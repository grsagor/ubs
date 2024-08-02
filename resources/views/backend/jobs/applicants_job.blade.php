@extends('layouts.app')
@section('title', 'Applicants Job')
@section('css')
    <style>
    </style>
@endsection

@section('content')
    <section class="content-header">
        <h1>All applicant</h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">
            <div class="box-body" style="overflow-x: scroll;">
                <table id="applicants_job_Table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th colspan="9" class="text-center">
                                <a
                                    href="{{ route('recruitment.details', ['id' => $job->short_id, 'title' => rawurlencode($job->title)]) }}">{{ $job->title }}
                                </a>
                            </th>
                        </tr>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Date & Time</th>
                            <th>Current address</th>
                            <th>Counrtry of residence</th>
                            <th>Origin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applicants as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->recuimentId->name ?? '' }}</td>
                                <td>{{ $item->recuimentId->phone ?? '' }}</td>
                                <td>{{ $item->recuimentId->email ?? '' }}</td>
                                <td>{{ $item->created_at->format('jS F Y h:i A') }}</td>
                                <td>{{ $item->recuimentId->current_address ?? '' }}</td>
                                <td>{{ $item->recuimentId->countryResidence->country_name ?? '' }}</td>
                                <td>{{ $item->recuimentId->birthCountry->country_name ?? '' }}</td>
                                <td>
                                    <a href="{{ route('recruitment.show', $item->recruitment_id) }}"
                                        class="btn btn-xs btn-primary">
                                        <i class="fas fa-eye"></i> Show
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



@endsection
