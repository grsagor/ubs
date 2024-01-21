@extends('layouts.app')
@section('title', 'Jobs')
@section('content')
    <section class="content-header">
        <h1>Applied jobs</h1>
    </section>

    <section class="content">

        <div class="form-container box box-primary">

            <div class="box-header" style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Search form -->
                <form action="{{ route('recruitment.appliedJobs') }}" method="GET" style="flex: 1; margin-right: 10px;">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control"
                            placeholder="Search...">
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

                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Job Title</th>
                            <th colspan="3">Applicant</th>
                        </tr>
                        <tr>

                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Applied date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appliedJobs as $item)
                            <tr>
                                <td>{{ serialNumber($appliedJobs, $loop) }}</td>
                                <td>
                                    <a
                                        href="{{ route('recruitment.details', $item->JobId->uuid) }}">{{ $item->JobId->title }}</a>
                                </td>
                                <td>{{ $item->recuimentId->name ?? '' }}</td>
                                <td>{{ $item->recuimentId->phone ?? '' }}</td>
                                <td>{{ $item->recuimentId->email ?? '' }}</td>
                                <td>{{ $item->created_at->format('d F Y') ?? '' }}</td>

                                {{-- <td>
                                    <a href="{{ route('recruitment.show', $item->uuid) }}" class="btn btn-xs btn-primary">
                                        <i class="fas fa-eye"></i> Show
                                    </a>

                                    <a href="#" class="btn btn-xs btn-success copy-link"
                                        data-link="{{ route('recruitment.show', $item->uuid) }}">
                                        <i class="fas fa-copy"></i> Copy
                                    </a>
                                </td> --}}

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $appliedJobs->links() }}
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var copyLinkButtons = document.querySelectorAll('.copy-link');

            copyLinkButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    // Get the link from the data-link attribute
                    var linkToCopy = button.getAttribute('data-link');

                    // Create a temporary input element
                    var tempInput = document.createElement('input');
                    tempInput.value = linkToCopy;
                    document.body.appendChild(tempInput);

                    // Select and copy the text in the input element
                    tempInput.select();
                    document.execCommand('copy');
                    document.body.removeChild(tempInput);

                    // Show Toastr success message
                    toastr.success('Link copied');
                });
            });
        });
    </script>

@endsection
