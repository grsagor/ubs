@extends('frontend.layouts.master_layout')
@section('title', 'Successful')
@section('css')
    <style>
        .submit_body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            height: 90vh;
            margin: 0;
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn-container {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            line-height: 33px !important;
            padding: 0 20px !important;
            margin: 5px;
        }

        .btn-more-job {
            border-radius: 4px;
            background: #263038;
            color: #FFF;
            font-weight: 500;
        }

        .btn-more-job:hover,
        .btn-infomation:hover {
            color: white;
        }

        .btn-infomation {
            border-radius: 4px;
            background: #05addc;
            color: #FFF;
            font-weight: 500;
        }

        @media (max-width: 767px) {
            .submit_body {
                height: unset !important;
                margin-top: 100px;
                margin-bottom: 100px;
            }
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="submit_body">
        <h2>Your application is {{ $data }} successfully!</h2>
        <p>Thank you for applying! You will receive updates soon from the employer.</p>
        <div class="btn-container">
            <a href="{{ route('recruitment.list') }}" class="btn btn-more-job">More Jobs</a>
            <a href="{{ route('recruitment.edit', ['id' => myInformation()->uuid]) }}" class="btn btn-infomation">Your
                Applications</a>
        </div>
    </div>
@endsection
