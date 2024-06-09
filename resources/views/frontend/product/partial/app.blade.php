@extends('frontend.layouts.master_layout')
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="shop-list-page">
        <div class="mt-2 content-circle">
            <div class="container">
                <div class="row">
                    @include('frontend.service.service_list.partial.left_side')

                    @include('frontend.service.service_list.partial.right_side')
                </div>
            </div>
        </div>
    </div>
@endsection
