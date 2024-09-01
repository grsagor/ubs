<script>
    $(document).ready(function() {

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
                url: '/shop-news-marketing/get-sub-categories/' + categoryId,
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
</script>
