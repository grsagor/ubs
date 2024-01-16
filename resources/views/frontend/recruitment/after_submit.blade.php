@extends('frontend.layouts.master_layout')
@section('title', 'Successfull')
@section('css')
    <style>
        .container {
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            padding: 20px;
            max-width: 550px;
            width: 100%;
            margin-top: 20px;
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 0px 10px;
            margin: 5px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-job {
            background-color: #3498db;
            border: 2px solid #3498db;
        }

        .btn-info {
            background-color: #2ecc71;
            border: 2px solid #2ecc71;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">
        <h2>Your application is submitted successfully!</h2>
        <p>Thank you for applying! You will receive updates soon from the employer.</p>
        <a href="{{ route('recruitment.list') }}" class="btn btn-job">More Jobs</a>
        <a href="{{ route('recruitment.edit', ['id' => myInformation()->uuid]) }}" class="btn btn-info">Your Information</a>
    </div>
@endsection
