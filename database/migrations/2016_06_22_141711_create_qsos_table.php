<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qsos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('band');
            $table->float('rxfreq');
            $table->float('txfreq');
            $table->string('operator');
            $table->string('mode');
            $table->string('call');
            $table->string('exchange1')->nullable();
            $table->string('section')->nullable();
            $table->dateTime('timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('qsos');
    }
}