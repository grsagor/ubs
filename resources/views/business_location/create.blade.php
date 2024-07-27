@extends('layouts.app')
@section('title', 'Shop Location')
@section('content')
    <section class="content-header">
        <h1>Add Shop Location </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">
                <h3 class="box-title">Fill Shop location details </h3>
                <div class="box-tools">
                    <a href="{{ route('business-location.index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> Shop List</a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('business-location.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Shop Name <span class="text-danger">*</span></label>
                                {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('Shop name')]) !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="category">Category Name:<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="category" id="category_id"
                                    onchange="categoryChanged()" required>
                                    <option value="">Select</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="subcategory" id="subcategory_label">Subcategory Name: <span class="text-danger"
                                        id="subcategory_required_asterisk" style="display: none;">*</span></label>
                                <select class="form-control select2" name="subcategory" id="subcategory_id">
                                    <option value="">Select</option>
                                    <!-- Subcategories will be populated here -->
                                </select>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Shop Regisration Number <span class="text-danger">*</span></label>
                                {!! Form::text('location_id', null, [
                                    'class' => 'form-control',
                                    'required',
                                    'placeholder' => __('lang_v1.location_id'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('landmark', __('Building') . ':') !!}
                                {!! Form::text('landmark', null, ['class' => 'form-control', 'placeholder' => __('Building Name')]) !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">City <span class="text-danger">*</span></label>
                                {!! Form::text('city', null, [
                                    'class' => 'form-control',
                                    'required',
                                    'placeholder' => __('business.city'),
                                    'required',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Post Code <span class="text-danger">*</span></label>
                                {!! Form::text('zip_code', null, [
                                    'class' => 'form-control',
                                    'placeholder' => __('business.zip_code'),
                                    'required',
                                ]) !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('state', __('business.state') . ':') !!}
                                {!! Form::text('state', null, ['class' => 'form-control', 'placeholder' => __('business.state')]) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Country <span class="text-danger">*</span></label>
                                {!! Form::text('country', null, [
                                    'class' => 'form-control',
                                    'placeholder' => __('business.country'),
                                    'required',
                                ]) !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Mobile <span class="text-danger">*</span></label>
                                {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => __('business.mobile')]) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('alternate_number', __('business.alternate_number') . ':') !!}
                                {!! Form::text('alternate_number', null, [
                                    'class' => 'form-control',
                                    'placeholder' => __('business.alternate_number'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('email', __('business.email') . ':') !!}
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('business.email')]) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('website', __('lang_v1.website') . ':') !!}
                                {!! Form::text('website', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.website')]) !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook">Facebook Link</label>
                                <input type="text" name="facebook" class="form-control" id="facebook"
                                    placeholder="Enter facebook link">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instagram">Instagram Link</label>
                                <input type="text" name="instagram" class="form-control" id="instagram"
                                    placeholder="Enter instagram link">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="linkedin">Linkedin link</label>
                                <input type="text" name="linkedin" class="form-control" id="linkedin"
                                    placeholder="Enter linkedin link">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="youtube">YouTube Link</label>
                                <input type="text" name="youtube" class="form-control" id="youtube"
                                    placeholder="Enter youtube link">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="twitter">Twitter Link</label>
                                <input type="text" name="twitter" class="form-control" id="twitter"
                                    placeholder="Enter twitter link">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('logo', __('business.upload_logo') . ':') !!}
                                {!! Form::file('logo', [
                                    'id' => 'upload_image_business_location',
                                    'accept' => 'image/*',
                                    'class' => 'upload-element',
                                ]) !!}

                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="about_info">Shop Details</label>
                                <textarea name="about_info" class="form-control" id="about_info" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Invoice Scheme <span class="text-danger">*</span></label>
                                {!! Form::select('invoice_scheme_id', $invoice_schemes, null, [
                                    'class' => 'form-control',
                                    'required',
                                    'placeholder' => __('messages.please_select'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Invoice Layout For POS <span
                                        class="text-danger">*</span></label>
                                {!! Form::select('invoice_layout_id', $invoice_layouts, null, [
                                    'class' => 'form-control',
                                    'required',
                                    'placeholder' => __('messages.please_select'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Invoice Layout For Sale <span
                                        class="text-danger">*</span></label>
                                {!! Form::select('sale_invoice_layout_id', $invoice_layouts, null, [
                                    'class' => 'form-control',
                                    'required',
                                    'placeholder' => __('messages.please_select'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('selling_price_group_id', __('lang_v1.default_selling_price_group') . ':') !!} @show_tooltip(__('lang_v1.location_price_group_help'))
                                {!! Form::select('selling_price_group_id', $price_groups, null, [
                                    'class' => 'form-control',
                                    'placeholder' => __('messages.please_select'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        @php
                            $custom_labels = json_decode(session('business.custom_labels'), true);
                            $location_custom_field1 = !empty($custom_labels['location']['custom_field_1'])
                                ? $custom_labels['location']['custom_field_1']
                                : __('lang_v1.location_custom_field1');
                            $location_custom_field2 = !empty($custom_labels['location']['custom_field_2'])
                                ? $custom_labels['location']['custom_field_2']
                                : __('lang_v1.location_custom_field2');
                            $location_custom_field3 = !empty($custom_labels['location']['custom_field_3'])
                                ? $custom_labels['location']['custom_field_3']
                                : __('lang_v1.location_custom_field3');
                            $location_custom_field4 = !empty($custom_labels['location']['custom_field_4'])
                                ? $custom_labels['location']['custom_field_4']
                                : __('lang_v1.location_custom_field4');
                        @endphp
                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::label('custom_field1', $location_custom_field1 . ':') !!}
                                {!! Form::text('custom_field1', null, ['class' => 'form-control', 'placeholder' => $location_custom_field1]) !!}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::label('custom_field2', $location_custom_field2 . ':') !!}
                                {!! Form::text('custom_field2', null, ['class' => 'form-control', 'placeholder' => $location_custom_field2]) !!}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::label('custom_field3', $location_custom_field3 . ':') !!}
                                {!! Form::text('custom_field3', null, ['class' => 'form-control', 'placeholder' => $location_custom_field3]) !!}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::label('custom_field4', $location_custom_field4 . ':') !!}
                                {!! Form::text('custom_field4', null, ['class' => 'form-control', 'placeholder' => $location_custom_field4]) !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="col-sm-12">
                            {{-- <div class="form-group">
                                {!! Form::label('featured_products', __('lang_v1.pos_screen_featured_products') . ':') !!} @show_tooltip(__('lang_v1.featured_products_help'))

                                {!! Form::select('featured_products[]', [], null, [
                                    'class' => 'form-control select 2',
                                    'id' => 'featured_products',
                                    'multiple',
                                ]) !!}
                            </div> --}}

                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="col-sm-12">
                            <strong>@lang('lang_v1.payment_options'): @show_tooltip(__('lang_v1.payment_option_help'))</strong>
                            <div class="form-group">
                                <table class="table table-condensed table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">@lang('lang_v1.payment_method')</th>
                                            <th class="text-center">@lang('lang_v1.enable')</th>
                                            <th class="text-center @if (empty($accounts)) hide @endif">
                                                @lang('lang_v1.default_accounts') @show_tooltip(__('lang_v1.default_account_help'))</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payment_types as $key => $value)
                                            <tr>
                                                <td class="text-center">{{ $value }}</td>
                                                <td class="text-center">{!! Form::checkbox('default_payment_accounts[' . $key . '][is_enabled]', 1, true) !!}</td>
                                                <td class="text-center @if (empty($accounts)) hide @endif">
                                                    {!! Form::select('default_payment_accounts[' . $key . '][account]', $accounts, null, [
                                                        'class' => 'form-control input-sm',
                                                    ]) !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-12 text-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    @includeIf('business_location.partial.js')
@endsection
