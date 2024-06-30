@extends('layouts.app')
@section('title', __('essentials::lang.leave_type'))

@section('content')
    @include('essentials::layouts.nav_hrm')
    <section class="content-header">
        <h1>@lang('essentials::lang.leave_type')
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-solid', 'title' => __('essentials::lang.all_leave_types')])
            @slot('tool')
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#add_leave_type_modal">
                        <i class="fa fa-plus"></i> @lang('messages.add')</button>
                </div>
            @endslot
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="leave_type_table">
                    <thead>
                        <tr>
                            <th>@lang('essentials::lang.leave_type')</th>
                            <th>@lang('essentials::lang.max_leave_count')</th>
                            <th>@lang('messages.action')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent

        @include('essentials::leave_type.create')

    </section>
    <!-- /.content -->

@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {

            leave_type_table = $('#leave_type_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ action([\Modules\Essentials\Http\Controllers\EssentialsLeaveTypeController::class, 'index']) }}",
                columnDefs: [{
                    targets: 2,
                    orderable: false,
                    searchable: false,
                }, ],
            });

        });

        // $(document).on('submit', 'form#add_leave_type_form, form#edit_leave_type_form', function(e) {
        //     e.preventDefault();
        //     var data = $(this).serialize();
        //     $.ajax({
        //         method: $(this).attr('method'),
        //         url: "/hrm/leave-type",
        //         dataType: 'json',
        //         data: data,
        //         success: function(result) {
        //             if (result.success == true) {
        //                 $('div#add_leave_type_modal').modal('hide');
        //                 $('.view_modal').modal('hide');
        //                 toastr.success(result.msg);
        //                 leave_type_table.ajax.reload();
        //                 $('form#add_leave_type_form')[0].reset();
        //             } else {
        //                 toastr.error(result.msg);
        //             }
        //         },
        //     });
        // })

        $(document).on('submit', 'form#add_leave_type_form, form#edit_leave_type_form', function(e) {
            e.preventDefault();

            var form = $(this);
            var data = form.serialize();
            var method = form.attr('method');
            var url = form.attr('action');

            // Ensure the URL is correct based on the form ID
            if (form.attr('id') === 'add_leave_type_form') {
                url = '/hrm/leave-type';
            } else if (form.attr('id') === 'edit_leave_type_form') {
                url: $(this).attr('action');
            }

            console.log("URL: " + url);

            $.ajax({
                type: method,
                url: url,
                dataType: 'json',
                data: data,
                success: function(result) {
                    if (result.success == true) {
                        $('div#add_leave_type_modal').modal('hide');
                        $('.view_modal').modal('hide');
                        toastr.success(result.msg);
                        leave_type_table.ajax.reload();
                        $('form#add_leave_type_form')[0].reset();
                    } else {
                        toastr.error(result.msg);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred: ' + error);
                }
            });
        });
    </script>
@endsection
