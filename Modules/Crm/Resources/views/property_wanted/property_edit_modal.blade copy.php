<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit property wanted</h4>
        </div>

        <div class="modal-body">
            <form id="property_wanted_edit_form" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $property->id }}">
                <div id="showingbtn1" class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Property Type</label>
                            <select class="form-control" id="child_category_id" name="child_category_id" required>
                                <option selected="" value="">Select....</option>
                                @foreach ($child_categories as $item)
                                    <option {{ $property->child_category_id == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <span class="error text-danger" id="child_category_id-error"></span>
                        </div>
                    </div>
                    <div class="col-sm-12" id="number_of_bed_rooms_id">
                        <label for="selling_price_group_id">Number of bed rooms</label>
                        <select class="form-control" id="property_size" name="property_size" required>
                            <option>Select....</option>
                            @foreach (['1 Bed Room', '2 Bed Rooms', '3 Bed Rooms', '4 Bed Rooms', '5+ Bed Rooms'] as $key => $item)
                                <option {{ $property->property_size == $key + 1 ? 'selected' : '' }}
                                    value="{{ $key + 1 }}">{{ $item }}
                                </option>
                            @endforeach
                        </select>
                        <span class="error text-danger" id="property_size-error"></span>
                    </div>

                    <div id="rooms_inputs_container">
                        @if ($property && $property->room_details)
                            @foreach ($property->room_details as $index => $item)
                                <div class="col-sm-12" style="margin-bottom: 15px;">
                                    <label>Size of room-{{ $index + 1 }}</label>
                                    <div class="form_inputs">
                                        <label class="form_input form_radio"><input type="radio"
                                                name="room_details[{{ $index }}]"
                                                {{ $item == 1 ? 'checked' : '' }} value=1>Single</label>
                                        <label class="form_input form_radio"><input type="radio"
                                                name="room_details[{{ $index }}]"
                                                {{ $item == 2 ? 'checked' : '' }} value=2>Double</label>
                                        <label class="form_input form_radio"><input type="radio"
                                                name="room_details[{{ $index }}]"
                                                {{ $item == 6 ? 'checked' : '' }} value=6>Semi-double </label>
                                        <label class="form_input form_radio"><input type="radio"
                                                name="room_details[{{ $index }}]"
                                                {{ $item == 7 ? 'checked' : '' }} value=7>En-suit</label>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="col-sm-12" id="number_of_shared_people_container">
                        <div class="form-group">
                            <label for="invoice_scheme_id">How many people, including yourself, will share the
                                property?</label>
                            <select class="form-control" id="number_of_shared_people" name="number_of_shared_people"
                                required>
                                <option selected value=0>Select....</option>
                                <option {{ $property->number_of_shared_people == 1 ? 'selected' : '' }} value=1>1
                                </option>
                                <option {{ $property->number_of_shared_people == 2 ? 'selected' : '' }} value=2>2
                                </option>
                                <option {{ $property->number_of_shared_people == 3 ? 'selected' : '' }} value=3>3
                                </option>
                                <option {{ $property->number_of_shared_people == 4 ? 'selected' : '' }} value=4>4
                                </option>
                                <option {{ $property->number_of_shared_people == 5 ? 'selected' : '' }} value=5>5
                                </option>
                                <option {{ $property->number_of_shared_people == 6 ? 'selected' : '' }} value=6>6
                                </option>
                                <option {{ $property->number_of_shared_people == 7 ? 'selected' : '' }} value=7>7
                                </option>
                                <option {{ $property->number_of_shared_people == 8 ? 'selected' : '' }} value=8>8
                                </option>
                                <option {{ $property->number_of_shared_people == 9 ? 'selected' : '' }} value=9>9
                                </option>
                                <option {{ $property->number_of_shared_people == 10 ? 'selected' : '' }} value=10>10
                                </option>
                            </select>
                            <span class="error text-danger" id="number_of_shared_people-error"></span>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Why is searching?</label>
                            <textarea name="why_is_searching" class="form-control" type="text" rows="6"
                                placeholder="Maximum 100 characters">{{ $property->why_is_searching }}</textarea>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_scheme_id">Where do you want to live?</label>
                            <input class="form-control" placeholder="Area name" name="wanted_living_area" type="text"
                                value="{{ $property->wanted_living_area }}" required>
                            <span class="error text-danger" id="wanted_living_area-error"></span>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_scheme_id">Your budget</label>
                            <p class="">(total rental amount you can afford)</p>
                            <div class="row">
                                <div class="col-sm-7">
                                    <input class="form-control" placeholder="4" name="combined_budget" type="number"
                                        id="custom_field1" required>
                                    <span class="error text-danger" id="combined_budget-error"></span>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control" id="per" name="per">
                                        <option value="" selected="">Per week or month</option>
                                        <option {{ $property->per == 'per week' ? 'selected' : '' }} value="per week">
                                            per week</option>
                                        <option {{ $property->per == 'per month' ? 'selected' : '' }}
                                            value="per month">per month</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">I am available to move in from</label>
                            <input class="form-control" name="available_form" type="date" id="date"
                                value="{{ $property->available_form }}" required>
                            <span class="error text-danger" id="available_form-error"></span>
                        </div>
                    </div>

                    @php
                        $months = [
                            '1 month' => '1 month',
                            '2 months' => '2 months',
                            '3 months' => '3 months',
                            '4 months' => '4 months',
                            '5 months' => '5 months',
                            '6 months' => '6 months',
                            '7 months' => '7 months',
                            '8 months' => '8 months',
                            '9 months' => '9 months',
                            '10 months' => '10 months',
                            '11 months' => '11 months',
                            '1 year' => '1 year',
                            '1 year 3 months' => '1 year 3 months',
                            '1 year 6 months' => '1 year 6 months',
                            '1 year 9 months' => '1 year 9 months',
                            '2 years' => '2 years',
                            '3 years' => '3 years',
                        ];
                    @endphp

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_scheme_id">Period accommodation needed for</label>
                            <select class="form-control" id="min_term" name="min_term" required>
                                <option value="0" selected>No maximum
                                </option>
                                @foreach ($months as $value => $label)
                                    <option {{ $property->min_term == $value ? 'selected' : '' }}
                                        value="{{ $value }}">
                                        {{ $label }}</option>
                                @endforeach
                            </select>
                            <span class="error text-danger" id="min_term-error"></span>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_scheme_id">I want to stay in the accommodation</label>
                            <select class="form-control" id="days_of_wk_available" name="days_of_wk_available">
                                <option {{ $property->days_of_wk_available == '7 days a week' ? 'selected' : '' }}
                                    value="7 days a week">7 days a week
                                </option>
                                <option {{ $property->days_of_wk_available == 'Mon to Fri only' ? 'selected' : '' }}
                                    value="Mon to Fri only">Mon to Fri only
                                </option>
                                <option {{ $property->days_of_wk_available == 'Weekends only' ? 'selected' : '' }}
                                    value="Weekends only">Weekends only
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>I would prefer these amenities</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    @foreach (['furnished', 'living_room', 'washing_machine', 'garden', 'balcony'] as $option)
                                        <div>
                                            <label for="{{ $option }}">
                                                <input type="checkbox" name="roomfurnishings[]"
                                                    value="{{ $option }}" id="{{ $option }}"
                                                    @if (in_array($option, $property->roomfurnishings)) checked @endif>
                                                {{ ucfirst(str_replace('_', ' ', $option)) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-sm-6">
                                    @foreach (['off_street_parking', 'garage', 'disabled_access', 'broadband', 'ensuite'] as $option)
                                        <div>
                                            <label for="{{ $option }}">
                                                <input type="checkbox" name="roomfurnishings[]"
                                                    value="{{ $option }}" id="{{ $option }}"
                                                    @if (in_array($option, $property->roomfurnishings)) checked @endif>
                                                {{ ucfirst(str_replace('_', ' ', $option)) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>




                </div>

                <div id="showingbtn2" class="d-none row" style="display:none;">
                    <h4 class="modal-title" style="padding: 12px;">Your Household preferences</h4>

                    @if ($property->age)
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="invoice_scheme_id">Age range</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select class="form-control" id="age" name="age[]">
                                            <option value="">Select...</option>
                                            @foreach (range(18, 99) as $age)
                                                <option {{ $property->age[0] == $age ? 'selected' : '' }}
                                                    value="{{ $age }}">
                                                    {{ $age }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-1" style="width: 5%">
                                        <p class="text-center" style="font-size: 15px; margin-top: 5px;">To</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="age" name="age[]">
                                            <option value="">Select...</option>
                                            @foreach (range(18, 99) as $age)
                                                <option {{ $property->age[1] == $age ? 'selected' : '' }}
                                                    value="{{ $age }}">
                                                    {{ $age }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Occupation</label>
                            <select class="form-control" id="occupation" name="occupation" required>
                                <option {{ $property->occupation == 'Not disclosed' ? 'selected' : '' }}
                                    value="Not disclosed" selected="">Not disclosed</option>
                                <option {{ $property->occupation == 'Student' ? 'selected' : '' }} value="Student">
                                    Student</option>
                                <option {{ $property->occupation == 'Employee' ? 'selected' : '' }} value="Employee">
                                    Employee</option>
                                <option {{ $property->occupation == 'Others' ? 'selected' : '' }} value="Others">
                                    Others</option>
                                <option {{ $property->occupation == "I don't mind" ? 'selected' : '' }}
                                    value="I don't mind">I don't mind</option>
                            </select>
                            <span class="error text-danger" id="occupation-error"></span>
                        </div>
                    </div>

                    <div id="student_info_container">

                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Smoking?</label>
                            <select class="form-control" id="smoking_current" name="smoking_current">
                                <option {{ $property->smoking_current == '2' ? 'selected' : '' }} value="2">no
                                </option>
                                <option {{ $property->smoking_current == '1' ? 'selected' : '' }} value="1">yes
                                </option>
                                <option {{ $property->smoking_current == "I don't mind" ? 'selected' : '' }}
                                    value="I don't mind">I don't mind</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Pets?</label>
                            <select class="form-control" id="pets" name="pets">
                                <option {{ $property->smoking_current == '2' ? 'selected' : '' }} value="2"
                                    selected="">no</option>
                                <option {{ $property->smoking_current == '1' ? 'selected' : '' }} value="1">yes
                                </option>
                                <option {{ $property->smoking_current == "I don't mind" ? 'selected' : '' }}
                                    value="I don't mind">I don't mind</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Preferred sex</label>
                            <select class="form-control" id="gay_lesbian" name="gay_lesbian">
                                <option {{ $property->gay_lesbian == 'Undisclosed' ? 'selected' : '' }}
                                    value="Undisclosed" selected="">Undisclosed</option>
                                <option {{ $property->gay_lesbian == 'Straight' ? 'selected' : '' }} value="Straight">
                                    Straight</option>
                                <option {{ $property->gay_lesbian == 'Gay/Lesbian' ? 'selected' : '' }}
                                    value="Gay/Lesbian">Gay/Lesbian</option>
                                <option {{ $property->gay_lesbian == 'Bisexual' ? 'selected' : '' }} value="Bisexual">
                                    Bisexual</option>
                                <option {{ $property->gay_lesbian == "I don't mind" ? 'selected' : '' }}
                                    value="I don't mind">I don't mind</option>
                            </select>
                            <label class="form_input form_checkbox">
                                <input {{ $property->gay_consent ? '1' == 'checked' : '' }} type="checkbox"
                                    name="gay_consent" value="1">
                                Yes, Check this strictly
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Preferred language</label>
                            <select class="form-control" id="lang_id" name="lang_id">
                                @foreach ($languages as $item)
                                    <option {{ $property->lang_id == $item ? 'selected' : '' }}
                                        value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Preferred nationality</label> <i
                                class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true"
                                data-container="body" data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i>
                            <select class="form-control" id="nationality" name="nationality">

                                <option value="---">Select country</option>
                                @foreach ($countries as $item)
                                    <option {{ $property->nationality == $item ? 'selected' : '' }}
                                        value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                {{-- <div id="showingbtn2" class="row" style="display:none;">
                    <div class="col-sm-12 input_group_title_container">
                        <h6>Your flatmate preference</h6>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Gender</label>
                            <select class="form-control" id="gender_req" name="gender_req">
                                <option selected="" value="">Select....</option>
                                @foreach (getSex() as $item)
                                    <option value="{{ $item['value'] }}"
                                        {{ $property->gender_req == $item['value'] ? 'selected' : '' }}>
                                        {{ $item['label'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Smoking</label>
                            <select class="form-control" id="smoking" name="smoking">
                                <option {{ $property->smoking == "Don't mind" ? 'selected' : '' }} value="Don't mind">
                                    Don't mind</option>
                                <option {{ $property->smoking == 'No thanks' ? 'selected' : '' }} value="No thanks">No
                                    thanks</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Pets</label>
                            <select class="form-control" id="pets_req" name="pets_req">
                                <option {{ $property->pets_req == "Don't mind" ? 'selected' : '' }}
                                    value="Don't mind">Don't mind</option>
                                <option {{ $property->pets_req == 'No thanks' ? 'selected' : '' }} value="No thanks">
                                    No thanks</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Orientation</label>
                            <select class="form-control" id="gay_lesbian_req" name="gay_lesbian_req">
                                <option {{ $property->gay_lesbian_req == 'Not important' ? 'selected' : '' }}
                                    value="Not important" selected="">Not important</option>
                                <option {{ $property->gay_lesbian_req == 'Straight' ? 'selected' : '' }}
                                    value="Straight">Straight</option>
                                <option {{ $property->gay_lesbian_req == 'Gay/Lesbian' ? 'selected' : '' }}
                                    value="Gay/Lesbian">Gay/Lesbian</option>
                                <option {{ $property->gay_lesbian_req == 'Bisexual' ? 'selected' : '' }}
                                    value="Bisexual">Bisexual</option>
                            </select>
                        </div>
                    </div>
                </div> --}}
                <div id="showingbtn3" class="row" style="display:none;">

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Advert title</label>
                            <p class="sub-heading">(Short description)</p>
                            <input class="form-control" placeholder="Short description maximum 92 characters"
                                value="{{ $property->ad_title }}" name="ad_title" type="text" maxlength="100"
                                id="ad_title" required>
                            <span class="error text-danger" id="ad_title-error"></span>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Description</label>
                            <p class="sub-heading">(No contact details permitted within description)</p>
                            <textarea rows="30" type="text" class="form-control" name="ad_text" class="input-field"
                                placeholder="Description" required>{{ $property->ad_text }}</textarea>
                            <span class="error text-danger" id="ad_text-error"></span>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Upload your profile picture</label>
                            <input class="form-control" name="images[]" type="file" id="imageUpload" required>
                            <span class="error text-danger" id="images-error"></span>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Telephone</label>
                            <input class="form-control" value="{{ $property->tel }}" placeholder="Telephone"
                                name="tel" type="text" id="tel" required>
                            <span class="error text-danger" id="tel-error"></span>
                        </div>
                    </div>
                </div>
                <div id="showingbtn4" class="row" style="display:none;">
                    <div id="occupants_inputs_container">

                    </div>
                </div>


                <div id="nextprev1">
                    <div class="d-flex gap-1 justify-content-center">
                        <button id="next1" type="button"
                            class="btn btn-primary float-none w-25 rounded-0 submit-btn">Next</button>
                    </div>
                </div>
                <div style="display:none;" id="nextprev2">
                    <div class="d-flex gap-1 justify-content-center">
                        <button id="prev2" type="button"
                            class="btn btn-primary float-none w-25 rounded-0 submit-btn ">Previous</button>
                        <button id="next2" type="button"
                            class="btn btn-primary float-none w-25 rounded-0 submit-btn">Next</button>
                    </div>
                </div>
                <div style="display:none;" id="nextprev3">
                    <div class="d-flex gap-1 justify-content-center">
                        <button id="prev3" type="button"
                            class="btn btn-primary float-none w-25 rounded-0 submit-btn ">Previous</button>
                        <button id="next3" type="button"
                            class="btn btn-primary float-none w-25 rounded-0 submit-btn">Next</button>
                    </div>
                </div>
                <div style="display:none;" id="nextprev4">
                    <div class="d-flex gap-1 justify-content-center">
                        <button id="prev4" type="button"
                            class="btn btn-primary float-none w-25 rounded-0 submit-btn ">Previous</button>
                        <button style="margin-top: 0;" class="addProductSubmit-btn w-25 btn btn-success"
                            type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
        </div>


    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<style>
    .left-area {
        text-align: right;
    }

    .heading {
        font-size: 14px;
        color: #0d3359;
        font-weight: 600;
        margin-bottom: 0px;
    }

    #property_wanted_form select {
        width: 100%;
        padding: 0 20px 0px;
        border-radius: 0px;
        color: #5a6f84;
        height: 35px !important;
        font-size: 14px;
        margin-bottom: 15px;
        background: #fff;
        border-radius: 4px;
        border: 1px solid rgba(0, 0, 0, 0.15);
        -webkit-appearance: revert !important;
    }

    .input-field {
        width: 100%;
        padding: 0px 20px 0px;
        border-radius: 0px;
        color: #5a6f84;
        height: 35px !important;
        font-size: 14px;
        margin-bottom: 15px;
        border-radius: 4px;
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.15);
    }

    .img-upload {
        text-align: left;
    }

    .img-upload #image-preview {
        width: 240px;
        height: 240px;
        border: 1px dashed #000;
        color: #ecf0f1;
        position: relative;
        background-repeat: no-repeat !important;
        background-position: center !important;
    }

    .check-container input[type="checkbox"] {
        background-color: black;
    }

    .input_group_title_container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .input_group_title_container h6 {
        font-size: 22px;
        font-weight: bold;
    }

    .d-flex {
        display: flex !important;
    }

    .gap-1 {
        gap: 15px;
    }

    .justify-content-center {
        justify-content: center;
    }
</style>
<script>
    $(document).ready(function() {
        $("#property_wanted_edit_form").submit(function(event) {
            event.preventDefault();

            var formData = $("#property_wanted_edit_form").serializeArray();
            var jsonData = {};

            $.each(formData, function() {
                jsonData[this.name] = this.value;
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/contact/update-property-wanted",
                data: JSON.stringify(jsonData),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(response) {
                    toastr.options = {
                        "sound": false,
                    };
                    toastr.success(response.message);
                    $('#property_wanted_edit_form').find('input, textarea, select').val(
                        '');
                    $('.property_wanted_edit_modal').modal('hide');
                    $('#room_to_rent_share_table').DataTable().ajax.reload();
                },
            });
        });
    })
</script>
<script>
    $(document).ready(function() {
        $('#imageUpload').on('change', function(e) {
            var previewContainer = $('#previewContainer');
            previewContainer.empty();
            $.each(e.target.files, function(index, file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var image = $('<img>').attr('src', event.target.result);
                    previewContainer.append(image);
                };
                reader.readAsDataURL(file);
            });
        });
    });

    $(document).ready(function() {
        // $("#next1").click(function() {
        //     if ($('#child_category_id').val() == 11) {
        //         $("#showingbtn1").css('display', 'none');
        //         $("#showingbtn2").css('display', 'block');
        //         $("#nextprev1").css('display', 'none');
        //         $("#nextprev2").css('display', 'block');
        //     } else {
        //         $("#showingbtn1").css('display', 'none');
        //         $("#showingbtn3").css('display', 'block');
        //         $("#nextprev1").css('display', 'none');
        //         $("#nextprev3").css('display', 'block');
        //     }
        // });

        // $("#next2").click(function() {
        //     $("#showingbtn2").css('display', 'none');
        //     $("#showingbtn3").css('display', 'block');
        //     $("#nextprev2").css('display', 'none');
        //     $("#nextprev3").css('display', 'block');
        // });
        // $("#next3").click(function() {
        //     $("#showingbtn3").css('display', 'none');
        //     $("#showingbtn4").css('display', 'block');
        //     $("#nextprev3").css('display', 'none');
        //     $("#nextprev4").css('display', 'block');
        // });

        $("#prev2").click(function() {
            $("#showingbtn1").css('display', 'block');
            $("#showingbtn2").css('display', 'none');
            $("#nextprev1").css('display', 'block');
            $("#nextprev2").css('display', 'none');
        });

        $("#prev3").click(function() {
            if ($('#child_category_id').val() == 11) {
                $("#showingbtn2").css('display', 'block');
                $("#showingbtn3").css('display', 'none');
                $("#nextprev2").css('display', 'block');
                $("#nextprev3").css('display', 'none');
            } else {
                $("#showingbtn1").css('display', 'block');
                $("#showingbtn3").css('display', 'none');
                $("#nextprev1").css('display', 'block');
                $("#nextprev3").css('display', 'none');
            }
        });

        $("#prev4").click(function() {
            $("#showingbtn3").css('display', 'block');
            $("#showingbtn4").css('display', 'none');
            $("#nextprev3").css('display', 'block');
            $("#nextprev4").css('display', 'none');
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Open the modal
        $('#openModal').click(function() {
            $('#myModal').modal('show');
        });

        // Close the modal
        $('.close').click(function() {
            $('#myModal').modal('hide');
        });

        // Search functionality
        $('#searchBar').keyup(function() {
            var filter = $(this).val().toLowerCase();
            $('#sportsList li').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(filter) > -1);
            });
        });
        // Sport selection
        $('#sportsList .list-group-item').click(function() {
            $(this).toggleClass('active');
            $(this).toggleClass('selected'); // Add 'selected' class to change background color
        });

        $('#number_of_shared_people').change(function() {
            var num = $(this).val();
            $.ajax({
                url: "/contact/show-occupants-details-inputs",
                type: "get",
                data: {
                    num: num
                },
                dataType: "json",
                success: function(data) {
                    $('#occupants_inputs_container').empty()
                    $('#occupants_inputs_container').html(data.html)
                    $('#occupants_inputs_container').show()
                }
            });
        })

        $('#child_category_id').change(function() {
            var value = $(this).val();
            if (value == 11) {
                $('#rooms_inputs_container input').prop('disabled', false);
                $('#rooms_inputs_container').show();
            } else {
                $('#rooms_inputs_container').hide();
                $('#rooms_inputs_container input').prop('disabled', true);
            }
            if (value == 14) {
                $("#number_of_bed_rooms_id").css('display', 'none');
            } else {
                $("#number_of_bed_rooms_id").css('display', 'block');
            }
        })

        $('#property_size').change(function() {
            var num = $(this).val();
            $.ajax({
                url: "/contact/show-room-details-inputs",
                type: "get",
                data: {
                    num: num
                },
                dataType: "json",
                success: function(data) {
                    $('#rooms_inputs_container').empty()
                    $('#rooms_inputs_container').html(data.html)
                    $('#rooms_inputs_container').show()
                }
            });
        })

        $('#occupation').change(function() {
            var isStudent = $(this).val();
            if (isStudent == 'Student') {
                $.ajax({
                    url: "/contact/show-student-info-container-edit",
                    type: "get",
                    dataType: "json",
                    success: function(data) {
                        $('#student_info_container').empty()
                        $('#student_info_container').html(data.html)
                    }
                });
            } else {
                $('#student_info_container').empty()
            }
        })
    });
</script>
<script>
    $(document).ready(function() {
        $("#next1").click(function(event) {
            event.preventDefault();

            var formData = $("#property_wanted_edit_form #showingbtn1 input[required]")
                .serializeArray();
            var jsonData = {};

            $.each(formData, function() {
                jsonData[this.name] = this.value;
            });

            var isValid = true;

            $.each(formData, function(index, field) {
                if (!field.value) {
                    isValid = false;
                    $('#' + field.name.replace(/\[\]/g, '') + '-error').text(
                        'This field is required.');
                    $('#' + field.name.replace(/\[\]/g, '') + '-error').show();
                } else {
                    $('#' + field.name.replace(/\[\]/g, '') + '-error').hide();
                }
            });

            if (isValid) {
                if ($('#child_category_id').val() == 11) {
                    $("#showingbtn1").css('display', 'none');
                    $("#showingbtn2").css('display', 'block');
                    $("#nextprev1").css('display', 'none');
                    $("#nextprev2").css('display', 'block');
                } else {
                    $("#showingbtn1").css('display', 'none');
                    $("#showingbtn3").css('display', 'block');
                    $("#nextprev1").css('display', 'none');
                    $("#nextprev3").css('display', 'block');
                }
            }
        });
        $("#next2").click(function(event) {
            event.preventDefault();

            if ($('#child_category_id').val() == 11) {
                var formData = $("#property_wanted_edit_form #showingbtn2 input[required]")
                    .serializeArray();
            } else {
                var formData = $("#property_wanted_edit_form #showingbtn3 input[required]")
                    .serializeArray();
            }

            var jsonData = {};

            $.each(formData, function() {
                jsonData[this.name] = this.value;
            });

            var isValid = true;

            $.each(formData, function(index, field) {
                if (!field.value) {
                    isValid = false;
                    $('#' + field.name.replace(/\[\]/g, '') + '-error').text(
                        'This field is required.');
                    $('#' + field.name.replace(/\[\]/g, '') + '-error').show();
                } else {
                    $('#' + field.name.replace(/\[\]/g, '') + '-error').hide();
                }
            });

            if (isValid) {
                $("#showingbtn2").css('display', 'none');
                $("#showingbtn3").css('display', 'block');
                $("#nextprev2").css('display', 'none');
                $("#nextprev3").css('display', 'block');
            }
        });
        $("#next3").click(function(event) {
            event.preventDefault();

            var formData = $("#property_wanted_edit_form #showingbtn3 input[required]")
        .serializeArray();
            var jsonData = {};

            $.each(formData, function() {
                jsonData[this.name] = this.value;
            });

            var isValid = true;

            var fileInputField = $("#property_wanted_edit_form #showingbtn3 input[type='file']");
            if (!fileInputField[0].value) {
                isValid = false;
                $('#' + fileInputField[0].name.replace(/\[\]/g, '') + '-error').text(
                    'This field is required.');
                $('#' + fileInputField[0].name.replace(/\[\]/g, '') + '-error').show();
            } else {
                $('#' + fileInputField[0].name.replace(/\[\]/g, '') + '-error').hide();
            }

            $.each(formData, function(index, field) {
                if (!field.value) {
                    isValid = false;
                    $('#' + field.name.replace(/\[\]/g, '') + '-error').text(
                        'This field is required.');
                    $('#' + field.name.replace(/\[\]/g, '') + '-error').show();
                } else {
                    $('#' + field.name.replace(/\[\]/g, '') + '-error').hide();
                }
            });

            if (isValid) {
                $("#showingbtn3").css('display', 'none');
                $("#showingbtn4").css('display', 'block');
                $("#nextprev3").css('display', 'none');
                $("#nextprev4").css('display', 'block');
            }
        });
    })
</script>
