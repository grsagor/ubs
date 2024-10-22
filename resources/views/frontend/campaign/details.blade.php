<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Campaign</title>

    <!-- Title logo -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/title_fav.png') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            overflow-x: hidden;
        }

        img {
            width: 150px;
            height: 50px;
            object-fit: contain;
            display: block;
            margin: 0 auto 10px;
        }

        .details {
            font-size: 16px;
            margin: 0;
            color: #000;
            text-align: center;
        }

        .description {
            margin: 10px auto;
            padding: 10px;
        }

        .title_header {
            margin-top: 0;
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        .body_text {
            font-size: 17px;
            line-height: 1.6;
        }

        .body_text p,
        .body_text li,
        .body_text ul,
        .body_text div {
            word-wrap: break-word;
            /* Allows long words to break and wrap to the next line */
            word-break: break-word;
            /* Breaks long words and wraps them */
            white-space: normal;
            /* Ensures the text wraps normally */
        }

        .contact-button {
            display: inline-block;
            background-color: #333;
            color: white;
            padding: 2px 7px;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            margin-top: 20px;
            transition: 0.3s ease;
        }

        .contact-button:hover {
            background-color: #555;
        }

        hr {
            margin: 20px auto;
        }

        .contact-form {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            f
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            height: 34px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        .btn {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #555;
        }

        .add-button {
            display: inline-block;
            color: white;
            padding: 2px 7px;
            text-decoration: none;
            border-radius: 5px;
        }


        .delete-button {
            background-color: #dc3545;
            color: white;
            padding: 2px 7px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 5px;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        .text-danger {
            color: red;
            font-size: 14px;
        }

        .text-center {
            text-align: center;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }


        h4 {
            text-align: center;
            font-size: 20px;
            margin: 20px 0;
        }

        .mt-50 {
            margin-top: 50px;
        }

        .mt-20 {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="row justify-content-center mt-20">
        <div class="col-md-5">
            <img src="{{ asset($campaign->businessLocation->logo) }}" alt="Company Logo">

            <p class="details" style="font-weight: bold; margin: 10px;">{{ $campaign->businessLocation->name }}</p>
            <p class="details">{{ $address }}</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="description">
                <p class="title_header" style="text-align: center">{{ $campaign->subject }}</p>
                <div class="body_text"> {!! $campaign->email_body ?? '' !!} </div>

                <hr class="mt-50">

                <div class="contact-section mt-50" style="text-align: center;">
                    <a href="#contact" class="contact-button" id="contactButton">Contact</a>
                </div>
            </div>
        </div>
    </div>

    {{-- User information form --}}
    <div class="row justify-content-center mt-50">
        <div class="col-md-5">
            <div class="contact-form" id="contactForm" style="display: none;">
                <form action="{{ route('campaign.details.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="crm_campaign_id" id="crm_campaign_id" value="{{ $campaign->id }}">

                    @php
                        // Assuming $campaign->info_from_customer is a JSON string
                        $checkbox_data = json_decode($campaign->info_from_customer, true); // Decode JSON to array
                        // Debugging output (optional)
                    @endphp

                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="">
                        <span id="name-error" class="text-danger"></span>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="number" name="phone" class="form-control" placeholder="" required>
                                <span id="phone-error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" placeholder=""
                                    required>
                                <span id="email-error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="current_address">Current Address <span class="text-danger">*</span></label>
                        <input type="text" name="current_address" class="form-control" placeholder="" required>
                        <span id="current_address-error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="birth_country">Origin <span class="text-danger">*</span></label>
                        <select class="form-control" name="birth_country" required>
                            <option selected="" value="">Select...</option>
                            @foreach ($country as $item)
                                <option value="{{ $item->id }}">{{ $item->country_name }}</option>
                            @endforeach
                        </select>
                        <span id="birth_country-error" class="text-danger"></span>
                    </div>

                    {{-- Education section --}}
                    @if (isset($checkbox_data['checkbox_education']) && $checkbox_data['checkbox_education'] == 1)
                        <h4 class="text-center mt-50"><u>Education</u></h4>
                        <div class="education-group mt-20" style="border: 1px solid #ccc; padding: 15px;">
                            <div class="form-group">
                                <label>Name of education <span class="text-danger">*</span></label>
                                <input type="text" name="education_name_of_title[]" class="form-control"
                                    placeholder="" required>
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
                                <label for="end_date">Upload File <span class="text-danger">*</span></label>
                                <input type="file" name="education_file[]" class="form-control"
                                    accept=".pdf,.docx,.jpeg,.jpg,.png,.heic" required style="margin-bottom: unset;">
                                <span style="color: #878787; font-size: 13px;">Supported file
                                    types: pdf, docx,
                                    jpeg, jpg, png, heic</span>
                            </div>

                            <button type="button" style="display: none;" class="btn btn-danger delete-button"
                                onclick="removeEducation(this)">
                                Delete
                            </button>
                        </div>

                        <button type="button" class="btn btn-dark add-button" onclick="addEducation()">
                            Add More
                        </button>
                    @endif

                    {{-- Experience section --}}
                    @if (isset($checkbox_data['checkbox_experience']) && $checkbox_data['checkbox_experience'] == 1)
                        <h4 class="text-center mt-50"><u>Experience</u></h4>
                        <div class="experience-group mt-20" style="border: 1px solid #ccc; padding: 15px;">
                            <div class="form-group">
                                <label for="name_of_company">Title of experience <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="experience_name_of_company[]" class="form-control"
                                    placeholder="" required />
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="start_date">Start date <span class="text-danger">*</span></label>
                                        <input type="date" name="experience_start_date[]" class="form-control"
                                            required />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="end_date">End date <span class="text-danger">*</span></label>
                                        <input type="date" name="experience_end_date[]" class="form-control"
                                            required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="experience_file">Upload File </label>
                                <input type="file" name="experience_file[]" class="form-control"
                                    accept=".pdf,.docx,.jpeg,.jpg,.png,.heic" style="margin-bottom: unset;">
                                <span style="color: #878787; font-size: 13px;">Supported
                                    file types: pdf, docx, jpeg, jpg, png, heic</span>
                            </div>

                            <button type="button" class="btn btn-danger delete-button"
                                onclick="removeExperience(this)" style="display: none;">
                                Delete
                            </button>
                        </div>

                        <button type="button" class="btn btn-dark add-button" onclick="addExperience()">
                            Add More
                        </button>
                    @endif

                    {{-- This is default, do not use any condition --}}
                    <h4 class="text-center mt-50"><u>Add Files</u></h4>
                    <div class="additional-group mt-20" style="border: 1px solid #ccc; padding: 15px;">
                        <div class="form-group">
                            <label>Title of file</label>
                            <input type="text" name="additional_name_of_title[]" class="form-control"
                                placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="additional_file">Upload File </label>
                            <input type="file" name="additional_file[]" class="form-control"
                                accept=".pdf,.docx,.jpeg,.jpg,.png,.heic" style="margin-bottom: unset;">
                            <span style="color: #878787; font-size: 13px;">Supported
                                file types: pdf, docx, jpeg, jpg, png, heic</span>
                        </div>

                        <button type="button" class="btn btn-danger delete-button" onclick="removeAdditonal(this)"
                            style="display: none;">
                            Delete
                        </button>
                    </div>

                    <button type="button" class="btn btn-dark add-button" onclick="addAdditonal()">
                        Add More
                    </button>

                    {{-- CV section --}}
                    @if (isset($checkbox_data['checkbox_cv']) && $checkbox_data['checkbox_cv'] == 1)
                        <h4 class="text-center mt-50"><u>CV</u></h4>
                        <div class="form-group">
                            <input type="file" name="cv" class="form-control"
                                accept=".pdf,.docx,.jpeg,.jpg,.png,.heic" required style="margin-bottom: unset;">
                            <span style="color: #878787; font-size: 13px;">Supported file types:
                                pdf, docx, jpeg, jpg, png,
                                heic</span>
                        </div>
                    @endif

                    {{-- This is default, do not use any condition --}}
                    {{-- Note section --}}
                    <h4 class="text-center mt-50"><u>Note</u></h4>
                    <div class="form-group">
                        <textarea name="note" class="form-control" rows="8" placeholder="" style="min-height: 100px;"></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="contact-button">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            @if (session('status'))
                toastr.success("{{ session('status')['msg'] }}");
            @endif
        });
    </script>

    <script>
        $(document).ready(function() {
            var emailExists = false; // A flag to track if the email exists

            $('#email').on('blur', function() {
                var email = $(this).val();
                var crm_campaign_id = $('#crm_campaign_id').val();

                // Clear previous error message
                $('#email-error').text('');

                if (email) {
                    $.ajax({
                        url: "{{ route('check.email.for.contact') }}", // Correct route to check email
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            email: email,
                            crm_campaign_id: crm_campaign_id
                        },
                        success: function(response) {
                            if (response.exists) {
                                // Display error message if email exists
                                $('#email-error').text(response.message);

                                // If a contact ID is returned, log or display it
                                if (response.crm_contact_id) {
                                    $('#email-error').append('<br>Contact ID: ' + response
                                        .crm_contact_id);
                                }

                                emailExists = true; // Set flag to true since email exists
                            } else {
                                emailExists = false; // Reset flag if email doesn't exist
                            }
                        },
                        error: function(xhr, status, error) {
                            // Log any unexpected errors
                            // console.error(xhr.responseText); 
                        }
                    });
                }
            });

            // Prevent form submission if the email exists
            $('form').on('submit', function(e) {
                if (emailExists) {
                    e.preventDefault(); // Stop form submission
                    $('#email-error').text('You have already submitted this form.');
                }
            });
        });
    </script>

    <script>
        document.getElementById('contactButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            document.getElementById('contactForm').style.display = 'block'; // Show the form
            this.style.display = 'none'; // Hide the contact button
        });
    </script>

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
</body>

</html>
