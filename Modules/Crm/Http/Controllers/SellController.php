<?php

namespace Modules\Crm\Http\Controllers;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\TransactionSellLine;
use App\Utils\ModuleUtil;
use App\Utils\TransactionUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SellController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $transactionUtil;
    protected $moduleUtil;
    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct(TransactionUtil $transactionUtil, ModuleUtil $moduleUtil)
    {
        $this->transactionUtil = $transactionUtil;
        $this->moduleUtil = $moduleUtil;
    }

    public function getSellList(Request $request)
    {
        $business_id = request()->session()->get('user.business_id');

        // $contact_type = Contact::where('business_id', $business_id)
        //     ->find(auth()->user()->crm_contact_id)
        //     ->type;

        // if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'crm_module') && in_array($contact_type, ['customer', 'both']))) {
        //     abort(403, 'Unauthorized action.');
        // }



        $shipping_statuses = $this->transactionUtil->shipping_statuses();
        $payment_types = $this->transactionUtil->payment_types(null, true);
        $with = [];

        $user = Auth::user();
        if (request()->ajax()) {
            $transaction_sell_lines = TransactionSellLine::whereHas('transaction', function($sub_query) use($user) {
                $sub_query->where('created_by', $user->id);
            })
            ->with(['product.variations'])
            ->orderBy('created_at', 'asc')
            ->get();

            return DataTables::of($transaction_sell_lines)
                ->addColumn('name', function($transaction_sell_line) {
                    return $transaction_sell_line->product->name;
                })
                ->addColumn('unit_price', function($transaction_sell_line) {
                    return '£ ' . $transaction_sell_line->product->variations[0]->sell_price_inc_tax;
                })
                ->addColumn('payment_method', function($transaction_sell_line) {
                    return $transaction_sell_line->transaction->payment_lines[0]->method;
                })
                ->addColumn('purchase_date', function($transaction_sell_line) {
                    return Carbon::parse($transaction_sell_line->created_at)->format('d F, Y');
                })
                ->addColumn(
                    'action',
                    function ($row) {
                        $html = '<div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle btn-xs" 
                                        data-toggle="dropdown" aria-expanded="false">' .
                            __("messages.actions") .
                            '<span class="caret"></span><span class="sr-only">Toggle Dropdown
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-left" role="menu">

                                <li><a href="#" class="print-invoice" data-href="' . route('sell.printInvoice', [$row->id]) . '"><i class="fas fa-print" aria-hidden="true"></i> ' . __("messages.print") . '</a></li>';

                        $html .= '</ul></div>';

                        return $html;
                    }
                )
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('crm::sell.index');
    }
}
