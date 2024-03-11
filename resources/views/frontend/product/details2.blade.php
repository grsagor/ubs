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
                            <div class="col-md-9">
                                <div class="job-title">{{ $info->name }}</div>
                                <div class="card-text company-name color-black">
                                    {{ $info->business_location ? $info->business_location->name : '' }}</div>
                                <div class="card-text company-name color-black">
                                    {{ $info->business_location->landmark }}, {{ $info->business_location->city }},
                                    {{ $info->business_location->zip_code }},
                                    {{ $info->business_location->country }}
                                </div>

                            </div>

                            <div class="col-md-3 text-end">
                                @php
                                    $imageUrl = $info->business_location && File::exists($info->business_location->logo) ? asset($info->business_location->logo) : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
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

                        {{-- <div class="row header mobile-view">
                            <div class="col-md-12 text-center">

                                @php
                                    $businessLocation = $job->businessLocation;
                                    $imageUrl = $businessLocation && File::exists($businessLocation->logo) ? asset($businessLocation->logo) : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                @endphp

                                <a href="{{ $businessLocation ? route('shop.service', $businessLocation->id) : '#' }}">
                                    <div>
                                        <img class="" src="{{ $imageUrl }}" style="width: 30% !important;">
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="job-title">{{ $job->company_name }}</div>
                                <p class="card-text company-name color-black">{{ $job->title }}</p>
                            </div>
                        </div> --}}

                        <div class="apply-section mt-3">

                            <div class="apply-button">

                                <div class="d-flex gap-1" style="margin-top: 10px;">
                                    {{-- <button type="button" class="btn alreadyApplied" disabled>Already applied</button> --}}

                                    <form action="#" method="POST" class="mx-auto mobileView"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn applynow">Order Now</button>
                                    </form>
                                    <button type="button" data-product_id="{{ $info->id }}" data-is_add="1" class="btn applynow cart_btn">Add to cart</button>
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
                                                Unit: <span class="txtbold">{{ $info->unit->name ?? '' }}</span>
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
                                        <img class="" src="{{ $imageUrl }}" alt=""
                                            style="width: 33% !important;">
                                        <img class="" src="{{ $imageUrl }}" alt=""
                                            style="width: 33% !important;">
                                        <img class="" src="{{ $imageUrl }}" alt=""
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

                        @if ($info->tuition_fee_installment == 'Available')
                            <div class="requirements-section row mt-3">
                                <div class="col-sm-12 ">
                                    <div class="requirements-card">
                                        <h3 class="sectitle">Tution fee installment details</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->fee_installment_description ?? '' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">
                                    <h3 class="sectitle">Work placement details</h3>
                                    @if ($info->work_placement == 'Available')
                                        <div class="col-md-12 text-justify">
                                            {!! $info->work_placement_description ?? '' !!}
                                        </div>
                                    @endif
                                    <div class="col-md-12 text-justify">
                                        {!! $info->general_facilities ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">
                                    <h3 class="sectitle">Requirements</h3>
                                    <div class="col-md-12 text-justify">
                                        {{ $info->requirements ?? '' }}
                                    </div>
                                    <div class="col-md-12 text-justify">
                                        {!! $info->requirement_details ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">
                                    <h3 class="sectitle">Service Feature</h3>
                                    <div class="col-md-12 text-justify">
                                        {!! $info->service_features ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">
                                    <h3 class="sectitle">Experiences</h3>
                                    <div class="col-md-12 text-justify">
                                        {!! $info->experiences ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">
                                    <h3 class="sectitle">Specializations</h3>
                                    <div class="col-md-12 text-justify">
                                        {!! $info->specializations ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">
                                    <h3 class="sectitle">Policy</h3>
                                    <div class="col-md-12 text-justify">
                                        {!! $info->policy ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="company-info-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="company-info-card">
                                    <h3 class="sectitle">Company Information</h3>
                                    <div class="col-md-12">
                                        <p>{{ $job->company_name }}</p>

                                        <h5 class="subheading mb-0">Business:</h5>
                                        <div class="text-justify">
                                            {!! $job->company_information ?? '' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="report-section row mt-3">
                            <div class="col-sm-12">
                                <div class="report-card">
                                    <h3 class="reptitle">
                                        Report this Job / Company
                                        <button class="report-button"><i class="fas fa-flag"></i> Report</button>
                                    </h3>
                                    <div class="col-md-12 text-justify">
                                        <p>If the advertiser requests any payment from you for this job or provides
                                            incorrect or misleading information, please notify us immediately or report the
                                            job. Unipuller does not endorse or support any payment to individuals or
                                            organizations for job opportunities. Unipuller will not be held responsible for
                                            any financial transactions.
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
                                                complain@unipuller.com
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
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.cart_btn', function() {
                let product_id = $(this).data('product_id');
                let is_add = $(this).data('is_add');
                let data = { product_id: product_id, is_add: is_add };
                $.ajax({
                    url: "{{ route('post.cart') }}",
                    method: "POST",
                    data: data,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                        }
                    }
                })
            })
        })
    </script>
@endsection