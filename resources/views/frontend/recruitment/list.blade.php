@extends('frontend.layouts.master_layout')
@section('title', 'Jobs')
@section('css')
    <style>
        .container {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .color-black {
            color: black;
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
        <h2>Care Assistant</h2>

        <ul style="list-style-type: disc;">
            <li>Posting date: 06 January 2024</li>
            <li>Job details</li>
            <li>Posting date: 06 January 2024</li>
            <li>Hours: Full time</li>
            <li>Closing date: 05 February 2024</li>
            <li>Location: Hampshire, South East England</li>
            <li>Company: Care2 Training</li>
            <li>Job type: Permanent</li>
            <li>Job reference:</li>
        </ul>

        <div style="margin-top: 10px;">
            <button onclick="applyForJob()" type="button" class="btn btn-dark">Apply for this job</button>
        </div>

        <p class="color-black" style="margin-top: 10px;">
            <span style="font-size: 22px;"><b>Summary</b></span><br>
            Health Care Assistant - Days & Nights<br>
            CARE2 TRAINING LIMITED – London<br>
            Job Location: Hampshire County Council
        </p>

        <p class="color-black"><i>Health Care Assistant</i> (Must have 6 months experience in the UK)</p>

        <div class="color-black text-justify mb-3">
            <p style="margin-bottom: 0px;"><b>Job Description:</b></p>
            Care2 Training is looking for a compassionate and dedicated Health Care Assistant to join our team in
            providing
            care and support to residents in our care homes that we are currently supplying. The ideal candidate will be
            passionate about providing high-quality care and will have experience working in a similar role.
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;"><b>Responsibilities:</b></p>
            <ul>
                <li>Assisting residents with personal care tasks, such as washing, dressing, and toileting</li>
                <li>Supporting residents with mobility and other physical needs</li>
                <li>Administering medication as directed by medical staff</li>
                <li>Assisting with meal preparation and feeding</li>
                <li>Keeping accurate records of care provided</li>
                <li>Building strong relationships with residents and their families</li>
                <li>Maintaining a clean and safe environment for residents</li>
            </ul>
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;"><b>Requirements:</b></p>
            <ul>
                <li>Previous experience working as a Health Care Assistant in a care home setting</li>
                <li>Mandatory and Statutory training
                <li>Moving & Handling (Theory and Practical)</li>
                <li>Fire Safety</li>
                </li>
                <li>Excellent communication and interpersonal skills</li>
                <li>Ability to work well as part of a team</li>
                <li>A compassionate and caring nature</li>
                <li>Ability to work flexible hours, including weekends and evenings</li>
            </ul>
        </div>

        <div class="color-black text-justify mb-3">
            <p style="margin-bottom: 0px;"><b> As a recruitment agency, we require all our candidates to provide us with
                    certain compliance documents to
                    ensure
                    that they meet our standards. These documents include:</b></p>
            <ul>
                <li>Scanned Colour Passport or Visa</li>
                <li>Passport Sized Photo</li>
                <li>CV (Up to date - with Healthcare work experience)</li>
            </ul>
        </div>

        <div class="color-black text-justify mb-3">
            <p style="margin-bottom: 0px;">
                <b> *Please ensure that you have all these documents and training completed before applying for the
                    position. We do
                    not provide sponsorship for visas, but we can place workers in our company even if they are sponsored by
                    a
                    different company, as they’ll still be allowed to work outside their contractual hours with their
                    sponsored
                    company.
                </b>
            </p>
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;">
                <b> If you're interested in this position, please submit your CV to. We look forward to hearing from you!
                </b>
            </p>
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;">
                <b>Job Types:</b> Full-time, Part-time, Permanent
                <br>
                <b>Job Types:</b> Full-time, Part-time, Permanent
                <br>
                <b>Salary:</b> £11.00-£15.00 per hour
                <br>
                <b>Expected hours:</b> 20 – 50 per week
            </p>
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;">
                <b>Benefits: </b>
            </p>
            <ul>
                <li>Company pension</li>
                <li>Flexitime</li>
                <li>On-site parking</li>
                <li>Referral programme</li>
            </ul>
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;">
                <b>Schedule: </b>
            </p>
            <ul>
                <li>10-hour shift</li>
                <li>Weekend availability</li>
            </ul>
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;">
                <b>Supplemental pay types: </b>
            </p>
            <ul>
                <li>Performance bonus</li>
                <li>Quarterly bonus</li>
            </ul>
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;">
                <b>Ability to commute/relocate:: </b>
            </p>
            <ul>
                <li>England: reliably commute or plan to relocate before starting work (required)</li>
            </ul>
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;">
                <b>Application question(s): </b>
            </p>
            <ul>
                <li>You must have all the qualifications and compliance in order to apply for the position</li>
            </ul>
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;">
                <b>Education: </b>
            </p>
            <ul>
                <li>GCSE or equivalent (preferred)</li>
            </ul>
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;">
                <b>Experience: </b>
            </p>
            <ul>
                <li>Care home (required)</li>
                <li>Home care (preferred)</li>
                <li>Min 1 year (preferred)</li>
            </ul>
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;">
                <b>Language: </b>
            </p>
            <ul>
                <li>English (preferred)</li>
            </ul>
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;">
                <b>Licence/Certification: </b>
            </p>
            <ul>
                <li>Driving Licence (preferred)</li>
            </ul>
        </div>

        <div class="color-black mb-3">
            <p style="margin-bottom: 0px;">
                <b>Work Location: </b>
            </p>
            <ul>
                <li>Hampshire</li>
            </ul>
        </div>

    </div>

    <script>
        function applyForJob() {
            // Check if the user is authenticated
            @auth
            window.location.href = "{{ route('recruitment.create') }}";
        @else
            // If not authenticated, show a Toastr message
            window.location.href = "{{ route('login') }}";
            // toastr.warning('Please login to apply for the job.');
        @endauth
        }
    </script>
@endsection
