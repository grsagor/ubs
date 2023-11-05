<fieldset>
    @if ($child_category == 11)
        <h4 class="modal-title" style="padding: 12px;">Your Household preferences</h4>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="invoice_scheme_id">Age range</label>
                <div class="row">
                    <div class="col-sm-4">
                        <select class="form-control" id="age" name="age[]">
                            <option value="">Select...</option>
                            @foreach (range(18, 99) as $age)
                                <option value="{{ $age }}">
                                    {{ $age }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-1" style="width: 5%">
                        <p class="text-center" style="font-size: 15px; margin-top: 5px;">To</p>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control" id="age" name="age[]">
                            <option value="">Select...</option>
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
                <label for="selling_price_group_id">Occupation</label>
                <select class="form-control" id="occupation" name="occupation" required>
                    <option value="">Not disclosed</option>
                    <option value="Student">Student</option>
                    <option value="Employee">Employee</option>
                    <option value="Others">Others</option>
                    <option value="I don't mind">I don't mind</option>
                </select>
                <span class="error text-danger" id="occupation-error--property_wanted_create"></span>
            </div>
        </div>

        <div id="student_info_container">

        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="selling_price_group_id">Smoking?</label> <i
                    class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                    data-toggle="popover" data-placement="auto bottom"
                    data-content="This price group will be used as the default price group in this location."
                    data-html="true" data-trigger="hover"></i> <select class="form-control" id="smoking_current"
                    name="smoking_current">
                    <option value="2">no</option>
                    <option value="1">yes</option>
                    <option value="I don't mind">I don't mind</option>
                </select>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="selling_price_group_id">Pets?</label> <i
                    class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                    data-toggle="popover" data-placement="auto bottom"
                    data-content="This price group will be used as the default price group in this location."
                    data-html="true" data-trigger="hover"></i> <select class="form-control" id="pets"
                    name="pets">
                    <option value="2">no</option>
                    <option value="1">yes</option>
                    <option value="I don't mind">I don't mind</option>
                </select>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="selling_price_group_id">Preferred sex</label> <i
                    class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                    data-toggle="popover" data-placement="auto bottom"
                    data-content="This price group will be used as the default price group in this location."
                    data-html="true" data-trigger="hover"></i> <select class="form-control" id="gay_lesbian"
                    name="gay_lesbian">
                    <option value="Undisclosed">
                        Undisclosed
                    </option>
                    <option value="Straight">Straight</option>
                    <option value="Gay/Lesbian">Gay/Lesbian</option>
                    <option value="Bisexual">Bisexual</option>
                    <option value="I don't mind">I don't mind</option>
                </select>
                <label class="form_input form_checkbox">
                    <input type="checkbox" name="gay_consent" value="1">
                    Yes, Check this strictly
                </label>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="selling_price_group_id">Preferred language</label> <i
                    class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                    data-toggle="popover" data-placement="auto bottom"
                    data-content="This price group will be used as the default price group in this location."
                    data-html="true" data-trigger="hover"></i>
                <select class="form-control" id="lang_id" name="lang_id">

                    @include('partial.language')

                </select>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="selling_price_group_id">Preferred nationality</label> <i
                    class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body"
                    data-toggle="popover" data-placement="auto bottom"
                    data-content="This price group will be used as the default price group in this location."
                    data-html="true" data-trigger="hover"></i>
                <select class="form-control" id="nationality" name="nationality">

                    <option value="---">Select country</option>
                    @include('partial.nationality')

                </select>
            </div>
        </div>
    @else
        <div class="col-sm-12">
            <div class="form-group">
                <label for="custom_field1">Advert title</label>
                <p class="sub-heading">(Short description)</p>
                <input class="form-control" placeholder="Short description maximum 92 characters" name="ad_title"
                    type="text" maxlength="100" id="ad_title" required>
                <span class="error text-danger" id="ad_title-error--property_wanted_create"></span>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="custom_field1">Description</label>
                <p class="sub-heading">(No contact details permitted within description)</p>
                <textarea rows="5" type="text" class="form-control" name="ad_text" class="input-field"
                    placeholder="Description" required></textarea>
                <span class="error text-danger" id="ad_text-error--property_wanted_create"></span>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="custom_field1">Upload your profile picture</label>
                <input class="form-control" name="images" type="file" id="imageUpload--create" required>
            </div>
            <div id="create--imagePreview" class="w-100"></div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="custom_field1">Telephone</label>
                <input class="form-control" placeholder="Telephone" name="tel" type="text" id="tel"
                    required>
                <span class="error text-danger" id="tel-error--property_wanted_create"></span>
            </div>
        </div>

    @endif
</fieldset>

<script>
    $(document).ready(function() {
        $('#occupation').change(function() {
            console.log('changed');
            var isStudent = $(this).val();
            if (isStudent == 'Student') {
                $.ajax({
                    url: "/contact/show-student-info-container-create",
                    type: "get",
                    dataType: "json",
                    success: function(data) {
                        $('#student_info_container').empty()
                        $('#student_info_container').html(data.html)
                    }
                });
            } else {
                $('#student_info_container').empty()
            }
        });

        $('#imageUpload--create').on('change', function(e) {
            var files = e.target.files;
            var imagePreview = $('#create--imagePreview');
            imagePreview.empty();

            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var image = $('<img>')
                        .addClass('preview-image') 
                        .attr('src', e.target.result)
                    imagePreview.append(image);
                };
                reader.readAsDataURL(files[i]);
            }
        });
    })
</script>
<style>
    .preview-image {
        width: 20%;
    }
</style>