@extends('layouts.app')
@section('title', 'Advertise-Room')
@section('content')
    <section class="content-header">
        <h1>Footer Edit
            {{-- <small>Fill up what you want</small> --}}
        </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">
            <div class="box-body">
                <form action="{{ route('footer.update', $footer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{-- <label for="custom_field1">Title</label> --}}
                            <span class="text-success fw-bold">
                                <b>{{ $footer->category_name ?? '' }} →
                                    {{ ucwords(str_replace('-', ' ', $footer->slug)) }}
                                </b>
                            </span>

                        </div>
                    </div>
                    {{-- <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Name</label>
                            <span class="text-success fw-bold"><b>
                                    {{ ucwords(str_replace('-', ' ', $footer->slug)) }}</b></span>
                        </div>
                    </div> --}}

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Description</label>
                            <p class="sub-heading">(No contact details permitted within description)</p>
                            <textarea rows="5" type="text" class="form-control" name="description" id="footer_details" class="input-field"
                                placeholder="Description">{!! $footer->description ?? '' !!}</textarea>

                            @error('description')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Add Submit Button -->
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

@section('javascript')
    @include('backend.footer.partial.js')
@endsection
