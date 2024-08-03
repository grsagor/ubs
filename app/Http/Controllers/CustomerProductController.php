<?php

namespace App\Http\Controllers;

use App\Product;
use App\TransactionSellLine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Crm\Entities\ServicePropertyWanted;
use Yajra\DataTables\DataTables;

class CustomerProductController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

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
                ->rawColumns([])
                ->toJson();
        }
        return view('crm::customer-product.list');
    }
}
