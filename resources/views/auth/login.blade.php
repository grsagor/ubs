@extends('layouts.auth2')
@section('title', __('lang_v1.login'))

@section('content')

    <!-- Register Url -->
    @if (config('constants.allow_registration'))
        <div class="btn-group">
            <button type="button" class="btn dropdown-toggle bg-maroon btn-flat" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <b>{{ __('business.not_yet_registered') }}</b>
                {{ __('business.register_now') }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ url('business/register') }}">Register as business</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ url('customer/register') }}">Register as customer</a></li>
            </ul>
        </div>
    @endif

    <div class="login-form col-md-12 col-xs-12 right-col-content">
        <p class="form-header text-white">@lang('lang_v1.login')</p>
        <form method="POST" action="{{ route('login') }}" id="login-form">
            {{ csrf_field() }}
            <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                @php
                    $username = old('username');
                    $password = null;
                @endphp
                <input id="username" type="text" class="form-control" name="username" value="{{ $username }}"
                    required autofocus placeholder="@lang('lang_v1.username')">
                <span class="fa fa-user form-control-feedback"></span>
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" value="{{ $password }}"
                    required placeholder="@lang('lang_v1.password')">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('lang_v1.remember_me')
                    </label>
                </div>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat btn-login">@lang('lang_v1.login')</button>
                @if (config('app.env') != 'demo')
                    <a href="{{ route('password.request') }}" class="pull-right">
                        @lang('lang_v1.forgot_your_password')
                    </a>
                @endif
            </div>
        </form>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#change_lang').change(function() {
                window.location = "{{ route('login') }}?lang=" + $(this).val();
            });
        })
    </script>
@endsection
