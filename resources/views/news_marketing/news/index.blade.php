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
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($news as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->category->name ?? '' }}</td>
                                <td>{!! Str::limit($item->title, 80, ' ...') !!}</td>
                                <td>{{ $item->created_at->format('d F Y h:i A') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle btn-xs"
                                            data-toggle="dropdown" aria-expanded="false">
                                            {{ __('messages.actions') }}
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li>
                                                <a href="{{ route('shop-news.edit', $item->id) }}">
                                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                                </a>
                                            </li>

                                            {{-- <li>
                                                <a href="#" class="btn-view-job">
                                                    <i class="glyphicon glyphicon-eye-open"></i> View
                                                </a>
                                            </li> --}}

                                            <li>
                                                <a href="{{ route('shop-news.statusChange', $item->id) }}">
                                                    <i
                                                        class="fa fa-power-off {{ $item->status == 0 ? 'text-danger' : 'text-success' }}"></i>
                                                    <span class="{{ $item->status == 0 ? 'text-danger' : 'text-success' }}">
                                                        {{ $item->status == 0 ? 'Inactive' : 'Active' }}
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <form action="{{ route('shop-news.destroy', $item->id) }}" method="post"
                                                    style="display: none;" id="delete-form-{{ $item->id }}">
                                                    @csrf
                                                    @method('Delete')
                                                </form>

                                                <a href="#"
                                                    onclick="if(confirm('Are You Sure To Delete?')) {
                                                               event.preventDefault();
                                                               document.getElementById('delete-form-{{ $item->id }}').submit();
                                                           } else {
                                                               event.preventDefault();
                                                           }">
                                                    <i class="glyphicon glyphicon-trash"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
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