@extends('layouts.app')

@section('title', __('crm::lang.crm'))

@section('content')

    <section class="content">
        
        @component('components.widget', ['class' => 'box-primary', 'title' => __('All your adverts')])
            {{-- @slot('tool')
                <div class="box-tools">
                    <a href="{{ url('contact/property-wanted-create') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-plus"></i> @lang('messages.add')</a>
                </div>
            @endslot --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="sales_order_table">
                    <thead>
                        <tr>
                            {{-- <th>Action</th> --}}
                            {{-- <th>Status</th> --}}
                            {{-- <th>Action required</th> --}}
                            <th>Sl N</th>
                            <th>Invoice No</th>
                            <th>Product Name</th>
                            <th>Unit Purchase Price</th>
                            <th>Payment Method</th>
                            <th>Purchase Date</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent

        <div class="modal fade property_wanted_delete_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
@endsection
@section('css')
    <style type="text/css">
        .fw-100 {
            font-weight: 100;
        }
    </style>
@stop
@section('javascript')
    <script src="{{ asset('modules/crm/js/crm.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '#wish_birthday', function() {
                var url = $(this).data('href');
                var contact_ids = [];
                $("input.contat_id").each(function() {
                    if ($(this).is(":checked")) {
                        contact_ids.push($(this).val());
                    }
                });

                if (_.isEmpty(contact_ids)) {
                    alert("{{ __('crm::lang.plz_select_user') }}");
                } else {
                    location.href = url + '?contact_ids=' + contact_ids;
                }
            });
        });
    </script>
    {{-- datatables --}}
    <script>
        $(document).ready(function() {
            var salesOrderTable = $('#sales_order_table').DataTable({
                processing: true,
                serverSide: true,
                bPaginate: false,
                buttons: [],
                ajax: '/business/order',
                columns: [
                    // {
                    //     data: 'actions',
                    //     name: 'actions',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'invoice_no',
                        name: 'invoice_no'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'unit_price',
                        name: 'unit_price'
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method'
                    },
                    {
                        data: 'purchase_date',
                        name: 'purchase_date'
                    },

                ]
            });

            // Handling Delete Action
            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id'); // Getting the ID from the data attribute
                $.ajax({
                    url: "/contact/show-property-delete-modal", // Modify with your delete URL
                    type: "get",
                    data: {
                        id: id
                    },
                    dataType: "html",
                    success: function(html) {
                        $('.property_wanted_delete_modal').empty();
                        $('.property_wanted_delete_modal').html(html);
                        $('.property_wanted_delete_modal').modal('show');
                    }
                });
            });

            $(document).on('click', '.property_delete_confirm_btn', function() {
                var id = $(this).data('id'); // Getting the ID from the data attribute
                $.ajax({
                    url: "/contact/confirm-property-delete", // Modify with your delete confirm URL
                    type: "get",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        toastr.options = {
                            "sound": false // Disable sound globally
                            // Other options...
                        };
                        toastr.success(response.message);
                        salesOrderTable.ajax.reload(); // Reload DataTables after deletion
                        $('.property_wanted_delete_modal').modal('hide');
                    }
                });
            });
        });
    </script>
@endsection
