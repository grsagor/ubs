@extends('layouts.app')
@section('title', 'Marketing-Category')
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
                <form action="{{ route('shop-news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('put')

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="category">Category Name:<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="category_id" id="category_id"
                                onchange="categoryChanged()" required>
                                <option value="">Select</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ (old('category_id') ?? ($news->category_id ?? '')) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="subcategory">Subcategory Name: <span class="text-danger"
                                    id="subcategory_required_asterisk" style="display: none;">*</span></label>
                            <select class="form-control select2" name="subcategory_id" id="subcategory_id">
                                <option value="">Select</option>
                                @foreach ($sub_categories as $sub)
                                    <option value="{{ $sub->id }}"
                                        {{ (old('subcategory_id') ?? ($news->subcategory_id ?? '')) == $sub->id ? 'selected' : '' }}>
                                        {{ $sub->name }}
                                    </option>
                                @endforeach
                                <!-- Subcategories will be populgated here -->
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
                                        {{ old('region_id', $news->region_id) == $region->id ? 'selected' : '' }}>
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
                                        {{ old('language_id', $news->language_id) == $lang->id ? 'selected' : '' }}>
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
                                        {{ old('special_id', $news->special_id) == $special->id ? 'selected' : '' }}>
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
                                        {{ old('business_location_id', $news->business_location_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input class="form-control" required="" placeholder="Title" name="title" type="text"
                                value="{{ $news->title }}">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Description</label>
                            <p class="sub-heading">(No contact details permitted within description)</p>
                            <textarea rows="5" type="text" class="form-control" name="description" id="footer_details" class="input-field"
                                placeholder="Description">{!! $news->description ?? '' !!}</textarea>
                            <span class="error text-danger" id="footer_details-error--property_wanted_create"></span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Source Name <span class="text-danger">*</span></label>
                            <input class="form-control" required placeholder="Name of the source" name="source_name"
                                type="text" value="{{ old('source_name', $news->source_name) }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option selected="" value="">Select Status</option>
                                @foreach (getStatus() as $status)
                                    <option @selected($news->status == $status['value']) value="{{ $status['value'] }}">
                                        {{ $status['label'] }}</option>
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
                                type="url" value="{{ old('source_url', $news->source_url) }}">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Video URL <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="Video URL" name="video_url" type="url"
                                value="{{ old('video_url', $news->video_url) }}">
                        </div>
                    </div>

                    @php
                        $news->images = json_decode($news->images);
                    @endphp

                    <!-- Stored Thumbnail (No Delete Option) -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Thumbnail:</label>
                            <input class="form-control" name="thumbnail" type="file" id="thumbnail"
                                onchange="previewThumbnail(event)">
                            <div style="position: relative; display: inline-block;  margin-top:10px;">
                                <img src="{{ asset($news->thumbnail) }}" alt="Current Thumbnail" id="currentThumbnail"
                                    style="max-height: 200px;">
                            </div>

                        </div>
                    </div>

                    <!-- Stored Gallery Images and New Image Upload -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Current Gallery:</label>
                            <input class="form-control" name="images[]" type="file" id="images" multiple
                                onchange="previewNewImages(event)">

                            <div id="storedGallery" style="display:flex; flex-wrap:wrap; gap:10px; margin-top: 10px;">
                                @foreach ($news->images as $image)
                                    <div class="image-container" style="position: relative; display: inline-block;"
                                        data-image="{{ $image }}">
                                        <img src="{{ asset($image) }}" alt="Gallery Image" style="max-height: 100px;">
                                        <button type="button"
                                            onclick="removeStoredGalleryImage(this, '{{ $image }}')"
                                            style="position: absolute; top: 0; right: 0; background: red; color: white; border: none;">X
                                        </button>
                                        <input type="hidden" name="stored_images[]" value="{{ $image }}">
                                    </div>
                                @endforeach
                            </div>
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

@section('javascript')

    @include('news_marketing.news.partial.js')

    <!-- JavaScript to Handle Previews and Deletion -->
    <script>
        let removedStoredGalleryImages = [];
        let newImages = [];

        // Preview for New Thumbnail
        function previewThumbnail(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('currentThumbnail');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        }

        // Remove Stored Gallery Image
        function removeStoredGalleryImage(button, image) {
            // Hide the image preview and its container
            const imageContainer = button.closest('.image-container');
            imageContainer.style.display = 'none';

            // Add the image to the list of removed images
            removedStoredGalleryImages.push(image);
        }

        // Preview for New Uploaded Images (with Delete Option)
        function previewNewImages(event) {
            const galleryContainer = document.getElementById('storedGallery');

            Array.from(event.target.files).forEach(file => {
                const imageContainer = document.createElement('div');
                imageContainer.style.position = 'relative';
                imageContainer.style.display = 'inline-block';

                const imgElement = document.createElement('img');
                imgElement.src = URL.createObjectURL(file);
                imgElement.style.maxHeight = '100px';
                imgElement.style.marginRight = '10px';

                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.style.position = 'absolute';
                deleteButton.style.top = '0';
                deleteButton.style.right = '0';
                deleteButton.style.background = 'red';
                deleteButton.style.color = 'white';
                deleteButton.style.border = 'none';
                deleteButton.textContent = 'X';

                // Add functionality to remove the previewed new image
                deleteButton.onclick = () => {
                    imageContainer.remove();
                    // Track the removed new image
                    newImages = newImages.filter(image => image !== file);
                };

                imageContainer.appendChild(imgElement);
                imageContainer.appendChild(deleteButton);
                galleryContainer.appendChild(imageContainer);

                // Track the new image file
                newImages.push(file);
            });
        }

        // Handle Form Submission
        document.querySelector('form').onsubmit = function(e) {
            // Append removed stored images to the form
            removedStoredGalleryImages.forEach(image => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'removed_images[]';
                input.value = image;
                this.appendChild(input);
            });

            // Append new images to the form
            newImages.forEach(imageFile => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'new_images[]';
                    input.value = e.target.result; // base64 encoded data
                    document.querySelector('form').appendChild(input);
                };
                reader.readAsDataURL(imageFile);
            });

            return true; // Continue form submission
        };
    </script>

@endsection
