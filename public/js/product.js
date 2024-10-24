//This file contains all functions used products tab

$(document).ready(function () {
    $('#yearSelect').on('change', function () {
        console.log('Year select');
    });

    // Event listener for the Add button
    $('#addRequirement').on('click', function () {
        // Clone the first requirements section and append it to the container
        let clonedSection = $('.requirements-section:first').clone();

        // Disable options that are already selected in previous sections
        $('.requirements-section').each(function () {
            let selectedOption = $(this).find('.requirement-select').val();
            if (selectedOption) {
                clonedSection
                    .find('.requirement-select option[value="' + selectedOption + '"]')
                    .prop('disabled', true);
            }
        });

        $('#requirements-container').append(clonedSection);

        // Enable the "Remove" button after adding a section
        $('#removeRequirement').removeClass('hide');
    });

    // Event listener for the Remove button
    $('#removeRequirement').on('click', function () {
        // Remove the last requirements section
        if ($('.requirements-section').length > 1) {
            $('.requirements-section:last').remove();
        }

        // Disable the "Remove" button if there's only one section
        if ($('.requirements-section').length === 1) {
            $('#removeRequirement').addClass('hide');
        }
    });

    // On change of workPlacement Available
    $('#work_placement').on('change', function () {
        let workPlacementValue = $(this).val();
        if (workPlacementValue == 'Available') {
            $('#work-placement-description-section').removeClass('hide');
            $('#work-placement-description-clearfix').removeClass('hide');
        } else {
            $('#work-placement-description-section').addClass('hide');
            $('#work-placement-description-clearfix').addClass('hide');
        }
    });

    // On change of feeInstallment  Available
    $('#fee_installment').on('change', function () {
        let feeInstallment = $(this).val();
        if (feeInstallment == 'Available') {
            $('#fee-installment-description-section').removeClass('hide');
            $('#fee-installment-description-clearfix').removeClass('hide');
        } else {
            $('#fee-installment-description-section').addClass('hide');
            $('#fee-installment-description-clearfix').addClass('hide');
        }
    });

    // On change of feeInstallment  Available
    $('#course_module').on('change', function () {
        let feeInstallment = $(this).val();
        if (feeInstallment == 'Available') {
            $('#course-description-section').removeClass('hide');
        } else {
            $('#course-description-section').addClass('hide');
        }
    });

    // On change of resellingPrice  fixed or percentage validation
    $('#reselling_price').on('change', function () {
        let resellingPrice = $(this).val();

        if (resellingPrice === 'Percentage') {
            // Add validation for percentage (1-100)
            $('#resellingCommissionAmount').attr('max', 100);
            $('#resellingCommissionAmount').attr('min', 0);
            $('#resellingCommissionAmount').attr('type', 'number');

            $('#resellingCommissionAmountPercentageSection').removeClass('hide');
            $('#resellingCommissionAmountFixedSection').addClass('hide');
        } else if (resellingPrice === 'Fixed') {
            // Add validation for fixed amount (any)
            $('#resellingCommissionAmount').removeAttr('max');
            $('#resellingCommissionAmount').removeAttr('min');
            $('#resellingCommissionAmount').attr('type', 'number');
            $('#resellingCommissionAmountFixed').attr('min', 0);
            $('#resellingCommissionAmountFixedSection').removeClass('hide');
            $('#resellingCommissionAmountPercentageSection').addClass('hide');
        }
    });

    let resellingPrice = $('#reselling_price_edit').val();
    if (resellingPrice === 'Percentage') {
        $('#resellingCommissionAmountFixedSection').hide();
        $('#resellingCommissionAmountPercentageSection').show();
    } else if (resellingPrice === 'Fixed') {
        $('#resellingCommissionAmountFixedSection').show();
        $('#resellingCommissionAmountPercentageSection').hide();
    }

    $('#reselling_price_edit').on('change', function () {
        let resellingPrice = $(this).val();

        if (resellingPrice === 'Percentage') {
            $('#resellingCommissionAmountFixedSection').hide();
            $('#resellingCommissionAmountPercentageSection').show();
        } else if (resellingPrice === 'Fixed') {
            $('#resellingCommissionAmountFixedSection').show();
            $('#resellingCommissionAmountPercentageSection').hide();
        }
    });

    function toggleDescriptionVisibility() {
        if ($('#fee_installment_edit').val() === 'Available') {
            $('#fee-installment-description-section').removeClass('hide');
        } else {
            $('#fee-installment-description-section').addClass('hide');
        }
    }

    // Toggle visibility on page load
    toggleDescriptionVisibility();

    // Add onchange event listener to select element
    $('#fee_installment_edit').on('change', function () {
        toggleDescriptionVisibility();
    });

    // Function to toggle visibility based on selected option
    function toggleCourseDescriptionVisibility() {
        if ($('#course_module_edit').val() === 'Available') {
            $('#course-description-section').removeClass('hide');
        } else {
            $('#course-description-section').addClass('hide');
        }
    }

    // Toggle visibility on page load
    toggleCourseDescriptionVisibility();

    // Add onchange event listener to select element
    $('#course_module_edit').on('change', function () {
        toggleCourseDescriptionVisibility();
    });

    function toggleWorkPlacementDescriptionVisibility() {
        if ($('#work_placement_edit').val() === 'Available') {
            $('#work-placement-description-section').removeClass('hide');
        } else {
            $('#work-placement-description-section').addClass('hide');
        }
    }

    // Toggle visibility on page load
    toggleWorkPlacementDescriptionVisibility();

    // Add onchange event listener to select element
    $('#work_placement_edit').on('change', function () {
        toggleWorkPlacementDescriptionVisibility();
    });

    // Function to count words and check limit
    function countWordsAndCheckLimit() {
        var text = document.getElementById('define_this_item').value.trim();
        var charCount = text.length;

        document.getElementById('char_count').innerText = 'Character count: ' + charCount;

        // Check if word count exceeds limit
        if (charCount > 285) {
            document.getElementById('error_message_define_this_item').style.display = 'block';
            // Disable the button
            var buttons = document.querySelectorAll('.submit_product_form');
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].disabled = true;
            }
        } else {
            document.getElementById('error_message_define_this_item').style.display = 'none';
            // Enable all buttons
            var buttons = document.querySelectorAll('.submit_product_form');
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].disabled = false;
            }
        }
    }

    // On change of delivery area
    $('#delivery_area').on('change', function () {
        let deliveryArea = $(this).val();

        if (deliveryArea === 'National') {
            $('#delivery_cities_section').removeClass('hide');
            $('#delivery_countries_section').addClass('hide');

            $('#delivery_countries_excluded_section').addClass('hide');
        } else if (deliveryArea === 'International') {
            $('#delivery_cities_section').addClass('hide');
            $('#delivery_countries_section').removeClass('hide');

            $('#delivery_cities_excluded_section').addClass('hide');
        }
    });
    $('#delivery_cities').on('change', function () {
        let cityArea = $(this).val();
        if (cityArea === 'All Cities') {
            $('#delivery_cities_excluded_section').removeClass('hide');
        } else {
            $('#delivery_cities_excluded_section').addClass('hide');
        }
    });
    $('#delivery_countries').on('change', function () {
        let countryArea = $(this).val();
        if (countryArea === 'All Countries') {
            $('#delivery_countries_excluded_section').removeClass('hide');
        } else {
            $('#delivery_countries_excluded_section').addClass('hide');
            $('#delivery_countries_excluded_cities_section').addClass('hide');
        }
    });

    $('#delivery_excluded_countries').on('change', function () {
        $('#delivery_countries_excluded_cities_section').removeClass('hide');
    });

    $('#deliveryAreaWiseNational').on('change', function () {
        let selectedValue = $(this).val();
        var options = this.options;
        for (var i = 2; i < options.length; i++) {
            // options[i].disabled = false;  // Enable all options

            if (selectedValue === 'Excluding' || selectedValue === 'Including') {
                options[i].disabled = false; // Disable options if "Excluding" is selected
            }
        }
    });

    $(document).on('ifChecked', 'input#enable_stock', function () {
        $('div#alert_quantity_div').show();
        $('div#quick_product_opening_stock_div').show();

        //Enable expiry selection
        if ($('#expiry_period_type').length) {
            $('#expiry_period_type').removeAttr('disabled');
        }

        if ($('#opening_stock_button').length) {
            $('#opening_stock_button').removeAttr('disabled');
        }
    });
    $(document).on('ifUnchecked', 'input#enable_stock', function () {
        $('div#alert_quantity_div').hide();
        $('div#quick_product_opening_stock_div').hide();
        $('input#alert_quantity').val(0);

        //Disable expiry selection
        if ($('#expiry_period_type').length) {
            $('#expiry_period_type').val('').change();
            $('#expiry_period_type').attr('disabled', true);
        }
        if ($('#opening_stock_button').length) {
            $('#opening_stock_button').attr('disabled', true);
        }
    });

    //Start For product type single

    //If purchase price exc tax is changed
    $(document).on('change', 'input#single_dpp', function (e) {
        var purchase_exc_tax = __read_number($('input#single_dpp'));
        purchase_exc_tax = purchase_exc_tax == undefined ? 0 : purchase_exc_tax;

        var tax_rate = $('select#tax').find(':selected').data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        var purchase_inc_tax = __add_percent(purchase_exc_tax, tax_rate);
        __write_number($('input#single_dpp_inc_tax'), purchase_inc_tax);

        var profit_percent = __read_number($('#profit_percent'));
        var selling_price = __add_percent(purchase_exc_tax, profit_percent);
        var result = selling_price + (purchase_inc_tax - purchase_exc_tax);
        __write_number($('input#single_dsp'), result);

        var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
        __write_number($('input#single_dsp_inc_tax'), result);
    });

    //If tax rate is changed
    $(document).on('change', 'select#tax', function () {
        if ($('select#type').val() == 'single') {
            var purchase_exc_tax = __read_number($('input#single_dpp'));
            purchase_exc_tax = purchase_exc_tax == undefined ? 0 : purchase_exc_tax;

            var tax_rate = $('select#tax').find(':selected').data('rate');
            tax_rate = tax_rate == undefined ? 0 : tax_rate;

            var purchase_inc_tax = __add_percent(purchase_exc_tax, tax_rate);
            __write_number($('input#single_dpp_inc_tax'), purchase_inc_tax);

            var selling_price = __read_number($('input#single_dsp'));
            var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
            __write_number($('input#single_dsp_inc_tax'), selling_price_inc_tax);
        }

        var tax_rate = $('select#tax').find(':selected').data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        var purchase_exc_tax = __read_number($('#single_dpp'));
        var profit_percent = __read_number($('#profit_percent'));
        profit_percent = profit_percent == undefined ? 0 : profit_percent;

        var purchase_inc_tax = __add_percent(purchase_exc_tax, tax_rate);
        __write_number($('input#single_dpp_inc_tax'), purchase_inc_tax);

        var selling_price = __add_percent(purchase_exc_tax, profit_percent);
        var result = selling_price + (purchase_inc_tax - purchase_exc_tax);
        __write_number($('input#single_dsp'), result);
    });

    //If purchase price inc tax is changed
    $(document).on('change', 'input#single_dpp_inc_tax', function (e) {
        var purchase_inc_tax = __read_number($('input#single_dpp_inc_tax'));
        purchase_inc_tax = purchase_inc_tax == undefined ? 0 : purchase_inc_tax;

        var tax_rate = $('select#tax').find(':selected').data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        var purchase_exc_tax = __get_principle(purchase_inc_tax, tax_rate);
        __write_number($('input#single_dpp'), purchase_exc_tax);
        $('input#single_dpp').change();

        var profit_percent = __read_number($('#profit_percent'));
        profit_percent = profit_percent == undefined ? 0 : profit_percent;
        var selling_price = __add_percent(purchase_exc_tax, profit_percent);
        var result = selling_price + (purchase_inc_tax - purchase_exc_tax);
        __write_number($('input#single_dsp'), result);

        var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
        __write_number($('input#single_dsp_inc_tax'), result);
    });

    $(document).on('change', 'input#profit_percent', function (e) {
        var tax_rate = $('select#tax').find(':selected').data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        var purchase_inc_tax = __read_number($('input#single_dpp_inc_tax'));
        purchase_inc_tax = purchase_inc_tax == undefined ? 0 : purchase_inc_tax;

        var purchase_exc_tax = __read_number($('input#single_dpp'));
        purchase_exc_tax = purchase_exc_tax == undefined ? 0 : purchase_exc_tax;

        var profit_percent = __read_number($('input#profit_percent'));
        var selling_price = __add_percent(purchase_exc_tax, profit_percent);
        var result = selling_price + (purchase_inc_tax - purchase_exc_tax);
        __write_number($('input#single_dsp'), result);

        var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
        __write_number($('input#single_dsp_inc_tax'), result);
    });

    $(document).on('change', 'input#single_dsp', function (e) {
        var tax_rate = $('select#tax').find(':selected').data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        var selling_price = __read_number($('input#single_dsp'));
        var purchase_exc_tax = __read_number($('input#single_dpp'));
        var single_dpp_inc_tax = __read_number($('input#single_dpp_inc_tax'));
        var profit_percent = __read_number($('input#profit_percent'));

        //if purchase price not set
        if (purchase_exc_tax == 0) {
            profit_percent = 0;
        } else {
            profit_percent = ((selling_price - single_dpp_inc_tax) / purchase_exc_tax) * 100;
        }

        __write_number($('input#profit_percent'), profit_percent);

        var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
        __write_number($('input#single_dsp_inc_tax'), selling_price_inc_tax);
    });

    $(document).on('change', 'input#single_dsp_inc_tax', function (e) {
        var tax_rate = $('select#tax').find(':selected').data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;
        var selling_price_inc_tax = __read_number($('input#single_dsp_inc_tax'));

        var selling_price = __get_principle(selling_price_inc_tax, tax_rate);
        __write_number($('input#single_dsp'), selling_price);
        var purchase_exc_tax = __read_number($('input#single_dpp'));
        var profit_percent = __read_number($('input#profit_percent'));

        //if purchase price not set
        if (purchase_exc_tax == 0) {
            profit_percent = 0;
        } else {
            profit_percent = __get_rate(purchase_exc_tax, selling_price);
        }

        __write_number($('input#profit_percent'), profit_percent);
    });

    if ($('#product_add_form').length) {
        $('form#product_add_form').validate({
            rules: {
                sku: {
                    remote: {
                        url: '/products/check_product_sku',
                        type: 'post',
                        data: {
                            sku: function () {
                                return $('#sku').val();
                            },
                            product_id: function () {
                                if ($('#product_id').length > 0) {
                                    return $('#product_id').val();
                                } else {
                                    return '';
                                }
                            },
                        },
                    },
                },
                expiry_period: {
                    required: {
                        depends: function (element) {
                            return $('#expiry_period_type').val().trim() != '';
                        },
                    },
                },
            },
            messages: {
                sku: {
                    remote: LANG.sku_already_exists,
                },
            },
        });
    }

    $(document).on('click', '.submit_product_form', function (e) {
        e.preventDefault();

        var is_valid_product_form = true;

        var variation_skus = [];

        $('#product_form_part')
            .find('.input_sub_sku')
            .each(function () {
                var element = $(this);
                var row_variation_id = '';
                if ($(this).closest('tr').find('.row_variation_id')) {
                    row_variation_id = $(this).closest('tr').find('.row_variation_id').val();
                }

                variation_skus.push({
                    sku: element.val(),
                    variation_id: row_variation_id,
                });
            });

        if (variation_skus.length > 0) {
            $.ajax({
                method: 'post',
                url: '/products/validate_variation_skus',
                data: { skus: variation_skus },
                success: function (result) {
                    if (result.success == true) {
                        var submit_type = $(this).attr('value');
                        $('#submit_type').val(submit_type);
                        if ($('form#product_add_form').valid()) {
                            $('form#product_add_form').submit();
                        }
                    } else {
                        toastr.error(__translate('skus_already_exists', { sku: result.sku }));
                        return false;
                    }
                },
            });
        } else {
            var submit_type = $(this).attr('value');
            $('#submit_type').val(submit_type);
            if ($('form#product_add_form').valid()) {
                $('form#product_add_form').submit();
            }
        }
    });
    //End for product type single

    //Start for product type Variable
    //If purchase price exc tax is changed
    $(document).on('change', 'input.variable_dpp', function (e) {
        var tr_obj = $(this).closest('tr');

        var purchase_exc_tax = __read_number($(this));
        purchase_exc_tax = purchase_exc_tax == undefined ? 0 : purchase_exc_tax;

        var tax_rate = $('select#tax').find(':selected').data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        var purchase_inc_tax = __add_percent(purchase_exc_tax, tax_rate);
        __write_number(tr_obj.find('input.variable_dpp_inc_tax'), purchase_inc_tax);

        var profit_percent = __read_number(tr_obj.find('input.variable_profit_percent'));
        var selling_price = __add_percent(purchase_exc_tax, profit_percent);
        __write_number(tr_obj.find('input.variable_dsp'), selling_price);

        var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
        __write_number(tr_obj.find('input.variable_dsp_inc_tax'), selling_price_inc_tax);
    });

    //If purchase price inc tax is changed
    $(document).on('change', 'input.variable_dpp_inc_tax', function (e) {
        var tr_obj = $(this).closest('tr');

        var purchase_inc_tax = __read_number($(this));
        purchase_inc_tax = purchase_inc_tax == undefined ? 0 : purchase_inc_tax;

        var tax_rate = $('select#tax').find(':selected').data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        var purchase_exc_tax = __get_principle(purchase_inc_tax, tax_rate);
        __write_number(tr_obj.find('input.variable_dpp'), purchase_exc_tax);

        var profit_percent = __read_number(tr_obj.find('input.variable_profit_percent'));
        var selling_price = __add_percent(purchase_exc_tax, profit_percent);
        __write_number(tr_obj.find('input.variable_dsp'), selling_price);

        var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
        __write_number(tr_obj.find('input.variable_dsp_inc_tax'), selling_price_inc_tax);
    });

    $(document).on('change', 'input.variable_profit_percent', function (e) {
        var tax_rate = $('select#tax').find(':selected').data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        var tr_obj = $(this).closest('tr');
        var profit_percent = __read_number($(this));

        var purchase_exc_tax = __read_number(tr_obj.find('input.variable_dpp'));
        purchase_exc_tax = purchase_exc_tax == undefined ? 0 : purchase_exc_tax;

        var selling_price = __add_percent(purchase_exc_tax, profit_percent);
        __write_number(tr_obj.find('input.variable_dsp'), selling_price);

        var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
        __write_number(tr_obj.find('input.variable_dsp_inc_tax'), selling_price_inc_tax);
    });

    $(document).on('change', 'input.variable_dsp', function (e) {
        var tax_rate = $('select#tax').find(':selected').data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        var tr_obj = $(this).closest('tr');
        var selling_price = __read_number($(this));
        var purchase_exc_tax = __read_number(tr_obj.find('input.variable_dpp'));

        var profit_percent = __read_number(tr_obj.find('input.variable_profit_percent'));

        //if purchase price not set
        if (purchase_exc_tax == 0) {
            profit_percent = 0;
        } else {
            profit_percent = __get_rate(purchase_exc_tax, selling_price);
        }

        __write_number(tr_obj.find('input.variable_profit_percent'), profit_percent);

        var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
        __write_number(tr_obj.find('input.variable_dsp_inc_tax'), selling_price_inc_tax);
    });
    $(document).on('change', 'input.variable_dsp_inc_tax', function (e) {
        var tr_obj = $(this).closest('tr');
        var selling_price_inc_tax = __read_number($(this));

        var tax_rate = $('select#tax').find(':selected').data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        var selling_price = __get_principle(selling_price_inc_tax, tax_rate);
        __write_number(tr_obj.find('input.variable_dsp'), selling_price);

        var purchase_exc_tax = __read_number(tr_obj.find('input.variable_dpp'));
        var profit_percent = __read_number(tr_obj.find('input.variable_profit_percent'));
        //if purchase price not set
        if (purchase_exc_tax == 0) {
            profit_percent = 0;
        } else {
            profit_percent = __get_rate(purchase_exc_tax, selling_price);
        }

        __write_number(tr_obj.find('input.variable_profit_percent'), profit_percent);
    });

    $(document).on('click', '.add_variation_value_row', function () {
        var variation_row_index = $(this).closest('.variation_row').find('.row_index').val();
        var variation_value_row_index = $(this)
            .closest('table')
            .find('tr:last .variation_row_index')
            .val();

        if ($(this).closest('.variation_row').find('.row_edit').length >= 1) {
            var row_type = 'edit';
        } else {
            var row_type = 'add';
        }

        var table = $(this).closest('table');

        $.ajax({
            method: 'GET',
            url: '/products/get_variation_value_row',
            data: {
                variation_row_index: variation_row_index,
                value_index: variation_value_row_index,
                row_type: row_type,
            },
            dataType: 'html',
            success: function (result) {
                if (result) {
                    table.append(result);
                    toggle_dsp_input();
                }
            },
        });
    });
    $(document).on('change', '.variation_template_values', function () {
        var tr_obj = $(this).closest('tr');
        var val = $(this).val();
        tr_obj.find('.variation_value_row').each(function () {
            if (val.includes($(this).attr('data-variation_value_id'))) {
                $(this).removeClass('hide');
                $(this).find('.is_variation_value_hidden').val(0);
            } else {
                $(this).addClass('hide');
                $(this).find('.is_variation_value_hidden').val(1);
            }
        });
    });
    $(document).on('change', '.variation_template', function () {
        tr_obj = $(this).closest('tr');

        if ($(this).val() !== '') {
            tr_obj.find('input.variation_name').val($(this).find('option:selected').text());

            var template_id = $(this).val();
            var row_index = $(this).closest('tr').find('.row_index').val();
            $.ajax({
                method: 'POST',
                url: '/products/get_variation_template',
                dataType: 'json',
                data: { template_id: template_id, row_index: row_index },
                success: function (result) {
                    if (result) {
                        if (result.values.length > 0) {
                            tr_obj.find('.variation_template_values').select2();
                            tr_obj.find('.variation_template_values').empty();
                            tr_obj
                                .find('.variation_template_values')
                                .select2({ data: result.values, closeOnSelect: false });
                            tr_obj.find('.variation_template_values_div').removeClass('hide');
                            tr_obj.find('.variation_template_values').select2('open');
                        } else {
                            tr_obj.find('.variation_template_values_div').addClass('hide');
                        }
                        tr_obj.find('table.variation_value_table').find('tbody').html(result.html);

                        toggle_dsp_input();
                    }
                },
            });
        }
    });

    $(document).on('click', '.remove_variation_value_row', function () {
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var count = $(this).closest('table').find('.remove_variation_value_row').length;
                if (count === 1) {
                    $(this).closest('.variation_row').remove();
                } else {
                    $(this).closest('tr').remove();
                }
            }
        });
    });

    //If tax rate is changed
    $(document).on('change', 'select#tax', function () {
        if ($('select#type').val() == 'variable') {
            var tax_rate = $('select#tax').find(':selected').data('rate');
            tax_rate = tax_rate == undefined ? 0 : tax_rate;

            $('table.variation_value_table > tbody').each(function () {
                $(this)
                    .find('tr')
                    .each(function () {
                        var purchase_exc_tax = __read_number($(this).find('input.variable_dpp'));
                        purchase_exc_tax = purchase_exc_tax == undefined ? 0 : purchase_exc_tax;

                        var purchase_inc_tax = __add_percent(purchase_exc_tax, tax_rate);
                        __write_number(
                            $(this).find('input.variable_dpp_inc_tax'),
                            purchase_inc_tax
                        );

                        var selling_price = __read_number($(this).find('input.variable_dsp'));
                        var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
                        __write_number(
                            $(this).find('input.variable_dsp_inc_tax'),
                            selling_price_inc_tax
                        );
                    });
            });
        }
    });
    //End for product type Variable
    $(document).on('change', '#tax_type', function (e) {
        toggle_dsp_input();
    });
    toggle_dsp_input();

    $(document).on('change', '#expiry_period_type', function (e) {
        if ($(this).val()) {
            $('input#expiry_period').prop('disabled', false);
        } else {
            $('input#expiry_period').val('');
            $('input#expiry_period').prop('disabled', true);
        }
    });

    $(document).on('click', 'a.view-product', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            dataType: 'html',
            success: function (result) {
                $('#view_product_modal').html(result).modal('show');
                __currency_convert_recursively($('#view_product_modal'));
            },
        });
    });
    var img_fileinput_setting = {
        showUpload: false,
        showPreview: true,
        browseLabel: LANG.file_browse_label,
        removeLabel: LANG.remove,
        previewSettings: {
            image: {
                width: 'auto',
                height: 'auto',
                'max-width': '100%',
                'max-height': '100%',
            },
        },
    };
    $('#upload_image').fileinput(img_fileinput_setting);

    $('#thumbnail_image').fileinput(img_fileinput_setting);

    $('#brochure_image').fileinput(img_fileinput_setting);

    if ($('textarea#product_description').length > 0) {
        tinymce.init({
            selector: 'textarea#product_description',
            height: 250,
        });
    }

    if ($('textarea#requirement_details').length > 0) {
        tinymce.init({
            selector: 'textarea#requirement_details',
            height: 250,
        });
    }
    if ($('textarea#service_features').length > 0) {
        tinymce.init({
            selector: 'textarea#service_features',
            height: 250,
        });
    }
    if ($('textarea#experiences').length > 0) {
        tinymce.init({
            selector: 'textarea#experiences',
            height: 250,
        });
    }
    if ($('textarea#specializations').length > 0) {
        tinymce.init({
            selector: 'textarea#specializations',
            height: 250,
        });
    }
    if ($('textarea#work_placement_description').length > 0) {
        tinymce.init({
            selector: 'textarea#work_placement_description',
            height: 250,
        });
    }
    if ($('textarea#fee_installment_description').length > 0) {
        tinymce.init({
            selector: 'textarea#fee_installment_description',
            height: 250,
        });
    }
    if ($('textarea#course_module_description').length > 0) {
        tinymce.init({
            selector: 'textarea#course_module_description',
            height: 250,
        });
    }
    if ($('textarea#general_facilities').length > 0) {
        tinymce.init({
            selector: 'textarea#general_facilities',
            height: 250,
        });
    }
    if ($('textarea#policy').length > 0) {
        tinymce.init({
            selector: 'textarea#policy',
            height: 250,
        });
    }
    if ($('textarea#refund_policy').length > 0) {
        tinymce.init({
            selector: 'textarea#refund_policy',
            height: 250,
        });
    }
});

function toggle_dsp_input() {
    var tax_type = $('#tax_type').val();
    if (tax_type == 'inclusive') {
        $('.dsp_label').each(function () {
            $(this).text(LANG.inc_tax);
        });
        $('#single_dsp').addClass('hide');
        $('#single_dsp_inc_tax').removeClass('hide');

        $('.add-product-price-table')
            .find('.variable_dsp_inc_tax')
            .each(function () {
                $(this).removeClass('hide');
            });
        $('.add-product-price-table')
            .find('.variable_dsp')
            .each(function () {
                $(this).addClass('hide');
            });
    } else if (tax_type == 'exclusive') {
        $('.dsp_label').each(function () {
            $(this).text(LANG.exc_tax);
        });
        $('#single_dsp').removeClass('hide');
        $('#single_dsp_inc_tax').addClass('hide');

        $('.add-product-price-table')
            .find('.variable_dsp_inc_tax')
            .each(function () {
                $(this).addClass('hide');
            });
        $('.add-product-price-table')
            .find('.variable_dsp')
            .each(function () {
                $(this).removeClass('hide');
            });
    }
}

function get_product_details(rowData) {
    var div = $('<div/>').addClass('loading').text('Loading...');

    $.ajax({
        url: '/products/' + rowData.id,
        dataType: 'html',
        success: function (data) {
            div.html(data).removeClass('loading');
        },
    });

    return div;
}

//Quick add unit
$(document).on('submit', 'form#quick_add_unit_form', function (e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();

    $.ajax({
        method: 'POST',
        url: $(this).attr('action'),
        dataType: 'json',
        data: data,
        beforeSend: function (xhr) {
            __disable_submit_button(form.find('button[type="submit"]'));
        },
        success: function (result) {
            if (result.success == true) {
                var newOption = new Option(result.data.short_name, result.data.id, true, true);
                // Append it to the select
                $('#unit_id').append(newOption).trigger('change');
                $('div.view_modal').modal('hide');
                toastr.success(result.msg);
            } else {
                toastr.error(result.msg);
            }
        },
    });
});

//Quick add brand
$(document).on('submit', 'form#quick_add_brand_form', function (e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();

    $.ajax({
        method: 'POST',
        url: $(this).attr('action'),
        dataType: 'json',
        data: data,
        beforeSend: function (xhr) {
            __disable_submit_button(form.find('button[type="submit"]'));
        },
        success: function (result) {
            if (result.success == true) {
                var newOption = new Option(result.data.name, result.data.id, true, true);
                // Append it to the select
                $('#brand_id').append(newOption).trigger('change');
                $('div.view_modal').modal('hide');
                toastr.success(result.msg);
            } else {
                toastr.error(result.msg);
            }
        },
    });
});

$(document).on('click', 'button.apply-all', function () {
    var val = $(this).closest('.input-group').find('input').val();
    var target_class = $(this).data('target-class');
    $(this)
        .closest('tbody')
        .find('tr')
        .each(function () {
            element = $(this).find(target_class);
            element.val(val);
            element.change();
        });
});
