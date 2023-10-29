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
                                    <table class="table" style="width: 75%">

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
                                                                style="background: white; height: auto;" id="quantity_tab_3"
                                                                name="quantity" {{ $property_size ? 'disabled' : '' }}>
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
                                                    <input type="hidden" id="room_regular_product_id" name="product_id"
                                                        value="{{ $property_id ?? null }}">
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
                                                    <input type="hidden" id="room_regular_quantity" name="room_quantity"
                                                        value="">
                                                    <input type="hidden" id="room_regular_service_charge_id"
                                                        name="service_charge_id" value="">
                                                    <input type="hidden" id="room_regular_charge" name="room_charge"
                                                        value="">

                                                    <input type="hidden" name="plan" value="Regular">
                                                    <input type="hidden" name="child_category_id_from_backend"
                                                        value="11">

                                                    <td class="bg-green">
                                                        <button type="submit" class="btn" id="room_regular_pay_btn"
                                                            style="color: white">PAY</button>
                                                    </td>
                                                </form>

                                                <form id="propertyFindingPaymentForm" method="GET"
                                                    action="{{ route('propertyFindingPayment') }}">
                                                    @csrf
                                                    <input type="hidden" name="category_name" value="room">
                                                    <input type="hidden" id="room_premium_product_id" name="product_id"
                                                        value="{{ $property_id ?? null }}">
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
                                                    <input type="hidden" id="room_premium_quantity" name="room_quantity"
                                                        value="">
                                                    <input type="hidden" id="room_premium_service_charge_id"
                                                        name="service_charge_id" value="">
                                                    <input type="hidden" id="room_premium_charge" name="room_charge"
                                                        value="">

                                                    <input type="hidden" name="plan" value="Premium">
                                                    <input type="hidden" name="child_category_id_from_backend"
                                                        value="11">

                                                    <td class="bg-lblue">
                                                        <button type="submit" class="btn" id="room_premium_pay_btn"
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
