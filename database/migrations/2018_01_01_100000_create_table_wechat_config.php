<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWechatConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_config', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uid')->unique();
            // 名称
            $table->string('name');
            // 微信号
            $table->string('account');
            // 原始ID
            $table->string('original_account');
            // App Id
            $table->string('app_uid');
            // App Secret
            $table->string('app_secret');
            // 安全模式必填
            $table->string('aes_key');
            // 校验token
            $table->string('token');
            // 服务器地址(自动生成)
            $table->string('url');
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
        Schema::drop('wechat_config');
    }
}
