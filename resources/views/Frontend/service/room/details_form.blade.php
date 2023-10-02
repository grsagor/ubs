@extends('frontend.layouts.master_layout')

@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        input.select-style,
        select.form-control {
            width: 100%;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 0;
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 10px;
            height: 34px !important;
            font-size: 13px !important;
        }

        label {
            color: black;
        }
    </style>
@endsection

@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">

        <div class="higibigi mt-5 mb-5">
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal">
                Open Modal
            </button>
        </div>

        <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Booking Details</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="registerform" action="#" method="POST">

                            <div class="step" id="step1">

                                <div class="form-group" id="number_of_shared_people_container">
                                    <label for="invoice_scheme_id">How many people, including yourself, will share the
                                        property?</label>
                                    <select class="form-control" required="" id="number_of_shared_people"
                                        name="number_of_shared_people">
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
                                </div>

                                <div id="number_of_shared_people-error" class="text-danger mb-2" style="margin-top: -10px;">
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

                                <div class="form-group">
                                    <label for="accommodation">Period accommodation needed for</label>
                                    <select class="form-control" required="" id="min_term" name="min_term">
                                        <option value="0" selected>No maximum
                                        </option>
                                        @foreach ($months as $value => $label)
                                            <option value="{{ $value }}">
                                                {{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">I want to stay in the accommodation</label>
                                    <select class="form-control" required="" id="days_of_wk_available"
                                        name="days_of_wk_available">
                                        <option value="7 days a week">7 days a week
                                        </option>
                                        <option value="Mon to Fri only">Mon to Fri only
                                        </option>
                                        <option value="Weekends only">Weekends only
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="text" name="name" class="form-control select-style"
                                        placeholder="Email" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" name="name" class="form-control select-style"
                                        placeholder="Mobile">
                                </div>

                                <div class="text-center">
                                    <button type="button" class="btn btn-dark next-step">Next</button>
                                </div>

                            </div>

                            <div class="step" id="step2" style="display: none;">

                                <div id="occupants_inputs_container">

                                </div>

                                <div class="text-center">
                                    <button type="button" class="btn btn-dark previous-step">Previous</button>
                                    <button type="submit" class="btn btn-dark">Submit</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        var currentStep = 1;


        $(".next-step").on("click", function() {
            if (currentStep === 1) {
                var selectedValue = $("#number_of_shared_people").val();
                console.log('selected value' + selectedValue);
                if (selectedValue === '0') {
                    $("#number_of_shared_people-error").text(
                        "Please select this option");
                    return;
                }
            }

            $("#step" + currentStep).hide();
            currentStep++;
            $("#step" + currentStep).show();
        });


        $(".previous-step").on("click", function() {
            $("#step" + currentStep).hide();
            currentStep--;
            $("#step" + currentStep).show();
        });

        $("#registerform").on("submit", function(e) {
            e.preventDefault();
            $("#myModal").modal("hide");
        });

        $('#number_of_shared_people').change(function() {
            console.log('Hello');

            var num = $(this).val();

            if (num !== 0) {
                $("#number_of_shared_people-error").hide();
            }

            $.ajax({
                url: "/show-occupants-details-inputs",
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
    });
</script>
