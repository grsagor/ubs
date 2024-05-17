@extends('frontend.layouts.master_layout')
@section('content')
    @includeIf('frontend.partials.global.common-header')
    <!-- breadcrumb -->
    {{-- <div class="full-row bg-light overlay-dark py-5" style="">
        <div class="container">
            <div class="row text-center text-white">
                <div class="col-12">
                    <h3 class="mb-2 text-white">{{ __('Cart') }}</h3>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                            <li class="breadcrumb-item"><a href="{{ route('homePage') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- breadcrumb -->
    <div class="load_cart">
        @include('frontend.ajax.cart-page')
    </div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if (session()->has('error'))
    <script>
        console.log("{{ session()->get('error') }}");
    </script>
@endif
@endsection
@section('css')
    <style>
        .product-thumbnail img {
            object-fit: cover;
        }
    </style>
@endsection