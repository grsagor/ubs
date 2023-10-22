@extends('layouts.auth2')
@section('title', __('lang_v1.register'))

@section('content')
    <div class="login-form col-md-12 col-xs-12 right-col-content-register">

        <p class="form-header text-white">@lang('business.register_and_get_started_in_minutes')</p>
        {{-- Form will be start here --}}
        <form action="{{ route('customer.postRegister') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="business_id" value="{{ $business_id }}">

            <div class="content clearfix">
                <div class="row" id="add_contact_person_div_0">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="surname">Prefix:</label>
                            <input class="form-control" placeholder="Mr / Mrs / Miss" id="surname" name="surname"
                                type="text">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="first_name">First Name:*</label>
                            <input class="form-control" required="" placeholder="First Name" id="first_name"
                                name="first_name" type="text" aria-required="true">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input class="form-control" placeholder="Last Name" id="last_name" name="last_name"
                                type="text">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email:*</label>
                            <input class="form-control" placeholder="Email" id="email" name="email" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_number">Mobile Number:*</label>
                            <input class="form-control" placeholder="Mobile Number" id="contact_number"
                                name="contact_number" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alt_number">Alternate contact number:</label>
                            <input class="form-control" placeholder="Alternate contact number" id="alt_number"
                                name="alt_number" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="family_number">Family contact number:</label>
                            <input class="form-control" placeholder="Family contact number" id="family_number"
                                name="family_number" type="text">
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    {{-- Address start --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_line_1">Address line 1:</label>
                            <input class="form-control" placeholder="Address line 1" rows="3" name="permanent_address"
                                type="text" id="address_line_1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_line_2">Address line 2:</label>
                            <input class="form-control" placeholder="Address line 2" rows="3" name="current_address"
                                type="text" id="address_line_2">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="city">City:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-map-marker"></i>
                                </span>
                                <input class="form-control" placeholder="City" name="city" type="text"
                                    id="city">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="state">State:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-map-marker"></i>
                                </span>
                                <input class="form-control" placeholder="State" name="state" type="text"
                                    id="state">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-globe"></i>
                                </span>
                                <input class="form-control" placeholder="Country" name="country" type="text"
                                    id="country">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="zip_code">Zip Code:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-map-marker"></i>
                                </span>
                                <input class="form-control" placeholder="Zip/Postal Code" name="zip_code" type="text"
                                    id="zip_code">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" id="loginDiv0">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username:*</label>
                            <input class="form-control" placeholder="Username" required="" id="username"
                                name="username" type="text" aria-required="true">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password:*</label>
                            <input class="form-control" required="" placeholder="Password" id="password"
                                name="password" type="password" value="" aria-required="true">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password:*</label>
                            <input class="form-control" required="" placeholder="Confirm Password"
                                id="password_confirmation" data-rule-equalto="#password0" name="password_confirmation"
                                type="password" value="" aria-required="true">
                        </div>
                    </div>
                </div>
                <div class="actions clearfix">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </div>

        </form>
        {{-- Form will be end here --}}
    </div>
@stop
@section('javascript')
    <script type="text/javascript"></script>
@endsection
