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
        Schema::create('service_property_wanted', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_id')->unique();
            $table->string('who_is_searching')->nullable();
            $table->string('why_is_searching')->nullable();
            $table->tinyInteger('gender')->nullable()->nullable()->comment('1=male, 2=female, 3=others');
            $table->string('room_size')->nullable();
            $table->string('buddy_ups')->nullable();
            $table->string('wanted_living_area')->nullable();

            // $table->string('address')->nullable();

            $table->string('combined_budget')->nullable();

            $table->string('per')->nullable();
            $table->string('available_form')->nullable();
            $table->string('min_term')->nullable();
            $table->string('max_term')->nullable();
            $table->string('days_of_wk_available')->nullable();
            $table->string('roomfurnishings')->nullable();
            $table->string('age')->nullable();
            $table->string('occupation')->nullable();
            $table->string('smoking_current')->nullable()->comment('1=yes, 2=no');
            $table->string('pets')->nullable()->comment('1=yes, 2=no');
            $table->string('gay_lesbian')->nullable();
            $table->string('gay_consent')->nullable()->comment('1=yes, 2=no');

            $table->string('lang_id')->nullable();
            $table->string('nationality')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender_req')->nullable()->comment('1=male, 2=female, 3=others');
            $table->string('min_age_req')->nullable();
            $table->string('max_age_req')->nullable();
            $table->string('smoking')->nullable();
            $table->string('pets_req')->nullable();
            $table->string('gay_lesbian_req')->nullable();
            $table->string('ad_title')->nullable();
            $table->text('ad_text')->nullable();
            $table->string('tel')->nullable();
            $table->string('selectedSports')->nullable();
            $table->string('images')->nullable();



            $table->tinyInteger('advert_type')->default(1)->comment('1=Normal, 2=Feature');

            $table->tinyInteger('status')->default(1)->comment('1=active, 0=inactive');
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
        Schema::dropIfExists('service_property_wanted');
    }
};
