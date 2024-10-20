@extends('layouts.app')
@section('title', 'Edit Language')
@section('content')
    <section class="content-header">
        <h1>Edit language</h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">
                <h3 class="box-title">Edit language details</h3>
                <div class="box-tools">
                    <a href="{{ route('language.index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> List</a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('language.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Language name: <span class="text-danger">*</span></label>
                        <input class="form-control" required placeholder="Name of the language" name="name"
                            type="text" value="{{ old('name', $data->name) }}">
                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="short_code">Language Code:</label>
                        <input class="form-control" placeholder="Language Code" name="code" type="text"
                            value="{{ old('code', $data->code) }}">
                        <p class="help-block">Language code</b></p>
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
