<script>
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

    // Call categoryChanged on page load if a category is already selected (for edit page)
    $(document).ready(function() {

        if ($('#category_id').val()) {
            console.log('Hello');
            categoryChanged();
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

        $("#upload_image_business_location").fileinput(img_fileinput_setting);

    });
</script>
