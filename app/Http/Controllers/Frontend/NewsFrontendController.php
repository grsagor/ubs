<?php

namespace App\Http\Controllers\Frontend;

use App\News;
use App\Footer;
use App\Region;
use App\Special;
use App\Category;
use App\LanguageSpeech;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsFrontendController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Retrieve query parameters
            $search = $request->query('search');
            $searchDate = $request->query('date');
            $regionId = $request->query('region');
            $languageId = $request->query('language'); // Add language filter if needed
            $specialId = $request->query('special'); // Include special filter
            $categoryId = $request->query('category'); // Include special filter
            $subCategoryId = $request->query('subCategory'); // Include special filter

            // Log the selected subcategory ID
            \Log::info('Selected subCategoryId:', ['subCategoryId' => $subCategoryId]);

            // Build the query for news
            $query = News::query()
                ->with(['user', 'userProfilePicture', 'businessLocation'])
                ->active();

            // Filter by date if provided
            if ($searchDate) {
                $query->whereDate('created_at', $searchDate);
            }

            // Filter by search term if provided
            if ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', '%' . $search . '%')
                        ->orWhere('define_this_item', 'like', '%' . $search . '%');
                });
            }

            // Filter by region if provided
            if ($regionId) {
                $query->whereHas('region', function ($subQuery) use ($regionId) {
                    $subQuery->where('id', $regionId);
                });
            }

            // Filter by language if provided
            if ($languageId) {
                $query->whereHas('language', function ($subQuery) use ($languageId) {
                    $subQuery->where('id', $languageId);
                });
            }

            // Filter by special if provided
            if ($specialId) {
                $query->whereHas('special', function ($subQuery) use ($specialId) {
                    $subQuery->where('id', $specialId);
                });
            }

            // Filter by subcategory if provided
            if ($subCategoryId) {
                $query->where('subcategory_id', $subCategoryId);
            }

            // Filter by category if provided
            if ($categoryId) {
                $query->where('category_id', $categoryId);
            }

            // Execute the query and get the results
            $data['news'] = $query->latest()->get();

            // Fetch other necessary data for the view
            $categories = Category::query()
                ->where('category_type', 'news')
                ->active()
                ->orderByNameAsc()
                ->get();

            $groupedDataSetsCategories = $categories->groupBy('parent_id');
            $data['categories'] = $this->buildHierarchy($groupedDataSetsCategories, 0);
            $data['regions'] = Region::query()->active()->orderByNameAsc()->get();
            $data['languages'] = LanguageSpeech::query()->active()->orderByNameAsc()->get();
            $data['specials'] = Special::query()->where('type', 'news')->active()->orderByNameAsc()->get();

            // Return view or AJAX response
            if ($request->ajax()) {
                return view('frontend.news.partial.newsfeed', $data)->render();
            }

            return view('frontend.news.index', $data);
        } catch (\Exception $e) {
            // Log the error and return a JSON error response
            \Log::error('Error in index method: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function show($slug)
    {
        $data['news'] = News::query()
            ->with(['category', 'subCategory', 'region', 'language', 'special'])
            ->active()
            ->where('slug', $slug)
            ->first();

        if (!$data['news']) {
            return view('error.404');
        }

        $footerSlugs = ['contact-us-phone', 'contact-us-email-complain'];
        $data['othersInfo'] = Footer::whereIn('slug', $footerSlugs)->pluck('description', 'slug')->toArray();

        return view('frontend.news.show', $data);
    }

    protected function buildHierarchy($groupedDataSets, $parentId)
    {
        $result = [];

        // Check if the parent ID exists in the grouped data sets
        if (isset($groupedDataSets[$parentId])) {
            // Iterate over the child data sets
            foreach ($groupedDataSets[$parentId] as $dataSet) {
                // Recursively build hierarchy for child data sets
                $children = $this->buildHierarchy($groupedDataSets, $dataSet->id);
                // Add the current data set with its children to the result
                $result[] = [
                    'id' => $dataSet->id,
                    'name' => $dataSet->name,
                    'slug' => $dataSet->slug,
                    'children' => $children,
                ];
            }
        }

        return $result;
    }
}
