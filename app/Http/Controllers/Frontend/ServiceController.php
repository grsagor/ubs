<?php

namespace App\Http\Controllers\Frontend;

use App\BusinessLocation;
use App\Http\Controllers\Controller;
use App\ServiceCategory;
use App\ServiceChildCategories;
use App\ServiceEducation;
use App\ServiceSubCategories;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function serviceList(Request $request)
    {
        $data['per_page'] = 10;

        $data['education']          = ServiceEducation::active()->select(
            'id',
            'course_name',
            'price',
            'institution_name',
            'start_date',
            'tuition_fee',
            'images',
            'description',
            'created_at'
        )
            ->search($request)
            ->latest()->paginate($data['per_page']);

        $data['service_categories'] = ServiceCategory::query()->pluck('name','id');
        $data['service_sub_categories'] = ServiceSubCategories::query()->pluck('name','id');
        $data['service_child_categories'] = ServiceChildCategories::query()->pluck('name','id');

        return view('frontend.service.service_list', $data);
    }

    public function serviceCreate()
    {
        $business_id = request()->session()->get('user.business_id');

        $business_locations = BusinessLocation::where('business_id', $business_id)->get(['id', 'name', 'business_id']);

        // return $business_locations;

        return view('backend.services.create', compact('business_locations'));
    }

    public function getSubcategories($category_id)
    {
        // Query your database to retrieve subcategories for the selected category
        $subcategories = ServiceSubCategories::where('service_category_id', $category_id)->get();

        return response()->json($subcategories);
    }

    public function getChildSubcategories($subCategory_id)
    {
        // Query your database to retrieve subcategories for the selected category
        $childSubcategories = ServiceChildCategories::where('service_sub_category_id', $subCategory_id)->get();

        return response()->json($childSubcategories);
    }


    public function getServiceItems($category_id)
    {
        $serviceItems = ServiceEducation::where('service_category_id', $category_id)->get();

        return response()->json($serviceItems);
    }




}
