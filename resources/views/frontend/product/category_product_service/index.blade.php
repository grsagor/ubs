@extends('layouts.app')
@section('title', 'Category of Product/Service')
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
        <h1>Categories of Product/Service
            <small>
                Manage your Product/Service categories
            </small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-solid">
            <div class="box-header">
                <div class="box-tools">
                    <a type="button" class="btn btn-block btn-primary"
                        href="{{ route('product_service_sub_category_create') }}" style="margin-left: 4px;">
                        <i class="fa fa-plus"></i> Sub-Category</a>
                </div>
                <div class="box-tools">
                    <a type="button" class="btn btn-block btn-primary"
                        href="{{ route('product_service_category_create') }}">
                        <i class="fa fa-plus"></i> Category</a>
                </div>
            </div>

            <div class="box-body" style="overflow-x: scroll;">
                <table id="category_business_Table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Category name</th>
                            <th>Short Code</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->short_code }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a href="{{ route('product_service_category_edit', $item->id) }}"
                                        class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>

                            @foreach ($item->sub_categories as $sub)
                                <tr>
                                    <td>--{{ $sub->name }}</td>
                                    <td>{{ $sub->short_code }}</td>
                                    <td>{{ $sub->description }}</td>
                                    <td> <a href="{{ route('product_service_sub_category_edit', $sub->id) }}"
                                            class="btn btn-xs btn-primary">
                                            <i class="glyphicon glyphicon-edit"></i> Edit
                                        </a></td>
                                </tr>
                            @endforeach
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
@section('javascript')
    {{-- @includeIf('taxonomy.taxonomies_js') --}}
@endsection