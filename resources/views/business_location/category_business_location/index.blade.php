@extends('layouts.app')
@section('title', 'Category of business location')
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
        <h1>Categories of business location
            <small>
                Manage your business location categories
            </small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-solid">
            <div class="box-header">
                <div class="box-tools">
                    <a type="button" class="btn btn-block btn-primary"
                        href="{{ route('business_location_sub_category_create') }}" style="margin-left: 4px;">
                        <i class="fa fa-plus"></i> Sub-Category</a>
                </div>
                <div class="box-tools">
                    <a type="button" class="btn btn-block btn-primary"
                        href="{{ route('business_location_category_create') }}">
                        <i class="fa fa-plus"></i> Category</a>
                </div>
            </div>

            <div class="box-body" style="overflow-x: scroll;">
                <table id="category_business_Table" class="table table-bordered table-striped table-hover">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Category name</th>
                            <th>Sub Category</th>
                            <th>Short Code</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if ($item->sub_categories->isEmpty())
                                        {{-- <span>No Subcategories</span> --}}
                                    @else
                                        <ul>
                                            @foreach ($item->sub_categories as $sub)
                                                <li>{{ $sub->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td>{{ $item->short_code }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    @if ($item->sub_categories->isNotEmpty())
                                        <a href="{{ route('business_location_sub_category_index', $item->id) }}"
                                            class="btn btn-xs btn-info">
                                            <i class="glyphicon glyphicon-eye-open"></i> View
                                        </a>
                                    @endif

                                    <a href="{{ route('business_location_category_edit', $item->id) }}"
                                        class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No data available</td>
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
