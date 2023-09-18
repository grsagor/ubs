<?php

namespace App\Http\Controllers;

use App\PaymentHistory;
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

        $data['product_id'] = session('product_id');
        $data['product_name'] = session('product_name');
        $data['bill'] = session('bill');
        $data['table_name'] = session('table_name');
        $data['upgrade'] = false;
        $data['url'] = false;
        if (session('upgrade')) {
            $data['upgrade'] = true;
        }
        if (session('url')) {
            $data['url'] = session('url');
        }
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $data['product_id']         = session('product_id');
        $data['product_name']       = session('product_name');
        $data['bill']               = session('bill');
        $data['table_name']         = session('table_name');
        $data['status']             = session('output');

        return $data;
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
        $email = Auth::user()->email;
        $customer = \Stripe\Customer::create(array(
            'name' => 'test',
            'description' => 'test description',
            'email' => $email,
            'source' => $request->input('stripeToken'),
            "address" => ["city" => "San Francisco", "country" => "US", "line1" => "510 Townsend St", "postal_code" => "98140", "state" => "CA"]
        ));
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $request->bill * 100,
                "currency" => "usd",
                "customer" =>  $customer["id"],
                "description" => "Test payment.",
                "metadata" => array(
                    "bill" => $request->bill,
                    "product_id" => $request->product_id,
                    "product_name" => $request->product_name,
                    "table_name" => $request->table_name,
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

            if ($request->upgrade) {
                $property = ServicePropertyWanted::find($request->product_id);
                $property->upgraded = 1;
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
