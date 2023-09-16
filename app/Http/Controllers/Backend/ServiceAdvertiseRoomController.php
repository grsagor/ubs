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
        $category = ServiceCategory::where('name', 'Property')->first();
        $sub_category = SubCategory::where([['category_id', $category->id], ['name', 'rent']])->first();
        $child_categories = ChildCategory::where([['category_id', $category->id], ['sub_category_id', $sub_category->id],])->get();
        $service_charges = ServiceCharge::where([['category_id', $category->id], ['sub_category_id', $sub_category->id], ['child_category', 1]])->get();
        // return $service_charges;
        $user = Auth::user();
        $services = ServiceAdvertiseRoom::where('user_id', $user->id)->get();
        // return $services;
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $services = ServiceAdvertiseRoom::where('user_id', $user->id)->get();

            return Datatables::of($services)
                ->addColumn('category_name', function ($service) {
                    return $service->category->name;
                })
                ->addColumn('subcategory_name', function ($service) {
                    return $service->sub_category->name;
                })
                ->addColumn('child_category_name', function ($service) {
                    return $service->child_category->name;
                })
                ->addColumn('action', function ($service) {
                    return '<div class="d-flex gap-1"><button type="button" data-id="' . $service->id . '" class="btn btn-xs btn-success property_rent_edit_btn">Edit</button><button type="button" class="btn btn-xs btn-danger property_wanted_delete_btn" data-id="' . $service->id . '">Delete</button></div>';
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
        $category = ServiceCategory::where('name', 'Property')->first();
        $sub_category = SubCategory::where([['category_id', $category->id], ['name', 'rent']])->first();
        //$sub_category = SubCategory::where(['category_id',$category->id])->get();

        $child_categories = ChildCategory::where([['category_id', $category->id], ['sub_category_id', $sub_category->id],])->get();

        $data = [];
        $data['category'] = $category;
        $data['sub_category'] = $sub_category;
        $data['child_categories'] = $child_categories;
        $data['house'] = ServiceCharge::where('child_category', 2)->first()->service_charge;
        $data['Flat'] = ServiceCharge::where('child_category', 6)->first()->service_charge;
        $data['studio_flat'] = ServiceCharge::where('child_category', 9)->first()->service_charge;
        $data['single'] = ServiceCharge::where([['child_category', 1], ['size', ['single']]])->first()->service_charge;
        $data['double'] = ServiceCharge::where([['child_category', 1], ['size', ['double']]])->first()->service_charge;
        $data['semi_double'] = ServiceCharge::where([['child_category', 1], ['size', ['semi-double']]])->first()->service_charge;
        $data['en_suite'] = ServiceCharge::where([['child_category', 1], ['size', ['en-suite']]])->first()->service_charge;

        return view('backend.services.advertise_room.create', $data);
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
        $child_category = ChildCategory::find($request->child_category_id);
        $service_charges = ServiceCharge::where([['category_id', $request->service_category_id], ['sub_category_id', $request->sub_category_id], ['child_category', $request->child_category_id]])->get();
        $html = '';
        foreach ($service_charges as $category) {
            $html .= '<option value="' . $category->size . '">' . $category->size . '</option>';
        }
        $data = [];
        $data['name'] = $child_category->name;
        $data['html'] = $html;
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceAdvertiseRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceAdvertiseRoomRequest $request, ServiceAdvertiseRoom $serviceAdvertiseRoom)
    {
        dd($request->toArray());

        try {
            $requestedData = $request->all();

            $requestedData['reference_id'] = Auth::id() . Str::random(15);;

            $requestedData['property_amenities'] = json_encode($request->property_amenities);

            // $requestedData['service_category_id']         = $request->service_category_id;
            // $requestedData['sub_category_id']         = $request->sub_category_id;
            // $requestedData['child_category_id']         = $request->child_category_id;
            // $requestedData['room_size']         = $request->room_size;

            $requestedData['room'] = json_encode([
                'room_cost_of_amount1' => $request->room_cost_of_amount1 ?? NULL,
                'room_cost_time1' => $request->room_cost_time1 ?? NULL,
                'room_size1' => $request->room_size1 ?? NULL,
                'room_amenities1' => $request->room_amenities1 ?? NULL,
                'room_furnishings1' => $request->room_furnishings1 ?? NULL,
                'room_security_deposit1' => $request->room_security_deposit1 ?? NULL,
                'room_available_from1' => $request->room_available_from1 ?? NULL,
                'service_charge_room1' => $request->service_charge_room1 ?? NULL,
                'room_holding_deposit1' => $request->room_holding_deposit1 ?? NULL,

                'room_cost_of_amount2' => $request->room_cost_of_amount2 ?? NULL,
                'room_cost_time2' => $request->room_cost_time2 ?? NULL,
                'room_size2' => $request->room_size2 ?? NULL,
                'room_amenities2' => $request->room_amenities2 ?? NULL,
                'room_furnishings2' => $request->room_furnishings2 ?? NULL,
                'room_security_deposit2' => $request->room_security_deposit2 ?? NULL,
                'room_available_from2' => $request->room_available_from2 ?? NULL,
                'service_charge_room2' => $request->service_charge_room2 ?? NULL,
                'room_holding_deposit2' => $request->room_holding_deposit2 ?? NULL,

                'room_cost_of_amount3' => $request->room_cost_of_amount3 ?? NULL,
                'room_cost_time3' => $request->room_cost_time3 ?? NULL,
                'room_size3' => $request->room_size3 ?? NULL,
                'room_amenities3' => $request->room_amenities3 ?? NULL,
                'room_furnishings3' => $request->room_furnishings3 ?? NULL,
                'room_security_deposit3' => $request->room_security_deposit3 ?? NULL,
                'room_available_from3' => $request->room_available_from3 ?? NULL,
                'service_charge_room3' => $request->service_charge_room3 ?? NULL,
                'room_holding_deposit3' => $request->room_holding_deposit3 ?? NULL,

                'room_cost_of_amount4' => $request->room_cost_of_amount4 ?? NULL,
                'room_cost_time4' => $request->room_cost_time4 ?? NULL,
                'room_size4' => $request->room_size4 ?? NULL,
                'room_amenities4' => $request->room_amenities4 ?? NULL,
                'room_furnishings4' => $request->room_furnishings4 ?? NULL,
                'room_security_deposit4' => $request->room_security_deposit4 ?? NULL,
                'room_available_from4' => $request->room_available_from4 ?? NULL,
                'service_charge_room4' => $request->service_charge_room4 ?? NULL,
                'room_holding_deposit4' => $request->room_holding_deposit4 ?? NULL,

                'room_cost_of_amount5' => $request->room_cost_of_amount5 ?? NULL,
                'room_cost_time5' => $request->room_cost_time5 ?? NULL,
                'room_size5' => $request->room_size5 ?? NULL,
                'room_amenities5' => $request->room_amenities5 ?? NULL,
                'room_furnishings5' => $request->room_furnishings5 ?? NULL,
                'room_security_deposit5' => $request->room_security_deposit5 ?? NULL,
                'room_available_from5' => $request->room_available_from5 ?? NULL,
                'service_charge_room5' => $request->service_charge_room5 ?? NULL,
                'room_holding_deposit5' => $request->room_holding_deposit5 ?? NULL,
            ]);


            // $requestedData['advert_photos']              = $this->image($request->file('advert_photos'), 'uploads/service_room/', 800, 500);

            if ($request->hasFile('advert_photos')) {
                $image_path = public_path('uploads/service_room');

                $images = [];

                foreach ($request->file('advert_photos') as $image) {
                    $image_name = rand(123456, 999999) . '.' . $image->getClientOriginalExtension();
                    $image->move($image_path, $image_name);
                    $images[] = 'uploads/service_room/' . $image_name;
                }

                $requestedData['advert_photos'] = json_encode($images);
            }
            // return $requestedData;

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

    public function showPropertyRentDeleteModal(Request $request)
    {
        $id = $request->id;
        return view('backend.services.advertise_room.property_rent_delete_modal', compact('id'));
    }
    public function confirmPropertyRentDelete(Request $request)
    {
        $id = $request->id;
        // $property = ServicePropertyWanted::find($id)->delete();
        $property = ServiceAdvertiseRoom::find($id);
        $property->forceDelete();
        $response = [
            'success' => true,
            'message' => 'Property deleted.'
        ];
        return response()->json($response);
    }

    public function showPropertyRentEditModal(Request $request)
    {
        $property = ServiceAdvertiseRoom::find($request->id);
        $category = ServiceCategory::where('name', 'Property')->first();
        $sub_category = SubCategory::where([['category_id', $category->id], ['name', 'rent']])->first();
        //$sub_category = SubCategory::where(['category_id',$category->id])->get();

        $child_categories = ChildCategory::where([['category_id', $category->id], ['sub_category_id', $sub_category->id],])->get();

        $data = [];
        $data['property'] = $property;
        $data['category'] = $category;
        $data['sub_category'] = $sub_category;
        $data['child_categories'] = $child_categories;
        $data['house'] = ServiceCharge::where('child_category', 2)->first()->service_charge;
        $data['Flat'] = ServiceCharge::where('child_category', 6)->first()->service_charge;
        $data['studio_flat'] = ServiceCharge::where('child_category', 9)->first()->service_charge;
        $data['single'] = ServiceCharge::where([['child_category', 1], ['size', ['single']]])->first()->service_charge;
        $data['double'] = ServiceCharge::where([['child_category', 1], ['size', ['double']]])->first()->service_charge;
        $data['semi_double'] = ServiceCharge::where([['child_category', 1], ['size', ['semi-double']]])->first()->service_charge;
        $data['en_suite'] = ServiceCharge::where([['child_category', 1], ['size', ['en-suite']]])->first()->service_charge;


        //dd($data['child_categories']);
        return view('backend.services.advertise_room.property_rent_edit_modal', $data);
    }

    public function updatePropertyRent(Request $request)
    {
        $property = ServiceAdvertiseRoom::find($request->id);

        $property->advert_first_name = $request->advert_first_name;
        $property->advert_last_name = $request->advert_last_name;

        $property->save();

        $response = [
            'success' => true,
            'message' => 'Property updated successfully.'
        ];
        return response()->json($response);
    }
    public function destroy(ServiceAdvertiseRoom $serviceAdvertiseRoom)
    {
        //
    }
}
