@extends('crm::layouts.app')
@section('title', __('restaurant.bookings'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Property Wanted
            <small>Tell what you want</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary', 'title' => __('business.all_your_business_locations')])
            @slot('tool')
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal"
                        data-href="{{ action([\App\Http\Controllers\PropertyWantedCustomerController::class, 'create']) }}"
                        data-container=".property_wanted_add_modal">
                        <i class="fa fa-plus"></i> @lang('messages.add')</button>
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
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent

        <div class="modal fade property_wanted_add_modal" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade property_wanted_edit_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade property_wanted_delete_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Select Sports</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="searchBar" class="form-control" placeholder="Search sports...">
                        <ul id="sportsList" class="list-group">
                            <li class="list-group-item">Football</li>
                            <li class="list-group-item">Basketball</li>
                            <li class="list-group-item">Tennis</li>
                            <li class="list-group-item">Cricket</li>
                            <li class="list-group-item">Baseball</li>
                            <li class="list-group-item">Hockey</li>
                            <li class="list-group-item">Soccer</li>
                            <li class="list-group-item">Golf</li>
                            <li class="list-group-item">Badminton</li>
                            <li class="list-group-item">Volleyball</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button id="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
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
                ajax: '/contact/property-wanted',
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
                            var statusText = data == 1 ? 'Active' : 'Inactive';
                            var badgeStyle = data == 1 ? 'background-color: green; color: white;' :
                                'background-color: red; color: white;';
                            return '<span class="badge" style="' + badgeStyle + '">' + statusText +
                                '</span>';
                        }
                    },
                    {
                        data: 'reference_id',
                        name: 'reference_id'
                    },

                    {
                        data: 'child_category_name',
                        name: 'child_category_name'
                    },
                ]
            });
        });


        $(document).ready(function() {
            $(document).on('click', '#openModal', function() {
                $('#myModal').css('display', 'block');
                $('#myModal').modal('show');
            });

            // Close the modal
            $('.close').click(function() {
                $('#myModal').modal('hide');
            });

            // Submit button click event
            $('#submit').click(function() {
                // Get the selected sports
                var selectedSports = [];
                $('#sportsList .list-group-item.active').each(function() {
                    selectedSports.push($(this).text());
                });
                console.log(selectedSports)
                // Display the selected sports in the UI
                $('#selectedSports').html('Selected Sports: ' + selectedSports.join(', '));
                var inputField = $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'selectedSports')
                    .val(JSON.stringify(selectedSports));
                $('#property_wanted_form').append(inputField);


                // Hide the modal
                $('#myModal').css('display', 'none');
                $('.modal-backdrop.fade.in').eq(1).remove();
            });

            // Deleteing Property Started
            $(document).on('click', '#property_wanted_delete_btn', function() {
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

            // Editing property started
            $(document).on('click', '#property_wanted_edit_btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "/contact/show-property-edit-modal",
                    type: "get",
                    data: {
                        id: id
                    },
                    dataType: "html",
                    success: function(html) {
                        $('.property_wanted_edit_modal').empty();
                        $('.property_wanted_edit_modal').html(html);
                        $('.property_wanted_edit_modal').modal('show');
                    }
                })
            })
        })
    </script>
@endsection
