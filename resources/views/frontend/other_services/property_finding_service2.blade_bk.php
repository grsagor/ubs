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
                                                            'product_id' => '5',
                                                            'product_name' => 'Studio Flat Regular',
                                                            'plan' => 'Regular',
                                                            'bill' => $studio_flat_service_charge,
                                                            'service_id' => $service_id ?? null,
                                                            'child_category_id_from_backend' =>
                                                                $child_category_id ?? null,
                                                        ]
                                                    )
                                                </td>

                                                <td class="bg-lblue">

                                                    @include(
                                                        'frontend.other_services.partial.property_finding_service.pay_button',
                                                        [
                                                            'product_id' => '5',
                                                            'product_name' => 'Studio Flat Premium',
                                                            'plan' => 'Premium',
                                                            'bill' => $studio_flat_service_charge * 1.4,
                                                            'service_id' => $service_id ?? null,
                                                            'child_category_id_from_backend' =>
                                                                $child_category_id ?? null,
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
                                                            'product_id' => '3',
                                                            'product_name' => 'Flat Regular',
                                                            'plan' => 'Regular',
                                                            'bill' => $flat_service_charge,
                                                            'service_id' => $service_id ?? null,
                                                            'child_category_id_from_backend' =>
                                                                $child_category_id ?? null,
                                                        ]
                                                    )
                                                </td>

                                                <td class="bg-lblue">
                                                    @include(
                                                        'frontend.other_services.partial.property_finding_service.pay_button',
                                                        [
                                                            'product_id' => '3',
                                                            'product_name' => 'Flat Premium',
                                                            'plan' => 'Premium',
                                                            'bill' => $flat_service_charge * 1.4,
                                                            'service_id' => $service_id ?? null,
                                                            'child_category_id_from_backend' =>
                                                                $child_category_id ?? null,
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

                                                <div class="room_type_tab" id="room_type_tab">
                                                    <div class="row" id="room_type_tab1">

                                                    </div>
                                                </div>

                                                {{-- Add button --}}
                                                <div class="add_button_tab_3">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <button class="btn bg-success" type="button" id="add">
                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                            </button>
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
                                                            'product_id' => '4',
                                                            'product_name' => 'House Regular',
                                                            'plan' => 'Regular',
                                                            'bill' => $house_service_charge,
                                                            'service_id' => $service_id ?? null,
                                                            'child_category_id_from_backend' =>
                                                                $child_category_id ?? null,
                                                        ]
                                                    )
                                                </td>

                                                <td class="bg-lblue">
                                                    @include(
                                                        'frontend.other_services.partial.property_finding_service.pay_button',
                                                        [
                                                            'product_id' => '4',
                                                            'product_name' => 'House Premium',
                                                            'plan' => 'Premium',
                                                            'bill' => $house_service_charge * 1.4,
                                                            'service_id' => $service_id ?? null,
                                                            'child_category_id_from_backend' =>
                                                                $child_category_id ?? null,
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
    <script>
        $(document).ready(function() {

            var i = 1;
            var j = 1;
            var maxRows = 5;
            let totalServiceCharge = 0;

            var selectedCategories = [];
            let totalServiceCharges = [];
            let childCategoryIds = [];
            let quantities = [];

            const $regularPrice = $('#regular_price_room_tab3');
            const $premiumPrice = $('#premium_price_room_tab3');


            const $roomRegularProductid = $('#room_regular_product_id');
            const $roomRegularProductName = $('#room_regular_product_name');
            const $roomRegularProductBill = $('#room_regular_product_bill');

            const $roomPremiumProductid = $('#room_premium_product_id');
            const $roomPremiumProductName = $('#room_premium_product_name');
            const $roomPremiumProductBill = $('#room_premium_product_bill');

            $('#room_type_tab').on('change', 'select[id^="child_category_id_room_tab3_"]', function() {
                $(this).prop('disabled', true);
            });

            $('#room_type_tab').on('change', 'select[id^="quantity_tab3_"]', function() {
                $(this).prop('disabled', true);
            });

            function rowIncreaseFunction() {
                var selectedValueCategory = $('#child_category_id_room_tab3_' + j).val();
                var selectedValueQuantity = $('#quantity_tab3_' + j).val();

                if (selectedValueCategory != 0 && selectedValueQuantity != 0) {
                    if (i < maxRows) {
                        j++;
                        i++;

                        $('#room_type_tab').on('change', '#child_category_id_room_tab3_' + j, function() {
                            let id = $(this).val();
                            if (id != 0) {
                                $.ajax({
                                    url: '/property-finding-service-charge/' + id,
                                    type: 'get',
                                    success: (result) => {
                                        if (result) {
                                            // Save the child category ID in the array
                                            childCategoryIds[j] = id;

                                            $('#room_type_tab').on('change', '#quantity_tab3_' +
                                                j,
                                                function() {
                                                    let quantity = $(this).val();

                                                    // Save the quantity in the array
                                                    quantities[j] = quantity;

                                                    // Your existing code to calculate service charges and update the UI
                                                    serviceCharge = result.service_charge
                                                        .service_charge.toFixed(2) *
                                                        quantity;
                                                    totalServiceCharge += serviceCharge;
                                                    totalServiceCharges[j] = serviceCharge;
                                                    $regularPrice.text(
                                                        `£${totalServiceCharge}`).show();
                                                    premiumServiceCharge = (
                                                            totalServiceCharge * 1.4)
                                                        .toFixed(2);
                                                    $premiumPrice.text(
                                                            `£${premiumServiceCharge}`)
                                                        .show();

                                                    $roomRegularProductid.val(
                                                        childCategoryIds.filter(id =>
                                                            id !== undefined).join(', ')
                                                    );
                                                    $roomRegularProductName.val(quantities
                                                        .filter(qty => qty !==
                                                            undefined).join(', '));
                                                    $roomRegularProductBill.val(
                                                        totalServiceCharge);

                                                    $roomPremiumProductid.val(
                                                        childCategoryIds.filter(id =>
                                                            id !== undefined).join(', ')
                                                    );
                                                    $roomPremiumProductName.val(quantities
                                                        .filter(qty => qty !==
                                                            undefined).join(', '));
                                                    $roomPremiumProductBill.val(
                                                        premiumServiceCharge);

                                                    // Remove first two commas
                                                    console.log('Child category id ' +
                                                        childCategoryIds.filter(id =>
                                                            id !== undefined).join(', ')
                                                    );
                                                    console.log('Quantity ' + quantities
                                                        .filter(qty => qty !==
                                                            undefined).join(', '));
                                                });
                                        }
                                    }
                                });
                            }
                        });

                        selectedCategories.push(selectedValueCategory);

                        var categoryOptionsHtml = '<option value="0">Select</option>';

                        for (var optionValue = 1; optionValue <= 7; optionValue++) {
                            if (!selectedCategories.includes(optionValue.toString())) {
                                var optionText = getOptionText(optionValue);
                                if (optionText.trim() !== '') {
                                    categoryOptionsHtml += '<option value="' + optionValue + '">' +
                                        optionText + '</option>';
                                }
                            }
                        }

                        $('#room_type_tab').append(
                            '<div class="row" id="room_type_tab' + j +
                            '"> <div class="col-md-6" style="padding-right: 0;"> <select class="form-control" style="background: white; height: auto;" id="child_category_id_room_tab3_' +
                            j + '">' + categoryOptionsHtml +
                            '</select> </div> <div class="col-md-4" style="padding-right: 0;"> <select class="form-control" style="background: white; height: auto;" id="quantity_tab3_' +
                            j +
                            '"> <option value="0">Qty</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> </select> </div> <div class="col-md-2"> <button class="btn bg-danger btn_remove" type="button" id="' +
                            j +
                            '" style="padding: 6px; line-height: 0px; margin-top: -20px;"> <i class="fa fa-times" aria-hidden="true"></i> </button> </div> </div>'
                        );
                    } else {
                        i = maxRows;
                        toastr.error('Maximum room type add 4');
                    }
                } else {
                    toastr.error('Please select a value before adding a new row.');
                }
            }

            if (j = 1) {
                rowIncreaseFunction();
            }

            $('#add').click(function() {
                rowIncreaseFunction();
            });


            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");

                // Get the child category ID of the item being removed
                var removedChildCategoryId = $('#child_category_id_room_tab3_' + button_id).val();

                // Find the index of the removed item in the childCategoryIds array
                var removedIndex = childCategoryIds.indexOf(removedChildCategoryId);

                if (removedIndex !== -1) {
                    // Remove the child category ID and quantity at the same index from the arrays
                    childCategoryIds.splice(removedIndex, 1);
                    quantities.splice(removedIndex, 1);
                }

                // Get the quantity of the item being removed
                var removedQuantity = $('#quantity_tab3_' + button_id).val();

                // Get the service charge for this item
                var removedServiceCharge = totalServiceCharges[button_id];

                // Subtract the service charge for the removed item from the totalServiceCharge
                totalServiceCharge -= removedServiceCharge;

                // Update the totalServiceCharges array by removing the entry for the removed item
                delete totalServiceCharges[button_id];

                // Update the UI with the new total service charge
                $regularPrice.text(`£${totalServiceCharge}`).show();

                // Calculate and update the premium service charge
                var premiumServiceCharge = (totalServiceCharge * 1.4).toFixed(2);
                $premiumPrice.text(`£${premiumServiceCharge}`).show();

                var removedCategory = $('#child_category_id_room_tab3_' + button_id).val();

                selectedCategories = selectedCategories.filter(category => category !== removedCategory);

                $('select').show();

                selectedCategories.forEach(function(category) {
                    $('select option[value="' + category + '"]').hide();
                });

                $('#room_type_tab' + button_id).remove();

                i--;
            });



            function getOptionText(optionValue) {
                switch (optionValue) {
                    case 1:
                        return 'Single';
                    case 6:
                        return 'Semi-Double';
                    case 2:
                        return 'Double';
                    case 7:
                        return 'En-suite';
                    default:
                        return '';
                }
            }

        });
    </script>
    {{-- @include('frontend.other_services.partial.property_finding_service.script') --}}
@endsection
