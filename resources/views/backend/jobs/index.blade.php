@extends('layouts.app')
@section('title', 'Job')
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
                            <th>Compnay Name</th>
                            <th>Hour type</th>
                            <th>Job type</th>
                            <th>Salary</th>
                            <th>Closing date</th>
                            <th>Note</th>
                            <th>Created at</th>
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
                                <td>{{ $item->closing_date }}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->created_at->format('d F Y h:i A') }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge bg-green">Active</span>
                                    @else
                                        <span class="badge bg-red">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('jobs.edit', $item->uuid) }}" class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    @if ($item->status == 1)
                                        <a href="{{ route('recruitment.details', $item->short_id) }}" target="_blank"
                                            class="btn btn-xs btn-info">
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </a>
                                    @endif

                                    {{-- @if ($item->appliedJobs->count() > 0) --}}
                                    <a href="{{ route('jobs.applicantList', $item->uuid) }}"
                                        class="btn btn-xs btn-warning">
                                        <i class="fas fa-list"></i> Applicants
                                    </a>
                                    {{-- @endif --}}

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </section>
@endsection
