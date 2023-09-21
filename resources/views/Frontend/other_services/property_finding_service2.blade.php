@extends('frontend.layouts.master_layout')
@section('css')
    @include('frontend.other_services.partial.property_finding_service.style')
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">

        <div class="header m-3 p-3">

            <div class="property_finding_service">
                <h3 class="heading ">Property finding service </h3>
                <p class="heading-details">Unipuller is offering Tenant services to find out their properties. All our
                    services are premium and promised to deliver the service within due time. The service information and
                    service confirmation process are given below with details. This detailed information will be used as the
                    tenant service policy.
                </p>
            </div>

            <div class="service_includes">
                <h6 class="body-heading">Service includes:</h6>
                <ol>
                    <li> Finding properties on behalf of Tenant </li>
                    <li> Scheduling booking for the viewing of properties with landlord </li>
                    <li> Processing documents for the tenancy agreement with landlord </li>
                </ol>
            </div>

            <div class="service_contract_duration">
                <h6 class="body-heading">Service contract duration:</h6>
                <p> All our letting services are coming with a valid contract time. Once a customer confirms their booking
                    with us, their service will remain active until next 7 working days for premium service and 30 days for
                    the regular service.
                </p>
            </div>

            <div class="category_tab">
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
            </div>

            @php
                $service_charges = DB::table('service_charges')->get();
                $studio_flat_service_charge = null;
                $house_service_charge = null;
                $flat_service_charge = null;
                
                foreach ($service_charges as $item) {
                    if ($item->child_category == 2) {
                        $house_service_charge = $item->service_charge;
                    }
                
                    if ($item->child_category == 6) {
                        $flat_service_charge = $item->service_charge;
                    }
                
                    if ($item->child_category == 9) {
                        $studio_flat_service_charge = $item->service_charge;
                    }
                }
                
            @endphp


            <div class="tab-content custom-tab-content">

                <div class="tab-pane fade {{ $child_category_id == 14 || $child_category_id === null ? 'show active' : '' }}"
                    id="tab1">
                    <!-- Content for tab 1 goes here -->
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
                                                'category_name' => 'Studio Flat',
                                                'service_charge' => $studio_flat_service_charge,
                                            ]
                                        )

                                        <tbody>

                                            @include('frontend.other_services.partial.property_finding_service.tab_table')


                                            <!-- Buttons -->
                                            <tr>
                                                <td>&nbsp;</td>

                                                {{-- @include(
                                                    'frontend.other_services.partial.property_finding_service.pay_button',
                                                    [
                                                        'product_id' => '5',
                                                        'product_name' => 'Studio Flat Regular',
                                                        'bill' => $studio_flat_service_charge,
                                                        'service_id' => $service_id,
                                                        'child_category_id' => $child_category_id,
                                                    ]
                                                ) --}}

                                                <td class="bg-green">
                                                    <form id="propertyFindingPaymentForm" method="GET"
                                                        action="{{ route('propertyFindingPayment') }}">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="5">
                                                        <input type="hidden" name="product_name"
                                                            value="Studio Flat Regular">
                                                        <input type="hidden" name="product_name"
                                                            value="Studio Flat Regular">
                                                        <input type="hidden" name="plan" value="Regular">
                                                        <input type="hidden" name="bill"
                                                            value="{{ $studio_flat_service_charge }}">

                                                        @if ($service_id !== null)
                                                            <input type="hidden" name="service_id"
                                                                value="{{ $service_id }}">
                                                            <input type="hidden" name="child_category_id_from_backend"
                                                                value="{{ $child_category_id }}">
                                                        @endif

                                                        <button type="submit" class="btn"
                                                            style="color: white">PAY</button>

                                                    </form>
                                                </td>

                                                <td class="bg-lblue">
                                                    <form id="propertyFindingPaymentForm" method="GET"
                                                        action="{{ route('propertyFindingPayment') }}">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="5">
                                                        <input type="hidden" name="product_name"
                                                            value="Studio Flat Premium">
                                                        <input type="hidden" name="bill"
                                                            value="{{ $studio_flat_service_charge * 1.7 }}">

                                                        <button type="submit" class="btn"
                                                            style="color: white">PAY</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                                                <form id="propertyFindingPaymentForm" method="GET"
                                                    action="{{ route('propertyFindingPayment') }}">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="3">
                                                    <input type="hidden" name="product_name" value="Flat Regular">
                                                    <input type="hidden" name="bill"
                                                        value="{{ $flat_service_charge }}">

                                                    <td class="bg-green">
                                                        <button type="submit" class="btn"
                                                            style="color: white">PAY</button>
                                                    </td>
                                                </form>
                                                <form id="propertyFindingPaymentForm" method="GET"
                                                    action="{{ route('propertyFindingPayment') }}">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="3">
                                                    <input type="hidden" name="product_name" value="Flat Premium">
                                                    <input type="hidden" name="bill"
                                                        value="{{ $flat_service_charge * 1.7 }}">

                                                    <td class="bg-lblue">
                                                        <button type="submit" class="btn"
                                                            style="color: white">PAY</button>
                                                </form>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade {{ $child_category_id == 11 ? 'show active' : '' }}" id="tab3">
                    <!-- Content for tab 1 goes here -->
                    <div id="generic_price_table">
                        <!-- Pricing # -->
                        <div class="pricing">
                            <div class="container">
                                <div class="pricing-table table-responsive" style="text-align: -webkit-center">
                                    <table class="table">
                                        <!-- Heading -->
                                        <thead>
                                            <th>
                                                <select style="background: white;" id="child_category_id_room_tab3">
                                                    <option value="0">Select Room</option>
                                                    <option value="1">Single </option>
                                                    <option value="6">Semi-Double</option>
                                                    <option value="2">Double</option>
                                                    <option value="7">En-suite</option>
                                                </select>
                                            </th>

                                            <th>
                                                Regular
                                                <span class="ptable-star green">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    {{-- <i class="fa fa-star-half-o"></i> --}}
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
                                                <span class="ptable-price" id="premium_price_room_tab3">£99.0</span>
                                            </th>

                                        </thead>

                                        <tbody id="table_room_tab3">

                                            @include('frontend.other_services.partial.property_finding_service.tab_table')

                                            <!-- Buttons -->
                                            <!-- Buttons -->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <form id="propertyFindingPaymentForm" method="GET"
                                                    action="{{ route('propertyFindingPayment') }}">
                                                    @csrf
                                                    <input type="hidden" id="room_regular_product_id" name="product_id"
                                                        value="">
                                                    <input type="hidden" id="room_regular_product_name"
                                                        name="product_name" value="">
                                                    <input type="hidden" id="room_regular_product_bill" name="bill"
                                                        value="">

                                                    <td class="bg-green">
                                                        <button type="submit" class="btn"
                                                            style="color: white">PAY</button>
                                                    </td>
                                                </form>
                                                <form id="propertyFindingPaymentForm" method="GET"
                                                    action="{{ route('propertyFindingPayment') }}">
                                                    @csrf
                                                    <input type="hidden" id="room_premium_product_id" name="product_id"
                                                        value="">
                                                    <input type="hidden" id="room_premium_product_name"
                                                        name="product_name" value="">
                                                    <input type="hidden" id="room_premium_product_bill" name="bill"
                                                        value="">

                                                    <td class="bg-lblue">
                                                        <button type="submit" class="btn"
                                                            style="color: white">PAY</button>
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
                                                <form id="propertyFindingPaymentForm" method="GET"
                                                    action="{{ route('propertyFindingPayment') }}">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="4">
                                                    <input type="hidden" name="product_name" value="House Regular">
                                                    <input type="hidden" name="bill"
                                                        value="{{ $house_service_charge }}">

                                                    <td class="bg-green">
                                                        <button type="submit" class="btn"
                                                            style="color: white">PAY</button>
                                                    </td>
                                                </form>
                                                <form id="propertyFindingPaymentForm" method="GET"
                                                    action="{{ route('propertyFindingPayment') }}">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="4">
                                                    <input type="hidden" name="product_name" value="House Premium">
                                                    <input type="hidden" name="bill"
                                                        value="{{ $house_service_charge * 1.7 }}">

                                                    <td class="bg-lblue">
                                                        <button type="submit" class="btn"
                                                            style="color: white">PAY</button>
                                                </form>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="booking_fee mt-3">
                <h6 class="body-heading">1. Booking fee (premium):</h6>
                <p> Premium booking guarantees 95% of the property within 7 working days. We are promised to deliver
                    the property within due time. Our dedicated team will work on behalf of the tenants until last minute to
                    find out their property from the market. To confirm the booking, customers need to pay the service
                    charge upfront as security money. Once customers confirm their bookings, their service will remain
                    active until next 7 working day.
                </p>

                <h6 class="body-heading">2. Booking fee (Regular): </h6>
                <p> All our services have regular booking features. Regular booking guarantees 95% of the property
                    within 30 days. Regular service promised to deliver the property within due time. A dedicated team will
                    work on behalf of the tenants until last minute to find out their property from the market. To confirm
                    the booking, customers need to pay upfront as security money. Once customers confirm their bookings,
                    their service will remain active until next 30 day.
                </p>
            </div>

            <div class="refund mt-3">
                <h6 class="body-heading">Refund: </h6>
                <ul>
                    <li> • All booking fees are 100% refundable if property not been delivered within service
                        contract time
                    </li>
                    <li> • Customers will get 100% money refund within 7 working days if they cancel bookings within
                        24 hours from the booking confirmation time</li>
                    <li> • Customers will get 100% money refund within 30 days if they cancel bookings after 24
                        hours from the booking confirmation time
                    </li>
                    <li> • 50% of the security money will be deducted as compensation to Unipuller If customer view
                        5 properties physically and fail to choose any of them to confirm
                    </li>
                </ul>
            </div>

            <div class="note mt-3">
                <p class="body-heading">
                    <b>N: B: Unipuller provides property finding services for the tenants only after getting booking
                        confirmation from the customers. Unipuller taking booking fee upfront as the
                        security of the service. Unipuller do not own any properties to rent. Unipuller only works on behalf
                        of the tenants to find out their required properties from the market. As the market has uncertainty
                        of getting property and Unipuller does not own any properties, so Unipuller does not guarantees of
                        property 100%. Unipuller only works on behalf of the tenants to find their property and if fail find
                        out, customers will get their security money refund without any grounds.
                    </b>
                </p>
            </div>


            <div class="benefits_our_serices mt-3">
                <h6 class="body-heading">Benefits of our services: </h6>
                <ol>
                    <li>Extra property sourcing benefits for the tenants</li>
                    <li>Additional team to find out property on behalf of the tenants</li>
                    <li>Wider property sourcing link</li>
                    <li>No property no cost (customers do not need to pay any cost unless they take property)</li>
                    <li>90% confirmation of the property</li>
                    <li>No hidden charge</li>
                </ol>
            </div>

            <div class="row mt-3 mb-5 banking_information">
                <div class="col-md-3" style="border-style: ridge;">
                    <h6 class="body-heading">Company Bank Details: </h6>
                    <h6 class="body-heading">Account Name: Unipuller Ltd </h6>
                    <h6 class="body-heading">Account Number: 20378125 </h6>
                    <h6 class="body-heading">Sort code: 04-06-05 </h6>

                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    @include('frontend.other_services.partial.property_finding_service.style')
@endsection
