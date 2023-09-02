@for ($i = 0; $i < $num; $i++)
    <div>
        <h6>Occupant-{{ $i + 1 }} Details</h6>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_name">Name</label>
                <input class="form-control" name="occupant_name" type="text" id="occupant_name">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_gender_req">Gender</label>
                <select class="form-control" id="occupant_gender_req" name="occupant_gender_req">
                    <option selected="" value="">Select....</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Others</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="">Age Range</label>
                <div style="display: flex;">
                    <div class="">
                        <select class="form-control" id="occupant_min_age_req" name="occupant_min_age_req">
                            <option value="" selected>Select...</option>
                            @foreach (range(18, 99) as $age)
                                <option value="{{ $age }}">
                                    {{ $age }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center; flex-direction:column;"><span style="margin-bottom: 15px;">to</span></div>
                    <div class="">
                        <select class="form-control" id="occupant_max_age_req" name="occupant_max_age_req">
                            <option value="" selected>Select...</option>
                            @foreach (range(18, 99) as $age)
                                <option value="{{ $age }}">
                                    {{ $age }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_relationship">Relationship</label>
                <select class="form-control" id="occupant_relationship" name="occupant_relationship">
                    <option selected="" value="">Select....</option>
                    <option value="1">Family (Family member if relation is Father/Mother/Son/Daughter/Brother/Sister/Husband/Wife)</option>
                    <option value="2">Relatives (Uncle/ Aunty/Cousin/ Brother-in-law/ Sister-in-law)</option>
                    <option value="3">Friends</option>
                    <option value="4">Others</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="occupant_occupation">Relationship</label>
                <select class="form-control" id="occupant_occupation" name="occupant_occupation">
                    <option selected="" value="">Select....</option>
                    <option value="1">Student</option>
                    <option value="2">Employee</option>
                    <option value="3">Others</option>
                </select>
            </div>
        </div>
        <div class="student_info_container">
            

        </div>
    </div>
@endfor

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
