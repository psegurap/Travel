<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuickFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quick_feedback', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('visitor_name', 200);
            $table->text('visitor_feedback');
            $table->string('img_thumbnail', 200);
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
        Schema::dropIfExists('quick_feedback');
    }
}
