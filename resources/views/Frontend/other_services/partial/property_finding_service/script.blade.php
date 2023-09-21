<script>
    const $regularPrice = $('#regular_price_room_tab3');
    const $premiumPrice = $('#premium_price_room_tab3');
    const $tableRoom = $('#table_room_tab3').hide();

    const $roomRegularProductid = $('#room_regular_product_id');
    const $roomRegularProductName = $('#room_regular_product_name');
    const $roomRegularProductBill = $('#room_regular_product_bill');

    const $roomPremiumProductid = $('#room_premium_product_id');
    const $roomPremiumProductName = $('#room_premium_product_name');
    const $roomPremiumProductBill = $('#room_premium_product_bill');

    $('#regular_price_room_tab3, #premium_price_room_tab3').hide();

    $('#child_category_id_room_tab3').on('change', function(e) {
        e.preventDefault();

        $regularPrice.hide();
        $premiumPrice.hide();
        $tableRoom.hide();

        let id = $(this).val();

        if (id != 0) {
            $.ajax({
                url: '/property-finding-sevice-charge/' + id,
                type: 'get',
                success: (result) => {
                    if (result.service_charge) {
                        const serviceCharge = result.service_charge.service_charge.toFixed(2);
                        $regularPrice.text(`£${serviceCharge}`).show();

                        const premiumServiceCharge = (serviceCharge * 1.7).toFixed(2);
                        $premiumPrice.text(`£${premiumServiceCharge}`).show();

                        $tableRoom.show();

                        if (id == 1) {
                            $roomRegularProductid.val(id);
                            $roomRegularProductName.val('Room-single Regular');
                            $roomRegularProductBill.val(serviceCharge);

                            $roomPremiumProductid.val(id);
                            $roomPremiumProductName.val('Room-single Premium');
                            $roomPremiumProductBill.val(premiumServiceCharge);
                        }

                        if (id == 2) {
                            $roomRegularProductid.val(id);
                            $roomRegularProductName.val('Room-double Regular');
                            $roomRegularProductBill.val(serviceCharge);

                            $roomPremiumProductid.val(id);
                            $roomPremiumProductName.val('Room-double Premium');
                            $roomPremiumProductBill.val(premiumServiceCharge);
                        }

                        if (id == 6) {
                            $roomRegularProductid.val(id);
                            $roomRegularProductName.val('Room-semi-double Regular');
                            $roomRegularProductBill.val(serviceCharge);

                            $roomPremiumProductid.val(id);
                            $roomPremiumProductName.val('Room-semi-double Premium');
                            $roomPremiumProductBill.val(premiumServiceCharge);
                        }

                        if (id == 7) {
                            $roomRegularProductid.val(id);
                            $roomRegularProductName.val('Room-en-suit Regular');
                            $roomRegularProductBill.val(serviceCharge);

                            $roomPremiumProductid.val(id);
                            $roomPremiumProductName.val('Room-en-suit Premium');
                            $roomPremiumProductBill.val(premiumServiceCharge);
                        }
                    }
                }
            });
        }
    });
</script>
