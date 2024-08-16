@extends('frontend.layouts.master_layout')
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="list-page">
        <div class="mt-2 content-circle">
            <div class="container mt-3 mb-6" style="max-width: 1450px;">
                <div class="row">
                    @include('frontend.service.service_list.partial.left_side')

                    @include('frontend.service.service_list.partial.right_side')
                </div>
            </div>
        </div>
    </div>
@endsection
