@extends('layouts.app')
@section('title', 'Advertise-Room')
@section('content')
    <section class="content-header">
        <h1>Footer Details
            <small></small>
        </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">
            <div class="box-body">

                @include('backend.footer.partial', ['title' => 'Footer Table', 'data' => $footer])

                <hr style="margin-top: 40px; border: 1px dashed #979797; border-radius: 5px;">

                @include('backend.footer.partial', ['title' => 'Menu Table', 'data' => $menu])

            </div>
        </div>
    </section>
@endsection
