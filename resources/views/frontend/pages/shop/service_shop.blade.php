@extends('frontend.layouts.master_layout')
@section('content')
    @includeIf('frontend.partials.global.common-header')

    @include('frontend.pages.shop.css')

    <div class="container shadow p-0 mt-4 mb-4 bg-white rounded custom_mobile">

        <div class="shop-header">
            <div class="row m-0 p-0 custom">
                <div class="col-lg-5 d-flex pl-0 user-custom1">
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
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            (0) Reviews
                        </p>
                    </div>
                </div>
                <div class="col-lg-7 d-flex user-custom custom-class">
                    <img class="lazy custom-img w-100 img-fluid rounded"
                        data-src="{{ $shop->shop_image ? asset('assets/images/categories/' . $shop->shop_image) : asset('assets/common_img/vendor_profile.jpeg') }}"
                        alt="">
                    <div class="parter_company_details">
                        <h5 class="mb-2">{{ $shop->name }}</h5>
                        <p class="call_btn_size">
                            <span>Category</span>
                            <span>40 Bracken house</span>
                            {{ $shop->address }}

                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            (0) Reviews
                        </p>

                        <a href="{{ $shop->website }}"><button
                                class="btn btn-white mb-3 btn-sm website_btn">Website</button></a>

                        <a href="javascript:void(0);" onclick="seeShopContact()">
                            <button class="btn btn-white mb-3 btn-sm website_btn">Contact</button>
                        </a>
                        <p class="shop_contact" style="display: none;">{{ $shop->phone ?? 'Phone Number' }}</p>


                    </div>
                </div>
            </div>
        </div>

        <div class="shop-body">
            <div class="row m-0 p-0">
                {{-- <div class="col-lg-3 p-3 custom-sidebar">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <div class="">
                            <button class="nav-link vendor_sidebar rounded active" id="v-pills-home-tab"
                                type="button">Products & Services</button>
                            <button class="nav-link vendor_sidebar rounded" id="v-pills-messages-tab" data-bs-toggle="pill"
                                type="button">Marketing</button>
                            <button class="nav-link vendor_sidebar rounded" type="button">News</button>
                            <button class="nav-link vendor_sidebar rounded" type="button">Company Info</button>

                            @include('frontend.pages.shop.social_link')
                        </div>
                    </div>
                </div> --}}

                <div class="col-lg-12 p-3 mt-1">

                    {{-- Button --}}
                    <div class="row">
                        <div class="col-lg-3">
                            <button class="custom-button">About</button>
                        </div>
                        <div class="col-lg-3">
                            <button class="custom-button">Type</button>
                        </div>
                        <div class="col-lg-3">
                            <button class="custom-button">Category</button>
                        </div>

                        <div class="col-lg-3">
                            <button class="custom-button">Sort</button>
                        </div>
                    </div>

                    {{-- Product --}}
                    <div class="row">
                        <div class="col-lg-3 mt-2 custom-sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <div class="">
                                    <button class="nav-link vendor_sidebar rounded active" id="v-pills-home-tab"
                                        type="button">Products & Services</button>
                                    <button class="nav-link vendor_sidebar rounded" id="v-pills-messages-tab"
                                        data-bs-toggle="pill" type="button">Marketing</button>
                                    <button class="nav-link vendor_sidebar rounded" type="button">News</button>
                                    <button class="nav-link vendor_sidebar rounded" type="button">Company Info</button>

                                    @include('frontend.pages.shop.social_link')
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9  mt-3">

                            <div class="row">
                                <div class="col-md-12">
                                    <form id="searchForm" class="form-inline search-pill-shape bg-white"
                                        action="{{ route('property.list') }}" method="GET"
                                        style="height: 45px;  border-radius: 4px;">
                                        <input type="text" id="shop_name" class="col form-control search-field"
                                            name="search" placeholder="Search title or room type or room address"
                                            value="{{ request()->input('search') }}">

                                        <a type="submit" name="submit" class="search-submit"><i
                                                class="flaticon-search flat-mini text-white"></i>
                                        </a>
                                    </form>
                                </div>
                                <div class="col-md-12">
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
                                        <div class="col-lg-12 mt-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="page-center">
                                                        <h4 class="text-center">{{ __('Not Found.') }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    @include('frontend.pages.shop.script')
@endsection
