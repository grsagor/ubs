@extends('layouts.app')
@section('title', 'Advertise-Room')
<link rel="stylesheet" href="{{ asset('assets/rough/root.css') }}">
<link rel="stylesheet" href="{{ asset('assets/rough/stack.css') }}">
<link rel="stylesheet" href="{{ asset('assets/rough/advertise.css') }}">
@section('css')
    <style>

    </style>
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
        <h1 class="service_iiiiiii">Service
            <small>Advertise your room</small>
        </h1>
    </section> --}}

    <!-- Main content -->
    <section class="content">
        <div>
            <form class="row g-3 mt-2" action="{{ route('service-advertise.store') }}" id="multi-step-form" method="POST"
                enctype="multipart/form-data">
                @csrf
                <!-- Step 1 -->
                <div class="step" id="step-1">
                    <!-- Step 1 form fields go here -->
                    <!-- Start Step 1 -->
                    <div class="grid-12">
                        <div class="text-center">
                            <h1>Advertise your room</h1>
                        </div>
                    </div>
                    <div class="grid-12-4" style="display: flex; justify-content: center;">
                        <div>
                            <div class="block block_simple block_offered_listing">
                                <div class="block_header">
                                    <h2> Step 1 of 6 </h2>
                                </div>

                                <div class="block_content">
                                    {{-- <form action="" method="GET" class="pl_step1"> --}}
                                    <fieldset>
                                        <legend>
                                            Get started with your free advert
                                        </legend>

                                        <div class="form_row form_row_rooms_for_rent">
                                            <div class="form_label">
                                                I have
                                            </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="rooms_for_rent">
                                                        <option value="1">1 room for rent</option>
                                                        <option value="2">2 rooms for rent</option>
                                                        <option value="3">3 rooms for rent</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_property_type">
                                            <div class="form_label">
                                                Size and type of property
                                            </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="rooms_in_property">
                                                        <option value="2">2 bed</option>
                                                        <option value="3">3 bed</option>
                                                    </select>
                                                </span>
                                                <span class="form_input form_select form_select_property_type">
                                                    <select name="property_type">
                                                        <option value="">Select...</option>
                                                        <option value="Flat" selected>Flat/Apartment</option>
                                                        <option value="House">house</option>
                                                        <option value="Property">Property</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_occupants">
                                            <div class="form_label">
                                                There are already
                                            </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="occupants">
                                                        <option value="0">0</option>
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                    </select>
                                                </span>
                                                occupants in the property
                                            </div>
                                        </div>

                                        <div id="postcodeWrapper" class="form_row form_row_postcode">
                                            <div class="form_label">
                                                <span>
                                                    Postcode of property
                                                </span>

                                                <div class="form_hint" data-test-class="form_hint hidden">
                                                    (e.g. SE15 8PD)
                                                </div>
                                            </div>
                                            <div class="form_inputs">
                                                <div class="form_input form_text">
                                                    <div id="address_lookup" class="address_lookup">
                                                        <div class="form-group form-group--address-lookup">
                                                            <input class="form-group__input form-group__input--postcode"
                                                                type="text" name="address-postcode"
                                                                autocomplete="postal-code" pattern="[a-zA-Z0-9\s]+"
                                                                maxlength="8" required="" aria-invalid="true"
                                                                aria-label="Enter your postcode to find your address" /><button
                                                                class="button button--secondary button--postcode"
                                                                type="button">
                                                                Find address
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_role">
                                            <div class="form_label">
                                                I am a
                                            </div>
                                            <div class="form_inputs">
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="advertiser_role" />
                                                    Live in landlord
                                                    <span class="form_hint">(I own the property and live there)</span>
                                                </label>
                                                <br />

                                                <label class="form_input form_radio">
                                                    <input type="radio" name="advertiser_role" />
                                                    Live out landlord
                                                    <span class="form_hint">(I own the property but don't live
                                                        there)</span>
                                                </label>
                                                <br />

                                                <label class="form_input form_radio">
                                                    <input type="radio" name="advertiser_role" />
                                                    Current tenant/flatmate
                                                    <span class="form_hint">(I am living in the property)</span>
                                                </label>
                                                <br />

                                                <label class="form_input form_radio">
                                                    <input type="radio" name="advertiser_role" />
                                                    Agent
                                                    <span class="form_hint">(I am advertising on a landlord's
                                                        behalf)</span>
                                                </label>
                                                <br />

                                                <label class="form_input form_radio">
                                                    <input type="radio" name="advertiser_role" />
                                                    Former flatmate
                                                    <span class="form_hint">(I am moving out and need someone to replace
                                                        me)</span>
                                                </label>
                                                <br />

                                                <div id="advertiser_role_other" style="display: none;">
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="advertiser_role" />
                                                        other:
                                                        <span class="form_hint"><input type="text"
                                                                name="advertiser_role_other" value="" /></span>
                                                    </label>
                                                    <br />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="step1__button-wrapper">
                                            <div class="step1__facebook-button-wrapper" style="display: none;">
                                                <a class="button button--facebook button--wide" id="fb_login"
                                                    href="#">
                                                    <div class="button__content">
                                                        <span class="button__icon">
                                                            <i class="fab fa-facebook"></i> </span><span
                                                            class="button__text">Continue with Facebook</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="step1__email-button-wrapper" style="display: none;">
                                                <button type="button" class="button button--link">
                                                    Continue with email
                                                </button>
                                            </div>
                                            <div class="form_row form_row_email">
                                                <div class="form_label">
                                                    My email address is<span class="star">*</span>
                                                </div>
                                                <div class="form_inputs">
                                                    <span class="form_input form_text">
                                                        <input class="step-1__email-input" type="email"
                                                            name="youremail" />
                                                    </span>
                                                    <input type="hidden" name="emailrequested" value="1" />
                                                    <div class="form_hint">
                                                        (We'll keep this safe and not display it publicly)
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="form_row step1__continue-button-wrapper">
                                                <div class="form_label"></div>
                                                <div class="form_inputs">
                                                    <div class="form_input form_button">
                                                        <button class="button" id="continueButton" type="submit"
                                                            name="submit">
                                                            Continue
                                                        </button>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </fieldset>
                                    {{-- </form> --}}
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- Start Step 1 -->
                    <button type="button" class="btn btn-primary next-btn"
                        style="display: block; margin: auto;">Next</button>
                </div>

                <!-- Step 2 -->
                <div class="step" id="step-2">
                    <h3>Step 2</h3>
                    <!-- Step 2 form fields go here -->

                    <!-- Start Step 2 -->
                    <div class="grid-12-4" style="display: flex; justify-content: center;">
                        <div>
                            <div class="block block_simple block_offered_listing">
                                <div class="block_header">
                                    <h2> Step 2 of 6</h2>
                                </div>

                                <div class="block_content">
                                    <div id="deposit_warning_popup"></div>


                                    <fieldset>
                                        <legend>More about the property</legend>

                                        <div class="form_row form_row_address_snippet">
                                            <div class="form_label">
                                                Address of property
                                            </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_text">
                                                    <input type="text"
                                                        value="Unit 1, Nagpal House, 1 Gunthorpe Street, London, E1 7RG"
                                                        disabled="">
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form_row form_row_area_drop">
                                            <div class="form_label"> Area </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="neighbourhood_id" id="neighbourhood_id">
                                                        <option value="" selected="">Select area...</option>
                                                        <option value="28747">Aldgate</option>
                                                        <option value="6888">Whitechapel</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>



                                        <div class="form_row form_row_transport">
                                            <div class="form_label"> Transport </div>
                                            <div class="form_inputs">
                                                <select name="no_of_mins">
                                                    <option value="" selected="">Select...</option>
                                                    <option value="5">0-5</option>
                                                    <option value="10">5-10</option>
                                                </select> minutes

                                                <select name="no_of_mins_by">
                                                    <option value="" selected="">Select...</option>
                                                    <option value="walk">walk</option>
                                                    <option value="by tram">by tram</option>
                                                </select>

                                                from

                                                <select name="station_id">
                                                    <option value="" selected="">Select...
                                                    </option>
                                                    <option value="BLACKFRIARS">Blackfriars
                                                    </option>
                                                    <option value="CITYTHAMESLINK">City Thameslink
                                                    </option>
                                                    <option value="FARRINGDON">Farringdon
                                                    </option>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="form_row form_row_living_room">
                                            <div class="form_label"> Living room? </div>
                                            <div class="form_inputs">
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="living_room" checked=""
                                                        value="shared">
                                                    Yes, there is a shared living room
                                                </label>
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="living_room" value="none"> No
                                                </label>
                                            </div>
                                        </div>



                                        <div class="form_row form_row_amenities">
                                            <div class="form_label"> Amenities </div>
                                            <div class="form_inputs">
                                                <div class="cols cols2">
                                                    <div class="col col_first">
                                                        <label class="form_input form_checkbox">
                                                            <input type="checkbox" name="off_street_parking"
                                                                value="shared">
                                                            Parking
                                                        </label>
                                                        <label class="form_input form_checkbox">
                                                            <input type="checkbox" name="garden" value="shared">
                                                            Garden/roof
                                                            terrace
                                                        </label>
                                                        <label class="form_input form_checkbox">
                                                            <input type="checkbox" name="garage" value="shared"> Garage
                                                        </label>
                                                    </div>
                                                    <div class="col col_last">
                                                        <label class="form_input form_checkbox">
                                                            <input type="checkbox" name="balcony" value="shared">
                                                            Balcony/patio
                                                        </label>
                                                        <label class="form_input form_checkbox">
                                                            <input type="checkbox" name="disabled_access" value="Y">
                                                            Disabled access
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        {{-- <div class="form_row ">
                                            <div class="form_label"></div>
                                            <div class="form_inputs">
                                                <div class="btn-wrapper">
                                                    <div>
                                                        <button class="button" type="submit" name="validate_step"
                                                            value="Continue to next step">Continue to next step
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                    </fieldset>


                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End Step 2 -->



                    <button type="button" class="btn btn-primary prev-btn">
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>

                <!-- Step 3 -->
                <div class="step" id="step-3">
                    <h3>Step 3</h3>
                    <!-- Step 3 form fields go here -->



                    <!-- Start Step 3 -->
                    <div class="grid-12-4" style="display: flex; justify-content: center;">
                        <div>

                            <div class="block block_simple block_offered_listing">
                                <div class="block_header">
                                    <h2> Step 3 of 6</h2>
                                </div>

                                <div class="block_content">
                                    <div id="deposit_warning_popup"></div>




                                    <fieldset>

                                        <legend>The rooms</legend>

                                        <fieldset class="form_room_fieldset">

                                            <legend> Room 1 </legend>

                                            <div class="form_row form_row_cost ">
                                                <div class="form_label"> Cost of room </div>
                                                <div class="form_inputs">
                                                    <span class="form_input form_text">
                                                        <span class="form_currency_symbol">£</span>
                                                        <input type="number" name="roomprice1[]" value=""
                                                            size="6" step="any">
                                                    </span>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomper1" value="pw"> per week
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomper1" value="pcm"> per
                                                        calendar
                                                        month
                                                    </label>

                                                </div>
                                            </div>

                                            <div class="form_row form_row_room_size">
                                                <div class="form_label"> Size of room </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomtype1" value="single"> Single
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomtype1" checked=""
                                                            value="double"> Double
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form_row form_row_amenities">
                                                <div class="form_label"> Amenities </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="roomensuite1" value="Y">
                                                        En-suite
                                                        <span class="form_hint">(tick if room has own toilet and/or
                                                            bath/shower)</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form_row form_row_amenities">
                                                <div class="form_label"> Furnishings </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomfurnishings1" value="furnished">
                                                        Furnished
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomfurnishings1"
                                                            value="unfurnished">
                                                        Unfurnished
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="form_row form_row_deposit ">
                                                <div class="form_label"> Security deposit </div>
                                                <div class="form_inputs">
                                                    <span class="form_input form_text">
                                                        <span class="form_currency_symbol">£</span> <input type="number"
                                                            name="roomsecurity_deposit1" value="" step="any"
                                                            min="0">
                                                        <a class="offered-ad__deposit-limit-link">Check deposit limits</a>
                                                    </span>
                                                </div>
                                            </div>

                                        </fieldset>



                                        <fieldset class="form_room_fieldset">

                                            <legend> Room 2 </legend>

                                            <div class="form_row form_row_cost ">
                                                <div class="form_label"> Cost of room </div>
                                                <div class="form_inputs">
                                                    <span class="form_input form_text">
                                                        <span class="form_currency_symbol">£</span>
                                                        <input type="number" name="roomprice2" value=""
                                                            size="6" step="any">
                                                    </span>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomper2" value="pw"> per week
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomper2" value="pcm"> per
                                                        calendar
                                                        month
                                                    </label>

                                                </div>
                                            </div>
                                            <div class="form_row form_row_room_size">
                                                <div class="form_label"> Size of room </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomtype2" value="single"> Single
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomtype2" checked=""
                                                            value="double"> Double
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form_row form_row_amenities">
                                                <div class="form_label"> Amenities </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="roomensuite2" value="Y">
                                                        En-suite
                                                        <span class="form_hint">(tick if room has own toilet and/or
                                                            bath/shower)</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form_row form_row_amenities">
                                                <div class="form_label"> Furnishings </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomfurnishings2" value="furnished">
                                                        Furnished
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomfurnishings2"
                                                            value="unfurnished">
                                                        Unfurnished
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="form_row form_row_deposit ">
                                                <div class="form_label"> Security deposit </div>
                                                <div class="form_inputs">
                                                    <span class="form_input form_text">
                                                        <span class="form_currency_symbol">£</span>
                                                        <input type="number" name="roomsecurity_deposit2" value=""
                                                            step="any" min="0">
                                                        <a class="offered-ad__deposit-limit-link">Check deposit limits</a>
                                                    </span>
                                                </div>
                                            </div>

                                        </fieldset>



                                        <fieldset class="form_room_fieldset">
                                            <legend> Room 3 </legend>

                                            <div class="form_row form_row_cost ">
                                                <div class="form_label">
                                                    Cost of room </div>
                                                <div class="form_inputs">
                                                    <span class="form_input form_text">
                                                        <span class="form_currency_symbol">£</span>
                                                        <input type="number" name="roomprice3" value=""
                                                            size="6" step="any">
                                                    </span>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomper3" value="pw"> per week
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomper3" value="pcm"> per
                                                        calendar
                                                        month
                                                    </label>

                                                </div>
                                            </div>
                                            <div class="form_row form_row_room_size">
                                                <div class="form_label">
                                                    Size of room
                                                </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomtype3" value="single"> Single
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomtype3" checked=""
                                                            value="double"> Double
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form_row form_row_amenities">
                                                <div class="form_label"> Amenities </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="roomensuite3" value="Y">
                                                        En-suite
                                                        <span class="form_hint">(tick if room has own toilet and/or
                                                            bath/shower)</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form_row form_row_amenities">
                                                <div class="form_label"> Furnishings </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomfurnishings3" value="furnished">
                                                        Furnished
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="roomfurnishings3"
                                                            value="unfurnished">
                                                        Unfurnished
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="form_row form_row_deposit ">
                                                <div class="form_label"> Security deposit </div>
                                                <div class="form_inputs">
                                                    <span class="form_input form_text">
                                                        <span class="form_currency_symbol">£</span>
                                                        <input type="number" name="roomsecurity_deposit3" value=""
                                                            step="any" min="0">
                                                        <a class="offered-ad__deposit-limit-link">Check deposit limits</a>
                                                    </span>
                                                </div>
                                            </div>

                                        </fieldset>


                                        <div class="form_row form_row_avail_from ">
                                            <div class="form_label"> Available from </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="day_avail">
                                                        <option value="01">01</option>
                                                        <option value="26">26</option>
                                                        <option value="27" selected="">27</option>
                                                        <option value="31">31</option>
                                                    </select>
                                                </span>
                                                <span class="form_input form_select">
                                                    <select name="mon_avail">
                                                        <option value="01">Jan</option>
                                                        <option value="02">Feb</option>
                                                        <option value="07" selected="">Jul</option>
                                                        <option value="12">Dec</option>
                                                    </select>
                                                </span>
                                                <span class="form_input form_select">
                                                    <select name="year_avail">
                                                        <option value="2022">2022
                                                        </option>
                                                        <option value="2023" selected="">2023
                                                        </option>
                                                        <option value="2024">2024
                                                        </option>
                                                    </select>

                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_min_term">
                                            <div class="form_label"> Minimum stay </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="min_term">
                                                        <option value="0" selected="">No minimum</option>
                                                        <option value="1">1 month</option>
                                                        <option value="2">2 months</option>
                                                        <option value="5">5 months</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_max_term">
                                            <div class="form_label"> Maximum stay </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="max_term">
                                                        <option value="0" selected="">No maximum</option>
                                                        <option value="1">1 month</option>
                                                        <option value="2">2 months</option>
                                                        <option value="3">3 months</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_short_term">
                                            <div class="form_label">
                                                Short term lets considered?
                                                <div class="form_hint">
                                                    (i.e. 1 week to 3 months)
                                                </div>
                                            </div>
                                            <div class="form_inputs">
                                                <label class="form_input form_checkbox">
                                                    <input type="checkbox" name="short_lets_considered" value="Y">
                                                    Tick for yes
                                                </label>
                                                <span class="form_hint">
                                                    *Please specify any rent adjustments in your advert description (step
                                                    5).
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_days_avail">
                                            <div class="form_label">
                                                Days available
                                            </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="days_of_wk_available" id="days_of_wk_available">
                                                        <option value="7 days a week" selected="">7 days a week
                                                        </option>
                                                        <option value="Mon to Fri only">Mon to Fri only</option>
                                                        <option value="Weekends only">Weekends only</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_ref_req">
                                            <div class="form_label">
                                                References required?
                                            </div>
                                            <div class="form_inputs">
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="references_needed" value="Y"> yes
                                                </label>
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="references_needed" checked=""
                                                        value="N"> no
                                                </label>
                                            </div>
                                        </div>


                                        <div class="form_row form_row_bills_inc">
                                            <div class="form_label">
                                                Bills included
                                            </div>
                                            <div class="form_inputs">
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="bills_inc" value="Yes"> yes
                                                </label>
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="bills_inc" value="No"> no
                                                </label>
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="bills_inc" value="Some"> some
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_broadband">
                                            <div class="form_label">
                                                Broadband included?
                                            </div>
                                            <div class="form_inputs">
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="broadband" value="Y"> yes
                                                </label>
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="broadband" value="N"> no
                                                </label>
                                            </div>
                                        </div>




                                        {{-- <div class="form_row ">
                                            <div class="form_label"></div>
                                            <div class="form_inputs">
                                                <div class="btn-wrapper">
                                                    <div>
                                                        <button class="button" type="submit" name="validate_step"
                                                            value="Continue to next step">Continue to next step
                                                        </button>
                                                    </div>
                                                    <div class="btn-wrapper__back-btn">
                                                        <input class="button button--link" id="backButton" type="submit"
                                                            name="prev_step" value="Back">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                    </fieldset>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Step 3 -->


                    <button type="button" class="btn btn-primary prev-btn">
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>



                <!-- Step 4 -->
                <div class="step" id="step-4">
                    <h3>Step 4</h3>
                    <!-- Step 4 form fields go here -->

                    <!-- Start Step 4 -->

                    <div class="grid-12-4" style="display: flex; justify-content: center;">
                        <div>
                            <div class="block block_simple block_offered_listing">
                                <div class="block_header">
                                    <h2> Step 4 of 6</h2>
                                </div>

                                <div class="block_content">
                                    <div id="deposit_warning_popup"></div>

                                    <fieldset>
                                        <legend>The Existing Flatmate</legend>

                                        <div class="form_row form_row_smoking">
                                            <div class="form_label"> Smoking </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="smoking_current">
                                                        <option value="N" selected="">No</option>
                                                        <option value="Y">Yes</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_gender ">
                                            <div class="form_label"> Gender </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="gender">
                                                        <option value="NULL">Select...
                                                        </option>
                                                        <option value="F">Female
                                                        </option>
                                                        <option value="M">Male
                                                        </option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form_row form_row_occupation">
                                            <div class="form_label">
                                                Occupation
                                            </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="share_type">
                                                        <option value="ND" selected="">Not disclosed</option>
                                                        <option value="S">Student</option>
                                                        <option value="P">Professional</option>
                                                        <option value="O">Other</option>

                                                    </select>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_campus" style="display: none;">
                                            <div class="form_label">
                                                If student(s), which university?
                                                <div class="form_hint">
                                                    (optional)
                                                </div>
                                            </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="campus_id">
                                                        <option value="" selected="">Not applicable/not disclosed
                                                        </option>

                                                        <option value="166">London School of Economics (LSE) (1.97 miles
                                                            away)</option>

                                                        <option value="135">London College of Communication (1.98 miles
                                                            away)</option>

                                                        <option value="9999">Other</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form_row form_row_pets">
                                            <div class="form_label"> Pets </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="pets">
                                                        <option value="N">no</option>
                                                        <option value="Y">yes</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form_row form_row_age">
                                            <div class="form_label"> Age </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="min_age">
                                                        <option value="null" selected="">-</option>
                                                        <option value="18">18</option>
                                                        <option value="98">98</option>
                                                        <option value="99">99</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form_row form_row_language">
                                            <div class="form_label"> Language </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="lang_id">
                                                        <option value="26">English </option>
                                                        <option value="27">Mixed </option>
                                                        <option value="17">Cantonese </option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form_row form_row_nationality">
                                            <div class="form_label"> Nationality </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <span id="nationality-select" data-selected=""><select
                                                            name="nationality">
                                                            <option value="">Not disclosed</option>
                                                            <option value="Welsh">Welsh</option>
                                                            <option value="Yemeni">Yemeni</option>
                                                            <option value="Zambian">Zambian</option>
                                                            <option value="Zimbabwean">Zimbabwean</option>
                                                        </select></span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_orientation">
                                            <div class="form_label"> Sexual orientation </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="gay_lesbian">
                                                        <option value="ND">Not disclosed</option>
                                                        <option value="S">Straight</option>
                                                        <option value="B">Bisexual</option>
                                                    </select>
                                                </span>
                                                <label class="form_input form_checkbox">
                                                    <input type="checkbox" name="gay_consent" value="Y">
                                                    Yes, I would like my orientation to form part of my ad's search criteria
                                                    and
                                                    allow others to search on this field.
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_interests" style="display: none;">
                                            <div class="form_label"> Interests </div>
                                            <div class="form_inputs">

                                                <div id="sharedInterests" data-post-ad-type="offered"
                                                    data-advertiser-role="live out landlord"></div>

                                                <span class="form_input form_text">
                                                    <input type="text" name="interests" value="" size="48"
                                                        maxlength="255">
                                                </span>
                                            </div>
                                        </div>

                                    </fieldset>

                                    <fieldset>
                                        <legend> Preferences For New flatmates </legend>
                                        <div class="form_row form_row_smoking">
                                            <div class="form_label"> smoking </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="smoking">
                                                        <option value="Y">No preference</option>
                                                        <option value="N">No</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_gender">
                                            <div class="form_label"> Gender </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="gender_req">
                                                        <option value="N">No preference</option>
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_occupation">
                                            <div class="form_label"> Occupation </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="share_type_req">
                                                        <option value="M">No preference</option>
                                                        <option value="S">Student</option>
                                                        <option value="P">Professional</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>




                                        <div class="form_row form_row_pets">
                                            <div class="form_label"> Pets considered </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="pets_req">
                                                        <option value="N">no</option>
                                                        <option value="Y">yes</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>




                                        <div class="form_row form_row_min_age">
                                            <div class="form_label"> Minimum age </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="min_age_req">
                                                        <option value="null" selected="">-</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="99">99</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form_row form_row_max_age">
                                            <div class="form_label"> Maximum age </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">

                                                    <select name="max_age_req">
                                                        <option value="null" selected="">-</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="99">99</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>





                                        <div class="form_row form_row_language">
                                            <div class="form_label"> Language </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="lang_id_req">
                                                        <option value="27">Mixed
                                                        </option>
                                                        <option value="76">Quechua
                                                        </option>
                                                        <option value="98">Zulu
                                                        </option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>



                                        <div class="form_row form_row_couples">
                                            <div class="form_label"> Couples welcome? </div>
                                            <div class="form_inputs">
                                                <span class="form_input">
                                                    <label><input type="radio" name="couples" value="N"> no
                                                    </label>
                                                    <label><input type="radio" name="couples" value="Y"> yes*
                                                    </label>
                                                </span>
                                                <div class="form_hint"> *specify any rent adjustments in your ad
                                                    description
                                                    on next step

                                                </div>
                                            </div>
                                        </div>


                                        <div class="form_row form_row_misc">
                                            <div class="form_label"> Vegetarians preferred? </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="vegetarians">
                                                        <option>No preference</option>
                                                        <option value="Y">Yes</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>


                                        {{-- <div class="form_row ">
                                            <div class="form_label"></div>
                                            <div class="form_inputs">
                                                <div class="btn-wrapper">
                                                    <div>
                                                        <button class="button" type="submit" name="validate_step"
                                                            value="Continue to next step">Continue to next step
                                                        </button>
                                                    </div>
                                                    <div class="btn-wrapper__back-btn">
                                                        <input class="button button--link" id="backButton" type="submit"
                                                            name="prev_step" value="Back">
                                                    </div>

                                                </div>
                                            </div>
                                        </div> --}}

                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Step 4 -->
                    <button type="button" class="btn btn-primary prev-btn">
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>

                <!-- Step 5 -->
                <div class="step" id="step-5">
                    <h3>Step 5</h3>
                    <!-- Step 5 form fields go here -->

                    <!-- Start Step 5 -->
                    <div class="grid-12-4" style="display: flex; justify-content: center;">
                        <div>

                            <div class="block block_simple block_offered_listing">
                                <div class="block_header">
                                    <h2>
                                        Step 5 of 6</h2>
                                </div>

                                <div class="block_content">

                                    <div id="deposit_warning_popup"></div>



                                    <fieldset>
                                        <legend>Your ad &amp; contact details</legend>

                                        <div class="form_row form_row_title ">
                                            <div class="form_label">

                                                <span>Advert title</span>

                                                <div class="form_hint" id="advertTitleHint">
                                                    (short description – max 50 characters)
                                                </div>

                                            </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_text">
                                                    <input type="text" name="ad_title"
                                                        value="Aliquam beatae est veniam cupiditate consequatur"
                                                        size="50" maxlength="50">
                                                </span>
                                            </div>
                                        </div>

                                        <div id="descriptionRowOrginal" class="form_row form_row_description ">
                                            <div class="form_label">

                                                <span id="">Description</span>

                                            </div>
                                            <div class="form_inputs">

                                                <span class="form_input form_text">
                                                    <textarea id="descOrginalTextArea" name="ad_text" rows="15" cols="50" wrap="virtual">Aperidd fdafs Aperidd fAperidd fdafs Aperidd fdafsAperidd fdafs Aperidd fdafsAperidd fdafs Aperidd fdafsAperidd fdafs Aperidd fdafsAperidd fdafs Aperidd fdafsAperidd fdafs Aperidd fdafsdafsAperidd fdafs Aperidd fdafs</textarea>
                                                </span>
                                                <div class="form_hint" id="descriptionHint">
                                                    Tips: Give more detail about the accommodation
                                                    and who you are looking for. You must write at least 25 words and can
                                                    write as much as you like within reason. (No contact details permitted
                                                    within description).
                                                </div>


                                            </div>
                                        </div>


                                        {{-- <div class="msg warning">
                                    <span>As the advertiser, it's your responsibility to:</span>
                                    <ul class="msg-warning__list">
                                        <li class="msg-warning__list-item"><i class="far fa-check"></i>
                                            <p class="msg-warning__text">Include <span
                                                    class="msg-warning__text-bold">EPC energy rating</span>
                                                (upload as one of your ad's photos)</p>
                                        </li>
                                        <li class="msg-warning__list-item"><i class="far fa-check"></i>
                                            <p class="msg-warning__text">Include <span
                                                    class="msg-warning__text-bold">council tax band</span>
                                                (specify in your ad's description) <span id="councilTaxModal"><button
                                                        class="button button--link" type="button"
                                                        aria-label="council tax info"><i
                                                            class="fas fa-info-circle"></i></button></span></p>
                                        </li>

                                        <li class="msg-warning__list-item"><i class="far fa-check"></i>
                                            <p class="msg-warning__text">Familiarise yourself with <a
                                                    href="/content/default/discrimination"
                                                    target="_blank">discrimination laws</a></p>
                                        </li>
                                    </ul>
                                </div> --}}





                                        <div class="form_row form_row_photos post-ad__photo-upload">
                                            <div class="post-ad__photo-upload-label">Upload photos</div>
                                            <div id="photosHintExperiment"
                                                class="tips-experiment__message-box tips-experiment__message-box--photos"
                                                style="display:none">
                                                <div class="message-box message-box--tips message-box--small">
                                                    <span class="message-box__icon">
                                                        <i class="far fa-lightbulb-on"></i>
                                                    </span>
                                                    <p class="message-box__text">
                                                        <strong>Only upload JPG or PNG files less than 16mb.</strong> <br>
                                                        Photos must not contain any web urls or contact details. Only
                                                        branded advertisers may include a company name or logo.

                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form_inputs">
                                                <div id="photoUploader" data-upload-url="/flatshare/upload-photos.pl"
                                                    data-advert-id="jthnSEZAZOqGIDgnVmoD7g"
                                                    data-draft-advert-id="jthnSEZAZOqGIDgnVmoD7g"
                                                    data-session-id="855B9E9E-2FD6-11EE-A74F-B8E7F7D085E0"
                                                    data-flatshare-type="offered" data-email="abshakib91@gmail.com"
                                                    data-max-file-size="16777216" data-slots-remaining="9">
                                                    <div data-testid="uploader">
                                                        <div class="dropzone-wrapper">
                                                            <div class="dropzone-button"><button
                                                                    class="button button--wide dz-clickable"
                                                                    id="dzClickable" type="button">
                                                                    <div class="button__content"><span
                                                                            class="button__icon dropzone-button__icon"><i
                                                                                class="fas fa-images"></i></span><span
                                                                            class="button__text">Add up to 9 images</span>
                                                                    </div>
                                                                </button>
                                                                <p class="dropzone__file-hint">.jpg or .png only. Up to
                                                                    16mb</p>
                                                            </div>
                                                            <div class="filepicker dropzone">
                                                                <div class="dz-default dz-message"><span>Drop files here
                                                                        to upload</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="uploader__hint">Photos must not contain any web urls
                                                            or contact details. Only branded advertisers may include a
                                                            company name or logo.</div>
                                                        <div class="photo-upload"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form_row form_row_name  ">
                                            <div class="form_label">


                                                Your name


                                            </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_text">
                                                    <input type="text" name="first_name" value="Amal"
                                                        placeholder="First name" autocomplete="given-name">
                                                </span>
                                                <span class="form_input form_text">
                                                    <input type="text" name="last_name" value="Santos"
                                                        placeholder="Last name" autocomplete="family-name">
                                                </span>
                                                <label class="form_input form_checkbox">
                                                    <input type="checkbox" name="display_last_name" value="Y">
                                                    Display last name on advert?
                                                </label>

                                            </div>
                                        </div>

                                        <div class="form_row form_row_tel">
                                            <div class="form_label">
                                                Telephone
                                            </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_text">
                                                    <input class="form_input_tel" type="tel" name="tel"
                                                        value="+1 (655) 337-3249" autocomplete="tel"
                                                        id="form_input--tel-n">
                                                </span>
                                                <label class="form_input form_checkbox">
                                                    <input name="display_tel" value="Y" type="checkbox">
                                                    Display with advert?
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form_row form_row_email">
                                            <div class="form_label">
                                                Email
                                            </div>
                                            <div class="form_inputs">


                                                abshakib91@gmail.com
                                                <input type="hidden" name="email" value="abshakib91@gmail.com">

                                            </div>
                                        </div>
                                        <div id="inputButtonWrapper">


                                            <div class="form_row ">
                                                <div class="form_label"></div>
                                                <div class="form_inputs">
                                                    <div class="btn-wrapper">


                                                        {{-- <div><button class="button" type="submit" name="validate_step"
                                                                value="Continue to next step">Continue to next
                                                                step</button> </div>
                                                        <div class="btn-wrapper__back-btn">
                                                            <input class="button button--link" id="backButton"
                                                                type="submit" name="prev_step" value="Back">
                                                        </div> --}}

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </fieldset>





                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- End Step 5 -->



                    <button type="button" class="btn btn-primary prev-btn">
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>

                <!-- Step 6 -->
                <div class="step" id="step-6">
                    <h3>Step 6</h3>
                    <!-- Step 6 form fields go here -->


                    <!-- Start Step 6 -->
                    <div class="grid-12-4" style="display: flex; justify-content: center;">
                        <div>

                            <div class="block block_simple block_offered_listing">
                                <div class="block_header">
                                    <h2>
                                        Step 6 of 6</h2>
                                </div>

                                <div class="block_content">

                                    <div id="deposit_warning_popup"></div>






                                    <fieldset>
                                        <input type="hidden" name="is_loggedin" value="1">
                                        <legend>Email alerts</legend>
                                        <div class="form_row form_row_emails">
                                            <div class="form_label">
                                                Daily email alerts
                                            </div>
                                            <div class="form_inputs">
                                                <label class="form_input form_checkbox">
                                                    <input type="checkbox" name="emailnotify" checked=""
                                                        value="Y">
                                                    Yes, please send me daily summary emails of new Rooms Wanted adverts
                                                    matching my requirements
                                                </label>
                                                <input type="hidden" name="emailnotify_prev" value="Y">
                                            </div>
                                        </div>
                                        <div class="form_row form_row_emails form_row_emails_instant">
                                            <div class="form_label">
                                                Instant email alerts
                                            </div>
                                            <div class="form_inputs">
                                                <label class="form_input form_checkbox">
                                                    <input type="checkbox" name="emailnotify_justin" value="Y">
                                                    Yes, please send me emails of new Rooms Wanted adverts matching my
                                                    requirements as soon as they are posted on the website
                                                </label>
                                                <input type="hidden" name="emailnotify_justin_prev" value="N">
                                                (up to a maximum of
                                                <span class="form_input form_select">
                                                    <select name="emailnotify_justin_max_qty">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12" selected="">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="20">20</option>
                                                        <option value="25">25</option>
                                                        <option value="30">30</option>
                                                        <option value="35">35</option>
                                                        <option value="40">40</option>
                                                        <option value="45">45</option>
                                                        <option value="50">50</option>
                                                    </select>
                                                </span>
                                                <input type="hidden" name="emailnotify_justin_max_qty_prev"
                                                    value="12">
                                                per day)
                                            </div>
                                        </div>



                                        <div class="form_row ">
                                            <div class="form_label"></div>
                                            <div class="form_inputs">
                                                <div class="btn-wrapper">


                                                    {{-- <div><button class="button" type="submit" name="validate_step"
                                                            value="Post your advert">Post your advert</button> </div>
                                                    <div class="btn-wrapper__back-btn">
                                                        <input class="button button--link" id="backButton" type="submit"
                                                            name="prev_step" value="Back">
                                                    </div> --}}

                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>


                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- End Step 6 -->
                    <button type="button" class="btn btn-primary prev-btn">
                        Previous
                    </button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $(".step:not(:first)").hide(); // Hide all steps except the first one

            $(".next-btn").click(function() {
                $(this).parent().hide().next().show();
            });

            $(".prev-btn").click(function() {
                $(this).parent().hide().prev().show();
            });
        });
    </script>
@endsection
