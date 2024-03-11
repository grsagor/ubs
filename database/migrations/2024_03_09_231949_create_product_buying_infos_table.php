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
        Schema::create('product_buying_infos', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('transaction_id');
            $table->string('amount');
            $table->string('personal_name');
            $table->string('personal_email');
            $table->string('pass_check');
            $table->string('personal_pass');
            $table->string('personal_confirm');
            $table->string('shipping');
            $table->string('pickup_location');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->string('customer_city');
            $table->string('customer_zip');
            $table->string('select_country');
            $table->string('customer_state');
            $table->string('shipping_name');
            $table->string('shipping_phone');
            $table->string('shipping_address');
            $table->string('shipping_zip');
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->string('shipping_country');
            $table->string('order_notes');
            $table->string('payment_method');
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
        Schema::dropIfExists('product_buying_infos');
    }
};
