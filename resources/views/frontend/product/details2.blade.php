@extends('frontend.layouts.master_layout')
@section('title', $info->name)
@section('css')
    <style>
        .container {
            margin-top: 10px;
            margin-bottom: 10px;
        }

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
            font-size: 18px;
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

        .summery-card,
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

                        <div class="row header laptopp-view">
                            <div class="col-md-8">
                                <div class="job-title">{{ $info->name }}</div>
                                <div class="card-text company-name color-black">
                                    {{ $info->category->name }}
                                </div>
                                <div class="price"> &pound; Price+ VAT</div>
                                <div class="refund mt-1">
                                    <a href="{{ route('footer.details.policies.return_refund_policies') }}" target="__blank"
                                        style="font-size: 20px;">Refund Policy
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4 text-start">
                                <div>
                                    Size: <span class="txtbold">Size</span>
                                </div>
                                <div>
                                    Color: <span class="txtbold">Color</span>
                                </div>
                            </div>
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

                        <div class="summary-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="summery-card">
                                    <h3 class="sectitle">Summary</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                Category: <span class="txtbold">{{ $info->category->name }}</span>
                                            </div>
                                            <div>
                                                @if ($info->sub_category_id)
                                                    Sub-category: <span
                                                        class="txtbold">{{ $info->subCategory->name }}</span>
                                                @endif
                                            </div>
                                            <div>
                                                @if ($info->child_category_id)
                                                    Child-category: <span
                                                        class="txtbold">{{ $info->childCategory->name }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                Barcode type: <span class="txtbold">{{ $info->barcode_type ?? '' }}</span>
                                            </div>
                                            <div>
                                                SKU: <span class="txtbold">{{ $info->sku ?? '' }}</span>
                                            </div>
                                            <div>
                                                Unit: <span class="txtbold">{{ $info->unit->short_name ?? '' }}</span>
                                            </div>
                                            <div>
                                                Brand: <span class="txtbold">{{ $info->brand->name ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">
                                    <h3 class="sectitle">Images</h3>
                                    <div class="col-md-12 text-justify">
                                        <img class="" src="{{ $first_image }}" alt=""
                                            style="width: 33% !important;">
                                        <img class="" src="{{ $first_image }}" alt=""
                                            style="width: 33% !important;">
                                        <img class="" src="{{ $first_image }}" alt=""
                                            style="width: 33% !important;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="summary-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="summery-card">
                                    <h3 class="sectitle">Study</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                Study time: <span class="txtbold">{{ $info->study_time }}</span>
                                            </div>
                                            <div>
                                                Start-years: <span class="txtbold">{{ $info->selected_years ?? '' }}</span>
                                            </div>
                                            <div>
                                                Start-Months: <span
                                                    class="txtbold">{{ $info->selected_months ?? '' }}</span>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                Name of institution: <span
                                                    class="txtbold">{{ $info->name_of_institution ?? '' }}</span>
                                            </div>
                                            <div>
                                                Duration: <span class="txtbold">{{ $info->duration_year ?? '' }}
                                                    {{ $info->duration_month ?? '' }}</span>
                                            </div>
                                            <div>
                                                Tution fees for home students: <span
                                                    class="txtbold">{{ $info->home_students_fees ?? '' }}</span>
                                            </div>
                                            <div>
                                                Tution fees for international students: <span
                                                    class="txtbold">{{ $info->int_students_fees ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">

                                    <h3 class="sectitle">Instalments</h3>
                                    <div class="col-md-12 text-justify">
                                        {!! $info->fee_installment_description ?? '' !!}
                                    </div>

                                    <h3 class="sectitle">Requirements</h3>
                                    <div class="col-md-12 text-justify">
                                        {{ $info->requirements ?? '' }}
                                    </div>
                                    <div class="col-md-12 text-justify">
                                        {!! $info->requirement_details ?? '' !!}
                                    </div>

                                    <h3 class="sectitle">Features</h3>
                                    <div class="col-md-12 text-justify">
                                        {!! $info->service_features ?? '' !!}
                                    </div>

                                    <h3 class="sectitle">Facilities</h3>
                                    <div class="col-md-12 text-justify">
                                        {!! $info->general_facilities ?? '' !!}
                                    </div>

                                    <h3 class="sectitle">Details</h3>
                                    <div class="col-md-12 text-justify">
                                        {!! $info->product_description ?? '' !!}
                                    </div>

                                    @if ($info->work_placement == 'Available')
                                        <h3 class="sectitle">Work Placement</h3>
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
                                                {{ $info->business ? $info->business->name : '' }}</div>
                                        </div>

                                        <div class="col-md-3 text-end">
                                            @php
                                                $imageUrl = $info->business && File::exists($info->business->logo) ? asset($info->business->logo) : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                            @endphp
                                            <a
                                                href="{{ $info->business ? route('shop.service', $info->business->id) : '#' }}">
                                                <div>
                                                    <img class="" src="{{ $imageUrl }}" alt=""
                                                        style="width: 35% !important;">
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <h3 class="sectitle">Experiences</h3>
                                    <div class="col-md-12 text-justify">
                                        {!! $info->experiences ?? '' !!}
                                    </div>

                                    <h3 class="sectitle">Specializations</h3>
                                    <div class="col-md-12 text-justify">
                                        {!! $info->specializations ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="report-section row mt-3">
                            <div class="col-sm-12">
                                <div class="report-card">
                                    <h3 class="reptitle">
                                        Report About This Service & Company
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
