@extends('frontend.layouts.master_layout')
@section('title', 'Recruitment')
@section('css')
    <style>
        /* The container */
        .frontend_container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .frontend_container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            border: 1px solid black;
        }


        /* When the checkbox is checked, add a blue background */
        .frontend_container input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .frontend_container input:checked~.checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .frontend_container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }




        input.select-style,
        select.form-control,
        .form-control {
            width: 100%;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 0;
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 10px;
            height: 34px !important;
            font-size: 13px !important;
        }

        label {
            color: black;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        textarea[name="cover_letter"] {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        .certificate-section {
            display: flex;
            align-items: center;
        }

        .certificate-section input,
        .certificate-section button {
            margin-right: 5px;
        }

        .experience-group:first-child .delete-button,
        .experience-group:nth-child(1) .delete-button {
            display: none;
        }

        .education-group:first-of-type .delete-button {
            display: none;
        }

        .delete-button,
        .add-button {
            padding: 0px 10px;
            line-height: 27px;
        }

        .btn-dark,
        .prev-step {
            padding: 0px 17px;
            line-height: 35px;
        }


        @media (max-width: 767px) {
            .mobileView {
                width: 95% !important;
            }

            textarea[name="cover_letter"] {
                width: 100%;
                box-sizing: border-box;
            }
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <form id="twoStepForm" action="{{ route('recruitment.store') }}" method="POST" style="width: 50%;"
        class="mx-auto mobileView"enctype="multipart/form-data">

        @csrf

        <!-- Hidden input for jobID -->
        <input type="hidden" name="job_id" value="{{ $jobID }}">
        <input type="hidden" name="create_page" value="{{ $create_page ?? null }}">

        <!-- Step 1 -->
        <div class="step card" style="margin-top:50px; margin-bottom: 50px;" id="step1">
            <div class="card-header">
                <h5 class="card-title">Apply Form - Step 1</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="">
                    <span id="name-error" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="phone">Phone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control" placeholder="">
                    <span id="phone-error" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="">
                    <span id="email-error" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="current_address">Current address <span class="text-danger">*</span></label>
                    <input type="text" name="current_address" class="form-control" placeholder="">
                    <span id="current_address-error" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="country_of_residence">Country of residence <span class="text-danger">*</span></label>
                    <select class="form-control" name="country_residence">
                        <option selected="" value="">Select....</option>
                        @foreach ($country as $item)
                            <option value="{{ $item->id }}">{{ $item->country_name }}</option>
                        @endforeach
                    </select>
                    <span id="country_residence-error" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="birth_country">Birth country <span class="text-danger">*</span></label>
                    <select class="form-control" name="birth_country">
                        <option selected="" value="">Select....</option>
                        @foreach ($country as $item)
                            <option value="{{ $item->id }}">{{ $item->country_name }}</option>
                        @endforeach
                    </select>
                    <span id="birth_country-error" class="text-danger"></span>
                </div>


                <label class="frontend_container">Sponsorship required?
                    <input type="checkbox" name="sponsorship" value=1>
                    <span class="checkmark"></span>
                </label>


                <div class="text-center" style="margin-top: 10px;">
                    <button type="button" class="btn btn-dark next-step"
                        onclick="validateForm(); nextStep();">Next</button>
                </div>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="step card" style="margin-top:50px; margin-bottom: 50px;" id="step2">
            <div class="card-header">
                <h5 class="card-title">Apply Form - Step 2</h5>
            </div>
            <div class="card-body" id="experienceSection">

                <h4 class="text-center"><u>Education</u></h4>
                <div class="education-group mt-2" style="border: 1px solid #ccc; padding: 10px;">
                    <div class="form-group">
                        <label>Name of education</label>
                        <input type="text" name="education_name_of_title[]" class="form-control" placeholder="">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="start_date">Start date</label>
                                <input type="date" name="education_start_date[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="end_date">End date</label>
                                <input type="date" name="education_end_date[]" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="education_file">Upload File</label>
                        <input type="file" name="education_file[]" class="form-control"
                            accept=".pdf,.docx,.png,.jpg,.jpeg,.heif,.heic" />
                    </div>


                    <div class="form-group">
                        <button type="button" class="btn btn-danger delete-button" onclick="removeEducation(this)">
                            Delete
                        </button>
                    </div>
                </div>

                <button type="button" class="btn btn-dark add-button" onclick="addEducation()">
                    Add More
                </button>

                <h4 class="text-center"><u>Experience</u></h4>
                <div class="experience-group mt-2" style="border: 1px solid #ccc; padding: 10px;">
                    <div class="form-group">
                        <label for="name_of_company">Title of experience</label>
                        <input type="text" name="experience_name_of_company[]" class="form-control" placeholder="" />
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="start_date">Start date</label>
                                <input type="date" name="experience_start_date[]" class="form-control" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="end_date">End date</label>
                                <input type="date" name="experience_end_date[]" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="experience_file">Upload File</label>
                        <input type="file" name="experience_file[]" class="form-control"
                            accept=".pdf,.docx,.png,.jpg,.jpeg,.heif,.heic" />
                    </div>

                    <button type="button" class="btn btn-danger delete-button" onclick="removeExperience(this)"
                        style="display: none;">
                        Delete
                    </button>
                </div>

                <button type="button" class="btn btn-dark add-button" onclick="addExperience()">
                    Add More
                </button>


                <h4 class="text-center"><u>Additional Files</u></h4>
                <div class="additional-group mt-2" style="border: 1px solid #ccc; padding: 10px;">
                    <div class="form-group">
                        <label>Title of file</label>
                        <input type="text" name="additional_name_of_title[]" class="form-control" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="additional_file">Upload File</label>
                        <input type="file" name="additional_file[]" class="form-control"
                            accept=".pdf,.docx,.png,.jpg,.jpeg,.heif,.heic" />
                    </div>


                    <button type="button" class="btn btn-danger delete-button" onclick="removeAdditonal(this)"
                        style="display: none;">
                        Delete
                    </button>
                </div>

                <button type="button" class="btn btn-dark add-button" onclick="addAdditonal()">
                    Add More
                </button>


                <div class="row" style="margin-top: 10px;">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="salary_type">Expected Salay</label>
                            <select class="form-control" name="salary_type" required>
                                <option selected="" value="">Select....</option>
                                <option value="1">Hourly</option>
                                <option value="2">Monthly</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="expected_salary">Amount </label>
                            <input type="number" step=".01" name="expected_salary" class="form-control"
                                placeholder="" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cv">CV <span class="text-danger">*</span></label>
                    <input type="file" name="cv" class="form-control"
                        accept=".pdf,.docx,.png,.jpg,.jpeg,.heif,.heic" required>
                </div>



                <div class="form-group">
                    <label for="cover_letter">Cover letter <span class="text-danger">*</span></label>
                    <textarea name="cover_letter" rows="8" cols="79" placeholder="" required></textarea>
                </div>

                <div class="text-center">
                    <button type="button" class="btn btn-secondary prev-step" onclick="prevStep()">Previous</button>
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
            </div>
        </div>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        function addCertificatesSection() {
            var certificatesSection = $('#certificatesSection');
            var certificateSectionHtml =
                '<div class="certificate-section">' +
                '<input type="text" name="additional_certificate_titles[]" class="form-control">' +
                '<input type="file" name="additional_certificate_files[]" class="form-control">' +
                '<button type="button" class="btn btn-danger delete-button" onclick="removeCertificateSection(this)">Delete</button>' +
                '</div>';

            certificatesSection.append(certificateSectionHtml);
        }

        function removeCertificateSection(button) {
            $(button).closest('.certificate-section').remove();
        }
    </script>

    <script>
        function addAdditonal() {
            var newAdditional = $(".additional-group:first").clone();
            newAdditional.find("input").val("");
            $(".additional-group:last").after(newAdditional);
            $(".additional-group .delete-button").show();
        }

        function removeAdditonal(button) {
            var additionalGroup = $(button).closest(".additional-group");
            if ($(".additional-group").length > 1) {
                additionalGroup.remove();
            }
            if ($(".additional-group").length === 1) {
                $(".additional-group .delete-button").hide(); // Hide delete button if there is only one section
            }
        }
    </script>
    <script>
        function addEducation() {
            var newEducation = $(".education-group:first").clone();
            newEducation.find("input").val("");
            $(".education-group:last").after(newEducation);
            $(".education-group .delete-button").show();
        }

        function removeEducation(button) {
            var educationGroup = $(button).closest(".education-group");
            if ($(".education-group").length > 1) {
                educationGroup.remove();
            }
            if ($(".education-group").length === 1) {
                $(".education-group .delete-button").hide(); // Hide delete button if there is only one section
            }
        }
    </script>


    <script>
        function addExperience() {
            var newExperience = $(".experience-group:first").clone();
            newExperience.find("input").val("");
            $(".experience-group:last").after(newExperience); // Use after to place the new experience below the last one
            $(".experience-group .delete-button").show(); // Show delete button for all sections
        }

        function removeExperience(button) {
            var experienceGroup = $(button).closest(".experience-group");
            if ($(".experience-group").length > 1) {
                experienceGroup.remove();
            }
            if ($(".experience-group").length === 1) {
                $(".experience-group .delete-button").hide(); // Hide delete button if there is only one section
            }
        }
    </script>

    <script>
        let currentStep = 1;

        function showStep(step) {
            document.getElementById(`step${step}`).classList.add('active');
        }

        function hideStep(step) {
            document.getElementById(`step${step}`).classList.remove('active');
        }

        function validateForm() {
            var name = document.getElementsByName("name")[0].value;
            var phone = document.getElementsByName("phone")[0].value;
            var email = document.getElementsByName("email")[0].value;
            var currentAddress = document.getElementsByName("current_address")[0].value;
            var countryResidence = document.getElementsByName("country_residence")[0].value;
            var birthCountry = document.getElementsByName("birth_country")[0].value;

            if (name === '') {
                document.getElementById('name-error').innerText = 'Name is required.';
                return false;
            } else {
                document.getElementById('name-error').innerText = '';
            }

            if (phone === '') {
                document.getElementById('phone-error').innerText = 'Phone is required.';
                return false;
            } else {
                document.getElementById('phone-error').innerText = '';
            }
            if (email === '') {
                document.getElementById('email-error').innerText = 'Email is required.';
                return false;
            } else {
                document.getElementById('email-error').innerText = '';
            }
            if (currentAddress === '') {
                document.getElementById('current_address-error').innerText = 'Current address is required.';
                return false;
            } else {
                document.getElementById('current_address-error').innerText = '';
            }
            if (countryResidence === '') {
                document.getElementById('country_residence-error').innerText = 'Current residence is required.';
                return false;
            } else {
                document.getElementById('country_residence-error').innerText = '';
            }
            if (birthCountry === '') {
                document.getElementById('birth_country-error').innerText = 'Birth country is required.';
                return false;
            } else {
                document.getElementById('birth_country-error').innerText = '';
            }
            return true;
        }

        function nextStep() {
            if (validateForm()) {
                hideStep(currentStep);
                currentStep = 2;
                showStep(currentStep);
            }
        }

        function prevStep() {
            hideStep(currentStep);
            currentStep = 1;
            showStep(currentStep);
        }

        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);
        });
    </script>
@endsection
