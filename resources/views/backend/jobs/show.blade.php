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
            @component('components.widget', ['class' => 'box-primary'])
                <div class="col-sm-12">
                    <label for="note">Note: @show_tooltip(__(''))</label>
                    <p>{{ $job->note }}</p>
                </div>
            @endcomponent
        </div>
    </section>
@endsection
