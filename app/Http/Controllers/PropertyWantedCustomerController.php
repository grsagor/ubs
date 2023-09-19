<?php

namespace App\Http\Controllers;

use App\User;
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
        $services = ServicePropertyWanted::where('user_id', $user->id)->with('category')->with('sub_category')->with('child_category')->get();
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (request()->ajax()) {
            $services = ServicePropertyWanted::where('user_id', Auth::id())->get();

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
                    $buttons = '<div class="d-flex gap-1">';

                    // Edit button
                    $buttons .= '<button type="button" data-id="' . $service->id . '" class="btn btn-xs btn-success property_wanted_edit_btn">Edit</button>';

                    // Delete button
                    $buttons .= '<button type="button" class="btn btn-xs btn-danger property_wanted_delete_btn" data-id="' . $service->id . '">Delete</button>';

                    // Check the upgraded status and add the appropriate button
                    if ($service->upgraded == 1) {
                        $buttons .= '<button>Upgraded</button>';
                    } else {
                        // $buttons .= '<form action="/contact/property-wanted/upgrade" method="POST" enctype="multipart/form-data">
                        // <input type="hidden" name="_token" value="' . csrf_token() . '">
                        // <input type="hidden" name="product_id" value="' . $service->id . '">
                        //                 <input type="submit" value="Upgrade" class="btn btn-xs btn-primary">
                        //             </form>';

                        $buttons .= '<form action="/property-finding-service/' . $service->id . '/' . $service->child_category_id . '" method="GET" enctype="multipart/form-data">
                                        <input type="submit" value="Upgrade" class="btn btn-xs btn-primary">
                                    </form>';
                    }

                    $buttons .= '</div>';

                    return $buttons;
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
        $category = ServiceCategory::where('name', 'Property')->first();
        $sub_category = SubCategory::where([['category_id', $category->id], ['name', 'buy']])->first();
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
        return view('crm::property_wanted.create', compact('business_locations'), $data);
    }

    public function showOccupantsDetailsInputs(Request $request)
    {
        $num = $request->num;
        $html = view('crm::property_wanted.show_occupants_details_inputs', compact('num'))->render();
        $response = [
            'html' => $html,
        ];
        return $response;
    }
    public function showRoomDetailsInputs(Request $request)
    {
        $num = $request->num;
        $html = view('crm::property_wanted.show_room_details_inputs', compact('num'))->render();
        $response = [
            'html' => $html,
        ];
        return $response;
    }

    public function store(Request $request)
    {
        // dd($request->toArray());
        $request->validate([
            'ad_title'              => 'required|max:92',
            'why_is_searching'      => 'required|max:100',
        ]);

        $count = count($request->occupant_name);
        $occupant_details = [];
        for ($i = 0; $i < $count; $i++) {
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

        $property = new ServicePropertyWanted();

        $requestedData = $request->all();

        $requestedData['reference_id'] = Auth::id() . Str::random(15);

        $requestedData['user_id'] = auth()->id();

        $requestedData['roomfurnishings']       = json_encode($request->roomfurnishings);
        $requestedData['occupant_details']      = json_encode($occupant_details);
        $requestedData['room_details']          = json_encode($request->room_details);
        $requestedData['age']                   = json_encode($request->age);

        $requestedData['images'] = $this->image($request->file('images'), '', 800, 500);

        $property->fill($requestedData)->save();

        $output = [
            'success' => true,
            'msg' => ('Created Successfully!!!'),
        ];

        return redirect()->back()->with('status', $output);
    }

    public function storaae(Request $request)
    {
        $count = count($request->occupant_name);
        $occupant_details = [];
        for ($i = 0; $i < $count; $i++) {
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
        $property = new ServicePropertyWanted();

        $requestedData = $request->all();

        $requestedData['reference_id'] = strval(Auth::id()) . Str::random(15);

        $requestedData['user_id'] = auth()->id();

        $requestedData['roomfurnishings'] = json_encode($request->roomfurnishings);
        $requestedData['occupant_details'] = json_encode($occupant_details);
        $requestedData['room_details'] = json_encode($request->room_size);

        // $requestedData['images'] = $this->image($request->file('images'), 'uploads/service_property/', 800, 500);
        $requestedData['images'] = null;

        if ($request->hasFile('images')) {
            $image_path = public_path('uploads/service_property');
            $image_names = [];

            foreach ($request->file('images') as $file) {
                $image_name = rand(123456, 999999) . '.' . $file->getClientOriginalExtension();
                $file->move($image_path, $image_name);
                $image_names[] = 'uploads/service_property/' . $image_name;
            }

            $requestedData['images'] = $image_names;
        }

        $property->fill($requestedData)->save();

        $output = [
            'success' => true,
            'msg' => ('Created Successfully!!!'),
        ];

        return redirect()->back()->with('success', $output);
    }

    public function showPropertyDeleteModal(Request $request)
    {
        $id = $request->id;
        return view('crm::property_wanted.property_delete_modal', compact('id'));
    }
    public function confirmPropertyDelete(Request $request)
    {
        $id = $request->id;
        // $property = ServicePropertyWanted::find($id)->delete();
        $property = ServicePropertyWanted::find($id);
        $property->forceDelete();
        $response = [
            'success' => true,
            'message' => 'Property deleted.'
        ];
        return response()->json($response);
    }

    public function showPropertyEditModal(Request $request)
    {
        $id = $request->id;
        $property = ServicePropertyWanted::find($id);
        $property->occupant_details = json_decode($property->occupant_details);
        $property->room_details = json_decode($property->room_details);
        $property->roomfurnishings = json_decode($property->roomfurnishings);


        $business_id = request()->session()->get('user.business_id');

        $business_locations = BusinessLocation::where('business_id', $business_id)->get(['id', 'name', 'business_id']);

        // return $business_locations;
        $category = ServiceCategory::where('name', 'Property')->first();
        $sub_category = SubCategory::where([['category_id', $category->id], ['name', 'buy']])->first();
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
        return view('crm::property_wanted.property_edit_modal', compact('business_locations'), $data);
    }

    public function updatePropertyWanted(Request $request)
    {
        $property = ServicePropertyWanted::find($request->id);

        $property->first_name = $request->first_name;
        $property->last_name = $request->last_name;

        $property->save();

        $response = [
            'success' => true,
            'message' => 'Property updated successfully.'
        ];
        return response()->json($response);
    }
    public function propertyWantedUpgradePage(Request $request)
    {
        $property = ServicePropertyWanted::find($request->product_id);
        $bill = ServiceCharge::where([['category_id', $property->category_id], ['sub_category_id', $property->sub_category_id], ['child_category', $property->child_category_id]])->first()->service_charge;

        return redirect('stripe')
            ->with([
                'product_id' => $request->product_id,
                // 'product_name' => $info['product_name'],
                'bill' => $bill,
                'table_name' => 'service_property_wanted',
                'upgrade' => 'yes',
                'url' => '/contact/property-wanted',
            ]);
    }
}
