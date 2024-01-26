@guest
    <div style="margin-top: 10px;">
        @if ($applied_jobs == 1)
            <button type="button" class="btn alreadyApplied" disabled>Already applied</button>
        @else
            @if ($recuitment_info == 0)
                <a href="{{ route('recruitment.create', $job->uuid) }}" class="btn applynow">Apply Now</a>
            @endif

            @if ($recuitment_info == 1)
                <form action="{{ route('recruitment.applyJob', $job->uuid) }}" method="POST" class="mx-auto mobileView"
                    enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn applynow">Apply Now</button>
                </form>
            @endif
        @endif
    </div>
@else
    @if (auth()->user()->id != 5)
        <div style="margin-top: 10px;">
            @if ($applied_jobs == 1)
                <button type="button" class="btn alreadyApplied" disabled>Already applied</button>
            @else
                @if ($recuitment_info == 0)
                    <a href="{{ route('recruitment.create', $job->uuid) }}" class="btn applynow">Apply Now</a>
                @endif

                @if ($recuitment_info == 1)
                    <form action="{{ route('recruitment.applyJob', $job->uuid) }}" method="POST" class="mx-auto mobileView"
                        enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn applynow">Apply Now</button>
                    </form>
                @endif
            @endif
        </div>
    @endif
@endguest
