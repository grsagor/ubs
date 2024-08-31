@extends('layouts.app')
@section('title', 'News')


@section('javascript')
    @include('news_marketing.news.partial.js')
@endsection
@section('content')
    <section class="content-header">
        <h1>News </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">

                <h3 class="box-title">All your news</h3>
                <div class="box-tools">
                    <a href="{{ route('shop-news.index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> List</a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('shop-news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="category">Category Name:<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="category_id" id="category_id"
                                onchange="categoryChanged()" required>
                                <option value="">Select</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="subcategory" id="subcategory_label">Subcategory Name: <span class="text-danger"
                                    id="subcategory_required_asterisk" style="display: none;">*</span></label>
                            <select class="form-control select2" name="subcategory_id" id="subcategory_id">
                                <option value="">Select</option>
                                <!-- Subcategories will be populated here -->
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="category">Region Name:<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="region_id" required>
                                <option value="">Select</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}"
                                        {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="category">Language Name:<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="language_id" required>
                                <option value="">Select</option>
                                @foreach ($languages as $lang)
                                    <option value="{{ $lang->id }}"
                                        {{ old('language_id') == $lang->id ? 'selected' : '' }}>
                                        {{ $lang->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="category">Sepcial Name:</label>
                            <select class="form-control select2" name="special_id">
                                <option value="">Select</option>
                                @foreach ($specials as $special)
                                    <option value="{{ $special->id }}"
                                        {{ old('special_id') == $special->id ? 'selected' : '' }}>
                                        {{ $special->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="selling_price_group_id">Shop location <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="business_location_id" required>
                                <option value="">Select</option>
                                @foreach ($business_locations as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('business_location_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input class="form-control" required="" placeholder="Title" name="title" type="text">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Description</label>
                            <p class="sub-heading">(No contact details permitted within description)</p>
                            <textarea rows="5" type="text" class="form-control" name="description" id="footer_details" class="input-field"
                                placeholder="Description"></textarea>
                            <span class="error text-danger" id="footer_details-error--property_wanted_create"></span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Source Name <span class="text-danger">*</span></label>
                            <input class="form-control" required placeholder="Name of the source" name="source_name"
                                type="text">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option selected="" value="">Select Status</option>
                                @foreach (getStatus() as $status)
                                    <option value="{{ $status['value'] }}"
                                        {{ $status['value'] == '1' ? 'selected' : '' }}>
                                        {{ $status['label'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Source URL <span class="text-danger">*</span></label>
                            <input class="form-control" required placeholder="Source URL" name="source_url"
                                type="url">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Video URL <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="Video URL" name="video_url" type="url">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Thumbnail:</label>
                            <input class="form-control upload-element" name="thumbnail" type="file"
                                id="thumbnail_image">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Gallery:</label>
                            <input class="form-control upload-element" name="images[]" type="file" id="galary_image"
                                multiple>
                        </div>
                    </div>

                    <!-- Add Submit Button -->
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
