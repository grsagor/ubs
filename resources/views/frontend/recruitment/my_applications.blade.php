@extends('layouts.app')
@section('title', 'My Applications')

@section('content')
    <style>
        /* @media screen and (max-width: 768px) {
                    .tr-width {
                        min-width: 200px;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }
                } */
    </style>
@section('content')
    <section class="content-header">
        <h1>My applications</h1>
    </section>

    <section class="content">

        <div class="form-container box box-primary">

            <div class="box-header" style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Search form -->
                <form action="{{ route('recruitment.myApplications') }}" method="GET" style="flex: 1; margin-right: 10px;">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control"
                            placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>

                <!-- Buttons -->
                <div>

                    <a href="{{ request()->url() }}" class="btn btn-success">
                        <i class="fa fa-hands-wash"></i>Clear
                    </a>
                    {{-- <a href="{{ route('recruitment.index') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add
                    </a> --}}
                </div>
            </div>



            {{-- <div class="box-body">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Job Title</th>
                            <th colspan="3">Applicant</th>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Applied date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appliedJobs as $item)
                            <tr>
                                <td>{{ serialNumber($appliedJobs, $loop) }}</td>
                                <td>
                                    <a
                                        href="{{ route('recruitment.details', $item->JobId->uuid) }}">{{ $item->JobId->title }}</a>
                                </td>
                                <td>{{ $item->recuimentId->name ?? '' }}</td>
                                <td>{{ $item->recuimentId->phone ?? '' }}</td>
                                <td>{{ $item->recuimentId->email ?? '' }}</td>
                                <td>{{ $item->created_at->format('d F Y') ?? '' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $appliedJobs->links() }}
            </div> --}}


            <div class="box-body" style="overflow-x: scroll;">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th style="min-width: 300px; overflow: hidden; text-overflow: ellipsis;">Job Title</th>
                            <th>Company Name</th>
                            <th>Location</th>
                            <th>Salary</th>
                            <th>Applied Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appliedJobs as $item)
                            <tr>
                                <td>{{ serialNumber($appliedJobs, $loop) }}</td>
                                <td>
                                    <a
                                        href="{{ route('recruitment.details', $item->JobId->uuid) }}">{{ $item->JobId->title }}</a>
                                </td>
                                <td>{{ $item->JobId->company_name ?? '' }}</td>
                                <td>{{ $item->JobId->location ?? '' }}</td>
                                <td>
                                    @if ($item->JobId->salary)
                                        {{ $item->JobId->salary }}/{{ $item->JobId->salary_type }}
                                    @else
                                        {{ $item->JobId->salary_type }}
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d F Y') ?? '' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $appliedJobs->links() }}
            </div>
        </div>
    </section>
@endsection
