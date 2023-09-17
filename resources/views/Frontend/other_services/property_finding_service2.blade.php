@extends('frontend.layouts.master_layout')
@section('css')
    <style>
        .pricing {
            margin: 40px 0px;
        }

        .pricing .table {
            border-top: 1px solid #ddd;
            background: #fff;
            width: 75%;
        }

        .pricing .table th,
        .pricing .table {
            text-align: center;
        }

        .pricing .table th,
        .pricing .table td {
            padding: 5px 2px;
            border: 1px solid #ddd;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .pricing .table th {
            width: 25%;
            font-size: 30px;
            font-weight: 400;
            border-bottom: 0;
            background: #2F313A;
            color: #EBEDF3;
            text-transform: uppercase;
        }



        .pricing .table tr:nth-child(odd) {
            background: #f0f8ff;
        }

        .pricing .table td:first-child {
            padding-left: 20px;
            text-align: left;
            /* padding-top: 35px; */
            background: #234889;
        }

        .pricing tr td .ptable-title {
            font-size: 17px;
            font-weight: 400;
            color: #fff;
        }

        .pricing tr td .ptable-title i {
            width: 23px;
            line-height: 25px;
            text-align: right;
            margin-right: 5px;
        }

        .pricing .ptable-star {
            position: relative;
            display: block;
            text-align: center;
        }

        .pricing .ptable-star.red {
            color: #e91e63;
        }

        .pricing .ptable-star.green {
            color: #4caf50;
        }

        .pricing .ptable-star.lblue {
            color: #03a9f4;
        }

        .pricing .ptable-star i {
            width: 8px;
            font-size: 13px;
        }

        .pricing .ptable-price {
            display: block;
        }

        .pricing tr td {
            font-size: 16px;
            line-height: 32px;
            text-transform: uppercase;
        }

        .pricing tr td.bg-red {
            background: #e91e63;
        }

        .pricing tr td.bg-green {
            background: #4caf50;
        }

        .pricing tr td.bg-lblue {
            background: #234889;
        }

        .pricing tr td.bg-red a,
        .pricing tr td.bg-green a,
        .pricing tr td.bg-lblue a {
            color: #fff;
        }

        .pricing tr td i {
            /* display: block;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            margin-bottom: 12px; */
            font-size: 20px;
        }

        .pricing tr td i.red {
            color: #e91e63;
        }

        .pricing tr td i.green {
            color: #4caf50;
        }

        .pricing tr td i.lblue {
            color: #03a9f4;
        }

        .pricing tr td i.white {
            color: #b9babc;
        }

        .pricing tr td:first-child i {
            display: inline;
            margin-bottom: 0px;
            font-size: 16px;
        }



        /* custom.css */

        /* Style for the navigation tabs */
        .nav-tabs.custom-tabs .nav-link {
            background-color: #00a0e8;
            color: #fff;
            border: none;
            border-radius: 0.25rem;
            padding: 10px 20px;
            margin-right: 10px;
            transition: background-color 0.3s;
        }

        .nav-tabs.custom-tabs .nav-link:hover {
            background-color: #0077b6;
        }

        /* Style for the active tab */
        .nav-tabs.custom-tabs .nav-item.show .nav-link,
        .nav-tabs.custom-tabs .nav-link.active {
            background-color: #0077b6;
            color: #fff;
        }

        /* Style for the tab content */
        .tab-content.custom-tab-content {
            padding: 20px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">

        <div class="header m-3 p-3">

            <div class="property_finding_service">
                <h3 class="heading ">Property finding service </h3>
                <p class="heading-details">Unipuller is offering Tenant services to find out their properties. All our
                    services
                    are premium and promised to
                    deliver the service within due time. The service information and service confirmation process are given
                    below with
                    details. This detailed information will be used as the tenant service policy.
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
                <p> All our letting services are coming with a valid contract time. Once a customer confirms their
                    booking with us, their
                    service will remain active until next 7 working days for premium service and 30 days for the
                    regular
                    service.
                </p>
            </div>



            <div class="category_tab">
                <ul class="nav nav-tabs custom-tabs" id="myTabs">
                    @foreach ($child_categories as $key => $item)
                        <li class="nav-item">
                            <a class="nav-link {{ $key === 0 ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#tab{{ $key + 1 }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
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
                
                // dd($studio_flat_service_charge, $flat_service_charge, $house_service_charge);
                
            @endphp


            <div class="tab-content custom-tab-content">
                <div class="tab-pane fade show active" id="tab1">
                    <!-- Content for tab 1 goes here -->
                    <div id="generic_price_table">

                        <!-- Pricing # -->
                        <div class="pricing">
                            <div class="container">
                                <div class="pricing-table table-responsive" style="text-align: -webkit-center">
                                    <table class="table">
                                        <!-- Heading -->
                                        <thead>
                                            <th>Studio Flat </th>
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
                                                <span class="ptable-price">£{{ $studio_flat_service_charge }}</span>
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
                                                <span class="ptable-price">£{{ $studio_flat_service_charge * 1.7 }}</span>
                                            </th>

                                        </thead>

                                        <tbody>

                                            @php
                                                $valueee = '
                                                <td>
                                                    Open Market
                                                    <abbr style="text-decoration: none"
                                                        title="Anyone who has property can be your provider">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td>
                                                    Open Market + Agent
                                                    <abbr style="text-decoration: none"
                                                        title="In addition to the open market our partner agents will be working for you to find out the property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>';
                                            @endphp

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">
                                                        Provider
                                                    </span>
                                                    <abbr style="text-decoration: none"
                                                        title="The responsible body who will be working for you to find out your property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>

                                                {!! $valueee !!}
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Market </span>
                                                    <abbr style="text-decoration: none"
                                                        title="From where your property will be searching">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>

                                                {!! $valueee !!}

                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Viewing By </span>
                                                    <abbr style="text-decoration: none"
                                                        title="The responsible person who will arrage viewing for you">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>

                                                {!! $valueee !!}

                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Dedicated </span>
                                                    <abbr style="text-decoration: none"
                                                        title="One of the officers will be dedicated to collaborate with you and agents to get property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> <i class="fa fa-times red"></i> </td>
                                                <td> <i class="fa fa-check green"></i> </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Call service </span>
                                                    <abbr style="text-decoration: none"
                                                        title="You can contact us for any information regarding the property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> Office hour </td>
                                                <td> 24/7 </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Cancel </span>
                                                    <abbr style="text-decoration: none" title="Right to cancel the service">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> Anytime </td>
                                                <td> Anytime </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Refund </span>
                                                    <abbr style="text-decoration: none"
                                                        title="Eligibilty for the return if you cancle this service">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> 100% </td>
                                                <td> 100% </td>
                                            </tr>

                                            <!-- Buttons -->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <form action="">
                                                    <td class="bg-green"><a class="btn" href="#">Pay</a></td>
                                                </form>
                                                <form action="">
                                                    <td class="bg-lblue"><a class="btn" href="#">Pay</a></td>
                                                </form>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="tab-pane fade" id="tab2">
                    <!-- Content for tab 2 goes here -->
                    <div id="generic_price_table">

                        <!-- Pricing # -->
                        <div class="pricing">
                            <div class="container">
                                <div class="pricing-table table-responsive" style="text-align: -webkit-center">
                                    <table class="table">
                                        <!-- Heading -->
                                        <thead>
                                            <th>Flat </th>
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
                                                <span class="ptable-price">£{{ $flat_service_charge }}</span>
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
                                                <span class="ptable-price">£{{ $flat_service_charge * 1.7 }}</span>
                                            </th>

                                        </thead>

                                        <tbody>

                                            @php
                                                $valueee = '
                                                <td>
                                                    Open Market
                                                    <abbr style="text-decoration: none"
                                                        title="Anyone who has property can be your provider">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td>
                                                    Open Market + Agent
                                                    <abbr style="text-decoration: none"
                                                        title="In addition to the open market our partner agents will be working for you to find out the property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>';
                                            @endphp

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">
                                                        Provider
                                                    </span>
                                                    <abbr style="text-decoration: none"
                                                        title="The responsible body who will be working for you to find out your property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>

                                                {!! $valueee !!}
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Market </span>
                                                    <abbr style="text-decoration: none"
                                                        title="From where your property will be searching">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>

                                                {!! $valueee !!}

                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Viewing By </span>
                                                    <abbr style="text-decoration: none"
                                                        title="The responsible person who will arrage viewing for you">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>

                                                {!! $valueee !!}

                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Dedicated </span>
                                                    <abbr style="text-decoration: none"
                                                        title="One of the officers will be dedicated to collaborate with you and agents to get property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> <i class="fa fa-times red"></i> </td>
                                                <td> <i class="fa fa-check green"></i> </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Call service </span>
                                                    <abbr style="text-decoration: none"
                                                        title="You can contact us for any information regarding the property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> Office hour </td>
                                                <td> 24/7 </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Cancel </span>
                                                    <abbr style="text-decoration: none"
                                                        title="Right to cancel the service">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> Anytime </td>
                                                <td> Anytime </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Refund </span>
                                                    <abbr style="text-decoration: none"
                                                        title="Eligibilty for the return if you cancle this service">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> 100% </td>
                                                <td> 100% </td>
                                            </tr>

                                            <!-- Buttons -->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <form action="">
                                                    <td class="bg-green"><a class="btn" href="#">Pay</a></td>
                                                </form>
                                                <form action="">
                                                    <td class="bg-lblue"><a class="btn" href="#">Pay</a></td>
                                                </form>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <div class="tab-pane fade" id="tab3">
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

                                            @php
                                                $valueee = '
                                                <td>
                                                    Open Market
                                                    <abbr style="text-decoration: none"
                                                        title="Anyone who has property can be your provider">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td>
                                                    Open Market + Agent
                                                    <abbr style="text-decoration: none"
                                                        title="In addition to the open market our partner agents will be working for you to find out the property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>';
                                            @endphp

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">
                                                        Provider
                                                    </span>
                                                    <abbr style="text-decoration: none"
                                                        title="The responsible body who will be working for you to find out your property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>

                                                {!! $valueee !!}
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Market </span>
                                                    <abbr style="text-decoration: none"
                                                        title="From where your property will be searching">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>

                                                {!! $valueee !!}

                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Viewing By </span>
                                                    <abbr style="text-decoration: none"
                                                        title="The responsible person who will arrage viewing for you">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>

                                                {!! $valueee !!}

                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Dedicated </span>
                                                    <abbr style="text-decoration: none"
                                                        title="One of the officers will be dedicated to collaborate with you and agents to get property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> <i class="fa fa-times red"></i> </td>
                                                <td> <i class="fa fa-check green"></i> </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Call service </span>
                                                    <abbr style="text-decoration: none"
                                                        title="You can contact us for any information regarding the property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> Office hour </td>
                                                <td> 24/7 </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Cancel </span>
                                                    <abbr style="text-decoration: none"
                                                        title="Right to cancel the service">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> Anytime </td>
                                                <td> Anytime </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Refund </span>
                                                    <abbr style="text-decoration: none"
                                                        title="Eligibilty for the return if you cancle this service">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> 100% </td>
                                                <td> 100% </td>
                                            </tr>

                                            <!-- Buttons -->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <form action="">
                                                    <td class="bg-green"><a class="btn" href="#">Pay</a></td>
                                                </form>
                                                <form action="">
                                                    <td class="bg-lblue"><a class="btn" href="#">Pay</a></td>
                                                </form>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <div class="tab-pane fade" id="tab4">
                    <!-- Content for tab 2 goes here -->
                    <div id="generic_price_table">

                        <!-- Pricing # -->
                        <div class="pricing">
                            <div class="container">
                                <div class="pricing-table table-responsive" style="text-align: -webkit-center">
                                    <table class="table">
                                        <!-- Heading -->
                                        <thead>
                                            <th>House </th>
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
                                                <span class="ptable-price">£{{ $house_service_charge }}</span>
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
                                                <span class="ptable-price">£{{ $house_service_charge * 1.7 }}</span>
                                            </th>

                                        </thead>

                                        <tbody>

                                            @php
                                                $valueee = '
                                                <td>
                                                    Open Market
                                                    <abbr style="text-decoration: none"
                                                        title="Anyone who has property can be your provider">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td>
                                                    Open Market + Agent
                                                    <abbr style="text-decoration: none"
                                                        title="In addition to the open market our partner agents will be working for you to find out the property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>';
                                            @endphp

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">
                                                        Provider
                                                    </span>
                                                    <abbr style="text-decoration: none"
                                                        title="The responsible body who will be working for you to find out your property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>

                                                {!! $valueee !!}
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Market </span>
                                                    <abbr style="text-decoration: none"
                                                        title="From where your property will be searching">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>

                                                {!! $valueee !!}

                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Viewing By </span>
                                                    <abbr style="text-decoration: none"
                                                        title="The responsible person who will arrage viewing for you">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>

                                                {!! $valueee !!}

                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Dedicated </span>
                                                    <abbr style="text-decoration: none"
                                                        title="One of the officers will be dedicated to collaborate with you and agents to get property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> <i class="fa fa-times red"></i> </td>
                                                <td> <i class="fa fa-check green"></i> </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Call service </span>
                                                    <abbr style="text-decoration: none"
                                                        title="You can contact us for any information regarding the property">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> Office hour </td>
                                                <td> 24/7 </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Cancel </span>
                                                    <abbr style="text-decoration: none"
                                                        title="Right to cancel the service">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> Anytime </td>
                                                <td> Anytime </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="ptable-title">Refund </span>
                                                    <abbr style="text-decoration: none"
                                                        title="Eligibilty for the return if you cancle this service">
                                                        <i class="fa fa-info-circle white" aria-hidden="true">
                                                        </i>
                                                    </abbr>
                                                </td>
                                                <td> 100% </td>
                                                <td> 100% </td>
                                            </tr>

                                            <!-- Buttons -->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <form action="">
                                                    <td class="bg-green"><a class="btn" href="#">Pay</a></td>
                                                </form>
                                                <form action="">
                                                    <td class="bg-lblue"><a class="btn" href="#">Pay</a></td>
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


            <div class="refund mt-3">
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

            <div class="note mt-3">
                <p class="body-heading">
                    <b>N: B: Unipuller provides property finding services for the tenants only after
                        getting booking confirmation from the customers. Unipuller taking booking fee upfront as the
                        security of the service. Unipuller do
                        not own any properties to rent. Unipuller only works on behalf of the tenants to find out their
                        required properties
                        from the market. As the market has uncertainty of getting property and Unipuller does not own any
                        properties, so Unipuller does not guarantees of property 100%. Unipuller only works on behalf of the
                        tenants to
                        find their property and if fail find out, customers will get their security money refund without any
                        grounds.
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
        const $regularPrice = $('#regular_price_room_tab3');
        const $premiumPrice = $('#premium_price_room_tab3');
        const $tableRoom = $('#table_room_tab3').hide();

        $('#regular_price_room_tab3, #premium_price_room_tab3').hide();

        $('#child_category_id_room_tab3').on('change', function(e) {
            e.preventDefault();

            $regularPrice.hide();
            $premiumPrice.hide();
            $tableRoom.hide();

            let id = $(this).val();

            if (id != 0) {
                $.ajax({
                    url: '/property-finding-sevice-charge/' + id,
                    type: 'get',
                    success: (result) => {
                        if (result.service_charge) {
                            const serviceCharge = result.service_charge.service_charge.toFixed(2);
                            $regularPrice.text(`£${serviceCharge}`).show();

                            const premiumServiceCharge = (serviceCharge * 1.7).toFixed(2);
                            $premiumPrice.text(`£${premiumServiceCharge}`).show();

                            $tableRoom.show();
                        }
                    }
                });
            }
        });
    </script>
@endsection
