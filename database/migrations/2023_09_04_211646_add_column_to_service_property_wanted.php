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
        Schema::table('service_property_wanted', function (Blueprint $table) {
            $table->integer('business_location_id')->unsigned()->nullable();
            $table->foreign('business_location_id')->references('id')->on('business_locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_property_wanted', function (Blueprint $table) {
            $table->dropForeign('business_location_id');
            $table->dropColumn('business_location_id');
        });
    }
};
