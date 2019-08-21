<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index()->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('api_token')->index();
            $table->unsignedInteger('level')->default(1);
            $table->unsignedInteger('status')->default(0)->comment('0-正常（默认） , 1-冻结');
            $table->string('avatar');
            // count
            $table->unsignedInteger('count_fans')->default(0)->comment('粉丝数');
            $table->unsignedInteger('count_follows')->default(0)->comment('关注用户数');
            $table->unsignedInteger('count_articles')->default(0)->comment('文章数');
            $table->unsignedInteger('count_likes')->default(0)->comment('被赞数');
            $table->unsignedInteger('count_words')->default(0)->comment('总字数');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
