@extends('layouts.app')
@section('title', 'Job-Edit')
@section('css')
    <style>
        .hidden {
            display: none;
        }
    </style>
@endsection
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
                <form action="{{ route('jobs.update', $job->uuid) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="title" required placeholder="Title"
                                    value="{{ old('title', $job->title) }}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="selling_price_group_id">Category <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="job_category_id" required>
                                    <option value="" disabled>Select</option>
                                    @foreach ($job_categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('job_category_id', $job->job_category_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Job type <span class="text-danger">*</span></label>
                                <select class="form-control select2" multiple name="job_type[]" required>
                                    <option value="" disabled>Select type</option>
                                    <option value="Permanent"
                                        {{ in_array('Permanent', old('job_type', $job->job_type ?? [])) ? 'selected' : '' }}>
                                        Permanent</option>
                                    <option value="Temporary"
                                        {{ in_array('Temporary', old('job_type', $job->job_type ?? [])) ? 'selected' : '' }}>
                                        Temporary</option>
                                </select>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Employee status <span class="text-danger">*</span></label>
                                <select class="form-control select2" multiple name="hour_type[]" required>
                                    <option value="" disabled>Select type</option>
                                    <option value="Full time"
                                        {{ in_array('Full time', old('hour_type', $job->hour_type ?? [])) ? 'selected' : '' }}>
                                        Full time</option>
                                    <option value="Part time"
                                        {{ in_array('Part time', old('hour_type', $job->hour_type ?? [])) ? 'selected' : '' }}>
                                        Part time</option>
                                    <option value="Freelancing"
                                        {{ in_array('Freelancing', old('hour_type', $job->hour_type ?? [])) ? 'selected' : '' }}>
                                        Freelancing</option>
                                    <option value="Contractual"
                                        {{ in_array('Contractual', old('hour_type', $job->hour_type ?? [])) ? 'selected' : '' }}>
                                        Contractual</option>
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
                        <div class="clearfix"></div>

                        {{-- Salary start --}}

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Salary <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="salary_variation" required>
                                    <option value="" selected="selected" disabled>Select type</option>
                                    <option value="Hourly"
                                        {{ old('salary_variation', $job->salary_variation) == 'Hourly' ? 'selected' : '' }}>
                                        Hourly
                                    </option>
                                    <option value="Monthly"
                                        {{ old('salary_variation', $job->salary_variation) == 'Monthly' ? 'selected' : '' }}>
                                        Monthly
                                    </option>
                                    <option value="Yearly"
                                        {{ old('salary_variation', $job->salary_variation) == 'Yearly' ? 'selected' : '' }}>
                                        Yearly
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Salary type <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="salary_type" id="salary_type" required>
                                    <option value="" selected="selected" disabled>Select type</option>
                                    <option value="Fixed"
                                        {{ old('salary_type', $job->salary_type) == 'Fixed' ? 'selected' : '' }}>Fixed
                                    </option>
                                    <option value="Negotiable"
                                        {{ old('salary_type', $job->salary_type) == 'Negotiable' ? 'selected' : '' }}>
                                        Negotiable
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6" id="fixed_amount_group" class="hidden">
                            <div class="form-group">
                                <label class="form-label">Salary <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" step="0.01" name="fixed_salary"
                                    placeholder="Ex. 10000" value="{{ old('fixed_salary', $job->fixed_salary) }}"
                                    id="fixed_amountField">
                            </div>
                        </div>

                        <div class="col-sm-6" id="salary_range_group" class="hidden">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label">Salary Range <span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-control" type="number" step="0.01"
                                                    name="from_salary" placeholder="From"
                                                    value="{{ old('from_salary', $job->from_salary) }}"
                                                    id="from_amountField">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-control" type="number" step="0.01"
                                                    name="to_salary" placeholder="To"
                                                    value="{{ old('to_salary', $job->to_salary) }}" id="to_amountField">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="range-error" style="display: none; color: red;">To amount must be greater than
                                    From amount</div>
                            </div>
                        </div>

                        {{-- Salary end --}}

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Number of vacancies <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="vacancies" required placeholder="Ex:05"
                                    value="{{ old('vacancies', $job->vacancies) }}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="selling_price_group_id">Shop location <span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" name="business_location_id">
                                    <option value="" disabled>Select</option>
                                    @foreach ($business_locations as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('business_location_id', $job->business_location_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="status">
                                    <option selected="" value="" disabled>Select Status</option>
                                    @foreach (getStatus() as $status)
                                        <option @selected($job->status == $status['value']) value="{{ $status['value'] }}">
                                            {{ $status['label'] }}</option>
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
                                    class="input-field" placeholder="Description">{{ old('description', $job->description) }}</textarea>

                                @error('description')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="note">Note:</label>
                                <textarea class="form-control" placeholder="" rows="3" name="note" cols="50">{{ old('note', $job->note) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <hr style="margin-top: 30px; margin-bottom: 20px; border-top: 3px solid #3e8541;">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Company Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="company_name" required
                                    placeholder="Name of the company"
                                    value="{{ old('company_name', $job->company_name) }}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Job location <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="location" required
                                    placeholder="Location" value="{{ old('location', $job->location) }}">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="custom_field1">Company Information <span class="text-danger">*</span></label>
                                <textarea rows="5" type="text" class="form-control" name="company_information" id="company-information"
                                    class="input-field" placeholder="Company information">{{ old('company_information', $job->company_information) }}</textarea>
                                @error('company_information')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
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
            function toggleSalaryFields() {
                const salaryType = $('#salary_type').val();

                if (salaryType === 'Fixed') {
                    $('#fixed_amount_group').show().find('input').attr('required', true);
                    $('#salary_range_group').hide().find('input').removeAttr('required').val(null);
                } else if (salaryType === 'Negotiable') {
                    $('#fixed_amount_group').hide().find('input').removeAttr('required').val(null);
                    $('#salary_range_group').show().find('input').attr('required', true);
                } else {
                    $('#fixed_amount_group, #salary_range_group').hide().find('input').removeAttr('required').val(
                        null);
                }
            }

            function validateRange() {
                const fromAmount = parseFloat($('#from_amountField').val());
                const toAmount = parseFloat($('#to_amountField').val());

                if (toAmount && fromAmount && toAmount <= fromAmount) {
                    $('#range-error').show();
                    $('#to_amountField').val(null);
                } else {
                    $('#range-error').hide();
                }
            }

            $('#salary_type').change(function() {
                toggleSalaryFields();
            });

            $('#to_amountField').on('change', function() {
                validateRange();
            });

            $('#from_amountField').on('change', function() {
                validateRange();
            });

            // Initial call to set the correct fields based on the old value if available
            toggleSalaryFields();
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
