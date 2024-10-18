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
                                <th>Created By</th>
                                <th>Created at</th>
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

                                    <td>{{ $item->campaign_type }}</td>
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

                                                <li>
                                                    <a href="{{ route('campaigns.edit', $item->id) }}">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                </li>

                                                <li>
                                                    @if (is_null($item->sent_on))
                                                        <a href="{{ route('sendNotification', $item->id) }}">
                                                            <i class="fa fa-envelope-square"></i> Send Notification
                                                        </a>
                                                    @endif
                                                </li>

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
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endsection
