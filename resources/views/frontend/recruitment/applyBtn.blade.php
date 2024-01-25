@guest
    <div style="margin-top: 10px;">
        @if ($applied_jobs == 1)
            <button type="button" class="btn btn-secondary" disabled>Already applied</button>
        @else
            @if ($recuitment_info == 0)
                <a href="{{ route('recruitment.create', $job->uuid) }}" class="btn btn-dark">Apply for this job</a>
            @endif

            @if ($recuitment_info == 1)
                <form action="{{ route('recruitment.applyJob', $job->uuid) }}" method="POST" class="mx-auto mobileView"
                    enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-dark">Apply for this job</button>
                </form>
            @endif
        @endif
    </div>
@else
    @if (auth()->user()->id != 5)
        <div style="margin-top: 10px;">
            @if ($applied_jobs == 1)
                <button type="button" class="btn btn-secondary" disabled>Already applied</button>
            @else
                @if ($recuitment_info == 0)
                    <a href="{{ route('recruitment.create', $job->uuid) }}" class="btn btn-dark">Apply for this job</a>
                @endif

                @if ($recuitment_info == 1)
                    <form action="{{ route('recruitment.applyJob', $job->uuid) }}" method="POST" class="mx-auto mobileView"
                        enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn btn-dark">Apply for this job</button>
                    </form>
                @endif
            @endif
        </div>
    @endif
@endguest
