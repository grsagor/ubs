@extends('layouts.app')
@section('title', 'News-Category')
@section('content')
    <section class="content-header">
        <h1>News Category</h1>
    </section>

    <section class="content">

        <div class="form-container box box-primary">

            <div class="box-header">
                <div class="box-tools"> <a type="button" class="btn btn-block btn-primary"
                        href="{{ route('shop_news_sub_category_create') }}" style="margin-left: 4px;"> <i
                            class="fa fa-plus"></i> Sub-Category</a> </div>
                <div class="box-tools"> <a type="button" class="btn btn-block btn-primary"
                        href="{{ route('shop_news_category_create') }}"> <i class="fa fa-plus"></i> Category</a>
                </div>
            </div>

            <div class="box-body" style="overflow-x: scroll;">
                <table id="category_business_Table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Category name</th>
                            <th>Type</th>
                            <th>Short Code</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ ucfirst($item->category_type) }}</td>
                                <td>{{ $item->short_code }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a href="{{ route('shop_news_category_edit', $item->id) }}"
                                        class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('shop_news_category.statusChange', $item->id) }}"
                                        class="btn btn-xs {{ $item->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                        <i class="fas fa-check-circle"></i>
                                    </a>
                                </td>
                            </tr>

                            @foreach ($item->sub_categories as $sub)
                                <tr>
                                    <td>--{{ $sub->name }}</td>
                                    <td></td>
                                    <td>{{ $sub->short_code }}</td>
                                    <td>{{ $sub->description }}</td>
                                    <td> <a href="{{ route('shop_news_sub_category_edit', $sub->id) }}"
                                            class="btn btn-xs btn-primary">
                                            <i class="glyphicon glyphicon-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('shop_news_sub_category.statusChange', $sub->id) }}"
                                            class="btn btn-xs {{ $sub->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </section>
@endsection
