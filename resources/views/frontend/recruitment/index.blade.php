@extends('layouts.app')
@section('title', 'Jobs')
@section('content')
    <section class="content-header">
        <h1>All applicant</h1>
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
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Applied Jobs</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Current Address</th>
                            <th>Country of Residence</th>
                            <th>Birth Country</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recruitments as $item)
                            <tr>
                                <td>{{ serialNumber($recruitments, $loop) }}</td>
                                <td>
                                    <ul>
                                        @foreach ($item->appliedJobs as $data)
                                            <li>
                                                <a href="{{ route('recruitment.details', $data->JobId->uuid) }}">
                                                    {{ $data->JobId->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $item->name ?? '' }}</td>
                                <td>{{ $item->phone ?? '' }}</td>
                                <td>{{ $item->email ?? '' }}</td>
                                <td>{{ $item->current_address ?? '' }}</td>
                                <td>{{ $item->countryResidence->country_name ?? '' }}</td>
                                <td>{{ $item->birthCountry->country_name ?? '' }}</td>
                                <td>
                                    {{ $item->createdBy->surname ?? '' }}
                                    {{ $item->createdBy->first_name ?? '' }}
                                    {{ $item->createdBy->last_name ?? '' }}
                                </td>
                                <td>
                                    <a href="{{ route('recruitment.show', $item->uuid) }}" class="btn btn-xs btn-primary">
                                        <i class="fas fa-eye"></i> Show
                                    </a>

                                    <a href="#" class="btn btn-xs btn-success copy-link"
                                        data-link="{{ route('recruitment.show', $item->uuid) }}">
                                        <i class="fas fa-copy"></i> Copy
                                    </a>

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
