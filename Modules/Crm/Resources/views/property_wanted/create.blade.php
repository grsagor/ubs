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

    $(document).ready(function() {
        // Show "Room 1" by default
        $("#room1").show();

        // Hide additional rooms initially
        $(".form_room_fieldset:not(#room1)").hide();

        // Show the selected number of additional rooms
        $("#roomQuantitySelect").change(function() {
            var selectedQuantity = parseInt($(this).val());

            // Hide all additional rooms
            $(".form_room_fieldset:not(#room1)").hide();

            // Show only the selected number of additional rooms
            for (var i = 2; i <= selectedQuantity; i++) {
                $("#room" + i).show();
            }
        });
    });
</script>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add room to rent</h4>
        </div>

        <div class="modal-body">
            <form action="{{ url('contact/property-wanted') }}" id="property_wanted_form" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div id="showingbtn1" class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Who's searching?:</label>
                            <div>
                                <input class="form-check-input" type="radio" name="who_is_searching" value="Just Me"
                                id="justme">
                            <label for="justme">Just Me</label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="who_is_searching"
                                    value="Me and a partner" id="meandapartner">
                                <label for="meandapartner">Me and a partner</label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="who_is_searching"
                                    value="Me and a friend" id="meandafriend">
                                <label for="meandafriend">Me and a friend</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Why is searching?</label>
                            <textarea name="why_is_searching" class="form-control" type="text"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_scheme_id">Your gender(s)</label> 
                            <select class="form-control" required="" id="gender" name="gender">
                                <option selected="" value="">Select
                                    ....</option>
                                @foreach (getSex() as $item)
                                    <option value="{{ $item['value'] }}"
                                        {{ old('sex') == $item['value'] ? 'selected' : '' }}>
                                        {{ $item['label'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Room size</label>
                            <div>
                                <input class="form-check-input" type="radio" name="room_size" value="A single room" id="dobuleroom">
                                <label for="dobuleroom">A single room</label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="room_size" value="A double room" id="dobuleroom">
                                <label for="dobuleroom">A double room</label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="room_size" value="A single or double" id="asingleordouble">
                                <label for="asingleordouble">A single or double
                                    room</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="showingbtn2" class="d-none row" style="display:none;">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_scheme_id">Where do you want to live?</label> 
                            <select class="form-control" required="" id="invoice_scheme_id" name="wanted_living_area">
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

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_scheme_id">Your budget</label> 
                                <p class="">(total rental amount you can afford)</p>
                                <div class="row">
                                    <div class="col-sm-7">
                                        <input class="form-control" placeholder="4" name="combined_budget" type="number" id="custom_field1">
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control" required="" id="per" name="per">
                                            <option value="" selected="">Per week or month</option>
                                            <option value="pw">per week</option>
                                            <option value="pcm">per month</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">I am available to move in from</label>
                            <input class="form-control" name="available_form" type="date"
                                id="date">
                        </div>
                    </div>

                    @php
                        $months = [
                            1 => '1 month',
                            2 => '2 months',
                            3 => '3 months',
                            4 => '4 months',
                            5 => '5 months',
                            6 => '6 months',
                            7 => '7 months',
                            8 => '8 months',
                            9 => '9 months',
                            10 => '10 months',
                            11 => '11 months',
                            12 => '1 year',
                            15 => '1 year 3 months',
                            18 => '1 year 6 months',
                            21 => '1 year 9 months',
                            24 => '2 years',
                            36 => '3 years',
                        ];
                    @endphp

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_scheme_id">Period accommodation needed for</label> 
                            <select class="form-control" required="" id="min_term" name="min_term">
                                <option value="0" selected>No maximum
                                </option>
                                @foreach ($months as $value => $label)
                                    <option value="{{ $value }}">
                                        {{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_scheme_id">I want to stay in the accommodation</label> 
                            <select class="form-control" required="" id="days_of_wk_available" name="days_of_wk_available">
                                <option value="7 days a week">7 days a week
                                </option>
                                <option value="Mon to Fri only">Mon to Fri only
                                </option>
                                <option value="Weekends only">Weekends only
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>I would prefer these amenities</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div><label for="furnished"><input type="checkbox" name="roomfurnishings[]" value="furnished"
                                        id="furnished">Furnished</label></div>
                                    <div><label for="living_room"><input type="checkbox" name="roomfurnishings[]"
                                        value="living_room" id="living_room">Shared living room</label></div>
                                    <div><label for="washing_machine"><input type="checkbox" name="roomfurnishings[]"
                                        value="washing_machine" id="washing_machine">Washing
                                    machine</label></div>
                                    <div><label for="garden"><input type="checkbox" name="roomfurnishings[]" value="garden"
                                        id="garden">Garden/roof terrace</label></div>
                                    <div><label for="balcony"><input type="checkbox" name="roomfurnishings[]" value="balcony"
                                        id="balcony">Balcony/patio</label></div>
                                </div>
                                <div class="col-sm-6">
                                    <div><label for="off_street_parking"><input type="checkbox" name="roomfurnishings[]"
                                        value="off_street_parking" id="off_street_parking">Parking</label></div>
                                    <div><label for="garage"><input type="checkbox" name="roomfurnishings[]" value="garage"
                                        id="garage">Garage</label></div>
                                    <div><label for="disabled_access"><input type="checkbox" name="roomfurnishings[]"
                                        value="disabled_access" id="disabled_access">Disabled
                                    access</label></div>
                                    <div><label for="broadband"><input type="checkbox" name="roomfurnishings[]" value="broadband"
                                        id="broadband">Broadband</label></div>
                                    <div><label for="ensuite"><input type="checkbox" name="roomfurnishings[]" value="ensuite"
                                        id="ensuite">En-suite</label></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Age</label> <i
                                class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                                data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i> <select class="form-control"
                                id="age" name="age">
                                <option value="">Select...</option>
                                @foreach (range(18, 99) as $age)
                                    <option value="{{ $age }}">
                                        {{ $age }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Occupation</label> <i
                                class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                                data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i> <select class="form-control"
                                id="occupation" name="occupation">
                                <option value="ND" selected="">Not
                                    disclosed
                                </option>
                                <option value="Student">Student</option>
                                <option value="Professional">Professional</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Do you smoke?</label> <i
                                class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                                data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i> <select class="form-control"
                                id="smoking_current" name="smoking_current">
                                <option value="2">no</option>
                                <option value="1">yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Do you have any pets?</label> <i
                                class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                                data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i> <select class="form-control"
                                id="pets" name="pets">
                                <option value="2" selected="">no</option>
                                <option value="1">yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Your sexual orientation</label> <i
                                class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                                data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i> <select class="form-control"
                                id="gay_lesbian" name="gay_lesbian">
                                <option value="Undisclosed" selected="">
                                    Undisclosed
                                </option>
                                <option value="Straight">Straight</option>
                                <option value="Gay/Lesbian">Gay/Lesbian</option>
                                <option value="Bisexual">Bisexual</option>
                            </select>
                            <label class="form_input form_checkbox">
                                <input type="checkbox" name="gay_consent" value="1">
                                Yes, I would like my orientation to form part of my
                                ad's
                                search criteria and allow others to search on this
                                field.
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Your preferred language</label> <i
                                class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                                data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i> <select class="form-control"
                                id="lang_id" name="lang_id">
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

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Your nationality</label> <i
                                class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                                data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i> <select class="form-control"
                                id="nationality" name="nationality">
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

                    <div class="col-sm-12" style="margin-top: 15px;">
                        <div class="form-group">
                            <label for="custom_field2">Your Interests</label><br>
                            <button type="button" id="openModal" class="btn btn-primary">Select</button>
                        <div id="selectedSports"></div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field2">Your name</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input class="form-control" placeholder="First name" name="first_name" type="text"
                                    id="first_name">
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" placeholder="Last name" name="last_name" type="text"
                                    id="last_name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 input_group_title_container">
                        <h6>Your flatmate preference</h6>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Gender</label> <i
                                class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                                data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i>
                            <select class="form-control" id="gender_req" name="gender_req">
                                <option selected="" value="">Select
                                    ....</option>
                                @foreach (getSex() as $item)
                                    <option value="{{ $item['value'] }}"
                                        {{ old('sex') == $item['value'] ? 'selected' : '' }}>
                                        {{ $item['label'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Age Range</label> <i
                                class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                                data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i>
                            <div style="display: flex;">
                                <div class="">
                                    <select class="form-control" id="min_age_req" name="min_age_req">
                                        <option value="" selected>Select...</option>
                                        @foreach (range(18, 99) as $age)
                                            <option value="{{ $age }}">
                                                {{ $age }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="display: flex; justify-content: center; align-items: center; flex-direction:column;"><span style="margin-bottom: 15px;">to</span></div>
                                <div class="">
                                    <select class="form-control" id="max_age_req" name="max_age_req">
                                        <option value="" selected>Select...</option>
                                        @foreach (range(18, 99) as $age)
                                            <option value="{{ $age }}">
                                                {{ $age }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Smoking</label> <i
                                class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                                data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i>
                            <select class="form-control" id="smoking" name="smoking">
                                <option value="Don't mind">Don't mind</option>
                                <option value="No thanks">No thanks</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Pets</label> <i
                                class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                                data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i>
                            <select class="form-control" id="pets_req" name="pets_req">
                                <option value="Don't mind">Don't mind</option>
                                <option value="No thanks">No thanks</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="selling_price_group_id">Orientation</label> <i
                                class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                                data-toggle="popover" data-placement="auto bottom"
                                data-content="This price group will be used as the default price group in this location."
                                data-html="true" data-trigger="hover"></i>
                            <select class="form-control" id="gay_lesbian_req" name="gay_lesbian_req">
                                <option value="Not important" selected="">Not
                                    important
                                </option>
                                <option value="Straight">Straight</option>
                                <option value="Gay/Lesbian">Gay/Lesbian</option>
                                <option value="Bisexual">Bisexual</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Advert title</label>
                            <p class="sub-heading">(Short description)</p>
                            <input class="form-control" placeholder="Short description" name="ad_title" type="text"
                                id="ad_title">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Description</label>
                            <p class="sub-heading">(No contact details permitted within description)</p>
                            <textarea type="text" class="form-control" name="ad_text" class="input-field"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Upload photos</label>
                            <input class="form-control" name="images[]" type="file" id="imageUpload" multiple>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Telephone</label>
                            <input class="form-control" placeholder="Telephone" name="tel" type="text"
                                id="tel">
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
                    <button style="margin-top: 0;" class="addProductSubmit-btn w-25 btn btn-success"
                        type="submit">Submit</button>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
        </div>


    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


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

    /* .addProductSubmit-btn {
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
    } */

    .check-container input[type="checkbox"] {
        background-color: black;
    }

    .input_group_title_container{
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .input_group_title_container h6{
        font-size: 22px;
        font-weight: bold;
    }
</style>
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
