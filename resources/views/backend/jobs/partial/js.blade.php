<script>
    $(document).ready(function() {
        function toggleSalaryFields() {
            const salaryType = $('#salary_type').val();

            if (salaryType === 'Fixed') {
                $('#fixed_amount_group').show().find('input').attr('required', true);
                $('#salary_range_group').hide().find('input').removeAttr('required').val(null);
            } else if (salaryType === 'Negotiable') {
                $('#fixed_amount_group').hide().find('input').removeAttr('required').val(null);
                $('#salary_range_group').show().find('input').attr('required', true);
            } else {
                $('#fixed_amount_group, #salary_range_group').hide().find('input').removeAttr('required').val(
                    null);
            }
        }

        function validateRange() {
            const fromAmount = parseFloat($('#from_amountField').val());
            const toAmount = parseFloat($('#to_amountField').val());

            if (toAmount && fromAmount && toAmount <= fromAmount) {
                $('#range-error').show();
                $('#to_amountField').val(null);
            } else {
                $('#range-error').hide();
            }
        }

        $('#salary_type').change(function() {
            toggleSalaryFields();
        });

        $('#to_amountField').on('change', function() {
            validateRange();
        });

        $('#from_amountField').on('change', function() {
            validateRange();
        });

        // Initial call to set the correct fields based on the old value if available
        toggleSalaryFields();
    });


    $(document).ready(function() {
        if ($("textarea#footer_details").length > 0) {
            tinymce.init({
                selector: "textarea#footer_details",
                height: 450,
            });
        }

        if ($("textarea#company-information").length > 0) {
            tinymce.init({
                selector: "textarea#company-information",
                height: 350,
            });
        }

        if ($("textarea#note").length > 0) {
            tinymce.init({
                selector: "textarea#note",
                height: 350,
            });
        }
    });
</script>
