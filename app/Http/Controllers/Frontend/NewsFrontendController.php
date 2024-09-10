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
            // Retrieve search and date parameters from the request
            $search = $request->query('search');
            $searchDate = $request->query('date');

            $query = News::query()
                ->with(['user', 'userProfilePicture', 'businessLocation'])
                ->active();

            // Apply the date filter if provided
            if ($searchDate) {
                $query->whereDate('created_at', $searchDate);
            }

            // Apply the search filter if provided
            if ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', '%' . $search . '%')
                        ->orWhere('define_this_item', 'like', '%' . $search . '%');
                });
            }

            // Retrieve the filtered news items
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

            if ($request->ajax()) {
                // Return the view fragment for the news feed
                return view('frontend.news.partial.newsfeed', $data)->render();
            }

            return view('frontend.news.index', $data);
        } catch (\Exception $e) {
            // Log the error message
            \Log::error('Error in index method: ' . $e->getMessage());

            // Return a generic error message
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
