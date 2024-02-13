@extends('layouts.app')
@section('title', 'News')
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
                <form action="{{ route('shop-news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-control" name="shop_news_category_id" required>
                                <option value="" selected="selected">Select Category</option>
                                @foreach ($newCategory as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Thumbnail:</label>
                            <input class="form-control" name="thumbnail" type="file" id="thumbnail"
                                onchange="previewThumbnail(this)">
                            <img id="thumbnail-preview" src="#" alt="Thumbnail Preview"
                                style="display: none; max-width: 20%; margin-top: 20px;">
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Gallery:</label>
                            <input class="form-control" name="images[]" type="file" id="images" multiple
                                onchange="previewImages(this)">
                            <div id="image-preview-container" class="mt-2"></div>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option selected="" value="">Select Status</option>
                                @foreach (getStatus() as $status)
                                    <option value="{{ $status['value'] }}" {{ $status['value'] == '1' ? 'selected' : '' }}>
                                        {{ $status['label'] }}
                                    </option>
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
            var preview = $('#thumbnail-preview')[0];
            var file = input.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }


        function previewImages(input) {
            var previewContainer = $('#image-preview-container');

            previewContainer.empty(); // Clear previous previews

            var files = input.files;

            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail').css('max-width',
                        '100%');
                    previewContainer.append(img);
                };

                reader.readAsDataURL(file);
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
