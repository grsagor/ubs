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

    public function propertyFindingService(Request $request)
    {
        if (auth()->check() && (auth()->user()->id === 5 || auth()->user()->user_type === 'user')) {
            abort(403, 'Unauthorized action.');
        }

        return $request->toArray();

        $data['property_id'] = $request->property_id;
        $data['child_category_id'] = $request->child_category_id;

        $category = ServiceCategory::where('name', 'Property')->first();
        $sub_category = SubCategory::where([['category_id', $category->id], ['name', 'rent']])->first();
        $data['child_categories'] = ChildCategory::where([['category_id', $category->id], ['sub_category_id', $sub_category->id],])->latest()->get();
        $data['room_size'] = ServiceCharge::where([['category_id', $category->id], ['sub_category_id', $sub_category->id], ['size', '!=', NULL]])->get();

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

        return view('frontend.other_services.property_finding_service3', $data);
    }

    public function propertyFindingServiceCharge($id)
    {
        $data['service_charge'] = ServiceCharge::findOrFail($id);
        return $data;
    }

    public function addClilckHandler(Request $request)
    {
        $category = ServiceCategory::where('name', 'Property')->first();
        $sub_category = SubCategory::where([['category_id', $category->id], ['name', 'rent']])->first();
        $room_size = ServiceCharge::where([['category_id', $category->id], ['sub_category_id', $sub_category->id], ['size', '!=', NULL]])->whereNotIn('id', $request->child_category)->get();
        $number_of_children = $request->number_of_children;
        $compact = [
            'number_of_children' => $number_of_children,
            'room_size' => $room_size
        ];
        $html = view('frontend.other_services.ajax_payment_select', $compact)->render();
        $response = [
            'html' => $html
        ];
        return response()->json($response);
    }
    public function changeQuantityHandler(Request $request)
    {
        $size_id = $request->size_id;
        $quantity = $request->quantity;
        $total_service_charge = 0;
        foreach ($size_id as $key => $value) {
            $service_charge = ServiceCharge::find($value)->service_charge;
            $service_charge = intval($service_charge) * intval($quantity[$key]);
            $total_service_charge = $total_service_charge + $service_charge;
        }
        $premium_service_charge = $total_service_charge * 1.4;
        $premium_service_charge = number_format($premium_service_charge, 2);

        $response = [
            'total_service_charge' => $total_service_charge,
            'premium_service_charge' => $premium_service_charge
        ];
        return response()->json($response);
    }

    public function propertyFindingPayment(Request $request)
    {
        // if ($request->category_name == 'room') {
        //     $product_id = [];
        //     $request->product_quantity = json_decode($request->product_quantity);
        //     foreach (json_decode($request->product_id) as $key => $value) {
        //         $size = ServiceCharge::find($value)->size;
        //         $service_charge = ServiceCharge::find($value)->service_charge;
        //         $product_id[] = [
        //             'size' => $size,
        //             'quantity' => $request->product_quantity[$key],
        //             'service_charge' => $service_charge
        //         ];
        //     }
        //     $request->merge(['product_id' => $product_id]);
        //     $request = $request->except('product_quantity');
        //     return $request;
        // }


        // $info['product_id']             = $request->product_id;
        // $info['product_name']           = $request->product_name;
        // $info['plan']                   = $request->plan;
        // $info['bill']                   = $request->bill;
        // $info['child_category_id']      = $request->child_category_id_from_backend;
        // $info['service_charge_id']      = $request->service_charge_id;
        // $info['table_name']             = 'propertyFindingService->serviceCharge';

        // $info['upgrade']                = null;
        // $info['url']                    = null;
        // $info['type']                   = 'property_wanted';

        // if ($request->product_id) {
        //     $info['upgrade']            = 'yes';
        //     $info['url']                = '/contact/property-wanted';
        // }

        // $info['output'] = [
        //     'success'               => true,
        //     'msg'                   => ('Successfull!'),
        // ];


        // return redirect('stripe')
        //     ->with([
        //         'product_id'        => $info['product_id'],
        //         'product_name'      => $info['product_name'],
        //         'plan'              => $info['plan'],
        //         'bill'              => $info['bill'],
        //         'service_charge_id' => $info['service_charge_id'],
        //         'child_category_id' => $info['child_category_id'],
        //         'table_name'        => $info['table_name'],
        //         // 'output'            => $info['output'],
        //         'upgrade'           => $info['upgrade'],
        //         'url'               => $info['url'],
        //         'type'              => $info['type'],
        //     ]);


        $info = [
            'product_id' => $request->product_id,
            'product_name' => $request->category_name === 'room' ?
                json_encode([
                    'size' => $request->room_size,
                    'room_quantity' => $request->room_quantity,
                    'charge' => $request->room_charge,
                ]) : $request->product_name,
            'plan' => $request->plan,
            'bill' => $request->category_name === 'room' ?
                $request->room_quantity * $request->room_charge : $request->bill,
            'child_category_id' => $request->child_category_id_from_backend,
            'service_charge_id' => $request->service_charge_id,
            'table_name' => 'propertyFindingService->serviceCharge',
            'upgrade' => $request->product_id ? 'yes' : null,
            'url' => '/contact/property-wanted',
            'type' => 'property_wanted',
            // 'output' => [
            //     'success' => true,
            //     'msg' => 'Successful!',
            // ],
        ];

        return redirect('stripe')
            ->with($info);
    }
}
