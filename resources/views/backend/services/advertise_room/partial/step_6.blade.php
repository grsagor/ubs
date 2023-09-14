<!-- Step 6 -->
<div class="step" id="step-6">
    <h3 class="text-center mb-2">Step 6</h3>
    <!-- Step 6 form fields go here -->


    <!-- Start Step 6 -->
    <div class="grid-12-4" style="display: flex; justify-content: center;">
        <div>

            <div class="block block_simple block_offered_listing">
                <div class="block_header">
                    <h2>
                        Step 6 of 6</h2>
                </div>

                <div class="block_content">

                    <div id="deposit_warning_popup"></div>

                    <fieldset>
                        <input type="hidden" name="is_loggedin" value="1">
                        <legend>Email alerts</legend>
                        <div class="form_row form_row_emails">
                            <div class="form_label"> Daily email alerts </div>
                            <div class="form_inputs">
                                <label class="form_input form_checkbox">
                                    <input type="checkbox" name="daily_email_alerts" checked="" value=1>
                                    Yes, please send me daily summary emails of new Rooms Wanted adverts
                                    matching my requirements
                                </label>
                            </div>
                        </div>
                        <div class="form_row form_row_emails form_row_emails_instant">
                            <div class="form_label"> Instant email alerts </div>
                            <div class="form_inputs">
                                <label class="form_input form_checkbox">
                                    <input type="checkbox" name="instant_email_alerts" value=1>
                                    Yes, please send me emails of new Rooms Wanted adverts matching my
                                    requirements as soon as they are posted on the website
                                </label>
                                (up to a maximum of
                                <span class="form_input form_select">
                                    <select name="instant_email_max_days">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12" selected="">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="30">30</option>
                                        <option value="35">35</option>
                                        <option value="40">40</option>
                                        <option value="45">45</option>
                                        <option value="50">50</option>
                                    </select>
                                </span>

                                per day)
                            </div>
                        </div>



                        <div class="form_row ">
                            <div class="form_label"></div>
                            <div class="form_inputs">
                                <div class="btn-wrapper">


                                    {{-- <div><button class="button" type="submit" name="validate_step"
                                    value="Post your advert">Post your advert</button> </div>
                            <div class="btn-wrapper__back-btn">
                                <input class="button button--link" id="backButton" type="submit"
                                    name="prev_step" value="Back">
                            </div> --}}

                                </div>
                            </div>
                        </div>

                    </fieldset>


                </div>

            </div>

        </div>

    </div>
    <!-- End Step 6 -->
    <div class="next-prev-btn-container">
        <button type="button" class="btn btn-primary prev-btn">Previous</button>
        @auth
            @php
                $userId = auth()->id();
            @endphp
        @endauth
        <input type="hidden" name="user_id" value="{{ $userId }}">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</div>
