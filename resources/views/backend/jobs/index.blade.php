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
                            <th>Hour type</th>
                            <th>Job type</th>
                            <th>Salary</th>
                            <th>Created at</th>
                            <th>Closing date</th>
                            <th>Note</th>
                            <th>Status</th>
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
                                <td>{{ is_array($item->job_type) ? implode(', ', $item->job_type) : $item->job_type }}</td>
                                <td>
                                    @if ($item->salary)
                                        {{ $item->salary }}/{{ $item->salary_type }}
                                    @else
                                        {{ $item->salary_type }}
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d F Y h:i A') }}</td>
                                <td>{{ Carbon::parse($item->closing_date)->format('d F Y') }}</td>
                                <td>
                                    <a href="#" class="btn btn-xs btn-info btn-view-job"
                                        data-id="{{ $item->uuid }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('jobs.status_change', $item->uuid) }}"
                                        class="btn btn-xs {{ $item->status == 0 ? 'btn-danger' : 'btn-success' }}">
                                        <i class="fa fa-power-off"></i> {{ $item->status == 0 ? 'Inactive' : 'Active' }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('jobs.edit', $item->uuid) }}" class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>
                                    @if ($item->status == 1)
                                        <a href="{{ route('recruitment.details', ['id' => $item->short_id, 'title' => rawurlencode($item->title)]) }}"
                                            target="_blank" class="btn btn-xs btn-info">
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('jobs.applicantList', $item->uuid) }}"
                                        class="btn btn-xs btn-warning">
                                        <i class="fas fa-list"></i> Applicants
                                    </a>
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
            $('.btn-view-job').click(function(e) {
                e.preventDefault();
                var jobId = $(this).data('id');
                $.ajax({
                    url: '{{ route('jobs.show', '') }}/' + jobId,
                    method: 'GET',
                    success: function(response) {
                        $('#jobModalLabel').text(response.title);
                        $('#modal-job-note').html(response.note);
                        $('#jobModal').modal('show');
                    },
                    error: function() {
                        alert('Failed to fetch job details.');
                    }
                });
            });
        });
    </script>
@endsection
