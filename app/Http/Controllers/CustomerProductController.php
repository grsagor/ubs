<?php

namespace App\Http\Controllers;

use App\Product;
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
        // $products = Product::whereHas('transaction_sell_lines.transaction', function($sub_query) use($user) {
        //     $sub_query->where('created_by', $user->id);
        // })
        // ->with(['variations'])
        // ->get();
        // return $products[0]->variations[0]->sell_price_inc_tax;

        if (request()->ajax()) {
            $products = Product::whereHas('transaction_sell_lines.transaction', function($sub_query) use($user) {
                $sub_query->where('created_by', $user->id);
            })
            ->with(['variations'])
            ->get();

            return DataTables::of($products)
                ->addColumn('unit_price', function($product) {
                    return '£ ' . $product->variations[0]->sell_price_inc_tax;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('crm::customer-product.list');
    }
}
