<?php

use Illuminate\Database\Migrations\Migration;

class TagVideoTable extends Migration
{

    public function up()
    {
        Schema::create('tag_video', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tag_id');
            $table->unsignedInteger('video_id');
            $table->timestamps();
        });
    }

    public function down()
    {

    }
}
