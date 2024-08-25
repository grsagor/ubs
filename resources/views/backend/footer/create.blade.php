@extends('layouts.app')
@section('title', 'Advertise-Room')
@section('content')
    <section class="content-header">
        <h1>Footer
        </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">
            <div class="box-body">
                <form action="{{ route('footer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
@endsection

@section('javascript')
    @include('backend.footer.partial.js')
@endsection
