@extends('frontend.layouts.master_layout')

@section('css')
    @include('frontend.service.partial.property_style')
@endsection

@section('content')
    @includeIf('frontend.partials.global.common-header')

    {{--<div class="pro-details-sidebar-item mb-4">
        <span> Contact </span>

        @php
            $businessLocation = $info->business_location;
            $imageUrl = $businessLocation && File::exists(public_path($businessLocation->logo)) ? asset($businessLocation->logo) : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
        @endphp

                <a
                        href="{{ $businessLocation ? route('shop.service', $businessLocation->id) : '#' }}">
                    <div>
                        <img class="" src="{{ $imageUrl }}" alt=""
                             width="100" height="100">
                    </div>
                    <strong
                            style="font-size: 24px;">{{ $businessLocation ? $businessLocation->name : '' }}</strong>
                </a>

        <p style="background: #45606b; color: #fff">
            {{ $info->property_user_title }}</p>

    </div>--}}

    <div class="shop-list-page">
        <div class="p-6" style="/*background: #4d6873;*/background: #38b2ac; margin: 0px 200px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <div class="container">
                <div class="row text-center text-white">
                    <div class="col-md-2" style="text-align: left">
                        @php
                            $imageUrl = $user_info && $user_info->file_name && File::exists(public_path("uploads/media/{$user_info->file_name}")) ? asset("uploads/media/{$user_info->file_name}") : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                        @endphp
                        <img style="margin: 5px 0" src="{{ $imageUrl }}" alt="Seller Image" width="100" height="100">
                    </div>
                    <div class="col-md-6 d-flex flex-column" style="text-align: left;">
                        <h5 class="align-items-center justify-content-center mb-0 mt-1">Seller</h5>
                        <strong style="line-height: 1.2">
                            <h3 class="mb-0 mt-0">{{ $info->business_location ? $info->business_location->name : '' }}</h3>
                            <h6 class="p-0 m-0 text-white">Category 1</h6>
                            <h6 class="p-0 m-0">{{$info->business_location->landmark}}, {{$info->business_location->city}}, {{$info->business_location->zip_code}},
                                {{$info->business_location->country}}
                            </h6>
                            {{--{{ $info->user->surname ?? '' }}
                            {{ $info->user->first_name ?? '' }}
                            {{ $info->user->last_name ?? '' }}--}}
                        </strong>
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
{{--                        <button type="button" class="btn btn-success">Contact</button>--}}
                        <a href="{{ $info->business_location ? route('shop.service', $info->business_location->id) : '#' }}" class="btn btn-success">Contact Now</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- breadcrumb -->
        <div class="shop-list-page">

            <div class="mt-2 content-circle">

                <div class="container">
                    <div class="full-row pb-0">
                        <div class="container">
                            <div class="row single-product-wrapper">
                                <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                                    <div class="product-images overflow-hidden">
                                        <div class="images-inner">
                                            <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4" style="opacity: 1; transition: opacity 0.25s ease-in-out 0s;">
                                                <figure class="woocommerce-product-gallery__wrapper">
                                                    <div class="bg-light">
                                                        <div style="height:389.328px;width:389.328px;" class="zoomWrapper">
                                                            <img id="single-image-zoom" src="{{ asset(asset('upload/'.$info->image)) }}" alt="Thumb Image" data-zoom-image="{{ asset(asset('upload/'.$info->image)) }}" style="position: absolute;">
                                                        </div>
                                                    </div>

                                                    <div id="gallery_09" class="product-slide-thumb">
                                                        <div class="owl-carousel four-carousel dot-disable nav-arrow-middle owl-mx-5 owl-loaded owl-drag">

                                                            <div class="owl-stage-outer">
                                                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 293px;">

                                                                    <div class="owl-item active" style="width: 96.582px; margin-right: 1px;">
                                                                        <div class="item">
                                                                            <a class="active" href="https://product.geniusocean.com/geniuscart/assets/images/galleries/1639378165t5CzXscD.jpg" data-image="https://product.geniusocean.com/geniuscart/assets/images/galleries/1639378165t5CzXscD.jpg" data-zoom-image="https://product.geniusocean.com/geniuscart/assets/images/galleries/1639378165t5CzXscD.jpg">
                                                                                <img src="{{ asset(asset('upload/'.$info->image)) }}" alt="Thumb Image">
                                                                            </a>
                                                                        </div>
                                                                    </div>

                                                                    <div class="owl-item active" style="width: 96.582px; margin-right: 1px;">
                                                                        <div class="item">
                                                                            <a class="active" href="https://product.geniusocean.com/geniuscart/assets/images/galleries/1639378165qI2PTBtC.jpg" data-image="https://product.geniusocean.com/geniuscart/assets/images/galleries/1639378165qI2PTBtC.jpg" data-zoom-image="https://product.geniusocean.com/geniuscart/assets/images/galleries/1639378165qI2PTBtC.jpg">
                                                                                <img src="https://product.geniusocean.com/geniuscart/assets/images/galleries/1639378165qI2PTBtC.jpg" alt="Thumb Image">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item active" style="width: 96.582px; margin-right: 1px;">
                                                                        <div class="item">
                                                                            <a class="active" href="https://product.geniusocean.com/geniuscart/assets/images/galleries/1639378165jYceIttx.jpg" data-image="https://product.geniusocean.com/geniuscart/assets/images/galleries/1639378165jYceIttx.jpg" data-zoom-image="https://product.geniusocean.com/geniuscart/assets/images/galleries/1639378165jYceIttx.jpg">
                                                                                <img src="https://product.geniusocean.com/geniuscart/assets/images/galleries/1639378165jYceIttx.jpg" alt="Thumb Image">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev disabled"><div class="nav-btn prev-slide"><i class="fas fa-chevron-left"></i><span>Prev</span></div></button><button type="button" role="presentation" class="owl-next disabled"><div class="nav-btn next-slide"><span>Next</span><i class="fas fa-chevron-right"></i></div></button></div><div class="owl-dots disabled"><button role="button" class="owl-dot active"><span></span></button></div></div>
                                                    </div>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-5 col-md-8">
                                    <div class="summary entry-summary">
                                        <div class="summary-inner">
                                            {{--<div class="entry-breadcrumbs w-100">
                                                <nav class="breadcrumb-divider-slash" aria-label="breadcrumb">
                                                    <ol class="breadcrumb pro-bread">
                                                        <li class="breadcrumb-item"><a href="https://product.geniusocean.com/geniuscart">Home</a></li>
                                                        <li class="breadcrumb-item"><a href="https://product.geniusocean.com/geniuscart/category/electric">Electronic</a></li>
                                                        <li class="breadcrumb-item">
                                                            <a href="https://product.geniusocean.com/geniuscart/category/electric/television">
                                                                TELEVISION
                                                            </a>
                                                        </li>
                                                        <li class="breadcrumb-item">
                                                            <a href="https://product.geniusocean.com/geniuscart/category/electric/television/lcd-tv">
                                                                LCD TV
                                                            </a>
                                                        </li>

                                                    </ol>
                                                </nav>
                                            </div>--}}
                                            <h1 class="product_title entry-title">{{ $info->name }}</h1>

                                            <div class="pro-details">
                                                <div class="pro-info">
                                                    <div class="woocommerce-product-rating">
                                                        <div class="fancy-star-rating">
                                                            <div class="rating-wrap"> <span class="fancy-rating good">0 ★</span>
                                                            </div>
                                                            <div class="rating-counts-wrap">
                                                                <a href="#reviews" class="bigbazar-rating-review-link" rel="nofollow"> <span class="rating-counts"> (0) </span> </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <p class="price">
                                                      <span class="woocommerce-Price-amount amount mr-4">
                                                          <bdi><span class="woocommerce-Price-currencySymbol" id="sizeprice">{{$info->variations[0]->default_purchase_price}}$</span></bdi>
                                                      </span>
                                                        <del class="ml-3"><small>{{ ($info->variations[0]->default_purchase_price * 8)/100 }}$</small></del>
                                                        <span class="on-sale"><span>8</span>% Off</span>

                                                    </p>

                                                    <div class="stock-availability in-stock text-bold">368 In Stock</div>

                                                    <div class="product-offers">
                                                        <ul class="product-offers-list">
                                                            <li class="product-offer-item"><span class="h6">Estimated Shipping Time:</span> 24
                                                            </li>
                                                            <li class="product-offer-item product-id"><span class="h6">Product SKU: </span> {{$info->sku}}
                                                            </li>


                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="product-color" data-key="false">
                                                <div class="title">Color :</div>
                                                <ul class="color-list">


                                                    <li class="show-colors active">
                                                       <span class="box" data-color="#c71f1f" style="background-color: #c71f1f">
                                                       <input type="hidden" class="size_price" value="0">
                                                       </span>
                                                    </li>

                                                    <li class="show-colors">
                                                       <span class="box" data-color="#000000" style="background-color: #000000">
                                                       <input type="hidden" class="size_price" value="0">
                                                       </span>
                                                    </li>

                                                    <li class="show-colors">
                                                       <span class="box" data-color="#00c236" style="background-color: #00c236">
                                                       <input type="hidden" class="size_price" value="0">
                                                       </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <input type="hidden" id="product_price" value="425">
                                            <input type="hidden" id="product_id" value="162">
                                            <input type="hidden" id="curr_pos" value="1">
                                            <input type="hidden" id="curr_sign" value="$">


                                            <input type="hidden" id="stock" value="368">

                                            <div class="d-flex flex-wrap mt-3">
                                                <div class="multiple-item-price m-1 me-3">
                                                    <div class="qty">
                                                        <ul class="qty-buttons">
                                                            <li>
                                                                <span class="qtminus">
                                                                   <i class="icofont-minus"></i>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <input class="qttotal" type="text" id="order-qty" value="1">
                                                                <input type="hidden" id="affilate_user" value="0">
                                                                <input type="hidden" id="product_minimum_qty" value="0">
                                                            </li>
                                                            <li>
                                                                <span class="qtplus">
                                                                   <i class="icofont-plus"></i>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>



                                                <ul>
                                                    <li class="addtocart m-1">
                                                        <a href="javascript:;" id="addcrt">Add to Cart</a>
                                                    </li>

                                                    <li class="addtocart m-1">
                                                        <a id="qaddcrt" href="javascript:;">
                                                            Buy Now
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="yith-wcwl-add-to-wishlist wishlist-fragment mt-3">
                                                <div class="wishlist-button">
                                                    <a class="add_to_wishlist" href="https://product.geniusocean.com/geniuscart/user/login" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                </div>
                                                <div class="compare-button">
                                                    <a class="compare button" data-href="https://product.geniusocean.com/geniuscart/item/compare/add/162" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                </div>

                                            </div>





                                            <div class="report-area">
                                                <a class="report-item" href="https://product.geniusocean.com/geniuscart/user/login"><i class="fas fa-flag"></i> Report This Item </a>
                                            </div>



                                            @include('frontend.social_media_share.social_media')

                                            <script async="" src="https://static.addtoany.com/menu/page.js"></script>

                                            <div class="product-attributes my-4">
                                                <div class="row gy-4">

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <strong class="text-capitalize mb-2 d-block">warranty type :</strong>
                                                            <div class="">
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="warranty_type0" name="warranty_type" class="form-check-input custom-control-input product-attr" data-key="warranty_type" data-price="10" value="Local seller warranty" checked="">
                                                                    <label class="form-check-label" for="warranty_type0">Local seller warranty

                                                                        +
                                                                        $ 10
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="warranty_type1" name="warranty_type" class="form-check-input custom-control-input product-attr" data-key="warranty_type" data-price="15" value="No warranty">
                                                                    <label class="form-check-label" for="warranty_type1">No warranty

                                                                        +
                                                                        $ 15
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="warranty_type2" name="warranty_type" class="form-check-input custom-control-input product-attr" data-key="warranty_type" data-price="20" value="international manufacturer warranty">
                                                                    <label class="form-check-label" for="warranty_type2">international manufacturer warranty

                                                                        +
                                                                        $ 20
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="warranty_type3" name="warranty_type" class="form-check-input custom-control-input product-attr" data-key="warranty_type" data-price="25" value="Non-local warranty">
                                                                    <label class="form-check-label" for="warranty_type3">Non-local warranty

                                                                        +
                                                                        $ 25
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <strong class="text-capitalize mb-2 d-block">brand :</strong>
                                                            <div class="">
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="brand0" name="brand" class="form-check-input custom-control-input product-attr" data-key="brand" data-price="5" value="Symphony" checked="">
                                                                    <label class="form-check-label" for="brand0">Symphony

                                                                        +
                                                                        $ 5
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="brand1" name="brand" class="form-check-input custom-control-input product-attr" data-key="brand" data-price="10" value="Oppo">
                                                                    <label class="form-check-label" for="brand1">Oppo

                                                                        +
                                                                        $ 10
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="brand2" name="brand" class="form-check-input custom-control-input product-attr" data-key="brand" data-price="15" value="EStore">
                                                                    <label class="form-check-label" for="brand2">EStore

                                                                        +
                                                                        $ 15
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="brand3" name="brand" class="form-check-input custom-control-input product-attr" data-key="brand" data-price="20" value="Infinix">
                                                                    <label class="form-check-label" for="brand3">Infinix

                                                                        +
                                                                        $ 20
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="brand4" name="brand" class="form-check-input custom-control-input product-attr" data-key="brand" data-price="25" value="Apple">
                                                                    <label class="form-check-label" for="brand4">Apple

                                                                        +
                                                                        $ 25
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <strong class="text-capitalize mb-2 d-block">color family :</strong>
                                                            <div class="">
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="color_family0" name="color_family" class="form-check-input custom-control-input product-attr" data-key="color_family" data-price="10" value="Black" checked="">
                                                                    <label class="form-check-label" for="color_family0">Black

                                                                        +
                                                                        $ 10
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="color_family1" name="color_family" class="form-check-input custom-control-input product-attr" data-key="color_family" data-price="15" value="Sliver">
                                                                    <label class="form-check-label" for="color_family1">Sliver

                                                                        +
                                                                        $ 15
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="color_family2" name="color_family" class="form-check-input custom-control-input product-attr" data-key="color_family" data-price="20" value="Dark Grey">
                                                                    <label class="form-check-label" for="color_family2">Dark Grey

                                                                        +
                                                                        $ 20
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="color_family3" name="color_family" class="form-check-input custom-control-input product-attr" data-key="color_family" data-price="35" value="Brown">
                                                                    <label class="form-check-label" for="color_family3">Brown

                                                                        +
                                                                        $ 35
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <strong class="text-capitalize mb-2 d-block">display size :</strong>
                                                            <div class="">
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="display_size0" name="display_size" class="form-check-input custom-control-input product-attr" data-key="display_size" data-price="120" value="40" checked="">
                                                                    <label class="form-check-label" for="display_size0">40

                                                                        +
                                                                        $ 120
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="display_size1" name="display_size" class="form-check-input custom-control-input product-attr" data-key="display_size" data-price="10" value="22">
                                                                    <label class="form-check-label" for="display_size1">22

                                                                        +
                                                                        $ 10
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="display_size2" name="display_size" class="form-check-input custom-control-input product-attr" data-key="display_size" data-price="20" value="24">
                                                                    <label class="form-check-label" for="display_size2">24

                                                                        +
                                                                        $ 20
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="display_size3" name="display_size" class="form-check-input custom-control-input product-attr" data-key="display_size" data-price="15" value="32">
                                                                    <label class="form-check-label" for="display_size3">32

                                                                        +
                                                                        $ 15
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio form-check">
                                                                    <input type="hidden" class="keys" value="">
                                                                    <input type="hidden" class="values" value="">
                                                                    <input type="radio" id="display_size4" name="display_size" class="form-check-input custom-control-input product-attr" data-key="display_size" data-price="60" value="21">
                                                                    <label class="form-check-label" for="display_size4">21

                                                                        +
                                                                        $ 60
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="pro-details-sidebar-item mb-4">
                                        <span>Sold By</span>
                                        <h5>
                                            Test Stores
                                        </h5>
                                        <h3>55</h3>
                                        <h6>Total Items</h6>

                                        <li class=" cnt-sell">
                                            <a href="https://product.geniusocean.com/geniuscart/Test-Stores" class="view-stor btn--base">
                                                <i class="icofont-ui-travel"></i>
                                                Visit Store
                                            </a>
                                        </li>








                                        <a class="view-stor btn--base" href="https://product.geniusocean.com/geniuscart/user/login">
                                            <i class="icofont-ui-chat"></i>
                                            Contact Seller
                                        </a>






                                        <br>

                                        <a class="view-stor btn--base" href="https://product.geniusocean.com/geniuscart/user/login">
                                            <i class="icofont-plus"></i>
                                            Add To Favorite Seller
                                        </a>



                                    </div>
                                    <div class="pro-summary mb-4">
                                        <div class="price-summary">
                                            <div class="price-summary-content">
                                                <h5 class="text-center">Wholesell</h5>
                                                <ul class="price-summary-list">
                                                    <li class="regular-price"> <h6>Quantity</h6>
                                                        <span>
                                  <span class="woocommerce-Price-amount amount"><h6>Discount</h6>
                               </span>
                               </span>
                                                    </li>
                                                    <li class="selling-price"> <label>15+</label> <span><span class="woocommerce-Price-amount amount">10% Off
                               </span>
                               </span>
                                                    </li>
                                                    <li class="selling-price"> <label>20+</label> <span><span class="woocommerce-Price-amount amount">15% Off
                               </span>
                               </span>
                                                    </li>
                                                    <li class="selling-price"> <label>30+</label> <span><span class="woocommerce-Price-amount amount">20% Off
                               </span>
                               </span>
                                                    </li>
                                                    <li class="selling-price"> <label>40+</label> <span><span class="woocommerce-Price-amount amount">25% Off
                               </span>
                               </span>
                                                    </li>
                                                    <li class="selling-price"> <label>50+</label> <span><span class="woocommerce-Price-amount amount">30% Off
                               </span>
                               </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="full-row">
                        <div class="container">
                            <div class="row justify-content-between">
                                <div class="col-lg-8">
                                    <div class="section-head border-bottom">
                                        <div class="woocommerce-tabs wc-tabs-wrapper ps-0">
                                            <ul class="nav nav-pills wc-tabs" id="pills-tab-one" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="pills-description-one-tab" data-bs-toggle="pill" href="#pills-description-one" role="tab" aria-controls="pills-description-one" aria-selected="true">Description</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-information-one-tab" data-bs-toggle="pill" href="#pills-information-one" role="tab" aria-controls="pills-information-one" aria-selected="false">Buy / Return Policy</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-reviews-one-tab" data-bs-toggle="pill" href="#pills-reviews-one" role="tab" aria-controls="pills-reviews-one" aria-selected="false">Reviews</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-comment-one-tab" data-bs-toggle="pill" href="#pills-comment-one" role="tab" aria-controls="pills-comment-one" aria-selected="false">Comments</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="woocommerce-tabs wc-tabs-wrapper ps-0 mt-0">
                                        <div class="tab-content" id="pills-tabContent-one">
                                            <div class="tab-pane fade woocommerce-Tabs-panel woocommerce-Tabs-panel--description mb-5 mt-4 active show bg-white" id="pills-description-one" role="tabpanel" aria-labelledby="pills-description-one-tab">
                                                {!! @$info->product_description !!}
                                            </div>
                                            <div class="tab-pane fade mb-5" id="pills-information-one" role="tabpanel" aria-labelledby="pills-information-one-tab">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h4 class="title" style="font-weight:600;line-height:1.2381;font-size:20px;color:rgb(5,14,51);"></h4><div class="product-services" style="margin-top:1.5em;color:rgb(118,118,120);font-family:Jost, sans-serif;font-size:16px;font-weight:400;"><span style="width:115px;font-weight:600;padding-right:0px;">Services:</span><ul class="product-services-list" style="padding:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;line-height:28px;"><li class="product-service-item">30 Day Return Policy</li><li class="product-service-item">Cash on Delivery available</li><li class="product-service-item">Free Delivery</li></ul></div><div class="woocommerce-product-details__short-description" style="margin-top:1.5em;color:rgb(118,118,120);font-family:Jost, sans-serif;font-size:16px;font-weight:400;"><span style="width:115px;font-weight:600;padding-right:0px;">Highlights:</span><div class="short-description"><ul style="padding:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;line-height:28px;"><li>Regular Fit.</li><li>Full sleeves.</li><li>70% cotton, 30% polyester.</li><li>Easy to wear and versatile as Casual.</li><li>Machine wash, tumble dry.</li></ul></div></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-comment-one" role="tabpanel" aria-labelledby="pills-comment-one-tab">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div id="comments">

                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <br>
                                                                    <h5 class="text-center"><a href="https://product.geniusocean.com/geniuscart/user/login" class="btn login-btn">Login</a> To Comment </h5>
                                                                    <br>
                                                                </div>
                                                            </div>

                                                            <ul class="all-comment">


                                                                <li>
                                                                    <div class="single-comment">
                                                                        <div class="left-area">
                                                                            <img class="lazy" alt="" src="https://product.geniusocean.com/geniuscart/assets/images/1567655174profile.jpg" style="">
                                                                            <h5 class="name">Vendor</h5>
                                                                            <p class="date">10 months ago</p>
                                                                        </div>
                                                                        <div class="right-area">
                                                                            <div class="comment-body">
                                                                                <p>
                                                                                    Te
                                                                                </p>
                                                                            </div>


                                                                        </div>
                                                                    </div>

                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-reviews-one" role="tabpanel" aria-labelledby="pills-reviews-one-tab">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div id="comments">
                                                            <p>No Review Found.</p>
                                                            <div id="review_form_wrapper">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <br>
                                                                        <h5 class="text-center">
                                                                            <a href="https://product.geniusocean.com/geniuscart/user/login" class="btn login-btn mr-1">
                                                                                Login
                                                                            </a>
                                                                            To Review
                                                                        </h5>
                                                                        <br>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">

                                    <div class="section-head border-bottom d-flex justify-content-between align-items-center">
                                        <div class="d-flex section-head-side-title">
                                            <h5 class="font-700 text-dark mb-0">Seller's Product</h5>
                                        </div>
                                    </div>

                                    <div class="product-style-2 owl-carousel owl-nav-hover-primary nav-top-right single-carousel dot-disable product-list e-bg-white owl-loaded owl-drag">







                                        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 948px;"><div class="owl-item active" style="width: 286px; margin-right: 30px;"><div class="item">
                                                        <div class="row row-cols-1">

                                                            <div class="col mb-1">
                                                                <div class="product type-product">
                                                                    <div class="product-wrapper">
                                                                        <div class="product-image">
                                                                            <a href="https://product.geniusocean.com/geniuscart/item/affiliate-product-title-will-be-here-affiliate-product-title-will-be-here-95-pr495jsv1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1568027732dTwHda8l.png" style=""></a>
                                                                            <div class="wishlist-view">
                                                                                <div class="quickview-button">
                                                                                    <a class="quickview-btn" href="https://product.geniusocean.com/geniuscart/item/affiliate-product-title-will-be-here-affiliate-product-title-will-be-here-95-pr495jsv1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Quick View" aria-label="Quick View">Quick View</a>
                                                                                </div>
                                                                                <div class="whishlist-button">
                                                                                    <a class="add_to_wishlist" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-info">
                                                                            <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/affiliate-product-title-will-be-here-affiliate-product-title-will-be-here-95-pr495jsv1">Affiliate Product Title will Be Here. Affiliate Pr...</a></h3>
                                                                            <div class="product-price">
                                                                                <div class="price">
                                                                                    <ins>58.50$</ins>
                                                                                    <del>111$</del>
                                                                                </div>
                                                                                <div class="on-sale"><span>47</span><span>% off</span></div>
                                                                            </div>
                                                                            <div class="shipping-feed-back">
                                                                                <div class="star-rating">
                                                                                    <div class="rating-wrap">
                                                                                        <p><i class="fas fa-star"></i><span> 0</span></p>
                                                                                    </div>
                                                                                    <div class="rating-counts-wrap">
                                                                                        <p>(0)</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col mb-1">
                                                                <div class="product type-product">
                                                                    <div class="product-wrapper">
                                                                        <div class="product-image">
                                                                            <a href="https://product.geniusocean.com/geniuscart/item/digital-product-title-will-be-here-by-name-107-4ll107cru-arabic" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1568026791NGCCXoMs.png" style=""></a>
                                                                            <div class="wishlist-view">
                                                                                <div class="quickview-button">
                                                                                    <a class="quickview-btn" href="https://product.geniusocean.com/geniuscart/item/digital-product-title-will-be-here-by-name-107-4ll107cru-arabic" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Quick View" aria-label="Quick View">Quick View</a>
                                                                                </div>
                                                                                <div class="whishlist-button">
                                                                                    <a class="add_to_wishlist" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-info">
                                                                            <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/digital-product-title-will-be-here-by-name-107-4ll107cru-arabic">Digital Product Title will Be Here by Name 107</a></h3>
                                                                            <div class="product-price">
                                                                                <div class="price">
                                                                                    <ins>57.50$</ins>
                                                                                    <del>83.75$</del>
                                                                                </div>
                                                                                <div class="on-sale"><span>31</span><span>% off</span></div>
                                                                            </div>
                                                                            <div class="shipping-feed-back">
                                                                                <div class="star-rating">
                                                                                    <div class="rating-wrap">
                                                                                        <p><i class="fas fa-star"></i><span> 0</span></p>
                                                                                    </div>
                                                                                    <div class="rating-counts-wrap">
                                                                                        <p>(0)</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col mb-1">
                                                                <div class="product type-product">
                                                                    <div class="product-wrapper">
                                                                        <div class="product-image">
                                                                            <a href="https://product.geniusocean.com/geniuscart/item/digital-product-title-will-be-here-by-name-109-ext109m9m-arabic" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/15680267308Mckygzw.png" style=""></a>
                                                                            <div class="wishlist-view">
                                                                                <div class="quickview-button">
                                                                                    <a class="quickview-btn" href="https://product.geniusocean.com/geniuscart/item/digital-product-title-will-be-here-by-name-109-ext109m9m-arabic" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Quick View" aria-label="Quick View">Quick View</a>
                                                                                </div>
                                                                                <div class="whishlist-button">
                                                                                    <a class="add_to_wishlist" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-info">
                                                                            <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/digital-product-title-will-be-here-by-name-109-ext109m9m-arabic">Digital Product Title will Be Here by Name 109</a></h3>
                                                                            <div class="product-price">
                                                                                <div class="price">
                                                                                    <ins>57.50$</ins>
                                                                                    <del>83.75$</del>
                                                                                </div>
                                                                                <div class="on-sale"><span>31</span><span>% off</span></div>
                                                                            </div>
                                                                            <div class="shipping-feed-back">
                                                                                <div class="star-rating">
                                                                                    <div class="rating-wrap">
                                                                                        <p><i class="fas fa-star"></i><span> 0</span></p>
                                                                                    </div>
                                                                                    <div class="rating-counts-wrap">
                                                                                        <p>(0)</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div></div><div class="owl-item" style="width: 286px; margin-right: 30px;"><div class="item">
                                                        <div class="row row-cols-1">

                                                            <div class="col mb-1">
                                                                <div class="product type-product">
                                                                    <div class="product-wrapper">
                                                                        <div class="product-image">
                                                                            <a href="https://product.geniusocean.com/geniuscart/item/license-key-title-will-be-here-according-to-your-wish-111-" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1568029267UZnlkD97.png" style=""></a>
                                                                            <div class="wishlist-view">
                                                                                <div class="quickview-button">
                                                                                    <a class="quickview-btn" href="https://product.geniusocean.com/geniuscart/item/license-key-title-will-be-here-according-to-your-wish-111-" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Quick View" aria-label="Quick View">Quick View</a>
                                                                                </div>
                                                                                <div class="whishlist-button">
                                                                                    <a class="add_to_wishlist" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-info">
                                                                            <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/license-key-title-will-be-here-according-to-your-wish-111-">License key title will be here according to your w...</a></h3>
                                                                            <div class="product-price">
                                                                                <div class="price">
                                                                                    <ins>89$</ins>
                                                                                    <del>110$</del>
                                                                                </div>
                                                                                <div class="on-sale"><span>19</span><span>% off</span></div>
                                                                            </div>
                                                                            <div class="shipping-feed-back">
                                                                                <div class="star-rating">
                                                                                    <div class="rating-wrap">
                                                                                        <p><i class="fas fa-star"></i><span> 0</span></p>
                                                                                    </div>
                                                                                    <div class="rating-counts-wrap">
                                                                                        <p>(0)</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col mb-1">
                                                                <div class="product type-product">
                                                                    <div class="product-wrapper">
                                                                        <div class="product-image">
                                                                            <a href="https://product.geniusocean.com/geniuscart/item/license-key-title-will-be-here-according-to-your-wish-1-" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1648013610nbbGKBia.png" style=""></a>
                                                                            <div class="wishlist-view">
                                                                                <div class="quickview-button">
                                                                                    <a class="quickview-btn" href="https://product.geniusocean.com/geniuscart/item/license-key-title-will-be-here-according-to-your-wish-1-" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Quick View" aria-label="Quick View">Quick View</a>
                                                                                </div>
                                                                                <div class="whishlist-button">
                                                                                    <a class="add_to_wishlist" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-info">
                                                                            <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/license-key-title-will-be-here-according-to-your-wish-1-">License key title will be here according to your w...</a></h3>
                                                                            <div class="product-price">
                                                                                <div class="price">
                                                                                    <ins>89$</ins>
                                                                                    <del>110$</del>
                                                                                </div>
                                                                                <div class="on-sale"><span>19</span><span>% off</span></div>
                                                                            </div>
                                                                            <div class="shipping-feed-back">
                                                                                <div class="star-rating">
                                                                                    <div class="rating-wrap">
                                                                                        <p><i class="fas fa-star"></i><span> 0</span></p>
                                                                                    </div>
                                                                                    <div class="rating-counts-wrap">
                                                                                        <p>(0)</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col mb-1">
                                                                <div class="product type-product">
                                                                    <div class="product-wrapper">
                                                                        <div class="product-image">
                                                                            <a href="https://product.geniusocean.com/geniuscart/item/license-key-title-will-be-here-according-to-your-wish-1-" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1639452704vGVh3Hle.png" style=""></a>
                                                                            <div class="wishlist-view">
                                                                                <div class="quickview-button">
                                                                                    <a class="quickview-btn" href="https://product.geniusocean.com/geniuscart/item/license-key-title-will-be-here-according-to-your-wish-1-" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Quick View" aria-label="Quick View">Quick View</a>
                                                                                </div>
                                                                                <div class="whishlist-button">
                                                                                    <a class="add_to_wishlist" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-info">
                                                                            <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/license-key-title-will-be-here-according-to-your-wish-1-">License key title will be here according to your w...</a></h3>
                                                                            <div class="product-price">
                                                                                <div class="price">
                                                                                    <ins>89$</ins>
                                                                                    <del>110$</del>
                                                                                </div>
                                                                                <div class="on-sale"><span>19</span><span>% off</span></div>
                                                                            </div>
                                                                            <div class="shipping-feed-back">
                                                                                <div class="star-rating">
                                                                                    <div class="rating-wrap">
                                                                                        <p><i class="fas fa-star"></i><span> 0</span></p>
                                                                                    </div>
                                                                                    <div class="rating-counts-wrap">
                                                                                        <p>(0)</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div></div><div class="owl-item" style="width: 286px; margin-right: 30px;"><div class="item">
                                                        <div class="row row-cols-1">

                                                            <div class="col mb-1">
                                                                <div class="product type-product">
                                                                    <div class="product-wrapper">
                                                                        <div class="product-image">
                                                                            <a href="https://product.geniusocean.com/geniuscart/item/affiliate-product-title-will-be-here-affiliate-product-title-will-be-here-116-pr496jsv1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1568027684whVhJDrR.png" style=""></a>
                                                                            <div class="wishlist-view">
                                                                                <div class="quickview-button">
                                                                                    <a class="quickview-btn" href="https://product.geniusocean.com/geniuscart/item/affiliate-product-title-will-be-here-affiliate-product-title-will-be-here-116-pr496jsv1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Quick View" aria-label="Quick View">Quick View</a>
                                                                                </div>
                                                                                <div class="whishlist-button">
                                                                                    <a class="add_to_wishlist" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-info">
                                                                            <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/affiliate-product-title-will-be-here-affiliate-product-title-will-be-here-116-pr496jsv1">Affiliate Product Title will Be Here. Affiliate Pr...</a></h3>
                                                                            <div class="product-price">
                                                                                <div class="price">
                                                                                    <ins>58.50$</ins>
                                                                                    <del>111$</del>
                                                                                </div>
                                                                                <div class="on-sale"><span>47</span><span>% off</span></div>
                                                                            </div>
                                                                            <div class="shipping-feed-back">
                                                                                <div class="star-rating">
                                                                                    <div class="rating-wrap">
                                                                                        <p><i class="fas fa-star"></i><span> 0</span></p>
                                                                                    </div>
                                                                                    <div class="rating-counts-wrap">
                                                                                        <p>(0)</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col mb-1">
                                                                <div class="product type-product">
                                                                    <div class="product-wrapper">
                                                                        <div class="product-image">
                                                                            <a href="https://product.geniusocean.com/geniuscart/item/affiliate-product-title-will-be-here-affiliate-product-title-will-be-here-117-pr497jsv1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1568027658Up0FIXsW.png" style=""></a>
                                                                            <div class="wishlist-view">
                                                                                <div class="quickview-button">
                                                                                    <a class="quickview-btn" href="https://product.geniusocean.com/geniuscart/item/affiliate-product-title-will-be-here-affiliate-product-title-will-be-here-117-pr497jsv1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Quick View" aria-label="Quick View">Quick View</a>
                                                                                </div>
                                                                                <div class="whishlist-button">
                                                                                    <a class="add_to_wishlist" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-info">
                                                                            <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/affiliate-product-title-will-be-here-affiliate-product-title-will-be-here-117-pr497jsv1">Affiliate Product Title will Be Here. Affiliate Pr...</a></h3>
                                                                            <div class="product-price">
                                                                                <div class="price">
                                                                                    <ins>58.50$</ins>
                                                                                    <del>111$</del>
                                                                                </div>
                                                                                <div class="on-sale"><span>47</span><span>% off</span></div>
                                                                            </div>
                                                                            <div class="shipping-feed-back">
                                                                                <div class="star-rating">
                                                                                    <div class="rating-wrap">
                                                                                        <p><i class="fas fa-star"></i><span> 0</span></p>
                                                                                    </div>
                                                                                    <div class="rating-counts-wrap">
                                                                                        <p>(0)</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col mb-1">
                                                                <div class="product type-product">
                                                                    <div class="product-wrapper">
                                                                        <div class="product-image">
                                                                            <a href="https://product.geniusocean.com/geniuscart/item/affiliate-product-title-will-be-here-affiliate-product-title-will-be-here-118-pr498jsv1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1568027631cnmEylRa.png" style=""></a>
                                                                            <div class="wishlist-view">
                                                                                <div class="quickview-button">
                                                                                    <a class="quickview-btn" href="https://product.geniusocean.com/geniuscart/item/affiliate-product-title-will-be-here-affiliate-product-title-will-be-here-118-pr498jsv1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Quick View" aria-label="Quick View">Quick View</a>
                                                                                </div>
                                                                                <div class="whishlist-button">
                                                                                    <a class="add_to_wishlist" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-info">
                                                                            <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/affiliate-product-title-will-be-here-affiliate-product-title-will-be-here-118-pr498jsv1">Affiliate Product Title will Be Here. Affiliate Pr...</a></h3>
                                                                            <div class="product-price">
                                                                                <div class="price">
                                                                                    <ins>58.50$</ins>
                                                                                    <del>111$</del>
                                                                                </div>
                                                                                <div class="on-sale"><span>47</span><span>% off</span></div>
                                                                            </div>
                                                                            <div class="shipping-feed-back">
                                                                                <div class="star-rating">
                                                                                    <div class="rating-wrap">
                                                                                        <p><i class="fas fa-star"></i><span> 0</span></p>
                                                                                    </div>
                                                                                    <div class="rating-counts-wrap">
                                                                                        <p>(0)</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div></div></div></div><div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><div class="nav-btn prev-slide"><i class="fas fa-chevron-left"></i><span>Prev</span></div></button><button type="button" role="presentation" class="owl-next"><div class="nav-btn next-slide"><span>Next</span><i class="fas fa-chevron-right"></i></div></button></div><div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button role="button" class="owl-dot"><span></span></button><button role="button" class="owl-dot"><span></span></button></div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="full-row pt-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="section-head border-bottom d-flex justify-content-between align-items-end mb-2">
                                        <div class="d-flex section-head-side-title">
                                            <h4 class="font-600 text-dark mb-0">Related Products</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="products product-style-1 owl-mx-5">
                                        <div class="five-carousel owl-carousel nav-top-right e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center owl-loaded owl-drag">












                                            <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2943px;"><div class="owl-item active" style="width: 245.2px;"><div class="item">
                                                            <div class="product type-product">
                                                                <div class="product-wrapper">
                                                                    <div class="product-image">
                                                                        <a href="https://product.geniusocean.com/geniuscart/item/top-rated-product-title-will-be-here-according-to-your-wish-102-pr613jsv1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1639456384gCuvZIXe.png" style=""></a>
                                                                        <div class="on-sale">-79%</div>
                                                                        <div class="hover-area">
                                                                            <div class="cart-button">
                                                                                <a href="javascript:;" data-href="https://product.geniusocean.com/geniuscart/addcart/128" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add To Cart" aria-label="Add To Cart"></a>
                                                                            </div>
                                                                            <div class="closed">
                                                                                <a class="button add_to_cart_button add-to-cart-quick" href="javascript:;" data-bs-toggle="tooltip" data-href="https://product.geniusocean.com/geniuscart/addtocart/128" data-bs-placement="right" title="" data-bs-original-title="Buy Now" aria-label="Buy Now"><i class="flaticon-shopping-cart-1 flat-mini mx-auto"></i></a>
                                                                            </div>
                                                                            <div class="wishlist-button">
                                                                                <a class="add_to_wishlist button add_to_cart_button" href="https://product.geniusocean.com/geniuscart/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                            </div>
                                                                            <div class="compare-button">
                                                                                <a class="compare button add_to_cart_button" data-href="https://product.geniusocean.com/geniuscart/item/compare/add/128" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/top-rated-product-title-will-be-here-according-to-your-wish-102-pr613jsv1">Top Rated product title will be here according to ...</a></h3>
                                                                        <div class="product-price">
                                                                            <div class="price">
                                                                                <ins>111$</ins>
                                                                                <del>531$</del>
                                                                            </div>
                                                                        </div>
                                                                        <div class="shipping-feed-back">
                                                                            <div class="star-rating">
                                                                                <div class="rating-wrap">
                                                                                    <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div><div class="owl-item active" style="width: 245.2px;"><div class="item">
                                                            <div class="product type-product">
                                                                <div class="product-wrapper">
                                                                    <div class="product-image">
                                                                        <a href="https://product.geniusocean.com/geniuscart/item/32-napco-dglass-ultra-slim-hd-led-tv-es700e-3uz9903ofs1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1639392738Dts57dc4.png" style=""></a>
                                                                        <div class="on-sale">-37%</div>
                                                                        <div class="hover-area">
                                                                            <div class="cart-button">
                                                                                <a href="javascript:;" data-href="https://product.geniusocean.com/geniuscart/addcart/135" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add To Cart" aria-label="Add To Cart"></a>
                                                                            </div>
                                                                            <div class="closed">
                                                                                <a class="button add_to_cart_button add-to-cart-quick" href="javascript:;" data-bs-toggle="tooltip" data-href="https://product.geniusocean.com/geniuscart/addtocart/135" data-bs-placement="right" title="" data-bs-original-title="Buy Now" aria-label="Buy Now"><i class="flaticon-shopping-cart-1 flat-mini mx-auto"></i></a>
                                                                            </div>
                                                                            <div class="wishlist-button">
                                                                                <a class="add_to_wishlist button add_to_cart_button" href="https://product.geniusocean.com/geniuscart/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                            </div>
                                                                            <div class="compare-button">
                                                                                <a class="compare button add_to_cart_button" data-href="https://product.geniusocean.com/geniuscart/item/compare/add/135" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/32-napco-dglass-ultra-slim-hd-led-tv-es700e-3uz9903ofs1">32 ''NAPCO D/GLASS ULTRA SLIM HD lED TV ES700E</a></h3>
                                                                        <div class="product-price">
                                                                            <div class="price">
                                                                                <ins>36.50$</ins>
                                                                                <del>57.50$</del>
                                                                            </div>
                                                                        </div>
                                                                        <div class="shipping-feed-back">
                                                                            <div class="star-rating">
                                                                                <div class="rating-wrap">
                                                                                    <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div><div class="owl-item active" style="width: 245.2px;"><div class="item">
                                                            <div class="product type-product">
                                                                <div class="product-wrapper">
                                                                    <div class="product-image">
                                                                        <a href="https://product.geniusocean.com/geniuscart/item/32-napco-dglass-ultra-slim-hd-led-tv-es700e-vrx2915o5c1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1639392531ypne3xL8.png" style=""></a>
                                                                        <div class="on-sale">-39%</div>
                                                                        <div class="hover-area">
                                                                            <div class="cart-button">
                                                                                <a href="javascript:;" data-href="https://product.geniusocean.com/geniuscart/addcart/144" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add To Cart" aria-label="Add To Cart"></a>
                                                                            </div>
                                                                            <div class="closed">
                                                                                <a class="button add_to_cart_button add-to-cart-quick" href="javascript:;" data-bs-toggle="tooltip" data-href="https://product.geniusocean.com/geniuscart/addtocart/144" data-bs-placement="right" title="" data-bs-original-title="Buy Now" aria-label="Buy Now"><i class="flaticon-shopping-cart-1 flat-mini mx-auto"></i></a>
                                                                            </div>
                                                                            <div class="wishlist-button">
                                                                                <a class="add_to_wishlist button add_to_cart_button" href="https://product.geniusocean.com/geniuscart/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                            </div>
                                                                            <div class="compare-button">
                                                                                <a class="compare button add_to_cart_button" data-href="https://product.geniusocean.com/geniuscart/item/compare/add/144" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/32-napco-dglass-ultra-slim-hd-led-tv-es700e-vrx2915o5c1">32 ''NAPCO D/GLASS ULTRA SLIM HD lED TV ES700E</a></h3>
                                                                        <div class="product-price">
                                                                            <div class="price">
                                                                                <ins>335$</ins>
                                                                                <del>545$</del>
                                                                            </div>
                                                                        </div>
                                                                        <div class="shipping-feed-back">
                                                                            <div class="star-rating">
                                                                                <div class="rating-wrap">
                                                                                    <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div><div class="owl-item active" style="width: 245.2px;"><div class="item">
                                                            <div class="product type-product">
                                                                <div class="product-wrapper">
                                                                    <div class="product-image">
                                                                        <a href="https://product.geniusocean.com/geniuscart/item/revel-real-estate-html-template-zhv5144fry1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1639392452QopalU8v.png" style=""></a>
                                                                        <div class="on-sale">-13%</div>
                                                                        <div class="hover-area">
                                                                            <div class="cart-button">
                                                                                <a href="javascript:;" data-href="https://product.geniusocean.com/geniuscart/addcart/159" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add To Cart" aria-label="Add To Cart"></a>
                                                                            </div>
                                                                            <div class="closed">
                                                                                <a class="button add_to_cart_button add-to-cart-quick" href="javascript:;" data-bs-toggle="tooltip" data-href="https://product.geniusocean.com/geniuscart/addtocart/159" data-bs-placement="right" title="" data-bs-original-title="Buy Now" aria-label="Buy Now"><i class="flaticon-shopping-cart-1 flat-mini mx-auto"></i></a>
                                                                            </div>
                                                                            <div class="wishlist-button">
                                                                                <a class="add_to_wishlist button add_to_cart_button" href="https://product.geniusocean.com/geniuscart/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                            </div>
                                                                            <div class="compare-button">
                                                                                <a class="compare button add_to_cart_button" data-href="https://product.geniusocean.com/geniuscart/item/compare/add/159" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/revel-real-estate-html-template-zhv5144fry1">Revel - Real Estate HTML Template</a></h3>
                                                                        <div class="product-price">
                                                                            <div class="price">
                                                                                <ins>320$</ins>
                                                                                <del>368.30$</del>
                                                                            </div>
                                                                        </div>
                                                                        <div class="shipping-feed-back">
                                                                            <div class="star-rating">
                                                                                <div class="rating-wrap">
                                                                                    <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div><div class="owl-item active" style="width: 245.2px;"><div class="item">
                                                            <div class="product type-product">
                                                                <div class="product-wrapper">
                                                                    <div class="product-image">
                                                                        <a href="https://product.geniusocean.com/geniuscart/item/zain-digital-agency-and-startup-html-template-o1l5621dis1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1639392363pYiiT6Vy.png" style=""></a>
                                                                        <div class="on-sale">-0%</div>
                                                                        <div class="hover-area">
                                                                            <div class="closed">
                                                                                <a class="cart-out-of-stock button add_to_cart_button" href="#" title="Out Of Stock"><i class="flaticon-cancel flat-mini mx-auto"></i></a>
                                                                            </div>
                                                                            <div class="wishlist-button">
                                                                                <a class="add_to_wishlist button add_to_cart_button" href="https://product.geniusocean.com/geniuscart/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                            </div>
                                                                            <div class="compare-button">
                                                                                <a class="compare button add_to_cart_button" data-href="https://product.geniusocean.com/geniuscart/item/compare/add/160" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/zain-digital-agency-and-startup-html-template-o1l5621dis1">Zain - Digital Agency and Startup HTML Template</a></h3>
                                                                        <div class="product-price">
                                                                            <div class="price">
                                                                                <ins>368.30$</ins>
                                                                                <del>368.30$</del>
                                                                            </div>
                                                                        </div>
                                                                        <div class="shipping-feed-back">
                                                                            <div class="star-rating">
                                                                                <div class="rating-wrap">
                                                                                    <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div><div class="owl-item" style="width: 245.2px;"><div class="item">
                                                            <div class="product type-product">
                                                                <div class="product-wrapper">
                                                                    <div class="product-image">
                                                                        <a href="https://product.geniusocean.com/geniuscart/item/revel-real-estate-html-template-d2e6433yi01" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/16393784188Gm57Wu2.png" style=""></a>
                                                                        <div class="on-sale">-23%</div>
                                                                        <div class="hover-area">
                                                                            <div class="closed">
                                                                                <a class="cart-out-of-stock button add_to_cart_button" href="#" title="Out Of Stock"><i class="flaticon-cancel flat-mini mx-auto"></i></a>
                                                                            </div>
                                                                            <div class="wishlist-button">
                                                                                <a class="add_to_wishlist button add_to_cart_button" href="https://product.geniusocean.com/geniuscart/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                            </div>
                                                                            <div class="compare-button">
                                                                                <a class="compare button add_to_cart_button" data-href="https://product.geniusocean.com/geniuscart/item/compare/add/161" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/revel-real-estate-html-template-d2e6433yi01">Revel - Real Estate HTML Template</a></h3>
                                                                        <div class="product-price">
                                                                            <div class="price">
                                                                                <ins>350$</ins>
                                                                                <del>455$</del>
                                                                            </div>
                                                                        </div>
                                                                        <div class="shipping-feed-back">
                                                                            <div class="star-rating">
                                                                                <div class="rating-wrap">
                                                                                    <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div><div class="owl-item" style="width: 245.2px;"><div class="item">
                                                            <div class="product type-product">
                                                                <div class="product-wrapper">
                                                                    <div class="product-image">
                                                                        <a href="https://product.geniusocean.com/geniuscart/item/zain-digital-agency-and-startup-html-template-toc5844n0t1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1639378156F9SBl2Yx.png" style=""></a>
                                                                        <div class="on-sale">-8%</div>
                                                                        <div class="hover-area">
                                                                            <div class="cart-button">
                                                                                <a href="javascript:;" data-href="https://product.geniusocean.com/geniuscart/addcart/162" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add To Cart" aria-label="Add To Cart"></a>
                                                                            </div>
                                                                            <div class="closed">
                                                                                <a class="button add_to_cart_button add-to-cart-quick" href="javascript:;" data-bs-toggle="tooltip" data-href="https://product.geniusocean.com/geniuscart/addtocart/162" data-bs-placement="right" title="" data-bs-original-title="Buy Now" aria-label="Buy Now"><i class="flaticon-shopping-cart-1 flat-mini mx-auto"></i></a>
                                                                            </div>
                                                                            <div class="wishlist-button">
                                                                                <a class="add_to_wishlist button add_to_cart_button" href="https://product.geniusocean.com/geniuscart/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                            </div>
                                                                            <div class="compare-button">
                                                                                <a class="compare button add_to_cart_button" data-href="https://product.geniusocean.com/geniuscart/item/compare/add/162" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/zain-digital-agency-and-startup-html-template-toc5844n0t1">Zain - Digital Agency and Startup HTML Template</a></h3>
                                                                        <div class="product-price">
                                                                            <div class="price">
                                                                                <ins>570$</ins>
                                                                                <del>622.50$</del>
                                                                            </div>
                                                                        </div>
                                                                        <div class="shipping-feed-back">
                                                                            <div class="star-rating">
                                                                                <div class="rating-wrap">
                                                                                    <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div><div class="owl-item" style="width: 245.2px;"><div class="item">
                                                            <div class="product type-product">
                                                                <div class="product-wrapper">
                                                                    <div class="product-image">
                                                                        <a href="https://product.geniusocean.com/geniuscart/item/zain-digital-agency-and-startup-html-template-1ui8665inp1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1648014087Du4NpEMJ.png" style=""></a>
                                                                        <div class="on-sale">-35%</div>
                                                                        <div class="hover-area">
                                                                            <div class="cart-button">
                                                                                <a href="javascript:;" data-href="https://product.geniusocean.com/geniuscart/addcart/163" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add To Cart" aria-label="Add To Cart"></a>
                                                                            </div>
                                                                            <div class="closed">
                                                                                <a class="button add_to_cart_button add-to-cart-quick" href="javascript:;" data-bs-toggle="tooltip" data-href="https://product.geniusocean.com/geniuscart/addtocart/163" data-bs-placement="right" title="" data-bs-original-title="Buy Now" aria-label="Buy Now"><i class="flaticon-shopping-cart-1 flat-mini mx-auto"></i></a>
                                                                            </div>
                                                                            <div class="wishlist-button">
                                                                                <a class="add_to_wishlist button add_to_cart_button" href="https://product.geniusocean.com/geniuscart/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                            </div>
                                                                            <div class="compare-button">
                                                                                <a class="compare button add_to_cart_button" data-href="https://product.geniusocean.com/geniuscart/item/compare/add/163" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/zain-digital-agency-and-startup-html-template-1ui8665inp1">Zain - Digital Agency and Startup HTML Template</a></h3>
                                                                        <div class="product-price">
                                                                            <div class="price">
                                                                                <ins>321$</ins>
                                                                                <del>493.20$</del>
                                                                            </div>
                                                                        </div>
                                                                        <div class="shipping-feed-back">
                                                                            <div class="star-rating">
                                                                                <div class="rating-wrap">
                                                                                    <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div><div class="owl-item" style="width: 245.2px;"><div class="item">
                                                            <div class="product type-product">
                                                                <div class="product-wrapper">
                                                                    <div class="product-image">
                                                                        <a href="https://product.geniusocean.com/geniuscart/item/zain-digital-agency-and-startup-html-template-rxp8737lev1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1639378035iwML8B6F.png" style=""></a>
                                                                        <div class="on-sale">-45%</div>
                                                                        <div class="hover-area">
                                                                            <div class="cart-button">
                                                                                <a href="javascript:;" data-href="https://product.geniusocean.com/geniuscart/addcart/164" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add To Cart" aria-label="Add To Cart"></a>
                                                                            </div>
                                                                            <div class="closed">
                                                                                <a class="button add_to_cart_button add-to-cart-quick" href="javascript:;" data-bs-toggle="tooltip" data-href="https://product.geniusocean.com/geniuscart/addtocart/164" data-bs-placement="right" title="" data-bs-original-title="Buy Now" aria-label="Buy Now"><i class="flaticon-shopping-cart-1 flat-mini mx-auto"></i></a>
                                                                            </div>
                                                                            <div class="wishlist-button">
                                                                                <a class="add_to_wishlist button add_to_cart_button" href="https://product.geniusocean.com/geniuscart/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                            </div>
                                                                            <div class="compare-button">
                                                                                <a class="compare button add_to_cart_button" data-href="https://product.geniusocean.com/geniuscart/item/compare/add/164" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/zain-digital-agency-and-startup-html-template-rxp8737lev1">Zain - Digital Agency and Startup HTML Template</a></h3>
                                                                        <div class="product-price">
                                                                            <div class="price">
                                                                                <ins>321$</ins>
                                                                                <del>581.40$</del>
                                                                            </div>
                                                                        </div>
                                                                        <div class="shipping-feed-back">
                                                                            <div class="star-rating">
                                                                                <div class="rating-wrap">
                                                                                    <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div><div class="owl-item" style="width: 245.2px;"><div class="item">
                                                            <div class="product type-product">
                                                                <div class="product-wrapper">
                                                                    <div class="product-image">
                                                                        <a href="https://product.geniusocean.com/geniuscart/item/zain-digital-agency-and-startup-html-template-rxp8737le1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1648013669fVYfMbbZ.png" style=""></a>
                                                                        <div class="on-sale">-45%</div>
                                                                        <div class="hover-area">
                                                                            <div class="cart-button">
                                                                                <a href="javascript:;" data-href="https://product.geniusocean.com/geniuscart/addcart/165" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add To Cart" aria-label="Add To Cart"></a>
                                                                            </div>
                                                                            <div class="closed">
                                                                                <a class="button add_to_cart_button add-to-cart-quick" href="javascript:;" data-bs-toggle="tooltip" data-href="https://product.geniusocean.com/geniuscart/addtocart/165" data-bs-placement="right" title="" data-bs-original-title="Buy Now" aria-label="Buy Now"><i class="flaticon-shopping-cart-1 flat-mini mx-auto"></i></a>
                                                                            </div>
                                                                            <div class="wishlist-button">
                                                                                <a class="add_to_wishlist button add_to_cart_button" href="https://product.geniusocean.com/geniuscart/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                            </div>
                                                                            <div class="compare-button">
                                                                                <a class="compare button add_to_cart_button" data-href="https://product.geniusocean.com/geniuscart/item/compare/add/165" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/zain-digital-agency-and-startup-html-template-rxp8737le1">Zain - Digital Agency and Startup HTML Template</a></h3>
                                                                        <div class="product-price">
                                                                            <div class="price">
                                                                                <ins>320$</ins>
                                                                                <del>580.40$</del>
                                                                            </div>
                                                                        </div>
                                                                        <div class="shipping-feed-back">
                                                                            <div class="star-rating">
                                                                                <div class="rating-wrap">
                                                                                    <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div><div class="owl-item" style="width: 245.2px;"><div class="item">
                                                            <div class="product type-product">
                                                                <div class="product-wrapper">
                                                                    <div class="product-image">
                                                                        <a href="https://product.geniusocean.com/geniuscart/item/revel-real-estate-huuu-tbs53803yh1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1648013500i2EEZrBt.png" style=""></a>
                                                                        <div class="on-sale">-12%</div>
                                                                        <div class="hover-area">
                                                                            <div class="cart-button">
                                                                                <a href="javascript:;" data-href="https://product.geniusocean.com/geniuscart/addcart/168" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add To Cart" aria-label="Add To Cart"></a>
                                                                            </div>
                                                                            <div class="closed">
                                                                                <a class="button add_to_cart_button add-to-cart-quick" href="javascript:;" data-bs-toggle="tooltip" data-href="https://product.geniusocean.com/geniuscart/addtocart/168" data-bs-placement="right" title="" data-bs-original-title="Buy Now" aria-label="Buy Now"><i class="flaticon-shopping-cart-1 flat-mini mx-auto"></i></a>
                                                                            </div>
                                                                            <div class="wishlist-button">
                                                                                <a class="add_to_wishlist button add_to_cart_button" href="https://product.geniusocean.com/geniuscart/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                            </div>
                                                                            <div class="compare-button">
                                                                                <a class="compare button add_to_cart_button" data-href="https://product.geniusocean.com/geniuscart/item/compare/add/168" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/revel-real-estate-huuu-tbs53803yh1">Revel - Real Estate Huuu</a></h3>
                                                                        <div class="product-price">
                                                                            <div class="price">
                                                                                <ins>335$</ins>
                                                                                <del>382.25$</del>
                                                                            </div>
                                                                        </div>
                                                                        <div class="shipping-feed-back">
                                                                            <div class="star-rating">
                                                                                <div class="rating-wrap">
                                                                                    <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div><div class="owl-item" style="width: 245.2px;"><div class="item">
                                                            <div class="product type-product">
                                                                <div class="product-wrapper">
                                                                    <div class="product-image">
                                                                        <a href="https://product.geniusocean.com/geniuscart/item/top-rated-product-title-will-be-here-according-to-your-wish-123-trg5938wny1" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://product.geniusocean.com/geniuscart/assets/images/products/1639377739mqNT2g2x.png" style=""></a>
                                                                        <div class="on-sale">-79%</div>
                                                                        <div class="hover-area">
                                                                            <div class="cart-button">
                                                                                <a href="javascript:;" data-href="https://product.geniusocean.com/geniuscart/addcart/169" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add To Cart" aria-label="Add To Cart"></a>
                                                                            </div>
                                                                            <div class="closed">
                                                                                <a class="button add_to_cart_button add-to-cart-quick" href="javascript:;" data-bs-toggle="tooltip" data-href="https://product.geniusocean.com/geniuscart/addtocart/169" data-bs-placement="right" title="" data-bs-original-title="Buy Now" aria-label="Buy Now"><i class="flaticon-shopping-cart-1 flat-mini mx-auto"></i></a>
                                                                            </div>
                                                                            <div class="wishlist-button">
                                                                                <a class="add_to_wishlist button add_to_cart_button" href="https://product.geniusocean.com/geniuscart/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                                            </div>
                                                                            <div class="compare-button">
                                                                                <a class="compare button add_to_cart_button" data-href="https://product.geniusocean.com/geniuscart/item/compare/add/169" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="https://product.geniusocean.com/geniuscart/item/top-rated-product-title-will-be-here-according-to-your-wish-123-trg5938wny1">Top Rated product title will be here according to ...</a></h3>
                                                                        <div class="product-price">
                                                                            <div class="price">
                                                                                <ins>110$</ins>
                                                                                <del>530$</del>
                                                                            </div>
                                                                        </div>
                                                                        <div class="shipping-feed-back">
                                                                            <div class="star-rating">
                                                                                <div class="rating-wrap">
                                                                                    <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div></div></div><div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><div class="nav-btn prev-slide"><i class="fas fa-chevron-left"></i><span>Prev</span></div></button><button type="button" role="presentation" class="owl-next"><div class="nav-btn next-slide"><span>Next</span><i class="fas fa-chevron-right"></i></div></button></div><div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button role="button" class="owl-dot"><span></span></button><button role="button" class="owl-dot"><span></span></button></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--<div class="row mobile-reverse">

                        <div class="row single-product-wrapper mt-3">
                            <div class="col-lg-5 mb-4 mb-lg-0">

                                @if ($info->image != null)
                                    <div class="slideShow">
                                        <!-- Images in the slideshow -->
                                        <div class="image-carousel">
                                            <div class="carousel-container">
                                                @foreach ($images as $key => $item)
                                                    <img class="mySlides" src="{{ asset('upload/'.$info->image) }}">
                                                @endforeach
                                                <a class="previous" onclick="plusSlides(-1)">❮</a>
                                                <a class="next" onclick="plusSlides(1)" style="float: right;">❯</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row p-2">
                                        @foreach ($images as $key => $item)
                                            <div class="col-lg-{{ $div_value }} text-center p-2">
                                                <img class="demo w3-opacity w3-hover-opacity-off" src="{{ asset($item) }}"
                                                    onclick="currentDiv({{ $key + 1 }})">
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <figure class="woocommerce-product-gallery__wrapper">
                                        <div class="bg-light">
                                            <img id="single-image-zoom" src="{{ asset($first_image) }}">
                                        </div>
                                    </figure>
                                @endif

                            </div>

                            <div class="col-lg-7 col-md-8">
                                <div class="summary entry-summary">
                                    <div class="summary-inner">

                                        <h1 class="product_title entry-title">{{ $info->name }}</h1>
                                        <h3 class="product_title entry-title">&pound; {{ $info->reselling_price }}</h3>

                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="pro-details">
                                                    <section class="row">

                                                        <div class="col-lg-12 call-button mb-2" style="display: flex; align-items: center;">
                                                            <a href="tel:{{ $info->tel }}" class="button-31" id="call_button_id" style="width: 180px; margin-left: 9px;">Add To Cart</a>
                                                            <span id="call_id" style="display: none; margin-left: 10px;">{{ $info->tel }}</span>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="button-31"
                                                                 style="display:block; align-items: center; margin-left: 9px; width: 180px; background: #e0892f;">
                                                                Order Now
                                                            </div>
                                                        </div>

                                                    </section>
                                                </div>

                                                @include('frontend.social_media_share.social_media')

                                                <div class="yith-wcwl-add-to-wishlist wishlist-fragment mt-3">
                                                    <div class="wishlist-button">
                                                        <a class="add_to_wishlist" href="">Wishlist</a>
                                                    </div>
                                                    <div class="compare-button">
                                                        <a class="compare button" href="">Compare</a>
                                                    </div>

                                                </div>

                                                <div class="report-area">
                                                    <a class="report-item" href="#"><i class="fas fa-flag"></i> Report
                                                        This
                                                        Item </a>
                                                </div>
                                            </div>

                                            <div class="col-lg-7 mt-3">
                                                <div class="pro-details-sidebar-item mb-4">
                                                    <span> Contact </span>

                                                    @php
                                                        $imageUrl = $user_info && $user_info->file_name && File::exists(public_path("uploads/media/{$user_info->file_name}")) ? asset("uploads/media/{$user_info->file_name}") : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                                    @endphp

                                                    <div>
                                                        <img class="" src="{{ $imageUrl }}" alt=""
                                                            width="100" height="100">
                                                    </div>

                                                    <strong>
                                                        {{ $info->user->surname ?? '' }}
                                                        {{ $info->user->first_name ?? '' }}
                                                        {{ $info->user->last_name ?? '' }}
                                                        @if ($info->plan)
                                                            ( {{ $info->plan }} )
                                                        @else
                                                            ( Free )
                                                        @endif
                                                    </strong>

                                                    <p style="background: #45606b; color: #fff">
                                                        {{ $info->why_is_searching }}</p>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>--}}

                    {{--<hr class="mt-3" style="width: 100%; height: 3px; margin: 0px;">

                    <div class="row">
                        <p style="margin-bottom: 0px; margin-top: 5px;">{!! @$info->product_description !!} </p>
                    </div>

                    <hr class="mb-3" style="width: 100%; height: 3px; margin: 0px;">

                    <div class="row">

                        <div class="col-lg-7" style="text-align: justify">
                            <p class="product-title">{!! @$info->product_description !!} </p>
                        </div>

                        <div class="col-lg-5 mt-3">


                            <div class="property_details">

                                <h5>Product Details</h5>

                                @if ($info->type)
                                    <p>
                                        <strong>Product Type: </strong>
                                        {{ $info->type ?? '' }}
                                    </p>
                                @endif

                                @if ($info->brand_id)
                                    <p>
                                        <strong>Brand Name: </strong>
                                        {{ $info->brand->name }}
                                    </p>
                                @endif

                                @if ($info->unit_id)
                                    <p>
                                        <strong>Unit: </strong>
                                        {{ $info->unit->actual_name }}
                                    </p>
                                @endif

                                @if ($info->sku)
                                    <p>
                                        <strong>SKU: </strong>
                                        {{ $info->sku }}
                                    </p>
                                @endif

                                @if ($info->weight)
                                    <p>
                                        <strong>Weight: </strong>
                                        {{ $info->weight }}
                                    </p>
                                @endif

                                @if ($info->tax)
                                    <p>
                                        <strong>Tax: </strong>
                                        {{ $info->tax }}
                                    </p>
                                @endif

                                @if ($info->tax_type)
                                    <p>
                                        <strong>Tax Type: </strong>
                                        {{ $info->tax_type }}
                                    </p>
                                @endif

                            </div>

                            <hr class="mt-3 mb-3" style="width: 100%; height: 3px; margin: 0px;">

                            <h5>Availability</h5>

                            @if ($info->available_form)
                                <p>
                                    <strong>Total Budget: </strong>
                                    £{{ $info->combined_budget }} {{ $info->per }}
                                </p>
                            @endif

                            <p>
                                <strong>Combined Income Before Tax: </strong>
                                £{{ @$total_monthly_income_before_tax }} Per month
                            </p>

                            @if ($info->available_form)
                                <p>
                                    <strong>Available From: </strong>
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d', $info->available_form)->format('M d') }}
                                </p>
                            @endif

                            @if ($info->min_term)
                                <p>
                                    <strong>Minimum term: </strong>
                                    {{ $info->min_term ?? '' }}
                                </p>
                            @endif

                            @if ($info->max_term)
                                <p>
                                    <strong>Maximum term: </strong>
                                    {{ $info->max_term ?? '' }} months
                                </p>
                            @endif

                            <hr class="mt-3 mb-3" style="width: 100%; height: 3px; margin: 0px;">

                            <h5>Preferred Area</h5>

                            @if ($info->wanted_living_area)
                                <p>
                                    <strong>Wanted Living Area: </strong>
                                    {{ $info->wanted_living_area }}
                                </p>
                            @endif

                            <hr class="mt-3 mb-3" style="width: 100%; height: 3px; margin: 0px;">

                            <h5>Preferred Amenities</h5>

                            @if ($info->roomfurnishings)
                                @php
                                    $amenities = json_decode($info->roomfurnishings, true);
                            
                                    if (is_array($amenities)) {
                                        array_walk($amenities, function (&$amenity) {
                                            $amenity = ucfirst($amenity);
                                        });
                                    }
                                @endphp
                            
                                <p>
                                    <strong>Amenities: </strong>
                                    @if (is_array($amenities))
                                        @foreach ($amenities as $item)
                                            <span>{{ $item }}, </span>
                                        @endforeach
                                    @endif
                                </p>
                            @endif

                            --}}{{-- $info->child_category_id == 11 means child_categories table value Room check child_categories table --}}{{--
                            @if ($info->child_category_id == 11)

                                <hr class="mt-3 mb-3" style="width: 100%; height: 3px; margin: 0px;">

                                <h5>Household Preference</h5>

                                @if ($info->age)
                                    @php
                                        $old = json_decode($info->age, true);
                                    @endphp
                                    <p>
                                        <strong>Age Range: </strong>
                                        @foreach ($old as $key => $item)
                                            {{ $item }}
                                            @if ($key == 0)
                                                to
                                            @endif
                                        @endforeach
                                        Years
                                    </p>
                                @endif

                                @if ($info->occupation)
                                    <p>
                                        <strong>Occupation: </strong>
                                        {{ $info->occupation ?? '' }}
                                    </p>
                                @endif

                                @if ($info->smoking_current)
                                    <p>
                                        <strong>Smoking: </strong>
                                        {{ $info->smoking_current == 1 ? 'Yes' : 'No' }}
                                    </p>
                                @endif

                                @if ($info->pets)
                                    <p>
                                        <strong>Pets: </strong>
                                        {{ $info->pets == 1 ? 'Yes' : 'No' }}
                                    </p>
                                @endif

                                @if ($info->pets)
                                    <p>
                                        <strong>Pets: </strong>
                                        {{ $info->pets == 1 ? 'Yes' : 'No' }}
                                    </p>
                                @endif

                                @if ($info->gay_lesbian)
                                    <p>
                                        <strong>Preferred Sex: </strong>
                                        {{ $info->gay_lesbian }}
                                    </p>
                                @endif

                                @if ($info->lang_id)
                                    <p>
                                        <strong>Preferred Language: </strong>
                                        {{ $info->lang_id }}
                                    </p>
                                @endif

                                @if ($info->nationality)
                                    <p>
                                        <strong>Preferred Nationality: </strong>
                                        {{ $info->nationality }}
                                    </p>
                                @endif

                            @endif

                        </div>

                    </div>--}}

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('frontend.service.partial.property_script')
@endsection
