<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyingCustomerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyingCustomer_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_name', 200);
            $table->string('customer_email', 100);
            $table->string('customer_adddress', 200);
            $table->string('customer_city', 100);
            $table->string('customer_zipCode', 20);
            $table->integer('customer_country');
            $table->string('customer_cellphone', 50);
            $table->string('customer_homephone', 50)->nullable();
            $table->text('customer_notes')->nullable();
            $table->string('language', 10);
            $table->integer('status');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('buyingCustomer_details');
    }
}
