<?php

namespace App\Http\Controllers\Frontend;

use App\SubCategory;
use App\ChildCategory;
use App\ServiceCharge;
use App\ServiceCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StripePaymentService;

class OtherServicesController extends Controller
{
    protected $stripe_payment_service;

    public function __construct(StripePaymentService $stripe_payment_service)
    {
        $this->stripe_payment_service                 = $stripe_payment_service;
    }

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

    public function propertyFindingService($service_id = null, $child_category_id = null)
    {
        $data['service_id'] = $service_id;
        $data['child_category_id'] = $child_category_id;

        $category = ServiceCategory::where('name', 'Property')->first();
        $sub_category = SubCategory::where([['category_id', $category->id], ['name', 'rent']])->first();
        $data['child_categories'] = ChildCategory::where([['category_id', $category->id], ['sub_category_id', $sub_category->id],])->latest()->get();

        $data['service_charge'] = ServiceCharge::with('childCategory')->get();
        $data['studio_flat_service_charge'] = null;
        $data['house_service_charge'] = null;
        $data['flat_service_charge'] = null;

        foreach ($data['service_charge'] as $item) {
            if ($item->child_category == 2) {
                $data['house_service_charge'] = $item->service_charge;
            }

            if ($item->child_category == 6) {
                $data['flat_service_charge'] = $item->service_charge;
            }

            if ($item->child_category == 9) {
                $data['studio_flat_service_charge'] = $item->service_charge;
            }
        }
        return view('frontend.other_services.property_finding_service2', $data);
    }

    public function propertyFindingServiceCharge($id)
    {
        $data['service_charge'] = ServiceCharge::findOrFail($id);
        return $data;
    }

    public function propertyFindingPayment(Request $request)
    {
        // $request['table_name']             = 'propertyFindingService->serviceCharge';
        // $request['description']            = "Service charge id: " . $request->child_category_id_from_backend ?? NULL;
        // $request['upgrade']                = 'yes';
        // $request['url']                    = '/contact/property-wanted';

        // $data = $this->stripe_payment_service->paymentData($request);

        // return redirect('stripe')->with('data', $data);

        $info['product_id']             = $request->service_id;
        $info['product_name']           = $request->product_name;
        $info['plan']                   = $request->plan;
        $info['bill']                   = $request->bill;
        $info['table_name']             = 'propertyFindingService->serviceCharge';
        $info['description']            = "Service charge id: " . $request->child_category_id_from_backend ?? NULL;


        $info['upgrade']                = null;
        $info['url']                    = null;

        if ($request->service_id) {
            $info['upgrade']            = 'yes';
            $info['url']                = '/contact/property-wanted';
        }

        $info['output'] = [
            'success'               => true,
            'msg'                   => ('Successfull!'),
        ];

        return redirect('stripe')
            ->with([
                'product_id'        => $info['product_id'],
                'product_name'      => $info['product_name'],
                'bill'              => $info['bill'],
                'plan'              => $info['plan'],
                'table_name'        => $info['table_name'],
                'description'       => $info['description'],
                // 'output'            => $info['output'],
                'upgrade'           => $info['upgrade'],
                'url'               => $info['url'],
            ]);
    }
}
