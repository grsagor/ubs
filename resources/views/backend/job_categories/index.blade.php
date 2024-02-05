@extends('layouts.app')
@section('title', 'Job-Categories')
@section('content')
    <section class="content-header">
        <h1>Job Categories</h1>
    </section>

    <section class="content">

        <div class="form-container box box-primary">

            <div class="box-header" style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Search form -->
                <form action="{{ route('job-category.index') }}" method="GET" style="flex: 1; margin-right: 10px;">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>

                <!-- Buttons -->
                <div>
                    <!-- Clear button -->
                    <a href="{{ request()->url() }}" class="btn btn-success">
                        <i class="fa fa-hands-wash"></i> Clear
                    </a>
                    <!-- Add button -->
                    <a href="{{ route('job-category.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add
                    </a>
                </div>
            </div>


            <div class="box-body">

                <table class="table table-bordered table-striped table-hover">
                    <!-- Table header -->
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jobs as $item)
                            <tr>
                                <td>{{ serialNumber($jobs, $loop) }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ route('job-category.statusChange', $item->id) }}"
                                        class="btn btn-xs {{ $item->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                        {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('job-category.edit', $item->id) }}" class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    {{-- <form action="{{ route('job-category.destroy', $item->id) }}" method="post"
                                        style="display: none;" id="delete-form-{{ $item->id }}">
                                        @csrf
                                        @method('Delete')
                                    </form>

                                    <a class="btn btn-xs btn-danger" href="#"
                                        onclick="if(confirm('Are You Sure To Delete?')) {
                                                   event.preventDefault();
                                                   document.getElementById('delete-form-{{ $item->id }}').submit();
                                               } else {
                                                   event.preventDefault();
                                               }">
                                        <i class="fas fa-trash-alt"></i>
                                    </a> --}}

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $jobs->links() }}

            </div>
        </div>
    </section>
@endsection
