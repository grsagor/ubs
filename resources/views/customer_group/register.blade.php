@extends('layouts.auth2')
@section('title', __('lang_v1.register'))

@section('content')
<div class="login-form col-md-12 col-xs-12 right-col-content-register">
    
    <p class="form-header text-white">@lang('business.register_and_get_started_in_minutes')</p>
    {{-- Form will be start here --}}
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="content clearfix">
            <div class="row" id="add_contact_person_div_0">
                <div class="col-md-2">
                    <div class="form-group">
                         <label for="surname0">Prefix:</label>
                         <input class="form-control" placeholder="Mr / Mrs / Miss" id="surname0" name="contact_persons[0][surname]" type="text">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="first_name0">First Name:*</label>
                        <input class="form-control" required="" placeholder="First Name" id="first_name0" name="contact_persons[0][first_name]" type="text" aria-required="true">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="last_name0">Last Name:</label>
                        <input class="form-control" placeholder="Last Name" id="last_name0" name="contact_persons[0][last_name]" type="text">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email0">Email:</label>
                        <input class="form-control" placeholder="Email" id="email0" name="contact_persons[0][email]" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_number0">Mobile Number:</label>
                        <input class="form-control" placeholder="Mobile Number" id="contact_number0" name="contact_persons[0][contact_number]" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alt_number0">Alternate contact number:</label>
                        <input class="form-control" placeholder="Alternate contact number" id="alt_number0" name="contact_persons[0][alt_number]" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="family_number0">Family contact number:</label>
                        <input class="form-control" placeholder="Family contact number" id="family_number0" name="contact_persons[0][family_number]" type="text">
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
    
    
            {{-- Address start --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address_line_1">Address line 1:</label>
                    <input class="form-control" placeholder="Address line 1" rows="3" name="address_line_1" type="text" id="address_line_1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address_line_2">Address line 2:</label>
                    <input class="form-control" placeholder="Address line 2" rows="3" name="address_line_2" type="text" id="address_line_2">
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
                        <input class="form-control" placeholder="City" name="city" type="text" id="city">
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
                        <input class="form-control" placeholder="State" name="state" type="text" id="state">
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
                        <input class="form-control" placeholder="Country" name="country" type="text" id="country">
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
                        <input class="form-control" placeholder="Zip/Postal Code" name="zip_code" type="text" id="zip_code">
                    </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row" id="loginDiv0">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username0">Username:*</label>
                        <input class="form-control" placeholder="Username" required="" id="username0" name="contact_persons[0][username]" type="text" aria-required="true">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password0">Password:*</label>
                        <input class="form-control" required="" placeholder="Password" id="password0" name="contact_persons[0][password]" type="password" value="" aria-required="true">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="confirm_password0">Confirm Password:*</label>
                        <input class="form-control" required="" placeholder="Confirm Password" id="confirm_password0" data-rule-equalto="#password0" name="contact_persons[0][confirm_password]" type="password" value="" aria-required="true">
                    </div>
                </div>
            </div>
            {{-- Address End --}}
        </div>
        <div class="actions clearfix"><ul role="menu" aria-label="Pagination"><li class="" aria-disabled="false"><a href="#previous" role="menuitem">Previous</a></li><li aria-hidden="true" aria-disabled="true" class="disabled" style="display: none;"><a href="#next" role="menuitem">Next</a></li><li aria-hidden="false" style=""><a href="#finish" role="menuitem">Register</a></li></ul></div>
    </form>
    {{-- Form will be end here --}}
</div>
@stop
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_lang').change( function(){
            window.location = "{{ route('business.getRegister') }}?lang=" + $(this).val();
        });
    })
</script> 
@endsection 