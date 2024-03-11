@extends('frontend.layouts.master_layout')
@section('title', 'Refund-Policy')
@section('css')
    @include('frontend.footerDetails.css')
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container" style="height: 30vh;">

        <h4 class="footer-details-title mt-4"><u>Refund Policy</u></h4>

        <div class="header mv">
            <div class="welcome">
                {!! $info->refund_policy ?? '' !!}
            </div>
        </div>
    </div>
@endsection
