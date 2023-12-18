<!-- Step 5 -->
<div class="step" id="step-5">

    <!-- Start Step 5 -->
    <div class="grid-12-4" style="display: flex; justify-content: center;">
        <div>

            <div class="block block_simple block_offered_listing">
                <div class="block_header">
                    <h2>
                        Step 5 of 6</h2>
                </div>

                <div class="block_content">

                    <div id="deposit_warning_popup"></div>

                    <fieldset>
                        <legend>Your ad &amp; contact details</legend>

                        <div class="form_row form_row_title ">
                            <div class="form_label">

                                <span>Advert title</span>

                                <div class="form_hint" id="advertTitleHint">
                                    (short description – max 100 characters)
                                </div>

                            </div>
                            <div class="form_inputs">
                                <span class="form_input form_text">
                                    {{-- <input type="text" name="advert_title" value="" size="50"
                                        maxlength="50"> --}}
                                    <textarea name="advert_title" rows="4" cols="25" maxlength="100"></textarea>

                                </span>
                            </div>
                        </div>

                        <div id="descriptionRowOrginal" class="form_row form_row_description ">
                            <div class="form_label">

                                <span id="">Description</span>

                            </div>
                            <div class="form_inputs">

                                <span class="form_input form_text">
                                    <textarea id="descOrginalTextArea" name="advert_description" rows="15" cols="50" wrap="virtual"></textarea>
                                </span>
                                <div class="form_hint" id="descriptionHint">
                                    Tips: Give more detail about the accommodation
                                    and who you are looking for. You must write at least 25 words and
                                    can
                                    write as much as you like within reason. (No contact details
                                    permitted
                                    within description).
                                </div>


                            </div>
                        </div>


                        {{-- <div class="msg warning">
            <span>As the advertiser, it's your responsibility to:</span>
            <ul class="msg-warning__list">
                <li class="msg-warning__list-item"><i class="far fa-check"></i>
                    <p class="msg-warning__text">Include <span
                            class="msg-warning__text-bold">EPC energy rating</span>
                        (upload as one of your ad's photos)</p>
                </li>
                <li class="msg-warning__list-item"><i class="far fa-check"></i>
                    <p class="msg-warning__text">Include <span
                            class="msg-warning__text-bold">council tax band</span>
                        (specify in your ad's description) <span id="councilTaxModal"><button
                                class="button button--link" type="button"
                                aria-label="council tax info"><i
                                    class="fas fa-info-circle"></i></button></span></p>
                </li>

                <li class="msg-warning__list-item"><i class="far fa-check"></i>
                    <p class="msg-warning__text">Familiarise yourself with <a
                            href="/content/default/discrimination"
                            target="_blank">discrimination laws</a></p>
                </li>
            </ul>
        </div> --}}





                        <div class="form_row form_row_photos post-ad__photo-upload">
                            <div class="post-ad__photo-upload-label">Upload photos</div>

                            <div class="form_inputs">
                                <div id="photoUploader" data-upload-url="">
                                    <div data-testid="uploader">
                                        <div class="dropzone-wrapper">
                                            <div class="dropzone-button">
                                                <!-- Input type file field -->
                                                <input type="file" name="advert_photos[]" multiple />
                                                <p class="dropzone__file-hint">.jpg or .png only. Up to
                                                    16mb</p>
                                            </div>
                                        </div>
                                        <div class="uploader__hint">Photos must not contain any web
                                            urls
                                            or contact details. Only branded advertisers may include a
                                            company name or logo.</div>
                                        <div class="photo-upload"></div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="form_row form_row_name  ">
                            <div class="form_label">
                                Your name
                            </div>
                            <div class="form_inputs">
                                <span class="form_input form_text">
                                    <input type="text" name="advert_first_name" value="Amal"
                                        placeholder="First name" autocomplete="given-name">
                                </span>
                                <span class="form_input form_text">
                                    <input type="text" name="advert_last_name" value="Santos" placeholder="Last name"
                                        autocomplete="family-name">
                                </span>
                                <label class="form_input form_checkbox">
                                    <input type="checkbox" name="advert_on_last_name" value=1>
                                    Display last name on advert?
                                </label>

                            </div>
                        </div>

                        <div class="form_row form_row_tel">
                            <div class="form_label"> Marketing Contact </div>
                            <div class="form_inputs">
                                <span class="form_input form_text">
                                    <input class="form_input_tel" type="tel" name="advert_telephone"
                                        value="+1 (111) 111-111" autocomplete="tel" id="form_input--tel-n">
                                </span>
                                <label class="form_input form_checkbox">
                                    <input name="advert_on_telephone" value=1 type="checkbox">
                                    Display with advert?
                                </label>
                            </div>
                        </div>

                        <div class="form_row form_row_tel">
                            <div class="form_label"> Seconday Contact </div>
                            <div class="form_inputs">
                                <span class="form_input form_text">
                                    <input class="form_input_tel" type="tel" name="secondary_telephone"
                                        value="+1 (111) 222-222" autocomplete="sec_tel" id="form_input--tel-n">
                                </span>
                            </div>
                        </div>

                        <div id="inputButtonWrapper">

                            <div class="form_row ">
                                <div class="form_label"></div>
                                <div class="form_inputs">
                                    <div class="btn-wrapper">


                                        {{-- <div><button class="button" type="submit" name="validate_step"
                                        value="Continue to next step">Continue to next
                                        step</button> </div>
                                <div class="btn-wrapper__back-btn">
                                    <input class="button button--link" id="backButton"
                                        type="submit" name="prev_step" value="Back">
                                </div> --}}

                                    </div>
                                </div>
                            </div>

                        </div>

                    </fieldset>

                </div>

            </div>

        </div>
    </div>
    <!-- End Step 5 -->


    <div class="next-prev-btn-container">
        <button type="button" class="btn btn-primary prev-btn">Previous</button>
        <button type="button" class="btn btn-primary next-btn">Next</button>
    </div>
</div>
