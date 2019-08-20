<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('comment_id');

            // 外键
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('commentable_id');
            $table->string('commentable_type');
            // count
            $table->unsignedInteger('count_likes')->default(0);
            $table->unsignedInteger('count_replies')->default(0);

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
        Schema::dropIfExists('replies');
    }
}
