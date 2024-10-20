<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;

class BusinessLocationCategoryController extends Controller

{
    protected $category_service;

    public function __construct(CategoryService $category_service)
    {
        $this->category_service = $category_service;
    }

    public function business_location_category_index()
    {
        $this->NotSuperAdmin();

        $business_id = request()->session()->get('user.business_id');

        $data['categories'] = Category::query()
            ->where('business_id', $business_id)
            ->where('category_type', 'business_location')
            ->onlyParent()
            ->orderByNameAsc()
            ->get();

        return view('business_location.category_business_location.index', $data);
    }

    public function business_location_category_create()
    {
        $this->NotSuperAdmin();

        return view('business_location.category_business_location.create');
    }

    public function business_location_category_store(Request $request)
    {
        $this->NotSuperAdmin();

        $object = new Category();

        $output =  $this->category_service->store($request, $object);

        return redirect()->route('business_location_category_index')->with('status', $output);
    }

    public function business_location_category_edit($id)
    {
        $this->NotSuperAdmin();

        $data = Category::find($id);

        return view('business_location.category_business_location.edit', compact('data'));
    }

    public function business_location_category_update(Request $request, $id)
    {
        $this->NotSuperAdmin();

        $object = Category::findOrFail($id);

        $output =  $this->category_service->update($request, $object);

        return redirect()->route('business_location_category_index')->with('status', $output);
    }

    public function business_location_category_statusChange($id)
    {
        $this->NotSuperAdmin();

        $data['category'] = Category::find($id);

        if ($data['category']) {
            // Toggle the status of the main category
            $data['category']->status = $data['category']->status == 1 ? 0 : 1;
            $data['category']->save();

            // Find and toggle the status of all subcategories
            $data['sub_categories'] = Category::where('parent_id', $id)->get();

            foreach ($data['sub_categories'] as $subCategory) {
                $subCategory->status = $data['category']->status; // Sync subcategory status with parent category
                $subCategory->save();
            }
        }

        $output = [
            'success' => true,
            'msg' => ('Status Change Successfully!!!'),
        ];

        return redirect()->route('business_location_category_index')->with('status', $output);
    }

    public function business_location_sub_category_statusChange($id)
    {
        $this->NotSuperAdmin();

        $data['sub_category'] = Category::find($id);

        $data['category'] = Category::find($data['sub_category']->parent_id);

        if ($data['category']->status == 0) {
            $output = [
                'success' => false,
                'msg' => ('Parent Category inactive'),
            ];

            return redirect()->back()->with('status', $output);
        }

        return $this->changeStatus($data['sub_category'], 'business_location_category_index', 'Status Change');
    }

    public function business_location_sub_category_create()
    {
        $this->NotSuperAdmin();

        $data['categorires'] = Category::query()
            ->where('category_type', 'business_location')
            ->active()
            ->orderByNameAsc()
            ->onlyParent()
            ->get();

        return view('business_location.sub_category_business_location.create', $data);
    }

    public function business_location_sub_category_edit($id)
    {
        $this->NotSuperAdmin();

        $data['sub_category'] = Category::findOrFail($id);

        $data['categories'] = Category::query()
            ->where('category_type', 'business_location')
            ->active()
            ->orderByNameAsc()
            ->onlyParent()
            ->get();

        return view('business_location.sub_category_business_location.edit', $data);
    }

    protected function NotSuperAdmin()
    {
        if (auth()->user()->id != 5) {
            // abort(403, 'Unauthorized action.');
            $output = [
                'success' => False,
                'msg' => 'You are not allowed',
            ];
            return redirect()->back()->with('status', $output);
        }
    }
}
