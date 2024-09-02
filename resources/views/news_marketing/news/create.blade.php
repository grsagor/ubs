@extends('layouts.app')
@section('title', 'News')
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
                            <input class="form-control" required="" placeholder="Title" name="title" type="text"
                                value="{{ old('title') }}">
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

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="define_this_item" style="display: block">Define this item in less than 250
                                characters
                                @show_tooltip(__('Clear details facilitate quick customer understanding and draw attention
                                effectively.')) <span class="text-danger">*</span>
                            </label>
                            <textarea name="define_this_item" required id="define_this_item" rows="4" maxlength="250"
                                style="width: 100%; box-sizing: border-box;"></textarea>
                            <div id="error_message_define_this_item" style="color: red; display: none;">
                                Characters limit exceeded! Maximum 250 characters allowed.
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">News Source Name <span class="text-danger">*</span></label>
                            <input class="form-control" required placeholder="Name of the source" name="source_name"
                                type="text" value="{{ old('source_name') }}">
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
                            <label class="form-label">News Source URL <span class="text-danger">*</span></label>
                            <input class="form-control" required placeholder="News Source URL" name="source_url"
                                type="url" value="{{ old('source_url') }}">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">News Video URL <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="News Video URL" name="video_url" type="url"
                                value="{{ old('video_url') }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Thumbnail:</label>
                            <input class="form-control" id="thumbnailInput" name="thumbnail" type="file"
                                accept="image/*" onchange="previewThumbnail(event)" required>
                            <div style="position: relative; display: inline-block;">
                                <img id="thumbnailPreview" src="#" alt="Thumbnail Preview"
                                    style="display:none; margin-top:10px; max-height:200px;">
                                {{-- <button type="button" onclick="removeThumbnail()"
                                    style="display:none; position: absolute; top: 0; right: 0; background: red; color: white; border: none;">X</button> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Gallery:</label>
                            <input class="form-control" id="galleryInput" name="images[]" type="file" multiple
                                accept="image/*" onchange="previewGallery(event)">
                        </div>
                        <div id="galleryPreview" style="display:flex; flex-wrap:wrap; gap:10px; margin-top:10px;"></div>
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

    <script>
        let galleryFiles = []; // Array to keep track of valid files for submission

        // Preview and remove for single thumbnail
        function previewThumbnail(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('thumbnailPreview');
                const removeButton = preview.nextElementSibling;
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
                removeButton.style.display = 'block';
            }
        }

        function removeThumbnail() {
            const preview = document.getElementById('thumbnailPreview');
            const removeButton = preview.nextElementSibling;
            preview.src = '#';
            preview.style.display = 'none';
            removeButton.style.display = 'none';
            document.getElementById('thumbnailInput').value = ''; // Clear the thumbnail input
        }

        // Preview and remove for multiple gallery images
        function previewGallery(event) {
            const galleryPreview = document.getElementById('galleryPreview');
            galleryPreview.innerHTML = ''; // Clear previous previews
            galleryFiles = Array.from(event.target.files); // Store selected files in the array

            galleryFiles.forEach((file, index) => {
                const imgContainer = document.createElement('div');
                imgContainer.style.position = 'relative';

                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.style.maxHeight = '100px';

                const removeBtn = document.createElement('button');
                removeBtn.textContent = 'X';
                removeBtn.style.position = 'absolute';
                removeBtn.style.top = '0';
                removeBtn.style.right = '0';
                removeBtn.style.background = 'red';
                removeBtn.style.color = 'white';
                removeBtn.style.border = 'none';

                removeBtn.onclick = function() {
                    imgContainer.remove(); // Remove the image container from the preview
                    galleryFiles[index] = null; // Mark the file as removed
                };

                imgContainer.appendChild(img);
                imgContainer.appendChild(removeBtn);
                galleryPreview.appendChild(imgContainer);
            });
        }

        // Ensure only non-deleted files are submitted
        document.querySelector('form').onsubmit = function(e) {
            const input = document.getElementById('galleryInput');
            const dataTransfer = new DataTransfer(); // Create a new DataTransfer object

            galleryFiles.forEach(file => {
                if (file !== null) {
                    dataTransfer.items.add(file); // Add only non-deleted files
                }
            });

            input.files = dataTransfer.files; // Update input with filtered files

            return true; // Continue with the form submission
        };
    </script>
@endsection
