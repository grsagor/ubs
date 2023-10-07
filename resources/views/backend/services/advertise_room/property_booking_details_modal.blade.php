<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><b
                    aria-hidden="true">&times;</b></button>
            <h4 class="modal-title">Property Booking Details</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <p><b>Title:</b>
                        {{ $booking_details->service_advertise->advert_title }}</p>
                    <hr style="border: 1px solid #8a8a8a; margin: 10px 0; height: 0px;">
                </div>
                <div class="col-md-12">
                    <p> <b>Number of shared
                            people:</b>{{ $booking_details->number_of_shared_people }} </p>
                </div>
                <div class="col-md-12">
                    <p><b>Period accommodation needed
                            for:</b>{{ $booking_details->preriod_accommodation_needed }}
                    </p>
                </div>
                <div class="col-md-12">
                    <p><b>Want to stay in the
                            accommodation:</b>{{ $booking_details->want_stay_accommodation }}
                    </p>
                </div>
                <div class="col-md-12">
                    <p><b>Email:</b>{{ $booking_details->email }}
                    </p>
                </div>
                <div class="col-md-12">
                    <p><b>Mobile:</b>{{ $booking_details->mobile }}
                    </p>

                </div>
                <div class="col-md-12">

                    @foreach ($booking_occupant_details as $key => $occupant)
                        <hr style="border: 1px solid #8a8a8a; margin: 10px 0; height: 0px;">

                        <p><b>Occupants Details - {{ $key + 1 }}</b></p>

                        <div>

                            <p><b>Name:</b>
                                @if ($occupant['occupant_name'])
                                    {{ $occupant['occupant_name'] }}
                                @else
                                    N/A
                                @endif
                            </p>

                            <p><b>Gender:</b>
                                @if ($occupant['occupant_gender_req'] == 1)
                                    Male
                                @elseif ($occupant['occupant_gender_req'] == 2)
                                    Female
                                @elseif ($occupant['occupant_gender_req'] == 3)
                                    Others
                                @else
                                    N/A
                                @endif
                            </p>

                            <p>
                                <b>Age:</b>
                                @if ($occupant['occupant_age'])
                                    {{ $occupant['occupant_age'] }}
                                @else
                                    N/A
                                @endif
                            </p>

                            <p><b>Relationship:</b>
                                @if ($occupant['occupant_relationship'] == 1)
                                    Family (Family member if relation is
                                    Father/Mother/Son/Daughter/Brother/Sister/Husband/Wife)
                                @elseif ($occupant['occupant_relationship'] == 2)
                                    Relatives (Uncle/ Aunty/Cousin/ Brother-in-law/ Sister-in-law)
                                @elseif ($occupant['occupant_relationship'] == 3)
                                    Friends
                                @elseif ($occupant['occupant_relationship'] == 4)
                                    Others
                                @elseif ($occupant['occupant_relationship'] == 5)
                                    Contact Person(The person as the point of contact or responsible party.)
                                @else
                                    N/A
                                @endif
                            </p>

                            <p><b>Occupation:</b>
                                @if ($occupant['occupant_occupation'] == 1)
                                    Student
                                @elseif ($occupant['occupant_occupation'] == 2)
                                    Employee
                                @elseif ($occupant['occupant_occupation'] == 3)
                                    Others
                                @else
                                    N/A
                                @endif
                            </p>

                            <p>
                                <b>Designation:</b>
                                @if ($occupant['occupant_designation'])
                                    {{ $occupant['occupant_designation'] }}
                                @else
                                    N/A
                                @endif
                            </p>

                            <p>
                                <b>Job Type:</b>
                                @if ($occupant['occupant_job_type'] == 1)
                                    Part-time
                                @elseif ($occupant['occupant_job_type'] == 2)
                                    Full-time
                                @elseif ($occupant['occupant_job_type'] == 3)
                                    Self-employed
                                @else
                                    N/A
                                @endif
                            </p>

                            <p>
                                <b>Monthly income before tax:</b>
                                @if ($occupant['occupant_miat'])
                                    {{ $occupant['occupant_miat'] }}
                                @else
                                    N/A
                                @endif
                            </p>

                            <p>
                                <b>University Name:</b>
                                @if ($occupant['occupant_university_name'])
                                    {{ $occupant['occupant_university_name'] }}
                                @else
                                    N/A
                                @endif
                            </p>

                            <p>
                                <b>Degree Name:</b>
                                @if ($occupant['occupant_degree_name'])
                                    {{ $occupant['occupant_degree_name'] }}
                                @else
                                    N/A
                                @endif
                            </p>

                            <p>
                                <b>Pay Rent:</b>
                                @if ($occupant['occupant_pay_rent'] == 0)
                                    No
                                @elseif ($occupant['occupant_pay_rent'] == 1)
                                    Yes
                                @else
                                    N/A
                                @endif
                            </p>

                            <p>
                                <b>Nationality:</b>
                                @if ($occupant['occupant_nationality'])
                                    {{ $occupant['occupant_nationality'] }}
                                @else
                                    N/A
                                @endif
                            </p>

                            <p>
                                <b>Visa Status:</b>
                                @if ($occupant['occupant_visa_status'])
                                    {{ $occupant['occupant_visa_status'] }}
                                @else
                                    N/A
                                @endif
                            </p>

                            <p><b>Photo:</b>
                                @if ($occupant['occupant_photo'])
                                    {{ $occupant['occupant_photo'] }}
                                @else
                                    N/A
                                @endif
                            </p>

                            <p>
                                <b>Passport:</b>
                                @if ($occupant['occupant_passport_id'])
                                    {{ $occupant['occupant_passport_id'] }}
                                @else
                                    N/A
                                @endif
                            </p>

                            <p>
                                <b>Pay Slip:</b>
                                @if ($occupant['occupant_pay_slip'])
                                    {{ $occupant['occupant_pay_slip'] }}
                                @else
                                    N/A
                                @endif
                            </p>


                            <p>
                                <b>Bank Statement:</b>
                                @if ($occupant['occupant_bank_statement'])
                                    {{ $occupant['occupant_bank_statement'] }}
                                @else
                                    N/A
                                @endif
                            </p>

                            <p>
                                <b>Other Documents:</b>
                                @if ($occupant['occupant_other_documents'])
                                    {{ $occupant['occupant_other_documents'] }}
                                @else
                                    N/A
                                @endif
                            </p>

                        </div>
                    @endforeach


                </div>
            </div>
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
        $("#property_rent_edit_form").submit(function(event) {
            event.preventDefault();

            var formData = $("#property_rent_edit_form").serializeArray();
            var jsonData = {};

            $.each(formData, function() {
                jsonData[this.name] = this.value;
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/update-property-rent",
                data: JSON.stringify(jsonData),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(response) {
                    toastr.options = {
                        "sound": false,
                    };
                    toastr.success(response.message);
                    $('#property_rent_edit_form').find('input, textarea, select').val(
                        '');
                    $('.property_rent_edit_modal').modal('hide');
                    $('#room_to_rent_share_table').DataTable().ajax.reload();
                },
            });
        });
    })
</script>
