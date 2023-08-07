<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{Product, Category, ServiceCategory, Subcategory, Childcategory, Report};
use App\Country;
use App\State;
use App\UserService;
use Illuminate\Support\Facades\Session;

class CatalogController extends Controller
{
    public function categories()
    {
        return view('frontend.pages.product.index');

    }

    public function category(Request $request, $slug = null, $slug1 = null, $slug2 = null, $slug3 = null, $kind = null)
    {
        if ($request->view_check) {
            session::put('view', $request->view_check);
        }

        //   dd(session::get('view'));

        $cat = null;
        $subcat = null;
        $childcat = null;
        $flash = null;
        $minprice = $request->min;
        $maxprice = $request->max;
        $sort = $request->sortby;
        $search = $request->search;
        $pageby = $request->pageby;
        $minprice = $minprice / $this->curr->value;
        $maxprice = $maxprice / $this->curr->value; 
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

        if (!empty($slug1)) {
            $subcat = Subcategory::where('slug', $slug1)->firstOrFail();
            $data['subcat'] = $subcat;
        }
        if (!empty($slug2)) {
            $childcat = Childcategory::where('slug', $slug2)->firstOrFail();
            $data['childcat'] = $childcat;
        }

        $data['latest_products'] = Product::with('user')
            ->whereStatus(1)
            ->whereLatest(1)
            ->home($this->language->id)
            ->get()
            ->reject(function ($item) {
                if ($item->user_id != 0) {
                    if ($item->user->is_vendor != 2) {
                        return true;
                    }
                }
                return false;
            });

        $prods = Product::when($cat, function ($query, $cat) {
            return $query->where('category_id', $cat->id);
        })
            ->when($subcat, function ($query, $subcat) {
                return $query->where('subcategory_id', $subcat->id);
            })
            ->when($type, function ($query, $type) {
                return $query
                    ->with('user')
                    ->whereStatus(1)
                    ->whereIsDiscount(1)
                    ->where('discount_date', '>=', date('Y-m-d'))
                    ->whereHas('user', function ($user) {
                        $user->where('is_vendor', 2);
                    });
            })
            ->when($childcat, function ($query, $childcat) {
                return $query->where('childcategory_id', $childcat->id);
            })
            ->when($minprice, function ($query, $minprice) {
                return $query->where('price', '>=', $minprice);
            })
            ->when($maxprice, function ($query, $maxprice) {
                return $query->where('price', '<=', $maxprice);
            })
            ->when($sort, function ($query, $sort) {
                if ($sort == 'date_desc') {
                    return $query->latest('id');
                } elseif ($sort == 'date_asc') {
                    return $query->oldest('id');
                } elseif ($sort == 'price_desc') {
                    return $query->latest('price');
                } elseif ($sort == 'price_asc') {
                    return $query->oldest('price');
                }
            })
            ->when(empty($sort), function ($query, $sort) {
                return $query->latest('id');
            });

        $prods = $prods->where(function ($query) use ($cat, $subcat, $childcat, $type, $request) {
            $flag = 0;
            if (!empty($cat)) {
                foreach ($cat->attributes as $key => $attribute) {
                    $inname = $attribute->input_name;
                    $chFilters = $request["$inname"];

                    if (!empty($chFilters)) {
                        $flag = 1;
                        foreach ($chFilters as $key => $chFilter) {
                            if ($key == 0) {
                                $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
                            } else {
                                $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
                            }
                        }
                    }
                }
            }

            if (!empty($subcat)) {
                foreach ($subcat->attributes as $attribute) {
                    $inname = $attribute->input_name;
                    $chFilters = $request["$inname"];

                    if (!empty($chFilters)) {
                        $flag = 1;
                        foreach ($chFilters as $key => $chFilter) {
                            if ($key == 0 && $flag == 0) {
                                $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
                            } else {
                                $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
                            }
                        }
                    }
                }
            }

            if (!empty($childcat)) {
                foreach ($childcat->attributes as $attribute) {
                    $inname = $attribute->input_name;
                    $chFilters = $request["$inname"];

                    if (!empty($chFilters)) {
                        $flag = 1;
                        foreach ($chFilters as $key => $chFilter) {
                            if ($key == 0 && $flag == 0) {
                                $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
                            } else {
                                $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
                            }
                        }
                    }
                }
            }
        });

        $prods = $prods
            ->where('language_id', $this->language->id)
            ->where('status', 1)
            ->where('category_type', 1)
            ->when($country, function ($query, $country) {
                if (is_array($country)) {
                    $query->where(function ($q) use ($country) {
                        foreach ($country as $cty) {
                            if ($cty !== 'all') {
                                $q->orWhereJsonContains('country_id', $cty);
                            }
                        }
                    });
                }
            })
            ->when($city, function ($query, $city) {
                if (is_array($city)) {
                    $query->where(function ($q) use ($city) {
                        foreach ($city as $cit) {
                            if ($cit !== 'all') {
                                $q->orWhereJsonContains('city_id', $cit);
                            }
                        }
                    });
                }
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')->orWhere('name', 'like', $search . '%');
                });
            })
            ->get()
            ->reject(function ($item) {
                if ($item->user_id != 0) {
                    if ($item->user->is_vendor != 2) {
                        return true;
                    }
                }

                if (isset($_GET['max'])) {
                    if ($item->vendorSizePrice() >= $_GET['max']) {
                        return true;
                    }
                }
                return false;
            })
            ->map(function ($item) {
                $item->price = $item->vendorSizePrice();
                return $item;
            })
            ->paginate(isset($pageby) ? $pageby : $this->gs->page_count);
        $data['prods'] = $prods;
        $data['countries'] = Country::where('status', 1)
            ->orderby('id', 'asc')
            ->get();
        //    dd($data['prods']);
        if ($request->ajax()) {
            $data['ajax_check'] = 1;
            return view('frontend.ajax.category', $data);
        }

        return view('frontend.pages.product.index', $data);
    }
}


