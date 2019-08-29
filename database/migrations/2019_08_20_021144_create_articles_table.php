<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('code')->default(0)->comment('0- 文字文章，其他待扩展');
            $table->string('title')->index();
            $table->text('content')->nullable();
            $table->string('cover')->nullable();
            $table->string('description');
            $table->unsignedInteger('status')->default(0)->comment('0- 草稿 1- 发布 2- 精选 3- 冻结');

            // count
            $table->integer('count_comments')->default(0)->comment('评论数量');
            $table->integer('count_likes')->default(0)->comment('点赞数量');
            $table->integer('count_reads')->default(0)->comment('阅读数量');
            $table->integer('count_words')->default(0)->comment('字数');

            // 创建时间 和 发布时间 不同
            $table->timestamp('published_at')->nullable()->comment('发布时间');

            // 外键
            $table->unsignedInteger('user_id')->index();
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
        Schema::dropIfExists('articles');
    }
}
