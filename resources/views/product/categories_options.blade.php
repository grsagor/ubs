<option selected="selected" value="">Please Select</option>
@foreach ($categories as $item)
    <option value="{{ $item->id }}">{{ $item->name }}</option>
@endforeach
