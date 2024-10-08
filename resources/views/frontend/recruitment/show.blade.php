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
            /* text-decoration: underline; */
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

        h3 {
            display: inline-block;
            margin-right: 10px;
            /* Adjust the margin as needed */
        }

        .view-btn {
            display: inline-block;
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
                    Country of Residence: {{ $item->countryResidence->country_name ?? '' }} <br>
                    Origin: {{ $item->birthCountry->country_name ?? '' }} <br>
                    Sponsorship: {{ $item->sponsorship == 1 ? 'Need' : 'No Need' }}
                </p>

                <h3>Cover letter</h3>
                <p class="font-size">
                    {{ $item->cover_letter ?? '' }}
                </p>

                <h4>Expected Salary
                    £{{ $item->expected_salary }}/{{ $item->salary_type == 1 ? 'hourly' : ($item->salary_type == 2 ? 'monthly' : 'unknown') }}
                </h4>



                <h3>Professional Experience</h3>

                @php
                    $experiences = json_decode($item->experiences, true);

                    if (json_last_error() !== JSON_ERROR_NONE || !is_array($experiences)) {
                        // Handle JSON decoding error or unexpected data type
                        // For example, log the error or set $experiences to an empty array
                        $experiences = [];
                    }
                @endphp


                {{-- {{ dd($experiences) }} --}}
                @if (!empty($experiences))
                    @foreach ($experiences as $index => $experience)
                        <h4 id="company-name">Name of experience: {{ $experience['experience_name_of_company'] }}</h4>
                        <p style="margin-top: 20px;">{{ $experience['experience_start_date'] }} To
                            <span>{{ $experience['experience_end_date'] }}</span>
                        </p>

                        {{-- <h3>Additional Files</h3> --}}
                        @if (!empty($experience['experience_file']) && file_exists(public_path($experience['experience_file'])))
                            <button class="view-btn" data-target="additional-files-viewer-{{ $index }}"
                                style="margin-top: 15px;">View</button>
                            <a href="{{ asset($experience['experience_file']) }}"
                                download="{{ $item->name }}_Experience_Files.pdf" style="margin-left: 10px;">Download</a>
                            <div class="pdf-viewer" id="additional-files-viewer-{{ $index }}"
                                style="display: none;">
                                <embed src="{{ asset($experience['experience_file']) }}" type="application/pdf"
                                    width="100%" height="600px" />
                            </div>
                        @endif
                    @endforeach
                @else
                    <p>No professional experiences available.</p>
                @endif

                @if (!empty($educations))
                    @foreach ($educations as $index => $edu)
                        <h4 id="company-name">Name of education: {{ $edu['education_name_of_title'] }}</h4>
                        <p style="margin-top: 20px;">{{ $edu['education_start_date'] }} To
                            <span>{{ $edu['education_end_date'] }}</span>
                        </p>

                        @if (!empty($edu['education_file']) && file_exists(public_path($edu['education_file'])))
                            <button class="view-btn" data-target="additional-files-viewer-{{ $index }}"
                                style="margin-top: 15px;">View</button>
                            <a href="{{ asset($edu['education_file']) }}"
                                download="{{ $item->name }}_Education_Files.pdf" style="margin-left: 10px;">Download</a>
                            <div class="pdf-viewer" id="additional-files-viewer-{{ $index }}"
                                style="display: none;">
                                <embed src="{{ asset($edu['education_file']) }}" type="application/pdf" width="100%"
                                    height="600px" />
                            </div>
                        @endif
                    @endforeach
                @else
                    <p>No professional experiences available.</p>
                @endif

                @if (!empty($item->cv) && file_exists(public_path($item->cv)))
                    <h3>Curriculum Vitae</h3>
                    <button class="view-btn" data-target="cv-viewer" style="margin-top: 15px;">View</button>
                    <a href="{{ asset($item->cv) }}" download="{{ $item->name }}_Curriculum_Vitae.pdf"
                        style="margin-left: 10px;">Download
                    </a>
                    <div class="pdf-viewer" id="cv-viewer" style="display: none;">
                        <embed src="{{ asset($item->cv) }}" type="application/pdf" width="100%" height="600px" />
                    </div>
                    <br>
                @endif


                @if (!empty($item->dbs_check) && file_exists(public_path($item->dbs_check)))
                    <h3>DBS Check</h3>
                    <button class="view-btn" data-target="dbs-viewer" style="margin-top: 15px;">View</button>
                    <a href="{{ asset($item->dbs_check) }}" download="{{ $item->name }}_DBS_Check.pdf"
                        style="margin-left: 10px;">Download </a>
                    <div class="pdf-viewer" id="dbs-viewer" style="display: none;">
                        <embed src="{{ asset($item->dbs_check) }}" type="application/pdf" width="100%" height="600px" />
                    </div>
                    <br>
                @endif


                @if (!empty($item->care_certificates) && file_exists(public_path($item->care_certificates)))
                    <h3>Care Certificates</h3>
                    <button class="view-btn" data-target="care-certificates-viewer" style="margin-top: 15px;">View</button>
                    <a href="{{ asset($item->care_certificates) }}" download="{{ $item->name }}_Care_Certificates.pdf"
                        style="margin-left: 10px;">Download</a>
                    <div class="pdf-viewer" id="care-certificates-viewer" style="display: none;">
                        <embed src="{{ asset($item->care_certificates) }}" type="application/pdf" width="100%"
                            height="600px" />
                    </div>
                    <br>
                @endif


                <h3>Additional Certificate</h3>

                @php
                    $additionalCertificates = json_decode($item->additional_files, true);

                    if (json_last_error() !== JSON_ERROR_NONE || !is_array($additionalCertificates)) {
                        // Handle JSON decoding error or unexpected data type
                        // For example, log the error or set $additionalCertificates to an empty array
                        $additionalCertificates = [];
                    }
                @endphp

                @if (!empty($additionalCertificates))
                    @foreach ($additionalCertificates as $index => $adCertificates)
                        <h4 id="company-name">Name of certificate: {{ $adCertificates['additional_name_of_title'] }}
                        </h4>

                        @if (!empty($adCertificates['additional_file']) && file_exists(public_path($adCertificates['additional_file'])))
                            <button class="view-btn" style="margin-top: 15px;"
                                data-target="additional-files-viewer-{{ $index }}">View</button>
                            <a href="{{ asset($adCertificates['additional_file']) }}"
                                download="{{ $item->name }}_Additional_Files.pdf" style="margin-left: 10px;">Download</a>
                            <div class="pdf-viewer" id="additional-files-viewer-{{ $index }}"
                                style="display: none;">
                                <embed src="{{ asset($adCertificates['additional_file']) }}" type="application/pdf"
                                    width="100%" height="600px" />
                            </div>
                        @endif
                        <br>
                    @endforeach
                @endif


            </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.view-btn').click(function() {
                var targetId = $(this).data('target');
                $('#' + targetId).toggle();
            });
        });
    </script>

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
