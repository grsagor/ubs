@extends('crm::layouts.app')
@section('title', 'My Orders')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header no-print">
        <h1>@lang('purchase.purchases')</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        @component('components.filters', ['title' => __('report.filters')])
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('status_filter', __('purchase.purchase_status') . ':') !!}
                    {!! Form::select('status_filter', $orderStatuses, null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('lang_v1.all'),
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('payment_status_filter', __('purchase.payment_status') . ':') !!}
                    {!! Form::select(
                        'payment_status_filter',
                        [
                            'paid' => __('lang_v1.paid'),
                            'due' => __('lang_v1.due'),
                            'partial' => __('lang_v1.partial'),
                            'overdue' => __('lang_v1.overdue'),
                        ],
                        null,
                        ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')],
                    ) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('date_range_filter', __('report.date_range') . ':') !!}
                    {!! Form::text('date_range_filter', null, [
                        'placeholder' => __('lang_v1.select_a_date_range'),
                        'class' => 'form-control',
                        'readonly',
                    ]) !!}
                </div>
            </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-primary', 'title' => __('All Your Purchases')])
            {{-- @slot('tool')
                <div class="box-tools">
                    <a href="{{ url('contact/property-wanted-create') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-plus"></i> @lang('messages.add')</a>
                </div>
            @endslot --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="room_to_rent_share_table">
                    <thead>
                        <tr>
                            <th>@lang('messages.action')</th>
                            <th>@lang('messages.date')</th>
                            <th>@lang('purchase.ref_no')</th>
                            <th>@lang('purchase.purchase_status')</th>
                            <th>@lang('purchase.payment_status')</th>
                            <th>@lang('purchase.grand_total')</th>
                            <th>@lang('purchase.payment_due') &nbsp;&nbsp;<i class="fa fa-info-circle text-info no-print"
                                    data-toggle="tooltip" data-placement="bottom" data-html="true"
                                    data-original-title="{{ __('messages.purchase_due_tooltip') }}" aria-hidden="true"></i></th>
                            <th>@lang('lang_v1.added_by')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent

        <div class="modal fade property_wanted_delete_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade " id="product_show_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade " id="product_print_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
    <!-- /.content -->

@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            business_locations = $('#room_to_rent_share_table').DataTable({
                processing: true,
                serverSide: true,
                bPaginate: false,
                buttons: [],
                ajax: '/contact/products',
                columns: [

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        "searchable": false
                    },

                    {
                        data: 'transaction_date',
                        name: 'transaction_date'
                    },
                    {
                        data: 'ref_no',
                        name: 'ref_no'
                    },

                    {
                        data: 'status',
                        name: 'status',
                        class: 'text-center'
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status',
                        class: 'text-center'
                    },
                    {
                        data: 'final_total',
                        name: 'final_total',
                    },
                    {
                        data: 'payment_due',
                        name: 'payment_due',
                        class: 'text-center'
                    },
                    {
                        data: 'added_by',
                        name: 'u.first_name'
                    }
                ]
            });
        });

        $(document).ready(function() {
            $(document).on('click', '.product_show', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('customer.order.show.details') }}",
                    type: 'get',
                    data: {
                        id: id
                    },
                    dataType: 'html',
                    success: function(d) {
                        $('#product_show_modal').empty();
                        $('#product_show_modal').html(d);
                        $('#product_show_modal').modal('show')
                    }
                })
            })
        })
        $(document).ready(function() {
            $(document).on('click', '.product_print', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('customer.order.print.details') }}",
                    type: 'get',
                    data: {
                        id: id
                    },
                    dataType: 'html',
                    success: function(d) {
                        $('#product_print_modal').empty();
                        $('#product_print_modal').html(d);
                        $('#product_print_modal').modal('show')
                    }
                })
            })
        })

        $(document).ready(function() {
            // Deleteing Property Started
            $(document).on('click', '.property-wanted-delete-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "/contact/show-property-delete-modal",
                    type: "get",
                    data: {
                        id: id
                    },
                    dataType: "html",
                    success: function(html) {
                        // toastr.success(JSON.stringify('Modal Open'));
                        $('.property_wanted_delete_modal').empty();
                        $('.property_wanted_delete_modal').html(html);
                        $('.property_wanted_delete_modal').modal('show');
                    }
                })
            })

            $(document).on('click', '.property_delete_confirm_btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "/contact/confirm-property-delete",
                    type: "get",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        toastr.options = {
                            "sound": false, // Disable sound globally
                            // Other options...
                        };
                        toastr.success(response.message);
                        $('#room_to_rent_share_table').DataTable().ajax.reload();
                        $('.property_wanted_delete_modal').modal('hide');
                    }
                })
            })
        })
    </script>
@endsection
