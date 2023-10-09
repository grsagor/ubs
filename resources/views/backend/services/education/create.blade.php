@extends('layouts.app')
@section('title', 'Add Service-Education')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add Service-Education</h1>
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
        {!! Form::open(['url' => action([\App\Http\Controllers\Backend\ServiceEducationController::class, 'store']), 'method' => 'post',
            'id' => 'education_add_form','class' => 'product_form ' . $form_class, 'files' => true ]) !!}
        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('name', __('Title00') . ':*') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required','placeholder' => 'Course Title']); !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('name', __('Education Type') . ':*') !!}
                        {!! Form::select('education_type',['Full-time','Part-time'], null, ['placeholder' => __('messages.please_select'),'class' => 'form-control', 'required']); !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('name', __('Level of Education') . ':*') !!}
                        {!! Form::text('level_of_education', null, ['class' => 'form-control', 'required','placeholder' => 'Ex: Undergraduate']); !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('name', __('Course Duration') . ':*') !!}
                        {!! Form::select('course_duration',['1','2','3','4'], null, ['placeholder' => __('messages.please_select'),'class' => 'form-control', 'required']); !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('name', __('Tuition Fees (Home Students)') . ':*') !!}
                        {!! Form::number('tuition_fee', null, ['class' => 'form-control', 'required','placeholder' => 'Ex: 20000']); !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('name', __('Tuition Fees (Int. Students)') . ':*') !!}
                        {!! Form::number('tuition_fee_int', null, ['class' => 'form-control', 'required','placeholder' => 'Ex: 30000']); !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('name', __('IELTS (Requirements)') ) !!}
                        {!! Form::number('ielts', null, ['class' => 'form-control', 'required','placeholder' => 'Ex: 6.5']); !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('name', __('Grades (Requirements)') ) !!}
                        {!! Form::number('grades', null, ['class' => 'form-control', 'required','placeholder' => 'Ex: 3.5']); !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('name', __('Youtube Link')) !!}
                        {!! Form::text('youtube_link', null, ['class' => 'form-control', 'required','placeholder' => 'Ex: www.youtube.com/xyz']); !!}
                    </div>
                </div>

                <div class="col-sm-4 @if(!session('business.enable_category')) hide @endif">
                    <div class="form-group">
                        {!! Form::label('category_id', __('product.category') . ':') !!}
                        {!! Form::select('category_id', $categories, !empty($duplicate_product->category_id) ? $duplicate_product->category_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); !!}
                    </div>
                </div>

                <div class="col-sm-4 @if(!(session('business.enable_category') && session('business.enable_sub_category'))) hide @endif">
                    <div class="form-group">
                        {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                        {!! Form::select('sub_category_id', $sub_categories, !empty($duplicate_product->sub_category_id) ? $duplicate_product->sub_category_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); !!}
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('description', __('Description') . ':') !!}
                        {!! Form::textarea('description',null, ['class' => 'form-control']); !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('image', __('Thumbnail/Feature Image') . ':') !!}
                        {!! Form::file('thumbnail', ['id' => 'upload_image', 'accept' => 'image/*',
                            'required' => $is_image_required, 'class' => 'upload-element']); !!}
                        <small><p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]) <br> @lang('lang_v1.aspect_ratio_should_be_1_1')</p></small>
                    </div>
                </div>
            </div>
        @endcomponent
        <div class="row">
            <div class="col-sm-12">
                <input type="hidden" name="submit_type" id="submit_type">
                <div class="text-center">
                    <div class="btn-group">
                        <button type="submit" value="submit" class="btn btn-primary submit_product_form btn-lg">@lang('messages.save')</button>
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

    {{--<script type="text/javascript">
        $(document).ready(function(){
            __page_leave_confirmation('#education_add_form');
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
        });
    </script>--}}
@endsection