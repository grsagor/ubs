@extends('layouts.app')
@section('title', 'Marketing-Category')
@section('content')
    <section class="content-header">
        <h1>Marketing Category</h1>
    </section>

    <section class="content">

        <div class="form-container box box-primary">

            <div class="box-header" style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Search form -->
                <form action="{{ route('shop-marketing-category.index') }}" method="GET"
                    style="flex: 1; margin-right: 10px;">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>

                <!-- Buttons -->
                <div>

                    <a href="{{ request()->url() }}" class="btn btn-success">
                        <i class="fa fa-hands-wash"></i>Clear
                    </a>
                    <a href="{{ route('shop-marketing-category.create') }}" class="btn btn-primary">
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($marketing as $item)
                            <tr>
                                <td>{{ serialNumber($marketing, $loop) }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ route('shop-marketing-category.edit', $item->id) }}"
                                        class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <a href="{{ route('shop-marketing-category.statusChange', $item->id) }}"
                                        class="btn btn-xs {{ $item->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                        <i class="fas fa-check-circle"></i>
                                    </a>

                                    <form action="{{ route('shop-marketing-category.destroy', $item->id) }}" method="post"
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
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $marketing->links() }}
            </div>
        </div>
    </section>
@endsection
