@php
    $user = Auth::user();
@endphp

<style>
    .custom-dropdown-item {
        text-transform: uppercase;
    }

    .active-dropdown-item {
        color: #c9030f;
    }
</style>

<div class="main-nav d-lg-block d-none ">
    <div class="container-fluid px-lg-5 border-bottom">
        <div class="row">
            <div class="col-xl-12 col-md-12 d-flex justify-content-center">
                <nav class="navbar navbar-expand-lg nav-dark nav-primary-hover nav-line-active">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="flaticon-menu-2 flat-small text-primary"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-md-2">
                            <li class="nav-item dropdown {{ request()->path() == '/' ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="{{ url('/') }}">Home</a>
                            </li>

                            <li
                                class="nav-item dropdown mega-dropdown {{ request()->routeIs(['property.list', 'propertyFindingService', 'landlordeService', 'tenant_management_service']) ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="{{ route('property.list') }}">Property</a>
                                <ul class="dropdown-menu mega-dropdown-menu">
                                    <li class="mega-container">
                                        <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-1">
                                            <div class="col">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item custom-dropdown-item {{ request()->routeIs('property.list') ? 'active-dropdown-item' : '' }}"
                                                            href="{{ route('property.list') }}">Property List</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item custom-dropdown-item {{ request()->routeIs('propertyFindingService') ? 'active-dropdown-item' : '' }}"
                                                            href="{{ route('propertyFindingService') }}">Property
                                                            Finding Service</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item custom-dropdown-item {{ request()->routeIs('landlordeService') ? 'active-dropdown-item' : '' }}"
                                                            href="{{ route('landlordeService') }}">Landlord Service</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item custom-dropdown-item {{ request()->routeIs('tenant_management_service') ? 'active-dropdown-item' : '' }}"
                                                            href="{{ route('tenant_management_service') }}">Tenant
                                                            Management Service</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item {{ request()->routeIs('service.list') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('service.list') }}">Service</a>
                            </li>
                            {{-- <li class="nav-item {{ request()->routeIs('product.list') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('product.list') }}">Product</a>
                            </li> --}}

                            <li class="nav-item {{ request()->routeIs('shop.list') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('shop.list') }}">Shop</a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('itSolutions') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('itSolutions') }}">IT Solutions</a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('businessSolutions') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('businessSolutions') }}">Business Solutions</a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('digitalMarketing') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('digitalMarketing') }}">Digital Marketing</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="https://shop.unipuler.com/" target="__blank">Domain &
                                    Hosting</a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('partnerBoarding') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('partnerBoarding') }}">Partner Boarding</a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('recruitment.list') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('recruitment.list') }}">Jobs</a>
                            </li>



                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('service.list') }}">Service</a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('education.list') }}">Education</a>
                            </li> --}}
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
            <div class="col-xxl-2 col-xl-2 col-lg-2 col-12 order-lg-1">
                <div class="d-flex align-items-center justify-content-between h-100 md-py-10">
                    <a href="{{ url('/') }}">
                        <img class="d-block d-md-none" src="{{ asset('assets/images/logo.png') }}" alt=""
                            style="width: 170px;">
                    </a>
                    <div class="nav-leftpush-overlay">
                        <nav class="navbar navbar-expand-lg nav-general nav-primary-hover">
                            <button type="button" class="push-nav-toggle d-lg-none border-0">
                                <i class="flaticon-menu-2 flat-small text-primary"></i>
                            </button>
                            <div class="navbar-slide-push transation-this">
                                @if (Auth::user())
                                    <div
                                        class="login-signup bg-secondary d-flex justify-content-between py-10 px-20 align-items-center">
                                        <span class="slide-nav-close"><i
                                                class="flaticon-cancel flat-mini text-white"></i></span>
                                    </div>
                                @else
                                    <div
                                        class="login-signup bg-secondary d-flex justify-content-end py-10 px-20 align-items-center">
                                        <a href="{{ url('user_login') }}" class="d-none align-items-center text-white">
                                            <i class="flaticon-user flat-small me-1"></i>
                                            <span>{{ __('Login') }}</span>
                                        </a>
                                        <a href="{{ url('user_register') }}"
                                            class="d-none align-items-center text-white">
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
                                            @if (!$user)
                                                <a class="nav-link" href="{{ url('login') }}">Login/ Register</a>
                                            @endif
                                            @if ($user && $user->user_type == 'user')
                                                <a class="nav-link" href="{{ url('home') }}">Dashboard</a>
                                            @endif
                                            @if ($user && $user->user_type == 'user_customer')
                                                <a class="nav-link"
                                                    href="{{ url('contact/contact-dashboard') }}">Dashboard</a>
                                            @endif
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="menu-and-categoryContent">
                                        <div class="tab-pane fade show active woocommerce-Tabs-panel woocommerce-Tabs-panel--description"
                                            id="pills-push-menu" role="tabpanel"
                                            aria-labelledby="pills-push-menu-tab">
                                            <div class="push-navbar">
                                                <ul class="navbar-nav">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                                                    </li>


                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle"
                                                            href="#">Property</a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('property.list') }}">Property</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('propertyFindingService') }}">Property
                                                                    Finding Service</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('landlordeService') }}">Landlord
                                                                    Service</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('tenant_management_service') }}">Tenant
                                                                    Management Service</a>
                                                            </li>
                                                        </ul>
                                                    </li>



                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link"
                                                            href="{{ route('service.list') }}">Service</a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ url('/shop/list') }}">Shop</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ url('/it-solutions') }}">It
                                                            Solutions</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ url('/business-solutions') }}">Business
                                                            Solutions</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ url('/digital-marketing') }}">Digital
                                                            Marketing</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="https://shop.unipuler.com/"
                                                            target="__blank">Domain
                                                            & Hosting</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ url('/partner-boarding') }}">Partner
                                                            Boarding</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ url('/recruitment/list') }}">Jobs</a>
                                                    </li>
                                                    {{-- <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ url('/education-list') }}">Education</a>
                                                    </li> --}}
                                                </ul>

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
                    <a class="navbar-brand" style="margin-right: -64px !important;" href="{{ url('/') }}"><img
                            class="nav-logo lazy" data-src="{{ asset('assets/images/logo.png') }}"
                            alt="Image not found !"></a>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-2 col-lg-2 col-0 order-lg-3">
                <div class="d-none d-md-flex align-items-center justify-content-end h-100 md-py-10">
                    <div class="dropdown sign-in my-account-dropdown position-relative">
                        <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                        <ul class="dropdown-menu">
                            @if ($user && $user->user_type == 'user_customer')
                                <li><a class="dropdown-item"
                                        href="{{ url('contact/contact-dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ url('logout') }}">Logout</a></li>
                            @endif
                            @if ($user && $user->user_type == 'user')
                                <li><a class="dropdown-item" href="{{ url('home') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ url('logout') }}">Logout</a></li>
                            @endif
                            @if (!$user)
                                <li><a class="dropdown-item" href="{{ url('login') }}">Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                {{-- @if ($user && $user->user_type == 'user')
                    <div class="d-flex align-items-center justify-content-end h-100 md-py-10">
                        <div class="sign-in my-account-dropdown position-relative">
                            <a href="{{ url('home') }}"
                                class="d-flex align-items-center text-white text-decoration-none">
                            </a>
                        </div>
                        <div class="sign-in my-account-dropdown position-relative">
                            <a href="{{ url('logout') }}"
                                class="d-flex align-items-center text-white text-decoration-none">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                        </div>
                    </div>
                @endif --}}
            </div>
            <div class="col-xxl-7 col-xl-6 col-lg-6 col-12 order-lg-2 search-bar-mobile-view d-none">
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
                        @if ($categoryType == 'service_category' || $categoryType == 'category')
                            <input type="text" id="prod_name_1" class="col form-control search-field "
                                name="search" placeholder="Search For" value="{{ request()->input('search') }}">
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
                                    <option value=""> Type </option>
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
                                name="search" placeholder="Search For" value="{{ request()->input('search') }}">
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
