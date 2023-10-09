<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Unipuller') }}</title>

    @include('layouts.partials.css')

</head>

<body>
    @inject('request', 'Illuminate\Http\Request')
    @if (session('status') && session('status.success'))
        <input type="hidden" id="status_span" data-status="{{ session('status.success') }}"
            data-msg="{{ session('status.msg') }}">
    @endif
    <div class="container-fluid">
        <div class="row eq-height-row">
            <div class="col-md-6 col-sm-5 hidden-xs left-col eq-height-col">
                <div class="left-col-content login-header">
                    <div style="margin-top: 60%;">
                        <a href="/">
                            @if (file_exists(public_path('uploads/logo.png')))
                                <img src="/uploads/logo.png" class="img-rounded" alt="Logo" width="150">
                            @endif
                        </a>
                        <br />
                        @if (!empty(config('constants.app_title')))
                            <small>{{ config('constants.app_title') }}</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-7 col-xs-12 right-col eq-height-col">
                <div class="row">
                    <div class="col-md-3 col-xs-4" style="text-align: left;">
                        <select class="form-control input-sm" id="change_lang" style="margin: 10px;">
                            @foreach (config('constants.langs') as $key => $val)
                                <option value="{{ $key }}" @if ((empty(request()->lang) && config('app.locale') == $key) || request()->lang == $key) selected @endif>
                                    {{ $val['full_name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-9 col-xs-8" style="text-align: right;padding-top: 10px;">

                        @if ($request->segment(1) != 'login')
                            &nbsp; &nbsp;<span class="text-white">{{ __('business.already_registered') }} </span><a
                                href="{{ action([\App\Http\Controllers\Auth\LoginController::class, 'login']) }}@if (!empty(request()->lang)) {{ '?lang=' . request()->lang }} @endif">
                                <span style="color: #a8b0e0">{{ __('business.sign_in') }}</span>
                            </a>
                        @endif
                    </div>

                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    @include('layouts.partials.javascripts')

    <!-- Scripts -->
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>

    @yield('javascript')

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2_register').select2();

            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

</html>
