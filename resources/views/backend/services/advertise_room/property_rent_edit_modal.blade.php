@include('backend.services.advertise_room.advertise_style')
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit property wanted</h4>
        </div>

        <div class="modal-body">
            <form id="property_rent_edit_form" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $property->id }}">
                {{-- <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field2">Your name</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input class="form-control" placeholder="First name" name="advert_first_name"
                                        type="text" id="advert_first_name" value="{{ $property->advert_first_name }}">
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" placeholder="Last name" name="advert_last_name" type="text"
                                        id="advert_last_name" value="{{ $property->advert_last_name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Submit"> --}}

                <!-- Step 1 -->
                @include('backend.services.advertise_room.partial.edit_step_1')

                <!-- Step 2 -->
                @include('backend.services.advertise_room.partial.edit_step_2')

                <!-- Step 3 -->
                @include('backend.services.advertise_room.partial.edit_step_3')

                <!-- Step 4 -->
                @include('backend.services.advertise_room.partial.edit_step_4')

                <!-- Step 5 -->
                @include('backend.services.advertise_room.partial.edit_step_5')

                <!-- Step 6 -->
                @include('backend.services.advertise_room.partial.edit_step_6')
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
                    toastr.success(response.msg);
                    $('#property_rent_edit_form').find('input, textarea, select').val(
                        '');
                    $('.property_rent_edit_modal').modal('hide');
                    $('#room_to_rent_share_table').DataTable().ajax.reload();
                },
            });
        });
    })
</script>
@include('backend.services.advertise_room.advertise_script')