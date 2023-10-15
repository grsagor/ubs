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
                                <li class="breadcrumb-item active" aria-current="page">Room Wanted</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="shop-list-page">

            <div class="mt-2 content-circle">

                <div class="container">
                    <div class="row mobile-reverse">

                        <div class="row single-product-wrapper mt-3">

                            <div class="col-lg-5 mb-4 mb-lg-0">

                                @if ($info->advert_photos != null)
                                    <div class="slideShow">
                                        <!-- Images in the slideshow -->
                                        <div class="image-carousel">
                                            <div class="carousel-container">
                                                @foreach ($images as $key => $item)
                                                    <div>
                                                        <img class="mySlides" src="{{ asset($item) }}">
                                                    </div>
                                                @endforeach
                                                <a class="previous" onclick="plusSlides(-1)">❮</a>
                                                <a class="next" onclick="plusSlides(1)" style="float: right;">❯</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row p-2">
                                        @foreach ($images as $key => $item)
                                            <div class="col-lg-{{ $div_value }} p-2">
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

                                        <h1 class="product_title entry-title" style="margin-bottom: 0px;">
                                            {{ $info->advert_title }}</h1>

                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="pro-details" style="margin-top: 0px;">

                                                    @if ($info->property_postcode)
                                                        <p style="margin: 10px;">
                                                            <strong>Post Code: </strong>
                                                            {{ $info->property_postcode ?? '' }}
                                                        </p>
                                                    @endif

                                                    @if ($info->transport_minutes)
                                                        <p style="margin: 10px;">
                                                            {{-- <strong>Distance from station: </strong> --}}
                                                            {{ $info->transport_minutes ?? '' }}
                                                            minutes
                                                            {{ $info->transport_form ?? '' }}
                                                            from
                                                            {{ $info->transport_to ?? '' }}
                                                        </p>
                                                    @endif


                                                    <div class="pro-info">

                                                        <form id="room_to_rent_reference_matching_form"
                                                            {{-- action="{{ route('room.referenceNumberCheck', $info->id) }}" --}} style="margin: 0px;">
                                                            @csrf
                                                            {{-- @method('PUT') --}}

                                                            <input type="hidden" name="bill"
                                                                value="{{ $service_charge }}">
                                                            <input type="hidden" name="id"
                                                                value="{{ $info->id }}">

                                                            <section class="row">

                                                                <section class="col-lg-12">
                                                                    <ul class="room-list">
                                                                        @foreach ($roomArray as $i => $item)
                                                                            @if ($info->child_category_id == 1)
                                                                                <li class="room-list__room">
                                                                                    <input type="radio" name="room_cost"
                                                                                        id="room{{ $i + 1 }}"
                                                                                        value="{{ $item['room_cost_of_amount'] }}">
                                                                                    {{-- <strong class="room-list__price">
                                                                                        &pound;
                                                                                        {{ $item['room_cost_of_amount'] }}
                                                                                        pcm</strong> --}}
                                                                                    <small>Room
                                                                                        {{ $i + 1 }}</small>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </section>

                                                                @if ($info->latest_booking_service === null || $info->latest_booking_service->status !== 'confirmed')
                                                                    <div class="col-lg-12">
                                                                        <div class="button-31 mt-2" data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModal"
                                                                            style="display:block; align-items: center; width:170px;">
                                                                            Book Now
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="col-lg-12">
                                                                        <div class="button-31 mt-2"
                                                                            style="display:block; align-items: center; width:170px; background: #e0892f;">
                                                                            Let Agreed
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                            </section>


                                                            {{-- Modal --}}
                                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">

                                                                        <div class="modal-body">
                                                                            <p class="text-center">Please call <a
                                                                                    href="callto:{{ $info->advert_telephone ?? '' }}">{{ $info->advert_telephone ?? '' }}</a>
                                                                                to get the reference id.</p>
                                                                            <div class="mb-3">
                                                                                <input type="text" class="form-control"
                                                                                    id="inputName" name="reference_number"
                                                                                    placeholder="Enter reference number"
                                                                                    style="width: 100%; border: 1px solid rgb(89, 85, 85);                                                                                    ">

                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer d-flex justify-content-center">
                                                                            <button type="button" class="btn btn-dark"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-dark"
                                                                                id="book_submit_modal">Book</button>
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

                                                <p id="call_id" class="mt-2"
                                                    style="display: none; margin-left: 10px;">
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
                                                    <div class="compare-button">
                                                        <a class="compare button" href="">Compare</a>
                                                    </div>

                                                </div>

                                                <div class="report-area">
                                                    <a class="report-item" href="#"><i class="fas fa-flag"></i>
                                                        Report This
                                                        Item </a>
                                                </div>

                                            </div>

                                            <div class="col-lg-7 mt-3">
                                                <div class="pro-details-sidebar-item mb-4">
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

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <hr class="mt-3 mb-3" style="width: 100%; height: 2px; margin: 0px;">

                    <div class="row">
                        <div class="col-lg-12">

                            @php
                                $room_count = count($roomArray);
                            @endphp

                            {{-- Room category table --}}
                            @if ($info->child_category_id == 1)
                                <div class="table-container">
                                    <table id="customers">
                                        <tr>
                                            <th>Room No.</th>
                                            <th>Rent</th>
                                            <th>Size</th>
                                            <th>En-suites</th>
                                            <th>Furnishing</th>
                                            <th>Deposit</th>
                                            <th>Available From</th>
                                        </tr>

                                        @foreach ($roomArray as $i => $item)
                                            <tr>
                                                <td>{{ $item['room_number'] }}</td>
                                                <td>{{ $item['room_cost_of_amount'] ?? '' }}</td>
                                                <td>
                                                    @if ($item['room_amenities'] == 'Y')
                                                        En-suite
                                                    @else
                                                        @if ($item['room_size'] == 1)
                                                            Single
                                                        @endif
                                                        @if ($item['room_size'] == 2)
                                                            Double
                                                        @endif
                                                        @if ($item['room_size'] == 3)
                                                            Semi-double
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>{{ $item['room_amenities'] == 1 ? 'Yes' : 'No' }}</td>
                                                <td>
                                                    {{ $item['room_furnishings'] == 1 ? 'Furnisihed' : 'Unfurnished' }}
                                                </td>
                                                <td>{{ $item['room_security_deposit'] }}</td>
                                                <td>{{ $item['room_available_from'] }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                            {{-- Room category table --}}

                            {{-- Falt/House category table --}}
                            @if ($info->child_category_id == 2 || $info->child_category_id == 6)
                                <div class="table-container">
                                    <table id="customers">
                                        <tr>
                                            <th>Room No.</th>
                                            <th>Size</th>
                                            <th>En-suites</th>
                                            <th>Furnishing</th>
                                            <th>Rent</th>
                                            <th>Deposit</th>
                                            <th>Holding Deposit</th>
                                            <th>Available From</th>
                                        </tr>

                                        {{-- {{ dd($roomArray) }} --}}

                                        @foreach ($roomArray as $i => $item)
                                            @if ($item['room_size'] !== null)
                                                <tr>
                                                    <td>{{ $item['room_number'] }}</td>

                                                    <td>
                                                        @if ($item['room_amenities'] == 'Y')
                                                            En-suite
                                                        @else
                                                            @if ($item['room_size'] == 1)
                                                                Single
                                                            @endif
                                                            @if ($item['room_size'] == 2)
                                                                Double
                                                            @endif
                                                            @if ($item['room_size'] == 3)
                                                                Semi-double
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>{{ $item['room_amenities'] == 1 ? 'Yes' : 'No' }}</td>
                                                    <td>
                                                        {{ $item['room_furnishings'] == 1 ? 'Furnisihed' : 'Unfurnished' }}
                                                    </td>

                                                    @if ($i == 0)
                                                        <td rowspan="{{ $room_count }}" style="background: white;">
                                                            {{ $info->rent ?? '' }}</td>
                                                        <td rowspan="{{ $room_count }}" style="background: white;">
                                                            {{ $info->security_deposit ?? '' }}
                                                        </td>
                                                        <td rowspan="{{ $room_count }}" style="background: white;">
                                                            {{ $info->holding_deposit ?? '' }}</td>
                                                        <td rowspan="{{ $room_count }}" style="background: white;">
                                                            {{ $info->room_available_from ?? '' }}</td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                            {{-- Falt/House category table --}}

                            {{-- Studio Flat category table --}}
                            @if ($info->child_category_id == 9)
                                <div class="table-container">
                                    <table id="customers">
                                        <tr>
                                            <th>En-suites</th>
                                            <th>Furnishing</th>
                                            <th>Rent</th>
                                            <th>Deposit</th>
                                            <th>Holding Deposit</th>
                                            <th>Available From</th>
                                        </tr>

                                        @foreach ($roomArray as $i => $item)
                                            <tr>
                                                @if ($i == 0)
                                                    <td>{{ $item['room_amenities'] == 1 ? 'Yes' : 'No' }}</td>
                                                    <td>
                                                        {{ $item['room_furnishings'] == 1 ? 'Furnisihed' : 'Unfurnished' }}
                                                    </td>
                                                    <td>{{ $info->rent ?? '' }}</td>
                                                    <td>{{ $info->security_deposit ?? '' }}</td>
                                                    <td>{{ $info->holding_deposit ?? '' }}</td>
                                                    <td>{{ $info->room_available_from ?? '' }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                            {{-- Studio Flat category table --}}


                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-7 p-4" style="text-align: justify">
                            <p class="product-title">{{ $info->advert_description }}</p>
                        </div>

                        <div class="col-lg-5 mt-3">

                            <div class="property_details">
                                <hr class="mb-2" style="width: 100%; height: 2px; margin: 0px;">

                                <h5>Property Details</h5>

                                @if ($info->child_category_id)
                                    <p>
                                        <strong>Property Type: </strong>
                                        {{ $info->child_category->name }}
                                    </p>
                                @endif

                                @if ($info->property_size)
                                    <p>
                                        <strong>Total Room: </strong>
                                        {{ $info->property_size ?? '' }}
                                    </p>
                                @endif

                                @if ($info->property_allow_people)
                                    <p>
                                        <strong>Max tenants allowed: </strong>
                                        {{ $info->property_allow_people }}
                                    </p>
                                @endif

                                @if ($info->bathroom)
                                    <p>
                                        <strong>Total bathrooms: </strong>
                                        {{ $info->bathroom }}
                                    </p>
                                @endif

                                @if ($info->living_room)
                                    <p>
                                        <strong>Living room: </strong>
                                        {{ $info->living_room == 1 ? 'Yes, there is a shared living room' : ($info->living_room == 3 ? 'Yes, there is a living room' : 'No') }}

                                    </p>
                                @endif

                                <p>
                                    <strong>Bills included: </strong>
                                    {{ $info->room_bills == 1 ? 'Yes' : 'No' }}
                                </p>

                                @if ($info->property_address)
                                    <p>
                                        <strong>Address: </strong>
                                        {{ $info->property_address }}
                                    </p>
                                @endif

                            </div>


                            <div class="availability">
                                <hr class="mb-2" style="width: 100%; height: 2px; margin: 0px;">

                                <h5>Availability</h5>

                                @if ($info->child_category_id != 1)
                                    <p>
                                        <strong>Available: </strong>
                                        {{ Carbon\Carbon::createFromFormat('Y-m-d', $info->room_available_from)->format('M d') }}
                                    </p>
                                @endif

                                @if ($info->room_min_stay)
                                    <p>
                                        <strong>Minimum Stay: </strong>
                                        {{ $info->room_min_stay ?? '' }} months
                                    </p>
                                @endif

                                @if ($info->room_max_stay)
                                    <p>
                                        <strong>Maximum Stay: </strong>
                                        {{ $info->room_max_stay ?? '' }} months
                                    </p>
                                @endif

                                <p>
                                    <strong>Short let consider: </strong>
                                    {{ $info->room_short_term_let_consider == 1 ? 'Yes' : 'No' }}
                                </p>

                                @if ($info->room_days_available)
                                    <p>
                                        <strong>Days avaiable: </strong>
                                        {{ $info->room_days_available }}
                                    </p>
                                @endif

                            </div>

                            <div class="amenities">
                                <hr class="mb-2" style="width: 100%; height: 2px; margin: 0px;">

                                <h5>Amenities</h5>

                                @if ($info->property_amenities)
                                    @php
                                        $amenities = json_decode($info->property_amenities, true);

                                        array_walk($amenities, function (&$amenity) {
                                            $amenity = ucfirst($amenity);
                                        });
                                    @endphp

                                    <p>
                                        <strong>Aminities: </strong>
                                        @foreach ($amenities as $item)
                                            <span>{{ $item }}, </span>
                                        @endforeach
                                    </p>
                                @endif

                                <p>
                                    <strong>Broadband included: </strong>
                                    {{ $info->room_broadband == 1 ? 'Yes' : 'No' }}
                                </p>
                            </div>

                            @if ($info->child_category_id == 1)
                                <div class="existing_flatmate">
                                    <hr class="mb-2" style="width: 100%; height: 2px; margin: 0px;">

                                    <h5>Current household</h5>

                                    <p>
                                        <strong>Smoker: </strong>
                                        {{ $info->exiting_flatmate_smoking == 1 ? 'Yes' : 'No' }}
                                    </p>

                                    @if ($info->exiting_flatmate_gender)
                                        <p>
                                            <strong>Gender: </strong>
                                            {{ $info->exiting_flatmate_gender == 1 ? 'Male' : ($info->exiting_flatmate_gender == 2 ? 'Female' : 'Others') }}
                                        </p>
                                    @endif

                                    @if ($info->exiting_flatmate_occupation)
                                        <p>
                                            <strong>Occupation: </strong>
                                            {{ $info->exiting_flatmate_occupation ?? '' }}
                                        </p>
                                    @endif

                                    <p>
                                        <strong>Any pets: </strong>
                                        {{ $info->exiting_flatmate_pets == 1 ? 'Yes' : 'No' }}
                                    </p>

                                    @if ($info->exiting_flatmate_age)
                                        <p>
                                            <strong>Age: </strong>
                                            {{ $info->exiting_flatmate_age ?? '' }}
                                        </p>
                                    @endif

                                    @if ($info->exiting_flatmate_language)
                                        <p>
                                            <strong>Language: </strong>
                                            {{ $info->exiting_flatmate_language ?? '' }}
                                        </p>
                                    @endif

                                    @if ($info->exiting_flatmate_nationality)
                                        <p>
                                            <strong>Nationality: </strong>
                                            {{ $info->exiting_flatmate_nationality ?? '' }}
                                        </p>
                                    @endif

                                    @if ($info->exiting_flatmate_sexual_orientation_check_box == 1)
                                        <p>
                                            <strong>Sexual orientation: </strong>
                                            {{ $info->exiting_flatmate_sexual_orientation ?? '' }}
                                        </p>
                                    @endif
                                </div>
                            @endif

                            <div class="new_flatmate">
                                <hr class="mb-2" style="width: 100%; height: 2px; margin: 0px;">

                                <h5>New household preference</h5>

                                <p>
                                    <strong>Smoking: </strong>
                                    {{ $info->new_flatmate_smoking == 1 ? 'Yes' : 'No' }}
                                </p>

                                @if ($info->exiting_flatmate_gender)
                                    <p>
                                        <strong>Gender: </strong>
                                        {{ $info->exiting_flatmate_gender == 1 ? 'Male' : ($info->exiting_flatmate_gender == 2 ? 'Female' : 'Others') }}
                                    </p>
                                @endif

                                @if ($info->new_flatmate_occupation)
                                    <p>
                                        <strong>Occupation: </strong>
                                        {{ $info->new_flatmate_occupation ?? '' }}
                                    </p>
                                @endif

                                @if ($info->new_flatmate_pets)
                                    <p>
                                        <strong>Pets: </strong>
                                        {{ $info->new_flatmate_pets == 1 ? 'Yes' : 'No' }}
                                    </p>
                                @endif

                                @if ($info->new_flatmate_min_age)
                                    <p>
                                        <strong>Min age: </strong>
                                        {{ $info->new_flatmate_min_age ?? '' }}
                                    </p>
                                @endif

                                @if ($info->new_flatmate_max_age)
                                    <p>
                                        <strong>Max age: </strong>
                                        {{ $info->new_flatmate_max_age ?? '' }}
                                    </p>
                                @endif

                                @if ($info->new_flatmate_language)
                                    <p>
                                        <strong>Language: </strong>
                                        {{ $info->new_flatmate_language ?? '' }}
                                    </p>
                                @endif

                                <p>
                                    <strong>Couples OK: </strong>
                                    {{ $info->new_flatmate_couples == 1 ? 'Yes' : 'No' }}
                                </p>

                                <p>
                                    <strong>Vegetarians: </strong>
                                    {{ $info->new_flatmate_vegetarians == 1 ? 'Yes' : 'No' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="room_to_rent_details_form">
    </div>

@endsection

@section('script')
    @include('frontend.service.partial.property_script')



    <script>
        $(document).ready(function() {
            $('#room_to_rent_reference_matching_form').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                $.ajax({
                    type: 'POST',
                    url: '/submit-form',
                    data: $(this).serialize(), // Serialize the form data
                    dataType: 'html',
                    success: function(html) {
                        // $('#exampleModal').modal('hide');
                        $('#room_to_rent_details_form').empty();
                        $('#room_to_rent_details_form').html(html);
                        $('#room_to_rent_details_form').modal('show');
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that occur during the request
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#book_submit_modal').on('click', function(e) {
                $('#exampleModal').modal('hide');
            });

        });
    </script>
@endsection
