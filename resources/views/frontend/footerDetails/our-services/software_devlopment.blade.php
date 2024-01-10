@extends('frontend.layouts.master_layout')
@section('css')
    @include('frontend.footerDetails.css')
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">

        <h4 class="footer-details-title mt-4"><u>Software Development</u></h4>

        <div class="header mv">
            <div class="welcome">
                {!! $data->description ?? '' !!}
            </div>
        </div>
    </div>
@endsection
