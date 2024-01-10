<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;
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
        // $data['bill']                   = session('bill');
        $data['bill']                   = 10;
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
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $metadata = ['stripe_email' => $request->stripeEmail];

        $charge = Charge::create([
            'amount' => 10 * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'metadata' => $metadata,
        ]);

        return $charge->id;
    }
}
