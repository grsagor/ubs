@extends('layouts.app')
@section('title', 'Marketing-Category')
@section('content')
    <section class="content-header">
        <h1>Marketing Category
            {{-- <small>Fill up what you want</small> --}}
        </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">

                <h3 class="box-title">All your marketing category</h3>
                <div class="box-tools">
                    <a href="{{ route('shop-marketing-category.index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> List</a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('shop-marketing-category.update', $marketingCategory->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf @method('put')

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input class="form-control" required="" placeholder="Category name" name="name"
                                type="text" id="name" value="{{ $marketingCategory->name }}">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Description</label>
                            <p class="sub-heading">(No contact details permitted within description)</p>
                            <textarea rows="5" type="text" class="form-control" name="description" class="input-field"
                                placeholder="Description">{{ $marketingCategory->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option selected="" value="">Select Status</option>
                                @foreach (getStatus() as $status)
                                    <option @selected($marketingCategory->status == $status['value']) value="{{ $status['value'] }}">
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

@endsection
