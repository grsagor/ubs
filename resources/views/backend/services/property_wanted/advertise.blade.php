@extends('layouts.app')
@section('title', 'Advertise-Room')
<link rel="stylesheet" href="{{ asset('assets/rough/root.css') }}">
<link rel="stylesheet" href="{{ asset('assets/rough/stack.css') }}">
<link rel="stylesheet" href="{{ asset('assets/rough/advertise.css') }}">
@section('css')
    <style>

    </style>
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
        <h1 class="service_iiiiiii">Service
            <small>Advertise your room</small>
        </h1>
    </section> --}}

    <!-- Main content -->
    <section class="content">
        <div>
            <form class="row g-3 mt-2" action="{{ route('property-wanted.store') }}" id="multi-step-form" method="POST"
                enctype="multipart/form-data">
                @csrf
                <!-- Step 1 -->
                <div class="step" id="step-1">
                    <!-- Step 1 form fields go here -->
                    <!-- Start Step 1 -->
                    <div class="grid-12">
                        <div class="text-center">
                            <h1> Post a room wanted advert </h1>
                        </div>
                    </div>
                    <div class="grid-12-4" style="display: flex; justify-content: center;">
                        <div>
                            <div class="block block_simple block_offered_listing">
                                <div class="block_header">
                                    <h2> Step 1 of 2 </h2>
                                </div>

                                <div class="block_content">



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


                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- Start Step 1 -->
                    <button type="button" class="btn btn-primary next-btn"
                        style="display: block; margin: auto;">Next</button>
                </div>




                <!-- Step 6 -->
                <div class="step" id="step-6">

                    <!-- Start Step 6 -->
                    <div class="grid-12-4" style="display: flex; justify-content: center;">
                        <div>

                            <div class="block block_simple block_offered_listing">
                                <div class="block_header">
                                    <h2>
                                        Step 2 of 2</h2>
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
                                                    <input type="checkbox" name="daily_email_alerts" checked=""
                                                        value=1>
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
                    <button type="button" class="btn btn-primary prev-btn">
                        Previous
                    </button>


                    @auth
                        @php
                            $userId = auth()->id();
                        @endphp
                    @endauth
                    <input type="hidden" name="user_id" value="{{ $userId }}">


                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $(".step:not(:first)").hide(); // Hide all steps except the first one

            $(".next-btn").click(function() {
                $(this).parent().hide().next().show();
            });

            $(".prev-btn").click(function() {
                $(this).parent().hide().prev().show();
            });
        });


        // Get the input element by its ID
        var roomAvailableFromInput = document.getElementById('room_available_from');

        // Get the current date in the format YYYY-MM-DD
        var currentDate = new Date().toISOString().split('T')[0];

        // Set the min attribute of the input to the current date
        roomAvailableFromInput.min = currentDate;
    </script>
@endsection
