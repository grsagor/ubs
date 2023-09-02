@for ($i = 0; $i < $num; $i++)
    <div class="each_occupant_container">
        <h6>Occupant-{{ $i + 1 }} Details</h6>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_name">Name</label>
                <input class="form-control" name="occupant_name[]" type="text" id="occupant_name">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_gender_req">Gender</label>
                <select class="form-control" id="occupant_gender_req" name="occupant_gender_req[]">
                    <option selected="" value="">Select....</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Others</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_age">Age Range</label>
                <select class="form-control" id="occupant_age" name="occupant_age[]">
                    <option value="" selected>Select...</option>
                    @foreach (range(18, 99) as $age)
                        <option value="{{ $age }}">{{ $age }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_relationship">Relationship</label>
                <select class="form-control" id="occupant_relationship" name="occupant_relationship[]">
                    <option selected="" value="">Select....</option>
                    <option value="1">Family (Family member if relation is
                        Father/Mother/Son/Daughter/Brother/Sister/Husband/Wife)</option>
                    <option value="2">Relatives (Uncle/ Aunty/Cousin/ Brother-in-law/ Sister-in-law)</option>
                    <option value="3">Friends</option>
                    <option value="4">Others</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_occupation">Job</label>
                <select class="form-control" id="occupant_occupation_{{ $i }}"
                    onchange="showStudentInfo({{ $i }})" name="occupant_occupation[]">
                    <option selected="" value="">Select....</option>
                    <option value="1">Student</option>
                    <option value="2">Employee</option>
                    <option value="3">Others</option>
                </select>
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
                    <input class="form-control" name="occupant_degree_name[]" type="text" id="occupant_degree_name">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="occupant_job">Do you have job?</label>
                    <select class="form-control" id="occupant_job" name="occupant_job[]">
                        <option selected="" value="">Select....</option>
                        <option value="1">Part-time</option>
                        <option value="2">Full-time</option>
                        <option value="3">Self-employed</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_miat">Monthly income after tax</label>
                <input class="form-control" name="occupant_miat[]" type="text" id="occupant_miat">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_pay_rent">Will he/she pay the rent?</label>
                <select class="form-control" id="occupant_pay_rent" name="occupant_pay_rent[]">
                    <option selected="" value="">Select....</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_nationality">Nationality</label>
                <input class="form-control" name="occupant_nationality[]" type="text" id="occupant_nationality">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_visa_status">Visa status</label>
                <select class="form-control" id="occupant_visa_status" name="occupant_visa_status[]">
                    <option selected="" value="">Select....</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
    </div>
@endfor

<script>
    function showStudentInfo(i) {
        var isStudent = $(`#occupant_occupation_${i}`).val();
        if (isStudent == 1) {
            $(`#student_info_container_${i} input, #student_info_container_${i} select, #student_info_container_${i} textarea`)
                .prop('disabled', false);
            $(`#student_info_container_${i}`).show();
        } else {
            $(`#student_info_container_${i} input, #student_info_container_${i} select, #student_info_container_${i} textarea`)
                .prop('disabled', true);
            $(`#student_info_container_${i}`).hide();
        }
    }
</script>

{{-- 
occupant_
Name:
Gender:
Age: 
Relationship: 1. Family (Family member if relation is Father/Mother/Son/Daughter/Brother/Sister/Husband/Wife)
2.	Relatives: Uncle/ Aunty/Cousin/ Brother-in-law/ Sister-in-law 
3.	Friends
4.	Others 
Occupation: Student/Employee/others
University name: (if student)
Degree name: (if student)
Do you have job? (if student): Part-time/full-time/self-employed
Monthly income after tax:
Will he/she pay the rent? 
Nationality:
Visa status: (if nationality is not similar with property country)




Visa expiry date: (if nationality is not similar with property country) (no need)

--}}
