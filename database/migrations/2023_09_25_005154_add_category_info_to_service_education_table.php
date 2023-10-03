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
        Schema::table('service_education', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('service_categories')->onDelete('cascade')->after('price');
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->onDelete('cascade')->after('price');
            $table->foreignId('child_category_id')->nullable()->constrained('child_categories')->onDelete('cascade')->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_education', function (Blueprint $table) {

        });
    }
};
