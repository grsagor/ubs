@extends('layouts.app')
@section('title', 'Edit Special')
@section('content')
    <section class="content-header">
        <h1>Edit special</h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">
                <h3 class="box-title">Edit special details</h3>
                <div class="box-tools">
                    <a href="{{ route('special.index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> List</a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('special.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="category_type">Type <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="type" required>
                            <option value="" selected disabled>Select type</option>
                            <option value="news" {{ old('type', $data->type) == 'news' ? 'selected' : '' }}>
                                News
                            </option>
                            <option value="marketing" {{ old('type', $data->type) == 'marketing' ? 'selected' : '' }}>
                                Marketing
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Special name: <span class="text-danger">*</span></label>
                        <input class="form-control" required placeholder="Name of the special" name="name" type="text"
                            value="{{ old('name', $data->name) }}">
                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="short_code">Special Code:</label>
                        <input class="form-control" placeholder="Special Code" name="code" type="text"
                            value="{{ old('code', $data->code) }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" placeholder="Description" rows="3" name="description" cols="50"
                            id="description">{{ old('description', $data->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status">
                            <option selected="" value="">Select Status</option>
                            @foreach (getStatus() as $status)
                                <option @selected($data->status == $status['value']) value="{{ $status['value'] }}">
                                    {{ $status['label'] }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
