<?php

namespace App\Http\Controllers;

use App\TransactionSellLine;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BusinessOrderController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $transaction_sell_lines = TransactionSellLine::whereHas('transaction')
                ->with(['product.variations'])
                ->orderBy('created_at', 'asc')
                ->get();


            return DataTables::of($transaction_sell_lines)
                // ->addColumn('actions', function ($transaction_sell_line) {
                //     $editUrl   = route('transaction.edit', $transaction_sell_line->transaction->id);
                //     $deleteUrl = route('transaction.delete', $transaction_sell_line->transaction->id);

                //     return '
                //     <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                //     <a href="' . $deleteUrl . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>
                // ';
                // })
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
                ->addColumn('purchase_date', function ($transaction_sell_line) {
                    return \Carbon::parse($transaction_sell_line->created_at)->format('d F, Y');
                })
                ->rawColumns([])
                ->toJson();
        }

        return view('business.order');
    }
}
