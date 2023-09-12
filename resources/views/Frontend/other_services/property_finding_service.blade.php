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







        @import url(https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700italic,700,900italic,900);
        @import url(https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900);
        @import url(https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900);

        body {
            background-color: #eee;
        }

        #generic_price_table {
            background-color: #f0eded;
        }

        /*PRICE COLOR CODE START*/
        #generic_price_table .generic_content {
            /* background-color: #afe6b7; */
        }

        #generic_price_table .generic_content .generic_head_price {
            background-color: #f6f6f6;
        }

        #generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg {
            border-color: #e4e4e4 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #e4e4e4;
        }

        #generic_price_table .generic_content .generic_head_price .generic_head_content .head span {
            color: #525252;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .sign {
            color: #414141;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .currency {
            color: #414141;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .cent {
            color: #414141;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .month {
            color: #414141;
        }

        #generic_price_table .generic_content .generic_feature_list ul li {
            color: #a7a7a7;
        }

        #generic_price_table .generic_content .generic_feature_list ul li span {
            color: #414141;
        }

        #generic_price_table .generic_content .generic_feature_list ul li:hover {
            background-color: #E4E4E4;
            border-left: 5px solid #2ECC71;
        }

        #generic_price_table .generic_content .generic_price_btn a {
            border: 1px solid #2ECC71;
            color: #2ECC71;
        }

        #generic_price_table .generic_content.active .generic_head_price .generic_head_content .head_bg,
        #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head_bg {
            border-color: #2ECC71 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #2ECC71;
            color: #fff;
        }

        #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head span,
        #generic_price_table .generic_content.active .generic_head_price .generic_head_content .head span {
            color: #fff;
        }

        #generic_price_table .generic_content:hover .generic_price_btn a,
        #generic_price_table .generic_content.active .generic_price_btn a {
            background-color: #2ECC71;
            color: #fff;
        }

        #generic_price_table {
            margin: 50px 0 50px 0;
            font-family: 'Raleway', sans-serif;
        }

        .row .table {
            padding: 28px 0;
        }

        /*PRICE BODY CODE START*/

        #generic_price_table .generic_content {
            overflow: hidden;
            position: relative;
            text-align: center;
        }

        #generic_price_table .generic_content .generic_head_price {
            margin: 0 0 20px 0;
        }

        #generic_price_table .generic_content .generic_head_price .generic_head_content {
            margin: 0 0 50px 0;
        }

        #generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg {
            border-style: solid;
            border-width: 90px 1411px 23px 399px;
            position: absolute;
        }

        #generic_price_table .generic_content .generic_head_price .generic_head_content .head {
            padding-top: 40px;
            position: relative;
            z-index: 1;
        }

        #generic_price_table .generic_content .generic_head_price .generic_head_content .head span {
            font-family: "Raleway", sans-serif;
            font-size: 28px;
            font-weight: 400;
            letter-spacing: 2px;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag {
            padding: 0 0 20px;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .price {
            display: block;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .sign {
            display: inline-block;
            font-family: "Lato", sans-serif;
            font-size: 28px;
            font-weight: 400;
            vertical-align: middle;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .currency {
            font-family: "Lato", sans-serif;
            font-size: 60px;
            font-weight: 300;
            letter-spacing: -2px;
            line-height: 60px;
            padding: 0;
            vertical-align: middle;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .cent {
            display: inline-block;
            font-family: "Lato", sans-serif;
            font-size: 24px;
            font-weight: 400;
            vertical-align: bottom;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .month {
            font-family: "Lato", sans-serif;
            font-size: 18px;
            font-weight: 400;
            letter-spacing: 3px;
            vertical-align: bottom;
        }

        #generic_price_table .generic_content .generic_feature_list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #generic_price_table .generic_content .generic_feature_list ul li {
            font-family: "Lato", sans-serif;
            font-size: 18px;
            padding: 15px 0;
            transition: all 0.3s ease-in-out 0s;
        }

        #generic_price_table .generic_content .generic_feature_list ul li:hover {
            transition: all 0.3s ease-in-out 0s;
            -moz-transition: all 0.3s ease-in-out 0s;
            -ms-transition: all 0.3s ease-in-out 0s;
            -o-transition: all 0.3s ease-in-out 0s;
            -webkit-transition: all 0.3s ease-in-out 0s;

        }

        #generic_price_table .generic_content .generic_feature_list ul li .fa {
            padding: 0 10px;
        }

        #generic_price_table .generic_content .generic_price_btn {
            margin: 20px 0 20px;
        }

        #generic_price_table .generic_content .generic_price_btn a {
            border-radius: 50px;
            -moz-border-radius: 50px;
            -ms-border-radius: 50px;
            -o-border-radius: 50px;
            -webkit-border-radius: 50px;
            display: inline-block;
            font-family: "Lato", sans-serif;
            font-size: 18px;
            outline: medium none;
            padding: 12px 30px;
            text-decoration: none;
            text-transform: uppercase;
        }

        #generic_price_table .generic_content,
        #generic_price_table .generic_content:hover,
        #generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg,
        #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head_bg,
        #generic_price_table .generic_content .generic_head_price .generic_head_content .head h2,
        #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head h2,
        #generic_price_table .generic_content .price,
        #generic_price_table .generic_content:hover .price,
        #generic_price_table .generic_content .generic_price_btn a,
        #generic_price_table .generic_content:hover .generic_price_btn a {
            transition: all 0.3s ease-in-out 0s;
            -moz-transition: all 0.3s ease-in-out 0s;
            -ms-transition: all 0.3s ease-in-out 0s;
            -o-transition: all 0.3s ease-in-out 0s;
            -webkit-transition: all 0.3s ease-in-out 0s;
        }

        @media (max-width: 320px) {}

        @media (max-width: 767px) {
            #generic_price_table .generic_content {
                margin-bottom: 75px;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #generic_price_table .col-md-3 {
                float: left;
                width: 50%;
            }

            #generic_price_table .col-md-4 {
                float: left;
                width: 50%;
            }

            #generic_price_table .generic_content {
                margin-bottom: 75px;
            }
        }

        @media (min-width: 992px) and (max-width: 1199px) {}

        @media (min-width: 1200px) {}

        #generic_price_table_home {
            font-family: 'Raleway', sans-serif;
        }

        .text-center h1,
        .text-center h1 a {
            color: #7885CB;
            font-size: 30px;
            font-weight: 300;
            text-decoration: none;
        }

        .demo-pic {
            margin: 0 auto;
        }

        .demo-pic:hover {
            opacity: 0.7;
        }

        #generic_price_table_home ul {
            margin: 0 auto;
            padding: 0;
            list-style: none;
            display: table;
        }

        #generic_price_table_home li {
            float: left;
        }

        #generic_price_table_home li+li {
            margin-left: 10px;
            padding-bottom: 10px;
        }

        #generic_price_table_home li a {
            display: block;
            width: 50px;
            height: 50px;
            font-size: 0px;
        }

        #generic_price_table_home .blue {
            background: #3498DB;
            transition: all 0.3s ease-in-out 0s;
        }

        #generic_price_table_home .emerald {
            background: #2ECC71;
            transition: all 0.3s ease-in-out 0s;
        }

        #generic_price_table_home .grey {
            background: #7F8C8D;
            transition: all 0.3s ease-in-out 0s;
        }

        #generic_price_table_home .midnight {
            background: #34495E;
            transition: all 0.3s ease-in-out 0s;
        }

        #generic_price_table_home .orange {
            background: #E67E22;
            transition: all 0.3s ease-in-out 0s;
        }

        #generic_price_table_home .purple {
            background: #9B59B6;
            transition: all 0.3s ease-in-out 0s;
        }

        #generic_price_table_home .red {
            background: #E74C3C;
            transition: all 0.3s ease-in-out 0s;
        }

        #generic_price_table_home .turquoise {
            background: #1ABC9C;
            transition: all 0.3s ease-in-out 0s;
        }

        #generic_price_table_home .blue:hover,
        #generic_price_table_home .emerald:hover,
        #generic_price_table_home .grey:hover,
        #generic_price_table_home .midnight:hover,
        #generic_price_table_home .orange:hover,
        #generic_price_table_home .purple:hover,
        #generic_price_table_home .red:hover,
        #generic_price_table_home .turquoise:hover {
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
            border-top-left-radius: 50px;
            border-top-right-radius: 50px;
            transition: all 0.3s ease-in-out 0s;
        }

        #generic_price_table_home .divider {
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
            padding: 20px;
        }

        #generic_price_table_home .divider span {
            width: 100%;
            display: table;
            height: 2px;
            background: #ddd;
            margin: 50px auto;
            line-height: 2px;
        }

        #generic_price_table_home .itemname {
            text-align: center;
            font-size: 50px;
            padding: 50px 0 20px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 40px;
            text-decoration: none;
            font-weight: 300;
        }

        #generic_price_table_home .itemnametext {
            text-align: center;
            font-size: 20px;
            padding-top: 5px;
            text-transform: uppercase;
            display: inline-block;
        }

        #generic_price_table_home .footer {
            padding: 40px 0;
        }

        .price-heading {
            text-align: center;
        }

        .price-heading h1 {
            color: #666;
            margin: 0;
            /* padding: 0 0 50px 0; */
        }

        .demo-button {
            background-color: #333333;
            color: #ffffff;
            display: table;
            font-size: 20px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
            margin-bottom: 50px;
            outline-color: -moz-use-text-color;
            outline-style: none;
            outline-width: medium;
            padding: 10px;
            text-align: center;
            text-transform: uppercase;
        }

        .bottom_btn {
            background-color: #333333;
            color: #ffffff;
            display: table;
            font-size: 28px;
            margin: 60px auto 20px;
            padding: 10px 25px;
            text-align: center;
            text-transform: uppercase;
        }

        .demo-button:hover {
            background-color: #666;
            color: #FFF;
            text-decoration: none;

        }

        .bottom_btn:hover {
            background-color: #666;
            color: #FFF;
            text-decoration: none;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">
        <div class="header m-3 p-3">

            <h3 class="heading ">Property finding service </h3>
            <p class="heading-details">Unipuller is offering Tenant services to find out their properties. All our
                services
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
                        service will remain active until next 7 working days for premium service and 30 days for the
                        regular
                        service.
                    </p>
                </div>
            </div>


            <div id="generic_price_table">
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="price-heading clearfix">
                                    <h1 class="mt-3"> Service Cost</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container p-4">

                        <div class="row">

                            @foreach ($service_charge as $key => $item)
                                <div class="col-md-4 mt-4">

                                    <div class="generic_content clearfix">

                                        <div class="generic_head_price clearfix">

                                            <div class="generic_head_content clearfix">

                                                <div class="head_bg"></div>
                                                <div class="head">
                                                    <span>{{ $item->child_category == 1 ? $item->size . '  room' : $item->childCategory->name }}</span>
                                                </div>

                                            </div>

                                            @php
                                                $costs = $item->service_charge * 1.7;
                                                
                                                $wholeNumberPart = floor($costs);
                                                $decimalPart = fmod($costs, 1.0);
                                                
                                                if ($wholeNumberPart === 0) {
                                                    $decimalPartFormatted = rtrim(number_format($decimalPart, 1), '0');
                                                    if ($decimalPartFormatted === '.') {
                                                        $decimalPartFormatted = '0';
                                                    }
                                                } else {
                                                    $decimalPartFormatted = number_format($decimalPart, 1);
                                                }
                                            @endphp


                                            <form id="propertyFindingPaymentForm" method="GET"
                                                action="{{ route('propertyFindingPayment') }}">
                                                @csrf
                                                <button type="submit">

                                                    <div class="generic_price_tag clearfix" style="background: #f4f3f3">
                                                        <span class="price">
                                                            <span class="sign">£</span>
                                                            <span class="currency">{{ $wholeNumberPart }}</span>
                                                            @if (ltrim($decimalPartFormatted, '0') != '.0')
                                                                <span
                                                                    class="cent">{{ ltrim($decimalPartFormatted, '0') }}</span>
                                                            @endif
                                                            <span class="month">/week</span>
                                                            <span class="month">+VAT</span>
                                                            <ul>
                                                                <li style="color: rgb(109, 109, 109)"> Premium </li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </button>

                                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                <input type="hidden" name="product_name"
                                                    value="{{ $item->child_category == 1 ? $item->size . ' room' : $item->childCategory->name }}">
                                                <input type="hidden" name="bill" value="{{ $costs }}">

                                            </form>





                                            <form id="propertyFindingPaymentForm" method="GET"
                                                action="{{ route('propertyFindingPayment') }}">
                                                @csrf
                                                <button type="submit">
                                                    <div class="generic_price_tag clearfix p-3" style="background: #f4f4f4">
                                                        <span class="price">
                                                            <span class="sign">£</span>
                                                            <span class="currency">{{ $item->service_charge }}</span>
                                                            <span class="month">/month</span>
                                                            <span class="month">+VAT</span>
                                                            <ul>
                                                                <li style="color: rgb(109, 109, 109)"> Regular </li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </button>

                                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                <input type="hidden" name="product_name"
                                                    value="{{ $item->child_category == 1 ? $item->size . ' room' : $item->childCategory->name }}">
                                                <input type="hidden" name="bill" value="{{ $item->service_charge }}">

                                            </form>


                                        </div>

                                        {{-- <div class="generic_price_btn clearfix">
                                            <a class="" href="">Add</a>
                                        </div> --}}

                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div>
                </section>
            </div>



            {{-- <div class="row">
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
                                <td>{{ $item->child_category == 1 ? $item->size . '  room' : $item->childCategory->name }}
                                </td>
                                <td>£{{ $item->service_charge * 1.7 }}+VAT</td>
                                <td>£{{ $item->service_charge }}+VAT</td>
                                <td style="text-align: center;"> <a href="#" class="button-31">Add</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div> --}}


            <div class="row mt-3">
                <div class="col-md-12">
                    <h6 class="body-heading">1. Booking fee (premium):</h6>
                    <p> Premium booking guarantees 95% of the property within 7 working days. We are promised to deliver
                        the
                        property
                        within due time. Our dedicated team will work on behalf of the tenants until last minute to find
                        out
                        their property
                        from the market. To confirm the booking, customers need to pay the service charge upfront as
                        security money.
                        Once customers confirm their bookings, their service will remain active until next 7 working
                        day.
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
                        <li> • All booking fees are 100% refundable if property not been delivered within service
                            contract
                            time
                        </li>
                        <li> • Customers will get 100% money refund within 7 working days if they cancel bookings within
                            24
                            hours from
                            the booking confirmation time</li>
                        <li> • Customers will get 100% money refund within 30 days if they cancel bookings after 24
                            hours
                            from
                            the
                            booking confirmation time
                        </li>
                        <li> • 50% of the security money will be deducted as compensation to Unipuller If customer view
                            5
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
                            customers. Unipuller taking booking fee upfront as the security of the service. Unipuller do
                            not
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
