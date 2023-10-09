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
            $table->foreignId('service_sub_category_id')->nullable()->constrained('service_sub_categories')->onDelete('cascade')->after('scholarship');
            $table->foreignId('service_child_category_id')->nullable()->constrained('service_child_categories')->onDelete('cascade')->after('scholarship');
            $table->string('education_type')->after('scholarship');
            $table->string('level_of_education')->after('scholarship');
            $table->integer('tuition_fee_int')->after('scholarship');
            $table->decimal('ielts',3,1)->nullable()->after('scholarship');
            $table->string('grades')->nullable()->after('scholarship');
            $table->string('youtube_link')->nullable()->after('scholarship');
            $table->integer('scholarship_by_unipuller')->nullable()->after('scholarship');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function dropColumn()
    {
        Schema::table('service_education', function (Blueprint $table) {
            $table->dropColumn('service_sub_category_id');
            $table->dropColumn('service_child_category_id');
            $table->dropColumn('education_type');
            $table->dropColumn('level_of_education');
            $table->dropColumn('tuition_fee_int');
            $table->dropColumn('ielts');
            $table->dropColumn('grades');
            $table->dropColumn('youtube_link');
            $table->dropColumn('scholarship_by_unipuller');
        });
    }
};
