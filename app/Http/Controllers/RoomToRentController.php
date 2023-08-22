<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\ServiceAdvertiseRoom;
use App\Traits\ImageFileUpload;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class RoomToRentController extends Controller
{
    use ImageFileUpload;

    public function index()
    {
        $user = Auth::user();
        $services = ServiceAdvertiseRoom::where('user_id', $user->id)->get();
        // return $services;
        // if (!auth()->user()->can('business_settings.access')) {
        //     abort(403, 'Unauthorized action.');
        // }

        if (request()->ajax()) {
            $services = ServiceAdvertiseRoom::where('user_id', $user->id)->get();

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
        return view('backend.services.advertise_room.advertise');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.services.advertise_room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceAdvertiseRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $serviceAdvertiseRoom = new ServiceAdvertiseRoom;

        try {
            $requestedData                               = $request->all();

            $requestedData['reference_id']               = Auth::id() . Str::random(15);;

            $requestedData['property_amenities']         = json_encode($request->property_amenities);

            $requestedData['room']                       = json_encode([
                'room_cost_of_amount1'                   => $request->room_cost_of_amount1 ?? NULL,
                'room_cost_time1'                        => $request->room_cost_time1 ?? NULL,
                'room_size1'                             => $request->room_size1 ?? NULL,
                'room_amenities1'                        => $request->room_amenities1 ?? NULL,
                'room_furnishings1'                      => $request->room_furnishings1 ?? NULL,
                'room_security_deposit1'                 => $request->room_security_deposit1 ?? NULL,

                'room_cost_of_amount2'                   => $request->room_cost_of_amount2 ?? NULL,
                'room_cost_time2'                        => $request->room_cost_time2 ?? NULL,
                'room_size2'                             => $request->room_size2 ?? NULL,
                'room_amenities2'                        => $request->room_amenities2 ?? NULL,
                'room_furnishings2'                      => $request->room_furnishings2 ?? NULL,
                'room_security_deposit2'                 => $request->room_security_deposit2 ?? NULL,

                'room_cost_of_amount3'                   => $request->room_cost_of_amount3 ?? NULL,
                'room_cost_time3'                        => $request->room_cost_time3 ?? NULL,
                'room_size3'                             => $request->room_size3 ?? NULL,
                'room_amenities3'                        => $request->room_amenities3 ?? NULL,
                'room_furnishings3'                      => $request->room_furnishings3 ?? NULL,
                'room_security_deposit3'                 => $request->room_security_deposit3 ?? NULL,
            ]);


            $requestedData['advert_photos']              = $this->image($request->file('advert_photos'), 'uploads/service_room/', 800, 500);


            $serviceAdvertiseRoom->fill($requestedData)->save();

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
