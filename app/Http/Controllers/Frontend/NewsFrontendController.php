<?php

namespace App\Http\Controllers\Frontend;

use App\News;
use App\Media;
use App\Footer;
use App\Region;
use App\Special;
use App\Category;
use App\LanguageSpeech;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NewsFrontendController extends Controller
{
    public function index()
    {
        $data['news'] = News::query()
            ->with(['user', 'userProfilePicture'])
            ->active()
            ->latest()
            ->get();

        $categories = Category::query()
            ->where('category_type', 'news')
            ->active()
            ->orderByNameAsc()
            ->get();

        $groupedDataSetsCategories = $categories->groupBy('parent_id');

        $data['categories'] = $this->buildHierarchy($groupedDataSetsCategories, 0);

        $data['regions'] = Region::query()
            ->active()
            ->orderByNameAsc()
            ->get();

        $data['languages'] = LanguageSpeech::query()
            ->active()
            ->orderByNameAsc()
            ->get();

        $data['specials'] = Special::query()
            ->where('type', 'news')
            ->active()
            ->orderByNameAsc()
            ->get();

        return view('frontend.news.index', $data);
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
