<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Product;
use App\TaxRate;
use App\Transaction;
use App\TransactionSellLine;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Crm\Entities\ServicePropertyWanted;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class CustomerProductController extends Controller
{
    /**
     * All Utils instance.
     */
    protected $productUtil;

    protected $transactionUtil;

    protected $moduleUtil;

    /**
     * Constructor
     *
     * @param  ProductUtils  $product
     * @return void
     */
    public function __construct(ProductUtil $productUtil, TransactionUtil $transactionUtil, BusinessUtil $businessUtil, ModuleUtil $moduleUtil)
    {
        $this->productUtil     = $productUtil;
        $this->transactionUtil = $transactionUtil;
        $this->businessUtil    = $businessUtil;
        $this->moduleUtil      = $moduleUtil;

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
    public function getListPurchases($id)
    {
        $purchases = Transaction::leftJoin('contacts', 'transactions.contact_id', '=', 'contacts.id')
            ->join(
                'business_locations AS BS',
                'transactions.location_id',
                '=',
                'BS.id'
            )
            ->leftJoin(
                'transaction_payments AS TP',
                'transactions.id',
                '=',
                'TP.transaction_id'
            )
            ->leftJoin(
                'transactions AS PR',
                'transactions.id',
                '=',
                'PR.return_parent_id'
            )
            ->leftJoin('users as u', 'transactions.created_by', '=', 'u.id')
            ->where('transactions.created_by', $id)
            ->where('transactions.type', 'purchase')
            ->select(
                'transactions.id',
                'transactions.document',
                'transactions.transaction_date',
                'transactions.ref_no',
                'transactions.invoice_no',
                'contacts.name',
                'contacts.supplier_business_name',
                'transactions.status',
                'transactions.payment_status',
                'transactions.final_total',
                'BS.name as location_name',
                'transactions.pay_term_number',
                'transactions.pay_term_type',
                'PR.id as return_transaction_id',
                DB::raw('SUM(TP.amount) as amount_paid'),
                DB::raw('(SELECT SUM(TP2.amount) FROM transaction_payments AS TP2 WHERE
                        TP2.transaction_id=PR.id ) as return_paid'),
                DB::raw('COUNT(PR.id) as return_exists'),
                DB::raw('COALESCE(PR.final_total, 0) as amount_return'),
                DB::raw("CONCAT(COALESCE(u.surname, ''),' ',COALESCE(u.first_name, ''),' ',COALESCE(u.last_name,'')) as added_by")
            )
            ->groupBy('transactions.id');

        return $purchases;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPurchaseList(Request $request)
    {
        // $user_id = request()->session()->get('user.id');
        $user = Auth::user();

        // $contact_type = Contact::where('created_by', $user->id)
        //     ->find(auth()->user()->crm_contact_id)
        //     ->type;

        // if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'crm_module') && in_array($contact_type, ['supplier', 'both']))) {
        //     abort(403, 'Unauthorized action.');
        // }

        if ($request->ajax()) {
            $purchases = $this->getListPurchases($user->id);

            //filter by payment status
            if (!empty($request->input('payment_status')) && $request->input('payment_status') != 'overdue') {
                $purchases->where('transactions.payment_status', $request->input('payment_status'));
            } elseif ($request->input('payment_status') == 'overdue') {
                $purchases->whereIn('transactions.payment_status', ['due', 'partial'])
                    ->whereNotNull('transactions.pay_term_number')
                    ->whereNotNull('transactions.pay_term_type')
                    ->whereRaw("IF(transactions.pay_term_type='days', DATE_ADD(transactions.transaction_date, INTERVAL transactions.pay_term_number DAY) < CURDATE(), DATE_ADD(transactions.transaction_date, INTERVAL transactions.pay_term_number MONTH) < CURDATE())");
            }

            //filter by purchase status
            if (!empty($request->status)) {
                $purchases->where('transactions.status', $request->status);
            }

            //filter by date
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $start = $request->start_date;
                $end   = $request->end_date;
                $purchases->whereDate('transactions.transaction_date', '>=', $start)
                    ->whereDate('transactions.transaction_date', '<=', $end);
            }

            //get purchase of logged in supplier/customer
            // $purchases->where('contacts.id', auth()->user()->crm_contact_id);

            return Datatables::of($purchases)
                ->addColumn('action', function ($row) {
                    $html = '<div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle btn-xs" 
                                data-toggle="dropdown" aria-expanded="false">' .
                        __("messages.actions") .
                        '<span class="caret"></span><span class="sr-only">Toggle Dropdown
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li>
                                    <a class="product_show"  data-id="' . $row->id . '"><i class="fas fa-eye " aria-hidden="true"></i>' . __("messages.view") . '</a>
                                </li>

                                <li>
                                    <a  class="product_print" data-id="' . $row->id . '"><i class="fas fa-print" aria-hidden="true"></i>' . __("messages.print") . '</a>
                                </li>';

                    $html .= '</ul>
                            </div>';
                    return $html;
                })
                // ->removeColumn('id')
                ->editColumn('ref_no', function ($row) {
                    return !empty($row->return_exists) ? $row->ref_no . ' <small class="label bg-red label-round no-print" title="' . __('lang_v1.some_qty_returned') . '"><i class="fas fa-undo"></i></small>' : $row->ref_no;
                })
                ->editColumn('invoice_no', function ($row) {
                    return $row->invoice_no;
                })
                ->editColumn(
                    'final_total',
                    '<span class="display_currency final_total" data-currency_symbol="true" data-orig-value="{{$final_total}}">{{$final_total}}</span>'
                )
                ->editColumn('transaction_date', function ($data) {
                    return \Carbon::parse($data->transaction_date)->format('Y-m-d');
                })
                ->editColumn(
                    'status',
                    function ($row) {
                        return $row->status;
                    }
                )
                ->editColumn(
                    'payment_status',
                    function ($row) {
                        $payment_status = Transaction::getPaymentStatus($row);

                        if ($payment_status == 'partial') {
                            $bg = 'bg-aqua';
                        } elseif ($payment_status == 'due') {
                            $bg = 'bg-yellow';
                        } elseif ($payment_status == 'paid') {
                            $bg = 'bg-light-green';
                        } elseif ($payment_status == 'overdue' || $payment_status == 'partial-overdue') {
                            $bg = 'bg-red';
                        }

                        $html = '<a href="#" class="view_payment_modal payment-status-label" data-orig-value="' . $payment_status . '" data-status-name="' . __('lang_v1.' . $payment_status) . '"><span class="label ' . $bg . '">' . __('lang_v1.' . $payment_status) . '
                        </span></a>';

                        return $html;
                    }
                )
                ->addColumn('payment_due', function ($row) {
                    $due      = $row->final_total - $row->amount_paid;
                    $due_html = '<span class="display_currency payment_due" data-currency_symbol="true" data-orig-value="' . $due . '">' . $due . '</span>';

                    if (!empty($row->return_exists)) {
                        $return_due = $row->amount_return - $row->return_paid;
                        $due_html .= '<br><strong>' . __('lang_v1.purchase_return') . ':</strong> <a href="#" class="no-print"><span class="display_currency purchase_return" data-currency_symbol="true" data-orig-value="' . $return_due . '">' . $return_due . '</span></a><span class="display_currency print_section" data-currency_symbol="true">' . $return_due . '</span>';
                    }
                    return $due_html;
                })
                // ->setRowAttr([
                //     'data-href' => function ($row) {
                //         return action('CustomerProductController@single', [$row->id]);
                //     }
                // ])
                ->rawColumns(['action', 'ref_no', 'invoice_no', 'transaction_date', 'status', 'payment_status', 'final_total', 'payment_due'])
                ->make(true);
        }
        $business_locations = [
            'dhaka'      => 'Dhaka',
            'chittagong' => 'Chittagong',
            'sylhet'     => 'Sylhet',
            'barisal'    => 'Barisal',
            'khulna'     => 'Khulna',
            'rajshahi'   => 'Rajshahi',
            'rangpur'    => 'Rangpur',
            'mymensingh' => 'Mymensingh',
        ];

        $customers = [
            'customer' => 'Customer',
            'supplier' => 'Supplier',
            'both'     => 'Both',
        ];

        $orderStatuses = $this->productUtil->orderStatuses();
        return view('crm::customer-product.order.list')
            ->with(compact('orderStatuses', 'business_locations', 'customers'));
    }
    public function index()
    {
        $businessUtil   = new BusinessUtil();
        $only_shipments = request()->only_shipments == 'true' ? true : false;
        $is_admin       = $businessUtil->is_admin(auth()->user());
        $sale_type      = !empty(request()->input('sale_type')) ? request()->input('sale_type') : 'sell';
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (request()->ajax()) {
            $transaction_sell_lines = TransactionSellLine::whereHas('transaction', function ($sub_query) use ($user) {
                $sub_query->where('created_by', $user->id);
            })
                ->with(['product.variations'])
                ->orderBy('created_at', 'asc')
                ->get();

            return DataTables::of($transaction_sell_lines)
                ->addColumn(
                    'action',
                    function ($row) use ($only_shipments, $is_admin, $sale_type) {
                        $html = '<div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle btn-xs" 
                                data-toggle="dropdown" aria-expanded="false">' .
                            __('messages.actions') .
                            '<span class="caret"></span><span class="sr-only">Toggle Dropdown
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">';


                        $html .= '<li><a  class="btn-modal product_show" data-id="' . $row->id . '"><i class="fas fa-eye" aria-hidden="true"></i> ' . __('messages.view') . '</a></li>';

                        if (!$only_shipments) {
                            if ($row->is_direct_sale == 0) {
                                if (auth()->user()->can('sell.update')) {
                                    $html .= '<li><a target="_blank" href="' . action([\App\Http\Controllers\SellPosController::class, 'edit'], [$row->id]) . '"><i class="fas fa-edit"></i> ' . __('messages.edit') . '</a></li>';
                                }
                            } elseif ($row->type == 'sales_order') {
                                if (auth()->user()->can('so.update')) {
                                    $html .= '<li><a target="_blank" href="' . action([\App\Http\Controllers\SellController::class, 'edit'], [$row->id]) . '"><i class="fas fa-edit"></i> ' . __('messages.edit') . '</a></li>';
                                }
                            } else {
                                if (auth()->user()->can('direct_sell.update')) {
                                    $html .= '<li><a target="_blank" href="' . action([\App\Http\Controllers\SellController::class, 'edit'], [$row->id]) . '"><i class="fas fa-edit"></i> ' . __('messages.edit') . '</a></li>';
                                }
                            }

                            $delete_link = '<li><a href="' . action([\App\Http\Controllers\SellPosController::class, 'destroy'], [$row->id]) . '" class="delete-sale"><i class="fas fa-trash"></i> ' . __('messages.delete') . '</a></li>';
                            if ($row->is_direct_sale == 0) {
                                if (auth()->user()->can('sell.delete')) {
                                    $html .= $delete_link;
                                }
                            } elseif ($row->type == 'sales_order') {
                                if (auth()->user()->can('so.delete')) {
                                    $html .= $delete_link;
                                }
                            } else {
                                if (auth()->user()->can('direct_sell.delete')) {
                                    $html .= $delete_link;
                                }
                            }
                        }

                        if (config('constants.enable_download_pdf') && auth()->user()->can('print_invoice') && $sale_type != 'sales_order') {
                            $html .= '<li><a href="' . route('sell.downloadPdf', [$row->id]) . '" target="_blank"><i class="fas fa-print" aria-hidden="true"></i> ' . __('lang_v1.download_pdf') . '</a></li>';

                            if (!empty($row->shipping_status)) {
                                $html .= '<li><a href="' . route('packing.downloadPdf', [$row->id]) . '" target="_blank"><i class="fas fa-print" aria-hidden="true"></i> ' . __('lang_v1.download_paking_pdf') . '</a></li>';
                            }
                        }

                        if (auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.access')) {
                            if (!empty($row->document)) {
                                $document_name = !empty(explode('_', $row->document, 2)[1]) ? explode('_', $row->document, 2)[1] : $row->document;
                                $html .= '<li><a href="' . url('uploads/documents/' . $row->document) . '" download="' . $document_name . '"><i class="fas fa-download" aria-hidden="true"></i>' . __('purchase.download_document') . '</a></li>';
                                if (isFileImage($document_name)) {
                                    $html .= '<li><a href="#" data-href="' . url('uploads/documents/' . $row->document) . '" class="view_uploaded_document"><i class="fas fa-image" aria-hidden="true"></i>' . __('lang_v1.view_document') . '</a></li>';
                                }
                            }
                        }

                        if ($is_admin || auth()->user()->hasAnyPermission(['access_shipping', 'access_own_shipping', 'access_commission_agent_shipping'])) {
                            $html .= '<li><a href="#" data-href="' . action([\App\Http\Controllers\SellController::class, 'editShipping'], [$row->id]) . '" class="btn-modal" data-container=".view_modal"><i class="fas fa-truck" aria-hidden="true"></i>' . __('lang_v1.edit_shipping') . '</a></li>';
                        }

                        if ($row->type == 'sell') {
                            if (auth()->user()->can('print_invoice')) {
                                $html .= '<li><a href="#" class="print-invoice" data-href="' . route('sell.printInvoice', [$row->id]) . '"><i class="fas fa-print" aria-hidden="true"></i> ' . __('lang_v1.print_invoice') . '</a></li>
                            <li><a href="#" class="print-invoice" data-href="' . route('sell.printInvoice', [$row->id]) . '?package_slip=true"><i class="fas fa-file-alt" aria-hidden="true"></i> ' . __('lang_v1.packing_slip') . '</a></li>';

                                $html .= '<li><a href="#" class="print-invoice" data-href="' . route('sell.printInvoice', [$row->id]) . '?delivery_note=true"><i class="fas fa-file-alt" aria-hidden="true"></i> ' . __('lang_v1.delivery_note') . '</a></li>';
                            }
                            $html .= '<li class="divider"></li>';
                            if (!$only_shipments) {
                                if (
                                    $row->is_direct_sale == 0 && !auth()->user()->can('sell.update') &&
                                    auth()->user()->can('edit_pos_payment')
                                ) {
                                    $html .= '<li><a href="' . route('edit-pos-payment', [$row->id]) . '" 
                            ><i class="fas fa-money-bill-alt"></i> ' . __('lang_v1.add_edit_payment') .
                                        '</a></li>';
                                }

                                if (
                                    auth()->user()->can('sell.payments') ||
                                    auth()->user()->can('edit_sell_payment') ||
                                    auth()->user()->can('delete_sell_payment')
                                ) {
                                    if ($row->payment_status != 'paid') {
                                        $html .= '<li><a href="' . action([\App\Http\Controllers\TransactionPaymentController::class, 'addPayment'], [$row->id]) . '" class="add_payment_modal"><i class="fas fa-money-bill-alt"></i> ' . __('purchase.add_payment') . '</a></li>';
                                    }

                                    $html .= '<li><a href="' . action([\App\Http\Controllers\TransactionPaymentController::class, 'show'], [$row->id]) . '" class="view_payment_modal"><i class="fas fa-money-bill-alt"></i> ' . __('purchase.view_payments') . '</a></li>';
                                }

                                if (auth()->user()->can('sell.create') || auth()->user()->can('direct_sell.access')) {
                                    // $html .= '<li><a href="' . action([\App\Http\Controllers\SellController::class, 'duplicateSell'], [$row->id]) . '"><i class="fas fa-copy"></i> ' . __("lang_v1.duplicate_sell") . '</a></li>';
        
                                    $html .= '<li><a href="' . action([\App\Http\Controllers\SellReturnController::class, 'add'], [$row->id]) . '"><i class="fas fa-undo"></i> ' . __('lang_v1.sell_return') . '</a></li>

                            <li><a href="' . action([\App\Http\Controllers\SellPosController::class, 'showInvoiceUrl'], [$row->id]) . '" class="view_invoice_url"><i class="fas fa-eye"></i> ' . __('lang_v1.view_invoice_url') . '</a></li>';
                                }
                            }

                            $html .= '<li><a href="#" data-href="' . action([\App\Http\Controllers\NotificationController::class, 'getTemplate'], ['transaction_id' => $row->id, 'template_for' => 'new_sale']) . '" class="btn-modal" data-container=".view_modal"><i class="fa fa-envelope" aria-hidden="true"></i>' . __('lang_v1.new_sale_notification') . '</a></li>';
                        } else {
                            $html .= '<li><a href="#" data-href="' . action([\App\Http\Controllers\SellController::class, 'viewMedia'], ['model_id' => $row->id, 'model_type' => \App\Transaction::class, 'model_media_type' => 'shipping_document']) . '" class="btn-modal" data-container=".view_modal"><i class="fas fa-paperclip" aria-hidden="true"></i>' . __('lang_v1.shipping_documents') . '</a></li>';
                        }

                        $html .= '</ul></div>';

                        return $html;
                    }
                )
                ->addColumn('name', function ($transaction_sell_line) {
                    return $transaction_sell_line->product->name;
                })
                ->addColumn('invoice_no', function ($transaction_sell_line) {
                    return $transaction_sell_line->transaction->invoice_no;
                })
                ->addColumn('unit_price', function ($transaction_sell_line) {
                    return '£ ' . $transaction_sell_line->product->variations[0]->sell_price_inc_tax;
                })
                ->addColumn('payment_method', function ($transaction_sell_line) {
                    return $transaction_sell_line->transaction->payment_lines[0]->method;
                })
                ->addColumn('payment_status', function ($transaction_sell_line) {
                    return $transaction_sell_line->transaction->payment_status;
                })
                ->addColumn('purchase_date', function ($transaction_sell_line) {
                    return Carbon::parse($transaction_sell_line->created_at)->format('d F, Y');
                })
                ->rawColumns([])
                ->toJson();
        }
        $business_locations = [
            'dhaka'      => 'Dhaka',
            'chittagong' => 'Chittagong',
            'sylhet'     => 'Sylhet',
            'barisal'    => 'Barisal',
            'khulna'     => 'Khulna',
            'rajshahi'   => 'Rajshahi',
            'rangpur'    => 'Rangpur',
            'mymensingh' => 'Mymensingh',
        ];
        $customers          = [
            'customer' => 'Customer',
            'supplier' => 'Supplier',
            'both'     => 'Both',
        ];
        return view('crm::customer-product.order.list')
            ->with(compact('business_locations', 'customers'));
    }
    public function show(Request $request)
    {
        $id = $request->id;

        return view('crm::customer-product.order.show', compact('id'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request)
    {
        // if (!auth()->user()->can('purchase.view')) {
        //     abort(403, 'Unauthorized action.');
        // }
        $id = $request->id;

        $user     = Auth::user();
        $taxes    = TaxRate::where('created_by', $user->id)
            ->pluck('name', 'id');
        $purchase = Transaction::where('created_by', $user->id)
            ->where('id', $id)
            ->with(
                'contact',
                'purchase_lines',
                'purchase_lines.product',
                'purchase_lines.product.unit',
                'purchase_lines.product.second_unit',
                'purchase_lines.variations',
                'purchase_lines.variations.product_variation',
                'purchase_lines.sub_unit',
                'location',
                'payment_lines',
                'tax'
            )
            ->firstOrFail();

        // foreach ($purchase->purchase_lines as $key => $value) {
        //     if (!empty($value->sub_unit_id)) {
        //         $formated_purchase_line         = $this->productUtil->changePurchaseLineUnit($value, $business_id);
        //         $purchase->purchase_lines[$key] = $formated_purchase_line;
        //     }
        // }

        $payment_methods = $this->productUtil->payment_types($purchase->location_id, true);

        $purchase_taxes = [];
        if (!empty($purchase->tax)) {
            if ($purchase->tax->is_tax_group) {
                $purchase_taxes = $this->transactionUtil->sumGroupTaxDetails($this->transactionUtil->groupTaxDetails($purchase->tax, $purchase->tax_amount));
            } else {
                $purchase_taxes[$purchase->tax->name] = $purchase->tax_amount;
            }
        }

        //Purchase orders
        $purchase_order_nos   = '';
        $purchase_order_dates = '';
        if (!empty($purchase->purchase_order_ids)) {
            $purchase_orders = Transaction::find($purchase->purchase_order_ids);

            $purchase_order_nos = implode(', ', $purchase_orders->pluck('ref_no')->toArray());
            $order_dates        = [];
            foreach ($purchase_orders as $purchase_order) {
                $order_dates[] = $this->transactionUtil->format_date($purchase_order->transaction_date, true);
            }
            $purchase_order_dates = implode(', ', $order_dates);
        }

        $activities = Activity::forSubject($purchase)
            ->with(['causer', 'subject'])
            ->latest()
            ->get();

        $statuses = $this->productUtil->orderStatuses();

        return view('crm::customer-product.order.show
        ', compact('id'))
            ->with(compact('taxes', 'purchase', 'payment_methods', 'purchase_taxes', 'activities', 'statuses', 'purchase_order_nos', 'purchase_order_dates'));
    }
    /**
     * Checks if ref_number and supplier combination already exists.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function printInvoice(Request $request)
    {
        $id = $request->id;
        try {
            // $business_id     = request()->session()->get('user.business_id');
            $user            = Auth::user();
            $taxes           = TaxRate::where('created_by', $user->id)
                ->pluck('name', 'id');
            $purchase        = Transaction::where('created_by', $user->id)
                ->where('id', $id)
                ->with(
                    'contact',
                    'purchase_lines',
                    'purchase_lines.product',
                    'purchase_lines.variations',
                    'purchase_lines.variations.product_variation',
                    'location',
                    'payment_lines'
                )
                ->first();
            $payment_methods = $this->productUtil->payment_types($purchase->location_id, true);

            //Purchase orders
            $purchase_order_nos   = '';
            $purchase_order_dates = '';
            if (!empty($purchase->purchase_order_ids)) {
                $purchase_orders = Transaction::find($purchase->purchase_order_ids);

                $purchase_order_nos = implode(', ', $purchase_orders->pluck('ref_no')->toArray());
                $order_dates        = [];
                foreach ($purchase_orders as $purchase_order) {
                    $order_dates[] = $this->transactionUtil->format_date($purchase_order->transaction_date, true);
                }
                $purchase_order_dates = implode(', ', $order_dates);
            }

            $output                            = ['success' => 1, 'receipt' => [], 'print_title' => $purchase->ref_no];
            $output['receipt']['html_content'] = view('purchase.partials.show_details', compact('taxes', 'purchase', 'payment_methods', 'purchase_order_nos', 'purchase_order_dates'))->render();
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => 0,
                'msg'     => __('messages.something_went_wrong'),
            ];
        }

        return $output;
    }
}
