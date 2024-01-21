@extends('frontend.layouts.master_layout')
@section('title', 'Jobs')
@section('css')
    <style>
        .container {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .color-black {
            color: black !important;
        }

        .text-justify {
            text-align: justify;
        }

        ul {
            color: black;
        }

        span {
            font-size: 22px;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">
        <h2>{{ $job->title }}</h2>

        <ul style="list-style-type: disc;">
            <li>Posting date: {{ $job->created_at->format('d F Y') }}</li>
            <li>Hours: {{ $job->hour_type }}</li>
            <li>Closing date: {{ \Carbon\Carbon::parse($job->closing_date)->format('d F Y') }}</li>
            <li>Location: {{ $job->location }}</li>
            <li>Company: {{ $job->company_name }}</li>
            <li>Job type: {{ $job->job_type }}</li>
            <li>Salary type: {{ $job->job_type }}</li>
        </ul>

        <div style="margin-top: 10px;">
            @if ($applied_jobs == 1)
                <button type="button" class="btn btn-secondary" disabled>Already applied</button>
            @else
                @if ($recuitment_info == 0)
                    <a href="{{ route('recruitment.create', $job->uuid) }}" class="btn btn-dark">Apply for this job</a>
                @endif

                @if ($recuitment_info == 1)
                    <form action="{{ route('recruitment.applyJob', $job->uuid) }}" method="POST"
                        class="mx-auto mobileView"enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn btn-dark">Apply for this job</button>
                    </form>
                @endif
            @endif
        </div>

        {{-- <button onclick="applyForJob()" type="button" class="btn btn-dark">Apply for this job</button> --}}

        <p class="color-black" style="margin-top: 20px; margin-bottom: 5px;">
            <span style="font-size: 22px;"><b>Summary</b></span><br>
        </p>
        <div class="color-black">
            {!! $job->description ?? '' !!}
        </div>



        <div style="margin-top: 10px;">
            @if ($applied_jobs == 1)
                <button type="button" class="btn btn-secondary" disabled>Already applied</button>
            @else
                @if ($recuitment_info == 0)
                    <a href="{{ route('recruitment.create', $job->uuid) }}" class="btn btn-dark">Apply for this job</a>
                @endif

                @if ($recuitment_info == 1)
                    <form action="{{ route('recruitment.applyJob', $job->uuid) }}" method="POST"
                        class="mx-auto mobileView"enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn btn-dark">Apply for this job</button>
                    </form>
                @endif
            @endif
        </div>

    </div>

    <script>
        function applyForJob() {
            // Check if the user is authenticated
            console.log('Clicked');

            @auth


            $.ajax({
                url: "{{ route('recruitment.userCheck', ['jobID' => $job->uuid]) }}",
                type: "get",
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    if (result == 1) {
                        window.location.href = "{{ route('recruitment.create', $job->uuid) }}";
                    } else {
                        toastr.warning('Already applied!!!');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        @else
            // If not authenticated, show a Toastr message
            window.location.href = "{{ route('login') }}";
            // toastr.warning('Please login to apply for the job.');
        @endauth
        }
    </script>
@endsection
