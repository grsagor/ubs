@extends('frontend.layouts.master_layout')
@section('title', 'Policy')
@section('css')
    @include('frontend.footerDetails.css')
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">

        <h4 class="footer-details-title mt-4"><u>Policy</u></h4>

        <div class="header mv">
            <div class="welcome">
                {!! $info->policy ?? '' !!}
            </div>
        </div>
    </div>
@endsection
