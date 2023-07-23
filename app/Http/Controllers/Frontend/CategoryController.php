<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Country;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     //aready type existed thats why kind was used  --added by huma
    public function category(Request $request, $slug = null, $slug1 = null, $slug2 = null, $slug3 = null, $kind = null)
    {

        $cat = null;
        $subcat = null;
        $childcat = null;
        $flash = null;
        $minprice = $request->min;
        $maxprice = $request->max;
        $sort = $request->sortby;
        $search = $request->search;
        $pageby = $request->pageby;
        $country = $request->country_id;
        $city = $request->city_id;
        $type = $request->has('type') ?? '';

        if (!empty($slug)) {
            $cat = Category::where('slug', $slug)
                ->with([
                    'attributes' => function ($query) {
                        $query->where('type', 1);
                    },
                ])
                ->firstOrFail();
            $data['cat'] = $cat;
        }



        $data['latest_products'] = Product::get();

        
        $data['prods'] = Product::paginate(30);
        $data['countries'] = Country::where('status', 1)
            ->orderby('id', 'asc')
            ->get();

        //    dd($data['prods']);
        if ($request->ajax()) {
            $data['ajax_check'] = 1;
            return view('frontend.ajax.category', $data);
        }

        return view('Frontend.pages.product.index', $data);
    }
}
