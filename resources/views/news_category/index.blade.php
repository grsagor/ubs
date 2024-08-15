@extends('layouts.app')
@section('title', 'News-Category')
@section('content')
    <section class="content-header">
        <h1>News Category</h1>
    </section>

    <section class="content">

        <div class="form-container box box-primary">

            <div class="box-header">
                <div class="box-tools">
                    <a href="{{ route('shop-news-category.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add
                    </a>
                </div>
            </div>

            <div class="box-body" style="overflow-x: scroll;">
                <table id="shop_news_category_table" class="table table-bordered table-striped table-hover">
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
                                <td>{{ $loop->iteration }}</td>
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
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </section>
@endsection
