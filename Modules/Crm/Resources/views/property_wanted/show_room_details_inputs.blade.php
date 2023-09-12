@for ($i = 0; $i < $num; $i++)
    <div class="col-sm-12" style="margin-bottom: 15px;">
        <label>Size of room-{{ $i + 1 }}</label>
        <div class="form_inputs">
            <label class="form_input form_radio"><input type="radio" name="room_details[{{ $i }}]"
                    value=1>Single</label>
            <label class="form_input form_radio"><input type="radio" name="room_details[{{ $i }}]"
                    value=2>Double</label>
            <label class="form_input form_radio"><input type="radio" name="room_details[{{ $i }}]"
                    value=3>Semi-double </label>
            <label class="form_input form_radio"><input type="radio" name="room_details[{{ $i }}]"
                    value=3>En-suit</label>
        </div>
    </div>
@endfor
