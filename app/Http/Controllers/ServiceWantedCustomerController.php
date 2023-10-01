<?php

namespace App\Http\Controllers;

use App\BusinessLocation;
use App\ChildCategory;
use App\ServiceCategory;
use App\ServiceCharge;
use App\SubCategory;
use App\Traits\ImageFileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Crm\Entities\ServicePropertyWanted;
use Yajra\DataTables\Facades\DataTables;

class ServiceWantedCustomerController extends Controller
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
                    if ($service->upgraded && $service->plan == 'Regular') {
                        $buttons .= '<button>Regular </button>';
                    } elseif ($service->plan == 'Premium') {
                        $buttons .= '<button>Premium </button>';
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
}
