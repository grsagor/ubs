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

        .text-justify {
            text-align: justify;
        }

        /* Custom styling for the cards */
        .custom-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .custom-card:hover {
            transform: scale(1.03);
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

        .m-b-0 {
            margin-bottom: 0px;
        }

        .m-b-5 {
            margin-bottom: 0px;
        }

        .p-7 {
            padding: 7px;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">

        <div class="row">
            @foreach ($jobs as $item)
                <div class="col-md-6 mt-3 p-7">
                    <a href="{{ route('recruitment.details', ['id' => $item->uuid]) }}" class="card-link">
                        <div class="card custom-card card-design">
                            <div class="card-body">
                                <h4 class="card-title">{{ $item->title }}</h4>
                                <p class="card-text mb-2 color-black">Company Name → {{ $item->company_name }}</p>
                                <p class="card-text mb-2 color-black">Hours → {{ $item->hour_type }}</p>
                                <p class="card-text mb-2 color-black">Job type → {{ $item->job_type }}</p>
                                <p class="card-text mb-2 color-black">
                                    @if ($item->salary)
                                        Salary → {{ $item->salary }}/{{ $item->salary_type }}
                                    @else
                                        Salary → {{ $item->salary_type }}
                                    @endif
                                </p>
                                <p class="card-text color-black">Last Date for Application → {{ $item->closing_date }}</p>
                                <p class="card-text color-black">Location: {{ $item->location }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>


    </div>
@endsection
