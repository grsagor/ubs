{{-- @guest
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
@endguest --}}

<!-- Apply Now Button -->


<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Apply</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body text-center" style="padding: 80px;">
                <p>Do you want to apply with your saved information?</p>

                <form action="{{ route('recruitment.applyJob', $job->uuid) }}" method="POST" class="mx-auto mobileView"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="confirmation" value="No"> <!-- Default value for "No" -->

                    <button type="submit" class="btn btn-no">No</button>

                    <button type="submit" class="btn applynow" onclick="setConfirmationValue('Yes')">Yes</button>
                </form>
            </div>

            <!-- Modal Footer -->
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> --}}

        </div>
    </div>
</div>

<div style="margin-top: 10px;">
    @if ($applied_jobs == 1)
        <button type="button" class="btn alreadyApplied" disabled>Already applied</button>
    @else
        @if ($recuitment_info == 0)
            <a href="{{ route('recruitment.create', $job->uuid) }}" class="btn applynow">Apply Now</a>
        @endif

        @if ($recuitment_info == 1)
            <button class="btn applynow" data-toggle="modal" data-target="#myModal">Apply Now</button>
        @endif
    @endif
</div>

<script>
    function setConfirmationValue(value) {
        // Set the value of the hidden input field before submitting the form
        document.querySelector('input[name="confirmation"]').value = value;
    }
</script>
