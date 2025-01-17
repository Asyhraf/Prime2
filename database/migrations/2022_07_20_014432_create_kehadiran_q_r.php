<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKehadiranQR extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kehadiran_q_r', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ahli_id')->unsigned();
            $table->integer('mesyuarat_id')->unsigned();
 
            $table->string('kehadiran');
            $table->string('catatan')->nullable();
            $table->integer('wakil_oleh')->nullable();
            $table->integer('susunan')->nullable();
            $table->timestamps();

            $table->foreign('ahli_id')->reference('id_ahli')->on('ahli_mesyuarat');

            $table->foreign('mesyuarat_id')->reference('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kehadiran_q_r');
    }
}
