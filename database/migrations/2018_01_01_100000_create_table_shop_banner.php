<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableShopBanner extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('shop_banner', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uid')->unique();
            // banner title
            $table->string('title');
            // img url
            $table->string('thumbnail')->nullable();
            // rediret url
            $table->string('link')->nullable();
            // 排序
            $table->integer('sequence')->default(0);
            // 是否显示
            $table->enum('status', ['show', 'hide']);
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
        Schema::drop('shop_banner');
    }
}
