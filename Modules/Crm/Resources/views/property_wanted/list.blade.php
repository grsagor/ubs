@extends('layouts.app')
@section('title', 'Shop Sharing')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/rough/root.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/rough/stack.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/rough/advertise.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Property Wanted
            <small>Tell what you want</small>
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
                        data-href="{{ action([\App\Http\Controllers\Backend\PropertyWantedController::class, 'create']) }}"
                        data-container=".room_to_rent_add_modal">
                        <i class="fa fa-plus"></i> @lang('messages.add')</button>
                </div>
            @endslot
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="room_to_rent_share_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent

        <div class="modal fade room_to_rent_add_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
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
            ajax: '/property-wanted',
            columns: [
                    { data: 'ad_title', name: 'ad_title' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
        });
    });
</script>
@endsection
