<div class="row" id="room_type_tab_{{ $number_of_children }}">
    <div class="col-md-6" style="padding-right: 0;">
        <select class="form-control" onchange="roomSizeSelectChange('{{ $number_of_children }}')"
            style="background: white; height: auto;"
            id="child_category_id_room_tab_{{ $number_of_children }}" name="child_category[]">
            <option value="0">Select</option>
            @foreach ($room_size as $item)
                <option value="{{ $item->id }}">{{ $item->size }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4" style="padding-right: 0;">
        <select class="form-control" disabled onchange="quantitySelectChange()"
            style="background: white; height: auto;"
            id="quantity_tab_{{ $number_of_children }}" name="quantity[]">
            <option value="0">Qty</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <div class="col-md-2"> <button class="btn bg-danger btn_remove"
            type="button" data-no="{{ $number_of_children }}"
            style="padding: 6px; line-height: 0px; margin-top: -20px;">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button> </div>
</div>