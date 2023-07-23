<div class="main-nav d-lg-block d-none ">
    <div class="container-fluid px-lg-5 border-bottom">
        <div class="row">
            <div class="col-xl-12 col-md-12 d-flex justify-content-center">
                <nav class="navbar navbar-expand-lg nav-dark nav-primary-hover nav-line-active">
                    {{-- <a class="navbar-brand" href="{{ url('/') }}"><img class="nav-logo lazy"
                            data-src="{{ asset('assets/images/logo.png') }}" alt="Image not found !"></a> --}}
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="flaticon-menu-2 flat-small text-primary"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-md-2">
                            <li class="nav-item dropdown {{ request()->path() == '/' ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle"
                                    href="{{ url('/') }}">Home</a>
                            </li>
                            <li
                                class="nav-item dropdown {{ request()->path() == '/service_category' ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle"
                                    href="{{ url('/service_category') }}">{{ __('Service') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('vendor_list') }}">Shop</a>
                            </li>
                            <li class="nav-item dropdown mega-dropdown">
                                <a class="nav-link dropdown-toggle"
                                    href="{{ url('/category') }}">Product</a>
                                {{-- <ul class="dropdown-menu mega-dropdown-menu">
                                    <li class="mega-container">
                                        <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-1">

                                            @foreach (App\Category::where('status', 1)->take(4)->get() as $category)
                                                <div class="col">
                                                    <span
                                                        class="d-inline-block px-3 font-600 text-uppercase text-secondary pb-2">{{ $category->name }}</span>
                                                    <ul>
                                                        @if ($category->subs->count() > 0)
                                                            @foreach (App\Models\Subcategory::where('category_id', $category->id)->get() as $subcategory)
                                                                <li><a class="dropdown-item"
                                                                        href="{{ url('front/category', [$category->slug, $subcategory->slug]) }}{{ !empty(request()->input('search')) ? '?search=' . request()->input('search') : '' }}">{{ $subcategory->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        @endif

                                                    </ul>
                                                </div>
                                            @endforeach

                                        </div>
                                    </li>
                                </ul> --}}
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://slippa.unipuller.uk">{{ __('IT Solutions') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="https://ubs.unipuller.com/">{{ __('Business Solutions') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="https://slippa.unipuller.uk">{{ __('Digital Marketing') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://slippa.unipuller.uk">{{ __('Domain & Hosting') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://slippa.unipuller.uk">{{ __('Partner Boarding') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://ubs.unipuller.com/">{{ __('Sales Lead') }}</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>


        </div>

    </div>
</div>
<div class="header-sticky  py-10" style="background-color: #131921 !important">
    <div class="container">
        <div class="row align-items-center d-flex justify-content-between">
            <div class="col-xxl-2 col-xl-2 col-lg-2 col-6 order-lg-1">
                <div class="d-flex align-items-center h-100 md-py-10">
                    <div class="nav-leftpush-overlay">
                        <nav class="navbar navbar-expand-lg nav-general nav-primary-hover">
                            <button type="button" class="push-nav-toggle d-lg-none border-0">
                                <i class="flaticon-menu-2 flat-small text-primary"></i>
                            </button>
                            <div class="navbar-slide-push transation-this">
                                @if (Auth::user())
                                    <div
                                        class="login-signup bg-secondary d-flex justify-content-between py-10 px-20 align-items-center">
                                        <a href=""
                                            class="d-flex align-items-center text-white">

                                            <span>{{ __('Dashboard') }}</span>
                                        </a>
                                        <span class="slide-nav-close"><i
                                                class="flaticon-cancel flat-mini text-white"></i></span>
                                    </div>
                                @else
                                    <div
                                        class="login-signup bg-secondary d-flex justify-content-between py-10 px-20 align-items-center">
                                        <a href="{{ url('user_login') }}"
                                            class="d-flex align-items-center text-white">
                                            <i class="flaticon-user flat-small me-1"></i>
                                            <span>{{ __('Login') }}</span>
                                        </a>
                                        <a href="{{ url('user_register') }}"
                                            class="d-flex align-items-center text-white">
                                            <i class="flaticon-user flat-small me-1"></i>
                                            <span>{{ __('Signup') }}</span>
                                        </a>
                                        <span class="slide-nav-close"><i
                                                class="flaticon-cancel flat-mini text-white"></i></span>
                                    </div>
                                @endif

                                <div class="menu-and-category">
                                    <ul class="nav nav-pills wc-tabs" id="menu-and-category" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="pills-push-menu-tab" data-bs-toggle="pill"
                                                href="#pills-push-menu" role="tab" aria-controls="pills-push-menu"
                                                aria-selected="true">{{ __('Menu') }}</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="pills-push-categories-tab" data-bs-toggle="pill"
                                                href="#pills-push-categories" role="tab"
                                                aria-controls="pills-push-categories"
                                                aria-selected="true">{{ __('Categories') }}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="menu-and-categoryContent">
                                        <div class="tab-pane fade show active woocommerce-Tabs-panel woocommerce-Tabs-panel--description"
                                            id="pills-push-menu" role="tabpanel" aria-labelledby="pills-push-menu-tab">
                                            <div class="push-navbar">
                                                <ul class="navbar-nav">
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ url('/') }}">Home</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ url('front/service_category') }}">{{ __('Service') }}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ url('vendor_list') }}">Shop</a>
                                                    </li>
                                                    <li class="nav-item ">
                                                        <a class="nav-link"
                                                            href="{{ url('front/category') }}">Product</a>
                                                    </li>
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle"
                                                            href="#">{{ __('Pages') }}</a>
                                                        <ul class="dropdown-menu">
                                                            {{-- @foreach (DB::table('pages')->where('language_id', 1)->where('header', '=', 1)->get() as $data)
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('front.vendor', $data->slug) }}">{{ $data->title }}</a>
                                                                </li>
                                                            @endforeach --}}
                                                        </ul>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ url('front_blog') }}">Blog</a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ url('front_faq') }}">Faq</a>
                                                    </li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="{{ url('front_contact') }}">Contact</a>
                                                    </li>
                                                </ul>
                                                <a href="{{ url('front/category') }}"
                                                    class="p-20 d-block bg-secondary text-white text-uppercase font-600 hover-text-primary text-center">{{ __('Buy now!') }}</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-push-categories" role="tabpanel"
                                            aria-labelledby="pills-push-categories-tab">
                                            <div id="woocommerce_product_categories-4"
                                                class="widget woocommerce widget_product_categories widget-toggle">
                                                <h2 class="widget-title">{{ __('Product categories') }}</h2>
                                                <ul class="product-categories">
                                                    @foreach (App\Category::get() as $category)
                                                        <li class="cat-item cat-parent">
                                                            <a href="{{ url('front/category', $category->slug) }}{{ !empty(request()->input('search')) ? '?search=' . request()->input('search') : '' }}"
                                                                class="category-link"
                                                                id="cat">{{ $category->name }} <span
                                                                    class="count"></span></a>

                                                            {{-- @if ($category->subs->count() > 0)
                                                                <span class="has-child"></span>
                                                                <ul class="children">
                                                                    @foreach (App\Models\Subcategory::where('category_id', $category->id)->get() as $subcategory)
                                                                        <li class="cat-item cat-parent">
                                                                            <a href="{{ url('front/category', [$category->slug, $subcategory->slug]) }}{{ !empty(request()->input('search')) ? '?search=' . request()->input('search') : '' }}"
                                                                                class="category-link {{ isset($subcat) ? ($subcat->id == $subcategory->id ? 'active' : '') : '' }}">{{ $subcategory->name }}
                                                                                <span class="count"></span></a>


                                                                            @if ($subcategory->childs->count() != 0)
                                                                                <span class="has-child"></span>
                                                                                <ul class="children">
                                                                                    @foreach (DB::table('childcategories')->where('subcategory_id', $subcategory->id)->get() as $key => $childelement)
                                                                                        <li class="cat-item ">
                                                                                            <a href="{{ url('front/category', [$category->slug, $subcategory->slug, $childelement->slug]) }}{{ !empty(request()->input('search')) ? '?search=' . request()->input('search') : '' }}"
                                                                                                class="category-link {{ isset($childcat) ? ($childcat->id == $childelement->id ? 'active' : '') : '' }}">
                                                                                                {{ $childelement->name }}
                                                                                                <span
                                                                                                    class="count"></span></a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif --}}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <a class="navbar-brand" href="{{ url('/') }}"><img class="nav-logo lazy"
                            data-src="{{ asset('assets/images/logo.png') }}" alt="Image not found !"></a>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-2 col-lg-2 col-6 order-lg-3">
                <div class="d-flex align-items-center justify-content-end h-100 md-py-10">
                    <div class="sign-in my-account-dropdown position-relative">
                        <a href="my-account.html"
                            class="has-dropdown d-flex align-items-center text-white text-decoration-none">
                            <select name="currency" class="currency selectors nice">
                                @foreach (DB::table('currencies')->get() as $currency)
                                    <option value="{{ url('/front_currency', $currency->id) }}"
                                        {{-- {{ Session::has('currency')? (Session::get('currency') == $currency->id? 'selected': ''): (DB::table('currencies')->where('is_default', '=', 1)->first()->id == $currency->id? 'selected': '') }}> --}}
                                        {{-- <span class="text-dark">{{ Session::has('currency')? DB::table('currencies')->where('id', '=', Session::get('currency'))->first()->sign: DB::table('currencies')->where('is_default', '=', 1)->first()->sign }}</span> --}}
                                        {{-- {{ $currency->sign }} --}}
                                        {{-- {{ $currency->name }} --}}
                                    </option>
                                @endforeach
                            </select>
                        </a>
                    </div>
                    <div class="sign-in position-relative font-general my-account-dropdown ms-2">
                        <a href="my-account.html"
                            class="has-dropdown d-flex align-items-center text-dark text-decoration-none"
                            title="My Account">
                            @if (Auth::check())
                                <img class="img-fluid user lazy"
                                    data-src="{{ Auth::user()->photo ? asset('assets/images/users/' . Auth::user()->photo) : '<i class="flaticon-user-3 flat-mini mx-auto text-dark"></i>' }}"
                                    alt="">
                            @else
                                <i class="flaticon-user-3 flat-mini mx-auto text-dark"></i>
                            @endif
                        </a>
                        <ul class="my-account-popup">
                            @if (Auth::check())

                                <li><a href=""><span
                                            class="menu-item-text">{{ 'User Panel' }}</span></a></li>

                                <li><a href=""><span
                                            class="menu-item-text">{{ 'Edit Profile' }}</span></a></li>
                                <li><a href=""><span
                                            class="menu-item-text">{{ 'Logout' }}</span></a></li>
                            @else
                                <li><a href="{{ url('/user/login') }}"><span
                                            class="menu-item-text sign-in">{{ 'Sign in' }}</span></a></li>

                                <li><a href="{{ url('/user/register') }}"><span
                                            class="menu-item-text join">{{ 'Join' }}</span></a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="wishlist-view header-cart-1 ms-2">
                        @if (Auth::check())
                            <a href="" class="cart " title="View Wishlist">
                                <div class="cart-icon"><i class="flaticon-like flat-mini mx-auto text-dark"></i> <span
                                        class="header-cart-count "
                                        id="wishlist-count1">10</span></div>
                            </a>
                        @else
                            <a href="{{ url('user_login') }}" class="cart " title="View Wishlist">
                                <div class="cart-icon"><i class="flaticon-like flat-mini mx-auto text-dark"></i> <span
                                        class="header-cart-count" id="wishlist-count1">{{ 0 }}</span>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="refresh-view header-cart-1 mx-2">
                        <a href="{{ url('product_compare') }}" class="cart " title="View Wishlist">
                            <div class="cart-icon"><i class="flaticon-shuffle flat-mini mx-auto text-dark"></i> <span
                                    class="header-cart-count "
                                    id="compare-count1">{{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}</span>
                            </div>
                        </a>
                    </div>
                    <div class="header-cart-1">
                        <a href="{{ url('front_cart') }}" class="cart has-cart-data" title="View Cart">
                            <div class="cart-icon"><i class="flaticon-shopping-cart flat-mini"></i> <span
                                    class="header-cart-count"
                                    id="cart-count1">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                            </div>
                            <div class="cart-wrap">
                                <div class="cart-text">Cart</div>
                                <span
                                    class="header-cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                            </div>
                        </a>
                        {{-- @include('load.cart') --}}
                    </div>
                </div>
            </div>
            <div class="col-xxl-7 col-xl-6 col-lg-6 col-12 order-lg-2">
                <div class="product-search-one">
                    <form id="searchForm" class="search-form form-inline search-pill-shape" action=""
                        method="GET">

                        @if (!empty(request()->input('sort')))
                            <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                        @endif
                        @if (!empty(request()->input('minprice')))
                            <input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
                        @endif
                        @if (!empty(request()->input('maxprice')))
                            <input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
                        @endif
                        @php
                            $categoryType = request()->segment(1);
                        @endphp
                        @if ($categoryType == 'service_category' || $categoryType == 'category' )
                            <input type="text" id="prod_name_1" class="col form-control search-field "
                                name="search" placeholder="Search For"
                                value="{{ request()->input('search') }}">
                            <div class="autocomplete2">
                                <div id="myInputautocomplete-list2" class="autocomplete-items"></div>
                            </div>
                            {{-- <div class=" categori-container select-appearance-none mx-2" id="serviceSelectForm">
                            <select name="category" class="form-control select2 category_select">
                                <option selected disabled>{{ __('Select Category') }}</option>
                                @foreach (DB::table('categories')->where('language_id', 1)->where('status', 1)->get() as $data)
                                    <option value="{{ $data->slug }}"
                                        {{ Request::route('category') == $data->slug ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                        @else
                            <div class="select-appearance-none categori-container mx-2 " id="typeSelectFormSticky">
                                <select name="selectType" id="selectTypeSticky" class="form-control  type_select"
                                    onchange="searchCategorySticky()" required>
                                    <option value="">  Type </option>
                                    <option value="2"> Service </option>
                                    <option value="1"> Product </option>
                                </select>
                            </div>
                            <div class="select-appearance-none categori-container" id="catSelectFormSticky">
                                <span id="productCategorySticky">
                                    @php
                                        $collection1 = DB::table('categories')
                                            // ->where('language_id', 1)
                                            // ->where('status', 1)
                                            ->get();
                                        // $collection2 = DB::table('service_categories')
                                            // ->where('language_id', 1)
                                            // ->where('status', 1)
                                            // ->get();
                                        // $cats = $collection1->concat($collection2);
                                        $cats = $collection1;
                                    @endphp
                                    <select name="category" class="form-control select2 category_select ">
                                        <option selected disabled>{{ __('Select Category') }}</option>
                                        @foreach ($cats as $data)
                                            <option value="{{ $data->slug }}"
                                                {{ Request::route('category') == $data->slug ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </span>
                                <span id="serviceCategorySticky">
                                    <select name="category" class="form-control select2 category_select ">
                                        <option selected disabled>{{ __('Select Category') }}</option>
                                        {{-- @foreach (DB::table('service_categories')->where('language_id', 1)->where('status', 1)->get() as $data)
                                            <option value="{{ $data->slug }}"
                                                {{ Request::route('service_category') == $data->slug ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </span>

                            </div>
                            <input type="text" id="prod_name2" class="col form-control search-field"
                                name="search" placeholder="Search For"
                                value="{{ request()->input('search') }}">
                            <input type="hidden" name="searchProduct" value="product">
                            <div class="autocomplete2">
                                <div id="myInputautocomplete-list2" class="autocomplete-items"></div>
                            </div>
                        @endif


                        <button type="submit" name="submit" class="search-submit"><i
                                class="flaticon-search flat-mini text-white"></i></button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function searchCategorySticky() {
        var type = document.getElementById("selectTypeSticky").value;
        document.getElementById("catSelectFormSticky").style.display = "block"
        var form = document.getElementById("searchForm");
        console.log('form, type', form.action, type);
        // Change the action attribute (form path)
        if (type == '2') {
            document.getElementById("serviceCategorySticky").style.display = "block"
            document.getElementById("productCategorySticky").style.display = "none"
            form.action =
                "{{ url('front/service_category', [Request::route('service_category'), Request::route('subcategory'), Request::route('childcategory')]) }}";
            console.log('form', form.action);


        } else {
            document.getElementById("productCategorySticky").style.display = "block"
            document.getElementById("serviceCategorySticky").style.display = "none"
            form.action =
                "{{ url('front/category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')]) }}";
            console.log('form', form.action);
        }
    }
</script>
