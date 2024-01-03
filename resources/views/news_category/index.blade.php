@extends('layouts.app')
@section('title', 'News-Category')
@section('content')
    <section class="content-header">
        <h1>News Category</h1>
    </section>

    <section class="content">

        <div class="form-container box box-primary">

            <div class="box-header" style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Search form -->
                <form action="{{ route('shop-news-category.index') }}" method="GET" style="flex: 1; margin-right: 10px;">
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
                    <a href="{{ route('shop-news-category.create') }}" class="btn btn-primary">
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
                        @forelse ($news as $item)
                            <tr>
                                <td>{{ serialNumber($news, $loop) }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ route('shop-news-category.edit', $item->id) }}"
                                        class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <a href="{{ route('shop-news-category.statusChange', $item->id) }}"
                                        class="btn btn-xs {{ $item->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                        <i class="fas fa-check-circle"></i>
                                    </a>

                                    <form action="{{ route('shop-news-category.destroy', $item->id) }}" method="post"
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

                {{ $news->links() }}


                {{-- {{ $news->links('news_category.pagination') }} --}}
            </div>
        </div>
    </section>
@endsection
