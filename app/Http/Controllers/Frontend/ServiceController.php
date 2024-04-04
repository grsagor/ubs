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
        $categories_id = Category::where('category_type', 'service')->get()->pluck('id');
        $data['per_page'] = 10;
        $price = 200;
        $products = Product::whereIn('category_id', $categories_id)
            // ->with(['variations' => function ($query) {
            //     $query->take(1); // Retrieve only the first variation
            // }])
            ->with('variations')
            ->search($request)
            ->latest()
            ->with('variations')
            ->get();

        // return $products;
        if ($request->category_id) {
            $products = Product::where('category_id', $request->category_id)->get();
        }
        if ($request->sub_category_id) {
            $products = Product::where('sub_category_id', $request->sub_category_id)->get();
        }
        if ($request->child_category_id) {
            $products = Product::where('child_category_id', $request->child_category_id)->get();
        }
        $data['products'] = $products->sortByDesc('updated_at')->values();
        // $data['products'] = Product::active()->with('category')->latest();

        if ($request->category_id !== null) {
            $data['products'] = $data['products']->where('category_id', $request->category_id);
            $data['sub_categories'] = Category::query()->where('parent_id', $request->category_id)->pluck('name', 'id');
        }
        if ($request->sub_category_id !== null) {
            $data['products'] = $data['products']->where('sub_category_id', $request->sub_category_id);
            $data['child_categories'] = Category::query()->where('parent_id', $request->sub_category_id)->pluck('name', 'id');
        }

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = $data['per_page'];
        $currentPageItems = $products->slice(($page - 1) * $perPage, $perPage)->all();

        $data['products'] = new LengthAwarePaginator($currentPageItems, count($products), $perPage);
        $data['products']->setPath(url()->current());

        // Business id == 5 means superadmin
        $data['categories'] = Category::query()->where([['category_type', 'service'], ['parent_id', 0], ['business_id', 5]])->orderBy('name')->pluck('name', 'id');

        $data['category_id'] = $request->category_id;

        $data['nestedDataSets'] = $this->dataSetService->getNestedDataSets();

        // return  $data['nestedDataSets'];
        return view('frontend.service.service_list', $data);
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
