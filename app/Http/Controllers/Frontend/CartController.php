<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductBuyingInfo;
use App\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Stripe\Charge;
use Stripe\Stripe;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        $current_carts= Session::get('current_carts');
        $products = Product::whereIn('id', $current_carts)->get();
        foreach ($products as $product) {
            $price = 0;
            foreach ($product->variations as $variation) {
                $price += $variation->default_sell_price;
            }
            $product->price = $price;
        }
        return view('frontend.cart.cart', compact('products'));
    }
    public function postCart(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where([['user_id', $user->id], ['product_id', $request->product_id]])->first();

        if ($cart) {
            $cart->delete();
            $response = [
                'success' => true,
                'message' => 'Cart Deleted',
            ];
        } else {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->product_id = $request->product_id;
            $cart->save();

            $response = [
                'success' => true,
                'message' => 'Cart Added',
            ];
        }

        return response()->json($response);
    }

    public function checkout()
    {
        $user = Auth::user();
        $current_carts= Session::get('current_carts');
        $products = Product::whereIn('id', $current_carts)->get();
        foreach ($products as $product) {
            $price = 0;
            foreach ($product->variations as $variation) {
                $price += $variation->default_sell_price;
            }
            $product->price = $price;
        }
        $total_price = 0;
        foreach ($products as $product) {
            $total_price += $product->price;
        }
        if (!count($products)) {
            return back()->with('error', 'No products in cart.');
        }
        $product_ids = collect($products)->pluck('id')->toArray();
        $data = [
            'products' => $products,
            'total_price' => $total_price,
            'product_ids' => implode(',', $product_ids)
        ];
        return view('frontend.cart.checkout', $data);
    }

    public function checkoutPost(Request $request)
    {
        try {
            DB::beginTransaction();
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $charge = Charge::create([
                'amount' => $request->amount * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for your purchase',
            ]);

            $transaction_history = new TransactionHistory();
            $transaction_history->user_id = Auth::user()->id;
            $transaction_history->transaction_id = $charge->id;
            $transaction_history->amount = $request->amount;
            $transaction_history->save();

            $product_ids = explode(',', $request->product_ids);

            foreach ($product_ids as $product_id) {
                $product = Product::with('variations')->find($product_id);
                $price = 0;
                foreach ($product->variations as $variation) {
                    $price += $variation->default_sell_price;
                }

                $info = new ProductBuyingInfo();
                $info->user_id = Auth::user()->id;
                $info->product_id = $product_id;
                $info->transaction_id = $transaction_history->id;
                $info->amount = $price;
                $info->personal_name = $request->personal_name;
                $info->personal_email = $request->personal_email;
                $info->pass_check = $request->pass_check;
                $info->personal_pass = $request->personal_pass;
                $info->personal_confirm = $request->personal_confirm;
                $info->shipping = $request->shipping;
                $info->pickup_location = $request->pickup_location;
                $info->customer_name = $request->customer_name;
                $info->customer_email = $request->customer_email;
                $info->customer_phone = $request->customer_phone;
                $info->customer_address = $request->customer_address;
                $info->customer_city = $request->customer_city;
                $info->customer_zip = $request->customer_zip;
                $info->select_country = $request->select_country;
                $info->customer_state = $request->customer_state;
                $info->shipping_name = $request->shipping_name;
                $info->shipping_phone = $request->shipping_phone;
                $info->shipping_address = $request->shipping_address;
                $info->shipping_zip = $request->shipping_zip;
                $info->shipping_city = $request->shipping_city;
                $info->shipping_state = $request->shipping_state;
                $info->shipping_country = $request->shipping_country;
                $info->order_notes = $request->order_notes;
                $info->payment_method = $request->payment_method;
                $info->save();  
                
                $cart = Cart::where([['user_id', Auth::user()->id], ['product_id', $product_id]])->first();
                if($cart) {
                    $cart->delete();
                }
            }

            DB::commit();

            return redirect(route('homePage'))->with('success', 'Successful.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function orderNow(Request $request) {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $product = Product::find($id);
            Session::put('current_carts', [$id]);                
            DB::commit();
            $response = [
                'success' => true,
                'message' => 'Success'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }
}
