@extends('frontend.layouts.master_layout')
@section('title', 'Recruitment')
@section('css')
    <style>
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
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <form id="twoStepForm" action="{{ route('recruitment.store') }}" method="POST" style="width: 50%;"
        class="mx-auto"enctype="multipart/form-data">

        @csrf
        <!-- Step 1 -->
        <div class="step card mt-2" id="step1">
            <div class="card-header">
                <h5 class="card-title">Registration Form - Step 1</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Full name">
                    <span id="name-error" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="phone">Phone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                    <span id="phone-error" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="Email address">
                    <span id="email-error" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="current_address">Current address <span class="text-danger">*</span></label>
                    <input type="text" name="current_address" class="form-control" placeholder="Current Address">
                    <span id="current_address-error" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="country_of_residence">Country of residence <span class="text-danger">*</span></label>
                    <input type="text" name="country_residence" class="form-control" placeholder="Country of Residence">
                    <span id="country_residence-error" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="birth_country">Birth country <span class="text-danger">*</span></label>
                    <input type="text" name="birth_country" class="form-control" placeholder="Birth country">
                    <span id="birth_country-error" class="text-danger"></span>
                </div>

                <div class="text-center" style="margin-top: 10px;">
                    <button type="button" class="btn btn-dark next-step"
                        onclick="validateForm(); nextStep();">Next</button>
                </div>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="step card mt-2" id="step2">
            <div class="card-header">
                <h5 class="card-title">Registration Form - Step 2</h5>
            </div>
            <div class="card-body" id="experienceSection">
                <div class="experience-group mt-2" style="border: 1px solid #ccc; padding: 10px;">
                    <h5 class="text-center"><u>Experience</u></h5>
                    <div class="form-group">
                        <label for="name_of_company">Name of company</label>
                        <input type="text" name="name_of_company[]" class="form-control" placeholder="Name of company">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="start_date">Start date</label>
                                <input type="date" name="start_date[]" class="form-control" placeholder="Start date">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="end_date">End date</label>
                                <input type="date" name="end_date[]" class="form-control" placeholder="End date">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="end_date">Upload File</label>
                        <input type="file" name="additional_file[]" class="form-control" placeholder="End date">
                    </div>

                    <div class="form-group">
                        {{-- <button type="button" class="btn btn-danger" onclick="removeExperience(this)">Delete</button> --}}
                        <button type="button" class="btn btn-success" onclick="addExperience()">Add Experience</button>
                    </div>
                </div>

                <div class="row" style="margin-top: 10px;">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="salary_type">Type</label>
                            <select class="form-control" name="salary_type" required>
                                <option selected="" value="">Select....</option>
                                <option value="1">Hourly</option>
                                <option value="2">Monthly</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="expected_salary">Expected salary </label>
                            <input type="number" step=".01" name="expected_salary" class="form-control"
                                placeholder="Expected salary" required>
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <label for="cv">CV </label>
                    <input type="file" name="cv" class="form-control">
                </div>

                <div class="form-group">
                    <label for="dbs">DBS check</label>
                    <input type="file" name="dbs_check" class="form-control">
                </div>

                <div class="form-group">
                    <label for="care_certificate">Care Certificates</label>
                    <input type="file" name="care_certificates" class="form-control">
                </div>

                <div class="form-group">
                    <label for="cover_letter">Cover letter</label>
                    <textarea name="cover_letter" rows="8" cols="79" placeholder="Write here"></textarea>
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
        function addExperience() {
            // Clone the first experience group
            var originalExperienceGroup = $(".experience-group:first");
            var clonedExperienceGroup = originalExperienceGroup.clone();

            // Clear input values in the cloned group
            clonedExperienceGroup.find('input[type="text"]').val('');

            // Remove delete button from the cloned group (if it exists)
            clonedExperienceGroup.find('.btn-danger').remove();

            // Insert the cloned group after the last experience group
            $(".experience-group:last").after(clonedExperienceGroup);

            // Add the delete button only to the newly added group
            clonedExperienceGroup.find('.form-group:last').append(
                '<button type="button" class="btn btn-danger" onclick="removeExperience(this)">Delete</button>');
        }

        // Function to remove an experience group
        function removeExperience(button) {
            // Check if the clicked button is not in the first experience group
            var experienceGroup = $(button).closest('.experience-group');
            if (experienceGroup.index() > 0) {
                // Remove the parent experience-group of the clicked button
                experienceGroup.remove();
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
