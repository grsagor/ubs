<?php

namespace App\Http\Controllers\Frontend;

use App\Product;
use App\BusinessLocation;
use App\ServiceEducation;
use Illuminate\Http\Request;
use App\ServiceSubCategories;
use App\ServiceChildCategories;
use App\Services\DataSetService;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    protected $dataSetService;

    public function __construct(DataSetService $dataSetService)
    {
        $this->dataSetService = $dataSetService;
    }

    public function serviceList(Request $request)
    {
        $data['products'] = Product::where('types', 'service')
            ->with('variations')
            ->search($request)
            ->latest()
            ->paginate(10);

        $data['nestedDataSets'] = $this->dataSetService->getNestedDataSets();

        return view('frontend.service.service_list.index', $data);
    }

    public function serviceCreate()
    {
        $business_id = request()->session()->get('user.business_id');

        $business_locations = BusinessLocation::where('business_id', $business_id)->get(['id', 'name', 'business_id']);

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
