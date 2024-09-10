@extends('frontend.layouts.master_layout')
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="shop-list-page">
        <div class="shop-list-page" style="background-color: #f0f2f5">
            <div class="content-circle">
                <div class="container mt-3 mb-6" style="max-width: 100%">
                    <div class="row">
                        @include('frontend.news.partial.left_side')

                        @include('frontend.news.partial.right_side')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
