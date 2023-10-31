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
<div class="col-sm-12">
    <div class="form-group">
        <label for="occupant_job">Do you have job?</label>
        <select class="form-control" id="occupant_job" name="occupant_job[]" required>
            <option selected="" value="">Select....</option>
            <option value="1">Part-time</option>
            <option value="2">Full-time</option>
            <option value="3">Self-employed</option>
        </select>
        <span class="error text-danger" id="occupant_job-error"></span>
    </div>
</div>