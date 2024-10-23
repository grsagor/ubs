@extends('layouts.app')

@section('title', __('crm::lang.campaigns'))

@section('content')
    @include('crm::layouts.nav')
    <!-- Content Header (Page header) -->
    <section class="content-header no-print">
        <h1>@lang('crm::lang.campaigns')</h1>
    </section>
    <section class="content no-print">
        @component('components.filters', ['title' => __('report.filters')])
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('campaign_type', __('crm::lang.campaign_type') . ':') !!}
                        {!! Form::select('campaign_type', ['sms' => __('crm::lang.sms'), 'email' => __('business.email')], null, [
                            'class' => 'form-control select2',
                            'id' => 'campaign_type_filter',
                            'placeholder' => __('messages.all'),
                        ]) !!}
                    </div>
                </div>
            </div>
        @endcomponent

        <section class="content">
            <div class="form-container box box-primary">
                <div class="box-header">
                    <div class="box-tools">
                        <a type="button" class="btn btn-block btn-primary" href="{{ route('campaigns.create') }}">
                            <i class="fa fa-plus"></i> Add</a>
                    </div>
                </div>

                <div class="box-body" style="overflow-x: scroll;">
                    <table id="crm_campaign_Table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Campaign Name</th>
                                <th>Campaign Type</th>
                                <th>Business Location</th>
                                <th>Promoter Name</th>
                                <th>Created at</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($campaigns as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $item->name }}
                                        @if ($item->sent_on)
                                            <span class="label label-success">Sent</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($item->campaign_type == 'sms')
                                            SMS
                                        @elseif($item->campaign_type == 'email')
                                            Email
                                        @elseif($item->campaign_type == 'lead_generation')
                                            Lead Generation
                                        @endif
                                    </td>
                                    <td>{{ $item->businessLocation->name ?? '' }}</td>
                                    <td>
                                        @php
                                            // Get promoter details contact_ids is array of user ids
                                            $promoter = DB::table('users')
                                                ->whereIn('id', $item->contact_ids)
                                                ->select('surname', 'first_name', 'last_name')
                                                ->first();
                                        @endphp

                                        @if ($promoter)
                                            {{ $promoter->surname }} {{ $promoter->first_name }}
                                            {{ $promoter->last_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d F Y h:i A') }}</td>
                                    <td>
                                        {{ $item->createdBy->surname }} {{ $item->createdBy->first_name }}
                                        {{ $item->createdBy->last_name }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info dropdown-toggle btn-xs"
                                                data-toggle="dropdown" aria-expanded="false">
                                                {{ __('messages.actions') }}
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                @if ($item->campaign_type == 'sms' || $item->campaign_type == 'email')
                                                    <li>
                                                        <a href="{{ route('campaigns.show', $item->id) }}">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                    </li>
                                                @endif

                                                <!-- For lead genaration only it shows in frontend -->
                                                @if ($item->campaign_type == 'lead_generation')
                                                    <li>
                                                        <a href="{{ route('campaign.details', $item->short_id) }}"
                                                            target="__blank">
                                                            <i class="fa fa-info-circle"></i> Details
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="copy-link"
                                                            data-link="{{ route('campaign.details', $item->short_id) }}">
                                                            <i class="fas fa-copy"></i> Copy
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('campaignApplicantList', $item->id) }}">
                                                            <i class="fas fa-list"></i> Leads
                                                        </a>
                                                    </li>
                                                @endif

                                                <li>
                                                    <a href="{{ route('campaigns.edit', $item->id) }}">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                </li>

                                                @if (in_array($item->campaign_type, ['sms', 'email']) && is_null($item->sent_on))
                                                    <li>
                                                        <a href="{{ route('sendNotification', $item->id) }}">
                                                            <i class="fa fa-envelope-square"></i>
                                                            @lang('Send Notification')
                                                        </a>
                                                    </li>
                                                @endif

                                                <li>
                                                    <a class="text-danger" href="#"
                                                        onclick="if(confirm('Are You Sure To Delete?')){
                                                                    event.preventDefault();
                                                                    document.getElementById('delete-form-{{ $item->id }}').submit();
                                                                } else {
                                                                    event.preventDefault();
                                                                }">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>

                                                    <form action="{{ route('campaigns.destroy', $item->id) }}"
                                                        method="post" style="display: none;"
                                                        id="delete-form-{{ $item->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13">No data available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </section>
@endsection
@section('javascript')
    <script src="{{ asset('modules/crm/js/crm.js?v=' . $asset_v) }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var copyLinkButtons = document.querySelectorAll('.copy-link');

            copyLinkButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    // Get the link from the data-link attribute
                    var linkToCopy = button.getAttribute('data-link');

                    // Create a temporary input element
                    var tempInput = document.createElement('input');
                    tempInput.value = linkToCopy;
                    document.body.appendChild(tempInput);

                    // Select and copy the text in the input element
                    tempInput.select();
                    document.execCommand('copy');
                    document.body.removeChild(tempInput);

                    // Show Toastr success message
                    toastr.success('Link copied');
                });
            });
        });
    </script>
@endsection
