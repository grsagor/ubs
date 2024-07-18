@extends('layouts.app')
@section('title', 'Shop Location')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Shop Location
            <small>Manage your shop location</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary', 'title' => 'All your shop locations'])
            @slot('tool')
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal"
                        data-href="{{ action([\App\Http\Controllers\BusinessLocationController::class, 'create']) }}"
                        data-container=".location_add_modal">
                        <i class="fa fa-plus"></i> @lang('messages.add')</button>
                </div>
            @endslot
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="business_location_table">
                    <thead>
                        <tr>
                            <th>@lang('invoice.name')</th>
                            <th>@lang('lang_v1.location_id')</th>
                            <th>@lang('business.landmark')</th>
                            <th>@lang('business.city')</th>
                            <th>@lang('business.zip_code')</th>
                            <th>@lang('business.state')</th>
                            <th>@lang('business.country')</th>
                            <th>@lang('lang_v1.price_group')</th>
                            <th>@lang('invoice.invoice_scheme')</th>
                            <th>@lang('lang_v1.invoice_layout_for_pos')</th>
                            <th>@lang('lang_v1.invoice_layout_for_sale')</th>
                            <th>@lang('messages.action')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent

        <div class="modal fade location_add_modal" tabindex="-1" role="dialog" data-backdrop="static"
            data-keyboard="false" aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade location_edit_modal" tabindex="-1" role="dialog" data-backdrop="static"
            data-keyboard="false" aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
    <!-- /.content -->

@endsection
@section('javascript')
    <script>
        function categoryChanged() {
            var categoryId = document.getElementById('category_id').value;

            if (categoryId) {
                $.ajax({
                    url: '/get_sub_category/' + categoryId,
                    method: 'GET',
                    success: function(response) {
                        var subcategorySelect = $('#subcategory_id');
                        subcategorySelect.empty();
                        subcategorySelect.append('<option value="">Select</option>');

                        if (response.subcategories.length > 0) {
                            $('#subcategory_required_asterisk').show();
                            $('#subcategory_id').prop('required', true);
                            response.subcategories.forEach(function(subcategory) {
                                var selected = subcategory.id ==
                                    '{{ old('subcategory') ?? ($location->subcategory ?? '') }}' ?
                                    ' selected' : '';
                                subcategorySelect.append('<option value="' + subcategory.id + '"' +
                                    selected + '>' +
                                    subcategory.name + '</option>');
                            });
                        } else {
                            $('#subcategory_required_asterisk').hide();
                            $('#subcategory_id').prop('required', false);
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching subcategories:', error);
                    }
                });
            } else {
                $('#subcategory_id').empty();
                $('#subcategory_id').append('<option value="">Select</option>');
                $('#subcategory_required_asterisk').hide();
                $('#subcategory_id').prop('required', false);
            }
        }

        // Call categoryChanged on page load if a category is already selected (for edit page)
        $(document).ready(function() {
            if ($('#category_id').val()) {
                console.log('Hello');
                categoryChanged();
            }
        });
    </script>
@endsection
