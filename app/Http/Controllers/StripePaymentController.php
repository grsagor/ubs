<?php

namespace App\Http\Controllers;

use Stripe;
use Session;
use App\User;
use App\SubCategory;
use App\PaymentHistory;
use App\ServiceCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Crm\Entities\ServicePropertyWanted;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $data['product_id']             = session('product_id');
        $data['product_name']           = session('product_name');
        $data['plan']                   = session('plan');
        $data['bill']                   = session('bill');
        $data['service_charge_id']      = session('service_charge_id');
        $data['child_category_id']      = session('child_category_id');
        $data['table_name']             = session('table_name');
        $data['upgrade']                = false;
        $data['url']                    = false;
        $data['type']                   = session('type');
        $data['status']                 = session('output');

        if (session('upgrade')) {
            $data['upgrade']            = true;
        }

        if (session('url')) {
            $data['url']                = session('url');
        }

        // return $data;
        return view('stripe', $data);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $userId             = Auth::id();
        $user_info          = User::find($userId);
        $customer           = \Stripe\Customer::create(array(
            'name'          => $user_info->username,
            'description'   => 'Null',
            'email'         => $user_info->email,
            'source'        => $request->input('stripeToken'),
            "address"       => ["city" => "San Francisco", "country" => "US", "line1" => "510 Townsend St", "postal_code" => "98140", "state" => "CA"]
        ));


        try {
            $charge = \Stripe\Charge::create(array(
                "amount"        => $request->bill * 100,
                "currency"      => "usd",
                "customer"      =>  $customer["id"],
                "description"   => "Test payment.",
                "metadata"      => array(
                    "product_id"            => $request->product_id,
                    "product_name"          => $request->product_name,
                    "plan"                  => $request->plan,
                    "bill"                  => $request->bill,
                    "service_charge_id"     => $request->service_charge_id,
                    "child_category_id"     => $request->child_category_id,
                    "table_name"            => $request->table_name,
                )
            ));

            $payment_history = new PaymentHistory;
            $payment_history->user_id = Auth::user()->id;
            $payment_history->amount = $request->bill; // Make sure to adjust the amount if needed
            $payment_history->currency = 'usd';
            $payment_history->description = 'Test payment.';
            $payment_history->transaction_id = $charge->id;
            $payment_history->foregn_key = $charge->metadata->product_id;
            $payment_history->table_name = $charge->metadata->table_name;
            $payment_history->save();

            if ($request->type == 'property_wanted_frontend') {
                dd('frontend');
                $category       = ServiceCategory::where('name', 'Property')->first();
                $sub_category   = SubCategory::where([['category_id', $category->id], ['name', 'buy']])->first();
                $requestedData['user_id'] = auth()->id();

                $property = new ServicePropertyWanted();

                $property->reference_id = Auth::id() . Str::random(15);
                $property->user_id =  auth()->id();
                $property->category_id =  $category->id;
                $property->sub_category_id =  $sub_category->id;
                $property->child_category_id =  $request->child_category_id;
                $property->upgraded =  1;
                $property->plan = $request->plan;
                $property->information_complete =  0; //O means information incomplete
                $property->save();
            }

            if ($request->upgrade  == 'yes') {
                $property = ServicePropertyWanted::find($request->product_id);
                $property->upgraded = 1;
                $property->plan = $request->plan;
                $property->save();
            }

            Session::flash('success', 'Payment successful!');
            if ($request->url) {
                return redirect($request->url);
            } else {
                return back();
            }
        } catch (\Stripe\Error\Card $e) {
            Session::flash('fail-message', $e->get_message());
            return back();
        }
    }
}
