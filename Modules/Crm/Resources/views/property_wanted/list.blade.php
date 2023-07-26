@extends('layouts.app')
@section('title', __('crm::lang.order_request'))
@section('content')

    <!-- breadcrumb -->
    <div class="full-row bg-light overlay-dark py-5" {{-- style="background-image: url({{ $gs->breadcrumb_banner ? asset('assets/images/' . $gs->breadcrumb_banner) : asset('assets/images/noimage.png') }}); background-position: center center; background-size: cover;"> --}} <!-- breadcrumb -->
        <!--==================== Blog Section Start ====================-->
        <div class="full-row">
            <div class="container">
                <div class="mb-4 d-xl-none">
                </div>
                <div class="row">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="widget border-0 p-40 widget_categories bg-light account-info">
                                    <h4 class="widget-title down-line mb-30">Property Wanted</h4>
                                    <div class="edit-info-area">
                                        <div class="body">
                                            <div class="edit-info-area-form">
                                                <div class="gocover" {{-- style="background: url({{ asset('assets/images/' . $gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"> --}} </div>
                                                    <form action="{{ route('property-wanted.store') }}"
                                                        id="property_wanted_form" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div id="showingbtn1">
                                                            <div class="row align-items-center">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Who's searching?</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex gap-3">
                                                                    <div class="d-flex gap-1">
                                                                        <h4>Who's searching?</h4>
                                                                        <input type="radio" name="who_is_searching"
                                                                            id="justme">
                                                                        <label for="justme">Just Me</label>
                                                                    </div>
                                                                    <div class="d-flex gap-1">
                                                                        <input type="radio" name="who_is_searching"
                                                                            id="meandapartner">
                                                                        <label for="meandapartner">Me and a partner</label>
                                                                    </div>
                                                                    <div class="d-flex gap-1">
                                                                        <input type="radio" name="who_is_searching"
                                                                            id="meandafriend">
                                                                        <label for="meandafriend">Me and a friend</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Why is searching?</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Why is searching?</h4>
                                                                    <div class="d-flex gap-1">
                                                                        <textarea name="why_is_searching" class="input-field"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Your gender(s)</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex gap-3">
                                                                    <h4 class="">Your gender(s)</h4>
                                                                    <div class="d-flex gap-1">
                                                                        <input type="radio" name="gender"
                                                                            id="male_gender">
                                                                        <label for="male_gender">1 male</label>
                                                                    </div>
                                                                    <div class="d-flex gap-1">
                                                                        <input type="radio" name="gender"
                                                                            id="female_gender">
                                                                        <label for="female_gender">1 female</label>
                                                                    </div>
                                                                    <div class="d-flex gap-1">
                                                                        <input type="radio" name="gender"
                                                                            id="other_gender">
                                                                        <label for="other_gender">Other</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Room size</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex gap-3">
                                                                    <h4 class="">Room size</h4>
                                                                    <div class="d-flex gap-1">
                                                                        <input type="radio" name="room_size"
                                                                            id="asingleordouble">
                                                                        <label for="asingleordouble">A single or double
                                                                            room</label>
                                                                    </div>
                                                                    <div class="d-flex gap-1">
                                                                        <input type="radio" name="room_size"
                                                                            id="dobuleroom">
                                                                        <label for="dobuleroom">A double room</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Room size</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Room size</h4>
                                                                    <div class="d-flex gap-1">
                                                                        <input type="checkbox" name="buddy_ups"
                                                                            id="buddy_ups">
                                                                        <span><label for="buddy_ups">A single or double
                                                                                room</label></span>
                                                                    </div>
                                                                    <div>
                                                                        Tick this if you might like to Buddy Up with other
                                                                        room
                                                                        seekers to find a whole flat or house together and
                                                                        start a
                                                                        brand new flat/house share.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="showingbtn2" class="d-none" style="display:none;">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Where do you want to live?</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Where do you want to live?</h4>
                                                                    <select name="reason_to_leave">
                                                                        <option value="" selected="">Select an
                                                                            area...
                                                                        </option>
                                                                        <option value="1">London and surrounds
                                                                        </option>
                                                                        <option value="2">East Anglia</option>
                                                                        <option value="3">East Midlands</option>
                                                                        <option value="4">North East England</option>
                                                                        <option value="5">North West England</option>
                                                                        <option value="6">South East England</option>
                                                                        <option value="7">South West England</option>
                                                                        <option value="8">West Midlands</option>
                                                                        <option value="9">Yorkshire and Humberside
                                                                        </option>
                                                                        <option value="10">Northern Ireland</option>
                                                                        <option value="11">Scotland</option>
                                                                        <option value="12">Wales</option>
                                                                        <option value="13">Channel Islands</option>
                                                                        <option value="14">Isle of Man</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Your budget</h4>
                                                         <p class="sub-heading">(total rental amount you can afford) --}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex">
                                                                    <h4 class="">Your budget</h4>
                                                                    <p class="">(total rental amount you can afford)
                                                                    </p>
                                                                    <input type="number" class="input-field"
                                                                        name="combined_budget" placeholder="4">
                                                                    <select name="per">
                                                                        <option value="" selected="">Per week or
                                                                            month
                                                                        </option>
                                                                        <option value="pw">per week</option>
                                                                        <option value="pcm">per month</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">I am available to move in from</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex">
                                                                    <h4 class="">I am available to move in from</h4>
                                                                    <select name="day_avail">
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                        <option value="03">03</option>
                                                                        <option value="04">04</option>
                                                                        <option value="05">05</option>
                                                                        <option value="06">06</option>
                                                                        <option value="07">07</option>
                                                                        <option value="08">08</option>
                                                                        <option value="09">09</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                        <option value="13">13</option>
                                                                        <option value="14" selected="">14</option>
                                                                        <option value="15">15</option>
                                                                        <option value="16">16</option>
                                                                        <option value="17">17</option>
                                                                        <option value="18">18</option>
                                                                        <option value="19">19</option>
                                                                        <option value="20">20</option>
                                                                        <option value="21">21</option>
                                                                        <option value="22">22</option>
                                                                        <option value="23">23</option>
                                                                        <option value="24">24</option>
                                                                        <option value="25">25</option>
                                                                        <option value="26">26</option>
                                                                        <option value="27">27</option>
                                                                        <option value="28">28</option>
                                                                        <option value="29">29</option>
                                                                        <option value="30">30</option>
                                                                        <option value="31">31</option>
                                                                    </select>
                                                                    <select name="mon_avail">
                                                                        <option value="01">Jan</option>
                                                                        <option value="02">Feb</option>
                                                                        <option value="03">Mar</option>
                                                                        <option value="04">Apr</option>
                                                                        <option value="05">May</option>
                                                                        <option value="06">Jun</option>
                                                                        <option value="07" selected="">Jul</option>
                                                                        <option value="08">Aug</option>
                                                                        <option value="09">Sep</option>
                                                                        <option value="10">Oct</option>
                                                                        <option value="11">Nov</option>
                                                                        <option value="12">Dec</option>
                                                                    </select>
                                                                    <select name="year_avail">
                                                                        <option value="2023" selected="">2023
                                                                        </option>
                                                                        <option value="2024">2024
                                                                        </option>
                                                                        <option value="2025">2025
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Period accommodation needed for</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex">
                                                                    <h4 class="">Period accommodation needed for</h4>
                                                                    <select name="min_term">
                                                                        <option value="0" selected="">No minimum
                                                                        </option>
                                                                        <option value="1">1 month</option>
                                                                        <option value="2">2 months</option>
                                                                        <option value="3">3 months</option>
                                                                        <option value="4">4 months</option>
                                                                        <option value="5">5 months</option>
                                                                        <option value="6">6 months</option>
                                                                        <option value="7">7 months</option>
                                                                        <option value="8">8 months</option>
                                                                        <option value="9">9 months</option>
                                                                        <option value="10">10 months</option>
                                                                        <option value="11">11 months</option>
                                                                        <option value="12">1 year</option>
                                                                        <option value="15">1 year 3 months</option>
                                                                        <option value="18">1 year 6 months</option>
                                                                        <option value="21">1 year 9 months</option>
                                                                        <option value="24">2 years</option>
                                                                        <option value="36">3 years</option>
                                                                    </select>
                                                                    <span>to</span>
                                                                    <select name="max_term">
                                                                        <option value="0" selected="">No maximum
                                                                        </option>
                                                                        <option value="1">1 month</option>
                                                                        <option value="2">2 months</option>
                                                                        <option value="3">3 months</option>
                                                                        <option value="4">4 months</option>
                                                                        <option value="5">5 months</option>
                                                                        <option value="6">6 months</option>
                                                                        <option value="7">7 months</option>
                                                                        <option value="8">8 months</option>
                                                                        <option value="9">9 months</option>
                                                                        <option value="10">10 months</option>
                                                                        <option value="11">11 months</option>
                                                                        <option value="12">1 year</option>
                                                                        <option value="15">1 year 3 months</option>
                                                                        <option value="18">1 year 6 months</option>
                                                                        <option value="21">1 year 9 months</option>
                                                                        <option value="24">2 years</option>
                                                                        <option value="36">3 years</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">I want to stay in the accommodation --}}
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex">
                                                                    <h4 class="heading">I want to stay in the accommodation
                                                                    </h4>
                                                                    <select name="days_of_wk_available">
                                                                        <option value="7 days a week">7 days a week
                                                                        </option>
                                                                        <option value="Mon to Fri only">Mon to Fri only
                                                                        </option>
                                                                        <option value="Weekends only">Weekends only
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">I would prefer these amenities</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex">
                                                                    <h4 class="heading">I would prefer these amenities</h4>
                                                                    <div>
                                                                        <label for="furnished"><input type="checkbox"
                                                                                name="roomfurnishings[]" value="furnished"
                                                                                id="furnished">Furnished</label>
                                                                        <label for="living_room"><input type="checkbox"
                                                                                name="roomfurnishings[]"
                                                                                value="living_room"
                                                                                id="living_room">Shared living room</label>
                                                                        <label for="washing_machine"><input
                                                                                type="checkbox" name="roomfurnishings[]"
                                                                                value="washing_machine"
                                                                                id="washing_machine">Washing
                                                                            machine</label>
                                                                        <label for="garden"><input type="checkbox"
                                                                                name="roomfurnishings[]" value="garden"
                                                                                id="garden">Garden/roof terrace</label>
                                                                        <label for="balcony"><input type="checkbox"
                                                                                name="roomfurnishings[]" value="balcony"
                                                                                id="balcony">Balcony/patio</label>
                                                                    </div>
                                                                    <div>
                                                                        <label for="off_street_parking"><input
                                                                                type="checkbox" name="roomfurnishings[]"
                                                                                value="off_street_parking"
                                                                                id="off_street_parking">Parking</label>
                                                                        <label for="garage"><input type="checkbox"
                                                                                name="roomfurnishings[]" value="garage"
                                                                                id="garage">Garage</label>
                                                                        <label for="disabled_access"><input
                                                                                type="checkbox" name="roomfurnishings[]"
                                                                                value="disabled_access"
                                                                                id="disabled_access">Disabled
                                                                            access</label>
                                                                        <label for="broadband"><input type="checkbox"
                                                                                name="roomfurnishings[]" value="broadband"
                                                                                id="broadband">Broadband</label>
                                                                        <label for="ensuite"><input type="checkbox"
                                                                                name="roomfurnishings[]" value="ensuite"
                                                                                id="ensuite">En-suite</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Age</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex">
                                                                    <h4 class="heading">Age</h4>
                                                                    <select name="min_age">
                                                                        <option value="">Select...</option>
                                                                        <option value="18">18</option>
                                                                        <option value="19">19</option>
                                                                        <option value="20">20</option>
                                                                        <option value="21">21</option>
                                                                        <option value="22">22</option>
                                                                        <option value="23">23</option>
                                                                        <option value="24" selected="">24</option>
                                                                        <option value="25">25</option>
                                                                        <option value="26">26</option>
                                                                        <option value="27">27</option>
                                                                        <option value="28">28</option>
                                                                        <option value="29">29</option>
                                                                        <option value="30">30</option>
                                                                        <option value="31">31</option>
                                                                        <option value="32">32</option>
                                                                        <option value="33">33</option>
                                                                        <option value="34">34</option>
                                                                        <option value="35">35</option>
                                                                        <option value="36">36</option>
                                                                        <option value="37">37</option>
                                                                        <option value="38">38</option>
                                                                        <option value="39">39</option>
                                                                        <option value="40">40</option>
                                                                        <option value="41">41</option>
                                                                        <option value="42">42</option>
                                                                        <option value="43">43</option>
                                                                        <option value="44">44</option>
                                                                        <option value="45">45</option>
                                                                        <option value="46">46</option>
                                                                        <option value="47">47</option>
                                                                        <option value="48">48</option>
                                                                        <option value="49">49</option>
                                                                        <option value="50">50</option>
                                                                        <option value="51">51</option>
                                                                        <option value="52">52</option>
                                                                        <option value="53">53</option>
                                                                        <option value="54">54</option>
                                                                        <option value="55">55</option>
                                                                        <option value="56">56</option>
                                                                        <option value="57">57</option>
                                                                        <option value="58">58</option>
                                                                        <option value="59">59</option>
                                                                        <option value="60">60</option>
                                                                        <option value="61">61</option>
                                                                        <option value="62">62</option>
                                                                        <option value="63">63</option>
                                                                        <option value="64">64</option>
                                                                        <option value="65">65</option>
                                                                        <option value="66">66</option>
                                                                        <option value="67">67</option>
                                                                        <option value="68">68</option>
                                                                        <option value="69">69</option>
                                                                        <option value="70">70</option>
                                                                        <option value="71">71</option>
                                                                        <option value="72">72</option>
                                                                        <option value="73">73</option>
                                                                        <option value="74">74</option>
                                                                        <option value="75">75</option>
                                                                        <option value="76">76</option>
                                                                        <option value="77">77</option>
                                                                        <option value="78">78</option>
                                                                        <option value="79">79</option>
                                                                        <option value="80">80</option>
                                                                        <option value="81">81</option>
                                                                        <option value="82">82</option>
                                                                        <option value="83">83</option>
                                                                        <option value="84">84</option>
                                                                        <option value="85">85</option>
                                                                        <option value="86">86</option>
                                                                        <option value="87">87</option>
                                                                        <option value="88">88</option>
                                                                        <option value="89">89</option>
                                                                        <option value="90">90</option>
                                                                        <option value="91">91</option>
                                                                        <option value="92">92</option>
                                                                        <option value="93">93</option>
                                                                        <option value="94">94</option>
                                                                        <option value="95">95</option>
                                                                        <option value="96">96</option>
                                                                        <option value="97">97</option>
                                                                        <option value="98">98</option>
                                                                        <option value="99">99</option>
                                                                    </select>
                                                                    <span>Years old</span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Occupation</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex">
                                                                    <h4 class="heading">Occupation</h4>
                                                                    <select name="share_type">
                                                                        <option value="ND" selected="">Not
                                                                            disclosed
                                                                        </option>
                                                                        <option value="S">Student</option>
                                                                        <option value="P">Professional</option>
                                                                        <option value="O">Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Do you smoke?</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex">
                                                                    <h4 class="heading">Do you smoke?</h4>
                                                                    <select name="pets">
                                                                        <option value="N">no</option>
                                                                        <option value="Y">yes</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Do you have any pets?</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex">
                                                                    <h4 class="heading">Do you have any pets?</h4>
                                                                    <select name="smoking_current">
                                                                        <option value="N" selected="">no</option>
                                                                        <option value="Y">yes</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Your sexual orientation</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Your sexual orientation</h4>
                                                                    <select name="gay_lesbian">
                                                                        <option value="ND" selected="">Undisclosed
                                                                        </option>
                                                                        <option value="S">Straight</option>
                                                                        <option value="G">Gay/Lesbian</option>
                                                                        <option value="B">Bisexual</option>
                                                                    </select>
                                                                    <label class="form_input form_checkbox">
                                                                        <input type="checkbox" name="gay_consent"
                                                                            value="Y">
                                                                        Yes, I would like my orientation to form part of my
                                                                        ad's
                                                                        search criteria and allow others to search on this
                                                                        field.
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Your preferred language</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Your preferred language</h4>
                                                                    <select name="lang_id">
                                                                        <option value="26">English</option>
                                                                        <option value="27">Mixed</option>
                                                                        <option value="4">Arabic</option>
                                                                        <option value="11">Bengali</option>
                                                                        <option value="17">Cantonese</option>
                                                                        <option value="37">French</option>
                                                                        <option value="39">German</option>
                                                                        <option value="44">Hindi</option>
                                                                        <option value="48">Indonesian</option>
                                                                        <option value="50">Japanese</option>
                                                                        <option value="62">Malay</option>
                                                                        <option value="63">Mandarin</option>
                                                                        <option value="73">Portuguese</option>
                                                                        <option value="74">Punjabi</option>
                                                                        <option value="79">Russian</option>
                                                                        <option value="88">Spanish</option>
                                                                        <option value="1">Afrikaans</option>
                                                                        <option value="2">Albanian</option>
                                                                        <option value="3">Amharic</option>
                                                                        <option value="5">Armenian</option>
                                                                        <option value="6">Aymara</option>
                                                                        <option value="7">Baluchi</option>
                                                                        <option value="8">Bambara</option>
                                                                        <option value="9">Basque</option>
                                                                        <option value="10">Belarussian</option>
                                                                        <option value="12">Berber</option>
                                                                        <option value="13">Bislama</option>
                                                                        <option value="14">Bosnian</option>
                                                                        <option value="15">Bulgarian</option>
                                                                        <option value="16">Burmese</option>
                                                                        <option value="18">Catalan</option>
                                                                        <option value="19">Ciluba</option>
                                                                        <option value="20">Creole</option>
                                                                        <option value="21">Croatian</option>
                                                                        <option value="22">Czech</option>
                                                                        <option value="23">Danish</option>
                                                                        <option value="24">Dari</option>
                                                                        <option value="25">Dutch</option>
                                                                        <option value="28">Eskimo</option>
                                                                        <option value="29">Estonian</option>
                                                                        <option value="30">Ewe</option>
                                                                        <option value="31">Fang</option>
                                                                        <option value="32">Faroese</option>
                                                                        <option value="33">Farsi (Persian)</option>
                                                                        <option value="34">Filipino</option>
                                                                        <option value="35">Finnish</option>
                                                                        <option value="36">Flemish</option>
                                                                        <option value="38">Galician</option>
                                                                        <option value="40">Greek</option>
                                                                        <option value="41">Gujarati</option>
                                                                        <option value="42">Hausa</option>
                                                                        <option value="43">Hebrew</option>
                                                                        <option value="45">Hungarian</option>
                                                                        <option value="46">Ibo</option>
                                                                        <option value="47">Icelandic</option>
                                                                        <option value="49">Italian</option>
                                                                        <option value="51">Kabi</option>
                                                                        <option value="52">Kashmiri</option>
                                                                        <option value="53">Kirundi</option>
                                                                        <option value="54">Kishwahili</option>
                                                                        <option value="55">Korean</option>
                                                                        <option value="56">Latvian</option>
                                                                        <option value="57">Lingala</option>
                                                                        <option value="58">Lithuanian</option>
                                                                        <option value="59">Luxembourgish</option>
                                                                        <option value="60">Macedonian</option>
                                                                        <option value="61">Malagasy</option>
                                                                        <option value="64">Mayan</option>
                                                                        <option value="65">Motu</option>
                                                                        <option value="66">Nepali</option>
                                                                        <option value="67">Norwegian</option>
                                                                        <option value="68">Noub</option>
                                                                        <option value="69">Pashto</option>
                                                                        <option value="70">Peul</option>
                                                                        <option value="71">Pidgin</option>
                                                                        <option value="72">Polish</option>
                                                                        <option value="75">Pushtu</option>
                                                                        <option value="76">Quechua</option>
                                                                        <option value="77">Romanian</option>
                                                                        <option value="78">Romansch</option>
                                                                        <option value="80">Sango</option>
                                                                        <option value="81">Serbian</option>
                                                                        <option value="82">Setswana</option>
                                                                        <option value="83">Sindhi</option>
                                                                        <option value="84">Sinhala</option>
                                                                        <option value="85">Slovak</option>
                                                                        <option value="86">Slovene</option>
                                                                        <option value="87">Somali</option>
                                                                        <option value="89">Swahili</option>
                                                                        <option value="90">Swedish</option>
                                                                        <option value="91">Tamil</option>
                                                                        <option value="92">Thai</option>
                                                                        <option value="93">Turkish</option>
                                                                        <option value="94">Urdu</option>
                                                                        <option value="95">Vietnamese</option>
                                                                        <option value="99">Welsh</option>
                                                                        <option value="96">Xhosa</option>
                                                                        <option value="97">Yoruba</option>
                                                                        <option value="98">Zulu</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Your nationality</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Your nationality</h4>
                                                                    <select name="nationality">
                                                                        <option value="">Not disclosed</option>
                                                                        <option value="Afghan">Afghan</option>
                                                                        <option value="Albanian">Albanian</option>
                                                                        <option value="Algerian">Algerian</option>
                                                                        <option value="American">American</option>
                                                                        <option value="Andorran">Andorran</option>
                                                                        <option value="Angolan">Angolan</option>
                                                                        <option value="Anguillan">Anguillan</option>
                                                                        <option value="Antigua and Barbuda">Citizen of
                                                                            Antigua and
                                                                            Barbuda</option>
                                                                        <option value="Argentine">Argentine</option>
                                                                        <option value="Armenian">Armenian</option>
                                                                        <option value="Australian">Australian</option>
                                                                        <option value="Austrian">Austrian</option>
                                                                        <option value="Azerbaijani">Azerbaijani</option>
                                                                        <option value="Bahamian">Bahamian</option>
                                                                        <option value="Bahraini">Bahraini</option>
                                                                        <option value="Bangladeshi">Bangladeshi</option>
                                                                        <option value="Barbadian">Barbadian</option>
                                                                        <option value="Belarusian">Belarusian</option>
                                                                        <option value="Belgian">Belgian</option>
                                                                        <option value="Belizean">Belizean</option>
                                                                        <option value="Beninese">Beninese</option>
                                                                        <option value="Bermudian">Bermudian</option>
                                                                        <option value="Bhutanese">Bhutanese</option>
                                                                        <option value="Bolivian">Bolivian</option>
                                                                        <option value="Bosnia and Herzegovina">Citizen of
                                                                            Bosnia
                                                                            and Herzegovina</option>
                                                                        <option value="Botswanan">Botswanan</option>
                                                                        <option value="Brazilian">Brazilian</option>
                                                                        <option value="British">British</option>
                                                                        <option value="British Virgin Islander">British
                                                                            Virgin
                                                                            Islander</option>
                                                                        <option value="Bruneian">Bruneian</option>
                                                                        <option value="Bulgarian">Bulgarian</option>
                                                                        <option value="Burkinan">Burkinan</option>
                                                                        <option value="Burmese">Burmese</option>
                                                                        <option value="Burundian">Burundian</option>
                                                                        <option value="Cambodian">Cambodian</option>
                                                                        <option value="Cameroonian">Cameroonian</option>
                                                                        <option value="Canadian">Canadian</option>
                                                                        <option value="Cape Verdean">Cape Verdean</option>
                                                                        <option value="Cayman Islander">Cayman Islander
                                                                        </option>
                                                                        <option value="Central African">Central African
                                                                        </option>
                                                                        <option value="Chadian">Chadian</option>
                                                                        <option value="Chilean">Chilean</option>
                                                                        <option value="Chinese">Chinese</option>
                                                                        <option value="Colombian">Colombian</option>
                                                                        <option value="Comoran">Comoran</option>
                                                                        <option value="Congolese (Congo)">Congolese (Congo)
                                                                        </option>
                                                                        <option value="Congolese (DRC)">Congolese (DRC)
                                                                        </option>
                                                                        <option value="Cook Islander">Cook Islander
                                                                        </option>
                                                                        <option value="Costa Rican">Costa Rican</option>
                                                                        <option value="Croatian">Croatian</option>
                                                                        <option value="Cuban">Cuban</option>
                                                                        <option value="Cymraes">Cymraes</option>
                                                                        <option value="Cymro">Cymro</option>
                                                                        <option value="Cypriot">Cypriot</option>
                                                                        <option value="Czech">Czech</option>
                                                                        <option value="Danish">Danish</option>
                                                                        <option value="Djiboutian">Djiboutian</option>
                                                                        <option value="Dominican (Commonwealth)">Dominican
                                                                            (Commonwealth)</option>
                                                                        <option value="Dominican (Republic)">Dominican
                                                                            (Republic)
                                                                        </option>
                                                                        <option value="Dutch">Dutch</option>
                                                                        <option value="East Timorese">East Timorese
                                                                        </option>
                                                                        <option value="Ecuadorean">Ecuadorean</option>
                                                                        <option value="Egyptian">Egyptian</option>
                                                                        <option value="Emirati">Emirati</option>
                                                                        <option value="English">English</option>
                                                                        <option value="Equatorial Guinean">Equatorial
                                                                            Guinean
                                                                        </option>
                                                                        <option value="Eritrean">Eritrean</option>
                                                                        <option value="Estonian">Estonian</option>
                                                                        <option value="Ethiopian">Ethiopian</option>
                                                                        <option value="Faroese">Faroese</option>
                                                                        <option value="Fijian">Fijian</option>
                                                                        <option value="Filipino">Filipino</option>
                                                                        <option value="Finnish">Finnish</option>
                                                                        <option value="French">French</option>
                                                                        <option value="Gabonese">Gabonese</option>
                                                                        <option value="Gambian">Gambian</option>
                                                                        <option value="Georgian">Georgian</option>
                                                                        <option value="German">German</option>
                                                                        <option value="Ghanaian">Ghanaian</option>
                                                                        <option value="Gibraltarian">Gibraltarian</option>
                                                                        <option value="Greek">Greek</option>
                                                                        <option value="Greenlandic">Greenlandic</option>
                                                                        <option value="Grenadian">Grenadian</option>
                                                                        <option value="Guamanian">Guamanian</option>
                                                                        <option value="Guatemalan">Guatemalan</option>
                                                                        <option value="Guinea-Bissau">Citizen of
                                                                            Guinea-Bissau
                                                                        </option>
                                                                        <option value="Guinean">Guinean</option>
                                                                        <option value="Guyanese">Guyanese</option>
                                                                        <option value="Haitian">Haitian</option>
                                                                        <option value="Honduran">Honduran</option>
                                                                        <option value="Hong Konger">Hong Konger</option>
                                                                        <option value="Hungarian">Hungarian</option>
                                                                        <option value="Icelandic">Icelandic</option>
                                                                        <option value="Indian">Indian</option>
                                                                        <option value="Indonesian">Indonesian</option>
                                                                        <option value="Iranian">Iranian</option>
                                                                        <option value="Iraqi">Iraqi</option>
                                                                        <option value="Irish">Irish</option>
                                                                        <option value="Israeli">Israeli</option>
                                                                        <option value="Italian">Italian</option>
                                                                        <option value="Ivorian">Ivorian</option>
                                                                        <option value="Jamaican">Jamaican</option>
                                                                        <option value="Japanese">Japanese</option>
                                                                        <option value="Jordanian">Jordanian</option>
                                                                        <option value="Kazakh">Kazakh</option>
                                                                        <option value="Kenyan">Kenyan</option>
                                                                        <option value="Kittitian">Kittitian</option>
                                                                        <option value="Kiribati">Citizen of Kiribati
                                                                        </option>
                                                                        <option value="Kosovan">Kosovan</option>
                                                                        <option value="Kuwaiti">Kuwaiti</option>
                                                                        <option value="Kyrgyz">Kyrgyz</option>
                                                                        <option value="Lao">Lao</option>
                                                                        <option value="Latvian">Latvian</option>
                                                                        <option value="Lebanese">Lebanese</option>
                                                                        <option value="Liberian">Liberian</option>
                                                                        <option value="Libyan">Libyan</option>
                                                                        <option value="Liechtenstein citizen">Liechtenstein
                                                                            citizen
                                                                        </option>
                                                                        <option value="Lithuanian">Lithuanian</option>
                                                                        <option value="Luxembourger">Luxembourger</option>
                                                                        <option value="Macanese">Macanese</option>
                                                                        <option value="Macedonian">Macedonian</option>
                                                                        <option value="Malagasy">Malagasy</option>
                                                                        <option value="Malawian">Malawian</option>
                                                                        <option value="Malaysian">Malaysian</option>
                                                                        <option value="Maldivian">Maldivian</option>
                                                                        <option value="Malian">Malian</option>
                                                                        <option value="Maltese">Maltese</option>
                                                                        <option value="Marshallese">Marshallese</option>
                                                                        <option value="Martiniquais">Martiniquais</option>
                                                                        <option value="Mauritanian">Mauritanian</option>
                                                                        <option value="Mauritian">Mauritian</option>
                                                                        <option value="Mexican">Mexican</option>
                                                                        <option value="Micronesian">Micronesian</option>
                                                                        <option value="Moldovan">Moldovan</option>
                                                                        <option value="Monegasque">Monegasque</option>
                                                                        <option value="Mongolian">Mongolian</option>
                                                                        <option value="Montenegrin">Montenegrin</option>
                                                                        <option value="Montserratian">Montserratian
                                                                        </option>
                                                                        <option value="Moroccan">Moroccan</option>
                                                                        <option value="Mosotho">Mosotho</option>
                                                                        <option value="Mozambican">Mozambican</option>
                                                                        <option value="Namibian">Namibian</option>
                                                                        <option value="Nauruan">Nauruan</option>
                                                                        <option value="Nepalese">Nepalese</option>
                                                                        <option value="New Zealander">New Zealander
                                                                        </option>
                                                                        <option value="Nicaraguan">Nicaraguan</option>
                                                                        <option value="Nigerian">Nigerian</option>
                                                                        <option value="Nigerien">Nigerien</option>
                                                                        <option value="Niuean">Niuean</option>
                                                                        <option value="North Korean">North Korean</option>
                                                                        <option value="Northern Irish">Northern Irish
                                                                        </option>
                                                                        <option value="Norwegian">Norwegian</option>
                                                                        <option value="Omani">Omani</option>
                                                                        <option value="Pakistani">Pakistani</option>
                                                                        <option value="Palauan">Palauan</option>
                                                                        <option value="Palestinian">Palestinian</option>
                                                                        <option value="Panamanian">Panamanian</option>
                                                                        <option value="Papua New Guinean">Papua New Guinean
                                                                        </option>
                                                                        <option value="Paraguayan">Paraguayan</option>
                                                                        <option value="Peruvian">Peruvian</option>
                                                                        <option value="Pitcairn Islander">Pitcairn Islander
                                                                        </option>
                                                                        <option value="Polish">Polish</option>
                                                                        <option value="Portuguese">Portuguese</option>
                                                                        <option value="Prydeinig">Prydeinig</option>
                                                                        <option value="Puerto Rican">Puerto Rican</option>
                                                                        <option value="Qatari">Qatari</option>
                                                                        <option value="Romanian">Romanian</option>
                                                                        <option value="Russian">Russian</option>
                                                                        <option value="Rwandan">Rwandan</option>
                                                                        <option value="Salvadorean">Salvadorean</option>
                                                                        <option value="Sammarinese">Sammarinese</option>
                                                                        <option value="Samoan">Samoan</option>
                                                                        <option value="Sao Tomean">Sao Tomean</option>
                                                                        <option value="Saudi Arabian">Saudi Arabian
                                                                        </option>
                                                                        <option value="Scottish">Scottish</option>
                                                                        <option value="Senegalese">Senegalese</option>
                                                                        <option value="Serbian">Serbian</option>
                                                                        <option value="Seychelles">Citizen of Seychelles
                                                                        </option>
                                                                        <option value="Sierra Leonean">Sierra Leonean
                                                                        </option>
                                                                        <option value="Singaporean">Singaporean</option>
                                                                        <option value="Slovak">Slovak</option>
                                                                        <option value="Slovenian">Slovenian</option>
                                                                        <option value="Solomon Islander">Solomon Islander
                                                                        </option>
                                                                        <option value="Somali">Somali</option>
                                                                        <option value="South African">South African
                                                                        </option>
                                                                        <option value="South Korean">South Korean</option>
                                                                        <option value="South Sudanese">South Sudanese
                                                                        </option>
                                                                        <option value="Spanish">Spanish</option>
                                                                        <option value="Sri Lankan">Sri Lankan</option>
                                                                        <option value="St Helenian">St Helenian</option>
                                                                        <option value="St Lucian">St Lucian</option>
                                                                        <option value="Stateless">Stateless</option>
                                                                        <option value="Sudanese">Sudanese</option>
                                                                        <option value="Surinamese">Surinamese</option>
                                                                        <option value="Swazi">Swazi</option>
                                                                        <option value="Swedish">Swedish</option>
                                                                        <option value="Swiss">Swiss</option>
                                                                        <option value="Syrian">Syrian</option>
                                                                        <option value="Taiwanese">Taiwanese</option>
                                                                        <option value="Tajik">Tajik</option>
                                                                        <option value="Tanzanian">Tanzanian</option>
                                                                        <option value="Thai">Thai</option>
                                                                        <option value="Togolese">Togolese</option>
                                                                        <option value="Tongan">Tongan</option>
                                                                        <option value="Trinidadian">Trinidadian</option>
                                                                        <option value="Tristanian">Tristanian</option>
                                                                        <option value="Tunisian">Tunisian</option>
                                                                        <option value="Turkish">Turkish</option>
                                                                        <option value="Turkmen">Turkmen</option>
                                                                        <option value="Turks and Caicos Islander">Turks and
                                                                            Caicos
                                                                            Islander</option>
                                                                        <option value="Tuvaluan">Tuvaluan</option>
                                                                        <option value="Ugandan">Ugandan</option>
                                                                        <option value="Ukrainian">Ukrainian</option>
                                                                        <option value="Uruguayan">Uruguayan</option>
                                                                        <option value="Uzbek">Uzbek</option>
                                                                        <option value="Vatican citizen">Vatican citizen
                                                                        </option>
                                                                        <option value="Vanuatu">Citizen of Vanuatu</option>
                                                                        <option value="Venezuelan">Venezuelan</option>
                                                                        <option value="Vietnamese">Vietnamese</option>
                                                                        <option value="Vincentian">Vincentian</option>
                                                                        <option value="Wallisian">Wallisian</option>
                                                                        <option value="Welsh">Welsh</option>
                                                                        <option value="Yemeni">Yemeni</option>
                                                                        <option value="Zambian">Zambian</option>
                                                                        <option value="Zimbabwean">Zimbabwean</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Your Interests</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Your Interests</h4>
                                                                    <button type="button" id="openModal"
                                                                        class="btn btn-primary">Add Interests</button>
                                                                    <div id="selectedSports"></div>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center mb-3">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Your name</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex gap-3">
                                                                    <h4 class="">Your name</h4>
                                                                    <div class="d-flex gap-1">
                                                                        <input type="text" name="first_name"
                                                                            id="first_name">
                                                                    </div>
                                                                    <br>
                                                                    <div class="d-flex gap-1">
                                                                        <input type="text" name="last_name"
                                                                            id="last_name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Gender</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="heading">Gender</h4>
                                                                    <select name="gender_req">
                                                                        <option value="N">Males or Females</option>
                                                                        <option value="M">Males</option>
                                                                        <option value="F">Females</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Age Range</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7 d-flex">
                                                                    <h4 class="heading">Age Range</h4>
                                                                    <select name="min_age_req">
                                                                        <option value="" selected="">Select...
                                                                        </option>
                                                                        <option value="18">18</option>
                                                                        <option value="19">19</option>
                                                                        <option value="20">20</option>
                                                                        <option value="21">21</option>
                                                                        <option value="22">22</option>
                                                                        <option value="23">23</option>
                                                                        <option value="24">24</option>
                                                                        <option value="25">25</option>
                                                                        <option value="26">26</option>
                                                                        <option value="27">27</option>
                                                                        <option value="28">28</option>
                                                                        <option value="29">29</option>
                                                                        <option value="30">30</option>
                                                                        <option value="31">31</option>
                                                                        <option value="32">32</option>
                                                                        <option value="33">33</option>
                                                                        <option value="34">34</option>
                                                                        <option value="35">35</option>
                                                                        <option value="36">36</option>
                                                                        <option value="37">37</option>
                                                                        <option value="38">38</option>
                                                                        <option value="39">39</option>
                                                                        <option value="40">40</option>
                                                                        <option value="41">41</option>
                                                                        <option value="42">42</option>
                                                                        <option value="43">43</option>
                                                                        <option value="44">44</option>
                                                                        <option value="45">45</option>
                                                                        <option value="46">46</option>
                                                                        <option value="47">47</option>
                                                                        <option value="48">48</option>
                                                                        <option value="49">49</option>
                                                                        <option value="50">50</option>
                                                                        <option value="51">51</option>
                                                                        <option value="52">52</option>
                                                                        <option value="53">53</option>
                                                                        <option value="54">54</option>
                                                                        <option value="55">55</option>
                                                                        <option value="56">56</option>
                                                                        <option value="57">57</option>
                                                                        <option value="58">58</option>
                                                                        <option value="59">59</option>
                                                                        <option value="60">60</option>
                                                                        <option value="61">61</option>
                                                                        <option value="62">62</option>
                                                                        <option value="63">63</option>
                                                                        <option value="64">64</option>
                                                                        <option value="65">65</option>
                                                                        <option value="66">66</option>
                                                                        <option value="67">67</option>
                                                                        <option value="68">68</option>
                                                                        <option value="69">69</option>
                                                                        <option value="70">70</option>
                                                                        <option value="71">71</option>
                                                                        <option value="72">72</option>
                                                                        <option value="73">73</option>
                                                                        <option value="74">74</option>
                                                                        <option value="75">75</option>
                                                                        <option value="76">76</option>
                                                                        <option value="77">77</option>
                                                                        <option value="78">78</option>
                                                                        <option value="79">79</option>
                                                                        <option value="80">80</option>
                                                                        <option value="81">81</option>
                                                                        <option value="82">82</option>
                                                                        <option value="83">83</option>
                                                                        <option value="84">84</option>
                                                                        <option value="85">85</option>
                                                                        <option value="86">86</option>
                                                                        <option value="87">87</option>
                                                                        <option value="88">88</option>
                                                                        <option value="89">89</option>
                                                                        <option value="90">90</option>
                                                                        <option value="91">91</option>
                                                                        <option value="92">92</option>
                                                                        <option value="93">93</option>
                                                                        <option value="94">94</option>
                                                                        <option value="95">95</option>
                                                                        <option value="96">96</option>
                                                                        <option value="97">97</option>
                                                                        <option value="98">98</option>
                                                                        <option value="99">99</option>
                                                                    </select>
                                                                    <span>to</span>
                                                                    <select name="max_age_req">
                                                                        <option value="" selected="">Select...
                                                                        </option>
                                                                        <option value="18">18</option>
                                                                        <option value="19">19</option>
                                                                        <option value="20">20</option>
                                                                        <option value="21">21</option>
                                                                        <option value="22">22</option>
                                                                        <option value="23">23</option>
                                                                        <option value="24">24</option>
                                                                        <option value="25">25</option>
                                                                        <option value="26">26</option>
                                                                        <option value="27">27</option>
                                                                        <option value="28">28</option>
                                                                        <option value="29">29</option>
                                                                        <option value="30">30</option>
                                                                        <option value="31">31</option>
                                                                        <option value="32">32</option>
                                                                        <option value="33">33</option>
                                                                        <option value="34">34</option>
                                                                        <option value="35">35</option>
                                                                        <option value="36">36</option>
                                                                        <option value="37">37</option>
                                                                        <option value="38">38</option>
                                                                        <option value="39">39</option>
                                                                        <option value="40">40</option>
                                                                        <option value="41">41</option>
                                                                        <option value="42">42</option>
                                                                        <option value="43">43</option>
                                                                        <option value="44">44</option>
                                                                        <option value="45">45</option>
                                                                        <option value="46">46</option>
                                                                        <option value="47">47</option>
                                                                        <option value="48">48</option>
                                                                        <option value="49">49</option>
                                                                        <option value="50">50</option>
                                                                        <option value="51">51</option>
                                                                        <option value="52">52</option>
                                                                        <option value="53">53</option>
                                                                        <option value="54">54</option>
                                                                        <option value="55">55</option>
                                                                        <option value="56">56</option>
                                                                        <option value="57">57</option>
                                                                        <option value="58">58</option>
                                                                        <option value="59">59</option>
                                                                        <option value="60">60</option>
                                                                        <option value="61">61</option>
                                                                        <option value="62">62</option>
                                                                        <option value="63">63</option>
                                                                        <option value="64">64</option>
                                                                        <option value="65">65</option>
                                                                        <option value="66">66</option>
                                                                        <option value="67">67</option>
                                                                        <option value="68">68</option>
                                                                        <option value="69">69</option>
                                                                        <option value="70">70</option>
                                                                        <option value="71">71</option>
                                                                        <option value="72">72</option>
                                                                        <option value="73">73</option>
                                                                        <option value="74">74</option>
                                                                        <option value="75">75</option>
                                                                        <option value="76">76</option>
                                                                        <option value="77">77</option>
                                                                        <option value="78">78</option>
                                                                        <option value="79">79</option>
                                                                        <option value="80">80</option>
                                                                        <option value="81">81</option>
                                                                        <option value="82">82</option>
                                                                        <option value="83">83</option>
                                                                        <option value="84">84</option>
                                                                        <option value="85">85</option>
                                                                        <option value="86">86</option>
                                                                        <option value="87">87</option>
                                                                        <option value="88">88</option>
                                                                        <option value="89">89</option>
                                                                        <option value="90">90</option>
                                                                        <option value="91">91</option>
                                                                        <option value="92">92</option>
                                                                        <option value="93">93</option>
                                                                        <option value="94">94</option>
                                                                        <option value="95">95</option>
                                                                        <option value="96">96</option>
                                                                        <option value="97">97</option>
                                                                        <option value="98">98</option>
                                                                        <option value="99">99</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Smoking</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="heading">Smoking</h4>
                                                                    <select name="smoking">
                                                                        <option value="Y">Don't mind</option>
                                                                        <option value="N">No thanks</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Pets</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Pets</h4>
                                                                    <select name="pets_req">
                                                                        <option value="Y">Don't mind</option>
                                                                        <option value="N">No thanks</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Occupation</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Occupation</h4>
                                                                    <select name="share_type_req">
                                                                        <option value="M">Don't mind</option>
                                                                        <option value="S">Students</option>
                                                                        <option value="P">Professionals</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Orientation</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Orientation</h4>
                                                                    <select name="gay_lesbian_req">
                                                                        <option value="ND" selected="">Not
                                                                            important
                                                                        </option>
                                                                        <option value="S">Straight</option>
                                                                        <option value="G">Gay/Lesbian</option>
                                                                        <option value="B">Bisexual</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Advert title</h4>
                                                         <p class="sub-heading">(Short description)</p> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Advert title</h4>
                                                                    <p class="sub-heading">(Short description)</p>
                                                                    <div class="d-flex gap-1">
                                                                        <input type="text" name="ad_title"
                                                                            class="input-field">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Description</h4>
                                                         <p class="sub-heading">(No contact details permitted
                                                             within description)</p> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Description</h4>
                                                                    <p class="sub-heading">(No contact details permitted
                                                                        within description)</p>
                                                                    <div class="d-flex gap-1">
                                                                        <textarea name="ad_text" class="input-field"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Upload photos</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Upload photos</h4>
                                                                    <input class="form-control" type="file"
                                                                        id="imageUpload" name="images[]" multiple>
                                                                    <div id="previewContainer"></div>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-lg-4">
                                                                    <div class="left-area">
                                                                        {{-- <h4 class="heading">Telephone</h4> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <h4 class="">Telephone</h4 <div
                                                                        class="d-flex gap-1">
                                                                    <input type="text" name="tel"
                                                                        class="input-field">
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>

                                                <div id="nextprev1">
                                                    <button id="next1" type="button"
                                                        class="btn btn-primary float-none w-25 rounded-0 submit-btn">Next</button>
                                                </div>
                                                <div class="d-none" style="display:none;" id="nextprev2">
                                                    <button id="prev2" type="button"
                                                        class="btn btn-primary float-none w-25 rounded-0 submit-btn ">Previous</button>
                                                    <button style="margin-top: 0;" class="addProductSubmit-btn w-25"
                                                        type="submit">{{ __('Create Shop') }}</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Select Sports</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="searchBar" class="form-control" placeholder="Search sports...">
                        <ul id="sportsList" class="list-group">
                            <li class="list-group-item">Football</li>
                            <li class="list-group-item">Basketball</li>
                            <li class="list-group-item">Tennis</li>
                            <li class="list-group-item">Cricket</li>
                            <li class="list-group-item">Baseball</li>
                            <li class="list-group-item">Hockey</li>
                            <li class="list-group-item">Soccer</li>
                            <li class="list-group-item">Golf</li>
                            <li class="list-group-item">Badminton</li>
                            <li class="list-group-item">Volleyball</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button id="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selected sports will be displayed here -->
    </div>
    <!--==================== Blog Section End ====================-->
    {{-- Modal --}}
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h4 class="modal-title d-inline-block">{{ __('License Key') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">{{ __('The Licenes Key is :') }} <span id="key"></span></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- @includeIf('partials.global.common-footer') --}}
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

        .addProductSubmit-btn {
            background: #1f224f;
            width: 160px;
            height: 40px;
            color: #fff;
            font-size: 14px;
            border: 0px;
            margin-top: 15px;
            -webkit-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
        }

        .check-container input[type="checkbox"] {
            background-color: black;
        }
    </style>
@stop
@section('javascript')
    @includeIf('sales_order.common_js')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
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
                    reader.readAsDataURL(file);
                });
            });
        });
        $(document).ready(function() {
            $("#next1").click(function() {
                $("#showingbtn1").css('display', 'none');
                $("#showingbtn2").css('display', 'block');
                $("#nextprev1").css('display', 'none').removeClass("d-flex gap-1 justify-content-between");
                $("#nextprev2").css('display', 'block').addClass("d-flex gap-1 justify-content-between");
            });

            $("#prev2").click(function() {
                $("#showingbtn1").css('display', 'block');
                $("#showingbtn2").css('display', 'none');
                $("#nextprev1").css('display', 'block').addClass("d-flex gap-1 justify-content-between");
                $("#nextprev2").css('display', 'none').removeClass("d-flex gap-1 justify-content-between");
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

            // Submit button click event
            $('#submit').click(function() {
                // Get the selected sports
                var selectedSports = [];
                $('#sportsList .list-group-item.active').each(function() {
                    selectedSports.push($(this).text());
                });
                console.log(selectedSports)
                // Display the selected sports in the UI
                $('#selectedSports').html('Selected Sports: ' + selectedSports.join(', '));
                var inputField = $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'selectedSports')
                    .val(JSON.stringify(selectedSports));
                $('#property_wanted_form').append(inputField);


                // Hide the modal
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
        });
    </script>
@endsection
