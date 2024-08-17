@extends('layouts.app')
@section('title', 'Job')
@section('css')
    <style>
        .hidden {
            display: none;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>All your Jobs</h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">
            <div class="box-header">
                <div class="box-tools">
                    <a type="button" class="btn btn-block btn-primary" href="{{ route('jobs.create') }}">
                        <i class="fa fa-plus"></i> Add</a>
                </div>
            </div>

            <div class="box-body" style="overflow-x: scroll;">
                <table id="jobs_Table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Reference</th>
                            <th>Category</th>
                            <th style="min-width: 300px; overflow: hidden; text-overflow: ellipsis;">Title</th>
                            <th>Company Name</th>
                            <th>Employee Status</th>
                            <th>Job Location</th>
                            <th>Job type</th>
                            <th>Salary</th>
                            <th>Created at</th>
                            <th>Closing date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jobs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->reference }}</td>
                                <td>{{ $item->job_category->name ?? '' }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->company_name }}</td>
                                <td>{{ is_array($item->hour_type) ? implode(', ', $item->hour_type) : $item->hour_type }}
                                </td>
                                <td>{{ $item->location }}</td>
                                <td>{{ is_array($item->job_type) ? implode(', ', $item->job_type) : $item->job_type }}</td>
                                <td>
                                    @php
                                        $salary = null;
                                        if (
                                            $item->salary_type == 'Fixed' &&
                                            $item->fixed_salary !== null &&
                                            $item->salary_variation !== null
                                        ) {
                                            $salary = '£' . $item->fixed_salary . '/' . $item->salary_variation;
                                        } elseif (
                                            $item->salary_type == 'Negotiable' &&
                                            $item->from_salary !== null &&
                                            $item->to_salary !== null &&
                                            $item->salary_variation !== null
                                        ) {
                                            $salary =
                                                '£' .
                                                $item->from_salary .
                                                '-' .
                                                $item->to_salary .
                                                '/' .
                                                $item->salary_variation;
                                        }
                                    @endphp

                                    {{ $salary ?? 'N/A' }}
                                </td>
                                <td>{{ $item->created_at->format('d F Y h:i A') }}</td>
                                <td>{{ Carbon::parse($item->closing_date)->format('d F Y') }}</td>

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
                                                <a href="{{ route('jobs.edit', $item->uuid) }}">
                                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('recruitment.details', ['id' => $item->short_id, 'slug' => $item->slug]) }}"
                                                    target="_blank">
                                                    <i class="fa fa-info-circle"></i>
                                                    Details
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('jobs.show', $item->uuid) }}" class=" btn-view-job">
                                                    <i class="glyphicon glyphicon-eye-open"></i> Note
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('jobs.status_change', $item->uuid) }}">
                                                    <i
                                                        class="fa fa-power-off {{ $item->status == 0 ? 'text-danger' : 'text-success' }}"></i>
                                                    <span
                                                        class="{{ $item->status == 0 ? 'text-danger' : 'text-success' }}">
                                                        {{ $item->status == 0 ? 'Inactive' : 'Active' }}
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('jobs.applicantList', $item->uuid) }}">
                                                    <i class="fas fa-list"></i> Applicants
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
    <!-- Modal -->
    <div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="jobModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobModalLabel">Title: </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Note:</strong> <span id="modal-job-note"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('javascript')
    <script>
        $(document).ready(function() {
            $('#jobs_Table').on('click', '.btn-view-job', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');

                // Check if the URL is already an absolute URL
                if (!url.startsWith('http') && !url.startsWith('/')) {
                    url = '/' + url; // Add leading slash only for relative URLs
                }

                console.log('URL:', url);

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        $('#jobModalLabel').text(response.title);
                        $('#modal-job-note').html(response.note);
                        $('#jobModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
