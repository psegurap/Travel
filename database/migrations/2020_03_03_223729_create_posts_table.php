<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_es', 200)->nullable();
            $table->string('title_en', 200)->nullable();
            $table->text('content_es')->nullable();
            $table->text('content_en')->nullable();
            $table->string('short_description_es', 200)->nullable();
            $table->string('short_description_en', 200)->nullable();
            $table->string('img_thumbnail', 200);
            $table->string('picture_path', 200);
            $table->integer('user_id');
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
        Schema::dropIfExists('posts');
    }
}
