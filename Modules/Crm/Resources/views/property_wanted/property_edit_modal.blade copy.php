<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit property wanted</h4>
        </div>

        <div class="modal-body">
            <form id="property_wanted_edit_form" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $property->id }}">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field2">Your name</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input class="form-control" placeholder="First name" name="first_name"
                                        type="text" id="first_name" value="{{ $property->first_name }}">
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" placeholder="Last name" name="last_name" type="text"
                                        id="last_name" value="{{ $property->last_name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Submit">
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