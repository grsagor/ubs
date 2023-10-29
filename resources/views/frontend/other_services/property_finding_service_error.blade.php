@extends('frontend.layouts.master_layout')
@section('css')
    <style>
        .card {
            border: none;
            border-radius: 15px;
            background: linear-gradient(45deg, #234889, #1ba18f);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.015);
        }

        .card-header {
            background-color: transparent;
            border: none;
        }

        .card-title {
            color: #fff;
        }

        .card-body {
            background-color: #f0f0f0;
            /* Change the background color here */
            color: #333;
            border-radius: 0 0 10px 10px;
            padding: 20px;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')
    <div class="container" style="margin-top: 100px; margin-bottom: 200px;">
        <div class="card">
            <div class="card-header m-3">
                <h3 class="card-title">This payment system is only for customers</h3>
            </div>
            <div class="card-body p-4">
                <p class="lead">For access to the payment system, please log in as a registered customer.</p>
                <p>If you are not a registered customer, you can sign up for an account.</p>
            </div>
        </div>
    </div>
@endsection
