@extends('layouts.app')
@section('title', 'Job')
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

                @component('components.widget', ['class' => 'box-primary'])
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="title" required placeholder="Title"
                                    value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="selling_price_group_id">Category <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="job_category_id" required>
                                    <option value="" disabled selected>Select</option>
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
                                <label class="form-label">Job type <span class="text-danger">*</span></label>
                                <select class="form-control select2" multiple name="job_type[]" required>
                                    <option value="" disabled>Select type</option>
                                    <option value="Permanent"
                                        {{ in_array('Permanent', old('job_type', [])) ? 'selected' : '' }}>Permanent
                                    </option>
                                    <option value="Temporary"
                                        {{ in_array('Temporary', old('job_type', [])) ? 'selected' : '' }}>Temporary
                                    </option>
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
                                        {{ in_array('Full time', old('hour_type', [])) ? 'selected' : '' }}>Full time
                                    </option>
                                    <option value="Part time"
                                        {{ in_array('Part time', old('hour_type', [])) ? 'selected' : '' }}>Part time
                                    </option>
                                    <option value="Freelancing"
                                        {{ in_array('Freelancing', old('hour_type', [])) ? 'selected' : '' }}>
                                        Freelancing
                                    </option>
                                    <option value="Contractual"
                                        {{ in_array('Contractual', old('hour_type', [])) ? 'selected' : '' }}>
                                        Contractual
                                    </option>
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
                        <div class="clearfix"></div>

                        {{-- Salary start --}}

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Salary <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="salary_variation" required>
                                    <option value="" selected disabled>Select type</option>
                                    <option value="Hourly" {{ old('salary_variation') == 'Hourly' ? 'selected' : '' }}>
                                        Hourly
                                    </option>
                                    <option value="Monthly" {{ old('salary_variation ') == 'Monthly' ? 'selected' : '' }}>
                                        Monthly </option>
                                    <option value="Yearly" {{ old('salary_variation ') == 'Yearly' ? 'selected' : '' }}>
                                        Yearly </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Salary type <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="salary_type" id="salary_type" required>
                                    <option value="" selected disabled>Select type</option>
                                    <option value="Fixed" {{ old('salary_type') == 'Fixed' ? 'selected' : '' }}>Fixed
                                    </option>
                                    <option value="Negotiable" {{ old('salary_type') == 'Negotiable' ? 'selected' : '' }}>
                                        Negotiable</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6" id="fixed_amount_group" class="hidden">
                            <div class="form-group">
                                <label class="form-label">Salary <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" step="0.01" name="fixed_salary"
                                    placeholder="Ex. 10000" value="{{ old('fixed_salary') }}" id="fixed_amountField">
                            </div>
                        </div>

                        <div class="col-sm-6" id="salary_range_group" class="hidden">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label">Salary Range <span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-control" type="number" step="0.01" name="from_salary"
                                                    placeholder="From" value="{{ old('from_salary') }}"
                                                    id="from_amountField">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-control" type="number" step="0.01" name="to_salary"
                                                    placeholder="To" value="{{ old('to_salary') }}" id="to_amountField">
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
                                    value="{{ old('vacancies') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="selling_price_group_id">Shop location <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="business_location_id" required>
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
                                <select class="form-control select2" name="status">
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
                    </div>
                @endcomponent

                @component('components.widget', ['class' => 'box-primary'])
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Employer Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="company_name" required
                                    placeholder="Name of the employer" value="{{ old('company_name') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Job location <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="location" required placeholder="Location"
                                    value="{{ old('location') }}">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="custom_field1">Employee Information <span class="text-danger">*</span></label>
                                <textarea rows="5" type="text" class="form-control" name="company_information" id="company-information"
                                    class="input-field" placeholder="Employee information">{{ old('company_information') }}</textarea>
                                @error('company_information')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                @endcomponent

                @component('components.widget', ['class' => 'box-primary'])
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="note">Note: @show_tooltip(__(''))</label>
                            <textarea rows="5" type="text" class="form-control" name="note" id="note" class="input-field"
                                placeholder="Note">{{ old('note') }}</textarea>
                        </div>
                    </div>
                @endcomponent

                <!-- Add Submit Button -->
                <div class="col-sm-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form>
        </div>

    </section>
@endsection

@section('javascript')
    @include('backend.jobs.partial.js')
@endsection
