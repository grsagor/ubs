@extends('layouts.app')
@section('title', 'Job')
@section('content')
    <section class="content-header">
        <h1>Jobs</h1>
    </section>

    <section class="content">

        <div class="form-container box box-primary">

            <div class="box-header" style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Search form -->
                <form action="{{ route('jobs.index') }}" method="GET" style="flex: 1; margin-right: 10px;">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>

                <!-- Buttons -->
                <div>
                    <!-- Clear button -->
                    <a href="{{ request()->url() }}" class="btn btn-success">
                        <i class="fa fa-hands-wash"></i> Clear
                    </a>
                    <!-- Add button -->
                    <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add
                    </a>
                </div>
            </div>


            <div class="box-body" style="overflow-x: scroll;">

                <table class="table table-bordered table-striped table-hover">
                    <!-- Table header -->
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Compnay Name</th>
                            <th>Hour type</th>
                            <th>Job type</th>
                            <th>Salary</th>
                            <th>Closing date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jobs as $item)
                            <tr>
                                <td>{{ serialNumber($jobs, $loop) }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->company_name }}</td>
                                <td>{{ $item->hour_type }}</td>
                                <td>{{ $item->job_type }}</td>
                                <td>
                                    @if ($item->salary)
                                        {{ $item->salary }}/{{ $item->salary_type }}
                                    @else
                                        {{ $item->salary_type }}
                                    @endif
                                </td>
                                <td>{{ $item->closing_date }}</td>
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
                                        <a href="{{ route('recruitment.details', $item->uuid) }}" target="_blank"
                                            class="btn btn-xs btn-info">
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </a>
                                    @endif

                                    <a href="{{ route('jobs.applicantList', $item->uuid) }}"
                                        class="btn btn-xs btn-warning">
                                        <i class="fas fa-list"></i> Applicant
                                    </a>


                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $jobs->links() }}

            </div>
        </div>
    </section>
@endsection
