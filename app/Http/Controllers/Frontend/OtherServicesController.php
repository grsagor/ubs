<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtherServicesController extends Controller
{
    public function digitalMarketing()
    {
        return view('frontend.other_services.digital_marketing');
    }

    public function partnerBoarding()
    {
        return view('frontend.other_services.partner_boarding');
    }

    public function businessSolutions()
    {
        return view('frontend.other_services.business_solution');
    }

    public function itSolutions()
    {
        return view('frontend.other_services.it_solution');
    }

    public function lettingService()
    {
        return 0;
    }
}
