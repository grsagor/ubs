<?php

namespace App\Http\Controllers\Frontend;

use App\Business;
use App\BusinessLocation;
use App\Cart;
use App\Contact;
use App\Http\Controllers\Controller;
use App\InvoiceScheme;
use App\Media;
use App\Product;
use App\ProductBuyingInfo;
use App\ReferenceCount;
use App\Transaction;
use App\TransactionHistory;
use App\TransactionPayment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Charge;
use Stripe\Stripe;
use App\Utils\BusinessUtil;
use App\Utils\CashRegisterUtil;
use App\Utils\ContactUtil;
use App\Utils\ModuleUtil;
use App\Utils\NotificationUtil;
use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * All Utils instance.
     */
    protected $contactUtil;

    protected $productUtil;

    protected $businessUtil;

    protected $transactionUtil;

    protected $cashRegisterUtil;

    protected $moduleUtil;

    protected $notificationUtil;

    /**
     * Constructor
     *
     * @param  ProductUtils  $product
     * @return void
     */
    public function __construct(
        ContactUtil $contactUtil,
        ProductUtil $productUtil,
        BusinessUtil $businessUtil,
        TransactionUtil $transactionUtil,
        CashRegisterUtil $cashRegisterUtil,
        ModuleUtil $moduleUtil,
        NotificationUtil $notificationUtil
    ) {
        $this->contactUtil      = $contactUtil;
        $this->productUtil      = $productUtil;
        $this->businessUtil     = $businessUtil;
        $this->transactionUtil  = $transactionUtil;
        $this->cashRegisterUtil = $cashRegisterUtil;
        $this->moduleUtil       = $moduleUtil;
        $this->notificationUtil = $notificationUtil;

        $this->dummyPaymentLine = [
            'method'                  => 'cash',
            'amount'                  => 0,
            'note'                    => '',
            'card_transaction_number' => '',
            'card_number'             => '',
            'card_type'               => '',
            'card_holder_name'        => '',
            'card_month'              => '',
            'card_year'               => '',
            'card_security'           => '',
            'cheque_number'           => '',
            'bank_account_number'     => '',
            'is_return'               => 0,
            'transaction_no'          => '',
        ];
    }
    public function cart(Request $request)
    {
        $current_carts = Session::get('current_carts');
        if (!$current_carts) {
            return redirect(route('service.list'))->with('error', "No product/service selected.");
        }
        $products = Product::whereIn('id', $current_carts)->get();
        foreach ($products as $product) {
            // $product->contact_id = Contact::where('business_id', $product->business_id)->first()->id;
            $price               = 0;
            $price_excluding_tax = 0;
            $vat                 = 0;
            $mrp                 = 0;
            foreach ($product->variations as $variation) {
                $mrp += $variation->default_purchase_price + (($variation->default_purchase_price * $variation->profit_percent) / 100);
                $percentage = (($variation->dpp_inc_tax - $variation->default_purchase_price) * 100) / $variation->default_purchase_price;
                $vat        = ($mrp * $percentage) / 100;
                $price += $mrp + $vat;
            }
            $product->price               = $price;
            $product->price_excluding_tax = $mrp;
            $product->vat                 = $vat;
        }
        $total_price               = 0;
        $total_price_excluding_tax = 0;
        $total_vat                 = 0;
        foreach ($products as $product) {
            $product->location_id      = BusinessLocation::where('business_id', $product->business_id)->first()->id;
            $total_price += $product->price;
            $total_price_excluding_tax += $product->price_excluding_tax;
            $total_vat += $product->vat;
        }
        $data = [
            'products'                  => $products,
            'total_price'               => $total_price,
            'total_price_excluding_tax' => $total_price_excluding_tax,
            'total_vat'                 => $total_vat,
        ];

        return view('frontend.cart.cart', $data);
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
            $cart             = new Cart();
            $cart->user_id    = $user->id;
            $cart->product_id = $request->product_id;
            $cart->save();

            $response = [
                'success' => true,
                'message' => 'Cart Added',
            ];
        }

        return response()->json($response);
    }
    public function removecart(Request $request)
    {
        $current_carts  = Session::get('current_carts', []);
        $item_to_remove = $request->input('id');
        $current_carts  = array_filter($current_carts, function ($item) use ($item_to_remove) {
            return $item != $item_to_remove;
        });
        $current_carts  = array_values($current_carts);
        Session::put('current_carts', $current_carts);
        return back()->with('success', 'The product removed from cart.');
    }
    public function checkout()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                session(['intended_url' => 'checkout']);
                return redirect(url('login'));
            }
            $current_carts = Session::get('current_carts');
            if (!$current_carts) {
                return redirect(route('service.list'))->with('error', "No product/service selected.");
            }
            $products = Product::whereIn('id', $current_carts)->get();
            foreach ($products as $product) {
                // $product->contact_id = Contact::where('business_id', $product->business_id)->first()->id;
                $price               = 0;
                $price_excluding_tax = 0;
                $vat                 = 0;
                $mrp                 = 0;
                foreach ($product->variations as $variation) {
                    $mrp += $variation->default_purchase_price + (($variation->default_purchase_price * $variation->profit_percent) / 100);
                    $percentage = (($variation->dpp_inc_tax - $variation->default_purchase_price) * 100) / $variation->default_purchase_price;
                    $vat        = ($mrp * $percentage) / 100;
                    $price += $mrp + $vat;
                }
                $product->price               = $price;
                $product->price_excluding_tax = $mrp;
                $product->vat                 = $vat;
            }
            $total_price               = 0;
            $total_price_excluding_tax = 0;
            $total_vat                 = 0;
            foreach ($products as $product) {
                $product->location_id      = BusinessLocation::where('business_id', $product->business_id)->first()->id;
                $total_price += $product->price;
                $total_price_excluding_tax += $product->price_excluding_tax;
                $total_vat += $product->vat;
            }
            if (!count($products)) {
                return back()->with('error', 'No products in cart.');
            }
            $product_ids = collect($products)->pluck('id')->toArray();
            $data = [
                'user'                      => $user,
                'products'                  => $products,
                'total_price'               => $total_price,
                'total_price_excluding_tax' => $total_price_excluding_tax,
                'total_vat'                 => $total_vat,
                'product_ids'               => implode(',', $product_ids)
            ];
            return view('frontend.cart.checkout', $data);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function getClientSecret(Request $request)
    {
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $intent = \Stripe\PaymentIntent::create([
                'amount'   => ($request->amount) * 100,
                'currency' => 'GBP',
                'metadata' => ['integration_check' => 'accept_a_payment']
            ]);

            $user = Auth::user();
            $name = ($user->surname ? $user->surname . ' ' : '') . ($user->first_name ? $user->first_name . ' ' : '') . ($user->last_name ? $user->last_name : '');
            $data = [
                'name'          => $name,
                'email'         => $user->email,
                'amount'        => $request->amount,
                'client_secret' => $intent->client_secret,
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }
    public function checkoutPost(Request $request)
    {
        // return $request;
        $is_direct_sale = false;
        try {
            $input = $request->except('_token');

            $input['is_quotation'] = 0;
            //status is send as quotation from Add sales screen.
            if ($input['status'] == 'quotation') {
                $input['status']       = 'draft';
                $input['is_quotation'] = 1;
                $input['sub_status']   = 'quotation';
            } elseif ($input['status'] == 'proforma') {
                $input['status']     = 'draft';
                $input['sub_status'] = 'proforma';
            }

            //Add change return
            $change_return = $this->dummyPaymentLine;
            if (!empty($input['payment']['change_return'])) {
                $change_return = $input['payment']['change_return'];
                unset($input['payment']['change_return']);
            }

            $business_id   = $input['business_id'];
            $user_id       = Auth::user()->id;
            $user       = Auth::user();
            $discount      = [
                'discount_type'   => $input['discount_type'],
                'discount_amount' => $input['discount_amount'],
            ];
            $invoice_total = $this->productUtil->calculateInvoiceTotal($input['products'], $input['tax_rate_id'], $discount);

            DB::beginTransaction();

            $contact = Contact::where([['business_id', $business_id], ['user_id', $user_id]])->first();
            if (!$contact) {
                $contact_input = [
                    'type' => 'customer',
                    'user_id' => $user->id,
                    'business_id' => $business_id,
                    'prefix' => $user->surname,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'mobile' => $user->contact_no,
                    'opening_balance' => 0,
                    'contact_status' => 'active',
                    'created_by' => $user->id,
                    'converted_by' => null,
                    'supplier_business_name' => null,
                ];
                $output = $this->contactUtil->createNewContact($contact_input);
                $input['contact_id'] = $output['data']['id'];
            } else {
                $input['contact_id'] = $contact->id;
            }

            $input['transaction_date'] = Carbon::now();
            if ($is_direct_sale) {
                $input['is_direct_sale'] = 1;
            }

            //Set commission agent
            $input['commission_agent'] = !empty($request->input('commission_agent')) ? $request->input('commission_agent') : null;
            $commsn_agnt_setting       = $request->session()->get('business.sales_cmsn_agnt');
            if ($commsn_agnt_setting == 'logged_in_user') {
                $input['commission_agent'] = $user_id;
            }

            if (isset($input['exchange_rate']) && $this->num_uf($input['exchange_rate']) == 0) {
                $input['exchange_rate'] = 1;
            }

            //Customer group details
            $contact_id                 = $request->get('contact_id', null);
            $cg                         = $this->contactUtil->getCustomerGroup($business_id, $contact_id);
            $input['customer_group_id'] = (empty($cg) || empty($cg->id)) ? null : $cg->id;

            //set selling price group id
            $price_group_id = $request->has('price_group') ? $request->input('price_group') : null;

            //If default price group for the location exists
            $price_group_id = $price_group_id == 0 && $request->has('default_price_group') ? $request->input('default_price_group') : $price_group_id;

            $input['is_suspend'] = isset($input['is_suspend']) && 1 == $input['is_suspend'] ? 1 : 0;
            if ($input['is_suspend']) {
                $input['sale_note'] = !empty($input['additional_notes']) ? $input['additional_notes'] : null;
            }

            //Generate reference number
            if (!empty($input['is_recurring'])) {
                //Update reference count
                $ref_count                = $this->setAndGetReferenceCount('subscription');
                $input['subscription_no'] = $this->generateReferenceNumber('subscription', $ref_count);
            }

            if (!empty($request->input('invoice_scheme_id'))) {
                $input['invoice_scheme_id'] = $request->input('invoice_scheme_id');
            }

            //Types of service
            if ($this->moduleUtil->isModuleEnabled('types_of_service')) {
                $input['types_of_service_id']    = $request->input('types_of_service_id');
                $price_group_id                  = !empty($request->input('types_of_service_price_group')) ? $request->input('types_of_service_price_group') : $price_group_id;
                $input['packing_charge']         = !empty($request->input('packing_charge')) ?
                    $this->num_uf($request->input('packing_charge')) : 0;
                $input['packing_charge_type']    = $request->input('packing_charge_type');
                $input['service_custom_field_1'] = !empty($request->input('service_custom_field_1')) ?
                    $request->input('service_custom_field_1') : null;
                $input['service_custom_field_2'] = !empty($request->input('service_custom_field_2')) ?
                    $request->input('service_custom_field_2') : null;
                $input['service_custom_field_3'] = !empty($request->input('service_custom_field_3')) ?
                    $request->input('service_custom_field_3') : null;
                $input['service_custom_field_4'] = !empty($request->input('service_custom_field_4')) ?
                    $request->input('service_custom_field_4') : null;
                $input['service_custom_field_5'] = !empty($request->input('service_custom_field_5')) ?
                    $request->input('service_custom_field_5') : null;
                $input['service_custom_field_6'] = !empty($request->input('service_custom_field_6')) ?
                    $request->input('service_custom_field_6') : null;
            }

            if ($request->input('additional_expense_value_1') != '') {
                $input['additional_expense_key_1']   = $request->input('additional_expense_key_1');
                $input['additional_expense_value_1'] = $request->input('additional_expense_value_1');
            }

            if ($request->input('additional_expense_value_2') != '') {
                $input['additional_expense_key_2']   = $request->input('additional_expense_key_2');
                $input['additional_expense_value_2'] = $request->input('additional_expense_value_2');
            }

            if ($request->input('additional_expense_value_3') != '') {
                $input['additional_expense_key_3']   = $request->input('additional_expense_key_3');
                $input['additional_expense_value_3'] = $request->input('additional_expense_value_3');
            }

            if ($request->input('additional_expense_value_4') != '') {
                $input['additional_expense_key_4']   = $request->input('additional_expense_key_4');
                $input['additional_expense_value_4'] = $request->input('additional_expense_value_4');
            }

            $input['selling_price_group_id'] = $price_group_id;

            if ($this->transactionUtil->isModuleEnabled('tables')) {
                $input['res_table_id'] = request()->get('res_table_id');
            }
            if ($this->transactionUtil->isModuleEnabled('service_staff')) {
                $input['res_waiter_id'] = request()->get('res_waiter_id');
            }

            //upload document
            $input['document'] = $this->transactionUtil->uploadFile($request, 'sell_document', 'documents');

            $transaction = $this->createSellTransaction($business_id, $input, $invoice_total, $user_id);

            //Upload Shipping documents
            Media::uploadMedia($business_id, $transaction, $request, 'shipping_documents', false, 'shipping_document');

            $this->transactionUtil->createOrUpdateSellLines($transaction, $input['products'], $input['location_id']);

            $change_return['amount']    = $input['change_return'] ?? 0;
            $change_return['is_return'] = 1;

            $input['payment'][] = $change_return;

            $is_credit_sale = isset($input['is_credit_sale']) && $input['is_credit_sale'] == 1 ? true : false;

            if (!$transaction->is_suspend && !empty($input['payment']) && !$is_credit_sale) {
                $this->transactionUtil->createOrUpdatePaymentLines($transaction, $input['payment']);
            }

            //Check for final and do some processing.
            if ($input['status'] == 'final') {
                if (!$is_direct_sale) {
                    //set service staff timer
                    foreach ($input['products'] as $product_line) {
                        if (!empty($product_line['res_service_staff_id'])) {
                            $product = Product::find($product_line['product_id']);

                            if (!empty($product->preparation_time_in_minutes)) {
                                $service_staff = User::find($product_line['res_service_staff_id']);

                                $base_time = Carbon::parse($transaction->transaction_date);

                                //if already assigned set base time as available_at
                                if (!empty($service_staff->available_at) && Carbon::parse($service_staff->available_at)->gt(Carbon::now())) {
                                    $base_time = Carbon::parse($service_staff->available_at);
                                }

                                $total_minutes = $product->preparation_time_in_minutes * $this->num_uf($product_line['quantity']);

                                $service_staff->available_at = $base_time->addMinutes($total_minutes);
                                $service_staff->save();
                            }
                        }
                    }
                }
                //update product stock
                foreach ($input['products'] as $product) {
                    $decrease_qty = $this->num_uf($product['quantity']);
                    if (!empty($product['base_unit_multiplier'])) {
                        $decrease_qty = $decrease_qty * $product['base_unit_multiplier'];
                    }

                    if ($product['enable_stock']) {
                        $this->productUtil->decreaseProductQuantity(
                            $product['product_id'],
                            $product['variation_id'],
                            $input['location_id'],
                            $decrease_qty
                        );
                    }

                    if ($product['product_type'] == 'combo') {
                        //Decrease quantity of combo as well.
                        $this->productUtil
                            ->decreaseProductQuantityCombo(
                                $product['combo'],
                                $input['location_id']
                            );
                    }
                }

                //Add payments to Cash Register
                if (!$is_direct_sale && !$transaction->is_suspend && !empty($input['payment']) && !$is_credit_sale) {
                    $this->cashRegisterUtil->addSellPayments($transaction, $input['payment']);
                }

                //Update payment status
                if ($request->payment_method == 'stripe') {
                    $transaction->payment_status = 'paid';
                } else {
                    $transaction->payment_status = 'due';
                }

                if ($request->session()->get('business.enable_rp') == 1) {
                    $redeemed = !empty($input['rp_redeemed']) ? $input['rp_redeemed'] : 0;
                    $this->transactionUtil->updateCustomerRewardPoints($contact_id, $transaction->rp_earned, 0, $redeemed);
                }

                //Allocate the quantity from purchase and add mapping of
                //purchase & sell lines in
                //transaction_sell_lines_purchase_lines table
                $business_details = $this->businessUtil->getDetails($business_id);
                $pos_settings     = empty($business_details->pos_settings) ? $this->businessUtil->defaultPosSettings() : json_decode($business_details->pos_settings, true);

                $business = [
                    'id'                => $business_id,
                    'accounting_method' => $request->session()->get('business.accounting_method'),
                    'location_id'       => $input['location_id'],
                    'pos_settings'      => $pos_settings,
                ];
                $this->transactionUtil->mapPurchaseSell($business, $transaction->sell_lines, 'purchase');

                //Auto send notification
                // $whatsapp_link = $this->notificationUtil->autoSendNotification($business_id, 'new_sale', $transaction, $transaction->contact);
            }

            if (!empty($transaction->sales_order_ids)) {
                $this->transactionUtil->updateSalesOrderStatus($transaction->sales_order_ids);
            }

            $this->moduleUtil->getModuleData('after_sale_saved', ['transaction' => $transaction, 'input' => $input]);

            Media::uploadMedia($business_id, $transaction, $request, 'documents');

            $this->transactionUtil->activityLog($transaction, 'added');

            $transaction_payment                 = new TransactionPayment();
            $transaction_payment->transaction_id = $transaction->id;
            $transaction_payment->business_id    = $business_id;
            $transaction_payment->amount         = $input['final_total'];
            if ($request->payment_method == 'stripe') {
                $transaction_payment->method = 'card';

                $business         = Business::find($business_id);
                $wallet           = $business->wallet + $request->amount;
                $business->wallet = $wallet;
                $business->save();
            } else {
                $transaction_payment->method = 'cash';
            }
            $transaction_payment->save();
            Session::put('current_carts', null);
            DB::commit();

            if ($request->input('is_save_and_print') == 1) {
                $url = $this->transactionUtil->getInvoiceUrl($transaction->id, $business_id);

                return redirect()->to($url . '?print_on_load=true');
            }

            $msg     = trans('sale.pos_sale_added');
            $receipt = '';
            // $invoice_layout_id = $request->input('invoice_layout_id');
            $invoice_layout_id = 3;
            $print_invoice     = false;
            if (!$is_direct_sale) {
                if ($input['status'] == 'draft') {
                    $msg = trans('sale.draft_added');

                    if ($input['is_quotation'] == 1) {
                        $msg           = trans('lang_v1.quotation_added');
                        $print_invoice = true;
                    }
                } elseif ($input['status'] == 'final') {
                    $print_invoice = true;
                }
            }

            if ($transaction->is_suspend == 1 && empty($pos_settings['print_on_suspend'])) {
                $print_invoice = false;
            }

            if (!auth()->user()->can('print_invoice')) {
                $print_invoice = false;
            }

            // if ($print_invoice) {
            //     $receipt = $this->receiptContent($business_id, $input['location_id'], $transaction->id, null, false, true, $invoice_layout_id);
            // }
            $receipt = $this->receiptContent($business_id, $input['location_id'], $transaction->id, null, false, true, $invoice_layout_id, false, $request->payment_method);

            $output = ['success' => 1, 'msg' => $msg, 'receipt' => $receipt, 'transaction_id' => $transaction->id];
            Session::put('receipt', $receipt);

            if (!empty($whatsapp_link)) {
                $output['whatsapp_link'] = $whatsapp_link;
            }
            // } else {
            //     $output = ['success' => 0,
            //         'msg' => trans('messages.something_went_wrong'),
            //     ];
            // }
        } catch (\Exception $e) {
            DB::rollBack();
            // \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            $msg = $e->getMessage();
            \Log::emergency('Error Stack Trace:');
            $stackTrace = $e->getTrace();
            foreach ($stackTrace as $index => $trace) {
                $file     = isset($trace['file']) ? $trace['file'] : 'Unknown File';
                $line     = isset($trace['line']) ? $trace['line'] : 'Unknown Line';
                $function = isset($trace['function']) ? $trace['function'] : 'Unknown Function';
                $class    = isset($trace['class']) ? $trace['class'] : 'Unknown Class';

                \Log::emergency("{$index}: File: {$file}, Line: {$line}, Function: {$function}, Class: {$class}");
            }

            if (get_class($e) == \App\Exceptions\PurchaseSellMismatch::class) {
                $msg = $e->getMessage();
            }
            if (get_class($e) == \App\Exceptions\AdvanceBalanceNotAvailable::class) {
                $msg = $e->getMessage();
            }

            $output = [
                'success' => 0,
                'msg'     => $msg,
                'line'    => $e->getLine(),
                'file'    => $e->getTrace(),
            ];
        }

        if (!$is_direct_sale) {
            return $output;
        } else {
            if ($input['status'] == 'draft') {
                if (isset($input['is_quotation']) && $input['is_quotation'] == 1) {
                    return redirect()
                        ->action([\App\Http\Controllers\SellController::class, 'getQuotations'])
                        ->with('status', $output);
                } else {
                    return redirect()
                        ->action([\App\Http\Controllers\SellController::class, 'getDrafts'])
                        ->with('status', $output);
                }
            } elseif ($input['status'] == 'quotation') {
                return redirect()
                    ->action([\App\Http\Controllers\SellController::class, 'getQuotations'])
                    ->with('status', $output);
            } elseif (isset($input['type']) && $input['type'] == 'sales_order') {
                return redirect()
                    ->action([\App\Http\Controllers\SalesOrderController::class, 'index'])
                    ->with('status', $output);
            } else {
                if (!empty($input['sub_type']) && $input['sub_type'] == 'repair') {
                    $redirect_url = $input['print_label'] == 1 ? action([\Modules\Repair\Http\Controllers\RepairController::class, 'printLabel'], [$transaction->id]) : action([\Modules\Repair\Http\Controllers\RepairController::class, 'index']);

                    return redirect($redirect_url)
                        ->with('status', $output);
                }

                return redirect()
                    ->action([\App\Http\Controllers\SellController::class, 'index'])
                    ->with('status', $output);
            }
        }
    }

    private function createSellTransaction($business_id, $input, $invoice_total, $user_id, $uf_data = true)
    {
        $sale_type         = !empty($input['type']) ? $input['type'] : 'sell';
        $invoice_scheme_id = !empty($input['invoice_scheme_id']) ? $input['invoice_scheme_id'] : null;
        $invoice_no        = !empty($input['invoice_no']) ? $input['invoice_no'] : $this->getInvoiceNumber($business_id, $input['status'], $input['location_id'], $invoice_scheme_id, $sale_type);

        $final_total = $uf_data ? $this->num_uf($input['final_total']) : $input['final_total'];

        $pay_term_number = isset($input['pay_term_number']) ? $input['pay_term_number'] : null;
        $pay_term_type   = isset($input['pay_term_type']) ? $input['pay_term_type'] : null;

        //if pay term empty set contact pay term
        // if (empty($pay_term_number) || empty($pay_term_type)) {
        //     $contact = Contact::find($input['contact_id']);
        //     $pay_term_number = $contact->pay_term_number;
        //     $pay_term_type = $contact->pay_term_type;
        // }
        $pay_term_number = null;
        $pay_term_type   = null;
        $transaction     = Transaction::create([
            'business_id'                => $business_id,
            'location_id'                => $input['location_id'],
            'type'                       => $sale_type,
            'status'                     => $input['status'],
            'sub_status'                 => !empty($input['sub_status']) ? $input['sub_status'] : null,
            'contact_id'                 => $input['contact_id'],
            'customer_group_id'          => !empty($input['customer_group_id']) ? $input['customer_group_id'] : null,
            'invoice_no'                 => $invoice_no,
            'ref_no'                     => '',
            'source'                     => !empty($input['source']) ? $input['source'] : null,
            'total_before_tax'           => $invoice_total['total_before_tax'],
            'transaction_date'           => $input['transaction_date'],
            'tax_id'                     => !empty($input['tax_rate_id']) ? $input['tax_rate_id'] : null,
            'discount_type'              => !empty($input['discount_type']) ? $input['discount_type'] : null,
            'discount_amount'            => $uf_data ? $this->num_uf($input['discount_amount']) : $input['discount_amount'],
            'tax_amount'                 => $invoice_total['tax'],
            'final_total'                => $final_total,
            'additional_notes'           => !empty($input['sale_note']) ? $input['sale_note'] : null,
            'staff_note'                 => !empty($input['staff_note']) ? $input['staff_note'] : null,
            'created_by'                 => $user_id,
            'document'                   => !empty($input['document']) ? $input['document'] : null,
            'custom_field_1'             => !empty($input['custom_field_1']) ? $input['custom_field_1'] : null,
            'custom_field_2'             => !empty($input['custom_field_2']) ? $input['custom_field_2'] : null,
            'custom_field_3'             => !empty($input['custom_field_3']) ? $input['custom_field_3'] : null,
            'custom_field_4'             => !empty($input['custom_field_4']) ? $input['custom_field_4'] : null,
            'is_direct_sale'             => !empty($input['is_direct_sale']) ? $input['is_direct_sale'] : 0,
            'commission_agent'           => $input['commission_agent'] ?? null,
            'is_quotation'               => isset($input['is_quotation']) ? $input['is_quotation'] : 0,
            'shipping_details'           => isset($input['shipping_details']) ? $input['shipping_details'] : null,
            'shipping_address'           => isset($input['shipping_address']) ? $input['shipping_address'] : null,
            'shipping_status'            => isset($input['shipping_status']) ? $input['shipping_status'] : null,
            'delivered_to'               => isset($input['delivered_to']) ? $input['delivered_to'] : null,
            'shipping_charges'           => isset($input['shipping_charges']) ? $uf_data ? $this->num_uf($input['shipping_charges']) : $input['shipping_charges'] : 0,
            'shipping_custom_field_1'    => !empty($input['shipping_custom_field_1']) ? $input['shipping_custom_field_1'] : null,
            'shipping_custom_field_2'    => !empty($input['shipping_custom_field_2']) ? $input['shipping_custom_field_2'] : null,
            'shipping_custom_field_3'    => !empty($input['shipping_custom_field_3']) ? $input['shipping_custom_field_3'] : null,
            'shipping_custom_field_4'    => !empty($input['shipping_custom_field_4']) ? $input['shipping_custom_field_4'] : null,
            'shipping_custom_field_5'    => !empty($input['shipping_custom_field_5']) ? $input['shipping_custom_field_5'] : null,
            'exchange_rate'              => !empty($input['exchange_rate']) ?
                $uf_data ? $this->num_uf($input['exchange_rate']) : $input['exchange_rate'] : 1,
            'selling_price_group_id'     => isset($input['selling_price_group_id']) ? $input['selling_price_group_id'] : null,
            'pay_term_number'            => $pay_term_number,
            'pay_term_type'              => $pay_term_type,
            'is_suspend'                 => !empty($input['is_suspend']) ? 1 : 0,
            'is_recurring'               => !empty($input['is_recurring']) ? $input['is_recurring'] : 0,
            'recur_interval'             => !empty($input['recur_interval']) ? $input['recur_interval'] : 1,
            'recur_interval_type'        => !empty($input['recur_interval_type']) ? $input['recur_interval_type'] : null,
            'subscription_repeat_on'     => !empty($input['subscription_repeat_on']) ? $input['subscription_repeat_on'] : null,
            'subscription_no'            => !empty($input['subscription_no']) ? $input['subscription_no'] : null,
            'recur_repetitions'          => !empty($input['recur_repetitions']) ? $input['recur_repetitions'] : 0,
            'order_addresses'            => !empty($input['order_addresses']) ? $input['order_addresses'] : null,
            'sub_type'                   => !empty($input['sub_type']) ? $input['sub_type'] : null,
            'rp_earned'                  => $input['status'] == 'final' ? $this->calculateRewardPoints($business_id, $final_total) : 0,
            'rp_redeemed'                => !empty($input['rp_redeemed']) ? $input['rp_redeemed'] : 0,
            'rp_redeemed_amount'         => !empty($input['rp_redeemed_amount']) ? $input['rp_redeemed_amount'] : 0,
            'is_created_from_api'        => !empty($input['is_created_from_api']) ? 1 : 0,
            'types_of_service_id'        => !empty($input['types_of_service_id']) ? $input['types_of_service_id'] : null,
            'packing_charge'             => !empty($input['packing_charge']) ? $input['packing_charge'] : 0,
            'packing_charge_type'        => !empty($input['packing_charge_type']) ? $input['packing_charge_type'] : null,
            'service_custom_field_1'     => !empty($input['service_custom_field_1']) ? $input['service_custom_field_1'] : null,
            'service_custom_field_2'     => !empty($input['service_custom_field_2']) ? $input['service_custom_field_2'] : null,
            'service_custom_field_3'     => !empty($input['service_custom_field_3']) ? $input['service_custom_field_3'] : null,
            'service_custom_field_4'     => !empty($input['service_custom_field_4']) ? $input['service_custom_field_4'] : null,
            'service_custom_field_5'     => !empty($input['service_custom_field_5']) ? $input['service_custom_field_5'] : null,
            'service_custom_field_6'     => !empty($input['service_custom_field_6']) ? $input['service_custom_field_6'] : null,
            'round_off_amount'           => !empty($input['round_off_amount']) ? $input['round_off_amount'] : 0,
            'import_batch'               => !empty($input['import_batch']) ? $input['import_batch'] : null,
            'import_time'                => !empty($input['import_time']) ? $input['import_time'] : null,
            'res_table_id'               => !empty($input['res_table_id']) ? $input['res_table_id'] : null,
            'res_waiter_id'              => !empty($input['res_waiter_id']) ? $input['res_waiter_id'] : null,
            'sales_order_ids'            => !empty($input['sales_order_ids']) ? $input['sales_order_ids'] : null,
            'prefer_payment_method'      => !empty($input['prefer_payment_method']) ? $input['prefer_payment_method'] : null,
            'prefer_payment_account'     => !empty($input['prefer_payment_account']) ? $input['prefer_payment_account'] : null,
            'is_export'                  => !empty($input['is_export']) ? 1 : 0,
            'export_custom_fields_info'  => (!empty($input['is_export']) && !empty($input['export_custom_fields_info'])) ? $input['export_custom_fields_info'] : null,
            'additional_expense_value_1' => isset($input['additional_expense_value_1']) ? $uf_data ? $this->num_uf($input['additional_expense_value_1']) : $input['additional_expense_value_1'] : 0,
            'additional_expense_value_2' => isset($input['additional_expense_value_2']) ? $uf_data ? $this->num_uf($input['additional_expense_value_2']) : $input['additional_expense_value_2'] : 0,
            'additional_expense_value_3' => isset($input['additional_expense_value_3']) ? $uf_data ? $this->num_uf($input['additional_expense_value_3']) : $input['additional_expense_value_3'] : 0,
            'additional_expense_value_4' => isset($input['additional_expense_value_4']) ? $uf_data ? $this->num_uf($input['additional_expense_value_4']) : $input['additional_expense_value_4'] : 0,
            'additional_expense_key_1'   => !empty($input['additional_expense_key_1']) ? $input['additional_expense_key_1'] : null,
            'additional_expense_key_2'   => !empty($input['additional_expense_key_2']) ? $input['additional_expense_key_2'] : null,
            'additional_expense_key_3'   => !empty($input['additional_expense_key_3']) ? $input['additional_expense_key_3'] : null,
            'additional_expense_key_4'   => !empty($input['additional_expense_key_4']) ? $input['additional_expense_key_4'] : null,

        ]);

        return $transaction;
    }

    private function getInvoiceNumber($business_id, $status, $location_id, $invoice_scheme_id = null, $sale_type = null)
    {
        if ($status == 'final') {
            if (empty($invoice_scheme_id)) {
                $scheme = $this->getInvoiceScheme($business_id, $location_id);
            } else {
                $scheme = InvoiceScheme::find($invoice_scheme_id);
            }

            if ($scheme->scheme_type == 'blank') {
                $prefix = $scheme->prefix;
            } else {
                $prefix = $scheme->prefix . date('Y') . config('constants.invoice_scheme_separator');
            }

            //Count
            $count = $scheme->start_number + $scheme->invoice_count;
            $count = str_pad($count, $scheme->total_digits, '0', STR_PAD_LEFT);

            //Prefix + count
            $invoice_no = $prefix . $count;

            //Increment the invoice count
            $scheme->invoice_count = $scheme->invoice_count + 1;
            $scheme->save();

            return $invoice_no;
        } elseif ($status == 'draft') {
            $ref_count  = $this->setAndGetReferenceCount('draft', $business_id);
            $invoice_no = $this->generateReferenceNumber('draft', $ref_count, $business_id);

            return $invoice_no;
        } elseif ($sale_type == 'sales_order') {
            $ref_count  = $this->setAndGetReferenceCount('sales_order', $business_id);
            $invoice_no = $this->generateReferenceNumber('sales_order', $ref_count, $business_id);

            return $invoice_no;
        } else {
            return Str::random(5);
        }
    }
    private function num_uf($input_number, $currency_details = null)
    {
        $thousand_separator = '';
        $decimal_separator  = '';

        if (!empty($currency_details)) {
            $thousand_separator = $currency_details->thousand_separator;
            $decimal_separator  = $currency_details->decimal_separator;
        } else {
            $thousand_separator = session()->has('currency') ? session('currency')['thousand_separator'] : '';
            $decimal_separator  = session()->has('currency') ? session('currency')['decimal_separator'] : '';
        }

        $num = str_replace($thousand_separator, '', $input_number);
        $num = str_replace($decimal_separator, '.', $num);

        return (float) $num;
    }
    private function calculateRewardPoints($business_id, $total)
    {
        if (session()->has('business')) {
            $business = session()->get('business');
        } else {
            $business = Business::find($business_id);
        }
        $total_points = 0;

        // if ($business->enable_rp == 1) {
        //     //check if order total elegible for reward
        //     if ($business->min_order_total_for_rp > $total) {
        //         return $total_points;
        //     }
        //     $amount_per_unit_point = $business->amount_for_unit_rp;

        //     $total_points = floor($total / $amount_per_unit_point);

        //     if (! empty($business->max_rp_per_order) && $business->max_rp_per_order < $total_points) {
        //         $total_points = $business->max_rp_per_order;
        //     }
        // }

        return $total_points;
    }
    private function setAndGetReferenceCount($type, $business_id = null)
    {
        if (empty($business_id)) {
            $business_id = request()->session()->get('user.business_id');
        }

        $ref = ReferenceCount::where('ref_type', $type)
            ->where('business_id', $business_id)
            ->first();
        if (!empty($ref)) {
            $ref->ref_count += 1;
            $ref->save();

            return $ref->ref_count;
        } else {
            $new_ref = ReferenceCount::create([
                'ref_type'    => $type,
                'business_id' => $business_id,
                'ref_count'   => 1,
            ]);

            return $new_ref->ref_count;
        }
    }
    public function generateReferenceNumber($type, $ref_count, $business_id = null, $default_prefix = null)
    {
        $prefix = '';

        if (session()->has('business') && !empty(request()->session()->get('business.ref_no_prefixes')[$type])) {
            $prefix = request()->session()->get('business.ref_no_prefixes')[$type];
        }
        if (!empty($business_id)) {
            $business = Business::find($business_id);
            $prefixes = $business->ref_no_prefixes;
            $prefix   = !empty($prefixes[$type]) ? $prefixes[$type] : '';
        }

        if (!empty($default_prefix)) {
            $prefix = $default_prefix;
        }

        $ref_digits = str_pad($ref_count, 4, 0, STR_PAD_LEFT);

        if (!in_array($type, ['contacts', 'business_location', 'username'])) {
            $ref_year   = Carbon::now()->year;
            $ref_number = $prefix . $ref_year . '/' . $ref_digits;
        } else {
            $ref_number = $prefix . $ref_digits;
        }

        return $ref_number;
    }
    private function receiptContent(
        $business_id,
        $location_id,
        $transaction_id,
        $printer_type = null,
        $is_package_slip = false,
        $from_pos_screen = true,
        $invoice_layout_id = null,
        $is_delivery_note = false,
        $payment_method
    ) {
        $output = [
            'is_enabled'     => false,
            'print_type'     => 'browser',
            'html_content'   => null,
            'printer_config' => [],
            'data'           => [],
        ];

        $business_details = $this->businessUtil->getDetails($business_id);
        $location_details = BusinessLocation::find($location_id);

        // if ($from_pos_screen && $location_details->print_receipt_on_invoice != 1) {
        //     return $output;
        // }
        //Check if printing of invoice is enabled or not.
        //If enabled, get print type.
        $output['is_enabled'] = true;

        $invoice_layout_id = !empty($invoice_layout_id) ? $invoice_layout_id : $location_details->invoice_layout_id;
        $invoice_layout    = $this->businessUtil->invoiceLayout($business_id, $invoice_layout_id);

        //Check if printer setting is provided.
        $receipt_printer_type = is_null($printer_type) ? $location_details->receipt_printer_type : $printer_type;

        $receipt_details = $this->getReceiptDetails($transaction_id, $location_id, $invoice_layout, $business_details, $location_details, $receipt_printer_type);

        $currency_details          = [
            'symbol'             => '$',
            'thousand_separator' => $business_details->thousand_separator,
            'decimal_separator'  => $business_details->decimal_separator,
        ];
        $receipt_details->currency = $currency_details;

        // if ($is_package_slip) {
        // $output['html_content'] = view('sale_pos.receipts.packing_slip', compact('receipt_details'))->render();

        // return $output;
        // }

        // if ($is_delivery_note) {
        $output['html_content'] = view('sale_pos.receipts.checkout_receipt', compact('receipt_details', 'payment_method'))->render();

        return $output;
        // }

        $output['print_title'] = $receipt_details->invoice_no;
        //If print type browser - return the content, printer - return printer config data, and invoice format config
        // if ($receipt_printer_type == 'printer') {
        $output['print_type']     = 'printer';
        $output['printer_config'] = $this->businessUtil->printerConfig($business_id, $location_details->printer_id);
        $output['data']           = $receipt_details;
        // } else {
        //     $layout = !empty($receipt_details->design) ? 'sale_pos.receipts.' . $receipt_details->design : 'sale_pos.receipts.classic';

        // $output['html_content'] = view($layout, compact('receipt_details'))->render();
        // }

        return $output;
    }

    public function orderNow(Request $request)
    {
        try {
            DB::beginTransaction();
            $id      = $request->id;
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

    public function getReceiptDetails($transaction_id, $location_id, $invoice_layout, $business_details, $location_details, $receipt_printer_type)
    {
        $il = $invoice_layout;

        $transaction      = Transaction::find($transaction_id);
        $transaction_type = $transaction->type;

        $output = [
            'header_text'            => isset($il->header_text) ? $il->header_text : '',
            'business_name'          => ($il->show_business_name == 1) ? $business_details->name : '',
            'location_name'          => ($il->show_location_name == 1) ? $location_details->name : '',
            'sub_heading_line1'      => trim($il->sub_heading_line1),
            'sub_heading_line2'      => trim($il->sub_heading_line2),
            'sub_heading_line3'      => trim($il->sub_heading_line3),
            'sub_heading_line4'      => trim($il->sub_heading_line4),
            'sub_heading_line5'      => trim($il->sub_heading_line5),
            'table_product_label'    => $il->table_product_label,
            'table_qty_label'        => $il->table_qty_label,
            'table_unit_price_label' => $il->table_unit_price_label,
            'table_subtotal_label'   => $il->table_subtotal_label,
        ];

        //Display name
        $output['display_name'] = $output['business_name'];
        if (!empty($output['location_name'])) {
            if (!empty($output['display_name'])) {
                $output['display_name'] .= ', ';
            }
            $output['display_name'] .= $output['location_name'];
        }

        //Codes
        if (!empty($business_details->code_label_1) && !empty($business_details->code_1)) {
            $output['code_label_1'] = $business_details->code_label_1;
            $output['code_1']       = $business_details->code_1;
        }

        if (!empty($business_details->code_label_1) && !empty($business_details->code_1)) {
            $output['code_label_2'] = $business_details->code_label_2;
            $output['code_2']       = $business_details->code_2;
        }

        if ($il->show_letter_head == 1) {
            $output['letter_head'] = !empty($il->letter_head) &&
                file_exists(public_path('uploads/invoice_logos/' . $il->letter_head)) ?
                asset('uploads/invoice_logos/' . $il->letter_head) : null;
        }

        //Logo
        $output['logo'] = $il->show_logo != 0 && !empty($il->logo) && file_exists(public_path('uploads/invoice_logos/' . $il->logo)) ? asset('uploads/invoice_logos/' . $il->logo) : false;

        //Address
        $output['address'] = '';
        $temp              = [];
        if ($il->show_landmark == 1) {
            $temp[] = $location_details->landmark;
        }
        if ($il->show_city == 1 && !empty($location_details->city)) {
            $temp[] = $location_details->city;
        }
        if ($il->show_state == 1 && !empty($location_details->state)) {
            $temp[] = $location_details->state;
        }
        if ($il->show_zip_code == 1 && !empty($location_details->zip_code)) {
            $temp[] = $location_details->zip_code;
        }
        if ($il->show_country == 1 && !empty($location_details->country)) {
            $temp[] = $location_details->country;
        }
        if (!empty($temp)) {
            $output['address'] .= implode(', ', $temp);
        }

        $output['website']                = $location_details->website;
        $output['location_custom_fields'] = '';
        $temp                             = [];
        $location_custom_field_settings   = !empty($il->location_custom_fields) ? $il->location_custom_fields : [];
        if (!empty($location_details->custom_field1) && in_array('custom_field1', $location_custom_field_settings)) {
            $temp[] = $location_details->custom_field1;
        }
        if (!empty($location_details->custom_field2) && in_array('custom_field2', $location_custom_field_settings)) {
            $temp[] = $location_details->custom_field2;
        }
        if (!empty($location_details->custom_field3) && in_array('custom_field3', $location_custom_field_settings)) {
            $temp[] = $location_details->custom_field3;
        }
        if (!empty($location_details->custom_field4) && in_array('custom_field4', $location_custom_field_settings)) {
            $temp[] = $location_details->custom_field4;
        }
        if (!empty($temp)) {
            $output['location_custom_fields'] .= implode(', ', $temp);
        }

        //Tax Info
        if ($il->show_tax_1 == 1 && !empty($business_details->tax_number_1)) {
            $output['tax_label1'] = !empty($business_details->tax_label_1) ? $business_details->tax_label_1 . ': ' : '';

            $output['tax_info1'] = $business_details->tax_number_1;
        }
        if ($il->show_tax_2 == 1 && !empty($business_details->tax_number_2)) {
            if (!empty($output['tax_info1'])) {
                $output['tax_info1'] .= ', ';
            }

            $output['tax_label2'] = !empty($business_details->tax_label_2) ? $business_details->tax_label_2 . ': ' : '';

            $output['tax_info2'] = $business_details->tax_number_2;
        }

        //Shop Contact Info
        $output['contact'] = '';
        if ($il->show_mobile_number == 1 && !empty($location_details->mobile)) {
            $output['contact'] .= '<b>' . __('contact.mobile') . ':</b> ' . $location_details->mobile;
        }
        if ($il->show_alternate_number == 1 && !empty($location_details->alternate_number)) {
            if (empty($output['contact'])) {
                $output['contact'] .= __('contact.mobile') . ': ' . $location_details->alternate_number;
            } else {
                $output['contact'] .= ', ' . $location_details->alternate_number;
            }
        }
        if ($il->show_email == 1 && !empty($location_details->email)) {
            if (!empty($output['contact'])) {
                $output['contact'] .= "\n";
            }
            $output['contact'] .= '<br>' . __('business.email') . ': ' . $location_details->email;
        }

        //Customer show_customer
        $customer = Contact::find($transaction->contact_id);

        $output['customer_info']          = '';
        $output['customer_tax_number']    = '';
        $output['customer_tax_label']     = '';
        $output['customer_custom_fields'] = '';
        if ($il->show_customer == 1) {
            $output['customer_label']  = !empty($il->customer_label) ? $il->customer_label : '';
            $output['customer_name']   = !empty($customer->name) ? $customer->name : $customer->supplier_business_name;
            $output['customer_mobile'] = $customer->mobile;

            if ($receipt_printer_type != 'printer') {
                $output['customer_info'] .= $customer->contact_address;
                if (!empty($customer->contact_address)) {
                    $output['customer_info'] .= '<br>';
                }
                $output['customer_info'] .= '<b>' . __('contact.mobile') . '</b>: ' . $customer->mobile;
                if (!empty($customer->landline)) {
                    $output['customer_info'] .= ', ' . $customer->landline;
                }
            }

            $output['customer_tax_number'] = $customer->tax_number;
            $output['customer_tax_label']  = !empty($il->client_tax_label) ? $il->client_tax_label : '';

            $temp                            = [];
            $customer_custom_fields_settings = !empty($il->contact_custom_fields) ? $il->contact_custom_fields : [];
            $contact_custom_labels           = $this->transactionUtil->getCustomLabels($business_details, 'contact');
            if (!empty($customer->custom_field1) && in_array('custom_field1', $customer_custom_fields_settings)) {
                if (!empty($contact_custom_labels['custom_field_1'])) {
                    $temp[] = $contact_custom_labels['custom_field_1'] . ': ' . $customer->custom_field1;
                } else {
                    $temp[] = $customer->custom_field1;
                }
            }
            if (!empty($customer->custom_field2) && in_array('custom_field2', $customer_custom_fields_settings)) {
                if (!empty($contact_custom_labels['custom_field_2'])) {
                    $temp[] = $contact_custom_labels['custom_field_2'] . ': ' . $customer->custom_field2;
                } else {
                    $temp[] = $customer->custom_field2;
                }
            }
            if (!empty($customer->custom_field3) && in_array('custom_field3', $customer_custom_fields_settings)) {
                if (!empty($contact_custom_labels['custom_field_3'])) {
                    $temp[] = $contact_custom_labels['custom_field_3'] . ': ' . $customer->custom_field3;
                } else {
                    $temp[] = $customer->custom_field3;
                }
            }
            if (!empty($customer->custom_field4) && in_array('custom_field4', $customer_custom_fields_settings)) {
                if (!empty($contact_custom_labels['custom_field_4'])) {
                    $temp[] = $contact_custom_labels['custom_field_4'] . ': ' . $customer->custom_field4;
                } else {
                    $temp[] = $customer->custom_field1;
                }
            }
            if (!empty($temp)) {
                $output['customer_custom_fields'] .= implode('<br>', $temp);
            }

            //To be used in pdfs
            $customer_address = [];
            if (!empty($customer->supplier_business_name)) {
                $customer_address[] = $customer->supplier_business_name;
            }
            if (!empty($customer->address_line_1)) {
                $customer_address[] = '<br>' . $customer->address_line_1;
            }
            if (!empty($customer->address_line_2)) {
                $customer_address[] = '<br>' . $customer->address_line_2;
            }
            if (!empty($customer->city)) {
                $customer_address[] = '<br>' . $customer->city;
            }
            if (!empty($customer->state)) {
                $customer_address[] = $customer->state;
            }
            if (!empty($customer->country)) {
                $customer_address[] = $customer->country;
            }
            if (!empty($customer->zip_code)) {
                $customer_address[] = '<br>' . $customer->zip_code;
            }
            if (!empty(trim($customer->name))) {
                $customer_address[] = '<br>' . $customer->name;
            }
            if (!empty($customer->mobile)) {
                $customer_address[] = '<br>' . $customer->mobile;
            }
            if (!empty($customer->landline)) {
                $customer_address[] = $customer->landline;
            }

            $output['customer_info_address'] = '';
            if (!empty($customer_address)) {
                $output['customer_info_address'] = implode(', ', $customer_address);
            }
        }

        if ($il->show_reward_point == 1) {
            $output['customer_rp_label'] = $business_details->rp_name;
            $output['customer_total_rp'] = $customer->total_rp;
        }

        $output['client_id']       = '';
        $output['client_id_label'] = '';
        if ($il->show_client_id == 1) {
            $output['client_id_label'] = !empty($il->client_id_label) ? $il->client_id_label : '';
            $output['client_id']       = !empty($customer->contact_id) ? $customer->contact_id : '';
        }

        //Sales person info
        $output['sales_person']       = '';
        $output['sales_person_label'] = '';
        if ($il->show_sales_person == 1) {
            $output['sales_person_label'] = !empty($il->sales_person_label) ? $il->sales_person_label : '';
            $output['sales_person']       = !empty($transaction->sales_person->user_full_name) ? $transaction->sales_person->user_full_name : '';
        }

        //commission agent info
        $output['commission_agent']       = '';
        $output['commission_agent_label'] = '';
        if ($il->show_commission_agent == 1) {
            $output['commission_agent_label'] = !empty($il->commission_agent_label) ? $il->commission_agent_label : '';
            $output['commission_agent']       = !empty($transaction->sale_commission_agent->user_full_name) ? $transaction->sale_commission_agent->user_full_name : '';
        }

        //Invoice info
        $output['invoice_no']        = $transaction->invoice_no;
        $output['invoice_no_prefix'] = $il->invoice_no_prefix;
        $output['shipping_address']  = !empty($transaction->shipping_address()) ? $transaction->shipping_address() : $transaction->shipping_address;

        //Heading & invoice label, when quotation use the quotation heading.
        if ($transaction_type == 'sell_return') {
            $output['invoice_heading']   = $il->cn_heading;
            $output['invoice_no_prefix'] = $il->cn_no_label;

            //Parent sell details(return_parent_id)
            $output['parent_invoice_no']        = Transaction::find($transaction->return_parent_id)->invoice_no;
            $output['parent_invoice_no_prefix'] = $il->invoice_no_prefix;
        } elseif ($transaction->status == 'draft' && $transaction->sub_status == 'proforma' && !empty($il->common_settings['proforma_heading'])) {
            $output['invoice_heading'] = $il->common_settings['proforma_heading'];
        } elseif ($transaction->status == 'draft' && $transaction->is_quotation == 1) {
            $output['invoice_heading']   = $il->quotation_heading;
            $output['invoice_no_prefix'] = $il->quotation_no_prefix;
        } elseif ($transaction_type == 'sales_order') {
            $output['invoice_heading']   = !empty($il->common_settings['sales_order_heading']) ? $il->common_settings['sales_order_heading'] : __('lang_v1.sales_order');
            $output['invoice_no_prefix'] = $il->quotation_no_prefix;
        } else {
            $output['invoice_heading'] = $il->invoice_heading;
            if ($transaction->payment_status == 'paid' && !empty($il->invoice_heading_paid)) {
                $output['invoice_heading'] .= ' ' . $il->invoice_heading_paid;
            } elseif (in_array($transaction->payment_status, ['due', 'partial']) && !empty($il->invoice_heading_not_paid)) {
                $output['invoice_heading'] .= ' ' . $il->invoice_heading_not_paid;
            }
        }

        $output['date_label'] = $il->date_label;
        if (blank($il->date_time_format)) {
            $output['invoice_date'] = $this->transactionUtil->format_date($transaction->transaction_date, true, $business_details);
        } else {
            $output['invoice_date'] = \Carbon::createFromFormat('Y-m-d H:i:s', $transaction->transaction_date)->format($il->date_time_format);
        }

        $output['transaction_date'] = $transaction->transaction_date;
        $output['date_time_format'] = $business_details->date_format;
        $output['currency_symbol']  = $business_details->currency_symbol;

        $output['hide_price'] = !empty($il->common_settings['hide_price']) ? true : false;

        if (!empty($il->common_settings['show_due_date']) && $transaction->payment_status != 'paid') {
            $output['due_date_label'] = !empty($il->common_settings['due_date_label']) ? $il->common_settings['due_date_label'] : '';
            $due_date                 = $transaction->due_date;
            if (!empty($due_date)) {
                if (blank($il->date_time_format)) {
                    $output['due_date'] = $this->transactionUtil->format_date($due_date->toDateTimeString(), true, $business_details);
                } else {
                    $output['due_date'] = \Carbon::createFromFormat('Y-m-d H:i:s', $due_date->toDateTimeString())->format($il->date_time_format);
                }
            }
        }

        $show_currency = true;
        if ($receipt_printer_type == 'printer' && trim($business_details->currency_symbol) != '$') {
            $show_currency = false;
        }

        //Invoice product lines
        $is_lot_number_enabled     = $business_details->enable_lot_number;
        $is_product_expiry_enabled = $business_details->enable_product_expiry;

        $output['lines'] = [];
        $total_exempt    = 0;
        if (in_array($transaction_type, ['sell', 'sales_order'])) {
            $sell_line_relations = ['modifiers', 'sub_unit', 'warranties'];

            if ($is_lot_number_enabled == 1) {
                $sell_line_relations[] = 'lot_details';
            }

            $lines = $transaction->sell_lines()->whereNull('parent_sell_line_id')->with($sell_line_relations)->get();

            foreach ($lines as $key => $value) {
                if (!empty($value->sub_unit_id)) {
                    $formated_sell_line = $this->transactionUtil->recalculateSellLineTotals($business_details->id, $value);

                    $lines[$key] = $formated_sell_line;
                }
            }

            $output['item_discount_label'] = $il->common_settings['item_discount_label'] ?? '';

            $output['discounted_unit_price_label'] = $il->common_settings['discounted_unit_price_label'] ?? '';

            $output['show_base_unit_details'] = !empty($il->common_settings['show_base_unit_details']);

            $output['tax_summary_label'] = $il->common_settings['tax_summary_label'] ?? '';
            $details                     = $this->transactionUtil->_receiptDetailsSellLines($lines, $il, $business_details);

            $output['lines']     = $details['lines'];
            $output['taxes']     = [];
            $total_quantity      = 0;
            $total_line_discount = 0;
            $total_line_taxes    = 0;
            $subtotal_exc_tax    = 0;
            $unique_items        = [];
            foreach ($details['lines'] as $line) {
                if (!empty($line['group_tax_details'])) {
                    foreach ($line['group_tax_details'] as $tax_group_detail) {
                        if (!isset($output['taxes'][$tax_group_detail['name']])) {
                            $output['taxes'][$tax_group_detail['name']] = 0;
                        }
                        $output['taxes'][$tax_group_detail['name']] += $tax_group_detail['calculated_tax'];
                    }
                } elseif (!empty($line['tax_id'])) {
                    if (!isset($output['taxes'][$line['tax_name']])) {
                        $output['taxes'][$line['tax_name']] = 0;
                    }

                    $output['taxes'][$line['tax_name']] += ($line['tax_unformatted'] * $line['quantity_uf']);
                }

                if (!empty($line['tax_id']) && $line['tax_percent'] == 0) {
                    $total_exempt += $line['line_total_uf'];
                }
                $subtotal_exc_tax += $line['line_total_exc_tax_uf'];
                $total_quantity += $line['quantity_uf'];
                $total_line_discount += ($line['line_discount_uf'] * $line['quantity_uf']);
                $total_line_taxes += ($line['tax_unformatted'] * $line['quantity_uf']);
                if (!empty($line['variation_id']) && !in_array($line['variation_id'], $unique_items)) {
                    $unique_items[] = $line['variation_id'];
                }
            }

            if (!empty($il->common_settings['total_quantity_label'])) {
                $output['total_quantity_label'] = $il->common_settings['total_quantity_label'];
                $output['total_quantity']       = $this->num_f($total_quantity, false, $business_details, true);
            }

            if (!empty($il->common_settings['total_items_label'])) {
                $output['total_items_label'] = $il->common_settings['total_items_label'];
                $output['total_items']       = count($unique_items);
            }

            $output['subtotal_exc_tax']    = $this->num_f($subtotal_exc_tax, true, $business_details);
            $output['total_line_discount'] = !empty($total_line_discount) ? $this->num_f($total_line_discount, true, $business_details) : 0;
        } elseif ($transaction_type == 'sell_return') {
            $parent_sell = Transaction::find($transaction->return_parent_id);
            $lines       = $parent_sell->sell_lines;

            foreach ($lines as $key => $value) {
                if (!empty($value->sub_unit_id)) {
                    $formated_sell_line = $this->transactionUtil->recalculateSellLineTotals($business_details->id, $value);

                    $lines[$key] = $formated_sell_line;
                }
            }

            $details         = $this->transactionUtil->_receiptDetailsSellReturnLines($lines, $il, $business_details);
            $output['lines'] = $details['lines'];

            $output['taxes'] = [];
            foreach ($details['lines'] as $line) {
                if (!empty($line['group_tax_details'])) {
                    foreach ($line['group_tax_details'] as $tax_group_detail) {
                        if (!isset($output['taxes'][$tax_group_detail['name']])) {
                            $output['taxes'][$tax_group_detail['name']] = 0;
                        }
                        $output['taxes'][$tax_group_detail['name']] += $tax_group_detail['calculated_tax'];
                    }
                }
            }
        }

        //show cat code
        $output['show_cat_code']  = $il->show_cat_code;
        $output['cat_code_label'] = $il->cat_code_label;

        //Subtotal
        $output['subtotal_label']       = $il->sub_total_label . ':';
        $output['subtotal']             = ($transaction->total_before_tax != 0) ? $this->num_f($transaction->total_before_tax, $show_currency, $business_details) : 0;
        $output['subtotal_unformatted'] = ($transaction->total_before_tax != 0) ? $transaction->total_before_tax : 0;

        //round off
        $output['round_off_label']  = !empty($il->round_off_label) ? $il->round_off_label . ':' : __('lang_v1.round_off') . ':';
        $output['round_off']        = $this->num_f($transaction->round_off_amount, $show_currency, $business_details);
        $output['round_off_amount'] = $transaction->round_off_amount;
        $output['total_exempt']     = $this->num_f($total_exempt, $show_currency, $business_details);
        $output['total_exempt_uf']  = $total_exempt;

        $taxed_subtotal           = $output['subtotal_unformatted'] - $total_exempt;
        $output['taxed_subtotal'] = $this->num_f($taxed_subtotal, $show_currency, $business_details);

        //Discount
        $discount_amount               = $this->num_f($transaction->discount_amount, $show_currency, $business_details);
        $output['line_discount_label'] = $invoice_layout->discount_label;
        $output['discount_label']      = $invoice_layout->discount_label;
        $output['discount_label'] .= ($transaction->discount_type == 'percentage') ? ' <small>(' . $this->num_f($transaction->discount_amount, false, $business_details) . '%)</small> :' : '';

        if ($transaction->discount_type == 'percentage') {
            $discount = ($transaction->discount_amount / 100) * $transaction->total_before_tax;
        } else {
            $discount = $transaction->discount_amount;
        }
        $output['discount'] = ($discount != 0) ? $this->num_f($discount, $show_currency, $business_details) : 0;

        //reward points
        if ($business_details->enable_rp == 1 && !empty($transaction->rp_redeemed)) {
            $output['reward_point_label']  = $business_details->rp_name;
            $output['reward_point_amount'] = $this->num_f($transaction->rp_redeemed_amount, $show_currency, $business_details);
        }

        //Format tax
        if (!empty($output['taxes'])) {
            $total_tax = 0;
            foreach ($output['taxes'] as $key => $value) {
                $total_tax += $value;

                $output['taxes'][$key] = $this->num_f($value, $show_currency, $business_details);
            }

            $output['taxes'][trans('lang_v1.total_tax')] = $this->num_f($total_tax, $show_currency, $business_details);
        }

        //Order Tax
        $tax                      = $transaction->tax;
        $output['tax_label']      = $invoice_layout->tax_label;
        $output['line_tax_label'] = $invoice_layout->tax_label;
        if (!empty($tax) && !empty($tax->name)) {
            $output['tax_label'] .= ' (' . $tax->name . ')';
        }
        $output['tax_label'] .= ':';
        $output['tax']       = ($transaction->tax_amount != 0) ? $this->num_f($transaction->tax_amount, $show_currency, $business_details) : 0;

        if ($transaction->tax_amount != 0 && $tax->is_tax_group) {
            $transaction_group_tax_details = $this->transactionUtil->groupTaxDetails($tax, $transaction->tax_amount);

            $output['group_tax_details'] = [];
            foreach ($transaction_group_tax_details as $value) {
                $output['group_tax_details'][$value['name']] = $this->num_f($value['calculated_tax'], $show_currency, $business_details);
            }
        }

        //Shipping charges
        $output['shipping_charges']       = ($transaction->shipping_charges != 0) ? $this->num_f($transaction->shipping_charges, $show_currency, $business_details) : 0;
        $output['shipping_charges_label'] = trans('sale.shipping_charges');
        //Shipping details
        $output['shipping_details']       = $transaction->shipping_details;
        $output['delivered_to']           = $transaction->delivered_to;
        $output['shipping_details_label'] = trans('sale.shipping_details');
        $output['packing_charge_label']   = trans('lang_v1.packing_charge');
        $output['packing_charge']         = ($transaction->packing_charge != 0) ? $this->num_f($transaction->packing_charge, $show_currency, $business_details) : 0;

        //Total
        if ($transaction_type == 'sell_return') {
            $output['total_label'] = $invoice_layout->cn_amount_label . ':';
            $output['total']       = $this->num_f($transaction->final_total, $show_currency, $business_details);
        } else {
            $output['total_label'] = $invoice_layout->total_label . ':';
            $output['total']       = $this->num_f($transaction->final_total, $show_currency, $business_details);
        }
        if (!empty($il->common_settings['show_total_in_words'])) {
            $word_format              = isset($il->common_settings['num_to_word_format']) ? $il->common_settings['num_to_word_format'] : 'international';
            $output['total_in_words'] = $this->transactionUtil->numToWord($transaction->final_total, null, $word_format);
        }

        $output['total_unformatted'] = $transaction->final_total;

        //Paid & Amount due, only if final
        if ($transaction_type == 'sell' && $transaction->status == 'final') {
            $paid_amount = $this->transactionUtil->getTotalPaid($transaction->id);
            $due         = $transaction->final_total - $paid_amount;

            $output['total_paid']       = ($paid_amount == 0) ? 0 : $this->num_f($paid_amount, $show_currency, $business_details);
            $output['total_paid_label'] = $il->paid_label;
            $output['total_due']        = ($due == 0) ? 0 : $this->num_f($due, $show_currency, $business_details);
            $output['total_due_label']  = $il->total_due_label;

            if ($il->show_previous_bal == 1) {
                $all_due = $this->transactionUtil->getContactDue($transaction->contact_id);
                if (!empty($all_due)) {
                    $output['all_bal_label'] = $il->prev_bal_label;
                    $output['all_due']       = $this->num_f($all_due, $show_currency, $business_details);
                }
            }

            //Get payment details
            $output['payments'] = [];
            if ($il->show_payments == 1) {
                $payments      = $transaction->payment_lines->toArray();
                $payment_types = $this->transactionUtil->payment_types($transaction->location_id, true);
                if (!empty($payments)) {
                    foreach ($payments as $value) {
                        $method = !empty($payment_types[$value['method']]) ? $payment_types[$value['method']] : '';
                        if ($value['method'] == 'cash') {
                            $output['payments'][] =
                                [
                                    'method' => $method . ($value['is_return'] == 1 ? ' (' . $il->change_return_label . ')(-)' : ''),
                                    'amount' => $this->num_f($value['amount'], $show_currency, $business_details),
                                    'date'   => $this->transactionUtil->format_date($value['paid_on'], false, $business_details),
                                ];
                            if ($value['is_return'] == 1) {
                            }
                        } elseif ($value['method'] == 'card') {
                            $output['payments'][] =
                                [
                                    'method' => $method . (!empty($value['card_transaction_number']) ? (', Transaction Number:' . $value['card_transaction_number']) : ''),
                                    'amount' => $this->num_f($value['amount'], $show_currency, $business_details),
                                    'date'   => $this->transactionUtil->format_date($value['paid_on'], false, $business_details),
                                ];
                        } elseif ($value['method'] == 'cheque') {
                            $output['payments'][] =
                                [
                                    'method' => $method . (!empty($value['cheque_number']) ? (', Cheque Number:' . $value['cheque_number']) : ''),
                                    'amount' => $this->num_f($value['amount'], $show_currency, $business_details),
                                    'date'   => $this->transactionUtil->format_date($value['paid_on'], false, $business_details),
                                ];
                        } elseif ($value['method'] == 'bank_transfer') {
                            $output['payments'][] =
                                [
                                    'method' => $method . (!empty($value['bank_account_number']) ? (', Account Number:' . $value['bank_account_number']) : ''),
                                    'amount' => $this->num_f($value['amount'], $show_currency, $business_details),
                                    'date'   => $this->transactionUtil->format_date($value['paid_on'], false, $business_details),
                                ];
                        } elseif ($value['method'] == 'advance') {
                            $output['payments'][] =
                                [
                                    'method' => $method,
                                    'amount' => $this->num_f($value['amount'], $show_currency, $business_details),
                                    'date'   => $this->transactionUtil->format_date($value['paid_on'], false, $business_details),
                                ];
                        } elseif ($value['method'] == 'other') {
                            $output['payments'][] =
                                [
                                    'method' => $method,
                                    'amount' => $this->num_f($value['amount'], $show_currency, $business_details),
                                    'date'   => $this->transactionUtil->format_date($value['paid_on'], false, $business_details),
                                ];
                        }

                        for ($i = 1; $i < 8; $i++) {
                            if ($value['method'] == "custom_pay_{$i}") {
                                $output['payments'][] =
                                    [
                                        'method' => $method . (!empty($value['transaction_no']) ? (', ' . trans('lang_v1.transaction_no') . ':' . $value['transaction_no']) : ''),
                                        'amount' => $this->num_f($value['amount'], $show_currency, $business_details),
                                        'date'   => $this->transactionUtil->format_date($value['paid_on'], false, $business_details),
                                    ];
                            }
                        }
                    }
                }
            }
        }

        $output['additional_expenses'] = [];

        if (!empty($transaction->additional_expense_value_1) && !empty($transaction->additional_expense_key_1)) {
            $output['additional_expenses'][$transaction->additional_expense_key_1] = $this->num_f($transaction->additional_expense_value_1, $show_currency, $business_details);
        }
        if (!empty($transaction->additional_expense_value_2) && !empty($transaction->additional_expense_key_2)) {
            $output['additional_expenses'][$transaction->additional_expense_key_2] = $this->num_f($transaction->additional_expense_value_2, $show_currency, $business_details);
        }
        if (!empty($transaction->additional_expense_value_3) && !empty($transaction->additional_expense_key_3)) {
            $output['additional_expenses'][$transaction->additional_expense_key_3] = $this->num_f($transaction->additional_expense_value_3, $show_currency, $business_details);
        }
        if (!empty($transaction->additional_expense_value_4) && !empty($transaction->additional_expense_key_4)) {
            $output['additional_expenses'][$transaction->additional_expense_key_4] = $this->num_f($transaction->additional_expense_value_4, $show_currency, $business_details);
        }

        //Check for barcode
        $output['barcode'] = ($il->show_barcode == 1) ? $transaction->invoice_no : false;

        //Additional notes
        $output['additional_notes'] = $transaction->additional_notes;
        $output['footer_text']      = $invoice_layout->footer_text;

        //Barcode related information.
        $output['show_barcode'] = !empty($il->show_barcode) ? true : false;

        if (in_array($transaction_type, ['sell', 'sales_order'])) {
            //Qr code related information.
            $output['show_qr_code'] = !empty($il->show_qr_code) ? true : false;

            $zatca_qr = !empty($il->common_settings['zatca_qr']) ? true : false;

            if ($zatca_qr) {
                $total_order_tax = $transaction->tax_amount + $total_line_taxes;
                $qr_code_text    = $this->transactionUtil->_zatca_qr_text($business_details->name, $business_details->tax_number_1, $transaction->transaction_date, $transaction->final_total, $total_order_tax);
            } else {
                $is_label_enabled = !empty($il->common_settings['show_qr_code_label']) ? true : false;
                $qr_code_details  = [];
                $qr_code_fields   = !empty($il->qr_code_fields) ? $il->qr_code_fields : [];

                if (in_array('business_name', $qr_code_fields)) {
                    $qr_code_details[] = $is_label_enabled ? __('business.business') . ': ' . $business_details->name : $business_details->name;
                }
                if (in_array('address', $qr_code_fields)) {
                    $qr_code_details[] = $is_label_enabled ? __('business.address') . ': ' . $location_details->name . ', ' . $output['address'] : $location_details->name . ' ' . str_replace(',', '', $output['address']);
                }
                if (in_array('tax_1', $qr_code_fields)) {
                    $qr_code_details[] = $is_label_enabled ? $business_details->tax_label_1 . ': ' . $business_details->tax_number_1 : $business_details->tax_number_1;
                }
                if (in_array('tax_2', $qr_code_fields)) {
                    $qr_code_details[] = $is_label_enabled ? $business_details->tax_label_2 . ' ' . $business_details->tax_number_2 : $business_details->tax_number_2;
                }
                if (in_array('invoice_no', $qr_code_fields)) {
                    $qr_code_details[] = $is_label_enabled ? $il->invoice_no_prefix . ': ' . $transaction->invoice_no : $transaction->invoice_no;
                }
                if (in_array('invoice_datetime', $qr_code_fields)) {
                    $qr_code_details[] = $is_label_enabled ? $output['date_label'] . ': ' . $output['invoice_date'] : $output['invoice_date'];
                }
                if (in_array('subtotal', $qr_code_fields)) {
                    $qr_code_details[] = $is_label_enabled ? $output['subtotal_label'] . ' ' . $output['subtotal'] : $output['subtotal'];
                }
                if (in_array('total_amount', $qr_code_fields)) {
                    $qr_code_details[] = $is_label_enabled ? $output['total_label'] . ' ' . $output['total'] : $output['total'];
                }
                if (in_array('total_tax', $qr_code_fields)) {
                    $total_order_tax           = $transaction->tax_amount + $total_line_taxes;
                    $total_order_tax_formatted = $this->num_f($total_order_tax, $show_currency, $business_details);
                    $qr_code_details[]         = $is_label_enabled ? __('sale.tax') . ': ' . $total_order_tax_formatted : $total_order_tax_formatted;
                }
                if (in_array('customer_name', $qr_code_fields)) {
                    $cust_label        = $il->customer_label ?? __('contact.customer');
                    $qr_code_details[] = $is_label_enabled ? $cust_label . ': ' . $customer->full_name : $customer->full_name;
                }
                if (in_array('invoice_url', $qr_code_fields)) {
                    $qr_code_details[] = $this->transactionUtil->getInvoiceUrl($transaction->id, $business_details->id);
                }

                $output['qr_code_details'] = $qr_code_details;

                $qr_code_text = $is_label_enabled ? implode(', ', $qr_code_details) : implode(' ', $qr_code_details);
            }

            if ($transaction->status == 'final') {
                $output['qr_code_text'] = $qr_code_text;
            }
        }
        //Module related information.
        $il->module_info = !empty($il->module_info) ? json_decode($il->module_info, true) : [];
        if (!empty($il->module_info['tables']) && $this->transactionUtil->isModuleEnabled('tables')) {
            //Table label & info
            $output['table_label'] = null;
            $output['table']       = null;
            if (isset($il->module_info['tables']['show_table'])) {
                $output['table_label'] = !empty($il->module_info['tables']['table_label']) ? $il->module_info['tables']['table_label'] : '';
                if (!empty($transaction->res_table_id)) {
                    $table = ResTable::find($transaction->res_table_id);
                }

                //res_table_id
                $output['table'] = !empty($table->name) ? $table->name : '';
            }
        }

        if (!empty($il->module_info['types_of_service']) && $this->transactionUtil->isModuleEnabled('types_of_service') && !empty($transaction->types_of_service_id)) {
            //Table label & info
            $output['types_of_service_label'] = null;
            $output['types_of_service']       = null;
            if (isset($il->module_info['types_of_service']['show_types_of_service'])) {
                $output['types_of_service_label'] = !empty($il->module_info['types_of_service']['types_of_service_label']) ? $il->module_info['types_of_service']['types_of_service_label'] : '';
                $output['types_of_service']       = $transaction->types_of_service->name;
            }

            if (isset($il->module_info['types_of_service']['show_tos_custom_fields'])) {
                $types_of_service_custom_labels           = $this->transactionUtil->getCustomLabels($business_details, 'types_of_service');
                $output['types_of_service_custom_fields'] = [];
                if (!empty($transaction->service_custom_field_1)) {
                    $tos_custom_label_1                                            = $types_of_service_custom_labels['custom_field_1'] ?? __('lang_v1.service_custom_field_1');
                    $output['types_of_service_custom_fields'][$tos_custom_label_1] = $transaction->service_custom_field_1;
                }
                if (!empty($transaction->service_custom_field_2)) {
                    $tos_custom_label_2                                            = $types_of_service_custom_labels['custom_field_2'] ?? __('lang_v1.service_custom_field_2');
                    $output['types_of_service_custom_fields'][$tos_custom_label_2] = $transaction->service_custom_field_2;
                }
                if (!empty($transaction->service_custom_field_3)) {
                    $tos_custom_label_3                                            = $types_of_service_custom_labels['custom_field_3'] ?? __('lang_v1.service_custom_field_3');
                    $output['types_of_service_custom_fields'][$tos_custom_label_3] = $transaction->service_custom_field_3;
                }
                if (!empty($transaction->service_custom_field_4)) {
                    $tos_custom_label_4                                            = $types_of_service_custom_labels['custom_field_4'] ?? __('lang_v1.service_custom_field_4');
                    $output['types_of_service_custom_fields'][$tos_custom_label_4] = $transaction->service_custom_field_4;
                }

                if (!empty($transaction->service_custom_field_5)) {
                    $tos_custom_label_5                                            = $types_of_service_custom_labels['custom_field_5'] ?? __('lang_v1.service_custom_field_5');
                    $output['types_of_service_custom_fields'][$tos_custom_label_5] = $transaction->service_custom_field_5;
                }

                if (!empty($transaction->service_custom_field_6)) {
                    $tos_custom_label_6                                            = $types_of_service_custom_labels['custom_field_6'] ?? __('lang_v1.service_custom_field_6');
                    $output['types_of_service_custom_fields'][$tos_custom_label_6] = $transaction->service_custom_field_6;
                }
            }
        }

        if (!empty($il->module_info['service_staff']) && $this->transactionUtil->isModuleEnabled('service_staff')) {
            //Waiter label & info
            $output['service_staff_label'] = null;
            $output['service_staff']       = null;
            if (isset($il->module_info['service_staff']['show_service_staff'])) {
                $output['service_staff_label'] = !empty($il->module_info['service_staff']['service_staff_label']) ? $il->module_info['service_staff']['service_staff_label'] : '';
                if (!empty($transaction->res_waiter_id)) {
                    $waiter = \App\User::find($transaction->res_waiter_id);
                }

                //res_table_id
                $output['service_staff'] = !empty($waiter->id) ? implode(' ', [$waiter->first_name, $waiter->last_name]) : '';
            }
        }

        //Repair module details
        if (!empty($il->module_info['repair']) && $transaction->sub_type == 'repair') {
            if (!empty($il->module_info['repair']['show_repair_status'])) {
                $output['repair_status_label'] = $il->module_info['repair']['repair_status_label'];
                $output['repair_status']       = '';
                if (!empty($transaction->repair_status_id)) {
                    $repair_status           = \Modules\Repair\Entities\RepairStatus::find($transaction->repair_status_id);
                    $output['repair_status'] = $repair_status->name;
                }
            }

            if (!empty($il->module_info['repair']['show_repair_warranty'])) {
                $output['repair_warranty_label'] = $il->module_info['repair']['repair_warranty_label'];
                $output['repair_warranty']       = '';
                if (!empty($transaction->repair_warranty_id)) {
                    $repair_warranty           = \App\Warranty::find($transaction->repair_warranty_id);
                    $output['repair_warranty'] = $repair_warranty->name;
                }
            }

            if (!empty($il->module_info['repair']['show_serial_no'])) {
                $output['serial_no_label']  = $il->module_info['repair']['serial_no_label'];
                $output['repair_serial_no'] = $transaction->repair_serial_no;
            }

            if (!empty($il->module_info['repair']['show_defects'])) {
                $output['defects_label']  = $il->module_info['repair']['defects_label'];
                $output['repair_defects'] = $transaction->repair_defects;
            }

            if (!empty($il->module_info['repair']['show_model'])) {
                $output['model_no_label'] = $il->module_info['repair']['model_no_label'];

                $output['repair_model_no'] = '';

                if (!empty($transaction->repair_model_id)) {
                    $device_model = \Modules\Repair\Entities\DeviceModel::find($transaction->repair_model_id);

                    if (!empty($device_model)) {
                        $output['repair_model_no'] = $device_model->name;
                    }
                }
            }

            if (!empty($il->module_info['repair']['show_repair_checklist'])) {
                $output['repair_checklist_label']   = $il->module_info['repair']['repair_checklist_label'];
                $output['checked_repair_checklist'] = $transaction->repair_checklist;

                $checklists = [];
                if (!empty($transaction->repair_model_id)) {
                    $model = \Modules\Repair\Entities\DeviceModel::find($transaction->repair_model_id);

                    if (!empty($model) && !empty($model->repair_checklist)) {
                        $checklists = explode('|', $model->repair_checklist);
                    }
                }

                $output['repair_checklist'] = $checklists;
            }

            if (!empty($il->module_info['repair']['show_device'])) {
                $output['device_label'] = $il->module_info['repair']['device_label'];
                $device                 = \App\Category::find($transaction->repair_device_id);

                $output['repair_device'] = '';
                if (!empty($device)) {
                    $output['repair_device'] = $device->name;
                }
            }

            if (!empty($il->module_info['repair']['show_brand'])) {
                $output['brand_label']  = $il->module_info['repair']['brand_label'];
                $brand                  = \App\Brands::find($transaction->repair_brand_id);
                $output['repair_brand'] = '';
                if (!empty($brand)) {
                    $output['repair_brand'] = $brand->name;
                }
            }
        }

        //Custom fields
        $custom_labels = json_decode($business_details['custom_labels']);

        //shipping custom fields
        if (!empty($custom_labels->shipping->custom_field_1)) {
            $output['shipping_custom_field_1_label'] = $custom_labels->shipping->custom_field_1;
            $output['shipping_custom_field_1_value'] = $transaction['shipping_custom_field_1'];
        }

        if (!empty($custom_labels->shipping->custom_field_2)) {
            $output['shipping_custom_field_2_label'] = $custom_labels->shipping->custom_field_2;
            $output['shipping_custom_field_2_value'] = $transaction['shipping_custom_field_2'];
        }

        if (!empty($custom_labels->shipping->custom_field_3)) {
            $output['shipping_custom_field_3_label'] = $custom_labels->shipping->custom_field_3;
            $output['shipping_custom_field_3_value'] = $transaction['shipping_custom_field_3'];
        }

        if (!empty($custom_labels->shipping->custom_field_4)) {
            $output['shipping_custom_field_4_label'] = $custom_labels->shipping->custom_field_4;
            $output['shipping_custom_field_4_value'] = $transaction['shipping_custom_field_4'];
        }

        //Sell custom fields
        if (!empty($custom_labels->shipping->custom_field_5)) {
            $output['shipping_custom_field_5_label'] = $custom_labels->shipping->custom_field_5;
            $output['shipping_custom_field_5_value'] = $transaction['shipping_custom_field_5'];
        }

        if (!empty($custom_labels->sell->custom_field_1)) {
            $output['sell_custom_field_1_label'] = $custom_labels->sell->custom_field_1;
            $output['sell_custom_field_1_value'] = $transaction['custom_field_1'];
        }

        if (!empty($custom_labels->sell->custom_field_2)) {
            $output['sell_custom_field_2_label'] = $custom_labels->sell->custom_field_2;
            $output['sell_custom_field_2_value'] = $transaction['custom_field_2'];
        }

        if (!empty($custom_labels->sell->custom_field_3)) {
            $output['sell_custom_field_3_label'] = $custom_labels->sell->custom_field_3;
            $output['sell_custom_field_3_value'] = $transaction['custom_field_3'];
        }

        if (!empty($custom_labels->sell->custom_field_4)) {
            $output['sell_custom_field_4_label'] = $custom_labels->sell->custom_field_4;
            $output['sell_custom_field_4_value'] = $transaction['custom_field_4'];
        }

        // location custom fields
        if (in_array('custom_field1', $location_custom_field_settings) && !empty($location_details->custom_field1) && !empty($custom_labels->location->custom_field_1)) {
            $output['location_custom_field_1_label'] = $custom_labels->location->custom_field_1;
            $output['location_custom_field_1_value'] = $location_details->custom_field1;
        }

        if (in_array('custom_field2', $location_custom_field_settings) && !empty($location_details->custom_field2) && !empty($custom_labels->location->custom_field_2)) {
            $output['location_custom_field_2_label'] = $custom_labels->location->custom_field_2;
            $output['location_custom_field_2_value'] = $location_details->custom_field2;
        }

        if (in_array('custom_field3', $location_custom_field_settings) && !empty($location_details->custom_field3) && !empty($custom_labels->location->custom_field_3)) {
            $output['location_custom_field_3_label'] = $custom_labels->location->custom_field_3;
            $output['location_custom_field_3_value'] = $location_details->custom_field3;
        }

        if (in_array('custom_field4', $location_custom_field_settings) && !empty($location_details->custom_field4) && !empty($custom_labels->location->custom_field_4)) {
            $output['location_custom_field_4_label'] = $custom_labels->location->custom_field_4;
            $output['location_custom_field_4_value'] = $location_details->custom_field4;
        }

        //Used in pdfs
        if (!empty($transaction->sales_order_ids)) {
            $sale_orders = Transaction::where('type', 'sales_order')
                ->find($transaction->sales_order_ids);

            $output['sale_orders_invoice_no'] = implode(', ', $sale_orders->pluck('invoice_no')->toArray());
            $sale_orders_invoice_date         = [];
            foreach ($sale_orders as $sale_order) {
                if (blank($il->date_time_format)) {
                    $sale_orders_invoice_date[] = $this->transactionUtil->format_date($sale_order->transaction_date, true);
                } else {
                    $sale_orders_invoice_date[] = \Carbon::createFromFormat('Y-m-d H:i:s', $sale_order->transaction_date)->format($il->date_time_format);
                }
            }
            $output['sale_orders_invoice_date'] = implode(', ', $sale_orders_invoice_date);
        }

        if (!empty($transaction->prefer_payment_method)) {
            $payment_types                      = $this->transactionUtil->payment_types(null, true, $transaction->business_id);
            $output['preferred_payment_method'] = $payment_types[$transaction->prefer_payment_method];
        }

        if (!empty($transaction->prefer_payment_account)) {
            $output['preferred_account_details'] = $transaction->preferredAccount->account_details;
        }

        //export custom fields
        $output['is_export']       = $transaction->is_export;
        $export_custom_fields_info = $transaction->export_custom_fields_info;
        if (!empty($transaction->is_export)) {
            $output['export_custom_fields_info']['export_custom_field_1'] = $export_custom_fields_info['export_custom_field_1'] ?? '';
            $output['export_custom_fields_info']['export_custom_field_2'] = $export_custom_fields_info['export_custom_field_2'] ?? '';
            $output['export_custom_fields_info']['export_custom_field_3'] = $export_custom_fields_info['export_custom_field_3'] ?? '';
            $output['export_custom_fields_info']['export_custom_field_4'] = $export_custom_fields_info['export_custom_field_4'] ?? '';
            $output['export_custom_fields_info']['export_custom_field_5'] = $export_custom_fields_info['export_custom_field_5'] ?? '';
            $output['export_custom_fields_info']['export_custom_field_6'] = $export_custom_fields_info['export_custom_field_6'] ?? '';
        }

        $output['design']             = $il->design;
        $output['table_tax_headings'] = !empty($il->table_tax_headings) ? array_filter(json_decode($il->table_tax_headings), 'strlen') : null;

        return (object) $output;
    }

    public function num_f($input_number, $add_symbol = false, $business_details = null, $is_quantity = false)
    {
        $thousand_separator = !empty($business_details) ? $business_details->thousand_separator : session('currency')['thousand_separator'];
        $decimal_separator  = !empty($business_details) ? $business_details->decimal_separator : session('currency')['decimal_separator'];

        $currency_precision = !empty($business_details) ? $business_details->currency_precision : session('business.currency_precision', 2);

        if ($is_quantity) {
            $currency_precision = !empty($business_details) ? $business_details->quantity_precision : session('business.quantity_precision', 2);
        }

        $formatted = number_format($input_number, $currency_precision, $decimal_separator, $thousand_separator);

        if ($add_symbol) {
            $currency_symbol_placement = !empty($business_details) ? $business_details->currency_symbol_placement : session('business.currency_symbol_placement');
            $symbol                    = !empty($business_details) ? $business_details->currency_symbol : session('currency')['symbol'];

            if ($currency_symbol_placement == 'after') {
                $formatted = $formatted . ' ' . '$';
            } else {
                $formatted = '$' . ' ' . $formatted;
            }
        }

        return $formatted;
    }

    public function paymentSuccessful(Request $request)
    {
        $transaction_id = $request->transaction_id;
        $receipt        = Session::get('receipt');
        $invoice_token     = Transaction::where('id', $transaction_id)->pluck('invoice_token')->first();

        // return $receipt['html_content'];
        return view('frontend.cart.payment_successful', compact('receipt', 'invoice_token'));
    }
}
