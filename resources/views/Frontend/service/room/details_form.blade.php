@extends('frontend.layouts.master_layout')

@section('css')
    <style>
        /* Style the input field to match the select box */
        input.select-style {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0;
            font-size: 16px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        /* Style the select element to match the input field */
        select.form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0;
            font-size: 16px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
@endsection

@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">
        <div class="col-lg-6 col-md-8 col-12">
            <h3>Signup Now</h3>
            <form id="registerform" action="#" method="POST">
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control select-style" placeholder="Full Name">
                </div>

                <div>
                    <label for="select">Select</label>
                    <select name="select" class="form-control">
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary float-none w-100 rounded-0 submit-btn" name="register"
                    value="Register">Register</button>
            </form>
        </div>
    </div>
@endsection
