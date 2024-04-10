@extends('layouts.app')
@section('title', 'Withdraw')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Withdraw
            <small>Take your money back</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="nav-tabs-custom">

                    <div class="tab-content">
                        <div class="tab-pane active" id="other_accounts">
                            <div class="row">
                                <div class="col-md-12">
                                    @component('components.widget')
                                        <div class="col-md-4">
                                        </div>
                                        <div class="col-md-8">
                                            <button type="button" class="btn btn-primary pull-right add_withdraw_request">
                                                <i class="fa fa-plus"></i> @lang('messages.add')</button>
                                        </div>
                                    @endcomponent
                                </div>
                                <div class="col-sm-12">
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="withdraws">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>BusinessID</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    @include('withdraw.modal')
@endsection

@section('javascript')
    <script>
        function getusers(name = null, email = null, phone = null) {
            var table = jQuery('#withdraws').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('account.withdraw.superadmin.list') }}",
                    type: 'GET',
                    data: {
                        'name': name,
                        'email': email,
                        'phone': phone
                    },
                },
                aLengthMenu: [
                    [25, 50, 100, 500, 5000, -1],
                    [25, 50, 100, 500, 5000, "All"]
                ],
                iDisplayLength: 25,
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                        "className": "text-center"
                    },
                    {
                        data: 'business_id',
                        name: 'business_id'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        "className": "text-center w-10"
                    },
                ]
            });

            table.on('draw.dt', function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            });
        }
        getusers();

        $(document).ready(function() {
            $(document).on('click', '.add_withdraw_request', function() {
                $.ajax({
                    url: "{{ route('account.withdraw.add.request') }}",
                    type: "get",
                    dataType: "json",
                    success: function(data) {
                        if (data.success) {
                            $('#withdraw_modal').html(data.html);
                            $('#withdraw_modal').modal('show');
                        }
                    },
                })
            })

            $(document).on('click', '#request_btn', function(e) {
                e.preventDefault();
                let form = document.getElementById('add_request_form');
                var formData = new FormData(form);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('account.withdraw.store.request') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.success) {
                            swal({
                                title: data.message,
                                icon: "success",
                                buttons: true,
                                dangerMode: true,
                            });
                            $('#withdraws').DataTable().destroy();
                            getusers();
                            $('#withdraw_modal').modal('hide');
                        } else {
                            swal({
                                title: data.message,
                                icon: "error",
                                buttons: true,
                                dangerMode: true,
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorMessage += ('' + value + '<br>');
                        });
                        $('#withdraw_modal .server_side_error').html(
                            '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            errorMessage + '</div>'
                        );
                    },
                })
            })
        });

        $(document).on('click', 'button.activate_account', function() {
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willActivate) => {
                if (willActivate) {
                    var url = $(this).data('url');
                    $.ajax({
                        method: "get",
                        url: url,
                        dataType: "json",
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                capital_account_table.ajax.reload();
                                other_account_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }

                        }
                    });
                }
            });
        });
    </script>
@endsection
