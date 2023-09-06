<?php

namespace App\Http\Controllers;

use App\User;
use App\BusinessLocation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageFileUpload;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Modules\Crm\Entities\ServicePropertyWanted;

class PropertyWantedCustomerController extends Controller
{
    use ImageFileUpload;

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // $services       = ServicePropertyWanted::where('user_id', Auth::id())->get();

        // return $services;
        // if (!auth()->user()->can('business_settings.access')) {
        //     abort(403, 'Unauthorized action.');
        // }

        // $user_type = User::where('user_type', 'user_customer')->where('id', Auth::id())->first();

        // return $user_type;

        if (request()->ajax()) {
            $services       = ServicePropertyWanted::where('user_id', Auth::id())->get();

            return Datatables::of($services)
                ->addColumn('action', function ($service) {
                    return '<form action="' . route("shop.share.store") . '" method="post" enctype="multipart/form-data">
                ' . csrf_field() . '
                            <input type="hidden" value="' . $service->id . '" name="shop_id">
                            <input type="submit" class="btn btn-xs btn-primary" value="Share This Shop">
                        </form>';
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('crm::property_wanted.list');
    }

    public function create()
    {
        $business_id            = request()->session()->get('user.business_id');

        $business_locations     = BusinessLocation::where('business_id', $business_id)->get(['id', 'name', 'business_id']);

        return view('crm::property_wanted.create', compact('business_locations'));
    }




    public function store(Request $request)
    {
        try {
            $property                                 = new ServicePropertyWanted();

            $requestedData                            = $request->all();

            $requestedData['reference_id']            = Auth::id() . Str::random(15);

            $requestedData['user_id']                 = auth()->id();

            $requestedData['roomfurnishings']         = json_encode($request->roomfurnishings);

            $requestedData['images']                  = $this->image($request->file('images'), 'uploads/service_property/', 800, 500);

            $property->fill($requestedData)->save();

            $output = [
                'success' => true,
                'msg' => ('Created Successfully!!!'),
            ];

            return redirect()->back()->with('status', $output);
        } catch (\Throwable $e) {

            dd($e->getmessage());

            return redirect()->back();
        }
    }
}
