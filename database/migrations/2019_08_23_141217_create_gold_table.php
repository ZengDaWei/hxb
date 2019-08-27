<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoldTable extends Migration
{

    public function up()
    {
        Schema::create('gold', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->index();
            $table->integer('action');
            $table->unsignedInteger('gold');
            $table->string('remark')->comment('备注');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('gold');
    }
}
