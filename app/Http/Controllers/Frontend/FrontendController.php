<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function footerDetails()
    {
        return view('frontend.footerDetails.footerDetails');
    }

    public function about_us()
    {
        return view('frontend.footerDetails.about-us.about_us');
    }

    public function statement()
    {
        return view('frontend.footerDetails.about-us.statement');
    }

    public function sustainability()
    {
        return view('frontend.footerDetails.about-us.sustainability');
    }

    public function unipuller_service()
    {
        return view('frontend.footerDetails.about-us.unipuller_service');
    }
}
