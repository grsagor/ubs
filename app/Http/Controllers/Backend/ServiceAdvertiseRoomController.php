<?php

namespace App\Http\Controllers\Backend;

use App\ChildCategory;
use App\ServiceCategory;
use App\ServiceCharge;
use App\SubCategory;
use Illuminate\Support\Str;
use App\ServiceAdvertiseRoom;
use App\Traits\ImageFileUpload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreServiceAdvertiseRoomRequest;
use App\Http\Requests\UpdateServiceAdvertiseRoomRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class ServiceAdvertiseRoomController extends Controller
{

    use ImageFileUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ServiceCategory::all();
        $sub_categories = SubCategory::all();
        $child_categories = ChildCategory::all();
        $service_charges = ServiceCharge::where([['category_id',1],['sub_category_id',2],['child_category',1]])->get();
        // return $child_categories;
        $user = Auth::user();
        $services = ServiceAdvertiseRoom::where('user_id', $user->id)->get();
        // return $services;
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

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
        $categories = ServiceCategory::all();
        return view('backend.services.advertise_room.create', compact('categories'));
    }
    public function showSubCategorySelect(Request $request)
    {
        $category_id = $request->id;
        $categories = SubCategory::where('category_id', $category_id)->get();
        $html = '';
        foreach ($categories as $category) {
            $html .= '<option value="' . $category->id . '">' . $category->name . '</option>';
        }
        return $html;
    }
    public function showChildCategorySelect(Request $request)
    {
        $category_id = $request->id;
        $categories = ChildCategory::where('sub_category_id', $category_id)->get();
        $html = '';
        foreach ($categories as $category) {
            $html .= '<option value="' . $category->id . '">' . $category->name . '</option>';
        }
        return $html;
    }
    public function showRoomQuantitySelect(Request $request)
    {
        $service_charges = ServiceCharge::where([['category_id',$request->service_category_id],['sub_category_id',$request->sub_category_id],['child_category',$request->child_category_id]])->get();
        $html = '';
        foreach ($service_charges as $category) {
            $html .= '<option value="' . $category->size . '">' . $category->size . ' room for rent</option>';
        }
        return $html;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceAdvertiseRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceAdvertiseRoomRequest $request, ServiceAdvertiseRoom $serviceAdvertiseRoom)
    {

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

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceAdvertiseRoom  $serviceAdvertiseRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceAdvertiseRoom $serviceAdvertiseRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceAdvertiseRoom  $serviceAdvertiseRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceAdvertiseRoom $serviceAdvertiseRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceAdvertiseRoomRequest  $request
     * @param  \App\ServiceAdvertiseRoom  $serviceAdvertiseRoom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceAdvertiseRoomRequest $request, ServiceAdvertiseRoom $serviceAdvertiseRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceAdvertiseRoom  $serviceAdvertiseRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceAdvertiseRoom $serviceAdvertiseRoom)
    {
        //
    }
}
