@extends('layouts.app')
@section('title', 'Edit ' . $data->category_type . ' category')
@section('content')
    <section class="content-header">
        <h1>Edit {{ $data->category_type }} category</h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">
                <h3 class="box-title">Edit {{ $data->category_type }} category details</h3>
                <div class="box-tools">
                    <a href="{{ route('shop_news_category_index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> Category List</a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('shop_news_category_update', $data->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="category_type">Type <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="category_type" required>
                            <option value="" selected disabled>Select type</option>
                            <option value="news"
                                {{ old('category_type', $data->category_type) == 'news' ? 'selected' : '' }}>
                                News
                            </option>
                            <option value="marketing"
                                {{ old('category_type', $data->category_type) == 'marketing' ? 'selected' : '' }}>
                                Marketing
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Category name: <span class="text-danger">*</span></label>
                        <input class="form-control" required placeholder="Category name" name="name" type="text"
                            id="name" value="{{ old('name', $data->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="short_code">Code:</label>
                        <input class="form-control" placeholder="Category Code" name="short_code" type="text"
                            id="short_code" value="{{ old('short_code', $data->short_code) }}">
                        <p class="help-block">Code is same as <b>HSN code</b></p>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" placeholder="Description" rows="3" name="description" cols="50"
                            id="description">{{ old('description', $data->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status">
                            <option selected="" value="">Select Status</option>
                            @foreach (getStatus() as $status)
                                <option @selected($data->status == $status['value']) value="{{ $status['value'] }}">
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
