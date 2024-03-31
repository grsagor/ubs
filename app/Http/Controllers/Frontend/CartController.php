<?php

namespace App\Http\Controllers\Frontend;

use App\BusinessLocation;
use App\Cart;
use App\Http\Controllers\Controller;
use App\Media;
use App\Product;
use App\ProductBuyingInfo;
use App\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Stripe\Charge;
use Stripe\Stripe;
use App\Utils\BusinessUtil;
use App\Utils\CashRegisterUtil;
use App\Utils\ContactUtil;
use App\Utils\ModuleUtil;
use App\Utils\NotificationUtil;
use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;

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
        $this->contactUtil = $contactUtil;
        $this->productUtil = $productUtil;
        $this->businessUtil = $businessUtil;
        $this->transactionUtil = $transactionUtil;
        $this->cashRegisterUtil = $cashRegisterUtil;
        $this->moduleUtil = $moduleUtil;
        $this->notificationUtil = $notificationUtil;

        $this->dummyPaymentLine = [
            'method' => 'cash',
            'amount' => 0,
            'note' => '',
            'card_transaction_number' => '',
            'card_number' => '',
            'card_type' => '',
            'card_holder_name' => '',
            'card_month' => '',
            'card_year' => '',
            'card_security' => '',
            'cheque_number' => '',
            'bank_account_number' => '',
            'is_return' => 0,
            'transaction_no' => '',
        ];
    }
    public function cart(Request $request)
    {
        $current_carts = Session::get('current_carts');
        $products = Product::whereIn('id', $current_carts)->get();
        $total_price = 0;
        foreach ($products as $product) {
            $price = 0;
            foreach ($product->variations as $variation) {
                $price += $variation->default_sell_price;
            }
            $product->price = $price;
            $total_price += $price;
        }
        $data = [
            'products' => $products,
            'total_price' => $total_price
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
        try {
            $user = Auth::user();
            $current_carts = Session::get('current_carts');
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
                'user' => $user,
                'products' => $products,
                'total_price' => $total_price,
                'product_ids' => implode(',', $product_ids)
            ];
            return view('frontend.cart.checkout', $data);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // public function checkoutPost(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
    //         $charge = Charge::create([
    //             'amount' => $request->amount * 100,
    //             'currency' => 'usd',
    //             'source' => $request->stripeToken,
    //             'description' => 'Payment for your purchase',
    //         ]);

    //         $transaction_history = new TransactionHistory();
    //         $transaction_history->user_id = Auth::user()->id;
    //         $transaction_history->transaction_id = $charge->id;
    //         $transaction_history->amount = $request->amount;
    //         $transaction_history->save();

    //         $product_ids = explode(',', $request->product_ids);

    //         foreach ($product_ids as $product_id) {
    //             $product = Product::with('variations')->find($product_id);
    //             $price = 0;
    //             foreach ($product->variations as $variation) {
    //                 $price += $variation->default_sell_price;
    //             }

    //             $info = new ProductBuyingInfo();
    //             $info->user_id = Auth::user()->id;
    //             $info->product_id = $product_id;
    //             $info->transaction_id = $transaction_history->id;
    //             $info->amount = $price;
    //             $info->personal_name = $request->personal_name;
    //             $info->personal_email = $request->personal_email;
    //             $info->pass_check = $request->pass_check;
    //             $info->personal_pass = $request->personal_pass;
    //             $info->personal_confirm = $request->personal_confirm;
    //             $info->shipping = $request->shipping;
    //             $info->pickup_location = $request->pickup_location;
    //             $info->customer_name = $request->customer_name;
    //             $info->customer_email = $request->customer_email;
    //             $info->customer_phone = $request->customer_phone;
    //             $info->customer_address = $request->customer_address;
    //             $info->customer_city = $request->customer_city;
    //             $info->customer_zip = $request->customer_zip;
    //             $info->select_country = $request->select_country;
    //             $info->customer_state = $request->customer_state;
    //             $info->shipping_name = $request->shipping_name;
    //             $info->shipping_phone = $request->shipping_phone;
    //             $info->shipping_address = $request->shipping_address;
    //             $info->shipping_zip = $request->shipping_zip;
    //             $info->shipping_city = $request->shipping_city;
    //             $info->shipping_state = $request->shipping_state;
    //             $info->shipping_country = $request->shipping_country;
    //             $info->order_notes = $request->order_notes;
    //             $info->payment_method = $request->payment_method;
    //             $info->save();  

    //             $cart = Cart::where([['user_id', Auth::user()->id], ['product_id', $product_id]])->first();
    //             if($cart) {
    //                 $cart->delete();
    //             }
    //         }

    //         DB::commit();

    //         return redirect(route('homePage'))->with('success', 'Successful.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('error', $e->getMessage());
    //     }
    // }
    public function checkoutPost(Request $request)
    {
        // if (! auth()->user()->can('sell.create') && ! auth()->user()->can('direct_sell.access') && ! auth()->user()->can('so.create')) {
        //     abort(403, 'Unauthorized action.');
        // }

        $is_direct_sale = false;
        if (!empty($request->input('is_direct_sale'))) {
            $is_direct_sale = true;
        }

        //Check if there is a open register, if no then redirect to Create Register screen.
        if (!$is_direct_sale && $this->cashRegisterUtil->countOpenedRegister() == 0) {
            return redirect()->action([\App\Http\Controllers\CashRegisterController::class, 'create']);
        }

        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $charge = Charge::create([
                'amount' => $request->amount * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for your purchase',
            ]);

            $input = $request->except('_token');

            $input['is_quotation'] = 0;
            //status is send as quotation from Add sales screen.
            if ($input['status'] == 'quotation') {
                $input['status'] = 'draft';
                $input['is_quotation'] = 1;
                $input['sub_status'] = 'quotation';
            } elseif ($input['status'] == 'proforma') {
                $input['status'] = 'draft';
                $input['sub_status'] = 'proforma';
            }

            //Add change return
            $change_return = $this->dummyPaymentLine;
            if (!empty($input['payment']['change_return'])) {
                $change_return = $input['payment']['change_return'];
                unset($input['payment']['change_return']);
            }

            //Check Customer credit limit
            $is_credit_limit_exeeded = $this->transactionUtil->isCustomerCreditLimitExeeded($input);

            if ($is_credit_limit_exeeded !== false) {
                $credit_limit_amount = $this->transactionUtil->num_f($is_credit_limit_exeeded, true);
                $output = [
                    'success' => 0,
                    'msg' => __('lang_v1.cutomer_credit_limit_exeeded', ['credit_limit' => $credit_limit_amount]),
                ];
                if (!$is_direct_sale) {
                    return $output;
                } else {
                    return redirect()
                        ->action([\App\Http\Controllers\SellController::class, 'index'])
                        ->with('status', $output);
                }
            }

            // if (! empty($input['products'])) {
            $business_id = $request->session()->get('user.business_id');

            //Check if subscribed or not, then check for users quota
            if (!$this->moduleUtil->isSubscribed($business_id)) {
                return $this->moduleUtil->expiredResponse();
            } elseif (!$this->moduleUtil->isQuotaAvailable('invoices', $business_id)) {
                return $this->moduleUtil->quotaExpiredResponse('invoices', $business_id, action([\App\Http\Controllers\SellPosController::class, 'index']));
            }

            $user_id = $request->session()->get('user.id');

            $discount = [
                'discount_type' => $input['discount_type'],
                'discount_amount' => $input['discount_amount'],
            ];
            $invoice_total = $this->productUtil->calculateInvoiceTotal($input['products'], $input['tax_rate_id'], $discount);

            DB::beginTransaction();

            if (empty($request->input('transaction_date'))) {
                $input['transaction_date'] = \Carbon::now();
            } else {
                $input['transaction_date'] = $this->productUtil->uf_date($request->input('transaction_date'), true);
            }
            if ($is_direct_sale) {
                $input['is_direct_sale'] = 1;
            }

            //Set commission agent
            $input['commission_agent'] = !empty($request->input('commission_agent')) ? $request->input('commission_agent') : null;
            $commsn_agnt_setting = $request->session()->get('business.sales_cmsn_agnt');
            if ($commsn_agnt_setting == 'logged_in_user') {
                $input['commission_agent'] = $user_id;
            }

            if (isset($input['exchange_rate']) && $this->transactionUtil->num_uf($input['exchange_rate']) == 0) {
                $input['exchange_rate'] = 1;
            }

            //Customer group details
            $contact_id = $request->get('contact_id', null);
            $cg = $this->contactUtil->getCustomerGroup($business_id, $contact_id);
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
                $ref_count = $this->transactionUtil->setAndGetReferenceCount('subscription');
                $input['subscription_no'] = $this->transactionUtil->generateReferenceNumber('subscription', $ref_count);
            }

            if (!empty($request->input('invoice_scheme_id'))) {
                $input['invoice_scheme_id'] = $request->input('invoice_scheme_id');
            }

            //Types of service
            if ($this->moduleUtil->isModuleEnabled('types_of_service')) {
                $input['types_of_service_id'] = $request->input('types_of_service_id');
                $price_group_id = !empty($request->input('types_of_service_price_group')) ? $request->input('types_of_service_price_group') : $price_group_id;
                $input['packing_charge'] = !empty($request->input('packing_charge')) ?
                    $this->transactionUtil->num_uf($request->input('packing_charge')) : 0;
                $input['packing_charge_type'] = $request->input('packing_charge_type');
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
                $input['additional_expense_key_1'] = $request->input('additional_expense_key_1');
                $input['additional_expense_value_1'] = $request->input('additional_expense_value_1');
            }

            if ($request->input('additional_expense_value_2') != '') {
                $input['additional_expense_key_2'] = $request->input('additional_expense_key_2');
                $input['additional_expense_value_2'] = $request->input('additional_expense_value_2');
            }

            if ($request->input('additional_expense_value_3') != '') {
                $input['additional_expense_key_3'] = $request->input('additional_expense_key_3');
                $input['additional_expense_value_3'] = $request->input('additional_expense_value_3');
            }

            if ($request->input('additional_expense_value_4') != '') {
                $input['additional_expense_key_4'] = $request->input('additional_expense_key_4');
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

            $transaction = $this->transactionUtil->createSellTransaction($business_id, $input, $invoice_total, $user_id);

            //Upload Shipping documents
            Media::uploadMedia($business_id, $transaction, $request, 'shipping_documents', false, 'shipping_document');

            $this->transactionUtil->createOrUpdateSellLines($transaction, $input['products'], $input['location_id']);

            $change_return['amount'] = $input['change_return'] ?? 0;
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

                                $base_time = \Carbon::parse($transaction->transaction_date);

                                //if already assigned set base time as available_at
                                if (!empty($service_staff->available_at) && \Carbon::parse($service_staff->available_at)->gt(\Carbon::now())) {
                                    $base_time = \Carbon::parse($service_staff->available_at);
                                }

                                $total_minutes = $product->preparation_time_in_minutes * $this->transactionUtil->num_uf($product_line['quantity']);

                                $service_staff->available_at = $base_time->addMinutes($total_minutes);
                                $service_staff->save();
                            }
                        }
                    }
                }
                //update product stock
                foreach ($input['products'] as $product) {
                    $decrease_qty = $this->productUtil
                        ->num_uf($product['quantity']);
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
                $payment_status = $this->transactionUtil->updatePaymentStatus($transaction->id, $transaction->final_total);

                $transaction->payment_status = $payment_status;

                if ($request->session()->get('business.enable_rp') == 1) {
                    $redeemed = !empty($input['rp_redeemed']) ? $input['rp_redeemed'] : 0;
                    $this->transactionUtil->updateCustomerRewardPoints($contact_id, $transaction->rp_earned, 0, $redeemed);
                }

                //Allocate the quantity from purchase and add mapping of
                //purchase & sell lines in
                //transaction_sell_lines_purchase_lines table
                $business_details = $this->businessUtil->getDetails($business_id);
                $pos_settings = empty($business_details->pos_settings) ? $this->businessUtil->defaultPosSettings() : json_decode($business_details->pos_settings, true);

                $business = [
                    'id' => $business_id,
                    'accounting_method' => $request->session()->get('business.accounting_method'),
                    'location_id' => $input['location_id'],
                    'pos_settings' => $pos_settings,
                ];
                $this->transactionUtil->mapPurchaseSell($business, $transaction->sell_lines, 'purchase');

                //Auto send notification
                $whatsapp_link = $this->notificationUtil->autoSendNotification($business_id, 'new_sale', $transaction, $transaction->contact);
            }

            if (!empty($transaction->sales_order_ids)) {
                $this->transactionUtil->updateSalesOrderStatus($transaction->sales_order_ids);
            }

            $this->moduleUtil->getModuleData('after_sale_saved', ['transaction' => $transaction, 'input' => $input]);

            Media::uploadMedia($business_id, $transaction, $request, 'documents');

            $this->transactionUtil->activityLog($transaction, 'added');

            DB::commit();

            if ($request->input('is_save_and_print') == 1) {
                $url = $this->transactionUtil->getInvoiceUrl($transaction->id, $business_id);

                return redirect()->to($url . '?print_on_load=true');
            }

            $msg = trans('sale.pos_sale_added');
            $receipt = '';
            // $invoice_layout_id = $request->input('invoice_layout_id');
            $invoice_layout_id = 3;
            $print_invoice = false;
            if (!$is_direct_sale) {
                if ($input['status'] == 'draft') {
                    $msg = trans('sale.draft_added');

                    if ($input['is_quotation'] == 1) {
                        $msg = trans('lang_v1.quotation_added');
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
            $receipt = $this->receiptContent($business_id, $input['location_id'], $transaction->id, null, false, true, $invoice_layout_id);

            $output = ['success' => 1, 'msg' => $msg, 'receipt' => $receipt];

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
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            $msg = 'File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage();

            if (get_class($e) == \App\Exceptions\PurchaseSellMismatch::class) {
                $msg = $e->getMessage();
            }
            if (get_class($e) == \App\Exceptions\AdvanceBalanceNotAvailable::class) {
                $msg = $e->getMessage();
            }

            $output = [
                'success' => 0,
                'msg' => $msg,
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
    private function receiptContent(
        $business_id,
        $location_id,
        $transaction_id,
        $printer_type = null,
        $is_package_slip = false,
        $from_pos_screen = true,
        $invoice_layout_id = null,
        $is_delivery_note = false
    ) {
        $output = [
            'is_enabled' => false,
            'print_type' => 'browser',
            'html_content' => null,
            'printer_config' => [],
            'data' => [],
        ];

        $business_details = $this->businessUtil->getDetails($business_id);
        $location_details = BusinessLocation::find($location_id);

        if ($from_pos_screen && $location_details->print_receipt_on_invoice != 1) {
            return $output;
        }
        //Check if printing of invoice is enabled or not.
        //If enabled, get print type.
        $output['is_enabled'] = true;

        $invoice_layout_id = !empty($invoice_layout_id) ? $invoice_layout_id : $location_details->invoice_layout_id;
        $invoice_layout = $this->businessUtil->invoiceLayout($business_id, $invoice_layout_id);

        //Check if printer setting is provided.
        $receipt_printer_type = is_null($printer_type) ? $location_details->receipt_printer_type : $printer_type;

        $receipt_details = $this->transactionUtil->getReceiptDetails($transaction_id, $location_id, $invoice_layout, $business_details, $location_details, $receipt_printer_type);

        $currency_details = [
            'symbol' => $business_details->currency_symbol,
            'thousand_separator' => $business_details->thousand_separator,
            'decimal_separator' => $business_details->decimal_separator,
        ];
        $receipt_details->currency = $currency_details;

        // if ($is_package_slip) {
        $output['html_content'] = view('sale_pos.receipts.packing_slip', compact('receipt_details'))->render();

        return $output;
        // }

        if ($is_delivery_note) {
            $output['html_content'] = view('sale_pos.receipts.delivery_note', compact('receipt_details'))->render();

            return $output;
        }

        $output['print_title'] = $receipt_details->invoice_no;
        //If print type browser - return the content, printer - return printer config data, and invoice format config
        if ($receipt_printer_type == 'printer') {
            $output['print_type'] = 'printer';
            $output['printer_config'] = $this->businessUtil->printerConfig($business_id, $location_details->printer_id);
            $output['data'] = $receipt_details;
        } else {
            $layout = !empty($receipt_details->design) ? 'sale_pos.receipts.' . $receipt_details->design : 'sale_pos.receipts.classic';

            $output['html_content'] = view($layout, compact('receipt_details'))->render();
        }

        return $output;
    }

    public function orderNow(Request $request)
    {
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
