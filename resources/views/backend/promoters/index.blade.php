@extends('layouts.app')
@section('title', 'Promoters')
@section('content')
    <section class="content-header">
        <h1>Promoters </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-body" style="overflow-x: scroll;">
                <table id="shop_news_table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Campaign</th>
                            <th>Leads</th>
                            <th>Earning</th>
                            <th>Paid</th>
                            <th>Balance</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $item)
                            <tr>
                                <td>{{ $item->surname }} {{ $item->first_name }} {{ $item->last_name }}</td>
                                <td>
                                    <a href="{{ route('promoter.campaigns', $item->id) }}">
                                        {{ $item->campaign_count }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('promoter.leads', $item->id) }}">
                                        {{ $item->lead_campaign_details_count }}
                                    </a>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle btn-xs"
                                            data-toggle="dropdown" aria-expanded="false">
                                            {{ __('messages.actions') }}
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li>
                                                <a href="">
                                                    <i class="glyphicon glyphicon-eye-open"></i> View
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <i class="glyphicon glyphicon-edit"></i> Campaigns
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="glyphicon glyphicon-edit"></i> Leads
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="glyphicon glyphicon-edit"></i> Earning Details
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="glyphicon glyphicon-edit"></i> Pay
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="glyphicon glyphicon-edit"></i> Email
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="glyphicon glyphicon-edit"></i> Add Lead/Convert to
                                                    customer/Convert to supplier
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="glyphicon glyphicon-edit"></i> Documents
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="glyphicon glyphicon-edit"></i> Contracts
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="glyphicon glyphicon-edit"></i> Active/Inactive
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No data available</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
