<script>
    $(document).ready(function() {
        $(".step:not(:first)").hide(); // Hide all steps except the first one

        $(".next-btn").click(function() {
            var parentDiv = $(this).parent();
            if (parentDiv.hasClass('next-prev-btn-container')) {
                var a = $(this).parent();
                a.parent().hide().next().show();
            } else {
                $(this).parent().hide().next().show();
            }
        });

        $(".prev-btn").click(function() {
            var parentDiv = $(this).parent();
            parentDiv.parent().hide().prev().show();
        });
    });


    // Get the input element by its ID
    var roomAvailableFromInput = document.getElementById('room_available_from');

    // Get the current date in the format YYYY-MM-DD
    var currentDate = new Date().toISOString().split('T')[0];

    // Set the min attribute of the input to the current date
    roomAvailableFromInput.min = currentDate;

    $(document).ready(function() {
        // Show "Room 1" by default
        $("#room1").show();

        // Hide additional rooms initially
        $(".form_room_fieldset:not(#room1)").hide();

        // Show the selected number of additional rooms
        $("#step_2_next").click(function() {

            var child_category = $('#child_category_id').val();

            if (child_category == 1) {
                var selectedQuantity = parseInt($('#property_room_quantity').val());
                $(".form_room_fieldset:not(#room1)").hide();
                for (var i = 2; i <= selectedQuantity; i++) {
                    $("#room" + i).show();
                }
            } else if (child_category == 9) {
                var selectedQuantity = 1;
                $(".form_room_fieldset:not(#room1)").hide();
                for (var i = 2; i <= selectedQuantity; i++) {
                    $("#room" + i).show();
                }
            } else {
                var selectedQuantity = parseInt($('#property_size').val());

                $(".form_room_fieldset:not(#room1)").hide();
                for (var i = 2; i <= selectedQuantity; i++) {
                    $("#room" + i).show();
                }
            }

        });



        // Show the selected number of additional rooms
        // $("#property_size").change(function() {
        //     var selectedQuantity = parseInt($(this).val());
        //     $(".form_room_fieldset:not(#room1)").hide();
        //     for (var i = 2; i <= selectedQuantity; i++) {
        //         $("#room" + i).show();
        //     }
        // });

    });



    $(document).ready(function() {

        var house = @json($house);
        var flat = @json($Flat);
        var studio_flat = @json($studio_flat);
        var single = @json($single);
        var double = @json($double);
        var semi_double = @json($semi_double);
        var en_suite = @json($en_suite);

        $(document).on('click', '#step_3_next_btn', function() {
            var size1 = $("input[name='room_size1']:checked").val();
            var size2 = $("input[name='room_size2']:checked").val();
            var size3 = $("input[name='room_size3']:checked").val();
            var size4 = $("input[name='room_size4']:checked").val();
            var size5 = $("input[name='room_size5']:checked").val();
            var child_category = $('#child_category_id').val();
            if (child_category == 1) {
                if (size1 == 1) {
                    $('#service_charge_room1').val(single)
                }
                if (size1 == 2) {
                    $('#service_charge_room1').val(double)
                }
                if (size1 == 3) {
                    $('#service_charge_room1').val(semi_double)
                }

                if (size2 == 1) {
                    $('#service_charge_room2').val(single)
                }
                if (size2 == 2) {
                    $('#service_charge_room2').val(double)
                }
                if (size2 == 3) {
                    $('#service_charge_room2').val(semi_double)
                }

                if (size3 == 1) {
                    $('#service_charge_room3').val(single)
                }
                if (size3 == 2) {
                    $('#service_charge_room3').val(double)
                }
                if (size3 == 3) {
                    $('#service_charge_room3').val(semi_double)
                }

                if (size4 == 1) {
                    $('#service_charge_room4').val(single)
                }
                if (size4 == 2) {
                    $('#service_charge_room4').val(double)
                }
                if (size4 == 3) {
                    $('#service_charge_room4').val(semi_double)
                }

                if (size5 == 1) {
                    $('#service_charge_room5').val(single)
                }
                if (size5 == 2) {
                    $('#service_charge_room5').val(double)
                }
                if (size5 == 3) {
                    $('#service_charge_room5').val(semi_double)
                }
            }
            if (child_category == 2) {
                $('#service_charge_room').val(house)
            }
            if (child_category == 6) {
                $('#service_charge_room').val(flat)
            }
            if (child_category == 9) {
                $('#service_charge_room').val(studio_flat)
            }
        })

        $(document).on('change', '#child_category_id', function() {
            var child_category_id = $(this).val();
            var sub_category_id = $('#sub_category_id').val();
            var service_category_id = $('#service_category_id').val();
            //alert(child_category_id);

            var a = document.getElementById('badOption');
            var b = document.getElementById('showroom');
            var c = document.getElementById('room_available_from_container');

            var d_1 = document.getElementById('room_available_from1_container');
            var d_2 = document.getElementById('room_available_from2_container');
            var d_3 = document.getElementById('room_available_from3_container');
            var d_4 = document.getElementById('room_available_from4_container');
            var d_5 = document.getElementById('room_available_from5_container');

            var e_1 = document.getElementById('size_of_room1');
            var e_2 = document.getElementById('size_of_room2');
            var e_3 = document.getElementById('size_of_room3');
            var e_4 = document.getElementById('size_of_room4');
            var e_5 = document.getElementById('size_of_room5');

            var f_1 = document.getElementById('room_amenities_id1');
            var f_2 = document.getElementById('room_amenities_id2');
            var f_3 = document.getElementById('room_amenities_id3');
            var f_4 = document.getElementById('room_amenities_id4');
            var f_5 = document.getElementById('room_amenities_id5');

            var g_1 = document.getElementById('room_security_deposit_id1');
            var g_2 = document.getElementById('room_security_deposit_id2');
            var g_3 = document.getElementById('room_security_deposit_id3');
            var g_4 = document.getElementById('room_security_deposit_id4');
            var g_5 = document.getElementById('room_security_deposit_id5');

            var h_1 = document.getElementById('room_cost_id1');
            var h_2 = document.getElementById('room_cost_id2');
            var h_3 = document.getElementById('room_cost_id3');
            var h_4 = document.getElementById('room_cost_id4');
            var h_5 = document.getElementById('room_cost_id5');

            var i = document.getElementById('rent_id');
            var j = document.getElementById('security_Deposit_id');
            var k = document.getElementById('holding_deposit_id');

            var m_1 = document.getElementById('room_holding_deposit_id1');
            var m_2 = document.getElementById('room_holding_deposit_id2');
            var m_3 = document.getElementById('room_holding_deposit_id3');
            var m_4 = document.getElementById('room_holding_deposit_id4');
            var m_5 = document.getElementById('room_holding_deposit_id5');

            var p = document.getElementById('existing_flatmate_id');


            // child_category_id means category 1 = Room
            // child_category_id means category 2 = House
            // child_category_id means category 6 = Flat
            // child_category_id means category 9 = Studio Flat

            if (child_category_id == 2 || child_category_id == 6 || child_category_id == 1) {
                a.style.display = 'block';
            } else {
                a.style.display = 'none';
            }
            if (child_category_id == 1) {
                b.style.display = 'block';
                c.style.display = 'none';
                i.style.display = 'none';
                j.style.display = 'none';
                k.style.display = 'none';
                p.style.display = 'block';

                d_1.style.display = 'block';
                d_2.style.display = 'block';
                d_3.style.display = 'block';
                d_4.style.display = 'block';
                d_5.style.display = 'block';

                m_1.style.display = 'block';
                m_2.style.display = 'block';
                m_3.style.display = 'block';
                m_4.style.display = 'block';
                m_5.style.display = 'block';
            } else {
                b.style.display = 'none';
                c.style.display = 'block';
                i.style.display = 'block';
                j.style.display = 'block';
                k.style.display = 'block';
                p.style.display = 'none';

                d_1.style.display = 'none';
                d_2.style.display = 'none';
                d_3.style.display = 'none';
                d_4.style.display = 'none';
                d_5.style.display = 'none';

                m_1.style.display = 'none';
                m_2.style.display = 'none';
                m_3.style.display = 'none';
                m_4.style.display = 'none';
                m_5.style.display = 'none';
            }

            if (child_category_id == 9) {
                e_1.style.display = 'none';
                e_2.style.display = 'none';
                e_3.style.display = 'none';
                e_4.style.display = 'none';
                e_5.style.display = 'none';

                f_1.style.display = 'none';
                f_2.style.display = 'none';
                f_3.style.display = 'none';
                f_4.style.display = 'none';
                f_5.style.display = 'none';

            } else {
                e_1.style.display = 'block';
                e_2.style.display = 'block';
                e_3.style.display = 'block';
                e_4.style.display = 'block';
                e_5.style.display = 'block';

                f_1.style.display = 'block';
                f_2.style.display = 'block';
                f_3.style.display = 'block';
                f_4.style.display = 'block';
                f_5.style.display = 'block';
            }

            if (child_category_id == 2 || child_category_id == 6 || child_category_id == 9) {
                if (child_category_id == 2 || child_category_id == 6) {
                    g_1.style.display = 'none';
                    g_2.style.display = 'none';
                    g_3.style.display = 'none';
                    g_4.style.display = 'none';
                    g_5.style.display = 'none';

                    h_1.style.display = 'none';
                    h_2.style.display = 'none';
                    h_3.style.display = 'none';
                    h_4.style.display = 'none';
                    h_5.style.display = 'none';
                } else {
                    g_1.style.display = 'none';

                    h_1.style.display = 'none';
                    h_2.style.display = 'none';
                    h_3.style.display = 'none';
                    h_4.style.display = 'none';
                    h_5.style.display = 'none';
                }
            } else {
                if (child_category_id == 2 || child_category_id == 6) {
                    g_1.style.display = 'block';
                    g_2.style.display = 'block';
                    g_3.style.display = 'block';
                    g_3.style.display = 'block';
                    g_4.style.display = 'block';

                    h_1.style.display = 'block';
                    h_2.style.display = 'block';
                    h_3.style.display = 'block';
                    h_4.style.display = 'block';
                    h_5.style.display = 'block';
                } else {
                    h_1.style.display = 'block';
                    h_2.style.display = 'block';
                    h_3.style.display = 'block';
                    h_4.style.display = 'block';
                    h_5.style.display = 'block';
                }
            }

            $.ajax({
                url: "/show-room-size-select",
                type: "get",
                data: {
                    child_category_id: child_category_id,
                    sub_category_id: sub_category_id,
                    service_category_id: service_category_id,
                },
                dataType: "json",
                success: function(data) {
                    if (data.name == 'room') {
                        $('#room_size').empty();
                        $('#room_size').html(data.html);
                        $('.room_size_container').show();

                    } else {
                        $('.room_size_container').hide();
                    }
                }
            });
        });
        /*$(document).on('change', '#property_room_quantity', function() {
          var roomQuantityId = $(this).val();
          alert(roomQuantityId);
          for (var i = 0; i <= roomQuantityId; i++) {
          let html = '<fieldset class="form_room_fieldset" id="room + i"> <legend> Room + i </legend> <div class="form_row form_row_cost "> <div class="form_label"> Cost of room </div> <div class="form_inputs"> <span class="form_input form_text"> <span class="form_currency_symbol">£</span> <input type="number" name="room_cost_of_amount1" value="" size="6" step="any"> </span> <label class="form_input form_radio"> <input type="radio" name="room_cost_time1" value=1> per week </label> <label class="form_input form_radio"> <input type="radio" name="room_cost_time1" checked="" value=2> per calendar month </label> </div> </div> <div class="form_row form_row_room_size"> <div class="form_label"> Size of room </div> <div class="form_inputs"> <label class="form_input form_radio"> <input type="radio" name="room_size1" value=1> Single </label> <label class="form_input form_radio"> <input type="radio" name="room_size1" value=2 checked=""> Double </label> </div> </div> <div class="form_row form_row_amenities"> <div class="form_label"> Amenities </div> <div class="form_inputs"> <label class="form_input form_checkbox"> <input type="checkbox" name="room_amenities1" value="Y"> En-suite <span class="form_hint">(tick if room has own toilet and/or bath/shower)</span> </label> </div> </div> <div class="form_row form_row_amenities"> <div class="form_label"> Furnishings </div> <div class="form_inputs"> <label class="form_input form_radio"> <input type="radio" name="room_furnishings1" value=1> Furnished </label> <label class="form_input form_radio"> <input type="radio" name="room_furnishings1" value=2> Unfurnished </label> </div> </div> <div class="form_row form_row_deposit "> <div class="form_label"> Security deposit </div> <div class="form_inputs"> <span class="form_input form_text"> <span class="form_currency_symbol">£</span> <input type="number" name="room_security_deposit1" value="" step="any" min="0"> </span> </div> </div> </fieldset>';
          document.getElementById("customRoomQuantity").innerHTML = html;
        }
      }); */

        $(document).on('change', '#property_size', function() {
            var badQuantityId = $(this).val();
            //alert(badQuantityId);

        });
    });
</script>
