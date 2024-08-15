@extends('layouts.app')
@section('title', 'Shop-News')
@section('content')
    <section class="content-header">
        <h1>Shop News </h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">

            <div class="box-header">
                <div class="box-tools">
                    <a href="{{ route('shop-news.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add
                    </a>
                </div>
            </div>

            <div class="box-body" style="overflow-x: scroll;">
                <table id="shop_news_table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($news as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->newsCategory->name ?? '' }}</td>
                                <td>{!! Str::limit($item->title, 80, ' ...') !!}</td>
                                <td>
                                    <a href="{{ route('shop-news.edit', $item->id) }}" class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <a href="{{ route('shop-news.statusChange', $item->id) }}"
                                        class="btn btn-xs {{ $item->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                        <i class="fas fa-check-circle"></i>
                                    </a>

                                    <form action="{{ route('shop-news.destroy', $item->id) }}" method="post"
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
                                <td colspan="4" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
