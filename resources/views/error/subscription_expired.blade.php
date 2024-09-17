@extends('layouts.app')
@section('title', 'Subscription Expired')
@section('css')
    <style>
        .custom-container {
            padding: 2rem;
            border-radius: 1rem;
        }

        .custom-title {
            color: #e53e3e;
            /* Red color */
            font-size: 24px;
            font-weight: 700;
        }

        .custom-description {
            color: #4a5568;
            /* Gray color */
            font-size: 18px;
            margin-top: 1rem;
        }

        .custom-button {
            background-color: #3182ce;
            /* Blue color */
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin-top: 1.5rem;
            transition: background-color 0.3s ease;
        }

        .custom-button:hover {
            background-color: #2b6cb0;
        }

        .marginTop {
            margin-top: 30px;
        }

        @media (max-width: 767px) {
            .marginTop {
                margin-top: 10px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="custom-container">
        <div class="text-center marginTop">
            <p class="custom-title">Subscription Trial Expired</p>
            <p class="custom-description">It looks like your subscription trial has ended. To continue enjoying our
                services, please purchase a subscription.</p>
            <a href="{{ route('subscription.index') }}" class="custom-button">Packages</a>
        </div>
    </div>
@endsection
