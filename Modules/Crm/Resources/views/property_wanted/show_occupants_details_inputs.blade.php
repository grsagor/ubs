@for ($i = 0; $i < $num; $i++)
    @if ($i != 0)
    @endif

    <div class="each_occupant_container">
        <div class="col-sm-12" style="{{ $i != 0 ? 'margin-top: 20px;' : '' }}">
            <h6><u>Occupant-{{ $i + 1 }} Details</u></h6>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_name">Name</label>
                <input class="form-control" name="occupant_name[]" type="text" id="occupant_name[]" required>
                <span class="error text-danger" id="occupant_name-error"></span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_gender_req">Gender</label>
                <select class="form-control" id="occupant_gender_req" name="occupant_gender_req[]" required>
                    <option selected="" value="">Select....</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Others</option>
                </select>
                <span class="error text-danger" id="occupant_gender_req-error"></span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_age">Age</label>
                <select class="form-control" id="occupant_age" name="occupant_age[]" required>
                    <option value="" selected>Select...</option>
                    @foreach (range(0, 99) as $age)
                        <option value="{{ $age }}">{{ $age }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_relationship">Relationship</label>
                <select class="form-control" id="occupant_relationship" name="occupant_relationship[]" required>
                    <option selected="" value="">Select....</option>
                    <option value="5">Contact Person(The person as the point of contact or responsible party.)
                    </option>
                    <option value="1">Family (Family member if relation is
                        Father/Mother/Son/Daughter/Brother/Sister/Husband/Wife)</option>
                    <option value="2">Relatives (Uncle/ Aunty/Cousin/ Brother-in-law/ Sister-in-law)</option>
                    <option value="3">Friends</option>
                    <option value="4">Others</option>
                </select>
                <span class="error text-danger" id="occupant_relationship-error"></span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_occupation">Profession</label>
                <select class="form-control" id="occupant_occupation_{{ $i }}"
                    onchange="showStudentInfo({{ $i }})" name="occupant_occupation[]" required>
                    <option selected="" value=0>Select....</option>
                    <option value="1">Student</option>
                    <option value="2">Employee</option>
                    <option value="3">Others</option>
                </select>
                <span class="error text-danger" id="occupant_occupation-error"></span>
            </div>
        </div>

        <div class="col-sm-12" id="have_job{{ $i }}" style="display: none;">
            <div class="form-group">
                <label for="occupant_job">Do you have job?</label>
                <select onchange="showJobInfo({{ $i }})" class="form-control"
                    id="occupant_job_{{ $i }}" name="occupant_job[]">
                    <option selected="" value="-1">Select....</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>

        <div id="job_info_{{ $i }}" style="display: none">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="occupant_job_type">Job Type</label>
                    <select class="form-control" id="occupant_job_type" name="occupant_job_type[]">
                        <option selected="" value="">Select....</option>
                        <option value="1">Part-time</option>
                        <option value="2">Full-time</option>
                        <option value="3">Self-employed</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="occupant_designation">Designation</label>
                    <input class="form-control" type="text" name="occupant_designation[]" id="occupant_designation">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="occupant_miat">Monthly income before tax</label>
                    <input class="form-control" name="occupant_miat[]" type="text" id="occupant_miat">
                </div>
            </div>
        </div>

        <div id="student_info_container_{{ $i }}" style="display: none;">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="occupant_university_name">University Name</label>
                    <input class="form-control" name="occupant_university_name[]" type="text"
                        id="occupant_university_name">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="occupant_degree_name">Degree Name</label>
                    <input class="form-control" name="occupant_degree_name[]" type="text"
                        id="occupant_degree_name">
                </div>
            </div>

        </div>


        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_pay_rent">Will he/she pay the rent?</label>
                <select class="form-control" id="occupant_pay_rent" name="occupant_pay_rent[]" required>
                    <option selected="" value="">Select....</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <span class="error text-danger" id="occupant_pay_rent-error"></span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_nationality">Nationality</label>
                {{-- <input class="form-control" name="occupant_nationality[]" type="text" id="occupant_nationality"> --}}

                <select class="form-control" id="occupant_nationality" name="occupant_nationality[]" required>
                    @include('partial.nationality')
                </select>
                <span class="error text-danger" id="occupant_nationality-error"></span>

            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_visa_status">Visa status</label>
                <select class="form-control" id="occupant_visa_status" name="occupant_visa_status[]">
                    <option selected="" value="">Select....</option>
                    <option value="Citizen">Citizen</option>
                    <option value="ILR">ILR</option>
                    <option value="Visit Visa">Visit Visa</option>
                    <option value="International student">International student</option>
                    <option value="Work permit">Work permit</option>
                    <option value="Others">Others</option>
                </select>
            </div>
        </div>
    </div>
@endfor

<script>
    function showStudentInfo(i) {
        var isStudent = $(`#occupant_occupation_${i}`).val();
        if (isStudent == 1) {
            $(`#student_info_container_${i}`).show();
        } else {
            $(`#student_info_container_${i}`).hide();
        }

        if (isStudent == 0) {
            console.log('Value check ' + isStudent);
            $(`#occupant_job_${i}`).val('0');

            $(`#have_job${i}`).hide();
            $(`#job_info_${i}`).hide();
        } else if (isStudent) {
            $(`#have_job${i}`).show();
        } else {
            $(`#have_job${i}`).hide();
        }

    }

    function showJobInfo(i) {
        var haveJob = $(`#occupant_job_${i}`).val();
        if (haveJob == 1) {
            $(`#job_info_${i}`).show();
        } else {
            $(`#job_info_${i}`).hide();
        }
    }
</script>
