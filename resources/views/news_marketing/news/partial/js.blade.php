<script>
    $(document).ready(function() {
        function previewThumbnail(input) {
            var preview = $('#thumbnail-preview')[0];
            var file = input.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }


        function previewImages(input) {
            var previewContainer = $('#image-preview-container');

            previewContainer.empty(); // Clear previous previews

            var files = input.files;

            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail').css(
                        'max-width',
                        '100%');
                    previewContainer.append(img);
                };

                reader.readAsDataURL(file);
            }
        }
        if ($("textarea#footer_details").length > 0) {
            tinymce.init({
                selector: "textarea#footer_details",
                height: 550,
            });
        }
    });


    function categoryChanged() {
        var categoryId = document.getElementById('category_id').value;

        if (categoryId) {
            $.ajax({
                url: '/get_sub_category/' + categoryId,
                method: 'GET',
                success: function(response) {
                    var subcategorySelect = $('#subcategory_id');
                    subcategorySelect.empty();
                    subcategorySelect.append('<option value="">Select</option>');

                    if (response.subcategories.length > 0) {
                        $('#subcategory_required_asterisk').show();
                        $('#subcategory_id').prop('required', true);
                        response.subcategories.forEach(function(subcategory) {
                            var selected = subcategory.id ==
                                '{{ old('subcategory') ?? ($location->subcategory ?? '') }}' ?
                                ' selected' : '';
                            subcategorySelect.append('<option value="' + subcategory.id + '"' +
                                selected + '>' +
                                subcategory.name + '</option>');
                        });
                    } else {
                        $('#subcategory_required_asterisk').hide();
                        $('#subcategory_id').prop('required', false);
                    }
                },
                error: function(error) {
                    console.error('Error fetching subcategories:', error);
                }
            });
        } else {
            $('#subcategory_id').empty();
            $('#subcategory_id').append('<option value="">Select</option>');
            $('#subcategory_required_asterisk').hide();
            $('#subcategory_id').prop('required', false);
        }
    }

    var img_fileinput_setting = {
        showUpload: false,
        showPreview: true,
        browseLabel: LANG.file_browse_label,
        removeLabel: LANG.remove,
        previewSettings: {
            image: {
                width: "auto",
                height: "auto",
                "max-width": "100%",
                "max-height": "100%",
            },
        },
    };
    $("#thumbnail_image").fileinput(img_fileinput_setting);
    $("#galary_image").fileinput(img_fileinput_setting);
</script>
