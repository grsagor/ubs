@extends('crm::layouts.app')
@section('title', 'Property Wanted')

@section('content')
    <style>
        .form-container {
            /* width: 90%;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border: 1px solid gray;
            border-radius: 8px; */
        }
    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add Property Wanted
            <small>Fill up what you want</small>
        </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">
            <div class="box-body">
                @include('crm::property_wanted.create')
            </div>
        </div>
    </section>

@endsection
{{-- @section('javascript')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    reader.readAsDataURL(file);//
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
        var ajaxSecondStep = true;
        var ajaxThirdStep = true;
        $(document).ready(function() {
            $("#next1").click(function(event) {
                var form = document.getElementById("showingbtn1");
                var inputs = form.querySelectorAll("[required]");

                var isValid = true;

                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].value.trim() === "") {
                        isValid = false;
                        inputs[i].setCustomValidity('');
                        inputs[i].reportValidity();
                        return;
                    }
                }

                var childCategory = $('#child_category_id').val();
                if (isValid && (childCategory == 11 && (ajaxSecondStep) || (childCategory != 11 &&
                        ajaxThirdStep))) {
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
                                ajaxSecondStep = false;
                                $("#showingbtn2").html(data.html)
                                $("#showingbtn1").css('display', 'none');
                                $("#showingbtn2").css('display', 'block');
                                $("#nextprev1").css('display', 'none');
                                $("#nextprev2").css('display', 'block');
                                $("#showingbtn3").empty();
                            } else {
                                ajaxThirdStep = false;
                                $("#showingbtn3").html(data.html)
                                $("#showingbtn1").css('display', 'none');
                                $("#showingbtn3").css('display', 'block');
                                $("#nextprev1").css('display', 'none');
                                $("#nextprev3").css('display', 'block');
                                $("#showingbtn2").empty();
                            }
                        }
                    });
                } else {
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
                if ($('#child_category_id').val() == 11) {
                    var form = document.getElementById("showingbtn2");
                } else {
                    var form = document.getElementById("showingbtn3");
                }

                var inputs = form.querySelectorAll("[required]");

                var isValid = true;

                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].value.trim() === "") {
                        isValid = false;
                        inputs[i].setCustomValidity('');
                        inputs[i].reportValidity();
                        return;
                    }
                }

                if (isValid && ajaxThirdStep) {
                    var data = {
                        child_category_id: 1111111111111
                    }
                    $.ajax({
                        url: "/contact/show-second-step",
                        type: "get",
                        data: data,
                        dataType: "json",
                        success: function(data) {
                            ajaxThirdStep = false;
                            $("#showingbtn3").html(data.html)
                            $("#showingbtn2").css('display', 'none');
                            $("#showingbtn3").css('display', 'block');
                            $("#nextprev2").css('display', 'none');
                            $("#nextprev3").css('display', 'block');
                        }
                    });
                } else {
                    $("#showingbtn2").css('display', 'none');
                    $("#showingbtn3").css('display', 'block');
                    $("#nextprev2").css('display', 'none');
                    $("#nextprev3").css('display', 'block');
                }
            });
            $("#next3").click(function(event) {
                var form = document.getElementById("showingbtn3");
                var inputs = form.querySelectorAll("[required]");

                var isValid = true;

                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].value.trim() === "") {
                        isValid = false;
                        inputs[i].setCustomValidity('');
                        inputs[i].reportValidity();
                        return;
                    }
                }

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
            $(document).on('click', '#add_ProductSubmit-btn', function() {
                var form = document.getElementById("showingbtn4");
                var inputs = form.querySelectorAll("[required]");

                var isValid = true;
                if ($('#accept-data-policy-edit').prop('checked')) {
                    $('#accept-data-policy-edit').val('on');
                } else {
                    $('#accept-data-policy-edit').val('');
                }

                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].value.trim() === "") {
                        isValid = false;
                        inputs[i].setCustomValidity('');
                        inputs[i].reportValidity();
                        return;
                    }
                }

                if (isValid) {
                    $('#property_wanted_forms').submit();
                }
            });



            $("#property_wanted_forms").submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/contact/property-wanted-store",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {
                        window.location.href = '/contact/property-wanted';
                        toastr.options = {
                            "sound": false,
                        };
                        toastr.success(response.msg);
                        $('#property_wanted_forms').find('input, textarea, select').val(
                            '');
                        $('.property_wanted_add_modal').modal('hide');
                        $('#room_to_rent_share_table').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle the error
                    }
                });
            });
        });
    </script>
@endsection --}}
