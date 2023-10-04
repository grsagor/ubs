@extends('frontend.layouts.master_layout')
@section('content')
    @includeIf('frontend.partials.global.common-header')
    <div class="shop-list-page">
        <div class="full-row bg-light overlay-dark py-5"
            style="background-image: url(https://www.unipuller.com/assets/images/1678212738up-mailphp.php); background-position: center center; background-size: cover;">
            <div class="container">
                <div class="row text-center text-white">
                    <div class="col-12">
                        <h3 class="mb-2 text-white"></h3>
                    </div>
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Shop List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <!-- breadcrumb -->
        <div class="shop-list-page">
            {{--   <div class="full-row bg-light overlay-dark py-5"
            style="background-image: url({{ $gs->breadcrumb_banner ? asset('assets/images/' . $gs->breadcrumb_banner) : asset('assets/images/noimage.png') }}); background-position: center center; background-size: cover;">
            <div class="container">
                <div class="row text-center text-white">
                    <div class="col-12">
                        <h3 class="mb-2 text-white"></h3>
                    </div>
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                                <li class="breadcrumb-item"><a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Shop List') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div> --}}
            <!-- breadcrumb -->

            <style>
                .product-wrapper .product-info .product-title,
                .product-wrapper .product-info .product-title a {
                    font-weight: 400;
                    font-size: 22px;
                }
            </style>

            {{-- There are two product page. you have to give condition here --}}
            <div class="mt-2 content-circle">
                <div class="container">
                    <div class="row mobile-reverse">
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                            <div class="row ">
                                <div class="col-lg-12 col-md-4 col-sm-6 d-flex align-content-stretch flex-wrap">
                                    <div class="advertise-banner">
                                        <h5 class="text-center px-4 mt-3">Create Your Free Business Profile</h5>
                                        <img class="text-center mb-2"
                                            src="{{ asset('/assets/front/images/services/social.png') }}" alt="">

                                        <p> <span><i class="fa fa-check"></i></span> Help us improve by letting us know</p>
                                        {{-- <p> <span><i class="fa fa-check"></i></span> Help us improve by letting us know</p> --}}
                                        {{-- <p> <span><i class="fa fa-check"></i></span> Help us improve by letting us know</p> --}}
                                        {{-- <p> <span><i class="fa fa-check"></i></span> Help us improve by letting us know</p> --}}
                                        <div class="d-flex mt-3 justify-content-between">
                                            <a href="#" target="_blank"><a class="btn btn-dark mr-2">Get
                                                    Started</a></a>
                                            <a href="#" class="btn btn-dark">Suggest edit</a>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12 col-md-4 col-sm-6 d-flex align-content-stretch flex-wrap">
                                <div class="advertise-box">
                                    <h6 class="text-center">See Anything wrong with this listing</h6>
                                    <p>Help us improve by letting us know</p>
                                    <a href="#" class="btn btn-primary">Suggest edit</a>
                                </div>
                            </div> --}}
                                {{-- <div class="col-lg-12 col-md-4 col-sm-6 d-flex align-content-stretch flex-wrap">
                                <div class="advertise-box">
                                    <h6 class="text-center">Is this your business</h6>
                                    <p>By claiming this business you can update and control company information</p>
                                    <a href="#" class="btn btn-primary">Claim Your Business</a>
                                </div>
                            </div> --}}
                                {{-- <div class="col-lg-12 col-md-4 col-sm-6 d-flex align-content-stretch flex-wrap">
                                <div class="advertise-box bg-sea-green">
                                    <h6 class="text-center">Real-Estate</h6>
                                    <img class="text-center mb-2" src="{{ asset('/assets/front/images/services/social.png') }}"
                                        alt="">
                                    <p> we take pride in providing exceptional services to assist you in fin
                                        ding your dream property. Whether you're looking for a cozy apartmen
                                        t, a spacious family home, or a commercial space for your business,
                                        we have a wide range of options to suit your needs.</p>
                                    <a class="btn btn-primary">Claim Your Business</a>
                                    <a href="#" class="btn  btn-dark">Get Job</a>

                                </div>
                            </div> --}}
                                {{-- <div class="col-lg-12 col-md-4 col-sm-6 d-flex align-content-stretch flex-wrap">
                                <div class="advertise-box">
                                    <h6 class="text-center">Our UBS System</h6>
                                    <p>Our UBS is a comprehensive solution designed to streamline and optimize various aspects of managing a business. It encompasses a wide range of functionalities and tools that help organizations effectively handle their operations, resources, and processes.</p>
                                    <a class="btn btn-primary">Claim Your Business</a>
                                    <a href="#" class="btn  btn-dark">Get System Services</a>
                                </div>
                            </div> --}}
                                {{-- <div class="col-lg-12 col-md-4 col-sm-6 d-flex align-content-stretch flex-wrap">
                                <div class="advertise-box bg-sea-green">
                                    <h6 class="text-center">Technology Services</h6>
                                    <img class="text-center mb-2" src="{{ asset('/assets/front/images/services/app-dev.png') }}"
                                        alt="">
                                    <p>We provide the following services:</p>
                                    <p> <span><i class="fa fa-check"></i></span> Application Development</p>
                                    <p> <span><i class="fa fa-check"></i></span> Web Development</p>
                                    <p> <span><i class="fa fa-check"></i></span> Cyber Security Service</p>
                                    <p> <span><i class="fa fa-check"></i></span> Web designing and services</p>
                                    <a class="btn btn-primary">Claim Your Business</a>
                                    <a href="#" class="btn  btn-dark">Get Technolgy
                                        services</a>
                                </div>
                            </div> --}}
                                {{-- <div class="col-lg-12 col-md-4 col-sm-6 d-flex align-content-stretch flex-wrap">
                                <div class="advertise-box">
                                    <h6 class="text-center">Domain Hosting</h6>
                                    <img class="text-center mb-2" src="{{ asset('/assets/front/images/services/social.png') }}"
                                        alt="">
                                    <p>we are dedicated to providing reliable and secure hosting solutions for your online presence.
                                        We understand the importance of having a robust and accessible website, and we strive to
                                        ensure that your domain and hosting needs.</p>
                                    <a class="btn btn-primary">Claim Your Business</a>
                                    <a href="https://slippa.unipuller.uk/" class="btn  btn-dark">Get Domain</a>
                                </div>
                            </div> --}}
                                {{-- <div class="col-lg-12 col-md-4 col-sm-6 d-flex align-content-stretch flex-wrap">
                                <div class="advertise-box">
                                    <h6 class="text-center">Book a Service</h6>
                                    <img class="text-center mb-2" src="{{ asset('/assets/front/images/services/social.png') }}"
                                        alt="">
                                    <p>we provide all kind of professional services. All professional working under our hood are experienced and easy to approach </p>
                                    <p> <span><i class="fa fa-check"></i></span> Experienced doctors</p>
                                    <p> <span><i class="fa fa-check"></i></span> Professional lawyers</p>
                                    <p> <span><i class="fa fa-check"></i></span> Engineers</p>

                                    <a class="btn btn-primary">Claim Your Business</a>
                                    <a href="#" class="btn  btn-dark">Get Service</a>
                                </div>
                            </div> --}}
                            </div>

                            {{-- <div class="advertise-box">
                            <h6 class="text-center">Buy and Sell Products</h6>
                            <img class="text-center mb-2" src="{{ asset('/assets/front/images/services/sell-product.png') }}"
                                alt="">
                            <p>we strive to connect buyers and sellers in a seamless and efficient manner. We understand the importance of finding the right products or selling your items to interested buyers, and we are here to facilitate that process.</p>
                            <a href="#" class="btn  btn-dark">Buy & Sell Products</a>
                        </div> --}}
                        </div>


                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
                            <div class="product-search-one">
                                <form id="searchForm" class="search-form form-inline search-pill-shape bg-white"
                                    action="{{ route('shop.list') }}" method="GET">
                                    <div class="select-appearance-none categori-container" id="countryForm">
                                        <select name="country" class="form-control categoris mx-2" id="country_select">
                                            <option selected="" value="">{{ __('Select Country') }}</option>
                                            @foreach (DB::table('countries')->where('status', 1)->orderby('id', 'desc')->get() as $data)
                                                <option value="{{ $data->country_name }}">
                                                    {{ $data->country_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="text" id="shop_name" class="col form-control search-field"
                                        name="search" placeholder="Search Location or Shop For"
                                        value="{{ request()->input('search') }}">

                                    <div class="select-appearance-none categori-container" id="catSelectForm">
                                        <select name="category" class="form-control categoris" id="category_select">
                                            <option disabled selected="">{{ __('Select Categories') }}</option>
                                            {{-- @foreach (DB::table('categories')->where('language_id', $langg->id)->where('status', 1)->get() as $data)
                                            <option value="{{ $data->slug }}"
                                                {{ request()->input('category') == $data->slug ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                        @endforeach --}}
                                        </select>
                                    </div>
                                    <a type="submit" name="submit" class="search-submit"><i
                                            class="flaticon-search flat-mini text-white"></i></a>
                                </form>
                            </div>
                            <div class="shopautocomplete2 position-relative">
                                <div id="shopmyInputautocomplete-list2" class="autocomplete-items"></div>
                            </div>
                            <div class="mb-4 d-none">
                                <a class="dashboard-sidebar-btn btn bg-primary rounded">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>

                            <div class="showing-products pt-30 pb-50 border-2 border-bottom border-light" id="ajaxContent">
                                @if (count($vendors) > 0)
                                    <div
                                        class="row row-cols-xxl-2 px-3 row-cols-md-2 mb-4 row-cols-1 g-3 product-style-1 shop-list product-list  e-title-hover-primary e-hover-image-zoom">
                                        @php
                                            $key = 0;
                                        @endphp
                                        @foreach ($vendors as $vendor)
                                            <div class="col">
                                                @php
                                                    $key += 1;
                                                @endphp
                                                <div class="product type-product rounded ">
                                                    <div class=" row m-0">
                                                        <div
                                                            class="  col-lg-4 col-md-4 col-sm-12 d-flex align-items-center card-image">
                                                            <a href="{{ route('shop.service', $vendor->id) }}"
                                                                class="woocommerce-LoopProduct-link">
                                                                <img class="lazy img-fluid rounded"
                                                                    data-src="{{ $vendor->logo ? asset('assets/images/categories/' . $vendor->logo) : asset('assets/common_img/vendor_profile.jpeg') }}"
                                                                    alt="Product Image">
                                                            </a>

                                                            <div class="hover-area">

                                                            </div>
                                                        </div>
                                                        <div class=" col-lg-8 col-md-8 col-sm-12 p-0">
                                                            <div class="p-4">
                                                                <h5 class="product-title large_screen  mb-0 ">
                                                                    <a class="text-dark"
                                                                        href="{{ route('shop.service', $vendor->id) }}">
                                                                        <span class="company-name">
                                                                            {{ $vendor->name }}</span>
                                                                    </a>
                                                                </h5>
                                                                <h5 class="product-title small_screen  mb-0"
                                                                    style="display: none">
                                                                    <a class="text-dark"
                                                                        href="{{ route('shop.service', $vendor->id) }}">
                                                                        <span class="company-name">
                                                                            {{ $vendor->name }}</span>
                                                                    </a>
                                                                </h5>
                                                                <hr class="mt-0">
                                                                <p class="category_text text-dark">
                                                                    {{ $vendor->subcategory }}</p>
                                                                <p class="about_line  text-dark"> {{ $vendor->about_info }}
                                                                </p>
                                                            </div>
                                                            <div class="d-flex text-center"
                                                                style="background-color: whitesmoke;
                                                        border-top: 3px solid var(--green);">
                                                                <span class=" flex-fill mb-0 text-white p-2">
                                                                    <p class="lower-section-text mb-0  text-muted">Services
                                                                    </p>
                                                                    <p class="mb-0 text-muted">
                                                                        {{ $vendor->services->count() }}</p>
                                                                </span>
                                                                <span class=" flex-fill mb-0 text-white p-2">
                                                                    <p class="lower-section-text mb-0  text-muted">
                                                                        Products</p>
                                                                    <p class="mb-0  text-muted">
                                                                        {{ $vendor->products->count() }}
                                                                    </p>
                                                                </span>
                                                                <span class=" flex-fill mb-0 text-white p-2">
                                                                    <p class="lower-section-text mb-0  text-muted">Rating
                                                                    </p>
                                                                    <p class="mb-0  text-muted">
                                                                        {{-- <i class="fas fa-star"></i> --}}
                                                                        {{ App\Rating::ratings($vendor->id) }}
                                                                        ({{ App\Rating::ratingCount($vendor->id) }})
                                                                    </p>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="bg-line-1"></div> --}}
                                                    {{-- <div class="bg-line-2"></div> --}}
                                                </div>
                                            </div>
                                        @endforeach
                                        <style>
                                            .category_text {
                                                color: #225db5;
                                            }

                                            .title_height {
                                                height: 60px;
                                            }

                                            .title_height2 {
                                                height: 40px;
                                            }

                                            .shop_about {
                                                margin-left: 15px;
                                                margin-right: 15px;
                                            }

                                            p.about_line {
                                                min-height: 40px;
                                                max-height: 40px;
                                            }

                                            p.category_text {
                                                min-height: 20px;
                                                max-height: 20px;
                                            }

                                            h5.product-title {
                                                min-height: 55px;
                                                max-height: 55px;
                                            }

                                            /* .shipping-feed-back {
                                                                                                            margin-bottom: -25px;
                                                                                                        } */

                                            /* .shipping-feed-back2 {
                                                                                                            margin-bottom: -15px;
                                                                                                        } */

                                            .product-info .product-title a {
                                                font-size: 18px !important;
                                            }

                                            .product-info p {
                                                font-size: 14px;
                                                line-height: 25px;
                                                margin-bottom: 2px;
                                            }
                                        </style>
                                    </div>
                                @else
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="page-center">
                                                <h4 class="text-center">{{ __('No Shop Found.') }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="d-flex align-items-start pt-3" id="custom-pagination">
                                    <div class="pagination-style-one">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                {{ $vendors->links() }}
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                {{-- <div class="bg-circle-2"></div> --}}
                {{-- <div class="bg-circle-1"></div> --}}
            </div>
        </div>
        {{-- {{-- @includeIf('partials.global.common-footer') --}}
    @endsection

    @section('script')
        <script>
            setTimeout(function() {
                if ($(window).width() < 1350) {
                    $(".large_screen").css("display", "none");
                    $(".small_screen").css("display", "block");
                } else {
                    console.log("small");
                    $(".large_screen").css("display", "block");
                    $(".small_screen").css("display", "none");
                }
            }, 1000);


            document.addEventListener("DOMContentLoaded", function() {
                function adjustCompanyName() {
                    var companyNames = document.getElementsByClassName('company-name');
                    var maxLengths = [60, 30, 25, 40, 20]; // Maximum lengths for different screen widths

                    for (var i = 0; i < companyNames.length; i++) {
                        var paragraph = companyNames[i];
                        var maxWidth = window.innerWidth;
                        var maxLength;

                        // Determine the maximum length based on the screen width
                        if (maxWidth < 768) {
                            maxLength = maxLengths[0];
                        } else if (maxWidth >= 768 && maxWidth < 992) {
                            maxLength = maxLengths[2];
                        } else if (maxWidth >= 992 && maxWidth < 1024) {
                            maxLength = maxLengths[1];
                        } else if (maxWidth >= 1024 && maxWidth < 1240) {
                            maxLength = maxLengths[4];
                        } else {
                            maxLength = maxLengths[0];
                        }

                        var text = paragraph.innerText; // Use innerText to retrieve the visible text
                        var truncatedText = text.length > maxLength ? text.substring(0, maxLength) + "..." : text;
                        paragraph.innerText = truncatedText; // Update the content of the paragraph
                    }
                }

                function adjustCompanyDetail() {
                    var details = document.getElementsByClassName('about_line');
                    var maxLen = [90, 60, 80, 110, 50]; // Maximum lengths for different screen widths

                    for (var i = 0; i < details.length; i++) {
                        var detail = details[i];
                        var maxWidth = window.innerWidth;
                        var max;

                        // Determine the maximum length based on the screen width
                        if (maxWidth < 768) {
                            max = maxLen[0];
                        } else if (maxWidth >= 768 && maxWidth < 992) {
                            max = maxLen[1];
                        } else if (maxWidth > 992 && maxWidth < 1024) {
                            max = maxLen[2];
                        } else if (maxWidth >= 1024 && maxWidth < 1240) {
                            max = maxLen[4];
                        } else if (maxWidth >= 1240 && maxWidth < 1440) {
                            max = maxLen[3];
                        } else {
                            max = maxLen[0];
                        }

                        var text = detail.innerText; // Use innerText to retrieve the visible text
                        var truncatedText = text.length > max ? text.substring(0, max) + "..." : text;
                        detail.innerText = truncatedText; // Update the content of the paragraph
                    }
                }
                adjustCompanyName(); // Initial adjustment
                adjustCompanyDetail(); // Initial adjustment

                function resizeEventHandler() {
                    adjustCompanyDetail();
                    adjustCompanyName();
                }

                window.addEventListener('resize', resizeEventHandler);

            });
        </script>
    @endsection
