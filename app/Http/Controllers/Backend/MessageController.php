<?php

namespace App\Http\Controllers\Backend;

use App\BusinessLocation;
use App\User;
use App\Message;
use App\Utils\ModuleUtil;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\NewMessageNotification;

class MessageController extends Controller
{
    /**
     * All Utils instance.
     */
    protected $moduleUtil;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct(ModuleUtil $moduleUtil)
    {
        $this->moduleUtil = $moduleUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $business_id = request()->session()->get('user.business_id');

        $query = Message::where('business_id', $business_id)
            ->whereHas('sender')
            ->with(['sender'])
            ->withTrashed()
            ->orderBy('created_at', 'ASC');

        $permitted_locations = auth()->user()->permitted_locations();
        if ($permitted_locations != 'all') {
            $query->where(function ($q) use ($permitted_locations) {
                $q->whereIn('location_id', $permitted_locations)
                    ->orWhereRaw('location_id IS NULL');
            });
        }
        $messages = $query->get();

        $business_locations = BusinessLocation::forDropdown($business_id);

        return view('backend.messages.index')
            ->with(compact('messages', 'business_locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */

    public function store(Request $request)
    {
        $business_id = $request->session()->get('user.business_id');

        if ($request->ajax()) {
            try {
                $user_id = $request->session()->get('user.id');

                $input = $request->only(['message', 'location_id', 'image_file']);
                $input['business_id'] = $business_id;
                $input['user_id'] = $user_id;

                // Check if a file or message is submitted
                // if ($request->hasFile('image_file') || !empty($input['message'])) {
                if (!empty($input['image_file']) || !empty($input['message'])) {
                    if (!empty($input['message'])) {
                        $input['message'] = nl2br($input['message']);
                    }
                    // dd($input);

                    if (!empty($input['image_file'])) {
                        $image_path = public_path('uploads/messages');

                        $images = [];

                        foreach ($request->file('image_file') as $image) {
                            $image_name = rand(123456, 999999) . '.' . $image->getClientOriginalExtension();
                            $image->move($image_path, $image_name);
                            $images[] = 'uploads/messages/' . $image_name;
                        }

                        $input['image_file'] = json_encode($images);
                    }

                    $message = Message::create($input);

                    $output = [
                        'success' => true,
                        'msg' => __('lang_v1.success'),
                        'html' => view('backend.messages.message_div', compact('message'))->render()
                    ];
                } else {
                    $output = [
                        'success' => false,
                        'msg' => __('Please enter a message or select a file to upload.')
                    ];
                }
            } catch (\Exception $e) {
                \Log::emergency('File:' . $e->getFile() . ' Line:' . $e->getLine() . ' Message:' . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => 'File:' . $e->getFile() . ' Line:' . $e->getLine() . ' Message:' . $e->getMessage(),
                ];
            }

            return response()->json($output);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy($id)
    {
        $business_id = request()->user()->business_id;

        if (request()->ajax()) {
            try {
                $user_id = request()->user()->id;

                Message::where('business_id', $business_id)
                    ->where('user_id', $user_id)
                    ->where('id', $id)
                    ->delete();

                $output = [
                    'success' => true,
                    'msg' => __('lang_v1.deleted_success'),
                ];
            } catch (\Exception $e) {
                \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong'),
                ];
            }

            return $output;
        }
    }

    /**
     * Sends notification to the user.
     *
     * @return void
     */
    private function __notify($message, $database_notification = true)
    {
        $business_id = request()->session()->get('user.business_id');
        $query = User::where('id', '!=', $message->user_id)
            ->where('business_id', $business_id);

        $users = null;
        if (empty($message->location_id)) {
            $users = $query->get();
        } else {
            $users = $query->permission('location.' . $message->location_id)->get();
        }

        if (count($users)) {
            $message->database_notification = $database_notification;
            \Notification::send($users, new NewMessageNotification($message));
        }
    }

    /**
     * Function to get recent messages
     *
     * @return void
     */
    public function getNewMessages()
    {
        $last_chat_time = request()->input('last_chat_time');

        $business_id = request()->session()->get('user.business_id');

        $query = Message::where('business_id', $business_id)
            ->where('user_id', '!=', auth()->user()->id)
            ->with(['sender'])
            ->orderBy('created_at', 'ASC');

        if (! empty($last_chat_time)) {
            $query->where('created_at', '>', $last_chat_time);
        }

        $permitted_locations = auth()->user()->permitted_locations();
        if ($permitted_locations != 'all') {
            $query->where(function ($q) use ($permitted_locations) {
                $q->whereIn('location_id', $permitted_locations)
                    ->orWhereRaw('location_id IS NULL');
            });
        }
        $messages = $query->get();

        return view('backend.messages.recent_messages')->with(compact('messages'));
    }
}
