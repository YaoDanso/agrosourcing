<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('longitude');
            $table->string('latitude');
            $table->integer('crop_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('size');
            $table->string('price');
            $table->string('image');
            $table->timestamps();

            $table->foreign('crop_id')
                ->references('id')
                ->on('crops');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farms');
    }
}
