<?php

namespace App\Http\Controllers\Frontend;

use App\Star;
use App\Rating;
use App\Slider;
use App\Product;
use App\Category;
use App\ArrivalSection;
use App\BusinessLocation;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $data['sliders']        = Slider::get();
        $data['arrivals']       = ArrivalSection::where('status', 1)->get();
        $data['products']       = Product::get();
        $data['ratings']        = Rating::get();
        $data['categories']     = Category::where('category_type', 'product')->limit(16)->get();
        $data['stars']          = Star::get();
        $data['vendors']        = BusinessLocation::latest()->limit(4)->get();

        return view('frontend.pages.homepage.index', $data);
    }
}
