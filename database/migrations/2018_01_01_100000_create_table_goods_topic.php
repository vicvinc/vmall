<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGoodsTopic extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('topic', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uid')->unique();
            $table->string('title');
            $table->string('thumbnail');
            $table->integer('sequence')->default(0);
            $table->enum('status',['show','hide']);
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
        Schema::drop('topic');
    }
}
