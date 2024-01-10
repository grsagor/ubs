<?php

namespace App\Http\Controllers;

use App\Product;
use App\ResellingProduct;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ResellController extends Controller
{
    public function index()
    {
        $price = 200;
        $products = Product::all();
        $resell_products = ResellingProduct::with('product')->get();
        $new_resell_products = $resell_products->map(function ($item) use ($price) {
            $product = $item->product;
            $product->is_resell = true;
            $product->resell_id = $item->id;
            $product->resell_info = ResellingProduct::find($item->id);
            if ($product->is_discount == 1 && $item->add_discount == "discount") {
                $product->reseller_get = ($price * (($product->discount_amount)/100)) - ($price * (($item->amount)/100));
            }
            if ($product->is_discount == 1 && $item->add_discount == "add") {
                $product->reseller_get = ($price * (($product->discount_amount)/100)) + ($price * (($item->amount)/100));
            }
            if (!$product->is_discount && $item->add_discount == "add") {
                $product->reseller_get = ($price * (($item->amount)/100));
            }
            if (!$product->is_discount && $item->add_discount == "discount") {
                $product->reseller_get = 0;
            }
            return $product;
        });
        $total_products = $products->concat($new_resell_products);
        $total_products = $total_products->sortByDesc('updated_at')->values();
        return $total_products;

        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $user_id = request()->session()->get('user.id');

            $products = Product::select('sku', 'id', 'name', 'product_custom_field1', 'product_custom_field2', 'product_custom_field3', 'product_custom_field4')
                ->whereNotIn('id', function ($query) use ($user_id) {
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
                    return '<button type="submit" class="btn btn-xs btn-primary resell_product_button" data-id="' . $product->id . '">Resell</button>';

                })

                ->rawColumns(['action'])
                ->make(true);

        }
        return view('product.resell.resell_product_create');
    }

    public function store(Request $request)
    {
        $resell_product = new ResellingProduct();
        $resell_product->reseller_id = request()->session()->get('user.id');
        $resell_product->product_id = $request->product_id;
        $resell_product->add_discount = $request->add_discount;
        $resell_product->amount = $request->amount;
        $resell_product->save();
        return back()->with('success', 'Added to resell product');
    }

    public function modalResellProduct(Request $request)
    {
        $id = $request->value;
        $product = Product::find($id);
        return view('product.resell.resell_product_create_modal', compact('id','product'));
    }
}
