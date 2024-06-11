@extends('layouts.app')
@section('title', 'Applicants')
@section('css')
    <style>
        .job-title-column {
            min-width: 300px;
            max-width: 300px;
            /* Ensure the column doesn't expand beyond 300px */
            white-space: nowrap;
            /* Prevent wrapping of text */
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .date-time-column {
            min-width: 150px;
            max-width: 150px;
            white-space: nowrap;
            /* Prevent wrapping of text */
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <h1>All applicant</h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">
            <div class="box-body" style="overflow-x: scroll;">
                <table id="recruitmentTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th class="job-title-column">Job Title</th>

                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th class="date-time-column">Date & Time</th>
                            <th>Current Address</th>
                            <th>Country of Residence</th>
                            <th>Origin</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recruitments as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a
                                        href="{{ route('recruitment.details', $item->JobId->uuid) }}">{{ $item->JobId->title }}</a>
                                </td>
                                <td>{{ $item->recuimentId->name ?? '' }}</td>
                                <td>{{ $item->recuimentId->phone ?? '' }}</td>
                                <td>{{ $item->recuimentId->email ?? '' }}</td>
                                <td>{{ $item->created_at->format('jS F Y h:i A') }}</td>
                                <td>{{ $item->recuimentId->current_address ?? '' }}</td>
                                <td>{{ $item->recuimentId->countryResidence->country_name ?? '' }}</td>
                                <td>{{ $item->recuimentId->birthCountry->country_name ?? '' }}</td>
                                <td>
                                    {{ $item->createdBy->surname ?? '' }}
                                    {{ $item->createdBy->first_name ?? '' }}
                                    {{ $item->createdBy->last_name ?? '' }}
                                </td>
                                <td>
                                    <a href="{{ route('recruitment.show', $item->recruitment_id) }}"
                                        class="btn btn-xs btn-primary">
                                        <i class="fas fa-eye"></i> Show
                                    </a>
                                    <a href="#" class="btn btn-xs btn-success copy-link"
                                        data-link="{{ route('recruitment.show', $item->recruitment_id) }}">
                                        <i class="fas fa-copy"></i> Copy
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No data available</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </section>

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
