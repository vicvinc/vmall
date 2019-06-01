<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWechatFollower extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_follower', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uid')->unique();
            $table->string('openid');
            $table->string('nickname');
            $table->enum('sex', ['unknow', 'male', 'female']);
            $table->string('language');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('avatar');
            $table->string('remark');
            $table->integer('groupid');
            $table->enum('sub_status', ['subscribed', 'unsubscribe']);
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
        Schema::drop('wechat_follower');
    }
}
