@extends('frontend.layouts.master_layout')
@section('css')
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')
    <div class="container mt-5">
        <div class="header p-3 bg-danger text-white rounded">
            <div class="error bg-light text-dark p-4 rounded shadow-lg">
                <h3 class="heading text-danger mb-3">This payment system is only for customers</h3>
                <p class="lead">For access to the payment system, please log in as a registered customer.</p>
                <p>If you are not a registered customer, you can sign up for an account.</p>
            </div>
        </div>
    </div>
@endsection
