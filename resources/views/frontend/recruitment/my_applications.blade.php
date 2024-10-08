@extends('layouts.app')
@section('title', 'My Applications')

@section('content')
    <section class="content-header">
        <h1>My applications</h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">
            <div class="box-body" style="overflow-x: scroll;">
                <table id="my_applications_Table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th style="min-width: 300px; overflow: hidden; text-overflow: ellipsis;">Job Title</th>
                            <th>Company Name</th>
                            <th>Location</th>
                            <th>Salary</th>
                            <th>Applied Date</th>
                            <th>Sponsorship</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appliedJobs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a
                                        href="{{ route('recruitment.details', ['id' => $item->JobId->short_id, 'slug' => $item->JobId->slug]) }}">{{ $item->JobId->title }}</a>
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
                                <td>{{ $item->recuimentId->sponsorship == 1 ? 'Need' : 'No Need' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
