@extends('frontend.layouts.master_layout')
@section('content')
    @includeIf('frontend.partials.global.common-header')

    @include('frontend.pages.shop.css')

    <div class="custom_small_screen row shadow m-0 p-0">
        <imgm class="lazy banner-img w-100 img-fluid rounded banner_img"
            data-src="{{ $shop->shop_banner ? asset('assets/images/categories/' . $shop->shop_banner) : asset('assets/common_img/shop_banner.jpeg') }}"
            alt="" />
        <img class="user-image"
            src="{{ $shop->shop_image ? asset('assets/images/categories/' . $shop->shop_image) : asset('assets/common_img/vendor_profile.jpeg') }}" />
        <img class="top-left-image"
            src="{{ $vendor->logo ? asset($vendor->logo) : asset('assets/common_img/vendor_profile.jpeg') }}" />
        <h3 class="partner_company_name">{{ $shop->shop_name }}</h3>
        <h4 class="partner_company_address">40 Bracken house</h4>
    </div>


    <div class="container shadow p-0 mt-4 mb-4 bg-white rounded custom_mobile">
        <div class="row m-0 p-0 custom">
            <div class="col-lg-4 d-flex pl-0 user-custom1">
                <a href="{{ route('business.shop.service', $vendor->id) }}">
                    <img class="lazy custom-left-img w-100 img-fluid rounded"
                        data-src="{{ $vendor->photo ? asset($vendor->photo) : asset('assets/common_img/vendor_profile.jpeg') }}"
                        alt="">
                </a>
                <div class="sub_company_details">
                    <a href="{{ route('business.shop.service', $vendor->id) }}">
                        <h5>{{ $vendor->name }}</h5>
                    </a>
                    <p class="call_btn_size">
                        <span>Category</span>
                        <span>{{ $vendor->address }}</span>
                        <!-- <br> -->
                        <span>5 year experience ['Business']</span>
                        <!-- <br> -->
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        (0) Reviews
                    </p>

                </div>
            </div>
            <div class="col-lg-5 d-flex user-custom custom-class">
                <img class="lazy custom-img w-100 img-fluid rounded"
                    data-src="{{ $shop->shop_image ? asset('assets/images/categories/' . $shop->shop_image) : asset('assets/common_img/vendor_profile.jpeg') }}"
                    alt="">
                <div class="parter_company_details">
                    <h5 class="mb-2">{{ $shop->name }}</h5>
                    <p class="call_btn_size">
                        <span>Category</span>
                        <span>40 Bracken house</span>
                        <!-- {{ $shop->address }} -->
                        <!-- <br> -->
                        <span>5 year experience ['Business Location']</span>
                        <!-- <br> -->
                        <!-- <span> -->
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <!-- <span class="ml-2"> -->
                        (0) Reviews
                        <!-- </span> -->
                        <!-- </span> -->
                    </p>
                    @if ($shop->website)
                        <a href="{{ $shop->website }}"><button
                                class="btn btn-white mb-3 btn-sm website_btn">Website</button></a>
                    @endif
                    @if ($shop->phone)
                        <a href="javascript:void(0);" onclick="seeShopContact()"><button
                                class="btn btn-white mb-3 btn-sm website_btn">Contact</button></a>
                        <p class="shop_contact text-danger" style="display: none;margin-top: -10px">{{ $shop->phone }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 banner">
                <img class="lazy banner-img w-100 img-fluid rounded"
                    data-src="{{ $shop->shop_banner ? asset('assets/images/categories/' . $shop->shop_banner) : asset('assets/common_img/shop_banner.jpeg') }}"
                    alt="">
            </div>
        </div>

        <div class=" mb-5">
            <div class="d-flex align-items-start custom-shop-tab">
                <div class="nav flex-column nav-pills w-25 p-3 me-3" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <div class="mobileTabManu"><button class="nav-link vendor_sidebar rounded active" id="v-pills-home-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab"
                            aria-controls="v-pills-home" aria-selected="false">Products & Services</button>
                        <button class="nav-link vendor_sidebar rounded" id="v-pills-messages-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-messages" type="button" role="tab"
                            aria-controls="v-pills-messages" aria-selected="false">Marketing</button>
                        <button class="nav-link vendor_sidebar rounded" id="v-pills-settings-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-settings" type="button" role="tab"
                            aria-controls="v-pills-settings" aria-selected="false">News</button>
                        <button class="nav-link vendor_sidebar rounded" id="v-pills--company-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-company" type="button" role="tab" aria-controls="v-pills-company"
                            aria-selected="false">Company Info</button>

                        <ul class="social-links">
                            @if ($shop->facebook)
                                <li>
                                    <a href="{{ $shop->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                </li>
                            @endif
                            @if ($shop->instagram)
                                <li>
                                    <a href="{{ $shop->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                </li>
                            @endif
                            @if ($shop->linkedin)
                                <li>
                                    <a href="{{ $shop->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                            @endif
                            @if ($shop->twitter)
                                <li>
                                    <a href="{{ $shop->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                </li>
                            @endif
                            @if ($shop->youtube)
                                <li>
                                    <a href="{{ $shop->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                                </li>
                            @endif
                            @if ($shop->pinterest)
                                <li>
                                    <a href="{{ $shop->pinterest }}" target="_blank"><i
                                            class="fab fa-pinterest"></i></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>



                <div class="tab-content w-100" id="v-pills-tabContent">


                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">


                        {{-- Search box Category Name --}}
                        <div class="category_search" style="width: 33%; margin-left: 200px; margin-top: 24px;">
                            <form id="searchForm" class="search-form form-inline search-pill-shape bg-white"
                                action="{{ route('property.list') }}" method="GET">
                                <div class="select-appearance-none categori-container" id="categorySelect">
                                    <select name="category" class="form-control categoris mx-2" id="country_select">
                                        <option selected="" value="">{{ __('Select Category') }}</option>
                                        <option value="1"> Properties To Rent </option>
                                        <option value="2"> Properties Wanted </option>
                                        <option value="3"> Education </option>
                                    </select>
                                </div>
                            </form>
                        </div>

                        <ul role="tablist" aria-owns="nav-tab1 nav-tab2 nav-tab3 nav-tab4"
                            class="nav nav-tabs mt-3 mb-2 product-service-tab" id="nav-tab-with-nested-tabs">
                            <li class="nav-item product_service_tabs" role="presentation">
                                <a class="nav-link active nav-link-style" aria-current="page" id="nav-tab1"
                                    href="#tab1-content" data-bs-toggle="tab" data-bs-target="#tab1-content"
                                    role="tab" aria-controls="tab1-content" aria-selected="false">Service</a>
                            </li>
                            <li class="nav-item product_service_tabs" role="presentation">
                                <a class="nav-link nav-link-style" id="nav-tab2" data-bs-toggle="tab"
                                    href="#tab2-content" data-bs-target="#tab2-content" role="tab"
                                    aria-controls="tab2-content" aria-selected="false">Product</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="nav-tabs-content">
                            <div class="tab-pane-with-nested-tab fade show active" id="tab1-content" role="tabpanel"
                                aria-labelledby="nav-tab1">
                                <div
                                    class="row row-cols-xxl-2 px-3 row-cols-md-2 mb-4 row-cols-1 g-3 product-style-1 shop-list product-list e-bg-light e-title-hover-primary e-hover-image-zoom">
                                    @if ($shop->services && $shop->services->count() > 0)
                                        @foreach ($shop->services as $service)
                                            <div class="col">
                                                <div class="product type-product">
                                                    <div class="product-wrapper"
                                                        style="background-color: #f0ebeb !important;">
                                                        <div class="product-image">
                                                            <a href="{{ route('service.details', $service->id) }}"
                                                                class="woocommerce-LoopProduct-link"><img class="lazy"
                                                                    data-src="{{ $service->photo ? asset('assets/images/products/' . $service->photo) : asset('assets/common_img/shop2.jpg') }}"
                                                                    alt="Product Image"></a>

                                                            <div class="hover-area">
                                                                @if ($service->product_type == 'affiliate')
                                                                    <div class="cart-button buynow">
                                                                        <a class="add-to-cart-quick button add_to_cart_button"
                                                                            href="javascript:;"
                                                                            data-href="{{ route('product.cart.quickadd', $service->id) }}"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="right" title=""
                                                                            data-bs-original-title="{{ __('Buy Now') }}"
                                                                            aria-label="{{ __('Buy Now') }}"></a>
                                                                    </div>
                                                                @else
                                                                    <div class="cart-button">
                                                                        <a href="javascript:;"
                                                                            data-href="{{ route('product.cart.add', $service->id) }}"
                                                                            class="add-cart button add_to_cart_button"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="right" title=""
                                                                            data-bs-original-title="{{ __('Add To Cart') }}"
                                                                            aria-label="{{ __('Add To Cart') }}"></a>
                                                                    </div>

                                                                    <div class="cart-button buynow">
                                                                        <a class="add-to-cart-quick button add_to_cart_button"
                                                                            href="javascript:;"
                                                                            data-href="{{ route('product.cart.quickadd', $service->id) }}"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="right" title=""
                                                                            data-bs-original-title="{{ __('Buy Now') }}"
                                                                            aria-label="{{ __('Buy Now') }}"></a>
                                                                    </div>
                                                                @endif
                                                                @if (Auth::check())
                                                                    <div class="wishlist-button">
                                                                        <a class="add_to_wishlist  new button add_to_cart_button"
                                                                            id="add-to-wish" href="javascript:;"
                                                                            data-href="{{ route('user-wishlist-add', $service->id) }}"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="right" title=""
                                                                            data-bs-original-title="Add to Wishlist"
                                                                            aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                                                                    </div>
                                                                @else
                                                                    <div class="wishlist-button">
                                                                        <a class="add_to_wishlist button add_to_cart_button"
                                                                            href="{{ route('user.login') }}"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="right" title=""
                                                                            data-bs-original-title="Add to Wishlist"
                                                                            aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                                                                    </div>
                                                                @endif
                                                                <div class="compare-button">
                                                                    <a class="compare button button add_to_cart_button"
                                                                        data-href="{{ route('product.compare.add', $service->id) }}"
                                                                        href="javascrit:;" data-bs-toggle="tooltip"
                                                                        data-bs-placement="right" title=""
                                                                        data-bs-original-title="Compare"
                                                                        aria-label="Compare">{{ __('Compare') }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-info">
                                                            <h3 class="product-title"><a
                                                                    href="{{ route('service.details', $service->id) }}">{{ $service->showName() }}</a>
                                                            </h3>
                                                            <p class="mb-1" style="color: #0d6efd;">
                                                                {{ $service->categories->name ?? '' }}</p>
                                                            <p class="short_desc"
                                                                style="text-align: justify; line-height: 1.5rem; margin-bottom: 0px;">
                                                                {!! strlen($service->short_description) > 150
                                                                    ? substr($service->short_description, 0, 150) .
                                                                        '... <a href="' .
                                                                        route('service.details', $service->id) .
                                                                        '">Read More</a>'
                                                                    : $service->short_description !!}
                                                            </p>
                                                            <div class="product-price">
                                                                <div class="price">

                                                                    <ins>{{ $service->setCurrency() }}</ins>
                                                                    <del>{{ $service->showPreviousPrice() }}</del>
                                                                </div>
                                                            </div>
                                                            <div class="shipping-feed-back" style="margin-top: 0px;">
                                                                <div class="star-rating">
                                                                    <div class="rating-wrap">
                                                                        <p><i class="fas fa-star"></i><span>
                                                                                {{ App\Models\Rating::ratings($service->id) }}
                                                                                ({{ App\Models\Rating::ratingCount($service->id) }})
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-lg-9">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="page-center">
                                                        <h4 class="text-center">{{ __('No Service Found.') }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2-content" role="tabpanel" aria-labelledby="nav-tab2">
                                <div
                                    class="row row-cols-xxl-2 row-cols-md-2 mb-4 row-cols-1 g-3 product-style-1 shop-list product-list e-bg-light e-title-hover-primary e-hover-image-zoom">
                                    @if ($shop->products && $shop->products->count() > 0)
                                        @foreach ($shop->products as $product)
                                            <div class="col">
                                                <div class="product type-product">
                                                    <div class="product-wrapper">
                                                        <div class="product-image">
                                                            <a href="{{ route('front.product', $product->slug) }}"
                                                                class="woocommerce-LoopProduct-link"><img class="lazy"
                                                                    data-src="{{ $product->photo ? asset('assets/images/products/' . $product->photo) : asset('assets/common_img/shop2.jpg') }}"
                                                                    alt="Product Image"></a>
                                                            {{-- @if (round($product->offPercentage()) > 0)
                                            <div class="on-sale">- {{ round($product->offPercentage() )}}%</div>
                                            @endif --}}
                                                            <div class="hover-area">
                                                                @if ($product->product_type == 'affiliate')
                                                                    <div class="cart-button buynow">
                                                                        <a class="add-to-cart-quick button add_to_cart_button"
                                                                            href="javascript:;"
                                                                            data-href="{{ route('product.cart.quickadd', $product->id) }}"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="right" title=""
                                                                            data-bs-original-title="{{ __('Buy Now') }}"
                                                                            aria-label="{{ __('Buy Now') }}"></a>
                                                                    </div>
                                                                @else
                                                                    @if ($product->emptyStock())
                                                                        <div class="closed">
                                                                            <a class="cart-out-of-stock button add_to_cart_button"
                                                                                href="#"
                                                                                title="{{ __('Out Of Stock') }}"><i
                                                                                    class="flaticon-cancel flat-mini mx-auto"></i></a>
                                                                        </div>
                                                                    @else
                                                                        <div class="cart-button">
                                                                            <a href="javascript:;"
                                                                                data-href="{{ route('product.cart.add', $product->id) }}"
                                                                                class="add-cart button add_to_cart_button"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="right" title=""
                                                                                data-bs-original-title="{{ __('Add To Cart') }}"
                                                                                aria-label="{{ __('Add To Cart') }}"></a>
                                                                        </div>

                                                                        <div class="cart-button buynow">
                                                                            <a class="add-to-cart-quick button add_to_cart_button"
                                                                                href="javascript:;"
                                                                                data-href="{{ route('product.cart.quickadd', $product->id) }}"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="right" title=""
                                                                                data-bs-original-title="{{ __('Buy Now') }}"
                                                                                aria-label="{{ __('Buy Now') }}"></a>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                                @if (Auth::check())
                                                                    <div class="wishlist-button">
                                                                        <a class="add_to_wishlist  new button add_to_cart_button"
                                                                            id="add-to-wish" href="javascript:;"
                                                                            data-href="{{ route('user-wishlist-add', $product->id) }}"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="right" title=""
                                                                            data-bs-original-title="Add to Wishlist"
                                                                            aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                                                                    </div>
                                                                @else
                                                                    <div class="wishlist-button">
                                                                        <a class="add_to_wishlist button add_to_cart_button"
                                                                            href="{{ route('user.login') }}"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="right" title=""
                                                                            data-bs-original-title="Add to Wishlist"
                                                                            aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                                                                    </div>
                                                                @endif
                                                                <div class="compare-button">
                                                                    <a class="compare button button add_to_cart_button"
                                                                        data-href="{{ route('product.compare.add', $product->id) }}"
                                                                        href="javascrit:;" data-bs-toggle="tooltip"
                                                                        data-bs-placement="right" title=""
                                                                        data-bs-original-title="Compare"
                                                                        aria-label="Compare">{{ __('Compare') }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-info">
                                                            <h3 class="product-title"><a
                                                                    href="{{ route('front.product', $product->slug) }}">{{ $product->showName() }}</a>
                                                            </h3>
                                                            <p>{{ $product->category->name ?? '' }}</p>
                                                            <p style="text-align: justify">{!! $product->short_description !!}</p>
                                                            <div class="product-price">
                                                                <div class="price">

                                                                    <ins>{{ $product->setCurrency() }}</ins>
                                                                    <del>{{ $product->showPreviousPrice() }}</del>
                                                                </div>
                                                            </div>
                                                            <div class="shipping-feed-back">
                                                                <div class="star-rating">
                                                                    <div class="rating-wrap">
                                                                        <p><i class="fas fa-star"></i><span>
                                                                                {{ App\Models\Rating::ratings($product->id) }}
                                                                                ({{ App\Models\Rating::ratingCount($product->id) }})
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-lg-9">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="page-center">
                                                        <h4 class="text-center">{{ __('No Product Found.') }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade marketing-section" id="v-pills-messages" role="tabpanel"
                        aria-labelledby="v-pills-messages-tab">
                        <!-- Marketing Section Start -->
                        <div class="container" id="marketing-container">
                            <!-- Buttons for switching between card and list view -->
                            <div class="btn-group mb-3 ml-auto" role="group" aria-label="View Switcher">
                                <button type="button" class="btn card_view_btn" data-view="card">Card View</button>
                                {{--  <button type="button" class="btn list_view_btn" data-view="list">List View</button> --}}
                            </div>

                            <!-- Card view for marketing section -->
                            <div class="row marketing-card-view" id="marketing-card-view">
                                @if ($shop->marketingProducts && $shop->marketingProducts->count() > 0)
                                    @foreach ($shop->marketingProducts as $product)
                                        <div class="col-md-6 mb-4">
                                            <div class="marketing-card">
                                                <div class="marketing-card-image">
                                                    <img src="{{ asset('assets/images/products/' . $product->photo) }}"
                                                        alt="...">
                                                </div>
                                                <div class="marketing-card-body">
                                                    <h5 class="marketing-card-title">{{ $product->showName() }}</h5>
                                                    <p class="marketing-card-text">
                                                        @if (strlen($product->details) > 200)
                                                            {!! substr($product->details, 0, 200) !!}...
                                                        @else
                                                            {!! $product->details !!}
                                                        @endif
                                                    </p>
                                                    <a href="{{ route('front.product', $product->slug) }}"
                                                        class="marketing-card-learn-more">Learn More</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-lg-9 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="page-center">
                                                    <h4 class="text-center">{{ __('No Product Found.') }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="pagination justify-content-center">
                                @if ($shop->products->count() > 8)
                                    @for ($i = 1; $i <= ceil($shop->products->count() / 8); $i++)
                                        <a class="pagination-link marketing-pagination-link @if ($i == 1) active @endif"
                                            id="marketing-pagination-link-{{ $i }}"
                                            onclick="loadMarketingProducts({{ $i }})"
                                            href="javascript:void(0)">{{ $i }}</a>
                                    @endfor
                                @endif
                            </div>

                            <!-- Pagination for marketing section -->
                            <!-- <div class="pagination justify-content-center">
                                                                                                                                                                                                <a href="#" class="pagination-link">&laquo;</a>
                                                                                                                                                                                                <a href="#" class="pagination-link active">1</a>
                                                                                                                                                                                                <a href="#" class="pagination-link">2</a>
                                                                                                                                                                                                <a href="#" class="pagination-link">3</a>
                                                                                                                                                                                                <a href="#" class="pagination-link">4</a>
                                                                                                                                                                                                <a href="#" class="pagination-link">5</a>
                                                                                                                                                                                                <a href="#" class="pagination-link">&raquo;</a>
                                                                                                                                                                                            </div> -->

                            <!-- List view for marketing section -->
                            <div class="marketing-list-view" style="display:none;">
                                <div class="list-group">
                                    <a href="#"
                                        class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Product Name 1</h5>
                                        </div>
                                        <img src="https://picsum.photos/id/1018/400/250" class="mb-3" alt="...">
                                        <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                                            malesuada molestie commodo. In hac habitasse platea dictumst. </p>
                                        <a href="#" class="btn btn-primary">Learn More</a>
                                    </a>
                                    <a href="#"
                                        class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Product Name 2</h5>
                                        </div>
                                        <img src="https://picsum.photos/id/1015/400/250" class="mb-3" alt="...">
                                        <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                                            malesuada molestie commodo. In hac habitasse platea dictumst.</p>
                                        <a href="#" class="btn btn-primary">Learn More</a>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Marketing Section End -->

                    <!-- News Section Start -->
                    <div class="tab-pane fade news-section" id="v-pills-settings" role="tabpanel"
                        aria-labelledby="v-pills-settings-tab">
                        <div class="container news_section_container">
                            <div class="row news-card-view" id="news-card-view">
                                @if ($shop->marketingProducts && $shop->marketingProducts->count() > 0)
                                    @foreach ($shop->marketingProducts as $product)
                                        <div class="col-md-6 mb-4">
                                            <div class="card news-card">
                                                <img src="{{ asset('assets/images/products/' . $product->photo) }}"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title news-card-title">{{ $product->showName() }}</h5>
                                                    <p class="card-text news-card-text">
                                                        @if (strlen($product->details) > 200)
                                                            {!! substr($product->details, 0, 200) !!}...
                                                        @else
                                                            {!! $product->details !!}
                                                        @endif
                                                    </p>
                                                    <a href="{{ route('front.product', $product->slug) }}"
                                                        class="btn btn-primary news-card-btn">Learn More</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-lg-9 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="page-center">
                                                    <h4 class="text-center">{{ __('No News Found.') }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Pagination for news section -->
                            <div class="pagination justify-content-center">
                                @if ($shop->products->count() > 8)
                                    @for ($i = 1; $i <= ceil($shop->products->count() / 8); $i++)
                                        <a class="pagination-link news-pagination-link @if ($i == 1) active @endif"
                                            id="news-pagination-link-{{ $i }}"
                                            onclick="loadNewsProducts({{ $i }})"
                                            href="javascript:void(0)">{{ $i }}</a>
                                    @endfor
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- News Section End -->
                    <div class="tab-pane fade" id="v-pills-company" role="tabpanel"
                        aria-labelledby="v-pills-company-tab">
                        <p class="pt-3 text-justify">{{ $shop->shop_about }}</p>
                    </div>
                </div>


            </div>
        </div>
    </div>

    {{-- @includeIf('partials.global.common-footer') --}}

@endsection
@section('script')
    <script>
        function seeVendorContact() {
            $(".vendor_contact").css("display", "block");
        }

        function seeShopContact() {
            $(".shop_contact").css("display", "block");
        }

        function loadMarketingProducts(page) {
            const links = document.querySelectorAll('.marketing-pagination-link');
            [].forEach.call(links, function(link) {
                link.classList.remove('active');
            });
            const currentPageLink = document.querySelector('#marketing-pagination-link-' + page);
            currentPageLink.classList.add('active');

            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    page: page,
                    shop_id: "{{ $shop->id }}"
                },
                success: function(response) {
                    $("#marketing-card-view").html(response);
                }
            });
        }

        function loadNewsProducts(page) {
            const links = document.querySelectorAll('.news-pagination-link');
            [].forEach.call(links, function(link) {
                link.classList.remove('active');
            });
            const currentPageLink = document.querySelector('#news-pagination-link-' + page);
            currentPageLink.classList.add('active');

            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    page: page,
                    shop_id: "{{ $shop->id }}"
                },
                success: function(response) {
                    $("#news-card-view").html(response);
                }
            });
        }

        $(document).ready(function() {
            $('.view-list').click(function() {
                console.log('list');
                $('.view-list-section').show();
                $('.view-card-section').hide();
            });

            $('.view-card').click(function() {
                console.log('card');
                $('.view-list-section').hide();
                $('.view-card-section').show();
            });
        });
    </script>
@endsection
