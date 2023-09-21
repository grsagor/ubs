<?php

namespace App\Http\Controllers;

use App\PaymentHistory;
use App\User;
use Modules\Crm\Entities\ServicePropertyWanted;
use Stripe;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $data['bill']                   = session('bill');
        $data['plan']                   = session('plan');
        $data['table_name']             = session('table_name');
        $data['upgrade']                = false;
        $data['url']                    = false;
        $data['meta_description']       = session('description');
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
                    "bill"                  => $request->bill,
                    "product_id"            => $request->product_id,
                    "product_name"          => $request->product_name,
                    "table_name"            => $request->table_name,
                    "meta_description"      => $request->meta_description,
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

            // dd($request->product_id, $request->upgrade, $request->url);
            if ($request->upgrade  == 'yes') {
                $property = ServicePropertyWanted::find($request->product_id);
                $property->upgraded = 1;
                $property->plan = $request->plan;
                $property->save();
            }

            Session::flash('success', 'Payment successful!');
            if ($request->url) {
                // $output = [
                //     'success' => true,
                //     'msg' => ('Created Successfully!!!'),
                // ];

                // return redirect()->back()->with('status', $output);
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
