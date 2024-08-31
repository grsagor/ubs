@extends('frontend.layouts.master_layout')
@section('title', 'Policy')
@section('css')
    @include('frontend.footerDetails.css')
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container" id="policy-container">
        <h4 class="footer-details-title mt-4">
            <u>Policy</u>
            <a href="{{ route('product.show', $info->slug) }}" class="sectitle">{{ $info->name }}</a>
        </h4>

        <div class="header mv">
            <div class="welcome">
                {!! $info->policy ?? '' !!}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            adjustContainerHeight();
        });

        $(window).resize(function() {
            adjustContainerHeight();
        });

        function adjustContainerHeight() {
            var container = $('#policy-container');
            var contentHeight = container.find('.welcome').height();

            if (contentHeight > 70 * window.innerHeight / 100) {
                container.css('height', 'auto');
            } else {
                container.css('height', '70vh');
            }
        }
    </script>

@endsection
