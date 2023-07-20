<div class="top-header font-400 d-none d-lg-block text-general bg-white p-0">
    {{-- <div class="container-fluid">
        <div class="row align-items-center justify-content-end">
            <div class="col-12 border-bottom">
                <ul class="top-links text-general ms-auto  d-flex justify-content-end">
                    <li class="my-account-dropdown p-0">
                        <div class="language-selector nice-select">
                            <i class="fas fa-globe-americas text-dark"></i>
                            <select name="language" class="language selectors nice">
                                @foreach (DB::table('languages')->get() as $language)
                                    <option value="{{ route('front.language', $language->id) }}"
                                        {{ Session::has('language')? (Session::get('language') == $language->id? 'selected': ''): (DB::table('languages')->where('is_default', '=', 1)->first()->id == $language->id? 'selected': '') }}>
                                        {{ $language->language }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <li class="my-account-dropdown">
                        <div class="currency-selector nice-select">
                            <span
                                class="text-dark">{{ Session::has('currency')? DB::table('currencies')->where('id', '=', Session::get('currency'))->first()->sign: DB::table('currencies')->where('is_default', '=', 1)->first()->sign }}</span>
                            <select name="currency" class="currency selectors nice">
                                @foreach (DB::table('currencies')->get() as $currency)
                                    <option value="{{ url('/front_currency', $currency->id) }}"
                                        {{ Session::has('currency')? (Session::get('currency') == $currency->id? 'selected': ''): (DB::table('currencies')->where('is_default', '=', 1)->first()->id == $currency->id? 'selected': '') }}>
                                        {{ $currency->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    @if ($gs->reg_vendor == 1)
                        <div class=" align-items-center text-general pt-1">
                            @if (Auth::check())
                                @if (Auth::guard('web')->user()->is_vendor == 2)
                                    <a href="{{ route('vendor.dashboard') }}" class="sell-btn ">
                                        {{ __('Sell') }}</a>
                                @else
                                    <a href="{{ route('user-package') }}" class="sell-btn "> {{ __('Sell') }}</a>
                                @endif
                        </div>
                    @else
                        <div class=" align-items-center text-general pt-1">
                            <a href="{{ route('vendor.login') }}" class="sell-btn "> {{ __('Sell') }}</a>
                        </div>
                    @endif
                    @endif
                </ul>
            </div>

        </div>

    </div> --}}
    <div class="container-fluid middle-nav-bar">
        <div class="row align-items-center justify-content-end  py-3">
            <div class="col-lg-3 sm-mx-none">
                <div class="d-flex align-items-center  text-general">
                    <i class="flaticon-phone-call flat-mini me-2 text-general"></i>
                    <a class="navbar-brand p-0" href="{{ url('/') }}"><img class="nav-logo lazy"
                            data-src="{{ asset('assets/images/logo.png') }}" width="120"
                            alt="Image not found !"></a>
                </div>
            </div>
            <div class="col-lg-6 sm-mx-none">
                @php
                    $categoryType = request()->segment(1);
                    $lastSegment = request()->segment(2);

                @endphp
                @if ($categoryType != 'service_category' && $categoryType != 'category' && $categoryType!='shop' && $lastSegment !='list'  )
                    <div class="product-search-one flex-grow-1 global-search">
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
                            {{-- <input type="text" id="prod_name" class="col form-control search-field " name="search"
                            placeholder="Search Product For" value="{{ request()->input('search') }}">
                        <div class=" categori-container select-appearance-none mx-2" id="serviceSelectForm">
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
                            <div class="select-appearance-none categori-container mx-2" id="typeSelectForm">
                                <select name="selectType" id="selectType" class="form-control  type_select"
                                    onchange="searchCategory()" required>
                                    <option value=""> Type </option>
                                    <option value="2"> Service </option>
                                    <option value="1"> Product </option>
                                </select>
                            </div>
                            <div class="select-appearance-none categori-container " id="catSelectForm">
                                <span id="productCategory">
                                    <select name="category" class="form-control select2 category_select ">
                                        <option selected disabled>{{ __('Select Category ') }}</option>
                                        {{-- @foreach (DB::table('categories')->where('language_id', 1)->where('status', 1)->get() as $data)
                                            <option value="{{ $data->slug }}"
                                                {{ Request::route('category') == $data->slug ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </span>
                                <span id="serviceCategory">
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
                            <input type="text" id="prod_name2" class="col form-control search-field" name="search"
                                placeholder="Search For" value="{{ request()->input('search') }}">
                                <input type="hidden" name="searchProduct" value="product">


                            <button type="submit" name="submit" class="search-submit"><i
                                    class="flaticon-search flat-mini text-white"></i></button>

                        </form>
                    </div>
                    <div class="autocomplete">
                        <div id="myInputautocomplete-list" class="autocomplete-items"></div>
                    </div>
                @endif

            </div>
            <div class="col-lg-3">
                {{-- <ul class="top-links text-general ms-auto  d-flex justify-content-end">
                   <li class="my-account-dropdown p-0">
                      <div class="language-selector nice-select">
                         <i class="fas fa-globe-americas text-dark"></i>
                         <select name="language" class="language selectors nice">
                         @foreach (DB::table('languages')->get() as $language)
                         <option value="{{route('front.language',$language->id)}}" {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }} >
                         {{$language->language}}
                         </option>
                         @endforeach
                         </select>
                      </div>
                   </li>
                   <li class="my-account-dropdown px-1">
                      <div class="currency-selector nice-select">
                         <span class="text-dark">{{ Session::has('currency') ? DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign }}</span>
                         <select name="currency" class="currency selectors nice">
                         @foreach (DB::table('currencies')->get() as $currency)
                         <option value="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}>
                         {{$currency->name}}
                         </option>
                         @endforeach
                         </select>
                      </div>
                   </li>
                   @if ($gs->reg_vendor == 1)
                   <div class=" align-items-center text-general sell">
                      @if (Auth::check())
                      @if (Auth::guard('web')->user()->is_vendor == 2)
                      <a href="{{ route('vendor.dashboard') }}" class="sell-btn "> {{ __('Sell') }}</a>
                      @else
                      <a href="{{ route('user-package') }}" class="sell-btn "> {{ __('Sell') }}</a>
                      @endif
                   </div>
                   @else
                   <div class=" align-items-center text-general">
                      <a href="{{ route('vendor.login') }}" class="sell-btn "> {{ __('Sell') }}</a>
                   </div>
                   @endif
                   @endif
                </ul> --}}
                <div class="margin-right-1 d-flex align-items-center justify-content-end h-100">
                    <div class="product-search-one flex-grow-1 global-search touch-screen-view">
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
                            {{-- <input type="text" id="prod_name" class="col form-control search-field " name="search"
                                placeholder="Search Product For" value="{{ request()->input('search') }}">
                            <div class=" categori-container select-appearance-none mx-2" id="serviceSelectForm">
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
                            <div class="select-appearance-none categori-container mx-2 border-end" id="typeSelectForm">
                                <select name="type" class="form-control  type_select" required>
                                    <option value=""> Type </option>
                                    <option value="service"> Service </option>
                                    <option value="product"> Product </option>
                                </select>
                            </div>
                            <div class="select-appearance-none categori-container " id="catSelectForm">
                                <span id="productCategory">
                                    <select name="category" class="form-control select2 category_select ">
                                        <option selected disabled>{{ __('Select Category') }}</option>
                                        {{-- @foreach (DB::table('categories')->where('language_id', 1)->where('status', 1)->get() as $data)
                                            <option value="{{ $data->slug }}"
                                                {{ Request::route('category') == $data->slug ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </span>
                                <span id="serviceCategory">
                                    <select name="category" class="form-control select2 category_select ">
                                        <option selected disabled>{{ __('Select Service Category') }}</option>
                                        {{-- @foreach (DB::table('service_categories')->where('language_id', 1)->where('status', 1)->get() as $data)
                                            <option value="{{ $data->slug }}"
                                                {{ Request::route('service_category') == $data->slug ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </span>
                            </div>
                            <input type="text" id="prod_name2" class="col form-control search-field" name="search"
                                placeholder="Search For" value="{{ request()->input('search') }}">


                            <button type="submit" name="submit" class="search-submit"><i
                                    class="flaticon-search flat-mini text-white"></i></button>

                        </form>
                    </div>
                  

                    <div class="sign-in my-account-dropdown position-relative">
                        <a href="my-account.html"
                            class="has-dropdown d-flex align-items-center text-white text-decoration-none">
                            <select name="currency" class="currency selectors nice">
                                @foreach (DB::table('currencies')->get() as $currency)
                                    <option value="{{ url('/front_currency', $currency->id) }}"
                                        {{-- {{ Session::has('currency')? (Session::get('currency') == $currency->id? 'selected': ''): (DB::table('currencies')->where('is_default', '=', 1)->first()->id == $currency->id? 'selected': '') }}> --}}
                                        {{-- <span class="text-dark">{{ Session::has('currency')? DB::table('currencies')->where('id', '=', Session::get('currency'))->first()->sign: DB::table('currencies')->where('is_default', '=', 1)->first()->sign }}</span> --}}
                                        {{-- {{$currency->sign}} --}}
                                        {{-- {{ $currency->name }} --}}
                                    </option>
                                @endforeach
                            </select>
                        </a>
                    </div>
                    <div class="sign-in my-account-dropdown position-relative">
                        <a href="my-account.html"
                            class="has-dropdown d-flex align-items-center text-white text-decoration-none">
                            @if (Auth::check())
                                <img class="img-fluid user lazy"
                                    data-src="{{ asset('assets/images/users/' . Auth::user()->photo) }}"
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
                    {{-- <div class="search-view d-xxl-none"> commented by huma
                           <a href="#"
                               class="search-pop top-quantity d-flex align-items-center text-decoration-none">
                               <i class="flaticon-search flat-mini text-dark mx-auto"></i>
                           </a>
                       </div> --}}
                    <div class="header-cart-1">
                        @if (Auth::check())
                            <a href="" class="cart " title="View Wishlist">
                                <div class="cart-icon"><i class="flaticon-like flat-mini mx-auto text-dark"></i> <span
                                        class="header-cart-count "
                                        id="wishlist-count">10</span></div>
                            </a>
                        @else
                            <a href="{{ url('user_login') }}" class="cart " title="View Wishlist">
                                <div class="cart-icon"><i class="flaticon-like flat-mini mx-auto text-dark"></i> <span
                                        class="header-cart-count" id="wishlist-count">{{ 0 }}</span>
                                </div>
                            </a>
                        @endif
                    </div>

                    <div class="header-cart-1">
                        <a href="{{ url('product_compare') }}" class="cart " title="Compare">
                            <div class="cart-icon"><i class="flaticon-shuffle flat-mini mx-auto text-dark"></i> <span
                                    class="header-cart-count "
                                    id="compare-count">{{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}</span>
                            </div>
                        </a>
                    </div>

                    <div class="header-cart-1">
                        <a href="{{ url('front_cart') }}" class="cart has-cart-data" title="View Cart">
                            <div class="cart-icon"><i class="flaticon-shopping-cart flat-mini"></i> <span
                                    class="header-cart-count"
                                    id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
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
        </div>
    </div>
</div>
<script>
    function searchCategory() {
        var type = document.getElementById("selectType").value;
        document.getElementById("catSelectForm").style.display = "block"
        var form = document.getElementById("searchForm");
        console.log('form, type', form.action, type);
        // Change the action attribute (form path)
        if (type == '2') {
            document.getElementById("serviceCategory").style.display = "block"
            document.getElementById("productCategory").style.display = "none"
            form.action =
                "{{ url('front/service_category', [Request::route('service_category'), Request::route('subcategory'), Request::route('childcategory')]) }}";
            console.log('form', form.action);


        } else {
            document.getElementById("productCategory").style.display = "block"
            document.getElementById("serviceCategory").style.display = "none"
            form.action =
                "{{ url('front/category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')]) }}";
            console.log('form', form.action);
        }
    }
</script>
