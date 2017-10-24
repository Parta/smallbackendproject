<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFansLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fans_likes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('page_id');
            $table->string('page');
            $table->string('name');
            $table->unsignedBigInteger('count');
            $table->dateTime('request_time');
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
        Schema::dropIfExists('fans_likes');
    }
}
