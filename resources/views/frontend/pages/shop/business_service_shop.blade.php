@extends('frontend.layouts.master_layout')
@section('content')
    @includeIf('frontend.partials.global.common-header')

    @include('frontend.pages.shop.css')

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
                    data-src="{{ $vendor->shop_image ? asset('assets/images/categories/' . $vendor->shop_image) : asset('assets/common_img/vendor_profile.jpeg') }}"
                    alt="">
                <div class="parter_company_details">
                    <h5 class="mb-2">{{ $vendor->name }}</h5>
                    <p class="call_btn_size">
                        <span>Category</span>
                        <span>40 Bracken house</span>
                        <!-- {{ $vendor->address }} -->
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
                    @if ($vendor->website)
                        <a href="{{ $vendor->website }}"><button
                                class="btn btn-white mb-3 btn-sm website_btn">Website</button></a>
                    @endif
                    @if ($vendor->phone)
                        <a href="javascript:void(0);" onclick="seeShopContact()"><button
                                class="btn btn-white mb-3 btn-sm website_btn">Contact</button></a>
                        <p class="shop_contact text-danger" style="display: none;margin-top: -10px">{{ $vendor->phone }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 banner">
                <img class="lazy banner-img w-100 img-fluid rounded"
                    data-src="{{ $vendor->shop_banner ? asset('assets/images/categories/' . $vendor->shop_banner) : asset('assets/common_img/shop_banner.jpeg') }}"
                    alt="">
            </div>
        </div>

    </div>

    <div class="container mb-5">
        <div class="d-md-flex d-sm-block align-items-start shadow custom-shop-tab">
            <div class="nav flex-column nav-pills w-25 p-3 me-3" id="v-pills-tab" role="tablist"
                aria-orientation="vertical">
                <button class="nav-link vendor_sidebar rounded active" id="v-pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                    aria-selected="true">Associated Brands</button>
                <button class="nav-link vendor_sidebar rounded" id="v-pills-messages-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages"
                    aria-selected="false">Marketing</button>
                <button class="nav-link vendor_sidebar rounded" id="v-pills-settings-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings"
                    aria-selected="false">News</button>
                <button class="nav-link vendor_sidebar rounded" id="v-pills--company-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-company" type="button" role="tab" aria-controls="v-pills-company"
                    aria-selected="false">Company Info</button>
            </div>

            <div class="tab-content w-100" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="row">
                        @foreach ($shop as $item)
                            <div class="col-md-5 shadow rounded p-3 m-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{ route('shop.service', $item->id) }}">
                                            <img class="lazy" alt=""
                                                src="{{ $item->logo ? asset($item->logo) : asset('assets/common_img/vendor_profile.jpeg') }}"
                                                style="height: unset;">
                                        </a>
                                    </div>
                                    <div class="col-md-9">
                                        <a href="{{ route('shop.service', $item->id) }}">
                                            <h6>{{ $item->name }}</h6>
                                        </a>
                                        <p class="store_line_height">
                                            {{ $item->country }},
                                            {{ $item->state }},
                                            {{ $item->city }},
                                            {{ $item->zip_code }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...
                    Coming soon
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    ...
                    Coming Soon
                </div>
                <div class="tab-pane fade" id="v-pills-company" role="tabpanel" aria-labelledby="v-pills-company-tab">
                    ...
                    <div class="row">
                        We are proud local consultancy company. Please visite us for more info
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
