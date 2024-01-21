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
            <div class="box-header">
                <h3 class="box-title">All your job</h3>
                <div class="box-tools">
                    <a href="{{ route('jobs.index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> List</a>
                </div>
            </div>
            <div class="box-body">
                <form action="{{ route('jobs.update', $job->uuid) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="title" required placeholder="Title"
                                value="{{ old('title', $job->title) }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Hours <span class="text-danger">*</span></label>
                            <select class="form-control" name="hour_type" required>
                                <option value="" selected="selected">Select type</option>
                                <option value="Full time"
                                    {{ old('hour_type', $job->hour_type) == 'Full time' ? 'selected' : '' }}>Full time
                                </option>
                                <option value="Part time"
                                    {{ old('hour_type', $job->hour_type) == 'Part time' ? 'selected' : '' }}>Part time
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Job type <span class="text-danger">*</span></label>
                            <select class="form-control" name="job_type" required>
                                <option value="" selected="selected">Select type</option>
                                <option value="Permanent"
                                    {{ old('job_type', $job->job_type) == 'Permanent' ? 'selected' : '' }}>Permanent
                                </option>
                                <option value="Contractual"
                                    {{ old('job_type', $job->job_type) == 'Contractual' ? 'selected' : '' }}>Contractual
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Closing date <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="closing_date" required
                                value="{{ old('closing_date', $job->closing_date) }}">

                            @error('closing_date')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Company Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="company_name" required
                                placeholder="Name of company" value="{{ old('company_name', $job->company_name) }}">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Location <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="location" required placeholder="Location"
                                value="{{ old('location', $job->location) }}">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Description <span class="text-danger">*</span></label>
                            <p class="sub-heading">(No contact details permitted within description)</p>
                            <textarea rows="5" type="text" class="form-control" name="description" id="footer_details" class="input-field"
                                placeholder="Description">{{ old('description', $job->description) }}</textarea>

                            @error('description')
                                <span class="error text-danger">{{ $message }}</span>
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
