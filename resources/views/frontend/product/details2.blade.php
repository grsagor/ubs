@extends('frontend.layouts.master_layout')
@section('title', $info->name)
@section('css')
    <style>
        .accordion-button {
            text-align: center;
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

        .mt-15 {
            margin-top: 15px;
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

        .image_show {
            width: 49%;
            display: inline-block;
            vertical-align: top;
            box-sizing: border-box;
        }

        .image_show img {
            width: 100% !important;
            height: auto;
        }

        .description ul li {
            list-style: disc inside;

        }

        #imageSlider .carousel-item img {
            max-width: 350px;
            max-height: 300px;
            width: auto;
            height: auto;
            margin: auto;
        }

        /* .carousel-control-next,
                                            .carousel-control-prev {
                                                filter: invert(100%);
                                            } */

        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath d='M5.25 0l-4 4 4 4 1.5-1.5L4.25 4l2.5-2.5L5.25 0z'/%3e%3c/svg%3e");
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath d='M2.75 0l-1.5 1.5L3.75 4l-2.5 2.5L2.75 8l4-4-4-4z'/%3e%3c/svg%3e");
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

            .mt-15 {
                margin-top: 10px !important;
            }

            .image_show {
                margin-top: 20px !important;
                width: 75%;
                /* Set width to 75% on mobile */
                display: block;
                /* Change to block display for stacking on mobile */
                margin: 0 auto;
                /* Center the element */
                text-align: center;
                /* Center the content inside the div */
            }

            .mobile_view_image_left {
                text-align: center !important;
            }

            .mobile_image {
                margin: 10px 0px 10px 0px !important;
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

                            <div class="col-md-12">
                                <div class="job-title">{{ $info->name }}</div>
                            </div>
                            <div class="col-md-8">

                                @php
                                    $result = '';

                                    if ($info->category && $info->category->name) {
                                        $result = $info->category->name;
                                    }

                                    if ($info->subCategory && $info->subCategory->name) {
                                        if ($result) {
                                            $result .= ', ' . $info->subCategory->name;
                                        } else {
                                            $result = $info->subCategory->name;
                                        }
                                    }

                                    if ($info->brand && $info->brand->name) {
                                        if ($result) {
                                            $result .= ', ' . $info->brand->name;
                                        } else {
                                            $result = $info->brand->name;
                                        }
                                    }
                                @endphp

                                <div class="card-text company-name color-black">
                                    {{ $result }}
                                </div>

                                @php
                                    // For service
                                    $service_price = null;
                                    foreach ($info->variations as $key => $value) {
                                        $service_price = $value->dpp_inc_tax;
                                        break;
                                    }
                                @endphp

                                <div class="price mt-2 mb-2"> &pound; {{ number_format($service_price, 2) }}</div>
                                <div class="refund">
                                    <a href="{{ route('product.refund.policy', $info->id) }}" target="__blank"
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


                        <div class="apply-section mt-3">

                            <div class="apply-button">

                                <div class="d-flex gap-1" style="margin-top: 10px;">
                                    {{-- <button type="button" class="btn alreadyApplied" disabled>Already applied</button> --}}

                                    <a href="{{ route('front.checkout') }}" class="btn applynow">Order Now</a>
                                    {{-- @if ($bought)
                                        <button type="button" disabled class="btn btn-secondary">Bought</button>
                                    @else
                                        @if ($cart)
                                            <button type="button" data-is_add="0" data-product_id="{{ $info->id }}"
                                                class="btn btn-danger cart_btn">Remove from cart</button>
                                        @else
                                            <button type="button" data-is_add="1" data-product_id="{{ $info->id }}"
                                                class="btn applynow cart_btn">Add to cart</button>
                                        @endif
                                    @endif --}}
                                </div>
                                {{-- Social Media Icons --}}
                                <div> <!-- Add ml-3 class here for left margin -->
                                    @include('frontend.social_media_share.social_media')
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
                                                    Tution fees for home students: <span class="txtbold">&#163;
                                                        {{ $info->home_students_fees ?? '' }}</span>
                                                </div>
                                            @endif

                                            @if ($info->int_students_fees)
                                                <div class="col-md-6">
                                                    Tution fees for international students: <span class="txtbold">&#163;
                                                        {{ $info->int_students_fees ?? '' }}</span>
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

                                        <div class="col-md-12 text-justify">

                                            <div class="row">
                                                <div class="col-md-6 text-center">
                                                    <img src="{{ asset($info->thumbnail) }}" alt=""
                                                        style="max-width: 350px; max-height: 300px; width: auto; height: auto;">
                                                </div>

                                                <div class="col-md-6" style="margin: auto;">
                                                    <div id="imageSlider" class="carousel slide" data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                            @foreach (json_decode($info->image ?? '[]') as $index => $item)
                                                                <div
                                                                    class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                                    <img src="{{ asset($item) }}" class="d-block w-100"
                                                                        alt="">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @if (count(json_decode($info->image ?? '[]')) > 1)
                                                            <button class="carousel-control-prev" type="button"
                                                                data-bs-target="#imageSlider" data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button"
                                                                data-bs-target="#imageSlider" data-bs-slide="next">
                                                                <span class="carousel-control-next-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>


                                            @php
                                                // Extract video ID from YouTube URL
                                                $youtubeUrl = $info->youtube_link; // Assuming $info->youtube_link contains the YouTube video URL
                                                $videoId = '';
                                                parse_str(parse_url($youtubeUrl, PHP_URL_QUERY), $query);
                                                if (isset($query['v'])) {
                                                    $videoId = $query['v'];
                                                }

                                                // Construct the embed iframe
                                                $embedCode = "<div style=\"width: 100%;\"><iframe width=\"100%\" height=\"375\" src=\"https://www.youtube.com/embed/$videoId\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe></div>";

                                            @endphp

                                            <div class="mt-4">
                                                {!! $embedCode !!}
                                            </div>

                                            <div class="accordion mt-4" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne"
                                                        style="background: rgb(194, 194, 194) !important;">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                            aria-expanded="false" aria-controls="collapseOne">
                                                            <span style="display: block; width: 100%;">Brochure</span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse"
                                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="brochure_show" style="text-align: center;">
                                                                <img src="{{ asset('uploads/img/' . $info->product_brochure) }}"
                                                                    alt="" style="width: 100% !important;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif


                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">
                                    {{-- <h3 class="sectitle mb-3">Details</h3> --}}
                                    @if ($info->fee_installment_description)
                                        <h3 class="sectitle">Instalments</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->fee_installment_description ?? '' !!}
                                        </div>
                                    @endif

                                    @if ($info->requirements)
                                        <h3 class="sectitle mt-15">Requirements</h3>
                                        <div class="col-md-12 text-justify">
                                            {{ $info->requirements ?? '' }}
                                        </div>
                                        <div class="col-md-12 text-justify mt-2 ">
                                            {!! $info->requirement_details ?? '' !!}
                                        </div>
                                    @endif

                                    @if ($info->service_features)
                                        <h3 class="sectitle mt-15">Features</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->service_features ?? '' !!}
                                        </div>
                                    @endif

                                    @if ($info->general_facilities)
                                        <h3 class="sectitle mt-15">Facilities</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->general_facilities ?? '' !!}
                                        </div>
                                    @endif

                                    @if ($info->product_description)
                                        <h3 class="sectitle mt-15">More Info</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->product_description ?? '' !!}
                                        </div>
                                    @endif

                                    {{-- @if ($info->work_placement == 'Available') --}}
                                    @if ($info->work_placement_description)
                                        <h3 class="sectitle mt-15">Work Placement</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->work_placement_description ?? '' !!}
                                        </div>
                                    @endif

                                    <h3 class="policy">
                                        <a href="{{ route('product.policy', $info->id) }}" target="_blank"
                                            class="policy-button" style="float: right;">
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

                                    <div class="row header">
                                        <div class="col-md-9">
                                            <div class="card-text company-name color-black">
                                                {{ $info->business_location ? $info->business_location->name : '' }}</div>
                                        </div>

                                        <div class="col-md-3 text-end mobile_view_image_left mobile_image">
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


                                            @php
                                                $businessLocation = $info->business_location;
                                                $imageUrl =
                                                    $businessLocation &&
                                                    File::exists(public_path($businessLocation->logo))
                                                        ? asset($businessLocation->logo)
                                                        : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                            @endphp

                                            {{-- <a
                                                href="{{ $businessLocation ? route('shop.service', $businessLocation->id) : '#' }}">
                                                <div>
                                                    <img class="" src="{{ $imageUrl }}" alt=""
                                                        width="100" height="100">
                                                </div>
                                                <strong
                                                    style="font-size: 24px;">{{ $businessLocation ? $businessLocation->name : '' }}</strong>
                                            </a> --}}







                                        </div>
                                    </div>

                                    @if ($info->experiences)
                                        <h3 class="sectitle color-black mt-15">Experiences</h3>
                                        <div class="col-md-12 text-justify">
                                            {!! $info->experiences ?? '' !!}
                                        </div>
                                    @endif

                                    @if ($info->specializations)
                                        <h3 class="sectitle color-black mt-15">Specializations</h3>
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
                                        Report this service
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
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.cart_btn', function() {
                let self = $(this); // Store reference to $(this)

                let product_id = self.data('product_id');
                let is_add = self.data('is_add');
                let data = {
                    product_id: product_id,
                    is_add: is_add
                };
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
                            if (is_add == 1) {
                                self.text('Remove from cart');
                                self.removeClass('applynow').addClass('btn-danger');
                                self.data('is_add', 0);
                            } else {
                                self.text('Add to cart');
                                self.addClass('applynow').removeClass('btn-danger');
                                self.data('is_add', 1);
                            }
                        }
                    }
                });
            });
        })
    </script>
@endsection
