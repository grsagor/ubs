@extends('frontend.layouts.master_layout')

@section('css')
    @include('frontend.service.partial.property_style')
@endsection

@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="shop-list-page">

        <div class="full-row bg-light overlay-dark py-5">
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
                                <li class="breadcrumb-item active" aria-current="page">Service</li>
                                <li class="breadcrumb-item active" aria-current="page">Education Details</li>
                            </ol>
                        </nav>
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

                                @if ($info->images != null)
                                    <div class="slideShow">
                                        <!-- Images in the slideshow -->
                                        <div class="image-carousel">
                                            <div class="carousel-container">
                                                @foreach ($images as $key => $item)
                                                    <img class="mySlides" src="{{ asset($item) }}">
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

                                        <h1 class="product_title entry-title">{{ $info->course_name }}</h1>

                                        <div class="row">
                                            <div class="col-lg-5">

                                                <div class="pro-details" style="margin-top: 0px;">

                                                    @if ($info->property_postcode)
                                                        <p style="margin: 10px;">
                                                            <strong>Post Code: </strong>
                                                            {{ $info->property_postcode ?? '' }} months
                                                        </p>
                                                    @endif

                                                    @if ($info->transport_minutes)
                                                        <p style="margin: 10px;">
                                                            <strong>Distance from station: </strong>
                                                            {{ $info->transport_minutes ?? '' }}
                                                            {{ $info->transport_form ?? '' }}
                                                            {{ $info->transport_to ?? '' }}
                                                        </p>
                                                    @endif


                                                    <div class="pro-info">

                                                        <form method="POST"
                                                            action="{{ route('room.referenceNumberCheck', $info->id) }}"
                                                            style="margin: 0px;">
                                                            @csrf
                                                            @method('PUT')

                                                            <input type="hidden" name="bill"
                                                                value="{{ @$service_charge }}">

                                                            <section class="row">

                                                                <div class="col-lg-12">
                                                                    <div class="button-31 mt-2" data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModal"
                                                                        style="display:block; align-items: center; width:170px;">
                                                                        Book Now
                                                                        @if ($info->child_category_id == 2 || $info->child_category_id == 6)
                                                                            £{{ $info->rent }}
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </section>




                                                            {{-- Modal --}}
                                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                                Reference
                                                                                Number</h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Please call <a
                                                                                    href="callto:{{ $info->user->contact_no }}">{{ $info->user->contact_no }}</a>
                                                                                to get the reference id.</p>
                                                                            <div class="mb-3">
                                                                                <input type="text" class="form-control"
                                                                                    id="inputName" name="reference_number"
                                                                                    placeholder="Enter reference number"
                                                                                    style="width: 100%;">

                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Buy</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Modal --}}

                                                        </form>

                                                    </div>
                                                </div>

                                                <div class="call-button" style="display: flex; align-items: center;">
                                                    <a href="tel:{{ $info->advert_telephone }}" class="button-31"
                                                        id="call_button_id" style="width: 170px;">Call</a>
                                                </div>

                                                <p id="call_id" class="mt-2" style="display: none; margin-left: 10px;">
                                                    {{ $info->advert_telephone }}</p>

                                                <div class="my-2 social-linkss social-sharing a2a_kit a2a_kit_size_32"
                                                    style="line-height: 32px;">
                                                    <h5 class="mb-2">Share Now</h5>
                                                    <ul class="social-icons py-1 share-product social-linkss py-md-0">
                                                        <li>
                                                            <a class="facebook a2a_button_facebook" href="/#facebook"
                                                                target="_blank" rel="nofollow noopener">
                                                                <i class="fab fa-facebook-f"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="twitter a2a_button_twitter" href="/#twitter"
                                                                target="_blank" rel="nofollow noopener">
                                                                <i class="fab fa-twitter"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="linkedin a2a_button_linkedin" href="/#linkedin"
                                                                target="_blank" rel="nofollow noopener">
                                                                <i class="fab fa-linkedin-in"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="pinterest a2a_button_pinterest" href="/#pinterest"
                                                                target="_blank" rel="nofollow noopener">
                                                                <i class="fab fa-pinterest-p"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="instagram a2a_button_whatsapp" href="/#whatsapp"
                                                                target="_blank" rel="nofollow noopener">
                                                                <i class="fab fa-whatsapp"></i>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                </div>

                                                <div class="yith-wcwl-add-to-wishlist wishlist-fragment mt-3">
                                                    <div class="wishlist-button">
                                                        <a class="add_to_wishlist" href="">Wishlist</a>
                                                    </div>
                                                    {{-- <div class="compare-button">
                                                        <a class="compare button" href="">Compare</a>
                                                    </div> --}}

                                                </div>

                                                <div class="report-area">
                                                    <a class="report-item" href="#"><i class="fas fa-flag"></i>
                                                        Report
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

                    <hr class="mt-3" style="width: 100%; height: 2px; margin: 0px;">

                    <div class="row">

                        <div class="col-lg-7 p-4" style="text-align: justify">
                            <p class="product-title">{{ $info->description }}</p>
                        </div>

                        <div class="col-lg-5 mt-3">

                            <h5>Availability</h5>

                            @if ($info->available_form)
                                <p>
                                    <strong>Total Budget: </strong>
                                    £{{ $info->combined_budget }} {{ $info->per }}
                                </p>
                            @endif

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

                            <hr class="mb-2" style="width: 100%; height: 2px; margin: 0px;">

                            <h5>Preferred Area</h5>

                            @if ($info->wanted_living_area)
                                <p>
                                    <strong>Wanted Living Area: </strong>
                                    {{ $info->wanted_living_area }}
                                </p>
                            @endif

                            <hr class="mb-2" style="width: 100%; height: 2px; margin: 0px;">

                            <h5>Preferred Amenities</h5>

                            @if ($info->roomfurnishings != null)
                                @php
                                    $amenities = json_decode($info->roomfurnishings, true);

                                    array_walk($amenities, function (&$amenity) {
                                        $amenity = ucfirst($amenity);
                                    });
                                @endphp
                                <p>
                                    <strong>Amenities: </strong>
                                    @foreach ($amenities as $item)
                                        <span>{{ $item }}, </span>
                                    @endforeach
                                </p>
                            @endif

                            {{-- $info->child_category_id == 11 means child_categories table value Room check child_categories table --}}
                            @if ($info->child_category_id == 11)

                                <hr class="mb-2" style="width: 100%; height: 2px; margin: 0px;">

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
