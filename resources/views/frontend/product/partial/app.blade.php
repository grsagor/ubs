@extends('frontend.layouts.master_layout')
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="shop-list-page">
        <div class="mt-2 content-circle">
            <div class="container">
                <div class="row">

                    @include('frontend.service.service_list.partial.left_side')

                    @include('frontend.service.service_list.partial.right_side')

                    {{-- <div class="col-lg-8 mt-3 text-center">
                        <div class="d-flex align-items-start pt-3" id="custom-pagination">
                            <div class="pagination-style-one mx-auto">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        {{ $rooms->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
