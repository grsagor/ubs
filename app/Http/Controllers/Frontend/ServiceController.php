<?php

namespace App\Http\Controllers\Frontend;

use App\Product;
use App\Category;
use App\ChildCategory;
use App\ServiceCategory;
use App\BusinessLocation;
use App\ResellingProduct;
use App\ServiceEducation;
use Illuminate\Http\Request;
use App\ServiceSubCategories;
use App\ServiceChildCategories;
use App\Services\DataSetService;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceController extends Controller
{
    protected $dataSetService;

    public function __construct(DataSetService $dataSetService)
    {
        $this->dataSetService = $dataSetService;
    }

    public function serviceList(Request $request)
    {
        // $data['products'] = Product::where('types', 'service')
        //     ->with('variations')
        //     ->search($request)
        //     ->with('variations')
        //     ->latest()
        //     ->paginate(10);

        // $data['nestedDataSets'] = $this->dataSetService->getNestedDataSets();

        $data['products'] = Product::where('types', 'service')
            ->with('variations')
            ->search($request)
            ->latest()
            ->paginate(10);

        $data['nestedDataSets'] = $this->dataSetService->getNestedDataSets();

        $page = $data['products']->currentPage(); // Changed to use current page from products pagination
        $perPage = $data['products']->perPage(); // Changed to use per page from products pagination
        $total_products = $data['products']->total(); // Assuming this represents the total number of products

        $currentPageItems = $data['products']->slice(($page - 1) * $perPage, $perPage)->all(); // Corrected to use products pagination


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
