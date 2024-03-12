<?php

namespace App\Utils;

use App\AccountTransaction;
use App\Business;
use App\BusinessLocation;
use App\CashDenomination;
use App\Contact;
use App\Currency;
use App\Events\TransactionPaymentAdded;
use App\Events\TransactionPaymentDeleted;
use App\Events\TransactionPaymentUpdated;
use App\Exceptions\AdvanceBalanceNotAvailable;
use App\Exceptions\PurchaseSellMismatch;
use App\InvoiceScheme;
use App\Product;
use App\PurchaseLine;
use App\Restaurant\ResTable;
use App\TaxRate;
use App\Transaction;
use App\TransactionPayment;
use App\TransactionSellLine;
use App\TransactionSellLinesPurchaseLines;
use App\Variation;
use App\VariationLocationDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionUtil extends Util
{
    /**
     * Add Sell transaction
     *
     * @param  int  $business_id
     * @param  array  $input
     * @param  float  $invoice_total
     * @param  int  $user_id
     * @return object
     */
    public function createSellTransaction($business_id, $input, $invoice_total, $user_id, $uf_data = true)
    {
        $sale_type = ! empty($input['type']) ? $input['type'] : 'sell';
        $invoice_scheme_id = ! empty($input['invoice_scheme_id']) ? $input['invoice_scheme_id'] : null;
        $invoice_no = ! empty($input['invoice_no']) ? $input['invoice_no'] : $this->getInvoiceNumber($business_id, $input['status'], $input['location_id'], $invoice_scheme_id, $sale_type);

        $final_total = $uf_data ? $this->num_uf($input['final_total']) : $input['final_total'];

        $pay_term_number = isset($input['pay_term_number']) ? $input['pay_term_number'] : null;
        $pay_term_type = isset($input['pay_term_type']) ? $input['pay_term_type'] : null;

        //if pay term empty set contact pay term
        if (empty($pay_term_number) || empty($pay_term_type)) {
            $contact = Contact::find($input['contact_id']);
            $pay_term_number = $contact->pay_term_number;
            $pay_term_type = $contact->pay_term_type;
        }
        $transaction = Transaction::create([
            'business_id' => $business_id,
            'location_id' => $input['location_id'],
            'type' => $sale_type,
            'status' => $input['status'],
            'sub_status' => ! empty($input['sub_status']) ? $input['sub_status'] : null,
            'contact_id' => $input['contact_id'],
            'customer_group_id' => ! empty($input['customer_group_id']) ? $input['customer_group_id'] : null,
            'invoice_no' => $invoice_no,
            'ref_no' => '',
            'source' => ! empty($input['source']) ? $input['source'] : null,
            'total_before_tax' => $invoice_total['total_before_tax'],
            'transaction_date' => $input['transaction_date'],
            'tax_id' => ! empty($input['tax_rate_id']) ? $input['tax_rate_id'] : null,
            'discount_type' => ! empty($input['discount_type']) ? $input['discount_type'] : null,
            'discount_amount' => $uf_data ? $this->num_uf($input['discount_amount']) : $input['discount_amount'],
            'tax_amount' => $invoice_total['tax'],
            'final_total' => $final_total,
            'additional_notes' => ! empty($input['sale_note']) ? $input['sale_note'] : null,
            'staff_note' => ! empty($input['staff_note']) ? $input['staff_note'] : null,
            'created_by' => $user_id,
            'document' => ! empty($input['document']) ? $input['document'] : null,
            'custom_field_1' => ! empty($input['custom_field_1']) ? $input['custom_field_1'] : null,
            'custom_field_2' => ! empty($input['custom_field_2']) ? $input['custom_field_2'] : null,
            'custom_field_3' => ! empty($input['custom_field_3']) ? $input['custom_field_3'] : null,
            'custom_field_4' => ! empty($input['custom_field_4']) ? $input['custom_field_4'] : null,
            'is_direct_sale' => ! empty($input['is_direct_sale']) ? $input['is_direct_sale'] : 0,
            'commission_agent' => $input['commission_agent'] ?? null,
            'is_quotation' => isset($input['is_quotation']) ? $input['is_quotation'] : 0,
            'shipping_details' => isset($input['shipping_details']) ? $input['shipping_details'] : null,
            'shipping_address' => isset($input['shipping_address']) ? $input['shipping_address'] : null,
            'shipping_status' => isset($input['shipping_status']) ? $input['shipping_status'] : null,
            'delivered_to' => isset($input['delivered_to']) ? $input['delivered_to'] : null,
            'shipping_charges' => isset($input['shipping_charges']) ? $uf_data ? $this->num_uf($input['shipping_charges']) : $input['shipping_charges'] : 0,
            'shipping_custom_field_1' => ! empty($input['shipping_custom_field_1']) ? $input['shipping_custom_field_1'] : null,
            'shipping_custom_field_2' => ! empty($input['shipping_custom_field_2']) ? $input['shipping_custom_field_2'] : null,
            'shipping_custom_field_3' => ! empty($input['shipping_custom_field_3']) ? $input['shipping_custom_field_3'] : null,
            'shipping_custom_field_4' => ! empty($input['shipping_custom_field_4']) ? $input['shipping_custom_field_4'] : null,
            'shipping_custom_field_5' => ! empty($input['shipping_custom_field_5']) ? $input['shipping_custom_field_5'] : null,
            'exchange_rate' => ! empty($input['exchange_rate']) ?
                                $uf_data ? $this->num_uf($input['exchange_rate']) : $input['exchange_rate'] : 1,
            'selling_price_group_id' => isset($input['selling_price_group_id']) ? $input['selling_price_group_id'] : null,
            'pay_term_number' => $pay_term_number,
            'pay_term_type' => $pay_term_type,
            'is_suspend' => ! empty($input['is_suspend']) ? 1 : 0,
            'is_recurring' => ! empty($input['is_recurring']) ? $input['is_recurring'] : 0,
            'recur_interval' => ! empty($input['recur_interval']) ? $input['recur_interval'] : 1,
            'recur_interval_type' => ! empty($input['recur_interval_type']) ? $input['recur_interval_type'] : null,
            'subscription_repeat_on' => ! empty($input['subscription_repeat_on']) ? $input['subscription_repeat_on'] : null,
            'subscription_no' => ! empty($input['subscription_no']) ? $input['subscription_no'] : null,
            'recur_repetitions' => ! empty($input['recur_repetitions']) ? $input['recur_repetitions'] : 0,
            'order_addresses' => ! empty($input['order_addresses']) ? $input['order_addresses'] : null,
            'sub_type' => ! empty($input['sub_type']) ? $input['sub_type'] : null,
            'rp_earned' => $input['status'] == 'final' ? $this->calculateRewardPoints($business_id, $final_total) : 0,
            'rp_redeemed' => ! empty($input['rp_redeemed']) ? $input['rp_redeemed'] : 0,
            'rp_redeemed_amount' => ! empty($input['rp_redeemed_amount']) ? $input['rp_redeemed_amount'] : 0,
            'is_created_from_api' => ! empty($input['is_created_from_api']) ? 1 : 0,
            'types_of_service_id' => ! empty($input['types_of_service_id']) ? $input['types_of_service_id'] : null,
            'packing_charge' => ! empty($input['packing_charge']) ? $input['packing_charge'] : 0,
            'packing_charge_type' => ! empty($input['packing_charge_type']) ? $input['packing_charge_type'] : null,
            'service_custom_field_1' => ! empty($input['service_custom_field_1']) ? $input['service_custom_field_1'] : null,
            'service_custom_field_2' => ! empty($input['service_custom_field_2']) ? $input['service_custom_field_2'] : null,
            'service_custom_field_3' => ! empty($input['service_custom_field_3']) ? $input['service_custom_field_3'] : null,
            'service_custom_field_4' => ! empty($input['service_custom_field_4']) ? $input['service_custom_field_4'] : null,
            'service_custom_field_5' => ! empty($input['service_custom_field_5']) ? $input['service_custom_field_5'] : null,
            'service_custom_field_6' => ! empty($input['service_custom_field_6']) ? $input['service_custom_field_6'] : null,
            'round_off_amount' => ! empty($input['round_off_amount']) ? $input['round_off_amount'] : 0,
            'import_batch' => ! empty($input['import_batch']) ? $input['import_batch'] : null,
            'import_time' => ! empty($input['import_time']) ? $input['import_time'] : null,
            'res_table_id' => ! empty($input['res_table_id']) ? $input['res_table_id'] : null,
            'res_waiter_id' => ! empty($input['res_waiter_id']) ? $input['res_waiter_id'] : null,
            'sales_order_ids' => ! empty($input['sales_order_ids']) ? $input['sales_order_ids'] : null,
            'prefer_payment_method' => ! empty($input['prefer_payment_method']) ? $input['prefer_payment_method'] : null,
            'prefer_payment_account' => ! empty($input['prefer_payment_account']) ? $input['prefer_payment_account'] : null,
            'is_export' => ! empty($input['is_export']) ? 1 : 0,
            'export_custom_fields_info' => (! empty($input['is_export']) && ! empty($input['export_custom_fields_info'])) ? $input['export_custom_fields_info'] : null,
            'additional_expense_value_1' => isset($input['additional_expense_value_1']) ? $uf_data ? $this->num_uf($input['additional_expense_value_1']) : $input['additional_expense_value_1'] : 0,
            'additional_expense_value_2' => isset($input['additional_expense_value_2']) ? $uf_data ? $this->num_uf($input['additional_expense_value_2']) : $input['additional_expense_value_2'] : 0,
            'additional_expense_value_3' => isset($input['additional_expense_value_3']) ? $uf_data ? $this->num_uf($input['additional_expense_value_3']) : $input['additional_expense_value_3'] : 0,
            'additional_expense_value_4' => isset($input['additional_expense_value_4']) ? $uf_data ? $this->num_uf($input['additional_expense_value_4']) : $input['additional_expense_value_4'] : 0,
            'additional_expense_key_1' => ! empty($input['additional_expense_key_1']) ? $input['additional_expense_key_1'] : null,
            'additional_expense_key_2' => ! empty($input['additional_expense_key_2']) ? $input['additional_expense_key_2'] : null,
            'additional_expense_key_3' => ! empty($input['additional_expense_key_3']) ? $input['additional_expense_key_3'] : null,
            'additional_expense_key_4' => ! empty($input['additional_expense_key_4']) ? $input['additional_expense_key_4'] : null,

        ]);

        return $transaction;
    }

    /**
     * Add/Edit transaction sell lines
     *
     * @param object/int $transaction
     * @param  array  $products
     * @param  array  $location_id
     * @param  bool  $return_deleted = false
     * @param  array  $extra_line_parameters = []
     *   Example: ['database_trasnaction_linekey' => 'products_line_key'];
     * @return boolean/object
     */
    public function createOrUpdateSellLines($transaction, $products, $location_id, $return_deleted = false, $status_before = null, $extra_line_parameters = [], $uf_data = true)
    {
        $lines_formatted = [];
        $modifiers_array = [];
        $edit_ids = [0];
        $modifiers_formatted = [];
        $combo_lines = [];
        $products_modified_combo = [];
        foreach ($products as $product) {
            $multiplier = 1;
            if (isset($product['sub_unit_id']) && $product['sub_unit_id'] == $product['product_unit_id']) {
                unset($product['sub_unit_id']);
            }

            if (! empty($product['sub_unit_id']) && ! empty($product['base_unit_multiplier'])) {
                $multiplier = $product['base_unit_multiplier'];
            }

            //Check if transaction_sell_lines_id is set, used when editing.
            if (! empty($product['transaction_sell_lines_id'])) {
                $edit_id_temp = $this->editSellLine($product, $location_id, $status_before, $multiplier, $uf_data);
                $edit_ids = array_merge($edit_ids, $edit_id_temp);

                //update or create modifiers for existing sell lines
                if ($this->isModuleEnabled('modifiers')) {
                    if (! empty($product['modifier'])) {
                        foreach ($product['modifier'] as $key => $value) {
                            if (! empty($product['modifier_sell_line_id'][$key])) {
                                $edit_modifier = TransactionSellLine::find($product['modifier_sell_line_id'][$key]);
                                $edit_modifier->quantity = isset($product['modifier_quantity'][$key]) ? $product['modifier_quantity'][$key] : 1;
                                $modifiers_formatted[] = $edit_modifier;
                                //Dont delete modifier sell line if exists
                                $edit_ids[] = $product['modifier_sell_line_id'][$key];
                            } else {
                                if (! empty($product['modifier_price'][$key])) {
                                    $this_price = $uf_data ? $this->num_uf($product['modifier_price'][$key]) : $product['modifier_price'][$key];
                                    $modifier_quantity = isset($product['modifier_quantity'][$key]) ? $product['modifier_quantity'][$key] : 1;
                                    $modifiers_formatted[] = new TransactionSellLine([
                                        'product_id' => $product['modifier_set_id'][$key],
                                        'variation_id' => $value,
                                        'quantity' => $modifier_quantity,
                                        'unit_price_before_discount' => $this_price,
                                        'unit_price' => $this_price,
                                        'unit_price_inc_tax' => $this_price,
                                        'parent_sell_line_id' => $product['transaction_sell_lines_id'],
                                        'children_type' => 'modifier',
                                    ]);
                                }
                            }
                        }
                    }
                }
            } else {
                $products_modified_combo[] = $product;

                //calculate unit price and unit price before discount
                $uf_unit_price = $uf_data ? $this->num_uf($product['unit_price']) : $product['unit_price'];
                $unit_price_before_discount = $uf_unit_price / $multiplier;
                $unit_price = $unit_price_before_discount;
                if (! empty($product['line_discount_type']) && $product['line_discount_amount']) {
                    $discount_amount = $uf_data ? $this->num_uf($product['line_discount_amount']) : $product['line_discount_amount'];
                    if ($product['line_discount_type'] == 'fixed') {

                        //Note: Consider multiplier for fixed discount amount
                        $unit_price = $unit_price_before_discount - ($discount_amount / $multiplier);
                    } elseif ($product['line_discount_type'] == 'percentage') {
                        $unit_price = ((100 - $discount_amount) * $unit_price_before_discount) / 100;
                    }
                }
                $uf_quantity = $uf_data ? $this->num_uf($product['quantity']) : $product['quantity'];
                $uf_item_tax = $uf_data ? $this->num_uf($product['item_tax']) : $product['item_tax'];
                $uf_unit_price_inc_tax = $uf_data ? $this->num_uf($product['unit_price_inc_tax']) : $product['unit_price_inc_tax'];

                $line_discount_amount = 0;
                if (! empty($product['line_discount_amount'])) {
                    $line_discount_amount = $uf_data ? $this->num_uf($product['line_discount_amount']) : $product['line_discount_amount'];

                    if ($product['line_discount_type'] == 'fixed') {
                        $line_discount_amount = $line_discount_amount / $multiplier;
                    }
                }

                $line = [
                    'product_id' => $product['product_id'],
                    'variation_id' => $product['variation_id'],
                    'quantity' => $uf_quantity * $multiplier,
                    'unit_price_before_discount' => $unit_price_before_discount,
                    'unit_price' => $unit_price,
                    'line_discount_type' => ! empty($product['line_discount_type']) ? $product['line_discount_type'] : null,
                    'line_discount_amount' => $line_discount_amount,
                    'item_tax' => $uf_item_tax / $multiplier,
                    'tax_id' => $product['tax_id'],
                    'unit_price_inc_tax' => $uf_unit_price_inc_tax / $multiplier,
                    'sell_line_note' => ! empty($product['sell_line_note']) ? $product['sell_line_note'] : '',
                    'sub_unit_id' => ! empty($product['sub_unit_id']) ? $product['sub_unit_id'] : null,
                    'discount_id' => ! empty($product['discount_id']) ? $product['discount_id'] : null,
                    'res_service_staff_id' => ! empty($product['res_service_staff_id']) ? $product['res_service_staff_id'] : null,
                    'res_line_order_status' => ! empty($product['res_service_staff_id']) ? 'received' : null,
                    'so_line_id' => ! empty($product['so_line_id']) ? $product['so_line_id'] : null,
                    'secondary_unit_quantity' => ! empty($product['secondary_unit_quantity']) ? $this->num_uf($product['secondary_unit_quantity']) : 0,
                ];

                foreach ($extra_line_parameters as $key => $value) {
                    $line[$key] = isset($product[$value]) ? $product[$value] : '';
                }

                if (! empty($product['lot_no_line_id'])) {
                    $line['lot_no_line_id'] = $product['lot_no_line_id'];
                }

                //Check if restaurant module is enabled then add more data related to that.
                if ($this->isModuleEnabled('modifiers')) {
                    $sell_line_modifiers = [];

                    if (! empty($product['modifier'])) {
                        foreach ($product['modifier'] as $key => $value) {
                            if (! empty($product['modifier_price'][$key])) {
                                $this_price = $uf_data ? $this->num_uf($product['modifier_price'][$key]) : $product['modifier_price'][$key];
                                $modifier_quantity = isset($product['modifier_quantity'][$key]) ? $product['modifier_quantity'][$key] : 1;
                                $sell_line_modifiers[] = [
                                    'product_id' => $product['modifier_set_id'][$key],
                                    'variation_id' => $value,
                                    'quantity' => $modifier_quantity,
                                    'unit_price_before_discount' => $this_price,
                                    'unit_price' => $this_price,
                                    'unit_price_inc_tax' => $this_price,
                                    'children_type' => 'modifier',
                                ];
                            }
                        }
                    }
                    $modifiers_array[] = $sell_line_modifiers;
                }

                $lines_formatted[] = new TransactionSellLine($line);

                $sell_line_warranties[] = ! empty($product['warranty_id']) ? $product['warranty_id'] : 0;

                //Update purchase order line quantity received
                $this->updateSalesOrderLine($line['so_line_id'], $line['quantity'], 0);
            }
        }

        if (! is_object($transaction)) {
            $transaction = Transaction::findOrFail($transaction);
        }

        //Delete the products removed and increment product stock.
        $deleted_lines = [];
        if (! empty($edit_ids)) {
            $deleted_lines = TransactionSellLine::where('transaction_id', $transaction->id)
                    ->whereNotIn('id', $edit_ids)
                    ->select('id')->get()->toArray();
            $combo_delete_lines = TransactionSellLine::whereIn('parent_sell_line_id', $deleted_lines)->where('children_type', 'combo')->select('id')->get()->toArray();
            $deleted_lines = array_merge($deleted_lines, $combo_delete_lines);

            $adjust_qty = $status_before == 'draft' ? false : true;

            $this->deleteSellLines($deleted_lines, $location_id, $adjust_qty);
        }

        $combo_lines = [];

        if (! empty($lines_formatted)) {
            $transaction->sell_lines()->saveMany($lines_formatted);

            //Add corresponding modifier sell lines if exists
            if ($this->isModuleEnabled('modifiers')) {
                foreach ($lines_formatted as $key => $value) {
                    if (! empty($modifiers_array[$key])) {
                        foreach ($modifiers_array[$key] as $modifier) {
                            $modifier['parent_sell_line_id'] = $value->id;
                            $modifiers_formatted[] = new TransactionSellLine($modifier);
                        }
                    }
                }
            }

            //Combo product lines.
            //$products_value = array_values($products);
            foreach ($lines_formatted as $key => $value) {
                if (! empty($products_modified_combo[$key]['product_type']) && $products_modified_combo[$key]['product_type'] == 'combo') {
                    $combo_lines = array_merge($combo_lines, $this->__makeLinesForComboProduct($products_modified_combo[$key]['combo'], $value));
                }

                //Save sell line warranty if set
                if (! empty($sell_line_warranties[$key])) {
                    $value->warranties()->sync([$sell_line_warranties[$key]]);
                }
            }
        }

        if (! empty($combo_lines)) {
            $transaction->sell_lines()->saveMany($combo_lines);
        }

        if (! empty($modifiers_formatted)) {
            $transaction->sell_lines()->saveMany($modifiers_formatted);
        }

        if ($return_deleted) {
            return $deleted_lines;
        }

        return true;
    }
    public function createOrUpdatePaymentLines($transaction, $payments, $business_id = null, $user_id = null, $uf_data = true)
    {
        $payments_formatted = [];
        $edit_ids = [0];
        $account_transactions = [];

        if (! is_object($transaction)) {
            $transaction = Transaction::findOrFail($transaction);
        }

        //If status is draft don't add payment
        if ($transaction->status == 'draft') {
            return true;
        }
        $c = 0;
        $prefix_type = 'sell_payment';
        if ($transaction->type == 'purchase') {
            $prefix_type = 'purchase_payment';
        }
        $contact_balance = Contact::where('id', $transaction->contact_id)->value('balance');
        $denominations = [];
        foreach ($payments as $payment) {
            //Check if transaction_sell_lines_id is set.
            if (! empty($payment['payment_id'])) {
                $edit_ids[] = $payment['payment_id'];
                $this->editPaymentLine($payment, $transaction, $uf_data);
            } else {
                $payment_amount = $uf_data ? $this->num_uf($payment['amount']) : $payment['amount'];
                if ($payment['method'] == 'advance' && $payment_amount > $contact_balance) {
                    throw new AdvanceBalanceNotAvailable(__('lang_v1.required_advance_balance_not_available'));
                }
                //If amount is 0 then skip.
                if ($payment_amount != 0) {
                    $prefix_type = 'sell_payment';
                    if ($transaction->type == 'purchase') {
                        $prefix_type = 'purchase_payment';
                    }
                    $ref_count = $this->setAndGetReferenceCount($prefix_type, $business_id);
                    //Generate reference number
                    $payment_ref_no = $this->generateReferenceNumber($prefix_type, $ref_count, $business_id);

                    if (! empty($payment['paid_on'])) {
                        $paid_on = $uf_data ? $this->uf_date($payment['paid_on'], true) : $payment['paid_on'];
                    } else {
                        $paid_on = \Carbon::now()->toDateTimeString();
                    }

                    $payment_data = [
                        'amount' => $payment_amount,
                        'method' => $payment['method'],
                        'business_id' => $transaction->business_id,
                        'is_return' => isset($payment['is_return']) ? $payment['is_return'] : 0,
                        'card_transaction_number' => isset($payment['card_transaction_number']) ? $payment['card_transaction_number'] : null,
                        'card_number' => isset($payment['card_number']) ? $payment['card_number'] : null,
                        'card_type' => isset($payment['card_type']) ? $payment['card_type'] : null,
                        'card_holder_name' => isset($payment['card_holder_name']) ? $payment['card_holder_name'] : null,
                        'card_month' => isset($payment['card_month']) ? $payment['card_month'] : null,
                        'card_security' => isset($payment['card_security']) ? $payment['card_security'] : null,
                        'cheque_number' => isset($payment['cheque_number']) ? $payment['cheque_number'] : null,
                        'bank_account_number' => isset($payment['bank_account_number']) ? $payment['bank_account_number'] : null,
                        'note' => isset($payment['note']) ? $payment['note'] : null,
                        'paid_on' => $paid_on,
                        'created_by' => empty($user_id) ? auth()->user()->id : $user_id,
                        'payment_for' => $transaction->contact_id,
                        'payment_ref_no' => $payment_ref_no,
                        'account_id' => ! empty($payment['account_id']) && $payment['method'] != 'advance' ? $payment['account_id'] : null,
                    ];

                    for ($i = 1; $i < 8; $i++) {
                        if ($payment['method'] == 'custom_pay_'.$i) {
                            $payment_data['transaction_no'] = $payment["transaction_no_{$i}"];
                        }
                    }

                    $payments_formatted[] = new TransactionPayment($payment_data);

                    if (! empty($payment['denominations'])) {
                        $denominations[$payment_ref_no] = $payment['denominations'];
                    }

                    $account_transactions[$c] = [];

                    //create account transaction
                    $payment_data['transaction_type'] = $transaction->type;
                    $account_transactions[$c] = $payment_data;

                    $c++;
                }
            }
        }

        //Delete the payment lines removed.
        if (! empty($edit_ids)) {
            $deleted_transaction_payments = $transaction->payment_lines()->whereNotIn('id', $edit_ids)->get();

            $transaction->payment_lines()->whereNotIn('id', $edit_ids)->delete();

            //Fire delete transaction payment event
            foreach ($deleted_transaction_payments as $deleted_transaction_payment) {
                event(new TransactionPaymentDeleted($deleted_transaction_payment));
            }
        }

        if (! empty($payments_formatted)) {
            $transaction->payment_lines()->saveMany($payments_formatted);
            $payment_lines = $transaction->payment_lines;
            foreach ($account_transactions as $account_transaction) {
                $payment = $payment_lines->where('payment_ref_no', $account_transaction['payment_ref_no'])->first();

                if (! empty($payment)) {
                    event(new TransactionPaymentAdded($payment, $account_transaction));
                }
            }

            //add denominations

            if (! empty($denominations)) {
                foreach ($denominations as $key => $value) {
                    $payment = $payment_lines->where('payment_ref_no', $key)->first();
                    $this->addCashDenominations($payment, $value);
                }
            }
        }

        return true;
    }
}
