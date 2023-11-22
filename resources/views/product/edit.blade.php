@extends('layouts.app')
@section('title', __('product.edit_product'))

@section('content')

@php
  $is_image_required = !empty($common_settings['is_product_image_required']) && empty($product->image);
@endphp

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('product.edit_product')</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
{!! Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'update'] , [$product->id] ), 'method' => 'PUT', 'id' => 'product_add_form',
        'class' => 'product_form', 'files' => true ]) !!}
    <input type="hidden" id="product_id" value="{{ $product->id }}">

    @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('class', __('product.type') . ':*') !!}
                    {!! Form::select('class', ['Product','Service'], !empty($product->class) ? $product->class : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'required']); !!}
                </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                {!! Form::label('name', __('product.product_name') . ':*') !!}
                  {!! Form::text('name', $product->name, ['class' => 'form-control', 'required',
                  'placeholder' => __('product.product_name')]); !!}
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                {!! Form::label('sku', __('product.sku')  . ':*') !!} @show_tooltip(__('tooltip.sku'))
                {!! Form::text('sku', $product->sku, ['class' => 'form-control',
                'placeholder' => __('product.sku'), 'required']); !!}
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-4">
              <div class="form-group">
                {!! Form::label('unit_id', __('product.unit') . ':*') !!}
                <div class="input-group">
                  {!! Form::select('unit_id', $units, $product->unit_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'required']); !!}
                  <span class="input-group-btn">
                    <button type="button" @if(!auth()->user()->can('unit.create')) disabled @endif class="btn btn-default bg-white btn-flat quick_add_unit btn-modal" data-href="{{action([\App\Http\Controllers\UnitController::class, 'create'], ['quick_add' => true])}}" title="@lang('unit.add_unit')" data-container=".view_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-sm-4 @if(!session('business.enable_sub_units')) hide @endif">
              <div class="form-group">
                {!! Form::label('sub_unit_ids', __('lang_v1.related_sub_units') . ':') !!} @show_tooltip(__('lang_v1.sub_units_tooltip'))

                <select name="sub_unit_ids[]" class="form-control select2" multiple id="sub_unit_ids">
                  @foreach($sub_units as $sub_unit_id => $sub_unit_value)
                    <option value="{{$sub_unit_id}}" 
                      @if(is_array($product->sub_unit_ids) &&in_array($sub_unit_id, $product->sub_unit_ids))   selected 
                      @endif>{{$sub_unit_value['name']}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            @if(!empty($common_settings['enable_secondary_unit']))
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('secondary_unit_id', __('lang_v1.secondary_unit') . ':') !!} @show_tooltip(__('lang_v1.secondary_unit_help'))
                        {!! Form::select('secondary_unit_id', $units, $product->secondary_unit_id, ['class' => 'form-control select2']); !!}
                    </div>
                </div>
            @endif

            <div class="col-sm-4 @if(!session('business.enable_brand')) hide @endif">
              <div class="form-group">
                {!! Form::label('brand_id', __('product.brand') . ':') !!}
                <div class="input-group">
                  {!! Form::select('brand_id', $brands, $product->brand_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); !!}
                  <span class="input-group-btn">
                    <button type="button" @if(!auth()->user()->can('brand.create')) disabled @endif class="btn btn-default bg-white btn-flat btn-modal" data-href="{{action([\App\Http\Controllers\BrandController::class, 'create'], ['quick_add' => true])}}" title="@lang('brand.add_brand')" data-container=".view_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-sm-4 @if(!session('business.enable_category')) hide @endif">
                <div class="form-group">
                    {!! Form::label('category_id', __('product.category') . ':') !!}
                    {!! Form::select('category_id', $categories, $product->category_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); !!}
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-4 @if(!(session('business.enable_category') && session('business.enable_sub_category'))) hide @endif">
              <div class="form-group">
                {!! Form::label('sub_category_id', __('product.sub_category')  . ':') !!}
                  {!! Form::select('sub_category_id', $sub_categories, $product->sub_category_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); !!}
              </div>
            </div>

            <div class="col-sm-4 @if(!(session('business.enable_category') && session('business.enable_sub_category'))) hide @endif">
                <div class="form-group">
                    {!! Form::label('child_category_id', __('product.child_category') . ':') !!}
                    {!! Form::select('child_category_id', $child_categories, !empty($product->child_category_id) ? $product->child_category_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); !!}
                </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                {!! Form::label('product_locations', __('business.business_locations') . ':') !!} @show_tooltip(__('lang_v1.product_location_help'))
                  {!! Form::select('product_locations[]', $business_locations, $product->product_locations->pluck('id'), ['class' => 'form-control select2', 'multiple', 'id' => 'product_locations']); !!}
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('barcode_type', __('product.barcode_type') . ':*') !!}
                    {!! Form::select('barcode_type', $barcode_types, $product->barcode_type, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'required']); !!}
                </div>
            </div>
        </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('name', __('product.study_time') . ':*') !!}
                            {!! Form::select('study_time', ['Part Time','Full Time'], !empty($product->name) ? $product->name : null, ['class' => 'form-control select2', 'required']); !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('start_type', 'Starts:*') !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="everyYearCheckbox" name="every_year" value="1">
                                        <label class="form-check-label" for="everyYearCheckbox">Every year</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectYearCheckbox" name="select_year" value="1">
                                        <label class="form-check-label" for="selectYearCheckbox">Select year</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select id="yearSelect" name="selected_years[]" class="form-control select2" multiple>
                                            <option disabled selected value="">Select Year</option>
                                            @php
                                                $currentYear = date('Y');
                                                for ($year = $currentYear; $year <= $currentYear + 5; $year++) {
                                                    echo "<option value='$year'>$year</option>";
                                                }
                                            @endphp
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select id="monthSelect" name="selected_months[]" class="form-control select2" multiple>
                                            <option disabled selected value="">Select Month</option>
                                            @php
                                                $months = [
                                                    'January', 'February', 'March', 'April', 'May', 'June',
                                                    'July', 'August', 'September', 'October', 'November', 'December'
                                                ];
                                                foreach ($months as $month) {
                                                    echo "<option value='$month'>$month</option>";
                                                }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('name', __('product.name_of_institution') . ':') !!}
                            {!! Form::text('name_of_institution', !empty($product->name_of_institution) ? $product->name_of_institution : null, ['class' => 'form-control', 'required',
                            'placeholder' => __('product.name_of_institution')]); !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('name', __('product.duration') . ':*') !!}
                            <div class="row">
                                <div class="col-md-6">
                                    {!! Form::select('duration', ['1','2','3','4','5'], !empty($product->duration) ? $product->duration : null, ['class' => 'form-control select2', 'required', 'placeholder' => 'Year']); !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::select('duration', ['1','2','3','4','5','7','8','9','10','11'], !empty($product->duration) ? $product->duration : null, ['class' => 'form-control select2', 'required', 'placeholder' => 'Month']); !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('name', __('product.tuition_fees') . ':') !!}
                            <div class="row">
                                <div class="col-md-5">
                                    {!! Form::text('home_students_fees', !empty($product->home_students_fees) ? $product->home_students_fees : null, ['class' => 'form-control', 'required',
                                        'placeholder' => __('product.home_students_fees')]); !!}
                                </div>
                                <div class="col-md-7">
                                    {!! Form::text('int_students_fees', !empty($product->int_students_fees) ? $product->int_students_fees : null, ['class' => 'form-control', 'required',
                                        'placeholder' => __('product.int_students_fees')]); !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            {!! Form::label('general_facilities', __('lang_v1.general_facilities') . ':') !!}
                            {!! Form::textarea('general_facilities', !empty($product->general_facilities) ? $product->general_facilities : null, ['class' => 'form-control']); !!}
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('work_placement', __('product.work_placement') . ':*') !!}
                            {!! Form::select('work_placement', ['Available'=>'Available','Unavailable'=>'Unavailable'], !empty($product->work_placement) ? $product->work_placement : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'required']); !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('tuition_fee_installment', __('product.tuition_fee_installment') . ':*') !!}
                            {!! Form::select('tuition_fee_installment', ['Available'=>'Available','Unavailable'=>'Unavailable'], !empty($product->tuition_fee_installment) ? $product->tuition_fee_installment : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'required']); !!}
                        </div>
                    </div>
                </div>
            @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('requirement', __('product.requirements') . ':') !!}
                            {!! Form::select('requirements',['English Language'=>'English Language','Education'=>'Education','General Requirements'=>'General Requirements'], !empty($product->requirements) ? $product->requirements : null, ['class' => 'form-control', 'placeholder' => __('messages.please_select'),]); !!}
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            {!! Form::label('requirement_details', __('product.requirement_details') . ':') !!}
                            {!! Form::textarea('requirement_details', !empty($product->requirement_details) ? $product->requirement_details : null, ['class' => 'form-control']); !!}
                        </div>
                    </div>
                </div>
            @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
              <br>
                <label>
                  {!! Form::checkbox('enable_stock', 1, $product->enable_stock, ['class' => 'input-icheck', 'id' => 'enable_stock']); !!} <strong>@lang('product.manage_stock')</strong>
                </label>@show_tooltip(__('tooltip.enable_stock')) <p class="help-block"><i>@lang('product.enable_stock_help')</i></p>
              </div>
            </div>
            <div class="col-sm-4" id="alert_quantity_div" @if(!$product->enable_stock) style="display:none" @endif>
              <div class="form-group">
                {!! Form::label('alert_quantity', __('product.alert_quantity') . ':') !!} @show_tooltip(__('tooltip.alert_quantity'))
                {!! Form::text('alert_quantity', $alert_quantity, ['class' => 'form-control input_number',
                'placeholder' => __('product.alert_quantity') , 'min' => '0']); !!}
              </div>
            </div>
            @if(!empty($common_settings['enable_product_warranty']))
            <div class="col-sm-4">
              <div class="form-group">
                {!! Form::label('warranty_id', __('lang_v1.warranty') . ':') !!}
                {!! Form::select('warranty_id', $warranties, $product->warranty_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); !!}
              </div>
            </div>
            @endif
            <!-- include module fields -->
            @if(!empty($pos_module_data))
                @foreach($pos_module_data as $key => $value)
                    @if(!empty($value['view_path']))
                        @includeIf($value['view_path'], ['view_data' => $value['view_data']])
                    @endif
                @endforeach
            @endif
            <div class="clearfix"></div>
            <div class="col-sm-8">
              <div class="form-group">
                {!! Form::label('product_description', __('lang_v1.product_description') . ':') !!}
                  {!! Form::textarea('product_description', $product->product_description, ['class' => 'form-control']); !!}
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                {!! Form::label('image', __('lang_v1.product_image') . ':') !!}
                {!! Form::file('image', ['id' => 'upload_image', 'accept' => 'image/*', 'required' => $is_image_required]); !!}
                <small><p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]). @lang('lang_v1.aspect_ratio_should_be_1_1') @if(!empty($product->image)) <br> @lang('lang_v1.previous_image_will_be_replaced') @endif</p></small>
              </div>
            </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                {!! Form::label('product_brochure', __('lang_v1.product_brochure') . ':') !!}
                {!! Form::file('product_brochure', ['id' => 'product_brochure', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); !!}
                <small>
                    <p class="help-block">
                        @lang('lang_v1.previous_file_will_be_replaced')<br>
                        @lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
                        @includeIf('components.document_help_text')
                    </p>
                </small>
              </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('youtube_link', __('product.youtube_link') . ':*') !!}
                    {!! Form::text('youtube_link', !empty($product->youtube_link) ? $product->youtube_link : null, ['class' => 'form-control', 'required',
                    'placeholder' => __('product.youtube_link')]); !!}
                </div>
            </div>
    @endcomponent

    @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('service_features', __('product.service_features') . ':') !!}
                    {!! Form::textarea('service_features', !empty($product->service_features) ? $product->service_features : null, ['class' => 'form-control']); !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('experiences', __('product.experiences') . ':') !!}
                    {!! Form::textarea('experiences', !empty($product->experiences) ? $product->experiences : null, ['class' => 'form-control']); !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('specializations', __('product.specializations') . ':') !!}
                    {!! Form::textarea('specializations', !empty($product->specializations) ? $product->specializations : null, ['class' => 'form-control']); !!}
                </div>
            </div>
            {{-- @if(!empty($common_settings['enable_product_warranty']))
             <div class="col-sm-6">
                 <div class="form-group">
                     {!! Form::label('warranty_id', __('lang_v1.warranty') . ':') !!}
                     {!! Form::select('warranty_id', $warranties, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); !!}
                 </div>
             </div>
             @endif--}}
        </div>
    @endcomponent

    @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-4 @if(!session('business.enable_price_tax')) hide @endif">
                <div class="form-group">
                    {!! Form::label('tax', __('product.applicable_tax') . ':') !!}
                    {!! Form::select('tax', $taxes, $product->tax, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2'], $tax_attributes); !!}
                </div>
            </div>

            <div class="col-sm-4 @if(!session('business.enable_price_tax')) hide @endif">
                <div class="form-group">
                    {!! Form::label('tax_type', __('product.selling_price_tax_type') . ':*') !!}
                    {!! Form::select('tax_type',['inclusive' => __('product.inclusive'), 'exclusive' => __('product.exclusive')], $product->tax_type,
                    ['class' => 'form-control select2', 'required']); !!}
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('type', __('product.product_type') . ':*') !!} @show_tooltip(__('tooltip.product_type'))
                    {!! Form::select('type', $product_types, $product->type, ['class' => 'form-control select2',
                      'required','disabled', 'data-action' => 'edit', 'data-product_id' => $product->id ]); !!}
                </div>
            </div>

            <div class="form-group col-sm-12" id="product_form_part"></div>
            <input type="hidden" id="variation_counter" value="0">
            <input type="hidden" id="default_profit_percent" value="{{ $default_profit_percent }}">
        </div>
    @endcomponent

    @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <br>
                    <label>
                        {!! Form::checkbox('disable_reselling', 1, !(empty($product)) ? $product->disable_reselling : false, ['class' => 'input-icheck']); !!} <strong>@lang('product.disable_reselling')</strong>
                    </label> @show_tooltip(__('product.disable_reselling'))
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('reselling_price', __('product.reselling_price') . ':*') !!}
                    {!! Form::select('reselling_price', ['Percentage','Fixed'], null, ['class' => 'form-control select2','required', 'placeholder' => __('messages.please_select')]); !!}
                </div>
            </div>
            <div class="col-sm-4">
                {!! Form::label('reselling_commission', __('product.reselling_commission') . ':') !!}
                {!! Form::text('reselling_commission', !empty($product->reselling_commission) ? $product->reselling_commission : null, ['class' => 'form-control', 'required',
                    'placeholder' => __('product.reselling_commission')]); !!}
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-4">
                {!! Form::label('reselling_commission_tuition', __('product.reselling_commission_tuition') . ':') !!}
                {!! Form::text('reselling_commission_tuition', !empty($product->reselling_commission_tuition) ? $product->reselling_commission_tuition : null, ['class' => 'form-control', 'required',
                    'placeholder' => __('product.reselling_commission_tuition')]); !!}
            </div>
            <div class="col-sm-4">
                {!! Form::label('price_changeable', __('product.price_changeable') . ':*') !!}
                {!! Form::select('price_changeable',['Yes','No'], !empty($product->price_changeable) ? $product->price_changeable : null, ['class' => 'form-control', 'required',
                    'placeholder' => __('messages.please_select')]); !!}
            </div>
        </div>
    @endcomponent

    @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('delivery_mode', __('product.delivery_mode') . ':*') !!}
                    {!! Form::select('delivery_mode', ['Online','Offline','Online & Offline'], null, ['class' => 'form-control select2', 'required', 'placeholder' => __('messages.please_select')]); !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('delivery_area', __('product.delivery_area') . ':*') !!}
                    {!! Form::select('delivery_area', ['National','International'], null, ['class' => 'form-control select2', 'required', 'placeholder' => __('messages.please_select')]); !!}
                </div>
            </div>
        </div>
    @endcomponent

    @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
        @if(session('business.enable_product_expiry'))

          @if(session('business.expiry_type') == 'add_expiry')
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
          <div class="col-sm-4 @if($hide) hide @endif">
            <div class="form-group">
              <div class="multi-input">
                @php
                  $disabled = false;
                  $disabled_period = false;
                  if( empty($product->expiry_period_type) || empty($product->enable_stock) ){
                    $disabled = true;
                  }
                  if( empty($product->enable_stock) ){
                    $disabled_period = true;
                  }
                @endphp
                  {!! Form::label('expiry_period', __('product.expires_in') . ':') !!}<br>
                  {!! Form::text('expiry_period', @num_format($product->expiry_period), ['class' => 'form-control pull-left input_number',
                    'placeholder' => __('product.expiry_period'), 'style' => 'width:60%;', 'disabled' => $disabled]); !!}
                  {!! Form::select('expiry_period_type', ['months'=>__('product.months'), 'days'=>__('product.days'), '' =>__('product.not_applicable') ], $product->expiry_period_type, ['class' => 'form-control select2 pull-left', 'style' => 'width:40%;', 'id' => 'expiry_period_type', 'disabled' => $disabled_period]); !!}
              </div>
            </div>
          </div>
          @endif
          <div class="col-sm-4">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('enable_sr_no', 1, $product->enable_sr_no, ['class' => 'input-icheck']); !!} <strong>@lang('lang_v1.enable_imei_or_sr_no')</strong>
              </label>
              @show_tooltip(__('lang_v1.tooltip_sr_no'))
            </div>
          </div>

          <div class="col-sm-4">
          <div class="form-group">
            <br>
            <label>
              {!! Form::checkbox('not_for_selling', 1, $product->not_for_selling, ['class' => 'input-icheck']); !!} <strong>@lang('lang_v1.not_for_selling')</strong>
            </label> @show_tooltip(__('lang_v1.tooltip_not_for_selling'))
          </div>
        </div>

        <div class="clearfix"></div>

        <!-- Rack, Row & position number -->
        @if(session('business.enable_racks') || session('business.enable_row') || session('business.enable_position'))
          <div class="col-md-12">
            <h4>@lang('lang_v1.rack_details'):
              @show_tooltip(__('lang_v1.tooltip_rack_details'))
            </h4>
          </div>
          @foreach($business_locations as $id => $location)
            <div class="col-sm-3">
              <div class="form-group">
                {!! Form::label('rack_' . $id,  $location . ':') !!}

                
                  @if(!empty($rack_details[$id]))
                    @if(session('business.enable_racks'))
                      {!! Form::text('product_racks_update[' . $id . '][rack]', $rack_details[$id]['rack'], ['class' => 'form-control', 'id' => 'rack_' . $id]); !!}
                    @endif

                    @if(session('business.enable_row'))
                      {!! Form::text('product_racks_update[' . $id . '][row]', $rack_details[$id]['row'], ['class' => 'form-control']); !!}
                    @endif

                    @if(session('business.enable_position'))
                      {!! Form::text('product_racks_update[' . $id . '][position]', $rack_details[$id]['position'], ['class' => 'form-control']); !!}
                    @endif
                  @else
                    {!! Form::text('product_racks[' . $id . '][rack]', null, ['class' => 'form-control', 'id' => 'rack_' . $id, 'placeholder' => __('lang_v1.rack')]); !!}

                    {!! Form::text('product_racks[' . $id . '][row]', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.row')]); !!}

                    {!! Form::text('product_racks[' . $id . '][position]', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.position')]); !!}
                  @endif

              </div>
            </div>
          @endforeach
        @endif


        <div class="col-sm-4">
          <div class="form-group">
            {!! Form::label('weight',  __('lang_v1.weight') . ':') !!}
            {!! Form::text('weight', $product->weight, ['class' => 'form-control', 'placeholder' => __('lang_v1.weight')]); !!}
          </div>
        </div>
        <div class="clearfix"></div>
        @php
          $custom_labels = json_decode(session('business.custom_labels'), true);
          $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
          $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
          $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
          $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
        @endphp
        <!--custom fields-->
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('product_custom_field1',  $product_custom_field1 . ':') !!}
            {!! Form::text('product_custom_field1', $product->product_custom_field1, ['class' => 'form-control', 'placeholder' => $product_custom_field1]); !!}
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('product_custom_field2',  $product_custom_field2 . ':') !!}
            {!! Form::text('product_custom_field2', $product->product_custom_field2, ['class' => 'form-control', 'placeholder' => $product_custom_field2]); !!}
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('product_custom_field3',  $product_custom_field3 . ':') !!}
            {!! Form::text('product_custom_field3', $product->product_custom_field3, ['class' => 'form-control', 'placeholder' => $product_custom_field3]); !!}
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('product_custom_field4',  $product_custom_field4 . ':') !!}
            {!! Form::text('product_custom_field4', $product->product_custom_field4, ['class' => 'form-control', 'placeholder' => $product_custom_field4]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('preparation_time_in_minutes',  __('lang_v1.preparation_time_in_minutes') . ':') !!}
            {!! Form::number('preparation_time_in_minutes', $product->preparation_time_in_minutes, ['class' => 'form-control', 'placeholder' => __('lang_v1.preparation_time_in_minutes')]); !!}
          </div>
        </div>
        <!--custom fields-->
        @include('layouts.partials.module_form_part')
        </div>
    @endcomponent

    @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    {!! Form::label('policy', __('product.policy') . ':') !!}
                    {!! Form::textarea('policy', !empty($product->policy) ? $product->policy : null, ['class' => 'form-control']); !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>
                        {!! Form::checkbox('unipuller_data_policy', 1, !(empty($product)) ? $product->unipuller_data_policy : false, ['class' => 'input-icheck', 'required']); !!} <strong>@lang('product.unipuller_data_policy')*</strong>
                    </label> @show_tooltip(__('product.unipuller_data_policy'))
                </div>
            </div>
        </div>
    @endcomponent

  <div class="row">
    <input type="hidden" name="submit_type" id="submit_type">
        <div class="col-sm-12">
          <div class="text-center">
            <div class="btn-group">
              @if($selling_price_group_count)
                <button type="submit" value="submit_n_add_selling_prices" class="btn btn-warning submit_product_form">@lang('lang_v1.save_n_add_selling_price_group_prices')</button>
              @endif

              @can('product.opening_stock')
              <button type="submit" @if(empty($product->enable_stock)) disabled="true" @endif id="opening_stock_button"  value="update_n_edit_opening_stock" class="btn bg-purple submit_product_form">@lang('lang_v1.update_n_edit_opening_stock')</button>
              @endif

              <button type="submit" value="save_n_add_another" class="btn bg-maroon submit_product_form">@lang('lang_v1.update_n_add_another')</button>

              <button type="submit" value="submit" class="btn btn-primary submit_product_form">@lang('messages.update')</button>
            </div>
          </div>
        </div>
  </div>
{!! Form::close() !!}
</section>
<!-- /.content -->

@endsection

@section('javascript')
  <script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
  <script type="text/javascript">
    $(document).ready( function(){
      __page_leave_confirmation('#product_add_form');
    });
  </script>
@endsection