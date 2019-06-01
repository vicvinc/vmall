<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrder extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            // order uuid
            $table->uuid('uid')->unique();
            // user open id
            $table->string('openid');
            // 订单编号
            $table->string('no');
            // 订单状态
            $table->enum('status', ['wait_pay', 'payed', 'refund', 'used', 'closed']);
            // 订单总价
            $table->float('order_amount')->default(0.00);
            // 商品总价
            $table->float('goods_amount')->default(0.00);
            // 收货人姓名
            $table->string('name');
            // 收货人联系电话
            $table->string('phone', 11);

            $table->string('address');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('order');
    }
}
