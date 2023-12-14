<?php

namespace App\Http\Controllers\Frontend;

use App\Footer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function sell_on_unipuller()
    {
        return view('frontend.footerDetails.make-money.sell_on_unipuller');
    }

    public function sell_on_technology()
    {
        return view('frontend.footerDetails.make-money.sell_on_technology');
    }

    public function associate_program()
    {
        return view('frontend.footerDetails.make-money.associate_program');
    }

    public function delivery_partner()
    {
        return view('frontend.footerDetails.make-money.delivery_partner');
    }

    public function advertising()
    {
        return view('frontend.footerDetails.our-services.advertising');
    }

    public function marketing()
    {
        return view('frontend.footerDetails.our-services.marketing');
    }

    public function website_devlopment()
    {
        return view('frontend.footerDetails.our-services.website_devlopment');
    }

    public function software_devlopment()
    {
        return view('frontend.footerDetails.our-services.software_devlopment');
    }

    public function seo()
    {
        return view('frontend.footerDetails.our-services.seo');
    }

    public function video_production()
    {
        return view('frontend.footerDetails.our-services.video_production');
    }

    public function software()
    {
        return view('frontend.footerDetails.quick-link.software');
    }

    public function ready_website()
    {
        return view('frontend.footerDetails.quick-link.ready_website');
    }

    public function form_generator()
    {
        return view('frontend.footerDetails.quick-link.form_generator');
    }

    public function qr_code_generator()
    {
        return view('frontend.footerDetails.quick-link.qr_code_generator');
    }

    public function content_creator()
    {
        return view('frontend.footerDetails.quick-link.content_creator');
    }

    public function privacy()
    {
        return view('frontend.footerDetails.policies.privacy');
    }

    public function cookies()
    {
        return view('frontend.footerDetails.policies.cookies');
    }

    public function condition_of_sale()
    {
        return view('frontend.footerDetails.policies.condition_of_sale');
    }

    public function condition_of_use()
    {
        $data = Footer::where('slug', 'condition_of_use_and_sale')->first();
        // dd($data);
        return view('frontend.footerDetails.policies.condition_of_use', compact('data'));
    }

    public function return_policies()
    {
        return view('frontend.footerDetails.policies.return_policies');
    }

    public function refund_policies()
    {
        return view('frontend.footerDetails.policies.refund_policies');
    }

    public function seller_statement()
    {
        return view('frontend.footerDetails.policies.seller_statement');
    }

    public function payment_terms()
    {
        return view('frontend.footerDetails.policies.payment_terms');
    }
}
