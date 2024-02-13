$data['menu'] = News::query()->active()->orderBy('id', 'asc')->where('type', '<>', 'Footer')->get();
    @extends('layouts.app')
    @section('title', 'Shop Sharing')

    @section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Shop Share
                <small>Share any shops from here</small>
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
                            data-href="{{ action([\App\Http\Controllers\BusinessLocationController::class, 'create']) }}"
                            data-container=".location_add_modal">
                            <i class="fa fa-plus"></i> @lang('messages.add')</button>
                    </div>
                @endslot
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="shop_share_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            <<<<<<< HEAD @endslot <div class="table-responsive">
                <table class="table table-bordered table-striped" id="shop_share_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location ID</th>
                            <th>Building</th>
                            <th>City</th>
                            <th>Post Code</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
                =======
            @endcomponent

            <div class="modal fade location_add_modal" tabindex="-1" role="dialog"
                aria-labelledby="gridSystemModalLabel">
            </div>
            <div class="modal fade location_edit_modal" tabindex="-1" role="dialog"
                aria-labelledby="gridSystemModalLabel">
                >>>>>>> main
            </div>

    </section>
    <!-- /.content -->

    <<<<<<< HEAD <!-- Shop Share Modal -->
        <div class="modal fade" id="shopShareModal" tabindex="-1" role="dialog" aria-labelledby="shopShareModalLabel">

        </div>

        </section>
        <!-- /.content -->
    @endsection
    @section('javascript')
        <script>
            $(document).ready(function() {
                business_locations = $('#shop_share_table').DataTable({
                    processing: true,
                    serverSide: true,
                    bPaginate: false,
                    buttons: [],
                    ajax: '/shop-share',
                    columns: [{
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'location_id',
                            name: 'location_id'
                        },
                        {
                            data: 'landmark',
                            name: 'landmark'
                        },
                        {
                            data: 'city',
                            name: 'city'
                        },
                        {
                            data: 'zip_code',
                            name: 'zip_code'
                        },
                        {
                            data: 'state',
                            name: 'state'
                        },
                        {
                            data: 'country',
                            name: 'country'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                console.log('working')
                $(document).on('click', '.shop_share_modal_open_btn', function() {
                    var id = $(this).data('id');
                    console.log('clicked');
                    $.ajax({
                        url: "{{ route('shop.share.open.modal') }}",
                        type: "GET",
                        data: {
                            id: id
                        },
                        dataType: "html",
                        success: function(html) {
                            $('#shopShareModal').html(html);
                            $('#shopShareModal').modal('show');
                        }
                    })
                })
            })
        </script>
    @endsection
    =======
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            business_locations = $('#shop_share_table').DataTable({
                processing: true,
                serverSide: true,
                bPaginate: false,
                buttons: [],
                ajax: '/shop-share',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
>>>>>>> main
