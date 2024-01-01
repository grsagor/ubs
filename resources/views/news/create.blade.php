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
                        <i class="fa fa-plus"></i> List</a>

                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('shop-news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="price_calculation_type">Category</label>
                            <select class="form-control" id="price_calculation_type" name="price_calculation_type">
                                <option value="percentage" selected="selected">Percentage</option>
                                <option value="selling_price_group">Selling Price Group</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Title:*</label>
                            <input class="form-control" required="" placeholder="Customer Group Name" name="name"
                                type="text" id="name">
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
                            <label for="name">Thumbnail:</label>
                            <input class="form-control" required="" placeholder="Customer Group Name" name="name"
                                type="file" id="name">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Galary:</label>
                            <input class="form-control" required="" placeholder="Customer Group Name" name="name"
                                type="file" id="name">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="price_calculation_type">Status</label>
                            <select class="form-control" id="price_calculation_type" name="price_calculation_type">
                                <option value="percentage" selected="selected">Percentage</option>
                                <option value="selling_price_group">Selling Price Group</option>
                            </select>
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
