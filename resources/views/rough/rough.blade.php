@extends('crm::layouts.app')
@section('title', __('restaurant.bookings'))

@section('content')

    <section class="content-header">
        <h1>Request Viewing </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="contentPane__header">

            <p>Property Description:
                <em>
                    <a href="">4 Bed
                        Flat, Plashet Road, E13</a> </em>
            </p>
            <p>Landlord Name: <strong> Omar P. </strong></p>
        </div>

        <form action="" method="post">

            <p>From : <b> Abdulla Shakib</b>
                (shakib.smartsoftware@gmail.com) </p>
            <p>My Number : <b> +447460497454 </b></p>

            <hr class="full">

            <div class="alert" style="background: rgb(162, 204, 206);color:rgb(75, 114, 116);font-weight: bold;">
                This landlord has enabled advanced tenant screening - as such, you will need
                to answer the following questions before submitting your enquiry:
            </div>


            <div class="form-group row">
                <div class="col-md-9">
                    <label for="IsStudent">Are you, or anyone you're
                        applying with, a student?</label>
                </div>
                <div class="col-md-3 text-md-right">
                    <input type="radio" name="student" class="" value="true" checked="">
                    <span class="">Yes</span>

                    <input type="radio" name="student" class="" value="false">
                    <span class="">No</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-9">
                    <label for="IsDSS">Will you, or anyone you're
                        applying with, be using housing benefits / DSS to pay the
                        rent?</label>
                </div>
                <div class="col-md-3 text-md-right">
                    <input type="radio" name="IsDSS" class="" value="true" checked="">
                    <span class="">Yes</span>

                    <input type="radio" name="IsDSS" class="" value="false">
                    <span class="">No</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-9">
                    <label for="HasPet">Do you, or anyone applying with
                        you, have a pet that will move into the property with you?</label>
                </div>
                <div class="col-md-3 text-md-right">
                    <input type="radio" name="HasPet" class="" value="true" checked="">
                    <span class="">Yes</span>

                    <input type="radio" name="HasPet" class="" value="false">
                    <span class="">No</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-9">
                    <label for="IsSmoker">Are you, or anyone you're
                        applying with, a smoker?</label>
                </div>
                <div class="col-md-3 text-md-right">
                    <input type="radio" name="IsSmoker" class="" value="true" checked="">
                    <span class="">Yes</span>

                    <input type="radio" name="IsSmoker" class="" value="false">
                    <span class="">No</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-9">
                    <label for="MinimumTenancy">Are you looking for a
                        tenancy equal to, or longer than 12 months?</label>
                </div>
                <div class="col-md-3 text-md-right">
                    <input type="radio" name="MinimumTenancy" class="" value="true" checked="">
                    <span class="">Yes</span>

                    <input type="radio" name="MinimumTenancy" class="" value="false">
                    <span class="">No</span>
                </div>
            </div>

            <hr class="full">

            <div class="form-group">
                <label for="FurnishedStateRequired">Do you have
                    any requirements regarding property furnishings?</label>
                <select class="form-control" name="">
                    <option value="">Select</option>
                    <option value="1">Must Be Unfurnished</option>
                    <option value="2">I don't mind</option>
                </select>
            </div>

            <div class="form-group">
                <label for="MustMoveInBy">What is your moving date?</label>
                <input class=" form-control" name="" type="date" id="datepicker" value="">
            </div>

            <div class="form-group">
                <label for="AnnualIncomeOfAllTenant">What's the
                    combined monthly income of you and your co-tenants
                    (before tax)?</label>
                <div class="input-group">
                    <div class="input-group-addon"> £</div>
                    <input class="form-control" name="" type="number" value="">
                </div>
            </div>

            <hr class="full">

            <div class="form-group">
                <label for="Availability">When are you available for viewings? (max 200
                    characters)</label>
                <input class="form-control" name="" type="text" value="">
            </div>

            <div class="form-group">
                <label for="Message">Message</label>
                <textarea class="form-control" name="" type="text" value="" rows="4"></textarea>
            </div>

            <div class="details-confirm">
                <label class="custom-control custom-checkbox custom-checkbox-lg">
                    <input name="ConfirmStatementsTrue" class="custom-control-input" data-val="true" type="checkbox"
                        value="true">
                    <span class="custom-control-description">I confirm that the above declarations are correct
                        and accurate.</span>
                </label>
            </div>

            <button type="Submit" class="btn btn-primary" style="margin-top: 10px; margin-bottom:10px;">
                Request Viewing
            </button>

            <p><i>To stop landlords receiving repeat enquiries, you will only be able to
                    submit this form once per property. </i></p>
        </form>
    </section>

@endsection
@section('javascript')

    <script>
        $(document).ready(function() {
            $('#datepicker').click(function() {
                $(this).datepicker('show');
            });
        });
    </script>
@endsection
