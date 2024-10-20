@extends('layouts.app')

@section('title', __('crm::lang.campaigns'))

@section('content')
    @include('crm::layouts.nav')
    <!-- Content Header (Page header) -->
    <section class="content-header no-print">
        <h1>@lang('crm::lang.campaigns')</h1>
    </section>
    <section class="content no-print">
        <section class="content">
            <div class="form-container box box-primary">

                <div class="box-body" style="overflow-x: scroll;">
                    <h3 style="margin-bottom: 30px; text-align: center;"> {{ $campaign_name }} </h3>
                    <table id="crm_campaign_Table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Form Details</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Source</th>
                                <th>Address</th>
                                <th>Added On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($campaign_applicant_lists as $item)
                                <tr>
                                    <td> <a href="{{ route('campaignApplicantDetails', $item->id) }}"
                                            class="btn btn-xs btn-primary">
                                            <i class="fa fa-eye"></i> Show</a> </td>
                                    <td> {{ $item->user->surname }} {{ $item->user->first_name }}
                                        {{ $item->user->last_name }} </td>
                                    <td> {{ $item->user->contact_no }} </td>
                                    <td> {{ $item->user->email }} </td>
                                    <td> {{ $item->source }} </td>
                                    <td> {{ $item->user->current_address ?? '' }} </td>

                                    <td>{{ $item->created_at->format('d F Y h:i A') }}</td>

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
                                                    <a href="{{ route('leads.show', $item->contacts_id) }}">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
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
