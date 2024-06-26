<?php

namespace App\Http\Controllers\Frontend;

use App\Footer;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function footerDetails()
    {
        return view('frontend.footerDetails.footerDetails');
    }

    // About Us
    public function about_us()
    {
        return $this->footer_Details('about-us');
    }

    public function slavery_and_human_trafficking_statement()
    {
        return $this->footer_Details('slavery-and-human-trafficking-statement');
    }

    public function statement()
    {
        return $this->footer_Details('statement');
    }

    public function sustainability()
    {
        return $this->footer_Details('sustainability');
    }

    public function unipuller_service()
    {
        return $this->footer_Details('unipullers-services');
    }


    // Make money with us
    public function sell_on_unipuller()
    {
        return $this->footer_Details('sell-on-unipuller');
    }

    public function sell_on_technology()
    {
        return $this->footer_Details('sell-on-unipuller-technology');
    }

    public function associate_program()
    {
        return $this->footer_Details('associate-program');
    }

    public function delivery_partner()
    {
        return $this->footer_Details('service-delivery-partnership');
    }

    // Our Services
    public function advertising()
    {
        return $this->footer_Details('advertising');
    }

    public function marketing()
    {
        return $this->footer_Details('marketing');
    }

    public function website_devlopment()
    {
        return $this->footer_Details('website-development');
    }

    public function software_devlopment()
    {
        return $this->footer_Details('software-development');
    }

    public function seo()
    {
        return $this->footer_Details('seo');
    }

    public function video_production()
    {
        return $this->footer_Details('video-production');
    }

    public function partner_boarding()
    {
        return $this->footer_Details('partner-boarding');
    }

    // Privacy
    public function privacy_cookies()
    {
        return $this->footer_Details('privacy-and-cookies');
    }

    public function condition_of_use_sale()
    {
        return $this->footer_Details('condition-of-use-and-sale');
    }

    public function return_refund_policies()
    {
        return $this->footer_Details('returns-and-refund-policies');
    }

    public function payment_terms()
    {
        return $this->footer_Details('payments-terms');
    }


    // Menu
    public function landlord_service()
    {
        return $this->footer_Details('landlords-service');
    }

    public function tenant_management_service()
    {
        return $this->footer_Details('tenant-management-service');
    }

    public function business_solutions()
    {
        return $this->footer_Details('unipuller-business-solutions');
    }

    public function unipuller_business_solutions()
    {
        return $this->footer_Details('unipuller-business-solutions');
    }

    public function digital_marketing_service()
    {
        return $this->footer_Details('digital-marketing-service');
    }

    public function it_solutions()
    {
        return $this->footer_Details('it-solution');
    }

    public function contact_us()
    {
        $slugs = ['contact-us-address', 'contact-us-phone', 'contact-us-email'];

        $footerData = Footer::whereIn('slug', $slugs)
            ->pluck('description', 'slug')
            ->toArray();

        return view('frontend.footerDetails.contact_us.index', compact('footerData'));
    }



    public function footer_Details($slug)
    {
        $data = Footer::where('slug', $slug)->first();
        return view('frontend.footerDetails.index', compact('data'));
    }
}
