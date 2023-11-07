@extends('frontend.layouts.master_layout')

@section('css')
    @include('frontend.service.partial.property_style')
@endsection

@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="shop-list-page">
        <div class="full-row py-5" style="background: #4d6873;">
            <div class="container">
                <div class="row text-center text-white">
                    <div class="col-12">
                        {{--@if ($info->plan)
                            <h3 class="mb-2 text-white" style="text-transform: capitalize;">
                                Find a property for this tenant get 30% &#163;{{ $info->payment_check->amount * 0.3 }}</h3>
                        @endif
                        @if ($info->upgraded !== 1)
                            <h3 class="mb-2 text-white" style="text-transform: capitalize;">
                                Help this tenant to get this property</h3>
                        @endif--}}

                    </div>
                </div>
            </div>
        </div>

        <!-- breadcrumb -->
        <div class="shop-list-page">

            <div class="mt-2 content-circle">

                <div class="container">
                    <div class="row mobile-reverse">

                        <div class="row single-product-wrapper mt-3">
                            <div class="col-lg-5 mb-4 mb-lg-0">

                                @if ($info->image != null)
                                    <div class="slideShow">
                                        <!-- Images in the slideshow -->
                                        <div class="image-carousel">
                                            <div class="carousel-container">
{{--                                                @foreach ($images as $key => $item)--}}
                                                    <img class="mySlides" src="{{ asset('upload/'.$info->image) }}">
{{--                                                @endforeach--}}
{{--                                                <a class="previous" onclick="plusSlides(-1)">❮</a>--}}
{{--                                                <a class="next" onclick="plusSlides(1)" style="float: right;">❯</a>--}}
                                            </div>
                                        </div>
                                    </div>

                                    {{--<div class="row p-2">
                                        @foreach ($images as $key => $item)
                                            <div class="col-lg-{{ $div_value }} text-center p-2">
                                                <img class="demo w3-opacity w3-hover-opacity-off" src="{{ asset($item) }}"
                                                    onclick="currentDiv({{ $key + 1 }})">
                                            </div>
                                        @endforeach
                                    </div>--}}
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
                                        <h3 class="product_title entry-title">&pound; {{ $info->price }}</h3>

                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="pro-details">
                                                    <section class="row">
                                                        <div class="col-lg-12">
                                                            <div class="button-31 mb-2"
                                                                 style="display:block; align-items: center; margin-left: 9px; width: 180px; background: #e0892f;">
                                                                Order Now
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 call-button" style="display: flex; align-items: center;">
                                                            <a href="tel:{{ $info->tel }}" class="button-31"
                                                               id="call_button_id"
                                                               style="width: 180px; margin-left: 9px;">Call</a>
                                                            <span id="call_id"
                                                                  style="display: none; margin-left: 10px;">{{ $info->tel }}</span>
                                                        </div>
                                                    </section>
                                                </div>

                                                @include('frontend.social_media_share.social_media')

                                                <div class="yith-wcwl-add-to-wishlist wishlist-fragment mt-3">
                                                    <div class="wishlist-button">
                                                        <a class="add_to_wishlist" href="">Wishlist</a>
                                                    </div>
                                                    {{--<div class="compare-button">
                                                        <a class="compare button" href="">Compare</a>
                                                    </div>--}}

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

                    </div>

                    <hr class="mt-3 mb-3" style="width: 100%; height: 3px; margin: 0px;">

                    <div class="row">
                        <p>{!! @$info->product_description !!} </p>
                    </div>

                    <div class="row">

                        <div class="col-lg-7 p-4" style="text-align: justify">
                            <p class="product-title">{!! @$info->product_description !!} </p>
                        </div>

                        <div class="col-lg-5 mt-3">

                            <hr class="mt-3 mb-3" style="width: 100%; height: 3px; margin: 0px;">

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

                            {{-- $info->child_category_id == 11 means child_categories table value Room check child_categories table --}}
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

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('frontend.service.partial.property_script')
@endsection
