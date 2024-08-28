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
</script>
