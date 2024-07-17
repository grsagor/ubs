@extends('layouts.app')
@section('title', 'Edit Business Location Category')
@section('content')
    <section class="content-header">
        <h1>Edit Business Location Sub Category</h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">
                <h3 class="box-title">Edit sub category details</h3>
                <div class="box-tools">
                    <a href="{{ route('business_location_category_index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> Category List</a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('business_location_category_update', $sub_category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="category_type" value="business_location">
                    <input type="hidden" name="mode" value="business_location_sub_category_edit">

                    <div class="form-group">
                        <label for="category_id">Category <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="category_id" required>
                            <option value="">Select</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id', $sub_category->parent_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Category name: <span class="text-danger">*</span></label>
                        <input class="form-control" required placeholder="Category name" name="name" type="text"
                            id="name" value="{{ old('name', $sub_category->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="short_code">Category Code:</label>
                        <input class="form-control" placeholder="Category Code" name="short_code" type="text"
                            id="short_code" value="{{ old('short_code', $sub_category->short_code) }}">
                        <p class="help-block">Category code is same as <b>HSN code</b></p>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" placeholder="Description" rows="3" name="description" cols="50"
                            id="description">{{ old('description', $sub_category->description) }}</textarea>
                    </div>

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
