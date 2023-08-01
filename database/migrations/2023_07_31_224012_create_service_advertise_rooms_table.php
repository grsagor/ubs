<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_advertise_rooms', function (Blueprint $table) {
            $table->increments('id');

            // Get started with your free advert

            $table->string('property_room_quantity');
            $table->string('property_size');
            $table->string('property_type');
            $table->string('property_occupants')->nullable();
            $table->string('property_postcode');
            $table->string('property_user_title');
            $table->string('property_email_address');

            // More about the property

            $table->string('property_address');
            $table->string('property_area');
            $table->string('transport_minutes');
            $table->string('transport_form');
            $table->string('transport_to');
            $table->tinyInteger('living_room')->comment('1=yes, 2=no');
            $table->text('property_amenities');

            // The rooms

            $table->double('room_cost_of_amount', 10, 2);
            $table->tinyInteger('room_cost__time')->comment('1=per week, 2=per calendar month');
            $table->tinyInteger('room_size')->nullable()->comment('1=single , 2=double');
            $table->tinyInteger('room_amenities')->nullable();
            $table->tinyInteger('room_furnishings')->nullable()->comment('1=furnished, 2=unfurnished');
            $table->double('room_security_deposit', 10, 2)->nullable();

            $table->string('room_available_from_date');
            $table->string('room_available_from_month');
            $table->string('room_available_from_year');
            $table->string('room_min_stay')->nullable();
            $table->string('room_max_stay')->nullable();
            $table->tinyInteger('room_short_term_let_consider')->nullable();
            $table->string('room_days_available');
            $table->tinyInteger('room_reference')->comment('1=yes, 2=no');
            $table->tinyInteger('room_bills')->comment('1=yes, 2=no, 3=some');
            $table->tinyInteger('room_broadband')->comment('1=yes, 2=no, 3=some');


            // The Existing Flatmate
            $table->tinyInteger('exiting_flatmate_smoking')->nullable()->comment('1=yes, 2=no');
            $table->tinyInteger('exiting_flatmate_gender')->nullable()->comment('1=male, 2=female, 3=others');
            $table->string('exiting_flatmate_occupation')->nullable();
            $table->tinyInteger('exiting_flatmate_pets')->nullable()->comment('1=yes, 2=no');
            $table->string('exiting_flatmate_age')->nullable();
            $table->string('exiting_flatmate_language')->nullable();
            $table->string('exiting_flatmate_nationality')->nullable();
            $table->string('exiting_flatmate_sexual_orientation')->nullable();
            $table->tinyInteger('exiting_flatmate_sexual_orientation_check_box')->nullable()->comment('1=yes, 2=no');

            // Preferences For New flatmates
            $table->tinyInteger('new_flatmate_smoking')->nullable()->comment('1=yes, 2=no');
            $table->tinyInteger('new_flatmate_gender')->nullable()->comment('1=yes, 2=no');
            $table->string('new_flatmate_occupation')->nullable();
            $table->tinyInteger('new_flatmate_pets')->nullable()->comment('1=yes, 2=no');
            $table->integer('new_flatmate_min_age')->nullable();
            $table->integer('new_flatmate_max_age')->nullable();
            $table->integer('new_flatmate_language')->nullable();
            $table->integer('new_flatmate_couples')->nullable();
            $table->tinyInteger('new_flatmate_vegetarians')->nullable()->comment('1=yes, 2=no');


            // Your ad & contact details

            $table->string('advert_title');
            $table->string('advert_description');
            $table->string('advert_photos')->nullable();
            $table->string('advert_first_name');
            $table->string('advert_last_name')->nullable();
            $table->tinyInteger('advert_on_last_name')->nullable()->comment('1=yes, 2=no');
            $table->string('advert_telephone');

            // Email alerts
            $table->tinyInteger('daily_email_alerts')->nullable()->comment('1=yes, 2=no');
            $table->tinyInteger('instant_email_alerts')->nullable()->comment('1=yes, 2=no');
            $table->integer('instant_email_max_days')->nullable();

            $table->tinyInteger('status')->nullable()->comment('1=active, 2=inactive');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->integer('update_by')->unsigned();
            $table->foreign('update_by')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_advertise_rooms');
    }
};
