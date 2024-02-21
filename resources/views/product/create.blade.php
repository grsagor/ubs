@extends('layouts.app')
@section('title', __('product.product_service'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add New</h1>
        <!-- <ol class="breadcrumb">
                                                                                                                                                                                                                                                                                                                                                                                                                                            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                            <li class="active">Here</li>
                                                                                                                                                                                                                                                                                                                                                                                                                                        </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
        @php
            $form_class = empty($duplicate_product) ? 'create' : '';
            $is_image_required = !empty($common_settings['is_product_image_required']);
        @endphp
        {!! Form::open([
            'url' => action([\App\Http\Controllers\ProductController::class, 'store']),
            'method' => 'post',
            'id' => 'product_add_form',
            'class' => 'product_form ' . $form_class,
            'files' => true,
        ]) !!}
        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('name', __('product.type') . ':*') !!}
                        {!! Form::select(
                            'types',
                            ['product' => 'Product', 'service' => 'Service'],
                            !empty($duplicate_product->type) ? $duplicate_product->type : null,
                            ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'required', 'id' => 'type'],
                        ) !!}

                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('barcode_type', __('product.barcode_type') . ':*') !!}
                        {!! Form::select(
                            'barcode_type',
                            $barcode_types,
                            !empty($duplicate_product->barcode_type) ? $duplicate_product->barcode_type : $barcode_default,
                            ['class' => 'form-control select2', 'required'],
                        ) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('sku', __('product.sku') . ':') !!} @show_tooltip(__('tooltip.sku'))
                        {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => __('product.sku')]) !!}
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('unit_id', __('product.unit') . ':*') !!}
                        <div class="input-group">
                            {!! Form::select(
                                'unit_id',
                                $units,
                                !empty($duplicate_product->unit_id) ? $duplicate_product->unit_id : session('business.default_unit'),
                                ['class' => 'form-control select2', 'required'],
                            ) !!}
                            <span class="input-group-btn">
                                <button type="button" @if (!auth()->user()->can('unit.create')) disabled @endif
                                    class="btn btn-default bg-white btn-flat btn-modal"
                                    data-href="{{ action([\App\Http\Controllers\UnitController::class, 'create'], ['quick_add' => true]) }}"
                                    title="@lang('unit.add_unit')" data-container=".view_modal"><i
                                        class="fa fa-plus-circle text-primary fa-lg"></i></button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 @if (!session('business.enable_sub_units')) hide @endif">
                    <div class="form-group">
                        {!! Form::label('sub_unit_ids', __('lang_v1.related_sub_units') . ':') !!} @show_tooltip(__('lang_v1.sub_units_tooltip'))

                        {!! Form::select(
                            'sub_unit_ids[]',
                            [],
                            !empty($duplicate_product->sub_unit_ids) ? $duplicate_product->sub_unit_ids : null,
                            ['class' => 'form-control select2', 'multiple', 'id' => 'sub_unit_ids'],
                        ) !!}
                    </div>
                </div>
                @if (!empty($common_settings['enable_secondary_unit']))
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('secondary_unit_id', __('lang_v1.secondary_unit') . ':') !!} @show_tooltip(__('lang_v1.secondary_unit_help'))
                            {!! Form::select(
                                'secondary_unit_id',
                                $units,
                                !empty($duplicate_product->secondary_unit_id) ? $duplicate_product->secondary_unit_id : null,
                                ['class' => 'form-control select2'],
                            ) !!}
                        </div>
                    </div>
                @endif

                <div class="col-sm-4 @if (!session('business.enable_brand')) hide @endif">
                    <div class="form-group">
                        {!! Form::label('brand_id', __('product.brand') . ':') !!}
                        <div class="input-group">
                            {!! Form::select(
                                'brand_id',
                                $brands,
                                !empty($duplicate_product->brand_id) ? $duplicate_product->brand_id : null,
                                ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2'],
                            ) !!}
                            <span class="input-group-btn">
                                <button type="button" @if (!auth()->user()->can('brand.create')) disabled @endif
                                    class="btn btn-default bg-white btn-flat btn-modal"
                                    data-href="{{ action([\App\Http\Controllers\BrandController::class, 'create'], ['quick_add' => true]) }}"
                                    title="@lang('brand.add_brand')" data-container=".view_modal"><i
                                        class="fa fa-plus-circle text-primary fa-lg"></i></button>
                            </span>
                        </div>
                    </div>
                </div>

                @php
                    $default_location = null;
                    if (count($business_locations) == 1) {
                        $default_location = array_key_first($business_locations->toArray());
                    }
                @endphp

                <div class="clearfix"></div>

                <div class="col-sm-4 @if (!session('business.enable_category')) hide @endif">
                    <div class="form-group">
                        {!! Form::label('category_id', __('product.category') . ':') !!}
                        {!! Form::select(
                            'category_id',
                            $categories,
                            !empty($duplicate_product->category_id) ? $duplicate_product->category_id : null,
                            ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'id' => 'categoryy_id'],
                        ) !!}
                    </div>
                </div>

                <div class="col-sm-4 @if (!(session('business.enable_category') && session('business.enable_sub_category'))) hide @endif">
                    <div class="form-group">
                        {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                        {!! Form::select(
                            'sub_category_id',
                            $sub_categories,
                            !empty($duplicate_product->sub_category_id) ? $duplicate_product->sub_category_id : null,
                            ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2'],
                        ) !!}
                    </div>
                </div>


                <div class="col-sm-4 @if (!(session('business.enable_category') && session('business.enable_sub_category'))) hide @endif">
                    <div class="form-group">
                        <label for="child_category_id">Child Category:</label>
                        <select class="form-control select2" id="child_category_id" name="child_category_id">
                            <option selected="selected" value="">Please Select</option>
                            <option value="127">Pascale Haney-Vero accusantium lau</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('product_locations', __('business.business_locations') . ':') !!} @show_tooltip(__('lang_v1.product_location_help'))
                        {!! Form::select('product_locations[]', $business_locations, $default_location, [
                            'class' => 'form-control select2',
                            'multiple',
                            'id' => 'product_locations',
                        ]) !!}
                    </div>
                </div>

                {{-- @php
                    $default_location = null;
                    if (count($business_locations) == 1) {
                        $default_location = array_key_first($business_locations->toArray());
                    }
                @endphp
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('product_locations', __('business.business_locations') . ':') !!} @show_tooltip(__('lang_v1.product_location_help'))
                        {!! Form::select('product_locations[]', $business_locations, $default_location, [
                            'class' => 'form-control select2',
                            'multiple',
                            'id' => 'product_locations',
                        ]) !!}
                    </div>
                </div> --}}

            </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', __('product.study_time') . ':') !!}
                        {!! Form::select(
                            'study_time',
                            ['Part Time' => 'Part Time', 'Full Time' => 'Full Time'],
                            !empty($duplicate_product->name) ? $duplicate_product->name : null,
                            ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2'],
                        ) !!}
                    </div>
                </div>

                {{-- <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('start_type', 'Starts:') !!}
                        <div class="row">
                            <div class="col-sm-6" id="every-year-div">
                                <div class="form-group">
                                    <label>
                                        {!! Form::checkbox('every_year', 1, !empty($duplicate_product) ? $duplicate_product->every_year : false, [
                                            'class' => 'input-icheck',
                                            'id' => 'every_year',
                                        ]) !!} <strong>Every Year*</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6" id="select-year-div">
                                <div class="form-group">
                                    <label>
                                        {!! Form::checkbox('select_year', 1, !empty($duplicate_product) ? $duplicate_product->select_year : false, [
                                            'class' => 'input-icheck',
                                            'id' => 'select_year',
                                        ]) !!} <strong>Select Year*</strong>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}


                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="row" id="select-year-section">
                            <div class="col-md-6">
                                {!! Form::label('start_type', 'Start years:') !!}
                                <select id="yearSelect" name="selected_years[]" class="form-control select2" multiple>
                                    <option value="every_year">Every Year</option>
                                    @php
                                        $currentYear = date('Y');
                                        $endYear = $currentYear + 5;
                                    @endphp

                                    @for ($year = $currentYear; $year <= $endYear; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('start_type', 'Select Month:') !!}

                                <select id="monthSelect" name="selected_months[]" class="form-control select2" multiple>
                                    {{-- <option disabled value="">Select Month</option> --}}
                                    @php
                                        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                        foreach ($months as $month) {
                                            echo "<option value='$month'>$month</option>";
                                        }
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', __('product.name_of_institution') . ':') !!}
                        {!! Form::text(
                            'name_of_institution',
                            !empty($duplicate_product->name_of_institution) ? $duplicate_product->name_of_institution : null,
                            ['class' => 'form-control', 'placeholder' => __('product.name_of_institution')],
                        ) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', __('product.duration') . ':') !!}
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::select(
                                    'duration_year',
                                    [
                                        '1' => '1',
                                        '2' => '2',
                                        '3' => '3',
                                        '4' => '4',
                                        '5' => '5',
                                    ],
                                    !empty($duplicate_product->duration) ? $duplicate_product->duration : null,
                                    ['class' => 'form-control select2', 'placeholder' => 'Year'],
                                ) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::select(
                                    'duration_month',
                                    [
                                        '1' => '1',
                                        '2' => '2',
                                        '3' => '3',
                                        '4' => '4',
                                        '5' => '5',
                                        '6' => '6',
                                        '7' => '7',
                                        '8' => '8',
                                        '9' => '9',
                                        '10' => '10',
                                        '11' => '11',
                                        '12' => '12',
                                    ],
                                    !empty($duplicate_product->duration) ? $duplicate_product->duration : null,
                                    ['class' => 'form-control select2', 'placeholder' => 'Month'],
                                ) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('name', __('product.tuition_fees') . ':') !!}
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::number(
                                    'home_students_fees',
                                    !empty($duplicate_product->home_students_fees) ? $duplicate_product->home_students_fees : null,
                                    ['class' => 'form-control', 'placeholder' => __('product.home_students_fees')],
                                ) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::number(
                                    'int_students_fees',
                                    !empty($duplicate_product->int_students_fees) ? $duplicate_product->int_students_fees : null,
                                    ['class' => 'form-control', 'placeholder' => __('product.int_students_fees')],
                                ) !!}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('tuition_fee_installment', __('product.tuition_fee_installment') . ':') !!}
                        {!! Form::select(
                            'tuition_fee_installment',
                            ['Available' => 'Available', 'Unavailable' => 'Unavailable'],
                            !empty($duplicate_product->tuition_fee_installment) ? $duplicate_product->tuition_fee_installment : null,
                            [
                                'placeholder' => __('messages.please_select'),
                                'id' => 'fee_installment',
                                'class' => 'form-control select2',
                            ],
                        ) !!}
                    </div>
                </div>

                <div class="col-sm-8 hide" id="fee-installment-description-section">
                    <div class="form-group">
                        {!! Form::label('fee_installment_description', __('product.fee_installment_description') . ':') !!}
                        {!! Form::textarea(
                            'fee_installment_description',
                            !empty(@$duplicate_product->fee_installment_description) ? @$duplicate_product->fee_installment_description : null,
                            ['class' => 'form-control'],
                        ) !!}
                    </div>
                </div>
                <div class="clearfix hide" id="fee-installment-description-clearfix"></div>


            </div>
        @endcomponent


        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('name', __('product.work_placement') . ':') !!}
                        {!! Form::select(
                            'work_placement',
                            ['Available' => 'Available', 'Unavailable' => 'Unavailable'],
                            !empty($duplicate_product->work_placement) ? $duplicate_product->work_placement : null,
                            [
                                'placeholder' => __('messages.please_select'),
                                'id' => 'work_placement',
                                'class' => 'form-control select2',
                                'required',
                            ],
                        ) !!}
                    </div>
                </div>
                <div class="col-sm-8 hide" id="work-placement-description-section">
                    <div class="form-group">
                        {!! Form::label('work_placement_description', __('product.work_placement_description') . ':') !!}
                        {!! Form::textarea(
                            'work_placement_description',
                            !empty(@$duplicate_product->work_placement_description) ? @$duplicate_product->work_placement_description : null,
                            ['class' => 'form-control'],
                        ) !!}
                    </div>
                </div>
                <div class="clearfix hide" id="work-placement-description-clearfix"></div>

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('general_facilities', __('lang_v1.general_facilities') . ':') !!}
                        {!! Form::textarea(
                            'general_facilities',
                            !empty($duplicate_product->general_facilities) ? $duplicate_product->general_facilities : null,
                            ['class' => 'form-control'],
                        ) !!}
                    </div>
                </div>

            </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
            <div id="requirements-container">
                <!-- Initial requirements section -->
                <div class="row requirements-section">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('requirement', __('product.requirements') . ':') !!}
                            {{-- {!! Form::select(
                                'requirements',
                                [
                                    'English Language' => 'English Language',
                                    'Education' => 'Education',
                                    'General Requirements' => 'General Requirements',
                                ],
                                null,
                                ['placeholder' => __('messages.please_select'), 'class' => 'form-control requirement-select'],
                            ) !!} --}}

                            {!! Form::text(
                                'requirements',
                                !empty($duplicate_product->requirements) ? $duplicate_product->requirements : null,
                                ['class' => 'form-control', 'placeholder' => __('Name of reqirements')],
                            ) !!}
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            {!! Form::label('requirement_details', __('product.requirement_details') . ':') !!}
                            {!! Form::textarea(
                                'requirement_details',
                                !empty($duplicate_product->requirement_details) ? $duplicate_product->requirement_details : null,
                                ['class' => 'form-control requirement_details', 'id' => 'requirement_details'],
                            ) !!}
                            {{-- {!! Form::textarea('requirement_details[]', null, ['class' => 'form-control']); !!} --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="align-right">
                <button id="addRequirement" type="button" class="btn-success">Add</button>
                <button id="removeRequirement" type="button" class="btn-danger hide">Remove</button>
            </div>
        @endcomponent


        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">

                @if (!empty($common_settings['enable_product_warranty']))
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('warranty_id', __('lang_v1.warranty') . ':') !!}
                            {!! Form::select('warranty_id', $warranties, null, [
                                'class' => 'form-control select2',
                                'placeholder' => __('messages.please_select'),
                            ]) !!}
                        </div>
                    </div>
                @endif

                <div class="clearfix"></div>

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('name', __('Title') . ':*') !!}
                        {!! Form::text('name', !empty($duplicate_product->name) ? $duplicate_product->name : null, [
                            'class' => 'form-control',
                            'required',
                            'placeholder' => __('product.product_name'),
                        ]) !!}
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('product_description', __('Description') . ':') !!}
                        {!! Form::textarea(
                            'product_description',
                            !empty($duplicate_product->product_description) ? $duplicate_product->product_description : null,
                            ['class' => 'form-control'],
                        ) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('image', __('Image') . ':') !!}
                        {!! Form::file('image[]', [
                            'id' => 'upload_image',
                            'accept' => 'image/*',
                            'required' => $is_image_required,
                            'class' => 'upload-element',
                            'multiple',
                        ]) !!}
                        <small>
                            <p class="help-block">@lang('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]) <br> @lang('lang_v1.aspect_ratio_should_be_1_1')</p>
                        </small>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('image', __('Thumbnail') . ':') !!}
                        {!! Form::file('thumbnail', [
                            'id' => 'thumbnail_image',
                            'accept' => 'image/*',
                            'required' => $is_image_required,
                            'class' => 'upload-element',
                        ]) !!}
                        <small>
                            <p class="help-block">@lang('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]) <br> @lang('lang_v1.aspect_ratio_should_be_1_1')</p>
                        </small>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('product_brochure', __('Brochure') . ':') !!}
                        {!! Form::file('product_brochure', [
                            'id' => 'brochure_image',
                            'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types'))),
                        ]) !!}
                        <small>
                            <p class="help-block">
                                @lang('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000])
                                @includeIf('components.document_help_text')
                            </p>
                        </small>
                    </div>
                </div>

                <!-- include module fields -->
                @if (!empty($pos_module_data))
                    @foreach ($pos_module_data as $key => $value)
                        @if (!empty($value['view_path']))
                            @includeIf($value['view_path'], ['view_data' => $value['view_data']])
                        @endif
                    @endforeach
                @endif

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('youtube_link', __('product.youtube_link') . ':*') !!}
                        {!! Form::text(
                            'youtube_link',
                            !empty($duplicate_product->youtube_link) ? $duplicate_product->youtube_link : null,
                            ['class' => 'form-control', 'placeholder' => __('product.youtube_link')],
                        ) !!}
                    </div>
                </div>
            </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('service_features', __('product.service_features') . ':') !!}
                        {!! Form::textarea(
                            'service_features',
                            !empty($duplicate_product->service_features) ? $duplicate_product->service_features : null,
                            ['class' => 'form-control'],
                        ) !!}
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('experiences', __('product.experiences') . ':') !!}
                        {!! Form::textarea(
                            'experiences',
                            !empty($duplicate_product->experiences) ? $duplicate_product->experiences : null,
                            ['class' => 'form-control'],
                        ) !!}
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('specializations', __('product.specializations') . ':') !!}
                        {!! Form::textarea(
                            'specializations',
                            !empty($duplicate_product->specializations) ? $duplicate_product->specializations : null,
                            ['class' => 'form-control'],
                        ) !!}
                    </div>
                </div>
                {{-- @if (!empty($common_settings['enable_product_warranty']))
             <div class="col-sm-6">
                 <div class="form-group">
                     {!! Form::label('warranty_id', __('lang_v1.warranty') . ':') !!}
                     {!! Form::select('warranty_id', $warranties, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); !!}
                 </div>
             </div>
             @endif --}}
            </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">

                <div class="col-sm-4 @if (!session('business.enable_price_tax')) hide @endif">
                    <div class="form-group">
                        {!! Form::label('tax', __('product.applicable_tax') . ':') !!}
                        {!! Form::select(
                            'tax',
                            $taxes,
                            !empty($duplicate_product->tax) ? $duplicate_product->tax : null,
                            ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2'],
                            $tax_attributes,
                        ) !!}
                    </div>
                </div>

                <div class="col-sm-4 @if (!session('business.enable_price_tax')) hide @endif">
                    <div class="form-group">
                        {!! Form::label('tax_type', __('product.selling_price_tax_type') . ':*') !!}
                        {!! Form::select(
                            'tax_type',
                            ['Inclusive' => __('product.inclusive'), 'Exclusive' => __('product.exclusive')],
                            !empty($duplicate_product->tax_type) ? $duplicate_product->tax_type : 'exclusive',
                            ['class' => 'form-control select2', 'required'],
                        ) !!}
                    </div>
                </div>

                <div class="clearfix"></div>

                {{-- <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('type', __('product.product_type') . ':*') !!} @show_tooltip(__('tooltip.product_type'))
                        {!! Form::select('type', $product_types, !empty($duplicate_product->type) ? $duplicate_product->type : null, [
                            'class' => 'form-control select2',
                            'required',
                            'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add',
                            'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0',
                        ]) !!}
                    </div>
                </div> --}}
                <input type="hidden" name="type" value="single">

                <div class="form-group col-sm-12" id="product_form_part">
                    @include('product.partials.single_product_form_part', [
                        'profit_percent' => $default_profit_percent,
                    ])
                </div>

                <input type="hidden" id="variation_counter" value="1">
                <input type="hidden" id="default_profit_percent" value="{{ $default_profit_percent }}">

            </div>
        @endcomponent


        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>
                            {!! Form::checkbox(
                                'disable_reselling',
                                1,
                                !empty($duplicate_product) ? $duplicate_product->disable_reselling : false,
                                ['class' => 'input-icheck'],
                            ) !!} <strong>@lang('product.disable_reselling')</strong>
                        </label> @show_tooltip(__('product.disable_reselling_info'))
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('price_changeable', __('product.price_changeable') . ':*') !!}
                        {!! Form::select(
                            'price_changeable',
                            ['1' => 'Yes', '0' => 'No'],
                            !empty($duplicate_product->price_changeable) ? $duplicate_product->price_changeable : null,
                            ['class' => 'form-control', 'required', 'placeholder' => __('messages.please_select')],
                        ) !!}
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('reselling_price', __('product.reselling_commission_type') . ':*') !!}
                        {!! Form::select('reselling_price', ['Percentage' => 'Percentage', 'Fixed' => 'Fixed'], null, [
                            'class' => 'form-control select2',
                            'required',
                            'placeholder' => __('messages.please_select'),
                        ]) !!}
                    </div>
                </div>

                <div class="col-sm-4" id="resellingCommissionAmountFixedSection">
                    <div class="form-group">
                        {!! Form::label('reselling_commission_amount', __('product.reselling_commission_amount') . ':') !!}
                        {!! Form::text(
                            'reselling_commission_amount',
                            !empty($duplicate_product->reselling_commission_amount) ? $duplicate_product->reselling_commission_amount : null,
                            [
                                'class' => 'form-control',
                                'required',
                                'placeholder' => __('product.reselling_commission_amount'),
                                'id' => 'resellingCommissionAmountFixed',
                            ],
                        ) !!}
                    </div>
                </div>

                <div class="col-sm-4 hide" id="resellingCommissionAmountPercentageSection">
                    <div class="form-group">
                        {!! Form::label('reselling_commission_amount', __('product.reselling_commission_amount_percentage') . ' :') !!}
                        {!! Form::select(
                            'reselling_commission_amount',
                            range(0, 100),
                            !empty($duplicate_product->reselling_commission_amount) ? $duplicate_product->reselling_commission_amount : null,
                            [
                                'class' => 'form-control',
                                'required',
                                'placeholder' => __('product.reselling_commission_amount'),
                                'id' => 'resellingCommissionAmountPercentage',
                            ],
                        ) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('extra_commission', __('product.extra_commission') . ':') !!}
                        {!! Form::number(
                            'extra_commission',
                            !empty($duplicate_product->extra_commission) ? $duplicate_product->extra_commission : null,
                            ['class' => 'form-control', 'required', 'placeholder' => __('product.extra_commission')],
                        ) !!}
                    </div>
                </div>
            </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('delivery_mode', __('product.delivery_mode') . ':*') !!}
                        {!! Form::select('delivery_mode', ['Online', 'Offline', 'Online & Offline'], null, [
                            'class' => 'form-control select2',
                            'placeholder' => __('messages.please_select'),
                        ]) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('delivery_area', __('product.delivery_area') . ':*') !!}
                        {!! Form::select('delivery_area', ['National' => 'National', 'International' => 'International'], null, [
                            'class' => 'form-control select2',
                            'id' => 'delivery_area',
                            'placeholder' => __('messages.please_select'),
                        ]) !!}
                    </div>
                </div>
                <div class="col-sm-4 hide" id="delivery_cities_section">
                    <div class="form-group">
                        {!! Form::label('delivery_cities', __('product.delivery_cities') . ':*') !!}
                        {!! Form::select('delivery_cities', ['All Cities' => 'All Cities', 'London' => 'London'], null, [
                            'class' => 'form-control',
                            'id' => 'delivery_cities',
                            'placeholder' => __('messages.please_select'),
                        ]) !!}
                    </div>
                </div>

                <div class="col-sm-4 hide" id="delivery_countries_section">
                    <div class="form-group">
                        {!! Form::label('delivery_countries', __('product.delivery_countries') . ':*') !!}
                        {!! Form::select('delivery_countries', ['All Countries' => 'All Countries', 'UK' => 'UK'], null, [
                            'class' => 'form-control',
                            'id' => 'delivery_countries',
                            'placeholder' => __('messages.please_select'),
                        ]) !!}
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="col-sm-4 hide" id="delivery_cities_excluded_section">
                    <div class="form-group">
                        {!! Form::label('delivery_excluded_cities', __('product.delivery_excluded_cities') . ':*') !!}
                        {!! Form::select(
                            'delivery_excluded_cities',
                            ['London' => 'London', 'Manchester' => 'Manchester'],
                            !empty($product->reselling_commission_amount) ? $product->reselling_commission_amount : null,
                            ['class' => 'form-control', 'id' => 'delivery_excluded_cities', 'placeholder' => __('messages.please_select')],
                        ) !!}
                    </div>
                </div>

                <div class="col-sm-4 hide" id="delivery_countries_excluded_section">
                    <div class="form-group">
                        {!! Form::label('delivery_excluded_countries', __('product.delivery_excluded_countries') . ':*') !!}
                        {!! Form::select(
                            'delivery_excluded_countries',
                            ['UK' => 'UK', 'Bangladesh' => 'Bangladesh'],
                            !empty($product->reselling_commission_amount) ? $product->reselling_commission_amount : null,
                            ['class' => 'form-control', 'id' => 'delivery_excluded_countries', 'placeholder' => __('messages.please_select')],
                        ) !!}
                    </div>
                </div>

                <div class="col-sm-4 hide" id="delivery_countries_excluded_cities_section">
                    <div class="form-group">
                        {!! Form::label('delivery_countries_excluded_cities', __('product.delivery_excluded_cities') . ':*') !!}
                        {!! Form::select(
                            'delivery_countries_excluded_cities',
                            ['London' => 'London', 'Dhaka' => 'Dhaka'],
                            !empty($product->reselling_commission_amount) ? $product->reselling_commission_amount : null,
                            [
                                'class' => 'form-control',
                                'id' => 'delivery_countries_excluded_cities',
                                'placeholder' => __('messages.please_select'),
                            ],
                        ) !!}
                    </div>
                </div>

                <div class="col-sm-4 hide" id="delivery_area_national_section">
                    <div class="form-group">
                        {!! Form::label('delivery_area', __('product.area_specification') . ':*') !!}
                        <select class="form-control select2" name="delivery_area_wise[]" multiple
                            id="deliveryAreaWiseNational">
                            <option disabled selected value="">Please Select</option>
                            <option value="London"> London </option>
                            <option value="Manchester"> Manchester </option>
                            <option value="Birmingham"> Birmingham </option>
                            <option value="Edinburgh"> Edinburgh </option>
                            <option value="Glasgow"> Glasgow </option>
                            <option value="Liverpool"> Liverpool </option>
                            <option value="Bristol"> Bristol </option>
                            <option value="Newcastle"> Newcastle </option>
                            <option value="Cardiff"> Cardiff </option>
                            <option value="Belfast"> Belfast </option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4 hide" id="delivery_area_international_section">
                    <div class="form-group">
                        {!! Form::label('delivery_area', __('product.area_specification') . ':*') !!}
                        <select class="form-control select2" name="delivery_area_wise[]" multiple
                            id="deliveryAreaWiseInternational">
                            <option disabled selected value="">Please Select</option>
                            <option value="London" disabled> United Kingdom </option>
                            <option value="Manchester" disabled> Bangladesh </option>
                        </select>
                    </div>
                </div>
            </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">
                @if (session('business.enable_product_expiry'))
                    @if (session('business.expiry_type') == 'add_expiry')
                        @php
                            $expiry_period = 12;
                            $hide = true;
                        @endphp
                    @else
                        @php
                            $expiry_period = null;
                            $hide = false;
                        @endphp
                    @endif
                    <div class="col-sm-4 @if ($hide) hide @endif">
                        <div class="form-group">
                            <div class="multi-input">
                                {!! Form::label('expiry_period', __('product.expires_in') . ':') !!}<br>
                                {!! Form::text(
                                    'expiry_period',
                                    !empty($duplicate_product->expiry_period) ? @num_format($duplicate_product->expiry_period) : $expiry_period,
                                    [
                                        'class' => 'form-control pull-left input_number',
                                        'placeholder' => __('product.expiry_period'),
                                        'style' => 'width:60%;',
                                    ],
                                ) !!}
                                {!! Form::select(
                                    'expiry_period_type',
                                    ['months' => __('product.months'), 'days' => __('product.days'), '' => __('product.not_applicable')],
                                    !empty($duplicate_product->expiry_period_type) ? $duplicate_product->expiry_period_type : 'months',
                                    ['class' => 'form-control select2 pull-left', 'style' => 'width:40%;', 'id' => 'expiry_period_type'],
                                ) !!}
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-sm-4">
                    <div class="form-group">
                        <br>
                        <label>
                            {!! Form::checkbox('enable_sr_no', 1, !empty($duplicate_product) ? $duplicate_product->enable_sr_no : false, [
                                'class' => 'input-icheck',
                            ]) !!} <strong>@lang('lang_v1.enable_imei_or_sr_no')</strong>
                        </label> @show_tooltip(__('lang_v1.tooltip_sr_no'))
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <br>
                        <label>
                            {!! Form::checkbox(
                                'not_for_selling',
                                1,
                                !empty($duplicate_product) ? $duplicate_product->not_for_selling : false,
                                ['class' => 'input-icheck'],
                            ) !!} <strong>@lang('lang_v1.not_for_selling')</strong>
                        </label> @show_tooltip(__('lang_v1.tooltip_not_for_selling'))
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>
                            {!! Form::checkbox('enable_stock', 1, !empty($duplicate_product) ? $duplicate_product->enable_stock : true, [
                                'class' => 'input-icheck',
                                'id' => 'enable_stock',
                            ]) !!} <strong>@lang('product.manage_stock')</strong>
                        </label>@show_tooltip(__('tooltip.enable_stock')) <p class="help-block"><i>@lang('product.enable_stock_help')</i></p>
                    </div>
                </div>
                <div class="col-sm-4 @if (!empty($duplicate_product) && $duplicate_product->enable_stock == 0) hide @endif" id="alert_quantity_div">
                    <div class="form-group">
                        {!! Form::label('alert_quantity', __('product.alert_quantity') . ':') !!} @show_tooltip(__('tooltip.alert_quantity'))
                        {!! Form::text(
                            'alert_quantity',
                            !empty($duplicate_product->alert_quantity) ? @format_quantity($duplicate_product->alert_quantity) : null,
                            ['class' => 'form-control input_number', 'placeholder' => __('product.alert_quantity'), 'min' => '0'],
                        ) !!}
                    </div>
                </div>

                <!-- Rack, Row & position number -->

                <div id="rack_details">
                    @if (session('business.enable_racks') || session('business.enable_row') || session('business.enable_position'))
                        <div class="col-md-12">
                            <h4>@lang('lang_v1.rack_details'):
                                @show_tooltip(__('lang_v1.tooltip_rack_details'))
                            </h4>
                        </div>
                        @foreach ($business_locations as $id => $location)
                            <div class="col-sm-3">
                                <div class="form-group">
                                    {!! Form::label('rack_' . $id, $location . ':') !!}

                                    @if (session('business.enable_racks'))
                                        {!! Form::text(
                                            'product_racks[' . $id . '][rack]',
                                            !empty($rack_details[$id]['rack']) ? $rack_details[$id]['rack'] : null,
                                            ['class' => 'form-control', 'id' => 'rack_' . $id, 'placeholder' => __('lang_v1.rack')],
                                        ) !!}
                                    @endif

                                    @if (session('business.enable_row'))
                                        {!! Form::text(
                                            'product_racks[' . $id . '][row]',
                                            !empty($rack_details[$id]['row']) ? $rack_details[$id]['row'] : null,
                                            ['class' => 'form-control', 'placeholder' => __('lang_v1.row')],
                                        ) !!}
                                    @endif

                                    @if (session('business.enable_position'))
                                        {!! Form::text(
                                            'product_racks[' . $id . '][position]',
                                            !empty($rack_details[$id]['position']) ? $rack_details[$id]['position'] : null,
                                            ['class' => 'form-control', 'placeholder' => __('lang_v1.position')],
                                        ) !!}
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('weight', __('lang_v1.weight') . ':') !!}
                        {!! Form::text('weight', !empty($duplicate_product->weight) ? $duplicate_product->weight : null, [
                            'class' => 'form-control',
                            'placeholder' => __('lang_v1.weight'),
                        ]) !!}
                    </div>
                </div>
                @php
                    $custom_labels = json_decode(session('business.custom_labels'), true);
                    $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
                    $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
                    $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
                    $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
                @endphp
                <!--custom fields-->
                <div class="clearfix"></div>
                <div class="col-sm-3">
                    <div class="form-group">
                        {!! Form::label('product_custom_field1', $product_custom_field1 . ':') !!}
                        {!! Form::text(
                            'product_custom_field1',
                            !empty($duplicate_product->product_custom_field1) ? $duplicate_product->product_custom_field1 : null,
                            ['class' => 'form-control', 'placeholder' => $product_custom_field1],
                        ) !!}
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        {!! Form::label('product_custom_field2', $product_custom_field2 . ':') !!}
                        {!! Form::text(
                            'product_custom_field2',
                            !empty($duplicate_product->product_custom_field2) ? $duplicate_product->product_custom_field2 : null,
                            ['class' => 'form-control', 'placeholder' => $product_custom_field2],
                        ) !!}
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        {!! Form::label('product_custom_field3', $product_custom_field3 . ':') !!}
                        {!! Form::text(
                            'product_custom_field3',
                            !empty($duplicate_product->product_custom_field3) ? $duplicate_product->product_custom_field3 : null,
                            ['class' => 'form-control', 'placeholder' => $product_custom_field3],
                        ) !!}
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        {!! Form::label('product_custom_field4', $product_custom_field4 . ':') !!}
                        {!! Form::text(
                            'product_custom_field4',
                            !empty($duplicate_product->product_custom_field4) ? $duplicate_product->product_custom_field4 : null,
                            ['class' => 'form-control', 'placeholder' => $product_custom_field4],
                        ) !!}
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        {!! Form::label('preparation_time_in_minutes', __('lang_v1.preparation_time_in_minutes') . ':') !!}
                        {!! Form::number(
                            'preparation_time_in_minutes',
                            !empty($duplicate_product->preparation_time_in_minutes) ? $duplicate_product->preparation_time_in_minutes : null,
                            ['class' => 'form-control', 'placeholder' => __('lang_v1.preparation_time_in_minutes')],
                        ) !!}
                    </div>
                </div>
                <!--custom fields-->
                <div class="clearfix"></div>
                @include('layouts.partials.module_form_part')
            </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('policy', __('product.policy') . ':') !!}
                        {!! Form::textarea('policy', !empty($duplicate_product->policy) ? $duplicate_product->policy : null, [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>
                            {!! Form::checkbox(
                                'unipuller_data_policy',
                                1,
                                !empty($duplicate_product) ? $duplicate_product->unipuller_data_policy : false,
                                ['class' => 'input-icheck', 'required'],
                            ) !!}
                        </label>
                        <a href="{{ route('footer.details.policies.privacy_cookies') }}"
                            target="__blank"><strong>@lang('product.unipuller_data_policy')*</strong>
                        </a>
                        @show_tooltip(__('product.unipuller_data_policy'))
                    </div>
                </div>
            </div>
        @endcomponent




        <div class="row">
            <div class="col-sm-12">
                <input type="hidden" name="submit_type" id="submit_type">
                <div class="text-center">
                    <div class="btn-group">
                        @if ($selling_price_group_count)
                            <button type="submit" id="submit_n_add_selling_prices" value="submit_n_add_selling_prices"
                                class="btn btn-warning submit_product_form">@lang('lang_v1.save_n_add_selling_price_group_prices')</button>
                        @endif

                        @can('product.opening_stock')
                            <button id="opening_stock_button" @if (!empty($duplicate_product) && $duplicate_product->enable_stock == 0) disabled @endif
                                type="submit" value="submit_n_add_opening_stock"
                                class="btn bg-purple submit_product_form">@lang('lang_v1.save_n_add_opening_stock')</button>
                        @endcan

                        <button type="submit" value="save_n_add_another"
                            class="btn bg-maroon submit_product_form">@lang('lang_v1.save_n_add_another')</button>

                        <button type="submit" id="save" value="submit"
                            class="btn btn-primary submit_product_form">@lang('messages.save')</button>
                    </div>

                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </section>
    <!-- /.content -->

@endsection

@section('javascript')
    @php $asset_v = env('APP_VERSION'); @endphp
    <script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            __page_leave_confirmation('#product_add_form');
            onScan.attachTo(document, {
                suffixKeyCodes: [13], // enter-key expected at the end of a scan
                reactToPaste: true, // Compatibility to built-in scanners in paste-mode (as opposed to keyboard-mode)
                onScan: function(sCode, iQty) {
                    $('input#sku').val(sCode);
                },
                onScanError: function(oDebug) {
                    console.log(oDebug);
                },
                minLength: 2,
                ignoreIfFocusOn: ['input', '.form-control']
                // onKeyDetect: function(iKeyCode){ // output all potentially relevant key events - great for debugging!
                //     console.log('Pressed: ' + iKeyCode);
                // }
            });

            /*$("#selectYearCheckbox").change(function() {
                if ($(this).is(":checked")) {
                    $("#monthSelect").show();
                    alert('HI');
                } else {
                    $("#monthSelect").hide();
                }
            });*/

            $(document).on('change', '#is_discount', function() {
                var value = $(this).val();
                if (value == 1) {
                    $('#discount_amount').show();
                    $('#discount_amount input').prop('disabled', false);
                } else {
                    $('#discount_amount').hide();
                    $('#discount_amount input').prop('disabled', true);
                }
            })

            $(document).on('change', '#type', function() {
                var type = $(this).val();
                console.log('Type id ' + type);
                $('#opening_stock_button').hide();
                $('#submit_n_add_selling_prices').hide();
                $('#save').hide();
                $('#rack_details').hide();

                $.ajax({
                    url: "{{ route('product.type.change') }}",
                    type: "GET",
                    data: {
                        type: type
                    },
                    dataType: "html",
                    success: function(html) {
                        $('#categoryy_id').html(html);
                        $('#sub_category_id').html(
                            '<option selected="selected" value="">Please Select</option>');
                        $('#child_category_id').html(
                            '<option selected="selected" value="">Please Select</option>');
                    }
                })
            })
            $(document).on('change', '#categoryy_id', function() {
                var category_id = $(this).val();
                $.ajax({
                    url: "{{ route('product.category_id.change') }}",
                    type: "GET",
                    data: {
                        category_id: category_id
                    },
                    dataType: "html",
                    success: function(html) {
                        $('#sub_category_id').html(html);
                        $('#child_category_id').html(
                            '<option selected="selected" value="">Please Select</option>');
                    }
                })
            })
            $(document).on('change', '#sub_category_id', function() {
                var sub_category_id = $(this).val();
                $.ajax({
                    url: "{{ route('product.sub_category.change') }}",
                    type: "GET",
                    data: {
                        sub_category_id: sub_category_id
                    },
                    dataType: "html",
                    success: function(html) {
                        $('#child_category_id').html(html);
                    }
                })
            })
        });
    </script>
@endsection
