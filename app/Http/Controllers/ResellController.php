<?php

namespace App\Http\Controllers;

use App\Product;
use App\ResellingProduct;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ResellController extends Controller
{
    public function index(){
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $user_id = request()->session()->get('user.id');

            $products = Product::select('sku', 'id')
            ->whereNotIn('id', function ($query) use($user_id) {
                $query->select('product_id')
                    ->from('reselling_products')
                    ->where('reseller_id', $user_id);
            })
            ->get();
            foreach ($products as $product) {
                $product->makeHidden('image_url');
            }
            return Datatables::of($products)
            ->addColumn('action', function ($product) {
                return '<button type="submit" class="btn btn-xs btn-primary resell_product_button" data-id="'.$product->id.'">Share This Shop</button>';
        
            })
            ->removeColumn('id')
            ->removeColumn('image_url')

                ->rawColumns([1])
                ->make(false);

        }
        return view('product.resell.resell_product_create');
    }

    public function store(Request $request){
        $resell_product = new ResellingProduct();
        $resell_product->reseller_id = request()->session()->get('user.id');
        $resell_product->product_id = $request->product_id;
        $resell_product->added_price = $request->added_price;
        $resell_product->discount_price = $request->discount_price;
        $resell_product->save();
        return back()->with('success', 'Added to resell product');
    }

    public function modalResellProduct(Request $request){
        $id = $request->value;
        return view('product.resell.resell_product_create_modal', compact('id'));
    }
}
