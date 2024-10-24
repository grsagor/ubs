@extends('layouts.app')

@section('title', __('crm::lang.campaigns'))

@section('content')
    @include('crm::layouts.nav')
    <!-- Content Header (Page header) -->
    <section class="content-header no-print">
        <h1>
            @lang('crm::lang.campaigns')
            <small>@lang('messages.edit')</small>
        </h1>
    </section>
    <section class="content no-print">
        <div class="box box-solid">
            <div class="box-body">
                {!! Form::open([
                    'url' => action('\Modules\Crm\Http\Controllers\CampaignController@update', ['campaign' => $campaign->id]),
                    'method' => 'put',
                    'id' => 'campaign_form',
                ]) !!}
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('name', __('crm::lang.campaign_name') . ':*') !!}
                            {!! Form::text('name', $campaign->name, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('campaign_type', __('crm::lang.campaign_type') . ':*') !!}
                            {!! Form::select(
                                'campaign_type',
                                ['lead_generation' => 'Lead Generation', 'sms' => __('crm::lang.sms'), 'email' => __('business.email')],
                                $campaign->campaign_type,
                                [
                                    'class' => 'form-control select2',
                                    'placeholder' => __('messages.please_select'),
                                    'required',
                                    'style' => 'width: 100%;',
                                ],
                            ) !!}
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="selling_price_group_id">Business location <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="business_location_id" required>
                                <option value="">Select</option>
                                @foreach ($business_locations as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (old('business_location_id') ?? $campaign->business_location_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 to_div">
                        <div class="form-group">
                            {!! Form::label('to', __('crm::lang.to') . ':*') !!}
                            {!! Form::select(
                                'to',
                                [
                                    'customer' => __('lang_v1.customers'),
                                    'lead' => __('crm::lang.leads'),
                                    'transaction_activity' => __('crm::lang.transaction_activity'),
                                    'contact' => __('contact.contact'),
                                ],
                                $campaign->additional_info['to'] ?? null,
                                [
                                    'class' => 'form-control select2',
                                    'placeholder' => __('messages.please_select'),
                                    'required',
                                    'style' => 'width: 100%;',
                                ],
                            ) !!}
                        </div>
                    </div>

                    <div class="col-md-4 promoter_div" style="display: none;">
                        <div class="form-group">
                            {!! Form::label('user_email', __('User Email')) !!}
                            <input type="email" id="user_email" class="form-control" placeholder="Type user email"
                                value="{{ $promoter->email ?? null }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 promoter_div" style="display: none;">
                        <div class="form-group" id="user_name_container">
                            {!! Form::label('user_name', __('Name')) !!}
                            {!! Form::text(
                                'user_name',
                                ($promoter->surname ?? '') . ' ' . ($promoter->first_name ?? '') . ' ' . ($promoter->last_name ?? ''),
                                [
                                    'class' => 'form-control',
                                    'id' => 'user_name',
                                    'readonly',
                                ],
                            ) !!}

                            <!-- Hidden promoter ID field -->
                            <input type="hidden" id="user_id" name="contact_id[]" value="{{ $promoter->id ?? null }}">
                        </div>
                    </div>

                    <div class="col-md-12" id="video_link_div" style="{{ $campaign->video_link ? '' : 'display: none;' }}">
                        <div class="form-group">
                            <label for="">Video Link
                                <span class="text-secondary" style="color: rgba(139, 139, 139, 0.762)">
                                    [Supports Youtube and Vimeo]
                                </span>
                            </label>
                            <input type="text" class="form-control" name="video_link" placeholder="Enter video link"
                                value="{{ old('video_link', $campaign->video_link) }}">
                        </div>
                    </div>


                    <div class="col-md-8 customer_div" style="display: none;">
                        <div class="form-group">
                            {!! Form::label('contact_id', __('lang_v1.customers') . ':*') !!}
                            <button type="button" class="btn btn-primary btn-xs select-all">
                                @lang('lang_v1.select_all')
                            </button>
                            <button type="button" class="btn btn-primary btn-xs deselect-all">
                                @lang('lang_v1.deselect_all')
                            </button>
                            {!! Form::select('contact_id[]', $customers, $campaign->contact_ids, [
                                'class' => 'form-control select2',
                                'multiple',
                                'id' => 'contact_id',
                                'style' => 'width: 100%;',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-8 lead_div" style="display: none;">
                        <div class="form-group">
                            {!! Form::label('lead_id', __('crm::lang.leads') . ':*') !!}
                            <button type="button" class="btn btn-primary btn-xs select-all">
                                @lang('lang_v1.select_all')
                            </button>
                            <button type="button" class="btn btn-primary btn-xs deselect-all">
                                @lang('lang_v1.deselect_all')
                            </button>
                            {!! Form::select('lead_id[]', $leads, $campaign->contact_ids, [
                                'class' => 'form-control select2',
                                'multiple',
                                'id' => 'lead_id',
                                'style' => 'width: 100%;',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-8 contact_div" style="display: none;">
                        <div class="form-group">
                            {!! Form::label('contact', __('contact.contact') . ':*') !!}
                            <button type="button" class="btn btn-primary btn-xs select-all">
                                @lang('lang_v1.select_all')
                            </button>
                            <button type="button" class="btn btn-primary btn-xs deselect-all">
                                @lang('lang_v1.deselect_all')
                            </button>
                            {!! Form::select('contact[]', $contacts, $campaign->contact_ids, [
                                'class' => 'form-control select2',
                                'multiple',
                                'id' => 'contact',
                                'style' => 'width: 100%;',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4 transaction_activity_div" style="display: none;">
                        <div class="form-group">
                            {!! Form::label('trans_activity', __('crm::lang.transaction_activity') . ':*') !!}
                            {!! Form::select(
                                'trans_activity',
                                [
                                    'has_transactions' => __('crm::lang.has_transactions'),
                                    'has_no_transactions' => __('crm::lang.has_no_transactions'),
                                ],
                                $campaign->additional_info['trans_activity'] ?? null,
                                ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;'],
                            ) !!}
                        </div>
                    </div>
                    <div class="col-md-4 transaction_activity_div" style="display: none;">
                        <div class="form-group">
                            <label for="in_days">{{ __('crm::lang.in_days') }}:*</label>
                            <div class="input-group">
                                <div class="input-group-addon">{{ __('crm::lang.in') }}</div>
                                <input type="text" class="form-control input_number" id="in_days" placeholder="0"
                                    name="in_days" required value="{{ $campaign->additional_info['in_days'] ?? null }}">
                                <div class="input-group-addon">{{ __('lang_v1.days') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row email_div">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('subject', __('crm::lang.subject') . ':*') !!}
                            {!! Form::text('subject', $campaign->subject, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('email_body', __('crm::lang.email_body') . ':*') !!}
                            {!! Form::textarea('email_body', $campaign->email_body, [
                                'class' => 'form-control ',
                                'id' => 'email_body',
                                'required',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row sms_div">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('sms_body', __('crm::lang.sms_body') . ':') !!}
                            {!! Form::textarea('sms_body', $campaign->sms_body, [
                                'class' => 'form-control ',
                                'id' => 'sms_body',
                                'rows' => '6',
                                'required',
                            ]) !!}
                        </div>
                    </div>
                </div>

                <div class="" id="available_tags">
                    <strong>@lang('lang_v1.available_tags'):</strong>
                    <p class="help-block">
                        {{ implode(', ', $tags) }}
                    </p>
                </div>

                @php
                    $infoFromCustomer = json_decode($campaign->info_from_customer, true);
                @endphp

                <div class="col-sm-12">
                    <label style="margin-bottom: 10px;">Select the information you need from leads:</label>
                    <div class="form-group">
                        <div style="margin-bottom: 10px;">
                            <input type="checkbox" class="input-icheck" name="checkbox_education"
                                {{ isset($infoFromCustomer['checkbox_education']) && $infoFromCustomer['checkbox_education'] == '1' ? 'checked' : '' }}>
                            <label style="margin-right: 20px;">Education</label>

                            <input type="checkbox" class="input-icheck" name="checkbox_experience"
                                {{ isset($infoFromCustomer['checkbox_experience']) && $infoFromCustomer['checkbox_experience'] == '1' ? 'checked' : '' }}>
                            <label style="margin-right: 20px;">Experience</label>

                            <input type="checkbox" class="input-icheck" name="checkbox_cv"
                                {{ isset($infoFromCustomer['checkbox_cv']) && $infoFromCustomer['checkbox_cv'] == '1' ? 'checked' : '' }}>
                            <label>CV</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-sm submit-button pull-right draft m-5"
                    name="send_notification" value="0" data-style="expand-right">
                    <span class="ladda-label">
                        <i class="fas fa-save"></i>
                        Save
                    </span>
                </button>

                <button type="submit" class="btn btn-warning btn-sm pull-right submit-button notif m-5"
                    name="send_notification" value="1" data-style="expand-right">
                    <span class="ladda-label">
                        <i class="fas fa-envelope-square"></i>
                        @lang('crm::lang.send_notification')
                    </span>
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    {{-- This is working in production --}}
    <script src="{{ asset('modules/crm/js/crm.js?v=' . time()) }}"></script>
    {{-- This is working in local --}}
    {{-- <script src="{{ asset('modules/crm/js/crm.js?v=' . $asset_v) }}"></script> --}}
    <script type="text/javascript">
        $(function() {

            $('select#to').change(function() {
                toggleFieldBasedOnTo($(this).val());
            });

            function toggleFieldBasedOnTo(to) {
                if (to == 'customer') {
                    $('div.customer_div').show();
                    $('div.lead_div').hide();
                    $('div.transaction_activity_div').hide();
                    $('div.contact_div').hide();
                } else if (to == 'lead') {
                    $('div.lead_div').show();
                    $('div.customer_div').hide();
                    $('div.transaction_activity_div').hide();
                    $('div.contact_div').hide();
                } else if (to == 'transaction_activity') {
                    $('div.transaction_activity_div').show();
                    $('div.customer_div').hide();
                    $('div.lead_div').hide();
                    $('div.contact_div').hide();
                } else if (to == 'contact') {
                    $('div.contact_div').show();
                    $('div.transaction_activity_div').hide();
                    $('div.customer_div').hide();
                    $('div.lead_div').hide();
                } else {
                    $('div.transaction_activity_div, div.customer_div, div.lead_div, div.contact_div').hide();
                }
            }

            toggleFieldBasedOnTo($('select#to').val());
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#user_email').on('input', function(e) {
                var email = $(this).val().trim();

                // Check if the input includes a dot and at least one character after it
                if (email.includes('.') && email.split('.').pop().length > 0) {
                    // Proceed with AJAX call
                    console.log('Input contains a dot, executing AJAX');
                    $.ajax({
                        url: '{{ route('validateEmail') }}', // Route to your email validation
                        method: 'POST',
                        data: {
                            email: email,
                            _token: '{{ csrf_token() }}' // CSRF token for security
                        },
                        success: function(response) {
                            if (response.success) {
                                // Email matches exactly, set the user name and user ID
                                var user = response.user;
                                $('#user_name_container').show();
                                $('#user_name').val(user.name); // Set the matched user's name
                                $('#user_id').val(user
                                    .id); // Set the matched user's ID in the hidden field
                            } else {
                                // Hide the user name input if no exact match
                                // $('#user_name_container').hide();
                                $('#user_name').val(''); // Clear the user name field
                                $('#user_id').val(''); // Clear the user ID field
                            }
                        }
                    });
                } else if (email.length === 0) {
                    // If input is empty, hide the user name input
                    // $('#user_name_container').hide();
                    $('#user_name').val(''); // Clear the user name field
                    $('#user_id').val(''); // Clear the user ID field
                } else {
                    // If the input does not meet the criteria, you can hide the container
                    // $('#user_name_container').hide();    
                    $('#user_name').val(''); // Clear the user name field
                    $('#user_id').val(''); // Clear the user ID field
                }
            });
        });
    </script>
@endsection
