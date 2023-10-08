@extends('layouts.app')
@section('title', __('restaurant.bookings'))

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/rough/root.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/rough/stack.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/rough/advertise.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Service
            <small>Advertise your room</small>
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
                    <button type="button" class="btn btn-block btn-primary room-to-rent-add-modal-btn"><i class="fa fa-plus"></i>
                        @lang('messages.add')</button>
                </div>
            @endslot
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="room_to_rent_share_table">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Status</th>
                            <th>Reference No</th>
                            <th>Category</th>
                            <th>Sub-category</th>
                            <th>Child-category</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent

        <div class="modal fade" id="room_to_rent_add_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade property_rent_edit_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade property_rent_delete_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>

        <div class="modal fade property_booking_details_modal" tabindex="-1" role="dialog"
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
                ajax: '/service-advertise',
                columns: [{
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            return data == 1 ? 'Active' : 'Inactive';
                        }
                    },
                    {
                        data: 'reference_id',
                        name: 'reference_id'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'subcategory_name',
                        name: 'subcategory_name'
                    },
                    {
                        data: 'child_category_name',
                        name: 'child_category_name'
                    },
                ]
            });
        });

        $(document).ready(function() {
            $(document).on('click', '.room-to-rent-add-modal-btn', function() {
                // var value = $(this).data('id');
                $.ajax({
                    url: "/room-to-rent-open-add-modal",
                    type: "get",
                    // data: {
                    //     value: value
                    // },
                    dataType: "html",
                    success: function(html) {
                        $('#room_to_rent_add_modal').empty();
                        $('#room_to_rent_add_modal').html(html);
                        $('#room_to_rent_add_modal').modal('show');
                    }
                })
            });

            $(document).on('change', '#service_category_id', function() {
                var id = $(this).val();
                $.ajax({
                    url: "/show-subcategory-select",
                    type: "get",
                    data: {
                        id: id
                    },
                    dataType: "html",
                    success: function(html) {
                        $('#sub-category-container').empty();
                        $('#sub-category-container').html(html);
                    }
                })
            });

            // Deleteing Property Started
            $(document).on('click', '#property_wanted_delete_btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "/show-property-rent-delete-modal",
                    type: "get",
                    data: {
                        id: id
                    },
                    dataType: "html",
                    success: function(html) {
                        // toastr.success(JSON.stringify('Modal Open'));
                        $('.property_rent_delete_modal').empty();
                        $('.property_rent_delete_modal').html(html);
                        $('.property_rent_delete_modal').modal('show');
                    }
                })
            });

            $(document).on('click', '.property_delete_confirm_btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "/confirm-property-rent-delete",
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
                        $('.property_rent_delete_modal').modal('hide');
                    }
                })
            });

            // Editing property started
            $(document).on('click', '#property_rent_edit_btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "/show-property-rent-edit-modal",
                    type: "get",
                    data: {
                        id: id
                    },
                    dataType: "html",
                    success: function(html) {
                        $('.property_rent_edit_modal').empty();
                        $('.property_rent_edit_modal').html(html);
                        $('.property_rent_edit_modal').modal('show');
                    }
                })
            });

            // Show booking details property started
            $(document).on('click', '#property_booking_details_btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "/show-property-booking-details-modal",
                    type: "get",
                    data: {
                        id: id
                    },
                    dataType: "html",
                    success: function(html) {
                        $('.property_booking_details_modal').empty();
                        $('.property_booking_details_modal').html(html);
                        $('.property_booking_details_modal').modal('show');
                    }
                })
            });

        })
    </script>
@endsection
