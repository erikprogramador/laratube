<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 150);
            $table->string('slug')->unique()->index();
            $table->text('description');
            $table->string('video_file');
            $table->string('thumb_file');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('visibility')->default(0);
            $table->unsignedBigInteger('channel_id');
            $table->timestamps();

            $table->foreign('channel_id')
                ->references('id')
                ->on('channels')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
