<?php

namespace App\Http\Controllers\Frontend;

use App\ServiceCharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function propertyFindingService()
    {

        $data['service_charge'] = ServiceCharge::get();
        // return  $data['service_charge'];
        return view('frontend.other_services.property_finding_service', $data);
    }
}
