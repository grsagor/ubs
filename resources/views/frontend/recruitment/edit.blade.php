@extends('crm::layouts.app')
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

        h3 {
            text-decoration: underline;
            margin-top: 2px !important;
            margin-bottom: 5px !important;
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

        .col-md-6 {
            padding-left: 0px !important;
        }

        .editPersonalInformation,
        .edit-text-cover-letter,
        .edit-text-expected-salary {
            cursor: pointer;
            /* Add other styles as needed */
        }

        .editPersonalInformation:hover,
        .edit-text-cover-letter:hover,
        .edit-text-expected-salary {
            text-decoration: underline;
        }

        .m-b-10 {
            margin-bottom: 10px !important;
        }

        textarea[name="cover_letter"] {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        @media (max-width: 767px) {
            .col-md-6 {
                padding-right: 0px !important;
            }
        }
    </style>
@endsection

@section('content')

    <section class="content">
        <div class="form-container box box-primary">
            <div id="header">
                <p id="name">{{ $item->name ?? '' }}</p>
                {{-- <a href="mailto:{{ $item->email }}">
                    <p id="email">Send</p>
                </a> --}}
            </div>

            <div class="right">
                <div class="personal-info">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="margin-top: 0;">Personal Information:</h3>
                        <div id="editPersonalInformation" class="editPersonalInformation">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            Edit
                        </div>
                    </div>

                    <p class="font-size personalInformation" id="personalInformation">
                        Phone Number: {{ $item->phone ?? '' }}<br>
                        Email: {{ $item->email ?? '' }}<br>
                        Current Address: {{ $item->current_address ?? '' }}<br>
                        Country of Residence: {{ $item->countryResidence->country_name ?? '' }} <br>
                        Birth Country: {{ $item->birthCountry->country_name ?? '' }}
                    </p>

                    <div class="edit-personal-information m-b-10" style="display: none;">
                        <form action="" id="personalInfoform" method="POST" enctype="multipart/form-data">
                            <div class="form-group col-md-6">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Full name"
                                    value="{{ old('name', $item->name) }}">
                                <span id="name-error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                                    value="{{ old('phone', $item->phone) }}">
                                <span id="phone-error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Email address"
                                    value="{{ old('email', $item->email) }}">
                                <span id="email-error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="current_address">Current address <span class="text-danger">*</span></label>
                                <input type="text" name="current_address" class="form-control"
                                    placeholder="Current Address"
                                    value="{{ old('current_address', $item->current_address) }}">
                                <span id="current_address-error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="country_of_residence">Country of residence <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="country_residence">
                                    <option value="">Select....</option>
                                    @foreach ($country as $cnt)
                                        <option value="{{ $cnt->id }}"
                                            {{ old('country_residence', $cnt->id) == $item->country_residence ? 'selected' : '' }}>
                                            {{ $cnt->country_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="country_residence-error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="birth_country">Birth country <span class="text-danger">*</span></label>
                                <select class="form-control" name="birth_country">
                                    <option selected="" value="">Select....</option>
                                    @foreach ($country as $birthCnt)
                                        <option value="{{ $birthCnt->id }}"
                                            {{ old('country_residence', $birthCnt->id) == $item->birth_country ? 'selected' : '' }}>
                                            {{ $birthCnt->country_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="birth_country-error" class="text-danger"></span>
                            </div>
                            <button type="button" class="btn btn-success personalInfoSubmit">Submit</button>
                            <button type="button" class="btn btn-danger personalInfoClose">Close</button>
                        </form>
                    </div>
                </div>

                <div class="cover-letter">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="margin-top: 0;">Cover letter:</h3>
                        <div id="edit-text-cover-letter" class="edit-text-cover-letter">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            Edit
                        </div>
                    </div>
                    <p class="font-size" id="cover-letter-text">
                        {{ $item->cover_letter ?? '' }}
                    </p>

                    <div class="edit-cover-letter m-b-10" style="display: none;">
                        <form action="" id="coverLetterform" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <textarea name="cover_letter" rows="8" placeholder="Write here cover letter">{{ $item->cover_letter }}</textarea>
                            </div>
                            <button type="button" class="btn btn-success coverLetterSubmit">Submit</button>
                            <button type="button" class="btn btn-danger coverLetterClose">Close</button>
                        </form>
                    </div>
                </div>

                <div class="expected-salary m-b-10">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h4 id="expected-salary-header">Expected Salary
                            £{{ $item->expected_salary }}/{{ $item->salary_type == 1 ? 'hourly' : ($item->salary_type == 2 ? 'monthly' : 'unknown') }}
                        </h4>
                        <div id="edit-text-expected-salary" class="edit-text-expected-salary">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            Edit
                        </div>
                    </div>

                    <div class="edit-expected-salary m-b-10" style="display: none;">
                        <form action="" id="expectedSalaryform" method="POST" enctype="multipart/form-data">
                            <div class="form-group col-md-6">
                                <label for="salary_type">Type</label>
                                <select class="form-control" name="salary_type" required>
                                    <option value="" {{ $item->salary_type == '' ? 'selected' : '' }}>Select....
                                    </option>
                                    <option value="1" {{ $item->salary_type == 1 ? 'selected' : '' }}>Hourly</option>
                                    <option value="2" {{ $item->salary_type == 2 ? 'selected' : '' }}>Monthly
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="expected_salary">Amount </label>
                                <input type="number" step=".01" name="expected_salary" class="form-control"
                                    placeholder="Ex. 1000" required
                                    value="{{ old('expected_salary', $item->expected_salary) }}">
                            </div>
                            <button type="button" class="btn btn-success expectedSalarySubmit">Submit</button>
                            <button type="button" class="btn btn-danger expectedSalaryClose">Close</button>
                        </form>
                    </div>
                </div>

                <div class="experience m-b-10">
                    <h3>Professional Experience</h3>

                    @php
                        $experiences = json_decode($item->experiences, true);

                        if (json_last_error() !== JSON_ERROR_NONE || !is_array($experiences)) {
                            $experiences = [];
                        }
                    @endphp

                    @if (!empty($experiences))
                        @foreach ($experiences as $index => $experience)
                            <h4 id="company-name">Name of experience: {{ $experience['experience_name_of_company'] }}</h4>
                            <p>{{ $experience['experience_start_date'] }} To
                                <span>{{ $experience['experience_end_date'] }}</span>
                            </p>

                            @if (!empty($experience['experience_file']) && file_exists(public_path($experience['experience_file'])))
                                <button class="view-btn"
                                    data-target="additional-files-viewer-{{ $index }}">View</button>
                                <a href="{{ asset($experience['experience_file']) }}"
                                    download="{{ $item->name }}_Experience_Files.pdf">Download</a>
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
                </div>

                <div class="education m-b-10">
                    <h3>Education</h3>

                    @php
                        $educations = json_decode($item->educations, true);

                        if (json_last_error() !== JSON_ERROR_NONE || !is_array($educations)) {
                            $educations = [];
                        }
                    @endphp

                    @if (!empty($educations))
                        @foreach ($educations as $index => $edu)
                            <h4 id="company-name">Name of education: {{ $edu['education_name_of_title'] }}</h4>
                            <p>{{ $edu['education_start_date'] }} To
                                <span>{{ $edu['education_end_date'] }}</span>
                            </p>

                            @if (!empty($edu['education_file']) && file_exists(public_path($edu['education_file'])))
                                <button class="view-btn"
                                    data-target="additional-files-viewer-{{ $index }}">View</button>
                                <a href="{{ asset($edu['education_file']) }}"
                                    download="{{ $item->name }}_Education_Files.pdf">Download</a>
                                <div class="pdf-viewer" id="additional-files-viewer-{{ $index }}"
                                    style="display: none;">
                                    <embed src="{{ asset($edu['education_file']) }}" type="application/pdf"
                                        width="100%" height="600px" />
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p>No education available.</p>
                    @endif
                </div>


                <div class="cv m-b-10">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3>Curriculum Vitae</h3>
                        <div id="edit-text-cv" class="edit-text-cv">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            Edit
                        </div>
                    </div>

                    @if (!empty($item->cv) && file_exists(public_path($item->cv)))
                        <button class="view-btn" data-target="cv-viewer" style="margin-top: 10px;">View</button>
                        <a href="{{ asset($item->cv) }}" download="{{ $item->name }}_Curriculum_Vitae.pdf">Download
                        </a>
                        <div class="pdf-viewer" id="cv-viewer" style="display: none;">
                            <embed src="{{ asset($item->cv) }}" type="application/pdf" width="100%" height="600px" />
                        </div>
                    @endif

                    <div class="edit-cv m-b-10" style="display: none;">
                        <form action="" id="CVform" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="cv">CV</label>
                                <input type="file" name="cv" class="form-control">
                            </div>
                            <button type="button" class="btn btn-success CVSubmit">Submit</button>
                            <button type="button" class="btn btn-danger CVClose">Close</button>
                        </form>
                    </div>
                </div>


                @if (!empty($item->dbs_check) && file_exists(public_path($item->dbs_check)))
                    <h3>DBS Check</h3>
                    <button class="view-btn" data-target="dbs-viewer">View</button>
                    <a href="{{ asset($item->dbs_check) }}" download="{{ $item->name }}_DBS_Check.pdf">Download </a>
                    <div class="pdf-viewer" id="dbs-viewer" style="display: none;">
                        <embed src="{{ asset($item->dbs_check) }}" type="application/pdf" width="100%"
                            height="600px" />
                    </div>
                    <br>
                @endif

                @if (!empty($item->care_certificates) && file_exists(public_path($item->care_certificates)))
                    <h3>Care Certificates</h3>
                    <button class="view-btn" data-target="care-certificates-viewer">View</button>
                    <a href="{{ asset($item->care_certificates) }}"
                        download="{{ $item->name }}_Care_Certificates.pdf">Download</a>
                    <div class="pdf-viewer" id="care-certificates-viewer" style="display: none;">
                        <embed src="{{ asset($item->care_certificates) }}" type="application/pdf" width="100%"
                            height="600px" />
                    </div>
                    <br>
                @endif

                <h3 style="margin-top: 10px !important;">Additional Certificate</h3>

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
                            <button class="view-btn"
                                data-target="additional-files-viewer-{{ $index }}">View</button>
                            <a href="{{ asset($adCertificates['additional_file']) }}"
                                download="{{ $item->name }}_Additional_Files.pdf">Download</a>
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
        document.getElementById("editPersonalInformation").addEventListener("click", function() {
            var editPersonalInfoDiv = document.querySelector('.edit-personal-information');
            // Toggle the 'display' property between 'none' and 'block'
            editPersonalInfoDiv.style.display = (editPersonalInfoDiv.style.display === 'none') ? 'block' : 'none';
        });

        $(document).ready(function() {
            // Add click event to the "Close" button
            $('.personalInfoClose').on('click', function() {
                // Add the 'd-none' class to the 'edit-personal-information' div
                $('.edit-personal-information').css('display', 'none');
            });
        });

        $('.personalInfoSubmit').on('click', function(e) {
            e.preventDefault();
            var id = "{{ $item->uuid }}";
            var formData = $('#personalInfoform').serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            $.ajax({
                url: "{{ route('recruitment.update', ['id' => $item->uuid]) }}",
                type: 'PUT',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    var countryResidenceName = result.country_residence ? result.country_residence
                        .country_name : '';
                    var birthCountryName = result.birth_country ? result.birth_country.country_name :
                        '';

                    $('#name').html(`  ${result.name ?? ''}  `);

                    $('#personalInformation').html(`
                <p class="font-size personalInformation">
                    Phone Number: ${result.phone ?? ''}<br>
                    Email: ${result.email ?? ''}<br>
                    Current Address: ${result.current_address ?? ''}<br>
                    Country of Residence: ${countryResidenceName} <br>
                    Birth Country: ${birthCountryName}
                </p>
            `);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });


        document.getElementById("edit-text-cover-letter").addEventListener("click", function() {
            var editCoverLetterDiv = document.querySelector('.edit-cover-letter');
            // Toggle the 'display' property between 'none' and 'block'
            editCoverLetterDiv.style.display = (editCoverLetterDiv.style.display === 'none') ? 'block' : 'none';
        });

        $(document).ready(function() {
            // Add click event to the "Close" button
            $('.coverLetterClose').on('click', function() {
                // Add the 'd-none' class to the 'edit-personal-information' div
                $('.edit-cover-letter').css('display', 'none');
            });
        });


        $('.coverLetterSubmit').on('click', function(e) {
            e.preventDefault();
            var id = "{{ $item->uuid }}";
            var formData = $('#coverLetterform').serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            $.ajax({
                url: "{{ route('recruitment.update', ['id' => $item->uuid]) }}",
                type: 'PUT',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    $('#cover-letter-text').html(`  ${result.cover_letter ?? ''}  `);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });


        document.getElementById("edit-text-expected-salary").addEventListener("click", function() {
            var editExpectedSalaryDiv = document.querySelector('.edit-expected-salary');
            // Toggle the 'display' property between 'none' and 'block'
            editExpectedSalaryDiv.style.display = (editExpectedSalaryDiv.style.display === 'none') ? 'block' :
                'none';
        });

        $(document).ready(function() {
            // Add click event to the "Close" button
            $('.expectedSalaryClose').on('click', function() {
                // Add the 'd-none' class to the 'edit-personal-information' div
                $('.edit-expected-salary').css('display', 'none');
            });
        });

        $('.expectedSalarySubmit').on('click', function(e) {
            e.preventDefault();
            var id = "{{ $item->uuid }}";
            var formData = $('#expectedSalaryform').serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});


            $.ajax({
                url: "{{ route('recruitment.update', ['id' => $item->uuid]) }}",
                type: 'PUT',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {

                    var expectedSalaryText = 'Expected Salary ' + '£' + (result.expected_salary ?? '') +
                        '/' +
                        (result.salary_type == 1 ? 'hourly' : (result.salary_type == 2 ? 'monthly' :
                            'unknown'));

                    // Assuming you want to update the content of the h4 element and #cover-letter-text
                    $('h4#expected-salary-header').html(expectedSalaryText);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });








        document.getElementById("edit-text-cv").addEventListener("click", function() {
            var editCVDiv = document.querySelector('.edit-cv');
            // Toggle the 'display' property between 'none' and 'block'
            editCVDiv.style.display = (editCVDiv.style.display === 'none') ? 'block' :
                'none';
        });

        $(document).ready(function() {
            $('.CVClose').on('click', function() {
                $('.edit-cv').css('display', 'none');
            });
        });

        $('.CVSubmit').on('click', function(e) {
            e.preventDefault();

            var id = "{{ $item->uuid }}";
            var formData = $('#CVform').serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                console.log('Form data for cv ' + item.value);
                return obj;
            }, {});

            $.ajax({
                url: "{{ route('recruitment.update', ['id' => $item->uuid]) }}",
                type: 'PUT',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    console.log('Success');
                },
                error: function(xhr, status, error) {
                    // console.error(xhr.responseText);
                }
            });
        });


        $(document).ready(function() {
            $('.view-btn').click(function() {
                var targetId = $(this).data('target');
                $('#' + targetId).toggle();
            });
        });
    </script>
@endsection