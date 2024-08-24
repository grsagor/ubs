@extends('layouts.app')
@section('title', 'Edit ' . $sub_category->category_type . ' sub category')
@section('content')
    <section class="content-header">
        <h1>Edit {{ $sub_category->category_type }} sub category</h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">
                <h3 class="box-title">Edit {{ $sub_category->category_type }} sub category details</h3>
                <div class="box-tools">
                    <a href="{{ route('product_service_category_index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> Category List</a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('product_service_category_update', $sub_category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- <div class="form-group">
                        <label for="category_type">Type <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="category_type" required id="type">
                            <option value="" selected disabled>Select type</option>
                            <option value="product"
                                {{ old('category_type', $sub_category->category_type) == 'product' ? 'selected' : '' }}>
                                Product
                            </option>
                            <option value="service"
                                {{ old('category_type', $sub_category->category_type) == 'service' ? 'selected' : '' }}>
                                Service
                            </option>
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label for="category_id">Parent Category <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="category_id" required id="category_id">
                            <option value="" selected disabled>Select type</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Sub Category name: <span class="text-danger">*</span></label>
                        <input class="form-control" required placeholder="Category name" name="name" type="text"
                            id="name" value="{{ old('name', $sub_category->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="short_code">Sub Category Code:</label>
                        <input class="form-control" placeholder="Category Code" name="short_code" type="text"
                            id="short_code" value="{{ old('short_code', $sub_category->short_code) }}">
                        <p class="help-block">Category code is same as <b>HSN code</b></p>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" placeholder="Description" rows="3" name="description" cols="50"
                            id="description">{{ old('description', $sub_category->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status">
                            <option selected="" value="">Select Status</option>
                            @foreach (getStatus() as $status)
                                <option @selected($sub_category->status == $status['value']) value="{{ $status['value'] }}">
                                    {{ $status['label'] }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection


@section('javascript')
    {{-- <script>
        $(document).on('change', '#type', function() {
            var type = $(this).val();
            console.log('Type id ' + type);

            $.ajax({
                url: "{{ route('product.type.change') }}",
                type: "GET",
                data: {
                    type: type
                },
                dataType: "html",
                success: function(html) {
                    console.log(html);
                    $('#category_id').html(html);
                }
            })
        })
    </script> --}}
@endsection
