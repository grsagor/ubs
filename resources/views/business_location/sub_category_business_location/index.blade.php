@extends('layouts.app')
@section('title', 'Category of business location')
@section('content')

    <section class="content-header">
        <h1>Sub categories of business location
            <small>
                Manage your business location sub categories
            </small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">Sub category details</h3>
                <div class="box-tools">
                    <a href="{{ route('business_location_category_index') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-list"></i> List</a>
                </div>
            </div>


            <div class="box-body" style="overflow-x: scroll;">
                <h4 class="text-center">
                    Category Name: {{ $category->name }}
                </h4>
                <table id="sub_category_business_Table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Sub Category name</th>
                            <th>Short Code</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sub_categorires as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->short_code }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a href="{{ route('business_location_sub_category_edit', $item->id) }}"
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
