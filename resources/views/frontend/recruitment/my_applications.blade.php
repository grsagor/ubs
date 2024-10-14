@extends('layouts.app')
@section('title', 'My Applications')

@section('content')
    <section class="content-header">
        <h1>My applications</h1>
    </section>

    <section class="content">
        <div class="form-container box box-primary">
            <div class="box-body" style="overflow-x: scroll;">
                <table id="my_applications_Table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th style="min-width: 300px; overflow: hidden; text-overflow: ellipsis;">Job Title</th>
                            <th>Company Name</th>
                            <th>Location</th>
                            <th>Salary</th>
                            <th>Applied Date</th>
                            <th>Sponsorship</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appliedJobs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a
                                        href="{{ route('recruitment.details', ['id' => $item->JobId->short_id, 'slug' => $item->JobId->slug]) }}">{{ $item->JobId->title }}</a>
                                </td>
                                <td>{{ $item->JobId->company_name ?? '' }}</td>
                                <td>{{ $item->JobId->location ?? '' }}</td>
                                <td>
                                    @if ($item->JobId->salary)
                                        {{ $item->JobId->salary }}/{{ $item->JobId->salary_type }}
                                    @else
                                        {{ $item->JobId->salary_type }}
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d F Y') ?? '' }}</td>
                                <td>{{ $item->recuimentId->sponsorship == 1 ? 'Need' : 'No Need' }}</td>
                                <td>
                                    <a href="{{ route('recruitment.show', $item->recruitment_id) }}"
                                        class="btn btn-xs btn-primary">
                                        <i class="fas fa-eye"></i> Show
                                    </a>
                                    <a href="#" class="btn btn-xs btn-success copy-link"
                                        data-link="{{ route('recruitment.show', $item->recruitment_id) }}">
                                        <i class="fas fa-copy"></i> Copy
                                    </a>
                                </td>
                            </tr>
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

@section('script')
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
