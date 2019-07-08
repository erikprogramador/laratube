<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_video', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('video_id');
            $table->timestamps();

            $table->index(['tag_id', 'video_id']);

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');

            $table->foreign('video_id')
                ->references('id')
                ->on('videos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_video');
    }
}
