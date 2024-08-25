@extends('layouts.app')
@section('title', 'Job-Categories')
@section('css')
    <style>
        .box.box-solid>.box-header .btn:hover {
            background: #0c84fd;
        }
    </style>
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Job Categories
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">

                <div class="box-tools">
                    <a type="button" class="btn btn-block btn-primary" href="{{ route('job-category.create') }}">
                        <i class="fa fa-plus"></i> Add</a>
                </div>
            </div>

            <div class="box-body" style="overflow-x: scroll;">
                <table id="category_business_Table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Short Code</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $item)
                            <!-- Main Category -->
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->short_code }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a href="{{ route('job-category.edit', $item->id) }}" class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <a href="{{ route('job-category.statusChange', $item->id) }}"
                                        class="btn btn-xs {{ $item->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                        <i class="fas fa-check-circle"></i>
                                    </a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
