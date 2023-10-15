<!-- Step 4 -->
<div class="step" id="step-4">

    <div class="grid-12-4" style="display: flex; justify-content: center;">
        <div>
            <div class="block block_simple block_offered_listing">
                <div class="block_header">
                    <h2> Step 4 of 6</h2>
                </div>

                <div class="block_content">
                    <div id="deposit_warning_popup"></div>

                    <fieldset id="existing_flatmate_id">
                        <legend>The Existing Flatmate</legend>

                        <div class="form_row form_row_smoking">
                            <div class="form_label"> Smoking </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="exiting_flatmate_smoking">
                                        <option value=1>Yes</option>
                                        <option value=2 selected="">No</option>
                                    </select>
                                </span>
                            </div>
                        </div>

                        <div class="form_row form_row_gender ">
                            <div class="form_label"> Gender </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="exiting_flatmate_gender">
                                        <option selected="" value="">Select ....</option>
                                        @foreach (getSex() as $item)
                                            <option value="{{ $item['value'] }}"
                                                {{ old('sex') == $item['value'] ? 'selected' : '' }}>
                                                {{ $item['label'] }}
                                            </option>
                                        @endforeach
                                    </select>

                                </span>
                            </div>
                        </div>
                        <div class="form_row form_row_occupation">
                            <div class="form_label">
                                Occupation
                            </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="exiting_flatmate_occupation">
                                        <option value="Not disclosed" selected="">Not disclosed</option>
                                        <option value="Student">Student</option>
                                        <option value="Professional">Professional</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </span>
                            </div>
                        </div>




                        <div class="form_row form_row_pets">
                            <div class="form_label"> Pets </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="exiting_flatmate_pets">
                                        <option value=2>no</option>
                                        <option value=1>yes</option>
                                    </select>
                                </span>
                            </div>
                        </div>


                        <div class="form_row form_row_age">
                            <div class="form_label"> Age </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="exiting_flatmate_age">
                                        <option value="null" selected="">-</option>
                                        @foreach (range(1, 150) as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </div>
                        </div>


                        <div class="form_row form_row_language">
                            <div class="form_label"> Language </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="exiting_flatmate_language">

                                        @include('partial.language')

                                    </select>
                                </span>
                            </div>
                        </div>
                        <div class="form_row form_row_nationality">
                            <div class="form_label"> Nationality </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <span id="nationality-select" data-selected=""><select
                                            name="exiting_flatmate_nationality">

                                            @include('partial.nationality')

                                        </select></span>
                                </span>
                            </div>
                        </div>

                        <div class="form_row form_row_orientation">
                            <div class="form_label"> Sexual orientation </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="exiting_flatmate_sexual_orientation">
                                        <option value="Not disclosed">Not disclosed</option>
                                        <option value="Straight">Straight</option>
                                        <option value="Bisexual">Bisexual</option>
                                    </select>
                                </span>
                                <label class="form_input form_checkbox">
                                    <input type="checkbox" name="exiting_flatmate_sexual_orientation_check_box" value=1>
                                    Yes, I would like my orientation to form part of my ad's search
                                    criteria
                                    and allow others to search on this field.
                                </label>
                            </div>
                        </div>


                    </fieldset>

                    <fieldset>
                        <legend> Preferences For New flatmates </legend>
                        <div class="form_row form_row_smoking">
                            <div class="form_label"> smoking </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="new_flatmate_smoking">
                                        <option value=0>No preference</option>
                                        <option value=1>Yes</option>
                                        <option value=2>No</option>
                                    </select>
                                </span>
                            </div>
                        </div>

                        <div class="form_row form_row_gender">
                            <div class="form_label"> Gender </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="new_flatmate_gender">
                                        <option selected="" value="">Select ....</option>
                                        @foreach (getSex() as $item)
                                            <option value="{{ $item['value'] }}"
                                                {{ old('sex') == $item['value'] ? 'selected' : '' }}>
                                                {{ $item['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </span>
                            </div>
                        </div>

                        <div class="form_row form_row_occupation">
                            <div class="form_label"> Occupation </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="new_flatmate_occupation">
                                        <option value="0">No preference</option>
                                        <option value="S">Student</option>
                                        <option value="P">Professional</option>
                                    </select>
                                </span>
                            </div>
                        </div>

                        <div class="form_row form_row_pets">
                            <div class="form_label"> Pets considered </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="new_flatmate_pets">
                                        <option value=1>yes</option>
                                        <option value=2>no</option>
                                    </select>
                                </span>
                            </div>
                        </div>

                        <div class="form_row form_row_min_age">
                            <div class="form_label"> Minimum age </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="new_flatmate_min_age">
                                        <option value="null" selected="">-</option>
                                        @foreach (range(1, 150) as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </div>
                        </div>

                        <div class="form_row form_row_max_age">
                            <div class="form_label"> Maximum age </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">

                                    <select name="new_flatmate_max_age">
                                        <option value="null" selected="">-</option>
                                        @foreach (range(1, 150) as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </div>
                        </div>

                        <div class="form_row form_row_language">
                            <div class="form_label"> Language </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="new_flatmate_language">

                                        @include('partial.language')

                                    </select>
                                </span>
                            </div>
                        </div>

                        <div class="form_row form_row_couples">
                            <div class="form_label"> Couples welcome? </div>
                            <div class="form_inputs">
                                <span class="form_input">
                                    <label><input type="radio" name="new_flatmate_couples" value=2>
                                        no
                                    </label>
                                    <label><input type="radio" name="new_flatmate_couples" value=1>
                                        yes
                                    </label>
                                </span>
                                <div class="form_hint"> *specify any rent adjustments in your ad description on next
                                    step

                                </div>
                            </div>
                        </div>

                        <div class="form_row form_row_misc">
                            <div class="form_label"> Vegetarians preferred? </div>
                            <div class="form_inputs">
                                <span class="form_input form_select">
                                    <select name="new_flatmate_vegetarians">
                                        <option value="2">No preference</option>
                                        <option value=1>Yes</option>
                                    </select>
                                </span>
                            </div>
                        </div>

                    </fieldset>
                </div>
            </div>
        </div>
    </div>
    <!-- End Step 4 -->
    <div class="next-prev-btn-container">
        <button type="button" class="btn btn-primary prev-btn">Previous</button>
        <button type="button" class="btn btn-primary next-btn">Next</button>
    </div>
</div>
