<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableShopConfig extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('shop_config', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uid')->unique();
            // shop name
            $table->string('name');
            // shop seo key words
            $table->string('seo_key_words', 50);
            // shop seo describe
            $table->string('seo_describe', 120);
            // contact phone number
            $table->string('phone', 11);
            // time stamp
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
        Schema::drop('shop_config');
    }
}
