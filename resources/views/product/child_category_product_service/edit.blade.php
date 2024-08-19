@extends('layouts.app')
@section('title', 'Edit ' . $child_category->category_type . ' Child Category')
@section('content')
    <section class="content-header">
        <h1>Edit {{ $child_category->category_type }} Child Category</h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">
                <h3 class="box-title">Edit {{ $child_category->category_type }} Child Category Details</h3>
                <div class="box-tools">
                    <a href="{{ route('product_service_category_index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> Category List
                    </a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('product_service_category_update', $child_category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Category Type -->
                    <div class="form-group">
                        <label for="category_type">Type <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="category_type" required id="type">
                            <option value="" selected disabled>Select Type</option>
                            <option value="product"
                                {{ old('category_type', $child_category->category_type) == 'product' ? 'selected' : '' }}>
                                Product</option>
                            <option value="service"
                                {{ old('category_type', $child_category->category_type) == 'service' ? 'selected' : '' }}>
                                Service</option>
                        </select>
                    </div>

                    <!-- Parent Category -->
                    <div class="form-group">
                        <label for="category_id">Parent Category <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="" required id="category_id">
                            <option value="" selected disabled>Select Parent Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id', $select_category->id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sub Category -->
                    <div class="form-group">
                        <label for="sub_category_id">Sub Category <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="category_id" required id="sub_category_id">
                            <option value="" selected disabled>Select Sub Category</option>
                            @foreach ($sub_categories as $sub_cat)
                                <option value="{{ $sub_cat->id }}"
                                    {{ old('sub_category_id', $select_sub_categories->id) == $sub_cat->id ? 'selected' : '' }}>
                                    {{ $sub_cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Child Category Name -->
                    <div class="form-group">
                        <label for="name">Child Category Name: <span class="text-danger">*</span></label>
                        <input class="form-control" required placeholder="Category name" name="name" type="text"
                            id="name" value="{{ old('name', $child_category->name) }}">
                    </div>

                    <!-- Child Category Code -->
                    <div class="form-group">
                        <label for="short_code">Category Code:</label>
                        <input class="form-control" placeholder="Category Code" name="short_code" type="text"
                            id="short_code" value="{{ old('short_code', $child_category->short_code) }}">
                        <p class="help-block">Category code is same as <b>HSN code</b></p>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" placeholder="Description" rows="3" name="description" cols="50"
                            id="description">{{ old('description', $child_category->description) }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script>
        // When type changes, reload parent categories
        $(document).on('change', '#type', function() {
            var type = $(this).val();
            $.ajax({
                url: "{{ route('product.type.change') }}",
                type: "GET",
                data: {
                    type: type
                },
                dataType: "html",
                success: function(html) {
                    $('#category_id').html(html);
                    $('#sub_category_id').html(
                        '<option selected="selected" value="">Please Select</option>');
                }
            });
        });

        // When parent category changes, reload sub-categories
        $(document).on('change', '#category_id', function() {
            var category_id = $(this).val();
            $.ajax({
                url: "{{ route('product.category_id.change') }}",
                type: "GET",
                data: {
                    category_id: category_id
                },
                dataType: "html",
                success: function(html) {
                    $('#sub_category_id').html(html);
                }
            });
        });
    </script>
@endsection
