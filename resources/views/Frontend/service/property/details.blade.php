@extends('frontend.layouts.master_layout')
@push('css')
    <style>
        .call-button {
            display: flex;
            align-items: center;
        }

        .button-31 {
            width: 130px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }

        #call_id {
            display: none;
            margin-left: 10px;
        }

        @media (max-width: 768px) {

            #call_id {
                display: none !important;
                display: block;
                margin-left: 0;
                margin-top: 10px;
            }
        }

        /* .image-carousel {
                            position: relative;
                        }

                        .carousel-container {
                            position: relative !important;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        }

                        .previous,
                        .next {
                            font-size: 24px;
                            cursor: pointer;
                            padding: 8px;
                            background-color: rgba(0, 0, 0, 0.5);
                            color: white;
                            border: none;
                            border-radius: 4px;
                            position: absolute !important;
                            top: 50%;
                            z-index: 1;
                        }

                        .previous {
                            left: 0;
                        }

                        .next {
                            right: 0;
                        }

                        .image-slide {
                            position: relative;
                        }

                        .image-slide img {
                            max-width: 100%;
                            height: auto;
                            display: block;
                        }

                        .active {
                            background-color: #333;
                        } */
    </style>
@endpush
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
                                <li class="breadcrumb-item active" aria-current="page">Service</li>
                                <li class="breadcrumb-item active" aria-current="page">Room Wanted</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <div class="shop-list-page">

            {{-- There are two product page. you have to give condition here --}}
            <div class="mt-2 content-circle">

                <div class="container">
                    <div class="row mobile-reverse">

                        <div class="row single-product-wrapper mt-3">
                            <div class="col-lg-4 mb-4 mb-lg-0">
                                <div class="product-images overflow-hidden">
                                    <div class="images-inner">

                                        @php
                                            $images = json_decode($info->images, true);
                                            $first_image = 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                            $img_count = null;
                                            $imagePath = null;
                                            
                                            if ($images) {
                                                $first_image = reset($images);
                                                $imagePath = public_path($first_image);
                                                $img_count = count($images);
                                            }
                                            
                                        @endphp

                                        @if ($images != null)
                                            <div class="image-carousel">

                                                <div class="carousel-container">
                                                    @foreach ($images as $index => $item)
                                                        <div class="image-slide">
                                                            <img src="{{ asset($item) }}" alt="Image {{ $index + 1 }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                {{-- <a class="previous" onclick="plusSlides(-1)">❮</a>
                                                <a class="next" onclick="plusSlides(1)" style="float: right;">❯</a> --}}
                                            </div>
                                        @else
                                            <figure class="woocommerce-product-gallery__wrapper">
                                                <div class="bg-light">
                                                    <img id="single-image-zoom" src="{{ asset($first_image) }}">
                                                </div>
                                            </figure>
                                        @endif

                                        {{-- <script>
                                            var currentIndex = 1;

                                            showSlides(currentIndex);

                                            function plusSlides(n) {
                                                showSlides(currentIndex += n);
                                            }

                                            function showSlides(n) {
                                                var i;
                                                var slides = document.querySelectorAll(".image-slide");

                                                if (n > slides.length) {
                                                    currentIndex = 1;
                                                }
                                                if (n < 1) {
                                                    currentIndex = slides.length;
                                                }

                                                for (i = 0; i < slides.length; i++) {
                                                    slides[i].style.display = "none";
                                                }

                                                slides[currentIndex - 1].style.display = "block";
                                            }
                                        </script> --}}


                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-8">
                                <div class="summary entry-summary">
                                    <div class="summary-inner">

                                        <h1 class="product_title entry-title">{{ $info->ad_title }}</h1>


                                        <div class="pro-details">

                                            <div class="pro-info">
                                                <strong class="room-list__price"gggggggg>
                                                    {{ $info->room_size }}</strong>
                                            </div>

                                            {{-- <li class="addtocart m-1">
                                                <form method="POST"
                                                    action="{{ route('property.referenceNumberCheck', $info->id) }}"
                                                    style="margin: 0px;">
                                                    @csrf
                                                    @method('PUT')

                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">
                                                        Send Message
                                                    </button>

                                                 
                                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Reference
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

                                                                        <input type="hidden" name="bill"
                                                                            value={{ $info->combined_budget }}>
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
                                                    

                                                </form>
                                            </li> --}}

                                            <div class="call-button" style="display: flex; align-items: center;">
                                                <a href="tel:{{ $info->tel }}" class="button-31" id="call_button_id"
                                                    style="width: 130px;">Call</a>
                                                <span id="call_id"
                                                    style="display: none; margin-left: 10px;">{{ $info->tel }}</span>
                                            </div>

                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                            <script>
                                                $(document).ready(function() {
                                                    $("#call_button_id").click(function() { // Use the correct ID selector (#call_button_id)
                                                        $("#call_id").show(); // Use the correct ID selector (#call_id)
                                                    });
                                                });
                                            </script>

                                        </div>


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
                                                    <a class="twitter a2a_button_twitter" href="/#twitter" target="_blank"
                                                        rel="nofollow noopener">
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
                                            <div class="compare-button">
                                                <a class="compare button" href="">Compare</a>
                                            </div>

                                        </div>

                                        <div class="report-area">
                                            <a class="report-item" href="#"><i class="fas fa-flag"></i> Report This
                                                Item </a>
                                        </div>



                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3 col-md-4">
                                <div class="pro-details-sidebar-item mb-4">
                                    <span> Contact </span>

                                    @php
                                        $imageUrl = $user_info && $user_info->file_name && File::exists(public_path("uploads/media/{$user_info->file_name}")) ? asset("uploads/media/{$user_info->file_name}") : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                    @endphp

                                    <div>
                                        <img class="" src="{{ $imageUrl }}" alt="" width="100"
                                            height="100">
                                    </div>

                                    <strong>
                                        {{ $info->user->surname ?? '' }}
                                        {{ $info->user->first_name ?? '' }}
                                        {{ $info->user->last_name ?? '' }}
                                    </strong>

                                </div>
                            </div>

                        </div>


                    </div>

                    <div class="row">

                        <div class="col-lg-7 p-4" style="text-align: justify">
                            <p class="product-title">{{ $info->ad_text }}</p>
                        </div>

                        <div class="col-lg-5">
                            <div>
                                <hr style="width: 100%;">
                            </div>
                            @if ($info->available_form)
                                <p>
                                    <strong>Availability: </strong>
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d', $info->available_form)->format('M d') }}
                                </p>
                            @endif

                            @if ($info->min_term)
                                <p>
                                    <strong>Minimum term: </strong>
                                    {{ $info->min_term ?? '' }} months
                                </p>
                            @endif

                            @if ($info->max_term)
                                <p>
                                    <strong>Maximum term: </strong>
                                    {{ $info->max_term ?? '' }} months
                                </p>
                            @endif

                            @if ($info->who_is_searching)
                                <p>
                                    <strong>Who is searching: </strong>
                                    {{ $info->who_is_searching }}
                                </p>
                            @endif

                            @if ($info->why_is_searching)
                                <p>
                                    <strong>Why is searching: </strong>
                                    {{ $info->why_is_searching }}
                                </p>
                            @endif

                            @if ($info->gender)
                                <p>
                                    <strong>Gender: </strong>
                                    {{ $info->gender == 1 ? 'Male' : ($info->gender == 2 ? 'Female' : 'Others') }}
                                </p>
                            @endif

                            @if ($info->buddy_ups)
                                <p>
                                    <strong>Buddy Ups: </strong>
                                    {{ $info->buddy_ups }}
                                </p>
                            @endif

                            @if ($info->wanted_living_area)
                                <p>
                                    <strong>Wanted Living Area: </strong>
                                    {{ $info->wanted_living_area }}
                                </p>
                            @endif


                            @php
                                if ($info->roomfurnishings == null) {
                                    $aminities = json_decode($info->roomfurnishings, true);
                                
                                    array_walk($aminities, function (&$amenity) {
                                        $amenity = ucfirst($amenity);
                                    });
                                }
                                
                            @endphp

                            @if ($info->roomfurnishings == null)
                                <p>
                                    <strong>Aminities: </strong>
                                    @foreach ($aminities as $item)
                                        <span>{{ $item }}, </span>
                                    @endforeach
                                </p>
                            @endif

                            <br>
                            <h5>Occupant Details</h5>
                            <div>
                                <hr style="width: 100%;">
                            </div>

                            <p>
                                <strong>Name: </strong>
                                {{ $info->first_name }}
                                {{ $info->last_name }}
                            </p>

                            <p>
                                <strong>Age: </strong>
                                {{ $info->age ?? '' }}
                            </p>
                            <p>
                                <strong>Occupation: </strong>
                                {{ $info->occupation ?? '' }}
                            </p>
                            <p>
                                <strong>Telephone </strong>
                                {{ $info->tel }}
                            </p>
                            <p>
                                <strong>Smoker: </strong>
                                {{ $info->smoking_current == 1 ? 'Yes' : 'No' }}
                            </p>
                            <p>
                                <strong>Pets: </strong>
                                {{ $info->pets == 1 ? 'Yes' : 'No' }}
                            </p>
                            <p>
                                <strong>Sex: </strong>
                                {{ $info->gay_lesbian }}
                            </p>
                            <p>
                                <strong>Gay Consent: </strong>
                                {{ $info->gay_consent == 1 ? 'Yes' : 'No' }}
                            </p>
                            <p>
                                <strong>Nationality: </strong>
                                {{ $info->nationality ?? '' }}
                            </p>
                            <p>
                                <strong>Language: </strong>
                                {{ $info->lang_id }}
                            </p>


                            @if ($info->selectedSports)
                                <p>
                                    <strong>Selected Sports </strong>
                                    {{ $info->selectedSports }}
                                </p>
                            @endif

                            <h5>Requirements</h5>
                            <div>
                                <hr style="width: 100%;">
                            </div>

                            <p>
                                <strong>Gender Requirement: </strong>
                                {{ $info->gender_req == 1 ? 'Male' : ($info->gender_req == 2 ? 'Female' : 'Others') }}
                            </p>

                            <p>
                                <strong>Minimum age requirement: </strong>
                                {{ $info->min_age_req }}
                            </p>
                            <p>
                                <strong>Maximum age requirement: </strong>
                                {{ $info->max_age_req }}
                            </p>
                            <p>
                                <strong>Pets Requirement: </strong>
                                {{ $info->pets_req }}
                            </p>
                            <p>
                                <strong>Gay Lesbian Requirement: </strong>
                                {{ $info->gay_lesbian_req }}
                            </p>
                        </div>
                        {{-- <div class="col-lg-3">

                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
