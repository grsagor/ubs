 <!-- Step 1 -->
 <div class="step" id="step-1">
     <!-- Start Step 1 -->
     <div class="grid-12">
         <div class="text-center">
             <h1>Advertise your room</h1>
         </div>
     </div>
     <div class="grid-12-4" style="display: flex; justify-content: center;">
         <div>
             <div class="block block_simple block_offered_listing">
                 <div class="block_header">
                     <h2> Step 1 of 6 </h2>
                 </div>

                 <div class="block_content">
                     <fieldset>
                         <legend> Get started with your free advert </legend>
                         {{-- <div class="col-sm-12">
                            <div class="form-group">
                                <label for="selling_price_group_id">Sub Categories</label>
                                <input type="text"  value="{{ $sub_category->name }}" >
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="sub_category_id">Sub Categories</label>
                                <select class="form-control" id="sub_category_id" name="sub_category_id">
                                    @foreach ($sub_category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                         <div class="col-sm-12">
                             <div class="form-group">
                                 <label for="selling_price_group_id">Category</label>
                                 <select class="form-control" id="child_category_id" name="child_category_id">
                                     <option value="">Select</option>
                                     @foreach ($child_categories as $item)
                                         <option value="{{ $item->id }}">{{ $item->name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>

                         <div class="col-sm-12 room_size_container" style="display: none;">
                             <div class="form-group">
                                 <label for="room_size">Room size</label>
                                 <select class="form-control" id="room_size" name="room_size">

                                 </select>
                             </div>
                         </div>

                         <div class="col-sm-12" id="showroom">
                             <div class="form-group">
                                 <label for="selling_price_group_id">I have</label>
                                 <select class="form-control" id="property_room_quantity" name="property_room_quantity">
                                     <option value="">--Select-- </option>
                                     @foreach (['1 Room for Rent', '2 Rooms for Rent', '3 Rooms for Rent', '4 Rooms for Rent', '5 Rooms for Rent'] as $key => $item)
                                         <option value="{{ $key + 1 }}">{{ $item }}
                                         </option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="form-group" id="badOption">
                                 <div class="row">
                                     <div class="col-sm-6">
                                         <label for="selling_price_group_id">Size of property</label>
                                         (Total rooms in your property)
                                         <select class="form-control" id="property_size" name="property_size">
                                             @foreach (['1 Bed Room', '2 Bed Rooms', '3 Bed Rooms', '4 Bed Rooms', '5+ Bed Rooms'] as $key => $item)
                                                 <option value="{{ $key + 1 }}">{{ $item }}
                                                 </option>
                                             @endforeach
                                         </select>
                                     </div>

                                     <div class="col-sm-6">
                                         <label for="selling_price_group_id">Type of property </label>
                                         (Your property house/flat)
                                         <select class="form-control" id="property_type" name="property_type">
                                             @foreach (['Flat', 'House'] as $key => $item)
                                                 <option value="{{ $item }}">{{ $item }}
                                                 </option>
                                             @endforeach
                                         </select>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div class="col-sm-12">
                             <label for="selling_price_group_id">Bathrooms</label>
                             <select class="form-control" id="bathroom" name="bathroom">
                                 @foreach (range(0, 10) as $item)
                                     <option value="{{ $item }}" {{ $item === 1 ? 'selected' : '' }}>
                                         {{ $item }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div class="col-sm-12" style="margin-top: 15px">
                             <div class="form-group">
                                 <label for="selling_price_group_id">There are already</label>
                                 <select class="form-control" id="property_occupants" name="property_occupants">
                                     @foreach (range(0, 10) as $item)
                                         <option value="{{ $item }}" {{ $item === 1 ? 'selected' : '' }}>
                                             {{ $item }}
                                         </option>
                                     @endforeach
                                 </select>occupants in the property
                             </div>
                         </div>

                         <div class="col-sm-12">
                             <div class="form-group">
                                 <label for="selling_price_group_id">No. of people allowed <span
                                         class="text-danger">*</span></label>
                                 <select class="form-control" id="property_allow_people" name="property_allow_people">
                                     @foreach (range(0, 10) as $item)
                                         <option value="{{ $item }}" {{ $item === 1 ? 'selected' : '' }}>
                                             {{ $item }}
                                         </option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>

                         <div class="col-sm-12">
                             @php
                                 $propert_user_title = [
                                     'Live in landlord' => 'I own the property and live there',
                                     'Live out landlord' => 'I own the property but don\'t live there',
                                     'Current tenant/flatmate' => 'I am living in the property',
                                     'Agent' => 'I am advertising on a landlord\'s behalf',
                                     'Former flatmate' => 'I am moving out and need someone to replace me',
                                 ];
                             @endphp
                             <div class="form-group">
                                 <label>I am a</label>
                                 @foreach ($propert_user_title as $label => $hint)
                                     <div>
                                         <input class="form-check-input" type="radio" name="property_user_title"
                                             value="{{ $label }}">
                                         <label for="justme">{{ $label }} <span
                                                 class="form_hint">({{ $hint }})</span></label>
                                     </div>
                                 @endforeach
                             </div>
                         </div>

                         <div class="col-sm-12">
                             <div class="form-group">
                                 <label for="custom_field1">My email address is<span class="star">*</span></label>
                                 <input class="form-control" name="property_email_address" type="text"
                                     id="property_email_address">
                                 <div class="form_hint">
                                     (We'll keep this safe and not display it publicly)
                                 </div>
                             </div>
                         </div>

                     </fieldset>
                 </div>

             </div>
         </div>
     </div>
     <!-- End Step 1 -->
     <button type="button" class="btn btn-primary next-btn" style="display: block; margin: auto;">Next</button>
 </div>
