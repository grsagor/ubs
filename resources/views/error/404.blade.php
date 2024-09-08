@extends('frontend.layouts.master_layout')
@section('title', '404 Error')
@section('css')
    <style>
        .error-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 90vh;
            margin: auto;
            text-align: center;
        }

        .error-header {
            font-size: 120px;
            color: #ff6b6b;
        }

        .error-h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .error-paragraph {
            font-size: 16px;
            color: #666;
            margin-bottom: 40px;
        }

        .error-homepage-btn {
            font-size: 18px;
            text-decoration: none;
            color: #ff6b6b;
            border: 2px solid #ff6b6b;
            padding: 10px 20px;
            border-radius: 25px;
            transition: 0.3s ease;
        }

        .error-homepage-btn:hover {
            background-color: #ff6b6b;
            color: #fff;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="error-container">
        <h1 class="error-header">404</h1>
        <h2 class="error-h2">Page Not Found</h2>
        <p class="error-paragraph">Sorry, the page you are looking for doesn't exist.</p>
        <a href="/" class="error-homepage-btn">Go to Homepage</a>
    </div>
@endsection
