@extends('frontend.layouts.master_layout')
@section('css')
    <style>
        .accordion-button {
            border-bottom: 1.5px solid rgb(88 161 138) !important;
        }

        .accordion-button.collapsed {
            background-color: rgb(241, 241, 241) !important;
        }

        .accordion-button:not(.collapsed) {
            background-color: rgb(241, 241, 241) !important;
        }

        .pt--25 {
            padding-top: 25px !important;
        }

        .card {
            border-radius: 0.25rem;
            border: 1px solid #EEEEEE;
            /* box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); */
            padding: 20px;
            background-color: #FFFFFF;
            color: #333333;
            /* transition: transform 0.2s; */
            /* background: linear-gradient(275deg, #f4f4f4, #FFFFFF); */
        }

        .card:hover {
            /* transform: scale(1.015); */
        }

        .edu-comment {
            display: flex;
        }

        .edu-comment .thumbnail {
            min-width: 70px;
            width: 70px;
            max-height: 70px;
            border-radius: 100%;
            margin-right: 25px;
        }

        .edu-comment .thumbnail img {
            border-radius: 100%;
            width: 100%;
        }

        .edu-comment+.edu-comment {
            border-top: 1px solid #EEEEEE;
            padding-top: 30px;
            margin-top: 30px;
        }
    </style>

    @include('frontend.other_services.partial.property_finding_service.style')
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">

        <div class="header m-3 p-3">

            <div class="property_finding_service card p-5 mt-2">
                <h3 class="heading text-center fw-bold">Flexible and Easy Solution To Find Out Your Property </h3>
                <h5 class="text-center mb-3"> Wherever you are in your property finding journey, We are here to assist
                    you in getting your property
                </h5>
                <div class="text-center">
                    <img src="{{ asset('assets/frontend/property_finding1.png') }}" alt="property_finding.png"
                        style="width: 75%">

                </div>
            </div>

            <div class="category_tab card p-5 mt-5">

                <h4 class="body-heading text-center fw-bold">Choose Your Property That You Need, Pay To Hire Openmarket
                    Assistants
                    And Wait To
                    Get It Ready
                </h4>
                <ul class="nav nav-tabs custom-tabs" id="myTabs">

                    {{-- child_category_id == 11, 12, 13, 14 this value check child categories table --}}
                    @if ($child_category_id !== null)
                        <li class="nav-item">
                            <a class="nav-link {{ $child_category_id == 14 || $child_category_id === null ? 'active' : 'd-none' }}"
                                data-bs-toggle="tab" href="#tab1">Studio Flat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $child_category_id == 13 ? 'active' : 'd-none' }}" data-bs-toggle="tab"
                                href="#tab2">Flat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $child_category_id == 11 ? 'active' : 'd-none' }}" data-bs-toggle="tab"
                                href="#tab3">Room</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $child_category_id == 12 ? 'active' : 'd-none' }}" data-bs-toggle="tab"
                                href="#tab4">House</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ $child_category_id == 14 || $child_category_id === null ? 'active' : '' }}"
                                data-bs-toggle="tab" href="#tab1">Studio Flat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $child_category_id == 13 ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#tab2">Flat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $child_category_id == 11 ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#tab3">Room</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $child_category_id == 12 ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#tab4">House</a>
                        </li>
                    @endif

                </ul>

                <div class="tab-content custom-tab-content">

                    <div class="tab-pane fade {{ $child_category_id == 14 || $child_category_id === null ? 'show active' : '' }}"
                        id="tab1">
                        <!-- Content for tab 1 goes here -->
                        <div id="generic_price_table">

                            <!-- Pricing # -->
                            <div class="pricing">
                                {{-- <div class="container"> --}}
                                <div class="pricing-table table-responsive" style="text-align: -webkit-center">
                                    <table class="table">
                                        <!-- Heading -->

                                        @include(
                                            'frontend.other_services.partial.property_finding_service.table_head',
                                            [
                                                'category_name' => 'Studio Flat',
                                                'service_charge' => $studio_flat_service_charge,
                                            ]
                                        )

                                        <tbody>

                                            @include('frontend.other_services.partial.property_finding_service.tab_table')

                                            <!-- Buttons -->
                                            <tr>
                                                <td>&nbsp;</td>

                                                <td class="bg-green">
                                                    @include(
                                                        'frontend.other_services.partial.property_finding_service.pay_button',
                                                        [
                                                            'product_id' => $property_id ?? null,
                                                            'product_name' => 'Studio Flat Regular',
                                                            'plan' => 'Regular',
                                                            'bill' => $studio_flat_service_charge,
                                                            'child_category_id_from_backend' =>
                                                                $child_category_id ?? 14,
                                                            'service_charge_id' => 5,
                                                        ]
                                                    )
                                                </td>

                                                <td class="bg-lblue">

                                                    @include(
                                                        'frontend.other_services.partial.property_finding_service.pay_button',
                                                        [
                                                            'product_id' => $property_id ?? null,
                                                            'product_name' => 'Studio Flat Premium',
                                                            'plan' => 'Premium',
                                                            'bill' => $studio_flat_service_charge * 1.4,
                                                            'child_category_id_from_backend' =>
                                                                $child_category_id ?? 14,
                                                            'service_charge_id' => 5,
                                                        ]
                                                    )
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- </div> --}}
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade {{ $child_category_id == 13 ? 'show active' : '' }}" id="tab2">
                        <!-- Content for tab 2 goes here -->
                        <div id="generic_price_table">

                            <!-- Pricing # -->
                            <div class="pricing">
                                <div class="container">
                                    <div class="pricing-table table-responsive" style="text-align: -webkit-center">
                                        <table class="table">

                                            <!-- Heading -->
                                            @include(
                                                'frontend.other_services.partial.property_finding_service.table_head',
                                                [
                                                    'category_name' => 'Flat',
                                                    'service_charge' => $flat_service_charge,
                                                ]
                                            )

                                            <tbody>

                                                @include('frontend.other_services.partial.property_finding_service.tab_table')

                                                <!-- Buttons -->
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td class="bg-green">
                                                        @include(
                                                            'frontend.other_services.partial.property_finding_service.pay_button',
                                                            [
                                                                'product_id' => $property_id ?? null,
                                                                'product_name' => 'Flat Regular',
                                                                'plan' => 'Regular',
                                                                'bill' => $flat_service_charge,
                                                                'child_category_id_from_backend' =>
                                                                    $child_category_id ?? 13,
                                                                'service_charge_id' => 3,
                                                            ]
                                                        )
                                                    </td>

                                                    <td class="bg-lblue">
                                                        @include(
                                                            'frontend.other_services.partial.property_finding_service.pay_button',
                                                            [
                                                                'product_id' => $property_id ?? null,
                                                                'product_name' => 'Flat Premium',
                                                                'plan' => 'Premium',
                                                                'bill' => $flat_service_charge * 1.4,
                                                                'child_category_id_from_backend' =>
                                                                    $child_category_id ?? 13,
                                                                'service_charge_id' => 3,
                                                            ]
                                                        )
                                                    </td>

                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade {{ $child_category_id == 11 ? 'show active' : '' }}" id="tab3">
                        <div id="generic_price_table">
                            <div class="pricing">
                                <div class="container">
                                    <div class="pricing-table table-responsive" style="text-align: -webkit-center">
                                        <table class="table" style="width: 80%">

                                            <thead>
                                                <th style="width: 30%">
                                                    <div class="room_type_tab3" id="room_type_tab3">




                                                        <div class="row p-2">

                                                            <div class="col-md-7">
                                                                <select class="form-control"
                                                                    style="background: white; height: auto;"
                                                                    id="child_category_id_room_tab_3" name="child_category"
                                                                    {{ $room_details ? 'disabled' : '' }}>
                                                                    <option value="0">Select</option>
                                                                    @foreach ($room_size as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            {{ $item->id == $room_details ? 'selected' : '' }}>
                                                                            {{ $item->size }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>


                                                            <div class="col-md-5">
                                                                <select class="form-control"
                                                                    style="background: white; height: auto;"
                                                                    id="quantity_tab_3" name="quantity"
                                                                    {{ $property_size ? 'disabled' : '' }}>
                                                                    <option value="0">Qty</option>
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <option value="{{ $i }}"
                                                                            {{ $property_size == $i ? 'selected' : '' }}>
                                                                            {{ $i }}
                                                                        </option>
                                                                    @endfor
                                                                </select>
                                                            </div>


                                                        </div>
                                                    </div>

                                                </th>

                                                <th>
                                                    Regular
                                                    <span class="ptable-star green">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </span>
                                                    <span class="ptable-price" id="regular_price_room_tab3">£0.0</span>
                                                </th>
                                                <th>
                                                    Premium
                                                    <span class="ptable-star lblue">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </span>
                                                    <span class="ptable-price" id="premium_price_room_tab3">£0.0</span>
                                                </th>

                                            </thead>

                                            <tbody id="table_room_tab3">

                                                @include('frontend.other_services.partial.property_finding_service.tab_table')

                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <form id="propertyFindingPaymentForm" method="GET"
                                                        action="{{ route('propertyFindingPayment') }}">
                                                        @csrf
                                                        <input type="hidden" name="category_name" value="room">
                                                        <input type="hidden" id="room_regular_product_id"
                                                            name="product_id" value="{{ $property_id ?? null }}">
                                                        @if ($property_id == null)
                                                            <input type="hidden" name="type"
                                                                value="property_wanted_frontend">
                                                        @else
                                                            <input type="hidden" name="type"
                                                                value="property_wanted_backend">
                                                        @endif

                                                        <input type="hidden" name="product_name" value="Room Regular">

                                                        <input type="hidden" id="room_regular_size" name="room_size"
                                                            value="">
                                                        <input type="hidden" id="room_regular_quantity"
                                                            name="room_quantity" value="">
                                                        <input type="hidden" id="room_regular_service_charge_id"
                                                            name="service_charge_id" value="">
                                                        <input type="hidden" id="room_regular_charge" name="room_charge"
                                                            value="">

                                                        <input type="hidden" name="plan" value="Regular">
                                                        <input type="hidden" name="child_category_id_from_backend"
                                                            value="11">

                                                        <td class="bg-green">
                                                            <button type="submit" class="btn"
                                                                id="room_regular_pay_btn"
                                                                style="color: white">PAY</button>
                                                        </td>
                                                    </form>

                                                    <form id="propertyFindingPaymentForm" method="GET"
                                                        action="{{ route('propertyFindingPayment') }}">
                                                        @csrf
                                                        <input type="hidden" name="category_name" value="room">
                                                        <input type="hidden" id="room_premium_product_id"
                                                            name="product_id" value="{{ $property_id ?? null }}">
                                                        @if ($property_id == null)
                                                            <input type="hidden" name="type"
                                                                value="property_wanted_frontend">
                                                        @else
                                                            <input type="hidden" name="type"
                                                                value="property_wanted_backend">
                                                        @endif

                                                        <input type="hidden" name="product_name" value="Room Premium">

                                                        <input type="hidden" id="room_premium_size" name="room_size"
                                                            value="">
                                                        <input type="hidden" id="room_premium_quantity"
                                                            name="room_quantity" value="">
                                                        <input type="hidden" id="room_premium_service_charge_id"
                                                            name="service_charge_id" value="">
                                                        <input type="hidden" id="room_premium_charge" name="room_charge"
                                                            value="">

                                                        <input type="hidden" name="plan" value="Premium">
                                                        <input type="hidden" name="child_category_id_from_backend"
                                                            value="11">

                                                        <td class="bg-lblue">
                                                            <button type="submit" class="btn"
                                                                id="room_premium_pay_btn"
                                                                style="color: white">PAY</button>
                                                        </td>
                                                    </form>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade {{ $child_category_id == 12 ? 'show active' : '' }}" id="tab4">
                        <!-- Content for tab 2 goes here -->
                        <div id="generic_price_table">

                            <!-- Pricing # -->
                            <div class="pricing">
                                <div class="container">
                                    <div class="pricing-table table-responsive" style="text-align: -webkit-center">
                                        <table class="table">
                                            <!-- Heading -->
                                            @include(
                                                'frontend.other_services.partial.property_finding_service.table_head',
                                                [
                                                    'category_name' => 'House',
                                                    'service_charge' => $house_service_charge,
                                                ]
                                            )

                                            <tbody>

                                                @include('frontend.other_services.partial.property_finding_service.tab_table')

                                                <!-- Buttons -->
                                                <tr>
                                                    <td>&nbsp;</td>

                                                    <td class="bg-green">
                                                        @include(
                                                            'frontend.other_services.partial.property_finding_service.pay_button',
                                                            [
                                                                'product_id' => $property_id ?? null,
                                                                'product_name' => 'House Regular',
                                                                'plan' => 'Regular',
                                                                'bill' => $house_service_charge,
                                                                'child_category_id_from_backend' =>
                                                                    $child_category_id ?? 12,
                                                                'service_charge_id' => 4,
                                                            ]
                                                        )
                                                    </td>

                                                    <td class="bg-lblue">
                                                        @include(
                                                            'frontend.other_services.partial.property_finding_service.pay_button',
                                                            [
                                                                'product_id' => $property_id ?? null,
                                                                'product_name' => 'House Premium',
                                                                'plan' => 'Premium',
                                                                'bill' => $house_service_charge * 1.4,
                                                                'child_category_id_from_backend' =>
                                                                    $child_category_id ?? 12,
                                                                'service_charge_id' => 4,
                                                            ]
                                                        )
                                                    </td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>



            <div class="open_market card p-5 mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Thousands of Openmarket assistants waiting to help you to get your property</h4>
                        <h4 class="fw-bold mt-4">Does Not Matter Who You Are And Where You Are Just Get Your Property </h4>
                        <h6>If you have all required instruments to get the property, then all other formalities are just
                            matters of your assistants. You just pay to hire the assistants and get your property ready.
                        </h6>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="{{ asset('assets/frontend/property_finding2.png') }}" alt="property_finding.png"
                            style="width: 75%">
                    </div>
                </div>
            </div>

            <div class="review card p-5 mt-5">
                <div class="row">
                    <div class="col-md-12 course-details-content">
                        <div class="course-details mt--40">
                            <div class="course-content">
                                <h4 class="text-center fw-bold">Some comments on this service</h4>
                                <div class="pt--25">

                                    <!-- Comment Box -->
                                    <div class="edu-comment">
                                        <div class="thumbnail">
                                            <img src="{{ asset('assets/frontend/reviewer1.png') }}" alt="Comment Images">
                                        </div>
                                        <div class="comment-content">
                                            <p style="color: black">Unipuller property finding team is very professional
                                                and responsive to the customer. Their serivce is very flexiable and reliable
                                                to get property according to my choice. </p>
                                        </div>
                                    </div>
                                    <!-- Comment Box -->

                                    <!-- Comment Box -->
                                    <div class="edu-comment">
                                        <div class="thumbnail">
                                            <img src="{{ asset('assets/frontend/reviewer2.jpg') }}" alt="Comment Images">
                                        </div>
                                        <div class="comment-content">
                                            <p style="color: black">The Unipuller Openmarket property-finding service is
                                                innovative and highly sought after by tenants. When I first heard about it
                                                from one of my friends, I found it quite interesting. This service is the
                                                best option for those who are looking for properties but don't have enough
                                                time or knowledge to handle it.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Comment Box -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="faq card p-5 mt-5 mb-4">
                <h4 class="fw-bold text-center mb-4">Frequent questions and Answers</h4>

                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a1" aria-expanded="false" aria-controls="a1"
                                data-bs-parent="#faqAccordion">
                                &rarr; Why should I take this service?
                            </button>
                        </h2>
                        <div id="a1" class="accordion-collapse collapse" aria-labelledby="q1">
                            <div class="accordion-body">
                                Many people chose this service to get their properties because of the convenience of getting
                                the
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q2">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a2" aria-expanded="false" aria-controls="a2"
                                data-bs-parent="#faqAccordion">
                                &rarr; Why do I need to pay?
                            </button>
                        </h2>
                        <div id="a2" class="accordion-collapse collapse" aria-labelledby="q2">
                            <div class="accordion-body">
                                You need to pay because thousands of openmarket assistants are working to find out
                                properties for the tenants.So for their hours of work to find out your property, you have to
                                pay.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q3">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a3" aria-expanded="false" aria-controls="a3"
                                data-bs-parent="#faqAccordion">
                                &rarr; Why do I pay before getting property?
                            </button>
                        </h2>
                        <div id="a3" class="accordion-collapse collapse" aria-labelledby="q3">
                            <div class="accordion-body">
                                You are paying upfront to let the Openmarket Assistants know that you are willing and ready
                                to
                                take their service. Once you pay the service charge, all Openmarket Assistants get
                                notification
                                for your needs and they start working immediately. Also you are paying upfront to make sure
                                that
                                theOpenmarket Assistants will get his/her payments immediately as soon as they deliver the
                                property.

                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q4">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a4" aria-expanded="false" aria-controls="a4"
                                data-bs-parent="#faqAccordion">
                                &rarr; What is an Openmarket Assistant?
                            </button>
                        </h2>
                        <div id="a4" class="accordion-collapse collapse" aria-labelledby="q4">
                            <div class="accordion-body">
                                Openmarket Assistants are those people who have properties to let and people who are working
                                to
                                find out your property. The market is open to anyone to work as an assistant. There are no
                                boundaries or restrictions to be an Openmarket Assistants.Anyone from any country can be an
                                open
                                market assistant.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q5">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a5" aria-expanded="false" aria-controls="a5"
                                data-bs-parent="#faqAccordion">
                                &rarr; How effective is this service?
                            </button>
                        </h2>
                        <div id="a5" class="accordion-collapse collapse" aria-labelledby="q5">
                            <div class="accordion-body">
                                This is very effective to get a property because when you pay for the service in our
                                Openmarket.
                                Once you pay in Openmarket, thousands of people start working to find out property for you
                                so
                                that they can get that service charge. But if you hire anyone or you search property by
                                yourself
                                then the limited time of a single person can reduce the searching area and positive outcome
                                after investing hundreds of hours. In fact if you work by yourself to find out the property
                                then
                                the hours that you spent is more costly than the service charge because when you pay the
                                service
                                charge, hundreds of people will start working for you. So Openmarket hire is more beneficial
                                and
                                effective than hiring someone for you or working alone!

                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q6">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a6" aria-expanded="false" aria-controls="a6"
                                data-bs-parent="#faqAccordion">
                                &rarr; How helpful is this service?
                            </button>
                        </h2>
                        <div id="a6" class="accordion-collapse collapse" aria-labelledby="q6">
                            <div class="accordion-body">
                                This service is very helpful because, when you work alone, your limited search will impact
                                the
                                positive outcome but when you pay the service charge in Openmarket, hundreds of people will
                                start working for you in a wide range of areas.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q7">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a7" aria-expanded="false" aria-controls="a7"
                                data-bs-parent="#faqAccordion">
                                &rarr; Does it cost if I do not get any properties?
                            </button>
                        </h2>
                        <div id="a7" class="accordion-collapse collapse" aria-labelledby="q7">
                            <div class="accordion-body">
                                No! You will not be charged anything if you do not get the property from RealZipper.
                                Customers
                                pay upfront as a security deposit for the service charge. Only customers will be charged if
                                they
                                take property. Otherwise, their upfront security deposit will be refunded in full.
                                Can I cancel the service?
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q8">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a8" aria-expanded="false" aria-controls="a8"
                                data-bs-parent="#faqAccordion">
                                &rarr; Can I cancel the service?
                            </button>
                        </h2>
                        <div id="a8" class="accordion-collapse collapse" aria-labelledby="q8">
                            <div class="accordion-body">
                                Yes! Customers can cancel the service at any time. But those customers who already have
                                taken
                                property from a service provider are not eligible to cancel the service because Unipuller
                                transfers the service charges to the providers as soon as property has been delivered.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q9">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a9" aria-expanded="false" aria-controls="a9"
                                data-bs-parent="#faqAccordion">
                                &rarr; Can I get the refund if I do not get any property?
                            </button>
                        </h2>
                        <div id="a9" class="accordion-collapse collapse" aria-labelledby="q9">
                            <div class="accordion-body">
                                Yes! You will get a refund in full amounts within 7 to 21 working days if you do not get any
                                properties. If you do not have any disputes with any service providers then you will get a
                                refund in 7 working days but this could take up to 21 days when there are any disputes.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q10">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a10" aria-expanded="false" aria-controls="a10"
                                data-bs-parent="#faqAccordion">
                                &rarr; What is the difference between regular and premium service?
                            </button>
                        </h2>
                        <div id="a10" class="accordion-collapse collapse" aria-labelledby="q10">
                            <div class="accordion-body">
                                There are several benefits of taking premium service compared to regular service.
                                <br>
                                <b>Regular:</b> Customers will get property finding services by Openmarket assistants. When
                                a
                                customer pays the service charge, anyone who has property can offer the customer. If
                                customers
                                take any properties then only they will be charged otherwise their security deposit will be
                                refunded.
                                <br>
                                <b> Premium: </b> Customers will get property finding services from partner agents and
                                Openmarket
                                assistants. A dedicated employee will look after your case closely and you will get 1 to 1
                                contact facilities for any updates.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q11">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a11" aria-expanded="false" aria-controls="a11"
                                data-bs-parent="#faqAccordion">
                                &rarr; How long can it take to get a property?
                            </button>
                        </h2>
                        <div id="a11" class="accordion-collapse collapse" aria-labelledby="q11">
                            <div class="accordion-body">
                                When a customer pays the service charge security deposits, the success rate of getting a
                                property increases. Many Openmarket assistants work on it to earn as a freelancer. So,
                                somehow
                                it becomes their profession to find out a property for the customers. While a customer pays
                                for
                                the premium service, many agents start working instantly to find out the property along with
                                a
                                dedicated officer who will take care of the service and any disputes. So, when a customer
                                purchases a property finding service, the success rate of getting property is very positive
                                within 7 to 21 working days.

                            </div>
                        </div>
                    </div>


                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q12">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a12" aria-expanded="false" aria-controls="a12"
                                data-bs-parent="#faqAccordion">
                                &rarr; What does Unipuller do?
                            </button>
                        </h2>
                        <div id="a12" class="accordion-collapse collapse" aria-labelledby="q12">
                            <div class="accordion-body">
                                Unipuller collaborates with numerous agents and Openmarket freelancers to secure properties
                                for tenants. Unipuller is also committed to ensuring that customers receive their properties
                                on time, and that their payments are handled securely. Unipuller holds customer payments in
                                their account until the customer acquires a property from an agent or through Openmarket.
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="connect_facebook card p-5 mt-2 text-center">
                <div class="text-center">
                    <img src="{{ asset('assets/frontend/real_zipper.jpg') }}" alt="real_zipper.png" style="width: 75%">
                </div>
                <div class="d-flex justify-content-center">
                    <a href="https://www.facebook.com/groups/181034591618704" class="btn mt-4"
                        style="background: #3b5998; color: white; font-size: 16px;" target="_blank">Connect with
                        Facebook</a>
                </div>
            </div>



            {{-- <div class="row mt-3 mb-5 banking_information">
                <div class="col-md-3" style="border-style: ridge;">
                    <h6 class="body-heading">Company Bank Details: </h6>
                    <h6 class="body-heading">Account Name: Unipuller Ltd </h6>
                    <h6 class="body-heading">Account Number: 20378125 </h6>
                    <h6 class="body-heading">Sort code: 04-06-05 </h6>

                </div>
            </div> --}}
        </div>

    </div>
@endsection
@section('script')
    {{-- <script>
        const $regularPrice = $('#regular_price_room_tab3');
        const $premiumPrice = $('#premium_price_room_tab3');
        const $regularpayButton = $('#room_regular_pay_btn');
        const $premiumpayButton = $('#room_premium_pay_btn');

        const $room_regular_size = $('#room_regular_size');
        const $room_regular_quantity = $('#room_regular_quantity');
        const $room_regular_charge = $('#room_regular_charge');
        const $room_regular_service_charge_id = $('#room_regular_service_charge_id');

        const $room_premium_size = $('#room_premium_size');
        const $room_premium_quantity = $('#room_premium_quantity');
        const $room_premium_charge = $('#room_premium_charge');
        const $room_premium_service_charge_id = $('#room_premium_service_charge_id');


        $regularpayButton.prop('disabled', true);
        $premiumpayButton.prop('disabled', true);

        function updatePrices() {
            const selectedCategory = $('#child_category_id_room_tab_3').val();
            const selectedQuantity = $('#quantity_tab_3').val();

            if (selectedCategory != 0 && selectedQuantity != 0) {
                $.ajax({
                    url: '/property-finding-service-charge/' + selectedCategory,
                    type: 'get',
                    success: (result) => {
                        if (result.service_charge) {
                            const serviceCharge = result.service_charge.service_charge.toFixed(2);
                            $regularPrice.text('£' + (serviceCharge * selectedQuantity)).show();

                            const premiumServiceCharge = (serviceCharge * 1.4).toFixed(2);
                            $premiumPrice.text('£' + (premiumServiceCharge * selectedQuantity)).show();

                            $room_regular_size.val(result.service_charge.size);
                            $room_regular_quantity.val(selectedQuantity);
                            $room_regular_service_charge_id.val(result.service_charge.id);
                            $room_regular_charge.val(result.service_charge.service_charge);

                            $room_premium_size.val(result.service_charge.size);
                            $room_premium_quantity.val(selectedQuantity);
                            $room_premium_service_charge_id.val(result.service_charge.id);
                            $room_premium_charge.val(result.service_charge.service_charge * 1.4);

                            $regularpayButton.prop('disabled', false);
                            $premiumpayButton.prop('disabled', false);
                        }
                    }
                });
            } else {
                $regularPrice.text('£0.0').show();
                $premiumPrice.text('£0.0').show();

                $regularpayButton.prop('disabled', true);
                $premiumpayButton.prop('disabled', true);
            }
        }

        $('#child_category_id_room_tab_3, #quantity_tab_3').on('change', function() {
            updatePrices();
        });
    </script> --}}


    <script>
        const $regularPrice = $('#regular_price_room_tab3');
        const $premiumPrice = $('#premium_price_room_tab3');
        const $regularpayButton = $('#room_regular_pay_btn');
        const $premiumpayButton = $('#room_premium_pay_btn');

        const $room_regular_size = $('#room_regular_size');
        const $room_regular_quantity = $('#room_regular_quantity');
        const $room_regular_charge = $('#room_regular_charge');
        const $room_regular_service_charge_id = $('#room_regular_service_charge_id');

        const $room_premium_size = $('#room_premium_size');
        const $room_premium_quantity = $('#room_premium_quantity');
        const $room_premium_charge = $('#room_premium_charge');
        const $room_premium_service_charge_id = $('#room_premium_service_charge_id');

        // Define a function to update prices
        function updatePrices() {
            const selectedCategory = $('#child_category_id_room_tab_3').val();
            const selectedQuantity = $('#quantity_tab_3').val();

            if (selectedCategory != 0 && selectedQuantity != 0) {
                $.ajax({
                    url: '/property-finding-service-charge/' + selectedCategory,
                    type: 'get',
                    success: (result) => {
                        if (result.service_charge) {
                            const serviceCharge = result.service_charge.service_charge.toFixed(2);
                            $regularPrice.text('£' + (serviceCharge * selectedQuantity)).show();

                            const premiumServiceCharge = (serviceCharge * 1.4 * selectedQuantity).toFixed(2);
                            $premiumPrice.text('£' + premiumServiceCharge).show();

                            $room_regular_size.val(result.service_charge.size);
                            $room_regular_quantity.val(selectedQuantity);
                            $room_regular_service_charge_id.val(result.service_charge.id);
                            $room_regular_charge.val(result.service_charge.service_charge);

                            $room_premium_size.val(result.service_charge.size);
                            $room_premium_quantity.val(selectedQuantity);
                            $room_premium_service_charge_id.val(result.service_charge.id);
                            $room_premium_charge.val(result.service_charge.service_charge * 1.4);

                            $regularpayButton.prop('disabled', false);
                            $premiumpayButton.prop('disabled', false);
                        }
                    }
                });
            } else {
                $regularPrice.text('£0.0').show();
                $premiumPrice.text('£0.0').show();

                $regularpayButton.prop('disabled', true);
                $premiumpayButton.prop('disabled', true);
            }
        }

        // Call the updatePrices function on page load
        updatePrices();

        // Attach event handlers
        $('#child_category_id_room_tab_3, #quantity_tab_3').on('change', function() {
            updatePrices();
        });
    </script>

    {{-- @include('frontend.other_services.partial.property_finding_service.script') --}}
@endsection
