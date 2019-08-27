<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{

    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->index();
            $table->integer('action');
            $table->unsignedInteger('rmb');
            $table->unsignedInteger('rate')->comment('兑换比率');
            $table->unsignedInteger('gold_balance')->comment('金币余额');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('records');
    }
}
