@extends('layouts.app')
@section('title', 'Resell Product')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Resell Product
            <small>Resell others products</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary', 'title' => __('business.all_your_business_locations')])
            @slot('tool')
                {{-- <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus"></i> @lang('messages.add')</button>
                </div> --}}
            @endslot
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="resell_product_table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Custom Field 1</th>
                            <th>Custom Field 2</th>
                            <th>Custom Field 3</th>
                            <th>Custom Field 4</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent

        <div class="modal fade location_add_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade location_edit_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
    <!-- /.content -->


    <!-- Modal -->
    <div class="modal fade" id="resell_product_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="resell_product_modal_form_container">

        </div>
    </div>
@endsection
@section('javascript')
    <script>
        business_locations = $('#resell_product_table').DataTable({
            processing: true,
            serverSide: true,
            bPaginate: false,
            buttons: [],
            ajax: '/resell-product',
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'sku',
                    name: 'sku'
                },
                {
                    data: 'product_custom_field1',
                    name: 'product_custom_field1'
                },
                {
                    data: 'product_custom_field2',
                    name: 'product_custom_field2'
                },
                {
                    data: 'product_custom_field3',
                    name: 'product_custom_field3'
                },
                {
                    data: 'product_custom_field4',
                    name: 'product_custom_field4'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $(document).ready(function() {
            $(document).on('click', '.resell_product_button', function() {
                var value = $(this).data('id');
                $.ajax({
                    url: "/resell_product_modal",
                    type: "get",
                    data: {
                        value: value
                    },
                    dataType: "html",
                    success: function(html) {
                        $('#resell_product_modal #resell_product_modal_form_container').empty();
                        $('#resell_product_modal #resell_product_modal_form_container').html(
                            html);
                        $('#resell_product_modal').modal('show');
                    }
                })
            });

            $(document).on('input', '#amount', function() {
                var max = $('#max_discount').val();
                var value = $(this).val();
                if (value > max) {
                    $('#save__btn').prop('disabled', true);
                    $('#amount_error').show();
                } else {
                    $('#save__btn').prop('disabled', false);
                    $('#amount_error').hide();
                }
            })
        })
    </script>
@endsection
