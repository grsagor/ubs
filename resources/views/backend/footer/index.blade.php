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
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Category</th>
                            <th>Name</th>
                            {{-- <th>Description</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->category_name }}</td>
                                <td>{{ ucwords(str_replace('-', ' ', $item->slug)) }}</td>
                                {{-- <td>{!! substr($item->description ?? '', 0, 40) !!}</td> --}}
                                <td>
                                    <a href="{{ route('footer.edit', $item->id) }}" class="btn btn-xs btn-primary"><i
                                            class="glyphicon glyphicon-edit"></i> Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
