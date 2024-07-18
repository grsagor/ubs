@extends('layouts.app')
@section('title', 'Shops location')
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
        <h1> Shops Location
            <small>Manage your shops location</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-solid">
            <div class="box-header">
                <div class="box-tools">
                    <a type="button" class="btn btn-block btn-primary" href="{{ route('business-location.create') }}">
                        <i class="fa fa-plus"></i> Create</a>
                </div>
            </div>

            <div class="box-body" style="overflow-x: scroll;">
                <table id="new_business_location_table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>Name</th>
                            <th>Location ID</th>
                            <th>Building</th>
                            <th>City</th>
                            <th>Post Code</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Price Group</th>
                            <th>Invoice Scheme</th>
                            <th>Invoice Layout For POS</th>
                            <th>Invoice Layout For Sale</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($locations as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->location_id }}</td>
                                <td>{{ $item->landmark }}</td>
                                <td>{{ $item->city }}</td>
                                <td>{{ $item->zip_code }}</td>
                                <td>{{ $item->state }}</td>
                                <td>{{ $item->country }}</td>
                                <td>{{ $item->selling_price_group->name ?? null }}</td>
                                <td>{{ $item->invoice_schemes->name ?? null }}</td>
                                <td>{{ $item->invoice_layouts->name ?? null }}</td>
                                <td>{{ $item->invoice_layouts_sale->name ?? null }}</td>
                                <td>
                                    <a href="{{ route('business-location.edit', $item->id) }}"
                                        class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <a href="{{ route('location.settings', $item->id) }}" class="btn btn-success btn-xs"><i
                                            class="fa fa-wrench"></i> Settings</a>

                                    <a href="{{ route('location.activate_deactivate', $item->id) }}"
                                        class="btn btn-xs {{ $item->is_active ? 'btn-danger' : 'btn-success' }}">
                                        <i class="fa fa-power-off"></i>
                                        {{ $item->is_active ? 'Deactivate' : 'Activate' }} Location
                                    </a>
                                </td>
                            @empty
                            <tr>
                                <td colspan="12" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('javascript')
    {{-- @includeIf('taxonomy.taxonomies_js') --}}
@endsection
