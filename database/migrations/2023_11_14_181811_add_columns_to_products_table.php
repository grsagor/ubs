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
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('child_category_id')->unsigned()->nullable()->after('sub_category_id');
            $table->string('class')->nullable()->after('sub_category_id');
            $table->boolean('select_year')->nullable()->after('sub_category_id');
            $table->boolean('every_years')->nullable()->after('sub_category_id');
            $table->string('selected_years')->nullable()->after('sub_category_id');
            $table->string('selected_months')->nullable()->after('sub_category_id');
            $table->string('name_of_institution')->nullable()->after('sub_category_id');
            $table->integer('duration_year')->nullable()->after('sub_category_id');
            $table->integer('duration_month')->nullable()->after('sub_category_id');
            $table->integer('home_students_fees')->nullable()->after('sub_category_id');
            $table->integer('int_students_fees')->nullable()->after('sub_category_id');
            $table->longText('general_facilities')->nullable()->after('sub_category_id');
            $table->string('work_placement')->nullable()->after('sub_category_id');
            $table->longText('work_placement_description')->nullable()->after('sub_category_id');
            $table->string('tuition_fee_installment')->nullable()->after( 'sub_category_id');
            $table->longText('fee_installment_description')->nullable()->after('sub_category_id');
            $table->string('requirements')->nullable()->after('sub_category_id');
            $table->longText('requirement_details')->nullable()->after('sub_category_id');
            $table->string('thumbnail')->nullable()->after('sub_category_id');
            $table->string('product_brochure')->nullable()->after('sub_category_id');
            $table->string('youtube_link')->nullable()->after('sub_category_id');
            $table->longText('service_features')->nullable()->after('sub_category_id');
            $table->longText('experiences')->nullable()->after('sub_category_id');
            $table->longText('specializations')->nullable()->after('sub_category_id');
            $table->string('disable_reselling')->nullable()->after('sub_category_id');
            $table->integer('reselling_price')->nullable()->after('sub_category_id');
            $table->string('reselling_commission_amount')->nullable()->after('sub_category_id');
            $table->string('extra_commission')->nullable()->after('sub_category_id');
            $table->boolean('price_changeable')->nullable()->after('sub_category_id');
            $table->string('delivery_mode')->nullable()->after('sub_category_id');
            $table->string('delivery_area')->nullable()->after('sub_category_id');
            $table->string('delivery_area_type')->nullable()->after('sub_category_id');
            $table->longText('policy')->nullable()->after('sub_category_id');
            $table->string('unipuller_data_policy')->nullable()->after('sub_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('select_year');
            $table->dropColumn('selected_years');
            $table->dropColumn('selected_months');
            $table->dropColumn('name_of_institution');
            $table->dropColumn('duration');
            $table->dropColumn('home_students_fees');
            $table->dropColumn('int_students_fees');
            $table->dropColumn('general_facilities');
            $table->dropColumn('work_placement');
            $table->dropColumn('tuition_fee_installment');
            $table->dropColumn('requirements');
            $table->dropColumn('requirement_details');
            $table->dropColumn('youtube_link');
            $table->dropColumn('service_features');
            $table->dropColumn('experiences');
            $table->dropColumn('specializations');
            $table->dropColumn('disable_reselling');
            $table->dropColumn('reselling_price');
            $table->dropColumn('reselling_commission');
            $table->dropColumn('reselling_commission_tuition');
            $table->dropColumn('price_changeable');
            $table->dropColumn('delivery_mode');
            $table->dropColumn('delivery_area');
            $table->dropColumn('policy');
            $table->dropColumn('unipuller_data_policy');
        });
    }
};
