@extends('layouts.app')
@section('title', 'Region')
@section('content')
    <section class="content-header">
        <h1>Region </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">
                <h3 class="box-title">Fill region details </h3>
                <div class="box-tools">
                    <a href="{{ route('region.index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> List</a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('region.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Region name: <span class="text-danger">*</span></label>
                        <input class="form-control" required="" placeholder="Name of the region" name="name"
                            type="text">

                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="short_code">Region Code:</label>
                        <input class="form-control" placeholder="Region Code" name="code" type="text">
                        <p class="help-block">Region code </p>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" placeholder="Description" rows="3" name="description" cols="50"
                            id="description"></textarea>
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
