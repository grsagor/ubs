<script>
    // Get the input element by its ID
    var roomAvailableFromInput = document.getElementById('room_available_from');

    // Get the current date in the format YYYY-MM-DD
    var currentDate = new Date().toISOString().split('T')[0];

    // Set the min attribute of the input to the current date
    roomAvailableFromInput.min = currentDate;

    $(document).ready(function() {
        // Show "Room 1" by default
        $("#room1").show();

        // Hide additional rooms initially
        $(".form_room_fieldset:not(#room1)").hide();

        // Show the selected number of additional rooms
        $("#roomQuantitySelect").change(function() {
            var selectedQuantity = parseInt($(this).val());

            // Hide all additional rooms
            $(".form_room_fieldset:not(#room1)").hide();

            // Show only the selected number of additional rooms
            for (var i = 2; i <= selectedQuantity; i++) {
                $("#room" + i).show();
            }
        });
    });
</script>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Property wanted form</h4>
        </div>

        <div class="modal-body">
            <form id="property_wanted_form" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div id="showingbtn1" class="row">

                    <input type="hidden" value="{{ $category->id }}" name="category_id">
                    <input type="hidden" value="{{ $sub_category->id }}" name="sub_category_id">

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Property Type</label>
                            <select class="form-control" id="child_category_id" name="child_category_id" required>
                                <option value="">Select....</option>
                                @foreach ($child_categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <span class="error text-danger" id="child_category_id-error--property_wanted_create"></span>
                        </div>
                    </div>
                    <div class="col-sm-12" id="number_of_bed_rooms_id">
                        <label for="selling_price_group_id">Number of bed rooms</label>
                        <select class="form-control" id="property_size" name="property_size" required>
                            <option value="">Select....</option>
                            @foreach (['1 Bed Room', '2 Bed Rooms', '3 Bed Rooms', '4 Bed Rooms', '5+ Bed Rooms'] as $key => $item)
                                <option value="{{ $key + 1 }}">{{ $item }}
                                </option>
                            @endforeach
                        </select>
                        <span class="error text-danger" id="property_size-error--property_wanted_create"></span>
                    </div>

                    <div id="rooms_inputs_container">

                    </div>

                    <div class="col-sm-12" id="number_of_shared_people_container">
                        <div class="form-group">
                            <label for="invoice_scheme_id">How many people, including yourself, will share the
                                property?</label>
                            <select class="form-control" id="number_of_shared_people" name="number_of_shared_people"
                                required>
                                <option selected value=0>Select....</option>
                                <option value=1>1</option>
                                <option value=2>2</option>
                                <option value=3>3</option>
                                <option value=4>4</option>
                                <option value=5>5</option>
                                <option value=6>6</option>
                                <option value=7>7</option>
                                <option value=8>8</option>
                                <option value=9>9</option>
                                <option value=10>10</option>
                            </select>
                            <span class="error text-danger"
                                id="number_of_shared_people-error--property_wanted_create"></span>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Why is searching?</label>
                            <textarea name="why_is_searching" class="form-control" type="text" rows="6"
                                placeholder="Maximum 100 characters"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_scheme_id">Where do you want to live?</label>
                            <input class="form-control" placeholder="Area name" name="wanted_living_area" type="text"
                                required>
                            <span class="error text-danger"
                                id="wanted_living_area-error--property_wanted_create"></span>
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
                                    <span class="error text-danger"
                                        id="combined_budget-error--property_wanted_create"></span>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control" id="per" name="per">
                                        <option value="">Per week or month</option>
                                        <option value="per week">per week</option>
                                        <option value="per month">per month</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">I am available to move in from</label>
                            <input class="form-control" name="available_form" type="date" id="date" required>
                            <span class="error text-danger" id="available_form-error--property_wanted_create"></span>
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
                                    <option value="{{ $value }}">
                                        {{ $label }}</option>
                                @endforeach
                            </select>
                            <span class="error text-danger" id="min_term-error--property_wanted_create"></span>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_scheme_id">I want to stay in the accommodation</label>
                            <select class="form-control" id="days_of_wk_available" name="days_of_wk_available">
                                <option value="7 days a week">7 days a week
                                </option>
                                <option value="Mon to Fri only">Mon to Fri only
                                </option>
                                <option value="Weekends only">Weekends only
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>I would prefer these amenities</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div><label for="furnished"><input type="checkbox" name="roomfurnishings[]"
                                                value="furnished" id="furnished">Furnished</label></div>
                                    <div><label for="living_room"><input type="checkbox" name="roomfurnishings[]"
                                                value="living_room" id="living_room">Shared living room</label></div>
                                    <div><label for="washing_machine"><input type="checkbox" name="roomfurnishings[]"
                                                value="washing_machine" id="washing_machine">Washing
                                            machine</label></div>
                                    <div><label for="garden"><input type="checkbox" name="roomfurnishings[]"
                                                value="garden" id="garden">Garden/roof terrace</label></div>
                                    <div><label for="balcony"><input type="checkbox" name="roomfurnishings[]"
                                                value="balcony" id="balcony">Balcony/patio</label></div>
                                </div>
                                <div class="col-sm-6">
                                    <div><label for="off_street_parking"><input type="checkbox"
                                                name="roomfurnishings[]" value="off_street_parking"
                                                id="off_street_parking">Parking</label></div>
                                    <div><label for="garage"><input type="checkbox" name="roomfurnishings[]"
                                                value="garage" id="garage">Garage</label></div>
                                    <div><label for="disabled_access"><input type="checkbox" name="roomfurnishings[]"
                                                value="disabled_access" id="disabled_access">Disabled
                                            access</label></div>
                                    <div><label for="broadband"><input type="checkbox" name="roomfurnishings[]"
                                                value="broadband" id="broadband">Broadband</label></div>
                                    <div><label for="ensuite"><input type="checkbox" name="roomfurnishings[]"
                                                value="ensuite" id="ensuite">En-suite</label></div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>

                <div id="showingbtn2" class="d-none row" style="display:none;">


                </div>

                <div id="showingbtn3" class="row" style="display:none;">

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


<!-- Selected sports will be displayed here -->
</div>
<!--==================== Blog Section End ====================-->
{{-- Modal --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __('License Key') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">{{ __('The Licenes Key is :') }} <span id="key"></span></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
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
                url: "/contact/show-occupants-details-inputs-create",
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
            console.log('changed');
            var isStudent = $(this).val();
            if (isStudent == 'Student') {
                $.ajax({
                    url: "/contact/show-student-info-container-create",
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
        });

    });
</script>
<script>
    $(document).ready(function() {
        $("#next1").click(function(event) {
            console.log($('#child_category_id').val())
            event.preventDefault();

            var formData = $(
                "#property_wanted_form #showingbtn1 input[required], #property_wanted_form #showingbtn1 select[required]"
            ).serializeArray();
            var jsonData = {};

            $.each(formData, function() {
                jsonData[this.name] = this.value;
            });

            var isValid = true;

            $.each(formData, function(index, field) {
                if (!field.value) {
                    isValid = false;
                    $('#' + field.name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                        .text(
                            'This field is required.');
                    $('#' + field.name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                        .show();
                } else {
                    $('#' + field.name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                        .hide();
                }
            });

            if (isValid) {
                var data = {
                    child_category_id: $('#child_category_id').val(),
                }
                $.ajax({
                    url: "/contact/show-second-step",
                    type: "get",
                    data: data,
                    dataType: "json",
                    success: function(data) {
                        if ($('#child_category_id').val() == 11) {
                            $("#showingbtn2").html(data.html)
                            $("#showingbtn1").css('display', 'none');
                            $("#showingbtn2").css('display', 'block');
                            $("#nextprev1").css('display', 'none');
                            $("#nextprev2").css('display', 'block');
                            $("#showingbtn3").empty();
                        } else {
                            $("#showingbtn3").html(data.html)
                            $("#showingbtn1").css('display', 'none');
                            $("#showingbtn3").css('display', 'block');
                            $("#nextprev1").css('display', 'none');
                            $("#nextprev3").css('display', 'block');
                            $("#showingbtn2").empty();
                        }
                    }
                });
            }
        });
        $("#next2").click(function(event) {
            console.log('click 2')
            console.log($('#child_category_id').val())
            event.preventDefault();

            if ($('#child_category_id').val() == 11) {
                var formData = $(
                    "#property_wanted_form #showingbtn2 input[required], #property_wanted_form #showingbtn2 select[required]"
                ).serializeArray();
            } else {
                var formData = $(
                    "#property_wanted_form #showingbtn3 input[required], #property_wanted_form #showingbtn3 select[required]"
                ).serializeArray();
            }

            console.log(formData)


            var jsonData = {};

            $.each(formData, function() {
                jsonData[this.name] = this.value;
            });

            var isValid = true;

            $.each(formData, function(index, field) {
                if (!field.value) {
                    isValid = false;
                    $('#' + field.name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                        .text(
                            'This field is required.');
                    $('#' + field.name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                        .show();
                } else {
                    $('#' + field.name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                        .hide();
                }
            });



            if (isValid) {
                var data = {
                    child_category_id: 1111111111111
                }
                $.ajax({
                    url: "/contact/show-second-step",
                    type: "get",
                    data: data,
                    dataType: "json",
                    success: function(data) {
                        $("#showingbtn3").html(data.html)
                        $("#showingbtn2").css('display', 'none');
                        $("#showingbtn3").css('display', 'block');
                        $("#nextprev2").css('display', 'none');
                        $("#nextprev3").css('display', 'block');
                    }
                });
            }
        });
        $("#next3").click(function(event) {
            console.log('click 3')
            event.preventDefault();

            var formData = $(
                "#property_wanted_form #showingbtn3 input[required], #property_wanted_form #showingbtn3 select[required]"
            ).serializeArray();
            var jsonData = {};

            $.each(formData, function() {
                jsonData[this.name] = this.value;
            });

            var isValid = true;

            var fileInputField = $("#property_wanted_form #showingbtn3 input[type='file']");
            if (!fileInputField[0].value) {
                isValid = false;
                $('#' + fileInputField[0].name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                    .text(
                        'This field is required.');
                $('#' + fileInputField[0].name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                    .show();
            } else {
                $('#' + fileInputField[0].name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                    .hide();
            }

            $.each(formData, function(index, field) {
                if (!field.value) {
                    isValid = false;
                    $('#' + field.name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                        .text(
                            'This field is required.');
                    $('#' + field.name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                        .show();
                } else {
                    $('#' + field.name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                        .hide();
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
<script>
    $(document).ready(function() {
        $("#property_wanted_form").submit(function(event) {
            event.preventDefault();
            var formData = $("#property_wanted_form").serializeArray();
            var jsonData = {};
            $.each(formData, function() {
                jsonData[this.name] = this.value;
            });
            
            var formDataCheck = $(
                "#property_wanted_form #showingbtn4 input[required], #property_wanted_form #showingbtn4 select[required]"
            ).serializeArray();
            console.log(formDataCheck)
            var jsonDataCheck = {};
            $.each(formDataCheck, function() {
                jsonDataCheck[this.name] = this.value;
            });
            var isValid = true;
            $.each(formDataCheck, function(index, field) {
                if (!field.value) {
                    isValid = false;
                    $('#' + field.name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                        .text(
                            'This field is required.');
                    $('#' + field.name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                        .show();
                } else {
                    $('#' + field.name.replace(/\[\]/g, '') + '-error--property_wanted_create')
                        .hide();
                }
            });
            if (isValid) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/contact/property-wanted-store",
                    data: JSON.stringify(jsonData),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(response) {
                        toastr.options = {
                            "sound": false,
                        };
                        toastr.success(response.msg);
                        $('#property_wanted_form').find('input, textarea, select').val(
                            '');
                        $('.property_wanted_add_modal').modal('hide');
                        $('#room_to_rent_share_table').DataTable().ajax.reload();
                    },
                });
            }
        });
    });
</script>
