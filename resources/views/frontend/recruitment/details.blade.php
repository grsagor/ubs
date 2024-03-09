@extends('frontend.layouts.master_layout')
@section('title', $job->title)
@section('css')
    <style>
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

        .description ul li {
            list-style: disc inside;
        }

        .description ul {
            margin-bottom: 15px;
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
                                <div class="job-title">{{ $job->title }}</div>
                                <div class="card-text company-name color-black">{{ $job->company_name }}</div>

                            </div>

                            <div class="col-md-3 text-end">

                                @php
                                    $businessLocation = $job->businessLocation;
                                    $imageUrl =
                                        $businessLocation && File::exists($businessLocation->logo)
                                            ? asset($businessLocation->logo)
                                            : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                @endphp

                                <a href="{{ $businessLocation ? route('shop.service', $businessLocation->id) : '#' }}">
                                    <div>
                                        <img class="" src="{{ $imageUrl }}" alt=""
                                            style="width: 35% !important;">
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="row header mobile-view">
                            <div class="col-md-12 text-center">

                                @php
                                    $businessLocation = $job->businessLocation;
                                    $imageUrl =
                                        $businessLocation && File::exists($businessLocation->logo)
                                            ? asset($businessLocation->logo)
                                            : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
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
                        </div>

                        <div class="apply-section mt-3">
                            <div class="deadline-heading">
                                Application Deadline: <span
                                    class="deadline-date">{{ \Carbon\Carbon::parse($job->closing_date)->format('d F Y') }}</span>
                            </div>
                            <div class="apply-button">

                                @include('frontend.recruitment.applyBtn')

                            </div>
                        </div>

                        <div class="summary-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="summery-card">
                                    <h3 class="sectitle">Summary</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                Employee Status: <span class="txtbold">{{ $job->hour_type }}</span>
                                            </div>
                                            <div>
                                                Job type: <span class="txtbold">{{ $job->job_type }}</span>
                                            </div>
                                            <div>
                                                Salary: <span class="txtbold">
                                                    @if ($job->salary)
                                                        {{ $job->salary }}/{{ $job->salary_type }}
                                                    @else
                                                        {{ $job->salary_type }}
                                                    @endif
                                                </span>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                Job Location: <span class="txtbold">{{ $job->location }}</span>
                                            </div>
                                            <div>
                                                Reference: <span class="txtbold">{{ $job->reference }}</span>
                                            </div>
                                            <div>
                                                Published: <span
                                                    class="txtbold">{{ $job->created_at->format('j F Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">
                                    <h3 class="sectitle">Details</h3>
                                    <div class="col-md-12 text-justify description">
                                        {!! $job->description ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="company-info-section row mt-3">
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
                        </div>

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
