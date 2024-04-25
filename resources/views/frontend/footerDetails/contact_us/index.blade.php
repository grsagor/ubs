@extends('frontend.layouts.master_layout')
@section('title', 'Contact us')
@section('css')
    {{-- @include('frontend.footerDetails.css') --}}
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <style>
        /* Default styles for all screen sizes */
        .contact-info h1,
        .contact-info p {
            font-family: 'Exo 2', sans-serif;
            font-weight: 600;
            color: black;
        }

        .contact-info h4 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .contact-info p {
            font-size: 18px;
            margin-top: 0;
        }

        .contact-info i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        h1 {
            text-decoration: underline;
        }

        /* Add border style for contact info divs */
        .contact-info>.col-md-4 {
            border: 1px solid #ccc;
            padding: 20px;
        }

        @media screen and (min-width: 992px) {
            .main {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 78vh;
                /* Adjust height as needed */
            }
        }

        @media screen and (max-width: 768px) {
            h1.text-center {
                margin-top: 20px;
            }
        }

        .contact-us {
            width: 100%;
        }
    </style>

    <div class="container main m-auto">
        <div class="contact-us">
            <h1 class="text-center">Contact Us</h1>
            <div class="text-center mt-4">
                <div class="row contact-info p-2">
                    <div class="col-md-4">
                        <h4 class="text-center">
                            <i class="fas fa-map-marker-alt"></i>
                        </h4>
                        <p class="text-center">Address</p>
                        <p class="text-center">{!! $footerData['contact-us-address'] ?? '' !!}</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-center">
                            <i class="fas fa-phone"></i>
                        </h4>
                        <p class="text-center">Phone</p>
                        <p class="text-center">{!! $footerData['contact-us-phone'] ?? '' !!}</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-center">
                            <i class="fas fa-envelope"></i>
                        </h4>
                        <p class="text-center">Email</p>
                        <p class="text-center">{!! $footerData['contact-us-email'] ?? '' !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
