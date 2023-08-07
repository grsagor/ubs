@extends('layouts.app')
@section('title', 'Shop Sharing')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Shop Share
            <small>Share any shops from here</small>
        </h1>
        <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary', 'title' => __('business.all_your_business_locations')])
            @slot('tool')
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal"
                        data-href="{{ action([\App\Http\Controllers\BusinessLocationController::class, 'create']) }}"
                        data-container=".location_add_modal">
                        <i class="fa fa-plus"></i> @lang('messages.add')</button>
                </div>
            @endslot
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="shop_share_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            {{-- <th>@lang( 'lang_v1.location_id' )</th>
                            <th>@lang( 'business.landmark' )</th>
                            <th>@lang( 'business.city' )</th>
                            <th>@lang( 'business.zip_code' )</th>
                            <th>@lang( 'business.state' )</th>
                            <th>@lang( 'business.country' )</th>
                            <th>@lang( 'lang_v1.price_group' )</th>
                            <th>@lang( 'invoice.invoice_scheme' )</th>
                            <th>@lang('lang_v1.invoice_layout_for_pos')</th>
                            <th>@lang('lang_v1.invoice_layout_for_sale')</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent

        <div class="modal fade location_add_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade location_edit_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
    <!-- /.content -->

@endsection
@section('javascript')
    <script>
        business_locations = $('#shop_share_table').DataTable({
            processing: true,
            serverSide: true,
            bPaginate: false,
            buttons: [],
            ajax: '/shop-share',
            columnDefs: [{
                targets: 1,
                orderable: false,
                searchable: false,
            }, ],
        });
    </script>
@endsection
