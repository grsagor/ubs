@extends('layouts.app')
@section('title', 'Marketing-Category')
@section('content')
    <section class="content-header">
        <h1>News
            {{-- <small>Fill up what you want</small> --}}
        </h1>
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

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-control" name="shop_news_category_id" required>
                                <option value="" selected="selected">Select Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $news->shop_news_category_id ? 'selected' : '' }}>
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

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Thumbnail:</label>
                            <input class="form-control" name="thumbnail" type="file" id="thumbnail"
                                onchange="previewThumbnail(this)">
                            @if (isset($news->thumbnail) && !empty($news->thumbnail))
                                <img id="thumbnail-preview" src="{{ asset($news->thumbnail) }}" alt="Thumbnail Preview"
                                    style="max-width: 20%; margin-top: 20px;">
                            @else
                                <img id="thumbnail-preview" src="#" alt="Thumbnail Preview"
                                    style="display: none; max-width: 20%; margin-top: 20px;">
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Gallery:</label>
                            <input class="form-control" name="images[]" type="file" id="images" multiple
                                onchange="previewImages(this)">
                            <div id="image-preview-container" class="mt-2">
                                @if (isset($news->images) && !empty($news->images))
                                    @php
                                        $decodedImages = json_decode($news->images, true);
                                    @endphp

                                    @if ($decodedImages && is_array($decodedImages) && count($decodedImages) > 0)
                                        @foreach ($decodedImages as $image)
                                            <img src="{{ asset($image) }}" alt="Image Preview"
                                                style="max-width: 20%; margin-right: 10px;">
                                        @endforeach
                                    @endif
                                @endif
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        function previewThumbnail(input) {
            var preview = document.getElementById('thumbnail-preview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }


        function previewImages(input) {
            var container = document.getElementById('image-preview-container');
            container.innerHTML = ''; // Clear previous previews

            var files = input.files;

            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var image = document.createElement('img');
                    image.src = e.target.result;
                    image.alt = 'Image Preview';
                    image.style.maxWidth = '20%';
                    image.style.marginTop = '8px';
                    image.style.marginRight = '10px';
                    container.appendChild(image);
                };
                reader.readAsDataURL(files[i]);
            }
        }

        $(document).ready(function() {
            if ($("textarea#footer_details").length > 0) {
                tinymce.init({
                    selector: "textarea#footer_details",
                    height: 550,
                });
            }
        });
    </script>
@endsection
