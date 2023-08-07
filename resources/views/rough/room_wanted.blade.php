<!DOCTYPE html>
<html class="desktop uk logged_out no-js" lang="en-GB">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <link rel="stylesheet" href="{{ asset('assets/rough/root.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/rough/stack.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/rough/advertise.css') }}">

</head>

<body>

    <!-- Room Wanted -->

    <main id="spareroom" class="wrap wrap--main">

        <!-- Start Step 1 -->

        <div class="step-1">
            <div class="grid-12-4 " id="mainheader">
                <div>
                    <h1> Post a room wanted advert </h1>
                </div>
                <div>&nbsp;</div>
            </div>
            <div class="grid-12-4">
                <div>
                    <div class="benefits" style="display:none">
                        <div>
                            <h3>Find your room faster with a FREE room wanted ad</h3>
                            <ul class="bulletlist points fa-ul">
                                <li class="bulletlist__text">
                                    <i class="fa-li far fa-check-circle"></i>
                                    <b>Maximise your chances</b> - landlords use room wanted ads to contact tenants
                                </li>
                                <li class="bulletlist__text">
                                    <i class="fa-li far fa-check-circle"></i>
                                    <b>Don’t miss out!</b> Demand for the best rooms is high
                                </li>
                                <li class="bulletlist__text">
                                    <i class="fa-li far fa-check-circle"></i>
                                    <b>Keep control</b> - FREE and quick to set up, halt your ad any time you want
                                </li>
                            </ul>
                            <p class="ending-line">Start your room wanted ad today!</p>
                        </div>
                    </div>
                    <div class="block block_simple block_wanted_listing">
                        <div class="block_header">
                            <h2>Step 1 of 2</h2>
                        </div>
                        <div class="block_content">

                            <form action="#" method="GET" class="pl_step1" name="place_room_wanted_st_1">
                                <fieldset class="form_fieldset_room_and_gender">

                                    <legend> Get started with your room wanted advert </legend>

                                    <div class="form_row form_row_whos_searching">
                                        <div class="form_label">Who's searching?</div>
                                        <div class="form_inputs">
                                            <label class="form_input form_radio">
                                                <input type="radio" name="who_is_searching" checked=""
                                                    value="justme">Just me
                                            </label>
                                            <label class="form_input form_radio">
                                                <input type="radio" name="who_is_searching" value="partner">
                                                Me and a partner
                                            </label>
                                            <label class="form_input form_radio">
                                                <input type="radio" name="who_is_searching" value="friend">
                                                Me and a friend
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_seekers ">
                                        <div class="form_label">Your gender(s)</div>
                                        <div class="form_inputs">
                                            <label class="form_input form_radio form_radio_single-seeker">
                                                <input type="radio" name="NumberAndSexOfSeekers" checked=""
                                                    value="M"> 1 male
                                            </label>
                                            <label class="form_input form_radio form_radio_single-seeker">
                                                <input type="radio" name="NumberAndSexOfSeekers" value="F"> 1
                                                female
                                            </label>
                                            <label
                                                class="form_input form_radio form_radio_other form_radio_single-seeker">
                                                <input type="radio" name="NumberAndSexOfSeekers" value="O"> Other
                                            </label>
                                            <label class="form_input form_radio form_radio_multi-seeker">
                                                <input type="radio" name="NumberAndSexOfSeekers" value="MM"
                                                    disabled=""> 2 males
                                            </label>
                                            <label class="form_input form_radio form_radio_multi-seeker">
                                                <input type="radio" name="NumberAndSexOfSeekers" value="FF"
                                                    disabled=""> 2 females
                                            </label>
                                            <label class="form_input form_radio form_radio_multi-seeker">
                                                <input type="radio" name="NumberAndSexOfSeekers" value="FM"
                                                    disabled=""> 1 male 1 female
                                            </label>
                                            <label
                                                class="form_input form_radio form_radio_other form_radio_multi-seeker">
                                                <input type="radio" name="NumberAndSexOfSeekers" value="OO"
                                                    disabled=""> Other
                                            </label>
                                            <span class="tooltip">
                                                <span class="tooltip_box">
                                                    <small class="tooltip_text" id="genderOther">You'll have the
                                                        opportunity
                                                        to self-describe in your ad(s) and messages, if you choose
                                                        to.</small>
                                                    <span class="tooltip_arrow">&nbsp;</span>
                                                </span>
                                                <span class="tooltip_item">
                                                    <i class="fas fa-info-circle"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_looking_for ">
                                        <div class="form_label">Room sizes</div>
                                        <div class="form_inputs">

                                            <label class="form_input form_radio">
                                                <input type="radio" name="RoomReq" value="a single or double room"> A
                                                single or double room
                                            </label><label class="form_input form_radio">
                                                <input type="radio" name="RoomReq" value="a double room"> A double
                                                room
                                            </label>

                                        </div>
                                    </div>


                                    <div class="form_row form_row_buddyups">
                                        <div class="form_label">'Buddy ups'</div>
                                        <div class="form_inputs">
                                            <label class="form_input form_checkbox">
                                                <input type="checkbox" name="interested_meeting_other_seekers"
                                                    value="Y">
                                                I/we are also interested in <em>Buddying up</em>
                                            </label>
                                            <div class="form_hint">

                                                Tick this if you might like to <em>Buddy Up</em> with other room seekers
                                                to
                                                find a whole flat or house together and start a brand new flat/house
                                                share.


                                            </div>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_buttons">
                                        <div class="form_label"></div>
                                        <div class="form_inputs">
                                            <button class="button wanted-step-1__continue-button" type="submit"
                                                name="submit">next</button>
                                        </div>
                                    </div>

                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <br><br>
                </div>

                <aside>
                    <section>
                        <h3>Help topics</h3>
                        <ul>
                            <li><a href="#">What's a buddy up?</a></li>
                            <li><a href="#">What's the difference between a
                                    single and double room?</a>
                            </li>
                        </ul>
                    </section>

                    <section class="panel panel-header-closed need-help">
                        <header>
                            <h3>Need any help?</h3>
                        </header>
                        <div>
                            <p class="need_help_contact">
                                Contact us by <a href="" rel="nofollow" title="Contact us by email">email</a>
                                or
                                <br>
                                <i class="far fa-phone"></i>
                                <a href="tel:+441617681162">Call us on 0161 768 1162</a>
                            </p>

                            <p class="need-help__hours">
                                Mon to Fri: 9am – 8.30pm
                                <br>
                                Weekends: 10am – 7.30pm
                            </p>
                        </div>
                    </section>
                </aside>


            </div>
        </div>

        <!-- End Step 1 -->


        <!-- Start Step 2 -->

        <div class="step-2">
            <div class="grid-12-4 " id="mainheader">
                <div>
                    <h1> Post new room wanted advert </h1>
                </div>
                <div>&nbsp;</div>
            </div>
            <div class="grid-12-4">
                <div>

                    <div class="block block_simple block_wanted_listing">
                        <div class="block_header">
                            <h2>Step 2 of 2</h2>
                        </div>
                        <div class="block_content">

                            <form action="#" id="wantedAdFormStepTwo" method="POST" class="pl_step2"
                                data-cookie-check="self" name="place_room_wanted_st_2">

                                <fieldset>
                                    <legend>Your search</legend>
                                    <div class="form_row form_row_watchlist ">

                                        <div class="form_label">
                                            Where do you want to live?
                                        </div>

                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="watch_gl_id">
                                                    <option value="" selected="">Select an area...</option>
                                                    <option value="12">Wales</option>
                                                    <option value="13">Channel Islands</option>
                                                    <option value="14">Isle of Man</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_budget  ">
                                        <div class="form_label">
                                            Your combined budget
                                            <div class="form_hint">
                                                (total combined rental you can both afford)
                                            </div>
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <span class="form_text_currency">£</span>
                                                <input type="number" name="combined_budget" value="0"
                                                    step="any">
                                            </span>
                                            <span class="form_input form_select" style="margin-right: 0;">
                                                <select name="per">
                                                    <option value="" selected="">Per week or month</option>
                                                    <option value="pcm">per month</option>
                                                    <option value="pw">per week</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="form_row form_row_avail_from">
                                        <div class="form_label">
                                            We are available to move in from
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="day_avail">
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="30" selected="">30</option>
                                                </select>
                                            </span>
                                            <span class="form_input form_select">
                                                <select name="mon_avail">
                                                    <option value="01">Jan</option>
                                                    <option value="07" selected="">Jul</option>
                                                    <option value="12">Dec</option>
                                                </select>
                                            </span>
                                            <span class="form_input form_select">
                                                <select name="year_avail">
                                                    <option value="2023" selected="">2023
                                                    </option>
                                                    <option value="2025">2025
                                                    </option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="form_row form_row_period ">
                                        <div class="form_label">
                                            Period accommodation needed for
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="min_term">
                                                    <option value="0" selected="">No minimum</option>
                                                    <option value="1">1 month</option>
                                                    <option value="2">2 months</option>
                                                    <option value="3">3 months</option>
                                                </select>

                                            </span>
                                            <span class="form_text_separator">to</span>
                                            <span class="form_input form_select">

                                                <select name="max_term">
                                                    <option value="0" selected="">No maximum</option>
                                                    <option value="1">1 month</option>
                                                    <option value="2">2 months</option>
                                                    <option value="3">3 months</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="form_row form_row_days_avail">
                                        <div class="form_label">
                                            We want to stay in the accommodation
                                        </div>

                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="days_of_wk_available">
                                                    <option value="7 days a week">7 days a week</option>
                                                    <option value="Weekends only">Weekends only</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="form_row form_row_amenities">
                                        <div class="form_label">
                                            We would prefer these amenities
                                        </div>
                                        <div class="form_inputs">
                                            <div class="cols cols2">
                                                <div class="col col_first">
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="roomfurnishings"
                                                            value="furnished"> Furnished
                                                    </label>
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="living_room" value="Y">
                                                        Shared living room
                                                    </label>
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="washing_machine" value="Y">
                                                        Washing machine
                                                    </label>
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="garden" value="Y">
                                                        Garden/roof terrace
                                                    </label>
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="balcony" value="Y">
                                                        Balcony/patio
                                                    </label>

                                                </div>
                                                <div class="col col_last">
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="off_street_parking"
                                                            value="Y"> Parking
                                                    </label>

                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="garage" value="Y"> Garage
                                                    </label>
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="disabled_access" value="Y">
                                                        Disabled access
                                                    </label>

                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="broadband" value="Y">
                                                        Broadband
                                                    </label>
                                                    <label class="form_input form_checkbox">
                                                        <input type="checkbox" name="ensuite" value="Y">
                                                        En-suite
                                                    </label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>

                                <fieldset class="form_fieldset form_fieldset_about_you">
                                    <legend> About yourselves </legend>
                                    <div class="form_row form_row_age form_row_ages  ">
                                        <div class="form_label"> Aged between </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">

                                                <select name="min_age">
                                                    <option value="">Select...</option>
                                                    <option value="18">18</option>
                                                    <option value="26" selected="">26</option>
                                                    <option value="99">99</option>
                                                </select>
                                            </span>

                                            <span class="form_text_separator">and</span>
                                            <span class="form_input form_select">
                                                <select name="max_age">
                                                    <option value="" selected="">Select...</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="99">99</option>
                                                </select>
                                            </span>

                                            <span class="form_input_description">years old</span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_occupation">
                                        <div class="form_label">
                                            Occupation
                                        </div>
                                        <div class="form_inputs">

                                            <span class="form_input form_select">
                                                <select name="share_type">
                                                    <option value="ND" selected="">Not disclosed</option>
                                                    <option value="S">Students</option>
                                                    <option value="P">Professionals</option>
                                                    <option value="O">Other</option>
                                                </select>
                                            </span>

                                        </div>
                                    </div>

                                    <div class="form_row form_row_campus" style="display: none;">
                                        <div class="form_label"> Uni/college </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="campus_id">
                                                    <option value="" selected="">Not applicable/not disclosed
                                                    </option>
                                                    <option value="164">Writtle College</option>
                                                    <option value="165">York St.John University</option>
                                                    <option value="9999">Mixed</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_smoking">
                                        <div class="form_label"> Do any of you smoke? </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="smoking_current">
                                                    <option value="N" selected="">no</option>
                                                    <option value="Y">yes</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_pets">
                                        <div class="form_label"> Do you have any pets? </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="pets">
                                                    <option value="N">no</option>
                                                    <option value="Y">yes</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="form_row form_row_orientation">
                                        <div class="form_label"> Your sexual orientation </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="gay_lesbian">
                                                    <option value="ND" selected="">Undisclosed</option>
                                                    <option value="S">Straight</option>
                                                    <option value="M">Mixed</option>
                                                </select>
                                            </span>
                                            <br>
                                            <label class="form_input form_checkbox">
                                                <input type="checkbox" name="gay_consent" value="Y">
                                                Yes, I would like my orientation to form part of my ad's search criteria
                                                and allow others to search on this field.
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_language">
                                        <div class="form_label">
                                            Your preferred language
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="lang_id">
                                                    <option value="26">English
                                                    </option>
                                                    <option value="97">Yoruba
                                                    </option>
                                                    <option value="98">Zulu
                                                    </option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_nationality">
                                        <div class="form_label"> Your nationality </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <span id="nationality-select" data-selected=""><select
                                                        name="nationality">
                                                        <option value="">Not disclosed</option>
                                                        <option value="Yemeni">Yemeni</option>
                                                        <option value="Zambian">Zambian</option>
                                                        <option value="Zimbabwean">Zimbabwean</option>
                                                    </select></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_interests">
                                        <div class="form_label"> Your interests </div>
                                        <div class="form_inputs">

                                            <div id="sharedInterests" data-post-ad-type="wanted">
                                                <div class="shared-interests">
                                                    <h3
                                                        class="shared-interests__heading shared-interests__heading--form">
                                                        Your interests</h3>
                                                    <div
                                                        class="shared-interests__form-elements shared-interests__form-elements--desktop">
                                                        <button type="button" class="button button--secondary"
                                                            tabindex="0" id="shared_interests_button">Add
                                                            interests</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <span class="form_input form_text" style="display: none;">
                                                <input type="text" name="interests" value=""
                                                    maxlength="255">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_name  ">
                                        <div class="form_label"> Your name </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="first_name" value="Abdulla"
                                                    placeholder="First name">

                                            </span>
                                            <span class="form_input form_text">
                                                <input type="text" name="last_name" value="Shakib"
                                                    placeholder="Last name">

                                            </span>

                                            <br>
                                            <label class="form_input form_checkbox">
                                                <input type="checkbox" name="display_last_name" checked=""
                                                    value="Y">
                                                Display last name on advert?
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Your preferred flatmate</legend>

                                    <div class="form_row form_row_gender">
                                        <div class="form_label">
                                            Gender
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="gender_req">
                                                    <option value="N">Males or Females</option>
                                                    <option value="M">Males</option>
                                                    <option value="F">Females</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_age">
                                        <div class="form_label"> Age range </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="min_age_req">
                                                    <option value="" selected="">Select...</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                </select>
                                            </span>
                                            <span class="form_text_separator">to</span>
                                            <span class="form_input form_select">
                                                <select name="max_age_req">
                                                    <option value="" selected="">Select...</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_occupation">
                                        <div class="form_label"> Occupation </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="share_type_req">
                                                    <option value="M">Don't mind</option>
                                                    <option value="S">Students</option>
                                                    <option value="P">Professionals</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_smoking">
                                        <div class="form_label"> smoking </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="smoking">
                                                    <option value="Y">Don't mind</option>
                                                    <option value="N">No thanks</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_pets form_row_pets_preference">
                                        <div class="form_label">
                                            pets
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="pets_req">
                                                    <option value="Y">Don't mind</option>
                                                    <option value="N">No thanks</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_orientation">
                                        <div class="form_label">
                                            Orientation
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_select">
                                                <select name="gay_lesbian_req">
                                                    <option value="ND" selected="">Not important</option>
                                                    <option value="S">Straight</option>
                                                    <option value="G">Gay/Lesbian</option>
                                                    <option value="B">Bisexual</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                </fieldset>


                                <fieldset>
                                    <legend> Advert details (optional) </legend>
                                    <div class="form_row form_row_title ">
                                        <div class="form_label"> Advert title
                                            <div class="form_hint"> (Short description) </div>
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input type="text" name="ad_title" value="" size="48"
                                                    maxlength="50">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form_row form_row_description ">
                                        <div class="form_label"> Description
                                            <div class="form_hint">
                                                (No contact details permitted within description)
                                            </div>
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <textarea name="ad_text" rows="10" cols="36" wrap="virtual"></textarea>
                                            </span>
                                            <div class="form_hint">
                                                Include details about the accommodation you are looking for, who you'd
                                                like to live with and what a potential flatmate should expect living
                                                with you.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_buddyup">
                                        <div class="form_label">
                                            <em>Buddy Up</em> additional description
                                            <div class="form_hint">
                                                (Optional message shown to Buddy Up searches
                                            </div>
                                        </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <textarea name="buddy_up_text" rows="5" cols="36" wrap="virtual"></textarea>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="form_row form_row_photos post-ad__photo-upload">
                                        <div class="post-ad__photo-upload-label">Upload photos</div>
                                        <div class="form_inputs">
                                            <div id="photoUploader" data-upload-url="#" data-profile-photo-id="">
                                                <div data-testid="uploader">
                                                    <div class="dropzone-wrapper">
                                                        <div class="dropzone-button"><button
                                                                class="button button--wide dz-clickable"
                                                                id="dzClickable" type="button">
                                                                <div class="button__content"><span
                                                                        class="button__icon dropzone-button__icon"><i
                                                                            class="fas fa-images"></i></span><span
                                                                        class="button__text">Add up to 9 images</span>
                                                                </div>
                                                            </button>
                                                            <p class="dropzone__file-hint">.jpg or .png only. Up to
                                                                16mb</p>
                                                        </div>
                                                        <div class="filepicker dropzone">
                                                            <div class="dz-default dz-message"><span>Drop files here
                                                                    to upload</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="uploader__hint">Photos must not contain any web urls
                                                        or contact details. Only branded advertisers may include a
                                                        company name or logo.</div>
                                                    <div class="photo-upload"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form_row form_row_tel">
                                        <div class="form_label"> Telephone </div>
                                        <div class="form_inputs">
                                            <span class="form_input form_text">
                                                <input class="form_input_tel" type="tel" name="tel"
                                                    value="" autocomplete="tel" id="form_input--tel-n">
                                            </span>
                                            <br>
                                            <span class="form_hint">
                                                (We won't display your number on SpareRoom or pass it onto any third
                                                parties. We need your number in case we need to contact you about your
                                                account or to help verify your details)
                                            </span>
                                        </div>
                                    </div>
                                </fieldset>


                                <fieldset>
                                    <legend>Email alerts</legend>
                                    <div class="form_row form_row_emails">
                                        <div class="form_label">
                                            Daily email alerts
                                        </div>
                                        <div class="form_inputs">
                                            <label class="form_input form_checkbox">
                                                <input type="checkbox" name="emailnotify" checked=""
                                                    value="Y">
                                                <input type="hidden" name="emailnotify_prev" value="Y">
                                                Yes, please send me daily summary emails of new Room Offered ads
                                                matching my requirements

                                            </label>
                                        </div>
                                    </div>
                                    <div class="form_row form_row_emails">
                                        <div class="form_label">
                                            Instant email alerts
                                        </div>
                                        <div class="form_inputs">
                                            <label class="form_input form_checkbox">
                                                <input type="checkbox" name="emailnotify_justin" value="Y">
                                                <input type="hidden" name="emailnotify_justin_prev" value="N">
                                                Yes, please send me emails of new Room Offered adverts matching my
                                                requirements as soon as they are posted on the website
                                            </label>
                                            (up to a maximum of
                                            <span class="form_input form_select">
                                                <select name="emailnotify_justin_max_qty">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </span>
                                            <input type="hidden" name="emailnotify_justin_max_qty_prev"
                                                value="12"> per day)
                                        </div>
                                    </div>
                                </fieldset>


                                <div class="form_row form_row_buttons">
                                    <div class="form_label"></div>
                                    <div class="form_inputs">
                                        <div class="form_input form_button pl_save_bottom">
                                            <button class="button" id="postWantedAd" type="submit" name="submit">
                                                Post ad
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

                <aside>
                    <section>
                        <h3>Help topics</h3>
                        <ul>
                            <li><a href="#">What's a buddy up?</a></li>
                            <li><a href="#">What's the difference between a
                                    single and double room?</a>
                            </li>
                        </ul>
                    </section>

                    <section class="panel panel-header-closed need-help">
                        <header>
                            <h3>Need any help?</h3>
                        </header>
                        <div>
                            <p class="need_help_contact">
                                Contact us by <a href="" rel="nofollow" title="Contact us by email">email</a>
                                or
                                <br>
                                <i class="far fa-phone"></i>
                                <a href="tel:+441617681162">Call us on 0161 768 1162</a>
                            </p>

                            <p class="need-help__hours">
                                Mon to Fri: 9am – 8.30pm
                                <br>
                                Weekends: 10am – 7.30pm
                            </p>
                        </div>
                    </section>

                </aside>

            </div>


        </div>

        <!-- End Step 2 -->


    </main>
</body>

</html>
