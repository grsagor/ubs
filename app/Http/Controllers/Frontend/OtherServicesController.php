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

    public function propertyFindingService()
    {

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
        $info['product_id']             = $request->product_id;
        $info['product_name']           = $request->product_name;
        $info['bill']                   = $request->bill;
        $info['table_name']             = 'propertyFindingService';

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
                'output'            => $info['output'],
            ]);
    }
}
