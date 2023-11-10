@for ($i = 0; $i < $num; $i++)
    <div class="col-sm-12" style="margin-bottom: 15px;">
        <label>Size of room-{{ $i + 1 }}</label>
        <div class="form_inputs">
            <label class="form_input form_radio"><input type="radio" class="room_details" name="room_details"
                    value=1 required>Single</label>
            <label class="form_input form_radio"><input type="radio" class="room_details" name="room_details"
                    value=2 >Double</label>
            <label class="form_input form_radio"><input type="radio" class="room_details" name="room_details"
                    value=6 >Semi-double </label>
            <label class="form_input form_radio"><input type="radio" class="room_details" name="room_details"
                    value=7 >En-suit</label>
        </div>
    </div>
@endfor
