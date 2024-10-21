@extends('layouts.app')
@section('title', __('crm::lang.campaigns'))
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

        h4 {
            font-weight: bold;
        }

        .font-size {
            font-size: 15px;
        }


        .view-btn {
            display: inline-block;
        }

        @media (max-width: 767px) {
            #email {
                color: black;
            }
        }
    </style>
@endsection

@section('content')

    @include('crm::layouts.nav')

    <section class="content">
        <div class="form-container box box-primary">
            <div id="header">
                <p id="name"> {{ $details->user->surname }} {{ $details->user->first_name }}
                    {{ $details->user->last_name }}</p>
                <a href="mailto:  {{ $details->user->email }} ">
                    <p id="email">Send</p>
                </a>
            </div>

            <div class="right">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 style="margin-top: 0;">Personal Information:</h4>
                    <button id="copyButton" class="btn btn-success">
                        <i class="fa fa-copy" aria-hidden="true"></i>
                        Copy Link
                    </button>
                </div>

                <p class="font-size">
                    Phone Number: {{ $details->user->contact_no ?? 'N/A' }}<br>
                    Email: {{ $details->user->email ?? 'N/A' }} <br>
                    Current Address: {{ $details->user->current_address ?? 'N/A' }}<br>
                    Origin: {{ $details->contact->country->country_name ?? 'N/A' }} <br>
                </p>

                <h4 style="margin-top: 30px;">Note</h4>
                <p class="font-size">
                    {!! nl2br(e($details->note)) !!}
                </p>

                @php
                    $experiences = json_decode($details->experiences, true);
                    if (json_last_error() !== JSON_ERROR_NONE || !is_array($experiences)) {
                        $experiences = [];
                    }
                @endphp

                @if (!empty($experiences))
                    <h4 style="margin-top: 30px;">Experience</h4>
                    <ul>
                        @foreach ($experiences as $index => $experience)
                            @if (
                                !empty($experience['experience_name_of_company']) ||
                                    (isset($experience['experience_file']) &&
                                        !empty($experience['experience_file']) &&
                                        file_exists(public_path($experience['experience_file']))))
                                <li>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        @if (!empty($experience['experience_name_of_company']))
                                            <p style="margin: 0px;">
                                                {{ $experience['experience_name_of_company'] }}
                                            </p>
                                        @endif

                                        @php
                                            $fileExtension = isset($experience['experience_file'])
                                                ? pathinfo($experience['experience_file'], PATHINFO_EXTENSION)
                                                : '';
                                            $downloadFileName = isset($experience['experience_file'])
                                                ? $details->name . '_Experience_File.' . strtolower($fileExtension)
                                                : '';
                                        @endphp

                                        @if (isset($experience['experience_file']) &&
                                                !empty($experience['experience_file']) &&
                                                file_exists(public_path($experience['experience_file'])))
                                            @if (strtolower($fileExtension) !== 'docx')
                                                <a href="javascript:void(0)" class="view-btn"
                                                    data-target="experience-viewer-{{ $index }}"
                                                    style="color: #007bff;">View</a>
                                            @endif
                                            <a href="{{ asset($experience['experience_file']) }}"
                                                download="{{ $downloadFileName }}" style="color: #007bff;">Download</a>
                                        @endif
                                    </div>

                                    @if (!empty($experience['experience_start_date']) || !empty($experience['experience_end_date']))
                                        <p>
                                            {{ !empty($experience['experience_start_date']) ? $experience['experience_start_date'] : 'N/A' }}
                                            To
                                            <span>{{ !empty($experience['experience_end_date']) ? $experience['experience_end_date'] : 'N/A' }}</span>
                                        </p>
                                    @endif

                                    @if (isset($experience['experience_file']) &&
                                            !empty($experience['experience_file']) &&
                                            file_exists(public_path($experience['experience_file'])))
                                        <div class="pdf-viewer" id="experience-viewer-{{ $index }}"
                                            style="display: none;">
                                            @if (strtolower($fileExtension) === 'pdf')
                                                <embed src="{{ asset($experience['experience_file']) }}"
                                                    type="application/pdf" width="100%" height="600px" />
                                            @elseif (in_array(strtolower($fileExtension), ['png', 'jpg', 'jpeg', 'heif', 'heic']))
                                                <img src="{{ asset($experience['experience_file']) }}"
                                                    style="max-height: 300px; width: auto;" />
                                            @endif
                                        </div>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif

                @php
                    $educations = json_decode($details->educations, true);

                    if (json_last_error() !== JSON_ERROR_NONE || !is_array($educations)) {
                        $educations = [];
                    }
                @endphp

                @if (!empty($educations))
                    <h4 style="margin-top: 30px;">Education</h4>

                    <ul>
                        @foreach ($educations as $index => $edu)
                            @if (!empty($edu['education_name_of_title']))
                                <li>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <p id="education-title" style="margin: 0px;">
                                            {{ $edu['education_name_of_title'] }}
                                        </p>

                                        @php
                                            // Check if the file key exists before accessing it
                                            $fileExtension = isset($edu['education_file'])
                                                ? pathinfo($edu['education_file'], PATHINFO_EXTENSION)
                                                : '';
                                            $downloadFileName = isset($edu['education_file'])
                                                ? $details->name . '_Education_File.' . strtolower($fileExtension)
                                                : '';
                                        @endphp

                                        @if (isset($edu['education_file']) && !empty($edu['education_file']) && file_exists(public_path($edu['education_file'])))
                                            @if (in_array(strtolower($fileExtension), ['pdf', 'png', 'jpg', 'jpeg', 'heif', 'heic']))
                                                <a href="javascript:void(0)" class="view-btn"
                                                    data-target="education-viewer-{{ $index }}"
                                                    style="color: #007bff;">View</a>
                                            @endif
                                            <a href="{{ asset($edu['education_file']) }}"
                                                download="{{ $downloadFileName }}" style="color: #007bff;">Download</a>
                                        @endif
                                    </div>

                                    @if (!empty($edu['education_start_date']) || !empty($edu['education_end_date']))
                                        <p style="margin-top: 5px;">
                                            {{ !empty($edu['education_start_date']) ? $edu['education_start_date'] : 'N/A' }}
                                            To
                                            <span>{{ !empty($edu['education_end_date']) ? $edu['education_end_date'] : 'N/A' }}</span>
                                        </p>
                                    @endif

                                    @if (isset($edu['education_file']) && !empty($edu['education_file']) && file_exists(public_path($edu['education_file'])))
                                        <div class="pdf-viewer" id="education-viewer-{{ $index }}"
                                            style="display: none;">
                                            @if ($fileExtension === 'pdf')
                                                <embed src="{{ asset($edu['education_file']) }}" type="application/pdf"
                                                    width="100%" height="600px" />
                                            @elseif (in_array(strtolower($fileExtension), ['png', 'jpg', 'jpeg', 'heif', 'heic']))
                                                <img src="{{ asset($edu['education_file']) }}"
                                                    style="max-height: 300px; width: auto;" />
                                            @endif
                                        </div>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif


                @if (!empty($details->cv) && file_exists(public_path($details->cv)))
                    <h4 style="margin-top: 30px;">Curriculum Vitae</h4>
                    <ul>
                        <li>
                            <span>CV:</span>
                            @php
                                // Ensure the file exists before proceeding
                                $fileExtension = pathinfo($details->cv, PATHINFO_EXTENSION);
                                $downloadFileName = $details->name . '_Curriculum_Vitae.' . strtolower($fileExtension);
                            @endphp

                            @if (in_array(strtolower($fileExtension), ['pdf', 'png', 'jpg', 'jpeg', 'heif', 'heic']))
                                <a href="javascript:void(0)" class="view-btn" data-target="cv-viewer"
                                    style="color: #007bff;">View</a>
                            @endif

                            <a href="{{ asset($details->cv) }}" download="{{ $downloadFileName }}"
                                style="color: #007bff; margin-left: 10px;">Download</a>

                            <div class="pdf-viewer" id="cv-viewer" style="display: none; margin-top: 10px;">
                                @if ($fileExtension === 'pdf')
                                    <embed src="{{ asset($details->cv) }}" type="application/pdf" width="100%"
                                        height="600px" />
                                @elseif (in_array(strtolower($fileExtension), ['png', 'jpg', 'jpeg', 'heif', 'heic']))
                                    <img src="{{ asset($details->cv) }}" style="max-height: 300px; width: auto;" />
                                @else
                                    <p>Cannot preview this file type.</p>
                                @endif
                            </div>
                        </li>
                    </ul>
                @endif


                @php
                    $additionalCertificates = json_decode($details->additional_files, true);

                    if (json_last_error() !== JSON_ERROR_NONE || !is_array($additionalCertificates)) {
                        $additionalCertificates = [];
                    }
                @endphp

                @if (!empty($additionalCertificates))
                    <h4 style="margin-top: 30px;">Additional Files</h4>
                    <ul>
                        @foreach ($additionalCertificates as $index => $adCertificates)
                            @if (!empty($adCertificates['additional_name_of_title']))
                                <li>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <p id="certificate-name" style="margin: 3px;">
                                            {{ $adCertificates['additional_name_of_title'] }}
                                        </p>

                                        @php
                                            // Check if the file key exists before accessing it
                                            $fileExtension = isset($adCertificates['additional_file'])
                                                ? pathinfo($adCertificates['additional_file'], PATHINFO_EXTENSION)
                                                : '';
                                            $downloadFileName = isset($adCertificates['additional_file'])
                                                ? $details->name . '_Additional_File.' . strtolower($fileExtension)
                                                : '';
                                        @endphp

                                        @if (isset($adCertificates['additional_file']) &&
                                                !empty($adCertificates['additional_file']) &&
                                                file_exists(public_path($adCertificates['additional_file'])))
                                            @if (in_array(strtolower($fileExtension), ['pdf', 'png', 'jpg', 'jpeg', 'heif', 'heic']))
                                                <a href="javascript:void(0)" class="view-btn"
                                                    data-target="additional-files-viewer-{{ $index }}"
                                                    style="color: #007bff;">View</a>
                                            @endif
                                            <a href="{{ asset($adCertificates['additional_file']) }}"
                                                download="{{ $downloadFileName }}" style="color: #007bff;">Download</a>
                                        @endif
                                    </div>

                                    @if (isset($adCertificates['additional_file']) &&
                                            !empty($adCertificates['additional_file']) &&
                                            file_exists(public_path($adCertificates['additional_file'])))
                                        <div class="pdf-viewer" id="additional-files-viewer-{{ $index }}"
                                            style="display: none;">
                                            @if ($fileExtension === 'pdf')
                                                <embed src="{{ asset($adCertificates['additional_file']) }}"
                                                    type="application/pdf" width="100%" height="600px" />
                                            @elseif (in_array(strtolower($fileExtension), ['png', 'jpg', 'jpeg', 'heif', 'heic']))
                                                <img src="{{ asset($adCertificates['additional_file']) }}"
                                                    style="max-height: 300px; width: auto;" />
                                            @else
                                                <p>Cannot preview this file type.</p>
                                            @endif
                                        </div>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
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
            var textToCopy = '{{ route('campaignApplicantDetails', $details->id) }}';
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
