@extends('layouts.app')
@section('title', 'Recruitment')
@section('css')
    <style>
        #header {
            z-index: 1;
            height: 48px;
            background-color: #668284;
        }

        #name {
            float: left;
            margin-left: 20px;
            margin-top: 10px;
            font-size: 22px;
            font-family: Verdana, sans-serif;
            color: #ffffff;
        }

        #email {
            float: right;
            margin-right: 20px;
            padding-bottom: 10px;
            margin-top: 10px;
            font-size: 16px;
            font-family: Verdana, sans-serif;
            color: #ffffff;
        }

        #contact {
            margin-left: 45%;
            padding-bottom: 10px;
            font-size: 16px;
            font-family: Verdana, sans-serif;
            color: #ffffff;
        }

        a:hover {
            font-weight: bold;
        }

        .right {
            float: left;
            padding: 25px;
            height: auto;
            width: 100%;
            background-color: #E3EDD8;
        }

        #footer {
            height: 40px;
            clear: both;
            position: relative;
            background-color: #C1E3E1;
        }

        h3 {
            text-decoration: underline;
        }

        #job-responsibilities {
            padding: 1px;
        }

        .job-title {
            font-weight: bold;
        }

        table {
            border: 1px dashed black;
        }

        td {
            padding: 2px;
            border: 1px solid #E88741;
        }

        #course-name {
            font-weight: bold;
        }

        #company-name {
            height: 2px;
            text-decoration: underline;
        }

        #job-title {
            margin-top: 20px;
            height: 5px;
        }

        .job-duration {
            float: right;
        }

        #heading {
            font-weight: bold;
        }

        .font-size {
            font-size: 15px;
        }
    </style>
@endsection

@section('content')

    <section class="content">
        <div class="form-container box box-primary">
            <div id="header">
                <p id="name">{{ $item->name ?? '' }}</p>
                <a href="mailto:{{ $item->email }}">
                    <p id="email">Send</p>
                </a>
            </div>

            <div class="right">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="margin-top: 0;">Personal Information:</h3>
                    <button id="copyButton" class="btn btn-success">
                        <i class="fa fa-copy" aria-hidden="true"></i>
                        Copy Link
                    </button>
                </div>

                <p class="font-size">
                    Phone Number: {{ $item->phone ?? '' }}<br>
                    Email: {{ $item->email ?? '' }}<br>
                    Current Address: {{ $item->current_address ?? '' }}<br>
                    Country of Residence: {{ $item->country_residence ?? '' }}
                    Birth Country: {{ $item->birth_country ?? '' }}
                </p>

                <h3>Cover letter</h3>
                <p class="font-size">
                    {{ $item->cover_letter ?? '' }}
                </p>

                <h3>Professional Experience</h3>

                @php
                    $experiences = json_decode($item->experiences, true);

                    if (json_last_error() !== JSON_ERROR_NONE || !is_array($experiences)) {
                        // Handle JSON decoding error or unexpected data type
                        // For example, log the error or set $experiences to an empty array
                        $experiences = [];
                    }
                @endphp

                @if (!empty($experiences))
                    @foreach ($experiences as $experience)
                        <h4 id="company-name">Name of comapany : {{ $experience['name_of_company'] }}</h4>
                        <p style="margin-top: 20px;">{{ $experience['start_date'] }} To
                            <span>{{ $experience['end_date'] }}</span>
                        </p>


                        @if (!empty($experience['additional_file']) && file_exists(public_path($experience['additional_file'])))
                            <embed src="{{ asset($experience['additional_file']) }}" type="application/pdf" width="100%"
                                height="600px" />
                            <a href="{{ asset($experience['additional_file']) }}"
                                download="{{ $item->name }}_Additional_Files.pdf">Download
                                Additional Files</a>
                        @endif
                        <br>
                    @endforeach
                @else
                    <p>No professional experiences available.</p>
                @endif

                <h4>Expected Salary &#163;{{ $item->expected_salary }}
                    {{ $item->salary_type == 1 ? 'Hourly' : ($item->salary_type == 2 ? 'Monthly' : '') }}

                </h4>

                <h3>Curriculum Vitae</h3>
                @if (!empty($item->cv) && file_exists(public_path($item->cv)))
                    <embed src="{{ asset($item->cv) }}" type="application/pdf" width="100%" height="600px" />
                    <a href="{{ asset($item->cv) }}" download="{{ $item->name }}_Curriculum_Vitae.pdf">Download CV</a>
                @endif

                <h3>DBS Check</h3>
                @if (!empty($item->dbs_check) && file_exists(public_path($item->dbs_check)))
                    <embed src="{{ asset($item->dbs_check) }}" type="application/pdf" width="100%" height="600px" />
                    <a href="{{ asset($item->dbs_check) }}" download="{{ $item->name }}_DBS_Check.pdf">Download DBS
                        Check</a>
                @endif

                <h3>Care Certificates</h3>
                @if (!empty($item->care_certificates) && file_exists(public_path($item->care_certificates)))
                    <embed src="{{ asset($item->care_certificates) }}" type="application/pdf" width="100%"
                        height="600px" />
                    <a href="{{ asset($item->care_certificates) }}"
                        download="{{ $item->name }}_Care_Certificates.pdf">Download Care Certificates</a>
                @endif
            </div>
    </section>

    <script>
        document.getElementById('copyButton').addEventListener('click', function() {
            var textToCopy = '{{ route('recruitment.show', $item->uuid) }}';
            var tempInput = document.createElement('input');
            tempInput.value = textToCopy;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);

            // Show a popup message
            toastr.success('Link copied: ');
        });
    </script>
@endsection
