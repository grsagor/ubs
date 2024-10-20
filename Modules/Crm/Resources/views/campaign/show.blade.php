@extends('layouts.app')

@section('title', __('crm::lang.campaigns'))

@section('content')
    @include('crm::layouts.nav')
    <!-- Content Header (Page header) -->
    <section class="content-header no-print">
        <h1>@lang('crm::lang.campaigns')</h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">
            {{-- <div class="box-header">
                <div class="box-tools">
                    <a type="button" class="btn btn-block btn-primary" href="{{ route('campaigns.create') }}">
                        <i class="fa fa-plus"></i> Add</a>
                </div>
            </div> --}}
            <div class="box-body">


                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $campaign->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <b>@lang('crm::lang.campaign_type'):</b>
                                @if ($campaign->campaign_type == 'sms')
                                    {{ __('crm::lang.sms') }}
                                @elseif($campaign->campaign_type == 'email')
                                    {{ __('business.email') }}
                                @endif
                            </div>
                            @if (!empty($campaign->sent_on))
                                <div class="col-sm-6">
                                    <p class="text-right">
                                        <b>@lang('crm::lang.sent_on'):</b>
                                        {{ @format_datetime($campaign->sent_on) }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        @if ($campaign->campaign_type == 'email')
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <b>@lang('crm::lang.subject'):</b> {{ $campaign->subject }}
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-sm-12">
                                    <b>@lang('crm::lang.email_body'):</b>
                                    {!! $campaign->email_body !!}
                                </div>
                            </div>
                        @elseif($campaign->campaign_type == 'sms')
                            <div class="row">
                                <div class="col-sm-12">
                                    <b>@lang('crm::lang.sms_body'):</b>
                                    <p>{!! $campaign->sms_body !!}</p>
                                </div>
                            </div>
                        @endif

                        @if (!empty($campaign->additional_info['to']) && $campaign->additional_info['to'] == 'transaction_activity')
                            <div class="row">
                                <div class="col-md-6">
                                    <b>@lang('crm::lang.transaction_activity'):</b>
                                    @lang('crm::lang.' . $campaign->additional_info['trans_activity'])
                                </div>
                                <div class="col-md-6">
                                    <b>@lang('crm::lang.in_days'):</b>
                                    {{ $campaign->additional_info['in_days'] }}
                                </div>
                            </div>
                        @endif

                        @php
                            $leads = [];
                            $customers = [];
                        @endphp
                        @if (count($notifiable_users) > 0)
                            @foreach ($notifiable_users as $contact)
                                @php
                                    if ($contact->type == 'lead') {
                                        $leads[] = $contact->name;
                                    } elseif ($contact->type == 'customer') {
                                        $customers[] = $contact->name;
                                    }
                                @endphp
                            @endforeach
                        @endif

                        <div class="row mt-3">
                            @if (!empty($customers))
                                <div class="col-sm-12">
                                    <strong>@lang('lang_v1.customers'): </strong>
                                    <p>
                                        {{ implode(', ', $customers) }}
                                    </p>
                                </div>
                            @endif
                            @if (!empty($leads))
                                <div class="col-sm-12">
                                    <strong>@lang('crm::lang.leads'): </strong>
                                    <p>
                                        {{ implode(', ', $leads) }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-left" style="margin-top: 20px;">
                        <i class="fas fa-pencil-alt"></i>
                        @lang('crm::lang.created_this_campaign_on', [
                            'name' => $campaign->createdBy->user_full_name,
                        ])
                        {{ @format_date($campaign->created_at) }}
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script src="{{ asset('modules/crm/js/crm.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endsection
