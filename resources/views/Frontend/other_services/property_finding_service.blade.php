@extends('frontend.layouts.master_layout')
@section('css')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 70%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(odd) {
            background-color: #dddddd;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">
        <div class="header m-3 p-3">
            <h3 class="heading ">Property finding service </h3>
            <p class="heading-details">Unipuller is offering Tenant services to find out their properties. All our services
                are premium and promised to
                deliver the service within due time. The service information and service confirmation process are given
                below with
                details. This detailed information will be used as the tenant service policy.
            </p>

            <div class="row">
                <div class="col-md-12">

                    <h6 class="body-heading">Service includes:</h6>
                    <ol>
                        <li> Finding properties on behalf of Tenant </li>
                        <li> Scheduling booking for the viewing of properties with landlord </li>
                        <li> Processing documents for the tenancy agreement with landlord </li>
                    </ol>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <h6 class="body-heading">Service contract duration:</h6>
                    <p> All our letting services are coming with a valid contract time. Once a customer confirms their
                        booking with us, their
                        service will remain active until next 7 working days for premium service and 30 days for the regular
                        service.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h6 class="body-heading">Service Cost:</h6>
                    <table>
                        <tr style="background: #72d4fa;">
                            <th>Type of property</th>
                            <th>Cost of service (Premium service delivery within 7 working days) </th>
                            <th>Cost of service (Regular service delivery within 30 days) </th>
                            <th style="width: 105px; text-align: center;">Buy</th>
                        </tr>

                        @foreach ($service_charge as $item)
                            <tr>
                                <td>{{ $item->size }}</td>
                                <td>£{{ $item->service_charge * 1.7 }}+VAT</td>
                                <td>£{{ $item->service_charge }}+VAT</td>
                                <td style="text-align: center;"> <a href="#" class="button-31">Add</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>


            <div class="row mt-3">
                <div class="col-md-12">
                    <h6 class="body-heading">1. Booking fee (premium):</h6>
                    <p> Premium booking guarantees 95% of the property within 7 working days. We are promised to deliver the
                        property
                        within due time. Our dedicated team will work on behalf of the tenants until last minute to find out
                        their property
                        from the market. To confirm the booking, customers need to pay the service charge upfront as
                        security money.
                        Once customers confirm their bookings, their service will remain active until next 7 working day.
                    </p>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <h6 class="body-heading">2. Booking fee (Regular): </h6>
                    <p> All our services have regular booking features. Regular booking guarantees 95% of the property
                        within 30 days.
                        Regular service promised to deliver the property within due time. A dedicated team will work on
                        behalf of the
                        tenants until last minute to find out their property from the market. To confirm the booking,
                        customers need to
                        pay upfront as security money. Once customers confirm their bookings, their service will remain
                        active until next
                        30 day.
                    </p>
                </div>
            </div>


            <div class="row mt-3">
                <div class="col-md-12">
                    <h6 class="body-heading">Refund: </h6>
                    <ul>
                        <li> • All booking fees are 100% refundable if property not been delivered within service contract
                            time
                        </li>
                        <li> • Customers will get 100% money refund within 7 working days if they cancel bookings within 24
                            hours from
                            the booking confirmation time</li>
                        <li> • Customers will get 100% money refund within 30 days if they cancel bookings after 24 hours
                            from
                            the
                            booking confirmation time
                        </li>
                        <li> • 50% of the security money will be deducted as compensation to Unipuller If customer view 5
                            properties physically and fail to choose any of them to confirm
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <p class="body-heading">
                        <b>N: B: Unipuller provides property finding services for the tenants only after
                            getting booking confirmation from the
                            customers. Unipuller taking booking fee upfront as the security of the service. Unipuller do not
                            own
                            any properties
                            to rent. Unipuller only works on behalf of the tenants to find out their required properties
                            from
                            the market. As the
                            market has uncertainty of getting property and Unipuller does not own any properties, so
                            Unipuller
                            does not
                            guarantees of property 100%. Unipuller only works on behalf of the tenants to find their
                            property
                            and if fail find
                            out, customers will get their security money refund without any grounds.</b>
                    </p>
                </div>
            </div>


            <div class="row mt-3">
                <div class="col-md-12">
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
            </div>


            <div class="row mt-3 mb-5">
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
