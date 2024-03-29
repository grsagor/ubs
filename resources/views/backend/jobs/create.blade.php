@extends('layouts.app')
@section('title', 'Job')
@section('content')
    <section class="content-header">
        <h1>Job form </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">
                <h3 class="box-title">Fill Job details </h3>
                <div class="box-tools">
                    <a href="{{ route('jobs.index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> List</a>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="title" required placeholder="Title"
                                value="{{ old('title') }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="selling_price_group_id">Category <span class="text-danger">*</span></label>
                            <select class="form-control" name="job_category_id" required>
                                <option value="">Select</option>
                                @foreach ($job_categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('job_category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Employee status <span class="text-danger">*</span></label>
                            <select class="form-control" name="hour_type" required>
                                <option value="" selected disabled>Select type</option>
                                <option value="Full time" {{ old('hour_type') == 'Full time' ? 'selected' : '' }}>Full time
                                </option>
                                <option value="Part time" {{ old('hour_type') == 'Part time' ? 'selected' : '' }}>Part time
                                </option>
                                <option value="Freelancing" {{ old('hour_type') == 'Freelancing' ? 'selected' : '' }}>
                                    Freelancing</option>
                                <option value="Contractual" {{ old('hour_type') == 'Contractual' ? 'selected' : '' }}>
                                    Contractual</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Job type <span class="text-danger">*</span></label>
                            <select class="form-control" name="job_type" required>
                                <option value="" selected disabled>Select type</option>
                                <option value="Permanent" {{ old('job_type') == 'Permanent' ? 'selected' : '' }}>Permanent
                                </option>
                                <option value="Temporary" {{ old('job_type') == 'Temporary' ? 'selected' : '' }}>
                                    Temporary</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Closing date <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="closing_date" required
                                value="{{ old('closing_date') }}">
                            @error('closing_date')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Company Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="company_name" required
                                placeholder="Name of company" value="{{ old('company_name') }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Salary </label>
                            <input class="form-control" type="number" step="0.01" name="salary" required
                                placeholder="Ex. 10000" value="{{ old('salary') }}" id="amountField">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Salary type <span class="text-danger">*</span></label>
                            <select class="form-control" name="salary_type" id="salary_type" required>
                                <option value="" selected disabled>Select type</option>
                                <option value="Hourly" {{ old('salary_type') == 'Hourly' ? 'selected' : '' }}>Hourly
                                </option>
                                <option value="Monthly" {{ old('salary_type') == 'Monthly' ? 'selected' : '' }}>Monthly
                                </option>
                                <option value="Negotiable" {{ old('salary_type') == 'Negotiable' ? 'selected' : '' }}>
                                    Negotiable
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Job location <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="location" required placeholder="Location"
                                value="{{ old('location') }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="selling_price_group_id">Business location <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" name="business_location_id">
                                <option value="">Select</option>
                                @foreach ($business_locations as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('business_location_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option selected="" value="">Select Status</option>
                                @foreach (getStatus() as $status)
                                    <option value="{{ $status['value'] }}"
                                        {{ $status['value'] == '1' ? 'selected' : '' }}>
                                        {{ $status['label'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Description <span class="text-danger">*</span></label>
                            <p class="sub-heading">(No contact details permitted within description)</p>
                            <textarea rows="5" type="text" class="form-control" name="description" id="footer_details"
                                class="input-field" placeholder="Description">{{ old('description') }}</textarea>

                            @error('description')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="custom_field1">Company Information <span class="text-danger">*</span></label>
                            <textarea rows="5" type="text" class="form-control" name="company_information" id="company-information"
                                class="input-field" placeholder="Company information">{{ old('company_information') }}</textarea>
                            @error('company_information')
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
            // Initial check on page load
            toggleAmountField();

            // Bind the change event on the salary_type dropdown
            $('#salary_type').change(function() {
                toggleAmountField();
            });

            function toggleAmountField() {
                var salaryType = $('#salary_type').val();
                var amountField = $('#amountField');

                // If salary type is Negotiable, make the amount field readonly
                if (salaryType === 'Negotiable') {
                    amountField.prop('readonly', true);
                    amountField.val(''); // Clear the value when readonly
                } else {
                    // Otherwise, remove the readonly attribute
                    amountField.prop('readonly', false);
                }
            }
        });


        $(document).ready(function() {
            if ($("textarea#footer_details").length > 0) {
                tinymce.init({
                    selector: "textarea#footer_details",
                    height: 450,
                });
            }

            if ($("textarea#company-information").length > 0) {
                tinymce.init({
                    selector: "textarea#company-information",
                    height: 350,
                });
            }
        });
    </script>
@endsection
