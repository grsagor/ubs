<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;

class NewsMarketingCategoryController extends Controller
{
    protected $category_service;

    public function __construct(CategoryService $category_service)
    {
        $this->category_service = $category_service;
    }

    public function shop_news_category_index()
    {
        $this->NotSuperAdmin();

        $business_id = request()->session()->get('user.business_id');

        $data['categories'] = Category::query()
            ->where('business_id', $business_id)
            ->whereIn('category_type', ['news', 'marketing'])
            ->onlyParent()
            ->orderByNameAsc()
            ->get();

        return view('news_marketing.news_category.index', $data);
    }

    public function shop_news_category_create()
    {
        return view('news_marketing.news_category.create');
    }

    public function shop_news_category_store(Request $request)
    {
        $object = new Category();

        $output =  $this->category_service->store($request, $object);

        return redirect()->route('shop_news_category_index')->with('status', $output);
    }

    public function shop_news_category_edit($id)
    {
        $data = Category::find($id);
        return view('news_marketing.news_category.edit', compact('data'));
    }

    public function shop_news_category_update(Request $request, $id)
    {
        $object = Category::findOrFail($id);

        $output =  $this->category_service->update($request, $object);

        return redirect()->route('shop_news_category_index')->with('status', $output);
    }

    public function shop_news_category_statusChange($id)
    {
        $data['category'] = Category::find($id);

        if ($data['category']) {
            // Toggle the status of the main category
            $data['category']->status = $data['category']->status == 1 ? 0 : 1;
            $data['category']->save();

            // Find and toggle the status of all subcategories
            $data['sub_categories'] = Category::where('parent_id', $id)->get();

            foreach ($data['sub_categories'] as $subCategory) {
                $subCategory->status = $data['category']->status;
                $subCategory->save();
            }
        }

        $output = [
            'success' => true,
            'msg' => ('Status Change Successfully!!!'),
        ];

        return redirect()->back()->with('status', $output);
    }


    public function shop_news_sub_category_create()
    {
        $data['categorires'] = Category::query()
            ->whereIn('category_type', ['news', 'marketing'])
            ->active()
            ->orderByNameAsc()
            ->onlyParent()
            ->get();

        return view('news_marketing.news_sub_category.create', $data);
    }

    public function shop_news_sub_category_edit($id)
    {
        $data['sub_category'] = Category::findOrFail($id);

        $data['categories'] = Category::query()
            ->whereIn('category_type', ['news', 'marketing'])
            ->active()
            ->orderByNameAsc()
            ->onlyParent()
            ->get();

        return view('news_marketing.news_sub_category.edit', $data);
    }

    public function shop_news_sub_category_statusChange($id)
    {
        // Retrieve the subcategory by its ID
        $subCategory = Category::find($id);

        // Find the parent category of the subcategory
        $parentCategory = Category::find($subCategory->parent_id);

        // Check if the parent category is inactive
        if ($parentCategory->status == 0) {
            // If inactive, return an error message
            $output = [
                'success' => false,
                'msg' => 'Parent Category is inactive',
            ];
        } else {
            // Toggle the status of the subcategory
            $newStatus = $subCategory->status == 1 ? 0 : 1;
            $subCategory->status = $newStatus;
            $subCategory->save();

            // Return a success message
            $output = [
                'success' => true,
                'msg' => 'Status changed successfully!',
            ];
        }

        // Redirect back with the status message
        return redirect()->back()->with('status', $output);
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
