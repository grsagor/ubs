  <!-- Step 3 -->
  <div class="step" id="step-3">
      <h3 class="text-center mb-2">Step 3</h3>
      <!-- Step 3 form fields go here -->



      <!-- Start Step 3 -->
      <div class="grid-12-4" style="display: flex; justify-content: center;">
          <div>

              <div class="block block_simple block_offered_listing">
                  <div class="block_header">
                      <h2> Step 3 of 6</h2>
                  </div>

                  <div class="block_content">
                      <div id="deposit_warning_popup"></div>

                      <fieldset>

                          <legend>The rooms</legend>
                          <div id="customRoomQuantity"></div>

                          <fieldset class="form_room_fieldset" id="room1">
                              <legend> Room 1 </legend>
                              <input type="hidden" name="service_charge_room1" id="service_charge_room1">
                              <div class="form_row form_row_cost ">
                                  <div class="form_label"> Cost of room </div>
                                  <div class="form_inputs"> <span class="form_input form_text"> <span
                                              class="form_currency_symbol">£</span> <input type="number"
                                              name="room_cost_of_amount1" value="" size="6" step="any">
                                      </span> <label class="form_input form_radio"> <input type="radio"
                                              name="room_cost_time1" value=1> per week </label> <label
                                          class="form_input form_radio"> <input type="radio" name="room_cost_time1"
                                              checked="" value=2> per
                                          calendar month </label> </div>
                              </div>
                              <div class="form_row form_row_room_size">
                                  <div class="form_label"> Size of room </div>
                                  <div class="form_inputs">
                                      <label class="form_input form_radio"> <input type="radio" name="room_size1"
                                              value=1> Single </label>
                                      <label class="form_input form_radio"> <input type="radio" name="room_size1"
                                              value=2> Double </label>
                                      <label class="form_input form_radio"> <input type="radio" name="room_size1"
                                              value=3> Semi-double </label>
                                  </div>
                              </div>
                              <div class="form_row form_row_amenities">
                                  <div class="form_label"> Amenities </div>
                                  <div class="form_inputs"> <label class="form_input form_checkbox">
                                          <input type="checkbox" name="room_amenities1" value="Y">
                                          En-suite <span class="form_hint">(tick if room has own toilet
                                              and/or bath/shower)</span> </label>
                                  </div>
                              </div>
                              <div class="form_row form_row_amenities">
                                  <div class="form_label"> Furnishings </div>
                                  <div class="form_inputs"> <label class="form_input form_radio"> <input type="radio"
                                              name="room_furnishings1" value=1> Furnished
                                      </label> <label class="form_input form_radio"> <input type="radio"
                                              name="room_furnishings1" value=2>
                                          Unfurnished </label> </div>
                              </div>
                              <div class="form_row form_row_deposit ">
                                  <div class="form_label"> Security deposit </div>
                                  <div class="form_inputs"> <span class="form_input form_text"> <span
                                              class="form_currency_symbol">£</span> <input type="number"
                                              name="room_security_deposit1" value="" step="any"
                                              min="0"> </span>
                                  </div>
                              </div>
                              <div class="form_row form_row_avail_from" id="room_available_from1_container">
                                  <div class="form_label"> Available from </div>
                                  <div class="form_inputs">
                                      <input type="date" name="room_available_from1" id="room_available_from1">
                                  </div>
                              </div>

                          </fieldset>

                          <fieldset class="form_room_fieldset" id="room2" style="display: none;">

                              <legend> Room 2 </legend>

                              <input type="hidden" name="service_charge_room2" id="service_charge_room2">

                              <div class="form_row form_row_cost ">
                                  <div class="form_label"> Cost of room </div>
                                  <div class="form_inputs">
                                      <span class="form_input form_text">
                                          <span class="form_currency_symbol">£</span>
                                          <input type="number" name="room_cost_of_amount2" value=""
                                              size="6" step="any">
                                      </span>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_cost_time2" value=1>
                                          per week
                                      </label>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_cost_time2" value=2>
                                          per calendar month
                                      </label>

                                  </div>
                              </div>

                              <div class="form_row form_row_room_size">
                                  <div class="form_label"> Size of room </div>
                                  <div class="form_inputs">
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_size2" value=1>
                                          Single
                                      </label>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_size2" value=2>
                                          Double
                                      </label>
                                      <label class="form_input form_radio"> <input type="radio" name="room_size2"
                                              value=3> Semi-double </label>
                                  </div>
                              </div>

                              <div class="form_row form_row_amenities">
                                  <div class="form_label"> Amenities </div>
                                  <div class="form_inputs">
                                      <label class="form_input form_checkbox">
                                          <input type="checkbox" name="room_amenities2" value="Y">
                                          En-suite
                                          <span class="form_hint">(tick if room has own toilet and/or
                                              bath/shower)</span>
                                      </label>
                                  </div>
                              </div>

                              <div class="form_row form_row_amenities">
                                  <div class="form_label"> Furnishings </div>
                                  <div class="form_inputs">
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_furnishings2" value=1>
                                          Furnished
                                      </label>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_furnishings2" value=2>
                                          Unfurnished
                                      </label>
                                  </div>
                              </div>


                              <div class="form_row form_row_deposit ">
                                  <div class="form_label"> Security deposit </div>
                                  <div class="form_inputs">
                                      <span class="form_input form_text">
                                          <span class="form_currency_symbol">£</span> <input type="number"
                                              name="room_security_deposit2" value="" step="any"
                                              min="0">
                                          {{-- <a class="offered-ad__deposit-limit-link">Check deposit limits</a> --}}
                                      </span>
                                  </div>
                              </div>
                              <div class="form_row form_row_avail_from ">
                                  <div class="form_label"> Available from </div>
                                  <div class="form_inputs">
                                      <input type="date" name="room_available_from2" id="room_available_from2">
                                  </div>
                              </div>

                          </fieldset>


                          <fieldset class="form_room_fieldset" id="room3" style="display: none;">

                              <legend> Room 3 </legend>

                              <input type="hidden" name="service_charge_room3" id="service_charge_room3">
                              <div class="form_row form_row_cost ">
                                  <div class="form_label"> Cost of room </div>
                                  <div class="form_inputs">
                                      <span class="form_input form_text">
                                          <span class="form_currency_symbol">£</span>
                                          <input type="number" name="room_cost_of_amount3" value=""
                                              size="6" step="any">
                                      </span>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_cost_time3" value=1>
                                          per week
                                      </label>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_cost_time3" value=2>
                                          per calendar month
                                      </label>

                                  </div>
                              </div>

                              <div class="form_row form_row_room_size">
                                  <div class="form_label"> Size of room </div>
                                  <div class="form_inputs">
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_size3" value=1>
                                          Single
                                      </label>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_size3" value=2>
                                          Double
                                      </label>
                                      <label class="form_input form_radio"> <input type="radio" name="room_size3"
                                              value=3> Semi-double </label>
                                  </div>
                              </div>

                              <div class="form_row form_row_amenities">
                                  <div class="form_label"> Amenities </div>
                                  <div class="form_inputs">
                                      <label class="form_input form_checkbox">
                                          <input type="checkbox" name="room_amenities3" value="Y">
                                          En-suite
                                          <span class="form_hint">(tick if room has own toilet and/or
                                              bath/shower)</span>
                                      </label>
                                  </div>
                              </div>

                              <div class="form_row form_row_amenities">
                                  <div class="form_label"> Furnishings </div>
                                  <div class="form_inputs">
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_furnishings3" value=1>
                                          Furnished
                                      </label>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_furnishings3" value=2>
                                          Unfurnished
                                      </label>
                                  </div>
                              </div>


                              <div class="form_row form_row_deposit ">
                                  <div class="form_label"> Security deposit </div>
                                  <div class="form_inputs">
                                      <span class="form_input form_text">
                                          <span class="form_currency_symbol">£</span> <input type="number"
                                              name="room_security_deposit3" value="" step="any"
                                              min="0">
                                          {{-- <a class="offered-ad__deposit-limit-link">Check deposit limits</a> --}}
                                      </span>
                                  </div>
                              </div>
                              <div class="form_row form_row_avail_from ">
                                  <div class="form_label"> Available from </div>
                                  <div class="form_inputs">
                                      <input type="date" name="room_available_from3" id="room_available_from3">
                                  </div>
                              </div>

                          </fieldset>
                          <fieldset class="form_room_fieldset" id="room4" style="display: none;">

                              <legend> Room 4 </legend>

                              <input type="hidden" name="service_charge_room4" id="service_charge_room4">
                              <div class="form_row form_row_cost ">
                                  <div class="form_label"> Cost of room </div>
                                  <div class="form_inputs">
                                      <span class="form_input form_text">
                                          <span class="form_currency_symbol">£</span>
                                          <input type="number" name="room_cost_of_amount3" value=""
                                              size="6" step="any">
                                      </span>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_cost_time4" value=1>
                                          per week
                                      </label>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_cost_time4" value=2>
                                          per calendar month
                                      </label>

                                  </div>
                              </div>

                              <div class="form_row form_row_room_size">
                                  <div class="form_label"> Size of room </div>
                                  <div class="form_inputs">
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_size4" value=1>
                                          Single
                                      </label>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_size4" value=2>
                                          Double
                                      </label>
                                      <label class="form_input form_radio"> <input type="radio" name="room_size4"
                                              value=3> Semi-double </label>
                                  </div>
                              </div>

                              <div class="form_row form_row_amenities">
                                  <div class="form_label"> Amenities </div>
                                  <div class="form_inputs">
                                      <label class="form_input form_checkbox">
                                          <input type="checkbox" name="room_amenities4" value="Y">
                                          En-suite
                                          <span class="form_hint">(tick if room has own toilet and/or
                                              bath/shower)</span>
                                      </label>
                                  </div>
                              </div>

                              <div class="form_row form_row_amenities">
                                  <div class="form_label"> Furnishings </div>
                                  <div class="form_inputs">
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_furnishings4" value=1>
                                          Furnished
                                      </label>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_furnishings4" value=2>
                                          Unfurnished
                                      </label>
                                  </div>
                              </div>


                              <div class="form_row form_row_deposit ">
                                  <div class="form_label"> Security deposit </div>
                                  <div class="form_inputs">
                                      <span class="form_input form_text">
                                          <span class="form_currency_symbol">£</span> <input type="number"
                                              name="room_security_deposit4" value="" step="any"
                                              min="0">
                                          {{-- <a class="offered-ad__deposit-limit-link">Check deposit limits</a> --}}
                                      </span>
                                  </div>
                              </div>
                              <div class="form_row form_row_avail_from ">
                                  <div class="form_label"> Available from </div>
                                  <div class="form_inputs">
                                      <input type="date" name="room_available_from4" id="room_available_from4">
                                  </div>
                              </div>

                          </fieldset>
                          <fieldset class="form_room_fieldset" id="room5" style="display: none;">

                              <legend> Room 5 </legend>

                              <input type="hidden" name="service_charge_room5" id="service_charge_room5">
                              <div class="form_row form_row_cost ">
                                  <div class="form_label"> Cost of room </div>
                                  <div class="form_inputs">
                                      <span class="form_input form_text">
                                          <span class="form_currency_symbol">£</span>
                                          <input type="number" name="room_cost_of_amount3" value=""
                                              size="6" step="any">
                                      </span>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_cost_time5" value=1>
                                          per week
                                      </label>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_cost_time5" value=2>
                                          per calendar month
                                      </label>

                                  </div>
                              </div>

                              <div class="form_row form_row_room_size">
                                  <div class="form_label"> Size of room </div>
                                  <div class="form_inputs">
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_size5" value=1>
                                          Single
                                      </label>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_size5" value=2>
                                          Double
                                      </label>
                                      <label class="form_input form_radio"> <input type="radio" name="room_size5"
                                              value=3> Semi-double </label>
                                  </div>
                              </div>

                              <div class="form_row form_row_amenities">
                                  <div class="form_label"> Amenities </div>
                                  <div class="form_inputs">
                                      <label class="form_input form_checkbox">
                                          <input type="checkbox" name="room_amenities5" value="Y">
                                          En-suite
                                          <span class="form_hint">(tick if room has own toilet and/or
                                              bath/shower)</span>
                                      </label>
                                  </div>
                              </div>

                              <div class="form_row form_row_amenities">
                                  <div class="form_label"> Furnishings </div>
                                  <div class="form_inputs">
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_furnishings5" value=1>
                                          Furnished
                                      </label>
                                      <label class="form_input form_radio">
                                          <input type="radio" name="room_furnishings5" value=2>
                                          Unfurnished
                                      </label>
                                  </div>
                              </div>


                              <div class="form_row form_row_deposit ">
                                  <div class="form_label"> Security deposit </div>
                                  <div class="form_inputs">
                                      <span class="form_input form_text">
                                          <span class="form_currency_symbol">£</span> <input type="number"
                                              name="room_security_deposit5" value="" step="any"
                                              min="0">
                                          {{-- <a class="offered-ad__deposit-limit-link">Check deposit limits</a> --}}
                                      </span>
                                  </div>
                              </div>
                              <div class="form_row form_row_avail_from ">
                                  <div class="form_label"> Available from </div>
                                  <div class="form_inputs">
                                      <input type="date" name="room_available_from5" id="room_available_from5">
                                  </div>
                              </div>
                          </fieldset>


                          <div class="form_row form_row_avail_from" id="room_available_from_container">
                              <div class="form_label"> Available from </div>
                              <div class="form_inputs">
                                  <input type="date" name="room_available_from" id="room_available_from">
                              </div>
                          </div>

                          <div class="form_row form_row_min_term">
                              <div class="form_label"> Minimum stay </div>
                              <div class="form_inputs">
                                  <span class="form_input form_select">
                                      <select name="room_min_stay">
                                          <option value="0" selected="">No minimum</option>
                                          <option value="1">1 month</option>
                                          <option value="2">2 months</option>
                                          <option value="5">5 months</option>
                                      </select>
                                  </span>
                              </div>
                          </div>

                          <div class="form_row form_row_max_term">
                              <div class="form_label"> Maximum stay </div>
                              <div class="form_inputs">
                                  <span class="form_input form_select">
                                      <select name="room_max_stay">
                                          <option value="0" selected="">No maximum</option>
                                          <option value="1">1 month</option>
                                          <option value="2">2 months</option>
                                          <option value="3">3 months</option>
                                      </select>
                                  </span>
                              </div>
                          </div>

                          <div class="form_row form_row_short_term">
                              <div class="form_label">
                                  Short term lets considered?
                                  <div class="form_hint">
                                      (i.e. 1 week to 3 months)
                                  </div>
                              </div>
                              <div class="form_inputs">
                                  <label class="form_input form_checkbox">
                                      <input type="checkbox" name="room_short_term_let_consider" value="Y">
                                      Tick for yes
                                  </label>
                                  <span class="form_hint">
                                      *Please specify any rent adjustments in your advert description
                                      (step
                                      5).
                                  </span>
                              </div>
                          </div>

                          <div class="form_row form_row_days_avail">
                              <div class="form_label">
                                  Days available
                              </div>
                              <div class="form_inputs">
                                  <span class="form_input form_select">
                                      <select name="room_days_available" id="days_of_wk_available">
                                          <option value="7 days a week" selected="">7 days a week
                                          </option>
                                          <option value="Mon to Fri only">Mon to Fri only</option>
                                          <option value="Weekends only">Weekends only</option>
                                      </select>
                                  </span>
                              </div>
                          </div>

                          <div class="form_row form_row_ref_req">
                              <div class="form_label">
                                  References required?
                              </div>
                              <div class="form_inputs">
                                  <label class="form_input form_radio">
                                      <input type="radio" name="room_reference" value=1> yes
                                  </label>
                                  <label class="form_input form_radio">
                                      <input type="radio" name="room_reference" checked="" value=2>
                                      no
                                  </label>
                              </div>
                          </div>


                          <div class="form_row form_row_bills_inc">
                              <div class="form_label">
                                  Bills included
                              </div>
                              <div class="form_inputs">
                                  <label class="form_input form_radio">
                                      <input type="radio" name="room_bills" value=1> Yes
                                  </label>
                                  <label class="form_input form_radio">
                                      <input type="radio" name="room_bills" value=2> No
                                  </label>
                                  <label class="form_input form_radio">
                                      <input type="radio" name="room_bills" value=3> Some
                                  </label>
                              </div>
                          </div>

                          <div class="form_row form_row_broadband">
                              <div class="form_label">
                                  Broadband included?
                              </div>
                              <div class="form_inputs">
                                  <label class="form_input form_radio">
                                      <input type="radio" name="room_broadband" value=1> Yes
                                  </label>
                                  <label class="form_input form_radio">
                                      <input type="radio" name="room_broadband" value=2> No
                                  </label>
                              </div>
                          </div>




                          {{-- <div class="form_row ">
                    <div class="form_label"></div>
                    <div class="form_inputs">
                        <div class="btn-wrapper">
                            <div>
                                <button class="button" type="submit" name="validate_step"
                                    value="Continue to next step">Continue to next step
                                </button>
                            </div>
                            <div class="btn-wrapper__back-btn">
                                <input class="button button--link" id="backButton" type="submit"
                                    name="prev_step" value="Back">
                            </div>
                        </div>
                    </div>
                </div> --}}

                      </fieldset>

                  </div>
              </div>
          </div>
      </div>
      <!-- End Step 3 -->

      <div class="next-prev-btn-container">
          <button type="button" class="btn btn-primary prev-btn">Previous</button>
          <button type="button" class="btn btn-primary next-btn" id="step_3_next_btn">Next</button>
      </div>
  </div>
