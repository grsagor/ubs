<script>
    $(document).ready(function() {
        if ($("textarea#footer_details").length > 0) {
            tinymce.init({
                selector: "textarea#footer_details",
                height: 550,
            });
        }
    });
</script>
