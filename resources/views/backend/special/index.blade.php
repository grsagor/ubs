@extends('layouts.app')
@section('title', 'Special')
@section('content')
    <section class="content-header">
        <h1>Special</h1>
    </section>

    <section class="content">

        <div class="form-container box box-primary">

            <div class="box-header">
                <div class="box-tools"> <a type="button" class="btn btn-block btn-primary"
                        href="{{ route('special.create') }}">
                        <i class="fa fa-plus"></i> Add</a>
                </div>
            </div>

            <div class="box-body" style="overflow-x: scroll;">
                <table id="category_business_Table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Short Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($specials as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ ucFirst($item->type) }}</td>
                                <td>{{ $item->code }}</td>
                                <td>
                                    <a href="{{ route('special.edit', $item->id) }}" class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('special.statusChange', $item->id) }}"
                                        class="btn btn-xs {{ $item->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                        {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </section>
@endsection
