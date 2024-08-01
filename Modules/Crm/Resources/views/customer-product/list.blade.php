@extends('crm::layouts.app')
@section('title', 'Property Wanted')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>My product
            <small>All your product that you bought</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary', 'title' => __('All your adverts')])
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
                            {{-- <th>Action</th> --}}
                            {{-- <th>Status</th> --}}
                            {{-- <th>Action required</th> --}}
                            <th>Product</th>
                            <th>Unit Purchase Price</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent

        <div class="modal fade property_wanted_delete_modal" tabindex="-1" role="dialog"
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
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    // {
                    //     data: 'status',
                    //     name: 'status',
                    //     render: function(data, type, row) {
                    //         if (type === 'display' && data !== null) {
                    //             var statusClass = data === 0 ? 'bg-red' : data === 1 ? 'bg-green' :
                    //                 '';
                    //             return '<span class="cursor-pointer label ' + statusClass +
                    //                 ' property-wanted-delete-btn" data-id="' +
                    //                 row.id + '">' + (data === 1 ? 'Published' : 'Private') +
                    //                 '</span>';
                    //         }
                    //         return '';
                    //     }
                    // },
                    // {
                    //     data: 'information_complete',
                    //     name: 'information_complete',
                    //     render: function(data, type, row) {
                    //         if (data == 1) {
                    //             return '<span class="label bg-green">Not required</span>';
                    //         } else {
                    //             return '<span class="label bg-yellow">Required</span>';
                    //         }
                    //     }
                    // },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'unit_price',
                        name: 'unit_price'
                    },
                ]
            });
        });


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
