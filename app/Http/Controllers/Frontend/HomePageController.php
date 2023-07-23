<?php

namespace App\Http\Controllers\Frontend;

use App\ArrivalSection;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Rating;
use App\Slider;
use App\Star;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $data['sliders'] = Slider::get();
        $data['arrivals'] = ArrivalSection::where('status', 1)->get();
        $data['products'] = Product::get();
        $data['ratings'] = Rating::get();
        $data['categories'] = Category::limit(16)->get();
        $data['stars'] = Star::get();

        return view('frontend.pages.homepage.index', $data);
    }

    public function extraIndex()
    {
        $data['hot_products'] = Product::with('user')
            ->get();

        $data['latest_products'] = Product::get();
        $data['sale_products'] = Product::get();
        $data['best_products'] = Product::get();
        $data['popular_products'] = Product::get();
        $data['top_products'] = Product::get();
        $data['big_products'] = Product::get();
        $data['trending_products'] = Product::get();

        $data['flash_products'] = Product::first();

        // $data['blogs'] = Blog::where('language_id', 1)
        //     ->latest()
        //     ->take(2)
        //     ->get();

        $data['service_categories'] = Category::take(12)->get();
        // $data['stars'] = Star::take(8)->get();


        return view('Frontend.pages.homepage.features', $data);
    }
}
