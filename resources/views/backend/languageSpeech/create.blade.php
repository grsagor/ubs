@extends('layouts.app')
@section('title', 'Language')
@section('content')
    <section class="content-header">
        <h1>Language </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">
                <h3 class="box-title">Fill language details </h3>
                <div class="box-tools">
                    <a href="{{ route('language.index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> List</a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('language.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Language name: <span class="text-danger">*</span></label>
                        <input class="form-control" required placeholder="Name of the language" name="name"
                            type="text" value="{{ old('name') }}">
                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="short_code">Language Code:</label>
                        <input class="form-control" placeholder="Language Code" name="code" type="text"
                            value="{{ old('code') }}">
                        <p class="help-block">Language code </p>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" placeholder="Description" rows="3" name="description" cols="50"
                            id="description">{{ old('description') }}</textarea>
                    </div>

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

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
