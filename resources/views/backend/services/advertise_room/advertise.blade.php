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
                            <th>Reference No</th>
                            <th>Shop</th>
                            <th>Category</th>
                            <th>Sub-category</th>
                            <th>Child-category</th>
                            <th>Status</th>
                            <th>Booked by</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent

        <div class="modal fade" id="room_to_rent_add_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade location_edit_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
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
                columns: [
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                    { data: 'reference_id', name: 'reference_id' },
                    { data: 'action', name: 'action' },
                    { data: 'action', name: 'action' },
                    { data: 'action', name: 'action' },
                    { data: 'action', name: 'action' },
                    { data: 'action', name: 'action' },
                    { data: 'action', name: 'action' },
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
            })

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
            })
        })
    </script>
@endsection
