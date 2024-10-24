@extends('layouts.app')

@section('title', __('crm::lang.campaigns'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header no-print">
        <h1>@lang('crm::lang.campaigns')</h1>
    </section>
    <section class="content no-print">

        <section class="content">
            <div class="form-container box box-primary">

                <div class="box-body" style="overflow-x: scroll;">
                    <table id="promoter_campaign_Table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Campaign Name</th>
                                <th>Business Location</th>
                                <th>Total Leads</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($campaigns as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('campaign.details', [$item->businessLocation->slug, $item->short_id]) }}"
                                            target="_blank">
                                            {{ $item->subject }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('shop.service', $item->business_location_id) }}" target="_blank">
                                            {{ $item->businessLocation->name ?? '' }}
                                        </a>
                                    </td>
                                    <td>{{ $item->lead_campaign_details_count }}</td>
                                    <td>{{ $item->created_at->format('d M Y h:i A') }}</td>
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
@endsection
