@extends('layouts.app')
@section('title', 'Recruitment')
@section('content')
    <section class="content-header">
        <h1>Recruitment List</h1>
    </section>

    <section class="content">

        <div class="form-container box box-primary">

            <div class="box-header" style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Search form -->
                <form action="{{ route('recruitment.index') }}" method="GET" style="flex: 1; margin-right: 10px;">
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
                    {{-- <a href="{{ route('recruitment.index') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add
                    </a> --}}
                </div>
            </div>



            <div class="box-body">

                <table class="table table-bordered table-striped table-hover">
                    <!-- Table header -->
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Current Address</th>
                            <th>Current of Residence</th>
                            <th>Birth Country</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recruitments as $item)
                            <tr>
                                <td>{{ serialNumber($recruitments, $loop) }}</td>
                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                <td>{{ $item->name ?? '' }}</td>
                                <td>{{ $item->phone ?? '' }}</td>
                                <td>{{ $item->email ?? '' }}</td>
                                <td>{{ $item->current_address ?? '' }}</td>
                                <td>{{ $item->country_residence ?? '' }}</td>
                                <td>{{ $item->birth_country ?? '' }}</td>
                                <td>
                                    <a href="{{ route('recruitment.show', $item->id) }}" class="btn btn-xs btn-primary">
                                        <i class="fas fa-eye"></i> Show
                                    </a>

                                    {{-- <a href="{{ route('shop-news.statusChange', $item->id) }}"
                                        class="btn btn-xs {{ $item->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                        <i class="fas fa-check-circle"></i>
                                    </a> --}}

                                    {{-- <form action="{{ route('shop-news.destroy', $item->id) }}" method="post"
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
                                <td colspan="8" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $recruitments->links() }}
            </div>
        </div>
    </section>
@endsection
