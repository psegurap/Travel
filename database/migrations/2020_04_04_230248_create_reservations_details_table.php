<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('adults_amount');
            $table->integer('kids_amount');
            $table->string('adults_total', 100);
            $table->string('kids_total', 100);
            $table->string('total_amount', 100);
            $table->integer('customer_id');
            $table->integer('trip_id');
            $table->integer('reservation_status');
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
        Schema::dropIfExists('reservations_details');
    }
}
