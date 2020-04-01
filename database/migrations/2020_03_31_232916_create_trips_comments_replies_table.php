<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsCommentsRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips_comments_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('comment');
            $table->string('user_name', 200);
            $table->string('user_email', 200);
            $table->string('language', 10);
            $table->integer('comment_id');
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
        Schema::dropIfExists('trips_comments_replies');
    }
}
