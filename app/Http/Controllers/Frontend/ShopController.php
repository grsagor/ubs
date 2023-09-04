<?php

namespace App\Http\Controllers\Frontend;

use App\Business;
use App\Category;
use App\BusinessLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function shopList(Request $request, $slug = null, $slug1 = null)
    {
        $search = $request->search;
        $category = $request->category;
        $country = $request->country;
        $vendors = BusinessLocation::orderby('id', 'desc')
            ->when($category, function ($query, $category) {
                if (!empty($category)) {
                    $category_id = Category::where('slug', $category)->first()->id;
                    return $query->where('category_id', $category_id);
                }
            })
            ->when($search, function ($query, $search) {
                if (!empty($search)) {
                    $query->where('name', 'like', '%' . $search . '%')->where(function ($q) use ($search) {
                        $q->orwhere('name', 'like', $search . '%');
                        // $q->orwhere('address', 'like', $search . '%');
                        // $q->orwhere('address', 'like', '%' . $search . '%');
                    });
                }
            })
            ->when($country, function ($query, $country) {
                if (!empty($country)) {
                    return $query->where('country', $country);
                }
            })
            ->paginate(20);
        return view('frontend.pages.shop.shop_list', compact('vendors'));
    }


    public function ShopService($id)
    {
        // dd($id);
        $shop = BusinessLocation::where('id', $id)
            ->with([
                'services',
                'products',
                'marketingProducts' => function ($query) {
                    $query->take(8);
                }
            ])->first();
        $vendor = Business::where('id', $shop->business_id)->first();

        // return $vendor;
        return view('frontend.pages.shop.service_shop', compact('shop', 'vendor'));
    }

    public function BusinessShopService($id)
    {
        $shop = BusinessLocation::where('business_id', $id)->get();
        $vendor = Business::where('id', $id)->first();
        // return $shop;
        return view('frontend.pages.shop.business_service_shop', compact('shop', 'vendor'));
    }
}
