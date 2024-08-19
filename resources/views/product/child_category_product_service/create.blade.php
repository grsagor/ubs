@extends('layouts.app')
@section('title', 'Child Categories of Product/Service')
@section('content')
    <section class="content-header">
        <h1>Child Categories of Product/Service </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">
                <h3 class="box-title">Fill category details </h3>
                <div class="box-tools">
                    <a href="{{ route('product_service_category_index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> Category List</a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('product_service_category_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="category">Type:<span class="text-danger">*</span></label>
                        <select class="form-control select2" name="category_type" required id="type">
                            <option value="" selected disabled>Select type</option>
                            <option value="product" {{ old('category_type') == 'product' ? 'selected' : '' }}>Product
                            </option>
                            <option value="service" {{ old('category_type') == 'service' ? 'selected' : '' }}>
                                Service</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="selling_price_group_id">Parent Category <span class="text-danger">*</span></label>
                        <select class="form-control select2" required id="category_id">
                            <option value="" selected disabled>Select type</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="selling_price_group_id">Sub Category <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="category_id" required id="sub_category_id">
                            <option value="" selected disabled>Select type</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Child Category name: <span class="text-danger">*</span></label>
                        <input class="form-control" required="" placeholder="Category name" name="name" type="text"
                            id="name">
                    </div>

                    <div class="form-group">
                        <label for="short_code">Child Category Code:</label>
                        <input class="form-control" placeholder="Category Code" name="short_code" type="text"
                            id="short_code">
                        <p class="help-block">Child category code is same as <b>HSN code</b></p>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" placeholder="Description" rows="3" name="description" cols="50"
                            id="description"></textarea>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script>
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
                    $('#sub_category_id').html(
                        '<option selected="selected" value="">Please Select</option>');
                }
            })
        })
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
            })
        });
    </script>
@endsection
