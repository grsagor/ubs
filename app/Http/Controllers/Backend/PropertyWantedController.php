<?php

namespace App\Http\Controllers\Backend;


use App\BusinessLocation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\ServiceAdvertiseRoom;
use App\Traits\ImageFileUpload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Modules\Crm\Entities\ServicePropertyWanted;

class PropertyWantedController extends Controller
{
    use ImageFileUpload;

    public function index()
    {
        $user = Auth::user();
        $services = ServicePropertyWanted::where('user_id', $user->id)->get();
        // return $services;
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $services = ServicePropertyWanted::where('user_id', $user->id)->get();

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
        $business_id = request()->session()->get('user.business_id');

        $business_locations = BusinessLocation::where('business_id', $business_id)->get(['id', 'name', 'business_id']);

        return $business_locations;
    }



    public function store(Request $request)
    {
        try {
            $property                                 = new ServicePropertyWanted();

            $requestedData                            = $request->all();

            // Check Service Category Table Education category id is 2
            $requestedData['service_category_id']     = 1;

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
