@extends('layouts.app')
@section('title', 'Special')
@section('content')
    <section class="content-header">
        <h1>Special </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">
                <h3 class="box-title">Fill special details </h3>
                <div class="box-tools">
                    <a href="{{ route('special.index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> List</a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('special.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="category">Type:<span class="text-danger">*</span></label>
                        <select class="form-control select2" name="type" required id="type">
                            <option value="" selected disabled>Select type</option>
                            <option value="news" {{ old('type') == 'news' ? 'selected' : '' }}>News
                            </option>
                            <option value="marketing" {{ old('type') == 'marketing' ? 'selected' : '' }}>
                                Marketing</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Special name: <span class="text-danger">*</span></label>
                        <input class="form-control" required placeholder="Special name" name="name" type="text"
                            value="{{ old('name') }}">
                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="short_code">Special Code:</label>
                        <input class="form-control" placeholder="Special Code" name="code" type="text"
                            value="{{ old('code') }}">
                        <p class="help-block">Special code </p>
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
