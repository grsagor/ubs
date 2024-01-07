@extends('frontend.layouts.master_layout')
@section('title', 'Recruitment')
@section('css')
    <style>
        .container {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 40px;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">
        <h2>Welcome to our Website!</h2>
        @if (isset($status['success']) && $status['success'] === false)
            <p style="color: black">{{ $status['msg'] }}</p>
        @endif

        @if (Auth::check() && Auth::user()->type != 'user_customer')
            <p style="color: black">Please login as a customer. <a href="{{ route('login') }}">Login here</a>.</p>
        @else
            <p style="color: black">Experience personalized service by logging in as a customer. If you don't have an account
                yet, you can <a href="{{ route('login') }}">Sign up/Login here</a>.</p>
        @endif
    </div>
@endsection
