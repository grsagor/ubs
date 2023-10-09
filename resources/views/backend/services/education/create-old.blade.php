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
                        <h1>Service Add</h1>
                    </div>
                </div>

                <div class="grid-12-6" style="display: flex; justify-content: center;">
                    <div class="block block_simple block_offered_listing">

                        <div class="block_content">

                            <fieldset>

                                <legend>
                                    Get started with
                                </legend>

                                <div class="form_row form_row_email">
                                    <div class="form_label">
                                        Title<span class="star">*</span>
                                    </div>
                                    <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="title" value="" size="50"
                                                       maxlength="50">
                                            </span>
                                    </div>
                                </div>

                                <div class="form_row form_row_email">
                                    <div class="form_label">
                                        Price(Hourly/Fixed)<span class="star">*</span>
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
                                        Sales Commission<span class="star">*</span>
                                    </div>
                                    <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="sales_commission"  value="" size="50"
                                                       maxlength="50">
                                            </span>
                                    </div>
                                </div>

                                <div class="form_row form_row_email">
                                    <div class="form_label">
                                        Fixed Price / Changeable<span class="star">*</span>
                                    </div>
                                    <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <select name="fixed_price_changeable" id="" class="form-control" maxlength="50">
                                                    <option value="">Select</option>
                                                    <option value="fixed">Fixed</option>
                                                    <option value="changeable">changeable</option>
                                                </select>
                                            </span>
                                    </div>
                                </div>
                                <div class="form_row form_row_email">
                                    <div class="form_label">
                                        Mode of delivery
                                        (Online/Offline)
                                    </div>
                                    <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <select name="fixed_price_changeable" id="" class="form-control" maxlength="50">
                                                    <option value="">Select</option>
                                                    <option value="Online">Online</option>
                                                    <option value="Offline">Offline</option>
                                                </select>
                                            </span>
                                    </div>
                                </div>
                                <div class="form_row form_row_email">
                                    <div class="form_label">
                                        Payment Instalment<span class="star">*</span>
                                    </div>
                                    <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <select name="fixed_price_changeable" id="" class="form-control" maxlength="50">
                                                    <option value="">Select</option>
                                                    <option value="Available">Available</option>
                                                    <option value="Not Available">Not Available</option>
                                                </select>
                                            </span>
                                    </div>
                                </div>
                                <div class="form_row form_row_email">
                                    <div class="form_label">
                                        Delivery Area<span class="star">*</span>
                                    </div>
                                    <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <select name="fixed_price_changeable" id="" class="form-control" maxlength="50">
                                                    <option value="">Select</option>
                                                    <option value="National">National</option>
                                                    <option value="International">International</option>
                                                </select>
                                            </span>
                                    </div>
                                </div>

                                <div class="form_row form_row_email">
                                    <div class="form_label">
                                        Service Warranty<span class="star">*</span>
                                    </div>
                                    <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="service_warranty" value="" size="50"
                                                       maxlength="50">
                                            </span>
                                    </div>
                                </div>

                                <div class="form_row form_row_email">
                                    <div class="form_label">
                                        Service Features<span class="star">*</span>
                                    </div>
                                    <div class="form_inputs">
                                            <span class="form_input form_text">
                                               <input type="text" name="service_features" value="" size="50"
                                                      maxlength="50">
                                            </span>
                                    </div>
                                </div>

                                <div class="form_row form_row_email">
                                    <div class="form_label">
                                        Years of Experiences
                                    </div>
                                    <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="number" step=".01" name="years_of_experiences" value=""
                                                       style="max-width: 152px;">
                                            </span>
                                    </div>
                                </div>

                                <div class="form_row form_row_email">
                                    <div class="form_label">
                                        Specialization
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
                                        Facilities
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

            </form>
        </div>
    </section>

@endsection
