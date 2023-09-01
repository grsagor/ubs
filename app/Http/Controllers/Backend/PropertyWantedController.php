<?php

namespace App\Http\Controllers\Backend;


use App\ServiceAdvertiseRoom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageFileUpload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Crm\Entities\ServicePropertyWanted;
use Yajra\DataTables\Facades\DataTables;

class PropertyWantedController extends Controller
{
    use ImageFileUpload;

    public function index()
    {
        $user = Auth::user();
        $services = ServicePropertyWanted::where('user_id',$user->id)->get();
        return $services;
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $services = ServicePropertyWanted::where('user_id',$user->id)->get();

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
        return view('crm::property_wanted.create');
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
