@extends('frontend.layouts.master_layout')
@section('title', 'Payment Successful - ')
@section('css')
    <style>
        #payment_thanks_container {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 36px;
        }

        #payment_thanks_container .btn {
            background: #7abad3 !important;
            color: white !important;
        }

        #payment_thanks_container .btn:hover {
            background: #61a0b9 !important;
            color: white !important;
        }

        #payment_thanks_container .btn {
            width: 130px !important;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')
    <div id="payment_thanks_container">
        <h1>Thank you for</h1>
        <h1 class="mb-5">Your Order!</h1>
        <div class="d-flex flex-column flex-md-row gap-4">
            <a class="btn" href="{{ route('service.list') }}">Buy more</a>
            <button class="btn" id="create_invoice_btn" type="button">
                <span id="create_invoice_btn_text">Invoice</span>
                <div id="create_invoice_btn_loader" style="display: none;">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </button>
            @if (Auth::user() && Auth::user()->user_type == 'user_customer')
                <a href="{{ url('contact/contact-dashboard') }}" class="btn">Dashboard</a>
            @else
                <a href="{{ url('home') }}" class="btn">Dashboard</a>
            @endif
        </div>
    </div>
@endsection

@section('script')
@endsection
