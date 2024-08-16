@extends('frontend.layouts.master_layout')
@section('title', $job->title)
@section('css')
    @include('frontend.recruitment.partial.details_css')
@endsection

@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">

        <div class="row">
            <div class="col-md-12 mt-2 p-2">

                <div class="card custom-card card-design">
                    <div class="card-body">

                        <div class="col-md-12">
                            <div class="job-title">{{ $job->title }}</div>
                            <div class="card-text company-name color-black">{{ $job->job_category->name }}</div>
                        </div>

                        <div class="mt-5 mb-4">
                            @include('frontend.recruitment.applyBtn')
                        </div>

                        <div class="summary-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="summery-card">
                                    <h3 class="sectitle">Summary</h3>
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div>
                                                Reference: <span class="txtbold">{{ $job->reference }}</span>
                                            </div>

                                            <div>
                                                Employee Status: <span
                                                    class="txtbold">{{ implode(', ', $job->hour_type) }}</span>
                                            </div>
                                            <div>
                                                Job type: <span class="txtbold"> {{ implode(', ', $job->job_type) }}
                                                </span>
                                            </div>

                                            @php
                                                $salary = null;
                                                if (
                                                    $job->salary_type == 'Fixed' &&
                                                    $job->fixed_salary !== null &&
                                                    $job->salary_variation !== null
                                                ) {
                                                    $salary = '£' . $job->fixed_salary . '/' . $job->salary_variation;
                                                } elseif (
                                                    $job->salary_type == 'Negotiable' &&
                                                    $job->from_salary !== null &&
                                                    $job->to_salary !== null &&
                                                    $job->salary_variation !== null
                                                ) {
                                                    $salary =
                                                        '£' .
                                                        $job->from_salary .
                                                        '-' .
                                                        $job->to_salary .
                                                        '/' .
                                                        $job->salary_variation;
                                                }
                                            @endphp

                                            <div>
                                                Salary: <span class="txtbold"> {{ $salary ?? 'N/A' }} </span>
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div>
                                                Job Location: <span class="txtbold">{{ $job->location }}</span>
                                            </div>
                                            <div>
                                                Vacancies: <span class="txtbold">
                                                    {{ $job->vacancies ?? 'N/A' }}
                                                </span>
                                            </div>

                                            <div>
                                                Published: <span
                                                    class="txtbold">{{ $job->created_at->format('j M Y') }}</span>
                                            </div>
                                            <div>
                                                Deadline: <span
                                                    class="text-danger fw-bold">{{ \Carbon\Carbon::parse($job->closing_date)->format('d M Y') }}</span>
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
                                    <h3 class="sectitle">Employeer Information</h3>
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

                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12">
                                @php
                                    $businessLocation = $job->business_location;
                                    $imageUrl =
                                        $businessLocation && File::exists($businessLocation->logo)
                                            ? asset($businessLocation->logo)
                                            : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                @endphp
                                <a href="{{ $businessLocation ? route('shop.service', $businessLocation->id) : '#' }}"
                                    class="text-decoration-none">
                                    <div class="requirements-card">
                                        <div class="row">
                                            <div
                                                class="card-text company-name color-black text_mobile_center col-md-6 col-sm-12">
                                                <h3 class="sectitle">Job Advertiser</h3>
                                                {{ $job->business_location->name }}
                                            </div>
                                            <div class="col-md-6 col-sm-12 image_mobile_view">
                                                <div>
                                                    <img class="logo_mobile" src="{{ $imageUrl }}"
                                                        alt="Business location logo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
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
                                        <p>If you come across any incorrect or misleading information in a job listing or
                                            encounter any issues with the advertiser, please let us know right away or
                                            report the job. Unipuler is committed to ensuring accurate and transparent job
                                            opportunities and does not support or endorse any inappropriate practices.
                                        </p>
                                    </div>

                                    <div class="complain-information">
                                        <div class="complain-info-item">
                                            <i class="fas fa-info-circle"></i>
                                            <div>
                                                02034881151
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
