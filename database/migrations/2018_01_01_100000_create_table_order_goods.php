<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrderGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('order_goods', function (Blueprint $table) {
            $table->increments('id');
            // uuid
            $table->uuid('uid')->unique();
            // user open id
            $table->string('openid')->nullable();
            // 订单uid
            $table->uuid('order_uid')->nullable();
            // 商品uid
            $table->uuid('goods_uid')->nullable();
            // 购买数量
            $table->integer('goods_num')->nullable();
            // 商品名称
            $table->string('goods_name')->nullable();
            // 商品图片
            $table->string('goods_thumbnail')->nullable();
            // 商品编号
            $table->string('goods_no')->nullable();
            // 商品原价
            $table->float('goods_price')->default(0.00);
            // 商品现价
            $table->float('goods_actprice')->default(0.00);
            
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
        Schema::drop('order_goods');
    }
}
