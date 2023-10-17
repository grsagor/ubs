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
                <div class="row">

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">I am available to move in from</label>
                            <input class="form-control" name="available_form" type="date" id="date" value="{{ $property->available_form }}">
                        </div>
                    </div>

                    <div class="col-sm-12" id="number_of_shared_people_container">
                        <div class="form-group">
                            <label for="invoice_scheme_id">How many people, including yourself, will share the
                                property?</label>
                            <select class="form-control" required="" id="number_of_shared_people"
                                name="number_of_shared_people">
                                <option selected value=0>Select....</option>
                                <option {{ $property->number_of_shared_people == 1 ? 'selected' : '' }} value=1>1</option>
                                <option {{ $property->number_of_shared_people == 2 ? 'selected' : '' }} value=2>2</option>
                                <option {{ $property->number_of_shared_people == 3 ? 'selected' : '' }} value=3>3</option>
                                <option {{ $property->number_of_shared_people == 4 ? 'selected' : '' }} value=4>4</option>
                                <option {{ $property->number_of_shared_people == 5 ? 'selected' : '' }} value=5>5</option>
                                <option {{ $property->number_of_shared_people == 6 ? 'selected' : '' }} value=6>6</option>
                                <option {{ $property->number_of_shared_people == 7 ? 'selected' : '' }} value=7>7</option>
                                <option {{ $property->number_of_shared_people == 8 ? 'selected' : '' }} value=8>8</option>
                                <option {{ $property->number_of_shared_people == 9 ? 'selected' : '' }} value=9>9</option>
                                <option {{ $property->number_of_shared_people == 10 ? 'selected' : '' }} value=10>10</option>
                            </select>
                        </div>
                    </div>

                        <div id="occupants_inputs_container" style="display: none;">
    
                        </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_scheme_id">Where do you want to live?</label>
                            <input class="form-control" placeholder="Area name" name="wanted_living_area"
                                type="text" value="{{ $property->wanted_living_area }}">
                        </div>
                    </div>

                    {{-- <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Occupation</label>
                            <i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true"
                                data-container="body" data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i>
                            <select class="form-control" id="occupation" name="occupation">
                                <option value="Not disclosed" selected="">Not disclosed</option>
                                <option value="Student">Student</option>
                                <option value="Employee">Employee</option>
                                <option value="Others">Others</option>
                                <option value="I don't mind">I don't mind</option>
                            </select>
                        </div>
                    </div>

                    <div id="student_info_container" style="display: none;">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="occupant_university_name">University Name</label>
                                <input class="form-control" name="occupant_university_name[]" type="text"
                                    id="occupant_university_name">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="occupant_degree_name">Degree Name</label>
                                <input class="form-control" name="occupant_degree_name[]" type="text"
                                    id="occupant_degree_name">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="occupant_job">Do you have job?</label>
                                <select class="form-control" id="occupant_job" name="occupant_job[]">
                                    <option selected="" value="">Select....</option>
                                    <option value="1">Part-time</option>
                                    <option value="2">Full-time</option>
                                    <option value="3">Self-employed</option>
                                </select>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Advert title</label>
                            <p class="sub-heading">(Short description)</p>
                            <input class="form-control" placeholder="Short description maximum 92 characters"
                                name="ad_title" type="text" maxlength="100" id="ad_title" value="{{ $property->ad_title }}">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Description</label>
                            <p class="sub-heading">(No contact details permitted within description)</p>
                            <textarea rows="10" type="text" class="form-control" name="ad_text" class="input-field"
                                placeholder="Description">{{ $property->ad_text }}</textarea>
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-center">
                    <button style="margin-top: 0;" class="w-25 btn btn-success" type="submit">Submit</button>
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

        $('#occupation').on('change', function() {
            var isStudent = $(this).val();
            console.log('occupation changed')
            if (isStudent == 'Student') {
                $('#student_info_container input, #student_info_container select, #student_info_container textarea')
                    .prop('disabled', false);
                $('#student_info_container').show();
            } else {
                $('#student_info_container input, #student_info_container select, #student_info_container textarea')
                    .prop('disabled', true);
                $('#student_info_container').hide();
            }
        });

        $('#number_of_shared_people').on('change', function() {
            console.log('number_of_shared_people changed')
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
    })
</script>
