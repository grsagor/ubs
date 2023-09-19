<?php

namespace App\Http\Controllers\Frontend;

use App\ChildCategory;
use App\ServiceCharge;
use App\ServiceCategory;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDO;

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

    public function propertyFindingService($service_id = null, $child_category_id = null)
    {
        $data['service_id'] = $service_id;
        $data['child_category_id'] = $child_category_id;

        $data['service_charge'] = ServiceCharge::with('childCategory')->get();

        $category = ServiceCategory::where('name', 'Property')->first();
        $sub_category = SubCategory::where([['category_id', $category->id], ['name', 'rent']])->first();
        $data['child_categories'] = ChildCategory::where([['category_id', $category->id], ['sub_category_id', $sub_category->id],])->latest()->get();

        return view('frontend.other_services.property_finding_service2', $data);
    }

    public function propertyFindingServiceCharge($id)
    {
        $data['service_charge'] = ServiceCharge::findOrFail($id);
        return $data;
    }

    public function propertyFindingPayment(Request $request)
    {
        // dd($request->toArray());
        $info['product_id']             = $request->service_id;
        $info['product_name']           = $request->product_name;
        $info['bill']                   = $request->bill;
        $info['table_name']             = 'propertyFindingService->serviceCharge';
        $info['description']            = 'Service charge id: ' . $request->child_category_id ?? NULL;

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
                'table_name'        => $info['table_name'],
                'description'        => $info['description'],
                'output'            => $info['output'],
                'upgrade'           => $info['upgrade'],
                'url'               => $info['url'],
            ]);
    }
}
