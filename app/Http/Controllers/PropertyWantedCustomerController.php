<?php

namespace App\Http\Controllers;

use App\BusinessLocation;
use App\ChildCategory;
use App\ServiceCategory;
use App\ServiceCharge;
use App\SubCategory;
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
        $user = Auth::user();
        $services = ServicePropertyWanted::where('user_id', $user->id)->get();
        // return $services;
        // if (!auth()->user()->can('business_settings.access')) {
        //     abort(403, 'Unauthorized action.');
        // }

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

        // return $business_locations;
        $category = ServiceCategory::where('name','Property')->first();
        $sub_category = SubCategory::where([['category_id',$category->id],['name','buy']])->first();
        //$sub_category = SubCategory::where(['category_id',$category->id])->get();

        $child_categories = ChildCategory::where([['category_id',$category->id],['sub_category_id',$sub_category->id],])->get();

        $data = [];
        $data['category'] = $category;
        $data['sub_category'] = $sub_category;
        $data['child_categories'] = $child_categories;
        $data['house'] = ServiceCharge::where('child_category',2)->first()->service_charge;
        $data['Flat'] = ServiceCharge::where('child_category',6)->first()->service_charge;
        $data['studio_flat'] = ServiceCharge::where('child_category',9)->first()->service_charge;
        $data['single'] = ServiceCharge::where([['child_category',1],['size',['single']]])->first()->service_charge;
        $data['double'] = ServiceCharge::where([['child_category',1],['size',['double']]])->first()->service_charge;
        $data['semi_double'] = ServiceCharge::where([['child_category',1],['size',['semi-double']]])->first()->service_charge;
        $data['en_suite'] = ServiceCharge::where([['child_category',1],['size',['en-suite']]])->first()->service_charge;
        return view('crm::property_wanted.create', compact('business_locations'), $data);
    }

    public function showOccupantsDetailsInputs(Request $request) {
        $num = $request->num;
        $html = view('crm::property_wanted.show_occupants_details_inputs', compact('num'))->render();
        $response = [
            'html' => $html,
        ];
        return $response;
    }
    public function showRoomDetailsInputs(Request $request) {
        $num = $request->num;
        $html = view('crm::property_wanted.show_room_details_inputs', compact('num'))->render();
        $response = [
            'html' => $html,
        ];
        return $response;
    }

    public function store(Request $request)
    {
        $count = count($request->occupant_name);
        $occupant_details = [];
        for ($i=0; $i < $count; $i++) { 
            $occupant_details[] = [
                "occupant_name" => $request->occupant_name[$i],
                "occupant_gender_req" => $request->occupant_gender_req[$i],
                "occupant_age" => $request->occupant_age[$i],
                "occupant_relationship" => $request->occupant_relationship[$i],
                "occupant_occupation" => $request->occupant_occupation[$i],
                "occupant_university_name" => $request->occupant_university_name[$i],
                "occupant_degree_name" => $request->occupant_degree_name[$i],
                "occupant_job" => $request->occupant_job[$i],
                "occupant_job_type" => $request->occupant_job_type[$i],
                "occupant_miat" => $request->occupant_miat[$i],
                "occupant_pay_rent" => $request->occupant_pay_rent[$i],
                "occupant_nationality" => $request->occupant_nationality[$i],
                "occupant_visa_status" => $request->occupant_visa_status[$i],
            ];
        }
        // $roomDetails = [];
        // $count = count($request->room_details);
        // for ($i = 0; $i < $count; $i++) {
        //     $roomDetails[$i] = $request->room_details[$i];
        // }
        // return $request;
        $property                                   = new ServicePropertyWanted();

        $requestedData                              = $request->all();

        $requestedData['reference_id']              = Auth::id() . Str::random(15);

        $requestedData['user_id']                   = auth()->id();

        $requestedData['roomfurnishings']           = json_encode($request->roomfurnishings);
        $requestedData['occupant_details']          = json_encode($occupant_details);
        $requestedData['room_details']              = json_encode($request->room_details);

        $requestedData['images']                    = $this->image($request->file('images'), 'uploads/service_property/', 800, 500);

        $property->fill($requestedData)->save();

        $output = [
            'success' => true,
            'msg' => ('Created Successfully!!!'),
        ];

        return redirect()->back()->with('status', $output);
        // try {
        //     $property                                 = new ServicePropertyWanted();

        //     $requestedData                            = $request->all();

        //     $requestedData['reference_id']            = Auth::id() . Str::random(15);

        //     $requestedData['user_id']                 = auth()->id();

        //     $requestedData['roomfurnishings']         = json_encode($request->roomfurnishings);
        //     $requestedData['occupant_details']         = json_encode($occupant_details);
        //     $requestedData['room_details']         = json_encode($request->room_size);

        //     $requestedData['images']                  = $this->image($request->file('images'), 'uploads/service_property/', 800, 500);

        //     $property->fill($requestedData)->save();

        //     $output = [
        //         'success' => true,
        //         'msg' => ('Created Successfully!!!'),
        //     ];

        //     return redirect()->back()->with('status', $output);
        // } catch (\Throwable $e) {

        //     dd($e->getmessage());

        //     return redirect()->back();
        // }
    }
    public function storaae(Request $request)
    {
        $count = count($request->occupant_name);
        $occupant_details = [];
        for ($i=0; $i < $count; $i++) { 
            $occupant_details[] = [
                "occupant_name" => $request->occupant_name[$i],
                "occupant_gender_req" => $request->occupant_gender_req[$i],
                "occupant_age" => $request->occupant_age[$i],
                "occupant_relationship" => $request->occupant_relationship[$i],
                "occupant_occupation" => $request->occupant_occupation[$i],
                "occupant_university_name" => $request->occupant_university_name[$i],
                "occupant_degree_name" => $request->occupant_degree_name[$i],
                "occupant_job" => $request->occupant_job[$i],
                "occupant_job_type" => $request->occupant_job_type[$i],
                "occupant_miat" => $request->occupant_miat[$i],
                "occupant_pay_rent" => $request->occupant_pay_rent[$i],
                "occupant_nationality" => $request->occupant_nationality[$i],
                "occupant_visa_status" => $request->occupant_visa_status[$i],
            ];
        }
        // return $request;
        $property                                   = new ServicePropertyWanted();

        $requestedData                              = $request->all();

        $requestedData['reference_id']              = strval(Auth::id()) . Str::random(15);

        $requestedData['user_id']                   = auth()->id();

        $requestedData['roomfurnishings']           = json_encode($request->roomfurnishings);
        $requestedData['occupant_details']          = json_encode($occupant_details);
        $requestedData['room_details']              = json_encode($request->room_size);

        $requestedData['images']                  = $this->image($request->file('images'), 'uploads/service_property/', 800, 500);

        $property->fill($requestedData)->save();

        $output = [
            'success' => true,
            'msg' => ('Created Successfully!!!'),
        ];

        return redirect()->back()->with('status', $output);
        // try {
        //     $property                                 = new ServicePropertyWanted();

        //     $requestedData                            = $request->all();

        //     $requestedData['reference_id']            = Auth::id() . Str::random(15);

        //     $requestedData['user_id']                 = auth()->id();

        //     $requestedData['roomfurnishings']         = json_encode($request->roomfurnishings);
        //     $requestedData['occupant_details']         = json_encode($occupant_details);
        //     $requestedData['room_details']         = json_encode($request->room_size);

        //     $requestedData['images']                  = $this->image($request->file('images'), 'uploads/service_property/', 800, 500);

        //     $property->fill($requestedData)->save();

        //     $output = [
        //         'success' => true,
        //         'msg' => ('Created Successfully!!!'),
        //     ];

        //     return redirect()->back()->with('status', $output);
        // } catch (\Throwable $e) {

        //     dd($e->getmessage());

        //     return redirect()->back();
        // }
    }
}
