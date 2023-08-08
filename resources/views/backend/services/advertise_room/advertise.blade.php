@extends('layouts.app')
@section('title', 'Advertise-Room')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/rough/root.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/rough/stack.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/rough/advertise.css') }}">
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
                                                    <select name="property_room_quantity">
                                                        @foreach (['1 room for rent', '2 rooms for rent', '3 rooms for rent'] as $key => $item)
                                                            <option value="{{ $key + 1 }}">{{ $item }}</option>
                                                        @endforeach
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
                                                    <select name="property_size">
                                                        @foreach (['1 bed', '2 beds', '3 beds'] as $key => $item)
                                                            <option value="{{ $key + 1 }}">{{ $item }}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                                <span class="form_input form_select form_select_property_type">
                                                    <select name="property_type">
                                                        @foreach (['Flat/Apartment', 'House', 'Property'] as $key => $item)
                                                            <option value="{{ $item }}">{{ $item }}</option>
                                                        @endforeach
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
                                                    <select name="property_occupants">
                                                        @foreach (['0', '1', '2', '3'] as $key => $item)
                                                            <option value="{{ $key + 1 }}"
                                                                {{ $item === '1' ? 'selected' : '' }}>{{ $item }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                                occupants in the property
                                            </div>
                                        </div>

                                        <div id="postcodeWrapper" class="form_row form_row_postcode">
                                            <div class="form_label">
                                                <span> Postcode of property </span>
                                                <div class="form_hint" data-test-class="form_hint hidden">
                                                    (e.g. SE15 8PD)
                                                </div>
                                            </div>
                                            <div class="form_inputs">
                                                <div class="form_input form_text">
                                                    <div id="address_lookup" class="address_lookup">
                                                        <div class="form-group form-group--address-lookup">
                                                            <input class="form-group__input form-group__input--postcode"
                                                                type="text" name="property_postcode" />
                                                            {{-- <button class="button button--secondary button--postcode"
                                                                type="button"> Find address
                                                            </button> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_role">
                                            <div class="form_label"> I am a </div>
                                            <div class="form_inputs">

                                                @php
                                                    $propert_user_title = [
                                                        'Live in landlord' => 'I own the property and live there',
                                                        'Live out landlord' => 'I own the property but don\'t live there',
                                                        'Current tenant/flatmate' => 'I am living in the property',
                                                        'Agent' => 'I am advertising on a landlord\'s behalf',
                                                        'Former flatmate' => 'I am moving out and need someone to replace me',
                                                    ];
                                                @endphp


                                                @foreach ($propert_user_title as $label => $hint)
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="property_user_title"
                                                            value="{{ $label }}" />
                                                        {{ $label }}
                                                        <span class="form_hint">({{ $hint }})</span>
                                                    </label>
                                                    <br />
                                                @endforeach
                                                <br />
                                            </div>
                                        </div>

                                        <div class="step1__button-wrapper">
                                            <div class="form_row form_row_email">
                                                <div class="form_label">
                                                    My email address is<span class="star">*</span>
                                                </div>
                                                <div class="form_inputs">
                                                    <span class="form_input form_text">
                                                        <input class="step-1__email-input" type="email"
                                                            name="property_email_address" />
                                                    </span>
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
                                                    <input type="text" name="property_address" value="">
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form_row form_row_area_drop">
                                            <div class="form_label"> Area </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="property_area" id="neighbourhood_id">
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
                                                <select name="transport_minutes">
                                                    <option value="" selected="">Select...</option>
                                                    @foreach (['0-5', '5-10', '10-15', '15-20'] as $key => $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select> minutes

                                                <select name="transport_form">
                                                    <option value="" selected="">Select...</option>
                                                    <option value="walk">walk</option>
                                                    <option value="by tram">by tram</option>
                                                </select>

                                                from

                                                <select name="transport_to">
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
                                                    <input type="radio" name="living_room" checked="" value=1>
                                                    Yes, there is a shared living room
                                                </label>
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="living_room" value=2> No
                                                </label>
                                            </div>
                                        </div>



                                        <div class="form_row form_row_amenities">
                                            <div class="form_label"> Amenities </div>
                                            <div class="form_inputs">
                                                <div class="cols cols2">

                                                    <div class="col">


                                                        @php
                                                            $amenities = ['Parking', 'Garden/Roof terrace', 'Garage', 'Balcony/patio', 'Disabled access'];
                                                        @endphp

                                                        @foreach ($amenities as $amenity)
                                                            <label class="form_input form_checkbox">
                                                                <input type="checkbox" name="property_amenities[]"
                                                                    value="{{ $amenity }}">
                                                                {{ $amenity }}
                                                            </label>
                                                        @endforeach

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
                                                        <input type="number" name="room_cost_of_amount1" value=""
                                                            size="6" step="any">
                                                    </span>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_cost_time1" value=1>
                                                        per week
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_cost_time1" checked=""
                                                            value=2>
                                                        per calendar month
                                                    </label>

                                                </div>
                                            </div>

                                            <div class="form_row form_row_room_size">
                                                <div class="form_label"> Size of room </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_size1" value=1>
                                                        Single
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_size1" value=2 checked="">
                                                        Double
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form_row form_row_amenities">
                                                <div class="form_label"> Amenities </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="room_amenities1" value="Y">
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
                                                        <input type="radio" name="room_furnishings1" value=1>
                                                        Furnished
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_furnishings1" value=2>
                                                        Unfurnished
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="form_row form_row_deposit ">
                                                <div class="form_label"> Security deposit </div>
                                                <div class="form_inputs">
                                                    <span class="form_input form_text">
                                                        <span class="form_currency_symbol">£</span> <input type="number"
                                                            name="room_security_deposit1" value="" step="any"
                                                            min="0">
                                                        {{-- <a class="offered-ad__deposit-limit-link">Check deposit limits</a> --}}
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
                                                        <input type="number" name="room_cost_of_amount2" value=""
                                                            size="6" step="any">
                                                    </span>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_cost_time2" value=1>
                                                        per week
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_cost_time2" checked=""
                                                            value=2>
                                                        per calendar month
                                                    </label>

                                                </div>
                                            </div>

                                            <div class="form_row form_row_room_size">
                                                <div class="form_label"> Size of room </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_size2" value=1>
                                                        Single
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_size2" checked="" value=2>
                                                        Double
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form_row form_row_amenities">
                                                <div class="form_label"> Amenities </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="room_amenities2" value="Y">
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
                                                        <input type="radio" name="room_furnishings2" value=1>
                                                        Furnished
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_furnishings2" value=2>
                                                        Unfurnished
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="form_row form_row_deposit ">
                                                <div class="form_label"> Security deposit </div>
                                                <div class="form_inputs">
                                                    <span class="form_input form_text">
                                                        <span class="form_currency_symbol">£</span> <input type="number"
                                                            name="room_security_deposit2" value="" step="any"
                                                            min="0">
                                                        {{-- <a class="offered-ad__deposit-limit-link">Check deposit limits</a> --}}
                                                    </span>
                                                </div>
                                            </div>

                                        </fieldset>


                                        <fieldset class="form_room_fieldset">

                                            <legend> Room 3 </legend>

                                            <div class="form_row form_row_cost ">
                                                <div class="form_label"> Cost of room </div>
                                                <div class="form_inputs">
                                                    <span class="form_input form_text">
                                                        <span class="form_currency_symbol">£</span>
                                                        <input type="number" name="room_cost_of_amount3" value=""
                                                            size="6" step="any">
                                                    </span>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_cost_time3" value=1>
                                                        per week
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_cost_time3" checked=""
                                                            value=2>
                                                        per calendar month
                                                    </label>

                                                </div>
                                            </div>

                                            <div class="form_row form_row_room_size">
                                                <div class="form_label"> Size of room </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_size3" value=1>
                                                        Single
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_size3" checked="" value=2>
                                                        Double
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form_row form_row_amenities">
                                                <div class="form_label"> Amenities </div>
                                                <div class="form_inputs">
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="room_amenities3" value="Y">
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
                                                        <input type="radio" name="room_furnishings3" value=1>
                                                        Furnished
                                                    </label>
                                                    <label class="form_input form_radio">
                                                        <input type="radio" name="room_furnishings3" value=2>
                                                        Unfurnished
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="form_row form_row_deposit ">
                                                <div class="form_label"> Security deposit </div>
                                                <div class="form_inputs">
                                                    <span class="form_input form_text">
                                                        <span class="form_currency_symbol">£</span> <input type="number"
                                                            name="room_security_deposit3" value="" step="any"
                                                            min="0">
                                                        {{-- <a class="offered-ad__deposit-limit-link">Check deposit limits</a> --}}
                                                    </span>
                                                </div>
                                            </div>

                                        </fieldset>


                                        <div class="form_row form_row_avail_from ">
                                            <div class="form_label"> Available from </div>
                                            <div class="form_inputs">
                                                <input type="date" name="room_available_from"
                                                    id="room_available_from">
                                            </div>
                                        </div>

                                        <div class="form_row form_row_min_term">
                                            <div class="form_label"> Minimum stay </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="room_min_stay">
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
                                                    <select name="room_max_stay">
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
                                                    <input type="checkbox" name="room_short_term_let_consider"
                                                        value="Y">
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
                                                    <select name="room_days_available" id="days_of_wk_available">
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
                                                    <input type="radio" name="room_reference" value=1> yes
                                                </label>
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="room_reference" checked="" value=2>
                                                    no
                                                </label>
                                            </div>
                                        </div>


                                        <div class="form_row form_row_bills_inc">
                                            <div class="form_label">
                                                Bills included
                                            </div>
                                            <div class="form_inputs">
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="room_bills" value=1> Yes
                                                </label>
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="room_bills" value=2> No
                                                </label>
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="room_bills" value=3> Some
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_broadband">
                                            <div class="form_label">
                                                Broadband included?
                                            </div>
                                            <div class="form_inputs">
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="room_broadband" value=1> Yes
                                                </label>
                                                <label class="form_input form_radio">
                                                    <input type="radio" name="room_broadband" value=2> No
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
                                                    <select name="exiting_flatmate_smoking">
                                                        <option value=1>Yes</option>
                                                        <option value=2 selected="">No</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_gender ">
                                            <div class="form_label"> Gender </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="exiting_flatmate_gender">
                                                        <option selected="" value="">Select ....</option>
                                                        @foreach (getSex() as $item)
                                                            <option value="{{ $item['value'] }}"
                                                                {{ old('sex') == $item['value'] ? 'selected' : '' }}>
                                                                {{ $item['label'] }}
                                                            </option>
                                                        @endforeach
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
                                                    <select name="exiting_flatmate_occupation">
                                                        <option value="ND" selected="">Not disclosed</option>
                                                        <option value="S">Student</option>
                                                        <option value="P">Professional</option>
                                                        <option value="O">Other</option>

                                                    </select>
                                                </span>
                                            </div>
                                        </div>




                                        <div class="form_row form_row_pets">
                                            <div class="form_label"> Pets </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="exiting_flatmate_pets">
                                                        <option value=2>no</option>
                                                        <option value=1>yes</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form_row form_row_age">
                                            <div class="form_label"> Age </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="exiting_flatmate_age">
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
                                                    <select name="exiting_flatmate_language">
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
                                                            name="exiting_flatmate_nationality">
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
                                                    <select name="exiting_flatmate_sexual_orientation">
                                                        <option value="ND">Not disclosed</option>
                                                        <option value="S">Straight</option>
                                                        <option value="B">Bisexual</option>
                                                    </select>
                                                </span>
                                                <label class="form_input form_checkbox">
                                                    <input type="checkbox"
                                                        name="exiting_flatmate_sexual_orientation_check_box" value=1>
                                                    Yes, I would like my orientation to form part of my ad's search criteria
                                                    and allow others to search on this field.
                                                </label>
                                            </div>
                                        </div>


                                    </fieldset>

                                    <fieldset>
                                        <legend> Preferences For New flatmates </legend>
                                        <div class="form_row form_row_smoking">
                                            <div class="form_label"> smoking </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="new_flatmate_smoking">
                                                        <option value=>No preference</option>
                                                        <option value=1>Yes</option>
                                                        <option value=2>No</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_gender">
                                            <div class="form_label"> Gender </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="new_flatmate_gender">
                                                        <option selected="" value="">Select ....</option>
                                                        @foreach (getSex() as $item)
                                                            <option value="{{ $item['value'] }}"
                                                                {{ old('sex') == $item['value'] ? 'selected' : '' }}>
                                                                {{ $item['label'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form_row form_row_occupation">
                                            <div class="form_label"> Occupation </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="new_flatmate_occupation">
                                                        <option value="">No preference</option>
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
                                                    <select name="new_flatmate_pets">
                                                        <option value=1>yes</option>
                                                        <option value=2>no</option>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>




                                        <div class="form_row form_row_min_age">
                                            <div class="form_label"> Minimum age </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_select">
                                                    <select name="new_flatmate_min_age">
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

                                                    <select name="new_flatmate_max_age">
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
                                                    <select name="new_flatmate_language">
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
                                                    <label><input type="radio" name="new_flatmate_couples" value=2> no
                                                    </label>
                                                    <label><input type="radio" name="new_flatmate_couples" value=1> yes*
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
                                                    <select name="new_flatmate_vegetarians">
                                                        <option>No preference</option>
                                                        <option value=1>Yes</option>
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
                                                    <input type="text" name="advert_title" value=""
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
                                                    <textarea id="descOrginalTextArea" name="advert_description" rows="15" cols="50" wrap="virtual"></textarea>
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

                                            <div class="form_inputs">
                                                <div id="photoUploader" data-upload-url="">
                                                    <div data-testid="uploader">
                                                        <div class="dropzone-wrapper">
                                                            <div class="dropzone-button">
                                                                <!-- Input type file field -->
                                                                <input type="file" name="advert_photos[]" multiple />
                                                                <p class="dropzone__file-hint">.jpg or .png only. Up to
                                                                    16mb</p>
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
                                                    <input type="text" name="advert_first_name" value="Amal"
                                                        placeholder="First name" autocomplete="given-name">
                                                </span>
                                                <span class="form_input form_text">
                                                    <input type="text" name="advert_last_name" value="Santos"
                                                        placeholder="Last name" autocomplete="family-name">
                                                </span>
                                                <label class="form_input form_checkbox">
                                                    <input type="checkbox" name="advert_on_last_name" value=1>
                                                    Display last name on advert?
                                                </label>

                                            </div>
                                        </div>

                                        <div class="form_row form_row_tel">
                                            <div class="form_label"> Telephone </div>
                                            <div class="form_inputs">
                                                <span class="form_input form_text">
                                                    <input class="form_input_tel" type="tel" name="advert_telephone"
                                                        value="+1 (655) 337-3249" autocomplete="tel"
                                                        id="form_input--tel-n">
                                                </span>
                                                <label class="form_input form_checkbox">
                                                    <input name="advert_on_telephone" value=1 type="checkbox">
                                                    Display with advert?
                                                </label>
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
                                            <div class="form_label"> Daily email alerts </div>
                                            <div class="form_inputs">
                                                <label class="form_input form_checkbox">
                                                    <input type="checkbox" name="daily_email_alerts" checked=""
                                                        value=1>
                                                    Yes, please send me daily summary emails of new Rooms Wanted adverts
                                                    matching my requirements
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form_row form_row_emails form_row_emails_instant">
                                            <div class="form_label"> Instant email alerts </div>
                                            <div class="form_inputs">
                                                <label class="form_input form_checkbox">
                                                    <input type="checkbox" name="instant_email_alerts" value=1>
                                                    Yes, please send me emails of new Rooms Wanted adverts matching my
                                                    requirements as soon as they are posted on the website
                                                </label>
                                                (up to a maximum of
                                                <span class="form_input form_select">
                                                    <select name="instant_email_max_days">
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


                    @auth
                        @php
                            $userId = auth()->id();
                        @endphp
                    @endauth
                    <input type="hidden" name="user_id" value="{{ $userId }}">


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


        // Get the input element by its ID
        var roomAvailableFromInput = document.getElementById('room_available_from');

        // Get the current date in the format YYYY-MM-DD
        var currentDate = new Date().toISOString().split('T')[0];

        // Set the min attribute of the input to the current date
        roomAvailableFromInput.min = currentDate;
    </script>
@endsection
