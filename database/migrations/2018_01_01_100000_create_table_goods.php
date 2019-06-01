<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGoods extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            // goods uid
            $table->uuid('uid')->unique();
            // 商品名称
            $table->string('name');
            // 商品图片
            $table->string('thumbnail')->nullable();
            // 商品编号
            $table->string('no')->nullable();
            // 商品原价
            $table->float('price')->default(0.00);
            // 商品现价
            $table->float('actprice')->default(0.00);
            // 商品库存
            $table->integer('stock')->default(0);
            // 商品销量
            $table->integer('sales')->default(0);
            // 商品详情
            $table->text('detail')->nullable();
            // 商品简介
            $table->string('brief')->nullable();
            // 商品状态
            $table->enum('status',['on_sale','off_sale']);
            // 商品排序
            $table->integer('sequence')->default(0);
            // 所属专题
            $table->integer('topic_uid')->default(NULL);
            // 所属板块
            $table->integer('plate_uid')->default(NULL);
            // 所属分类
            $table->integer('category_uid')->default(NULL);
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
        Schema::drop('goods');
    }
}
