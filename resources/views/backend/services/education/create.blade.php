@extends('layouts.app')
@section('title', 'Advertise-Room')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/rough/root.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/rough/stack.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/rough/advertise.css') }}">
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div>
            <form class="row g-3 mt-2" action="{{ route('service-education.store') }}" id="multi-step-form" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="grid-12">
                    <div class="text-center">
                        <h1>Education</h1>
                    </div>
                </div>

                <div class="grid-12-4" style="display: flex; justify-content: center;">
                    <div>
                        <div class="block block_simple block_offered_listing">

                            <div class="block_content">

                                <fieldset>

                                    <legend>
                                        Get started with
                                    </legend>

                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Course name<span class="star">*</span>
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="course_name" value="" size="50"
                                                    maxlength="50">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Price<span class="star">*</span>
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="price" value="" size="50"
                                                    maxlength="50">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Course Duration<span class="star">*</span>
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="course_duration" value="" size="50"
                                                    maxlength="50">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Institution name<span class="star">*</span>
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="institution_name" value="" size="50"
                                                    maxlength="50">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Requirements
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="requirements" value="" size="50"
                                                    maxlength="50">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Start Date<span class="star">*</span>
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="date" name="start_date" value="">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Intake<span class="star">*</span>
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="date" name="intake" value="" size="50"
                                                    maxlength="50">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Department<span class="star">*</span>
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="department" value="" size="50"
                                                    maxlength="50">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Tution Fee<span class="star">*</span>
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="number" step=".01" name="tuition_fee" value=""
                                                    style="max-width: 152px;">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Scholarship
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="number" step=".01" name="scholarship" value=""
                                                    style="max-width: 152px;">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Modules
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="modules" value="" size="50"
                                                    maxlength="50">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Description
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="description" value="" size="50"
                                                    maxlength="50">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Service Facilites
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="service_facilities" value=""
                                                    size="50" maxlength="50">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Agent Commission
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="number" step=".01" name="agent_commission"
                                                    value="" style="max-width: 152px;">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Thumbnail
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="file" name="thumbnail" value="">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_email">
                                        <div class="form_label">
                                            Images
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="file" name="images[]" multiple value="">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_inputs">
                                        <div class="form_input form_button">
                                            <button class="button" id="continueButton" type="submit" name="submit">
                                                Continue
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>

                            </div>

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>

@endsection
