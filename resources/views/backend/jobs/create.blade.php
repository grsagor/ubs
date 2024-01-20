@extends('layouts.app')
@section('title', 'Job')
@section('content')
    <section class="content-header">
        <h1>Job
            {{-- <small>Fill up what you want</small> --}}
        </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">
            <div class="box-body">
                <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" required="" name="title" placeholder="Title">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Job type <span class="text-danger">*</span></label>
                            <select class="form-control" name="shop_news_category_id" required>
                                <option value="" selected="selected">Select type</option>
                                <option value="">Select type</option>
                                <option value="Full time">Full time</option>
                                <option value="Part time">Part time</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Closing date <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="title">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Company Name <span class="text-danger">*</span></label>
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
