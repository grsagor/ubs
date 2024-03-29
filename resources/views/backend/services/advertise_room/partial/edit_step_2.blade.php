  <!-- Step 2 -->
  <div class="step" id="step-2">

      <!-- Start Step 2 -->
      <div class="grid-12-4" style="display: flex; justify-content: center;">
          <div>
              <div class="block block_simple block_offered_listing">
                  <div class="block_header">
                      <h2> Step 2 of 6</h2>
                  </div>

                  <div class="block_content">
                      <div id="deposit_warning_popup"></div>

                      <fieldset>
                          <legend>More about the property</legend>

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="custom_field1">Postcode of property (e.g. SE15 8PD)</label>
                                  <input class="form-control" name="property_postcode" type="text"
                                      id="property_postcode">
                              </div>
                          </div>

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="custom_field1">Address of property</label>
                                  <input class="form-control" name="property_address" type="text"
                                      id="property_address">
                              </div>
                          </div>

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="selling_price_group_id">Area</label>
                                  <input class="form-control" name="property_area" type="text" id="property_area">
                              </div>
                          </div>

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="selling_price_group_id">Transport</label>
                                  <div style="display: flex; align-items: center;">
                                      <div>
                                          <select class="form-control" id="transport_minutes" name="transport_minutes">
                                              <option value="" selected="">Select...</option>
                                              @foreach (['0-5', '5-10', '10-15', '15-20'] as $key => $item)
                                                  <option value="{{ $item }}">
                                                      {{ $item }}
                                                  </option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <div style="margin: 0px 10px 0px 10px;">minutes</div>
                                      <div>
                                          <select class="form-control" id="transport_form" name="transport_form">
                                              <option value="" selected="">Select...</option>
                                              <option value="walk">walk</option>
                                              <option value="by tram">by tram</option>
                                          </select>
                                      </div>
                                      <div style="margin: 0px 10px 0px 10px;">from</div>
                                      <div style="flex-grow: 1;">
                                          <input class="form-control" name="transport_to" type="text"
                                              id="transport_to" style="margin-right: 10px;">
                                      </div>
                                  </div>
                              </div>
                          </div>




                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Living room?</label>
                                  <div id="living_room_option1">
                                      <input class="form-check-input" type="radio" name="living_room" value="1">
                                      <label>Yes, there is a shared living room</label>
                                  </div>
                                  <div id="living_room_option2">
                                      <input class="form-check-input" type="radio" name="living_room" value="3">
                                      <label>Yes, there is a living room</label>
                                  </div>
                                  <div id="living_room_option3">
                                      <input class="form-check-input" type="radio" name="living_room" value="2">
                                      <label>No</label>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-12">
                              @php
                                  $amenities = ['Parking', 'Garden/Roof terrace', 'Garage', 'Balcony/patio', 'Disabled access'];
                              @endphp
                              <div class="form-group">
                                  <label>Amenities</label>
                                  @foreach ($amenities as $amenity)
                                      <div>
                                          <input class="form-check-input" type="checkbox" name="property_amenities[]"
                                              value="{{ $amenity }}">
                                          <label>{{ $amenity }}</label>
                                      </div>
                                  @endforeach
                              </div>
                          </div>
                      </fieldset>
                  </div>
              </div>
          </div>
      </div>

      <!-- End Step 2 -->

      <div class="next-prev-btn-container">
          <button type="button" class="btn btn-primary prev-btn">Previous</button>
          <button id="step_2_next" type="button" class="btn btn-primary next-btn">Next</button>
      </div>

  </div>
