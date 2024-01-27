@extends('frontend.layouts.master_layout')
@section('title', 'Jobs')
@section('css')
    <style>
        .container {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .color-black {
            color: black !important;
        }

        .custom-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card-body {
            padding: 20px;
        }

        .card-design {
            background-color: #dedede;
            color: #212529;
            /* Dark text color */
        }

        .card-title {
            color: #007bff;
            font-size: 26px;
            /* Blue title color */
        }

        .card-subtitle {
            color: #6c757d;
            /* Gray subtitle color */
        }

        .card-text {
            color: #495057;
            /* Dark text color for other text */
        }

        .mobile-view {
            display: none;
        }

        .laptop-view {
            display: block;
        }

        @media (max-width: 767px) {
            .mobile-view {
                display: block;
            }

            .laptop-view {
                display: none;
            }
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">

        <div class="row">
            @foreach ($jobs as $item)
                <div class="col-md-12 mt-2 p-2">
                    <a href="{{ route('recruitment.details', ['id' => $item->uuid]) }}" target="_blank" class="card-link">

                        <div class="card custom-card card-design laptop-view">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h4 class="card-title mb-0">{{ $item->title }}</h4>
                                        <p class="card-text company-name color-black">{{ $item->company_name }}</p>
                                        <p class="card-text mb-0 color-black">Employee Status: {{ $item->hour_type }}</p>
                                        <p class="card-text mb-0 color-black">Job Type: {{ $item->job_type }}</p>
                                        <p class="card-text color-black">
                                            @if ($item->salary)
                                                Salary: {{ $item->salary }}/{{ $item->salary_type }}
                                            @else
                                                Salary: {{ $item->salary_type }}
                                            @endif
                                        </p>
                                    </div>

                                    <div class="col-md-3 text-center m-auto">
                                        @if ($item->businessLocation && $item->businessLocation->logo)
                                            <img src="{{ asset($item->businessLocation->logo) }}" alt=""
                                                style="height: 110px">
                                        @else
                                            <img src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                                                alt="" style="height: 110px">
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-9">
                                        <p class="card-text color-black">Location: {{ $item->location }}</p>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <p class="card-text deadline color-black">Deadline:
                                            {{ date('d.m.Y', strtotime($item->closing_date)) }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>




                        {{-- Mobile view --}}
                        <div class="card custom-card card-design mobile-view">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-center m-auto">
                                        @if ($item->businessLocation && $item->businessLocation->logo)
                                            <img src="{{ asset($item->businessLocation->logo) }}" alt=""
                                                style="height: 110px">
                                        @else
                                            <img src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                                                alt="" style="height: 110px">
                                        @endif
                                    </div>

                                    <div class="col-md-12 mt-2">
                                        <h4 class="card-title mb-0">{{ $item->title }}</h4>
                                        <p class="card-text company-name color-black">{{ $item->company_name }}</p>
                                        <p class="card-text mb-0 color-black">Employee Status: {{ $item->hour_type }}</p>
                                        <p class="card-text mb-0 color-black">Job Type: {{ $item->job_type }}</p>
                                        <p class="card-text color-black">
                                            @if ($item->salary)
                                                Salary: {{ $item->salary }}/{{ $item->salary_type }}
                                            @else
                                                Salary: {{ $item->salary_type }}
                                            @endif
                                        </p>
                                        <p class="card-text mb-0 color-black">Location: {{ $item->location }}</p>
                                        <p class="card-text deadline color-black">Deadline:
                                            {{ date('d.m.Y', strtotime($item->closing_date)) }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </a>
                </div>
            @endforeach
        </div>


    </div>
@endsection
