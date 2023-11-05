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
                                <option value="{{ $age }}"
                                    {{ $property->age && $property->age[0] == $age ? 'selected' : '' }}>
                                    {{ $age }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-1" style="width: 5%">
                        <p class="text-center" style="font-size: 15px; margin-top: 5px;">To</p>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control" id="age" name="age[]"
                            {{ $property->age && $property->age[0] == $age ? 'selected' : '' }}>
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
                    <option {{ $property->occupation == 'Not disclosed' ? 'selected' : '' }} value="" selected=>
                        Not disclosed</option>
                    <option {{ $property->occupation == 'Student' ? 'selected' : '' }} value="Student">
                        Student</option>
                    <option {{ $property->occupation == 'Employee' ? 'selected' : '' }} value="Employee">
                        Employee</option>
                    <option {{ $property->occupation == 'Others' ? 'selected' : '' }} value="Others">
                        Others</option>
                    <option {{ $property->occupation == "I don't mind" ? 'selected' : '' }} value="I don't mind">I
                        don't mind</option>
                </select>
                <span class="error text-danger" id="occupation-error"></span>
            </div>
        </div>

        <div id="student_info_container">

        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="selling_price_group_id">Smoking?</label>
                <select class="form-control" id="smoking_current" name="smoking_current">
                    <option {{ $property->smoking_current == '2' ? 'selected' : '' }} value="2">no</option>
                    <option {{ $property->smoking_current == '1' ? 'selected' : '' }} value="1">yes</option>
                    <option {{ $property->smoking_current == "I don't mind" ? 'selected' : '' }} value="I don't mind">I
                        don't mind</option>
                </select>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="selling_price_group_id">Pets?</label>
                <select class="form-control" id="pets" name="pets">
                    <option {{ $property->pets == '2' ? 'selected' : '' }} value="2">no</option>
                    <option {{ $property->pets == '1' ? 'selected' : '' }} value="1">yes</option>
                    <option {{ $property->pets == "I don't mind" ? 'selected' : '' }} value="I don't mind">I don't mind
                    </option>
                </select>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="selling_price_group_id">Preferred sex</label>
                <select class="form-control" id="gay_lesbian" name="gay_lesbian">
                    <option {{ $property->gay_lesbian == 'Undisclosed' ? 'selected' : '' }} value="Undisclosed">
                        Undisclosed</option>
                    <option {{ $property->gay_lesbian == 'Straight' ? 'selected' : '' }} value="Straight">Straight
                    </option>
                    <option {{ $property->gay_lesbian == 'Gay/Lesbian' ? 'selected' : '' }} value="Gay/Lesbian">
                        Gay/Lesbian</option>
                    <option {{ $property->gay_lesbian == 'Bisexual' ? 'selected' : '' }} value="Bisexual">Bisexual
                    </option>
                    <option {{ $property->gay_lesbian == "I don't mind" ? 'selected' : '' }} value="I don't mind">I
                        don't mind</option>
                </select>
                <label class="form_input form_checkbox">
                    <input type="checkbox" name="gay_consent" value="1"
                        {{ $property->gay_consent == '1' ? 'checked' : '' }}>
                    Yes, Check this strictly
                </label>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="selling_price_group_id">Preferred language</label>
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
                    @foreach ($countries as $item)
                        <option {{ $property->nationality == $item ? 'selected' : '' }} value="{{ $item }}">
                            {{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @else
        <div class="col-sm-12">
            <div class="form-group">
                <label for="custom_field1">Advert title</label>
                <p class="sub-heading">(Short description)</p>
                <input class="form-control" placeholder="Short description maximum 92 characters" name="ad_title"
                    type="text" maxlength="100" id="ad_title" required value="{{ $property->ad_title }}">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="custom_field1">Description</label>
                <p class="sub-heading">(No contact details permitted within description)</p>
                <textarea rows="5" type="text" class="form-control" name="ad_text" class="input-field"
                    placeholder="Description" required>{{ $property->ad_text }}</textarea>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="custom_field1">Upload your profile picture</label>
                <input class="form-control" name="images" type="file" id="imageUpload--edit">
            </div>
            <div id="edit--imagePreview" class="w-100">
                @if ($property->images)
                @foreach ($property->images as $item)
                <img class="preview-image" src="{{ asset($item) }}" alt="">
                @endforeach
                    
                @endif
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="custom_field1">Telephone</label>
                <input class="form-control" placeholder="Telephone" name="tel" value="{{ $property->tel }}"
                    type="text" id="tel" required>
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

        $('#imageUpload--edit').on('change', function(e) {
            var files = e.target.files;
            var imagePreview = $('#edit--imagePreview');
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