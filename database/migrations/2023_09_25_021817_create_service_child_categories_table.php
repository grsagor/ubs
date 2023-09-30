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
        Schema::create('service_child_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('service_category_id');
            $table->foreignId('service_sub_category_id')->nullable()->constrained('service_sub_categories')->onDelete('cascade');
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
        Schema::dropIfExists('service_child_categories');
    }
};
