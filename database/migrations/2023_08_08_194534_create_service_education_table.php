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
        Schema::create('service_education', function (Blueprint $table) {
            $table->increments('id');
            $table->string('course_name')->nullable();
            $table->text('price')->nullable();
            $table->string('course_duration')->nullable();
            $table->string('institution_name')->nullable();
            $table->text('requirements')->nullable();
            $table->string('start_date')->nullable();
            $table->string('intake')->nullable();
            $table->string('department')->nullable();
            $table->string('tuition_fee')->nullable();
            $table->string('scholarship')->nullable();
            $table->string('modules')->nullable();
            $table->string('description')->nullable();
            $table->text('service_facilities')->nullable();
            $table->string('agent_commission')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('images')->nullable();


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
        Schema::dropIfExists('service_education');
    }
};
