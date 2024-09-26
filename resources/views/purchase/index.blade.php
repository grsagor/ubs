@extends('layouts.app')
@section('title', __('purchase.purchases'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header no-print">
        <h1>@lang('purchase.purchases')
            <small></small>
        </h1>
        <!-- <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                                    <li class="active">Here</li>
                                </ol> -->
    </section>

    <!-- Main content -->
    <section class="content no-print">
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

        @component('components.widget', ['class' => 'box-primary', 'title' => __('purchase.all_purchases')])
            {{-- @can('purchase.create')
                @slot('tool')
                    <div class="box-tools">
                        <a class="btn btn-block btn-primary"
                            href="{{ action([\App\Http\Controllers\PurchaseController::class, 'create']) }}">
                            <i class="fa fa-plus"></i> @lang('messages.add')</a>
                    </div>
                @endslot
            @endcan --}}
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

        {{-- <div class="modal fade product_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

        <div class="modal fade payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

        <div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div> --}}
        <div class="modal fade property_wanted_delete_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade " id="product_show_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade " id="product_print_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>


        {{-- @include('purchase.partials.update_purchase_status_modal') --}}

    </section>

    <section id="receipt_section" class="print_section"></section>

    <!-- /.content -->
@stop
@section('javascript')
    <script src="{{ asset('js/purchase.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
    {{-- <script>
        //Date range as a button
        $('#purchase_list_filter_date_range').daterangepicker(
            dateRangeSettings,
            function(start, end) {
                $('#purchase_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(
                    moment_date_format));
                purchase_table.ajax.reload();
            }
        );
        $('#purchase_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#purchase_list_filter_date_range').val('');
            purchase_table.ajax.reload();
        });

        $(document).on('click', '.update_status', function(e) {
            e.preventDefault();
            $('#update_purchase_status_form').find('#status').val($(this).data('status'));
            $('#update_purchase_status_form').find('#purchase_id').val($(this).data('purchase_id'));
            $('#update_purchase_status_modal').modal('show');
        });

        $(document).on('submit', '#update_purchase_status_form', function(e) {
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();

            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: data,
                beforeSend: function(xhr) {
                    __disable_submit_button(form.find('button[type="submit"]'));
                },
                success: function(result) {
                    if (result.success == true) {
                        $('#update_purchase_status_modal').modal('hide');
                        toastr.success(result.msg);
                        purchase_table.ajax.reload();
                        $('#update_purchase_status_form')
                            .find('button[type="submit"]')
                            .attr('disabled', false);
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            business_locations = $('#room_to_rent_share_table').DataTable({
                processing: true,
                serverSide: true,
                bPaginate: false,
                buttons: [],
                ajax: '/purchases/datatable/list',
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
                    url: "{{ route('single.order.show.details') }}",
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
                var href = $(this).data('href');
                console.log(href, "data")
                $.ajax({
                    url: href,
                    type: 'get',
                    // data: {
                    //     id: id
                    // },
                    dataType: 'html',
                    success: function(d) {
                        console.log(d, "d")
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
