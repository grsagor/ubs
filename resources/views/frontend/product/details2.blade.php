@extends('frontend.layouts.master_layout')
@section('title', $info->name)
@section('css')
    <style>
        /* .container {
                                                                margin-top: 10px;
                                                                margin-bottom: 10px;
                                                            } */

        .color-black {
            color: black !important;
        }

        .text-justify {
            text-align: justify;
        }

        .btn {
            line-height: 33px !important;
            padding: 0 20px !important;
        }

        .card-design {
            background-color: #fdfdfd;
            color: #212529;
            /* Dark text color */
        }

        .job-title {
            color: #333;
            font-size: 20px;
            font-weight: 600;
        }

        .deadline-heading {
            color: #333;
            font-size: 14px;
            font-weight: 400;
        }

        .deadline-date {
            color: #B32D7D;
            font-size: 14px;
            font-weight: 600;
        }

        .apply-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .deadline-heading {
            flex: 1;
        }

        .applynow {
            border-radius: 4px;
            background: #008020;
            color: #FFF;
            font-weight: 500;
        }

        .alreadyApplied {
            border-radius: 4px;
            background: #c9030f;
            color: #FFF;
            font-weight: 500;
        }

        .btn-no {
            border-radius: 4px;
            background: #c9030f;
            color: #FFF;
            font-weight: 500;
        }

        .summary-card,
        .company-info-card {
            border-radius: 4px;
            border: 0.5px solid #DDD;
            background: #F4F4F4;
            display: flex;
            flex-direction: column;
            padding: 15px 8px;
        }

        .requirements-card {
            border-radius: 4px;
            border: 0.5px solid #bababa;
            background: #fcfcfc;
            display: flex;
            flex-direction: column;
            padding: 15px 8px;
        }

        .sectitle {
            color: #B32D7D;
            font-size: 16px !important;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .mt-10 {
            margin-top: 10px !important;
        }

        .txtbold {
            font-weight: 600;
        }

        .subheading {
            color: #333;
            font-size: 14px;
            font-weight: 600;
        }

        .reptitle {
            color: #B83835;
            font-size: 18px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .report-card {
            border-radius: 4px;
            border: 0.5px solid #FDB5B3;
            background: #FFEFEF;
            padding: 10px;
        }

        .report-button {
            background-color: #e43200e2;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .policy-button {
            background-color: #515151e2;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .complain-info-item {
            display: flex;
            align-items: center;
        }

        .complain-info-item i {
            margin-right: 5px;
        }

        .mobile-view {
            display: none;
        }


        @media (max-width: 767px) {
            .reptitle {
                font-size: 15px !important;
            }

            .mobile-view {
                display: block;
            }

            .laptopp-view {
                display: none;
            }
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">

        <div class="row">
            <div class="col-md-12 mt-2 p-2">

                <div class="card custom-card card-design">
                    <div class="card-body">

                        {{-- <div class="row header laptopp-view"> --}}
                        <div class="row header">
                            <div class="col-md-8">
                                <div class="job-title">{{ $info->name }}</div>
                                <div class="card-text company-name color-black">
                                    {{ $info->category->name }}
                                    {{ $info->subCategory->name ?? '' }}
                                    @if ($info->brand)
                                        , {{ $info->brand->name }}
                                    @endif
                                </div>

                                @php
                                    // For service
                                    $service_price = null;
                                    foreach ($info->variations as $key => $value) {
                                        $service_price = $value->sell_price_inc_tax;
                                        break; // break out of the loop after saving the first value
                                    }
                                @endphp

                                <div class="price mt-2 mb-2"> &pound; {{ number_format($service_price, 2) }}</div>
                                <div class="refund">
                                    <a href="{{ route('footer.details.policies.return_refund_policies') }}" target="__blank"
                                        style="font-size: 18px;">Refund Policy
                                    </a>
                                </div>
                            </div>

                            {{-- For product --}}
                            {{-- <div class="col-md-4 text-start">
                                <div>
                                    Size: <span class="txtbold">Size</span>
                                </div>
                                <div>
                                    Color: <span class="txtbold">Color</span>
                                </div>
                            </div> --}}
                        </div>

                        <div class="apply-section mt-1">

                            <div class="apply-button">

                                <div style="margin-top: 10px;">
                                    {{-- <button type="button" class="btn alreadyApplied" disabled>Already applied</button> --}}

                                    <form action="#" method="POST" class="mx-auto mobileView"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn applynow">Order Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @if (
                            $info->sku ||
                                $info->study_time ||
                                $info->selected_years ||
                                $info->selected_months ||
                                $info->name_of_institution ||
                                $info->duration_year ||
                                $info->home_students_fees ||
                                $info->int_students_fees)

                            <div class="summary-section row mt-3">
                                <div class="col-sm-12 ">
                                    <div class="summary-card">
                                        <h3 class="sectitle">Summary</h3>
                                        <div class="row">
                                            @if ($info->sku)
                                                <div class="col-md-6">
                                                    SKU: <span class="txtbold">{{ $info->sku ?? '' }}</span>
                                                </div>
                                            @endif

                                            @if ($info->study_time)
                                                <div class="col-md-6">
                                                    Study time: <span class="txtbold">{{ $info->study_time }}</span>
                                                </div>
                                            @endif


                                            @php
                                                $selected_years = json_decode($info->selected_years);
                                                $start_year = !empty($selected_years) ? $selected_years[0] : '';
                                            @endphp

                                            @if (!empty($start_year))
                                                <div class="col-md-6">
                                                    Start-year: <span class="txtbold">{{ $start_year }}</span>
                                                </div>
                                            @endif

                                            @php
                                                $selected_months = json_decode($info->selected_months);
                                                $start_month = !empty($selected_months) ? $selected_months[0] : '';
                                            @endphp

                                            @if (!empty($start_month))
                                                <div class="col-md-6">
                                                    Start-Month: <span class="txtbold">{{ $start_month }}</span>
                                                </div>
                                            @endif


                                            @if ($info->name_of_institution)
                                                <div class="col-md-6">
                                                    Name of institution: <span
                                                        class="txtbold">{{ $info->name_of_institution ?? '' }}</span>
                                                </div>
                                            @endif

                                            @if ($info->duration_year)
                                                @php
                                                    $d_year = $info->duration_year;
                                                    if ($d_year == 1) {
                                                        $d_year = $d_year . ' Year';
                                                    } else {
                                                        $d_year = $d_year . ' Years';
                                                    }

                                                    $d_month = $info->duration_month;
                                                    if ($d_month == 1) {
                                                        $d_month = $d_month . ' Month';
                                                    } else {
                                                        $d_month = $d_month . ' Months';
                                                    }
                                                @endphp
                                                <div class="col-md-6">
                                                    Duration: <span class="txtbold">{{ $d_year ?? '' }}
                                                        {{ $d_month ?? '' }}</span>
                                                </div>
                                            @endif

                                            @if ($info->home_students_fees)
                                                <div class="col-md-6">
                                                    Tution fees for home students: <span
                                                        class="txtbold">{{ $info->home_students_fees ?? '' }}</span>
                                                </div>
                                            @endif

                                            @if ($info->int_students_fees)
                                                <div class="col-md-6">
                                                    Tution fees for international students: <span
                                                        class="txtbold">{{ $info->int_students_fees ?? '' }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($info->image)
                            <div class="requirements-section row mt-3">
                                <div class="col-sm-12 ">
                                    <div class="requirements-card">
                                        <h3 class="sectitle">Images</h3>
                                        <div class="col-md-12 text-justify">
                                            {{-- {{ dd($info->image) }} --}}
                                            @foreach (json_decode($info->image ?? '[]') as $item)
                                                <img class="" src="{{ asset($item) }}" alt=""
                                                    style="width: 33% !important;">
                                            @endforeach


                                            {{-- <img class="" src="{{ $info->image }}" alt=""
                                            style="width: 33% !important;">
                                        <img class="" src="{{ $first_image }}" alt=""
                                            style="width: 33% !important;">
                                        <img class="" src="{{ $first_image }}" alt=""
                                            style="width: 33% !important;"> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">
                                    <h3 class="sectitle">Details</h3>
                                    @if ($info->fee_installment_description)
                                        <h3 class="sectitle mt-10 color-black">Instalments</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->fee_installment_description ?? '' !!}
                                        </div>
                                    @endif

                                    @if ($info->requirements)
                                        <h3 class="sectitle mt-10 color-black">Requirements</h3>
                                        <div class="col-md-12 text-justify">
                                            {{ $info->requirements ?? '' }}
                                        </div>
                                        <div class="col-md-12 text-justify mt-2 ">
                                            {!! $info->requirement_details ?? '' !!}
                                        </div>
                                    @endif

                                    @if ($info->service_features)
                                        <h3 class="sectitle mt-10 color-black">Features</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->service_features ?? '' !!}
                                        </div>
                                    @endif

                                    @if ($info->general_facilities)
                                        <h3 class="sectitle mt-10 color-black">Facilities</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->general_facilities ?? '' !!}
                                        </div>
                                    @endif

                                    @if ($info->product_description)
                                        <h3 class="sectitle mt-10 color-black">More Info</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->product_description ?? '' !!}
                                        </div>
                                    @endif

                                    @if ($info->work_placement == 'Available')
                                        <h3 class="sectitle mt-10 color-black">Work Placement</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->work_placement_description ?? '' !!}
                                        </div>
                                    @endif

                                    <h3 class="policy">
                                        <a href="#" target="__blank" class="policy-button" style="float: right;">
                                            Policy
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>


                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">
                                    <h3 class="sectitle">About Provider</h3>

                                    <div class="row header laptopp-view">
                                        <div class="col-md-9">
                                            <div class="card-text company-name color-black">
                                                {{ $info->business_location ? $info->business_location->name : '' }}</div>
                                        </div>

                                        <div class="col-md-3 text-end">
                                            @php
                                                $imageUrl =
                                                    $user_info &&
                                                    $user_info->file_name &&
                                                    File::exists(public_path("uploads/media/{$user_info->file_name}"))
                                                        ? asset("uploads/media/{$user_info->file_name}")
                                                        : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                            @endphp
                                            <a
                                                href="{{ $info->business_location ? route('shop.service', $info->business_location->id) : '#' }}">
                                                <div>
                                                    <img class="" src="{{ $imageUrl }}" alt=""
                                                        style="width: 35% !important;">
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    @if ($info->experiences)
                                        <h3 class="sectitle color-black ">Experiences</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->experiences ?? '' !!}
                                        </div>
                                    @endif

                                    @if ($info->specializations)
                                        <h3 class="sectitle color-black mt-3">Specializations</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->specializations ?? '' !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="report-section row mt-3">
                            <div class="col-sm-12">
                                <div class="report-card">
                                    <h3 class="reptitle">
                                        Report this
                                        <button class="report-button"><i class="fas fa-flag"></i> Report</button>
                                    </h3>
                                    <div class="col-md-12 text-justify">
                                        <p>Your satisfaction is our priority. If you notice any service discrepancies or
                                            policy violations, please inform
                                            us immediately. We'll take swift action to address them. While Unipuler isn't
                                            directly responsible for any
                                            issue regarding this service, we're committed to upholding our standards. Note
                                            that Unipuler acts solely
                                            as a facilitator and is not liable for the quality or delivery of services
                                            provided by our partners. However,
                                            we hold our partners accountable to ensure your satisfaction.
                                        </p>
                                    </div>

                                    <div class="complain-information">
                                        <div class="complain-info-item">
                                            <i class="fas fa-info-circle"></i>
                                            <div>
                                                +44 (0) 7460497454
                                            </div>
                                        </div>
                                        <div class="complain-info-item">
                                            <i class="fas fa-envelope"></i>
                                            <div>
                                                complain@unipuler.com
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
