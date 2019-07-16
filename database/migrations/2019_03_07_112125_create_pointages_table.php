<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pointages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_departure');
            $table->dateTime('date_arrival');
            $table->bigInteger('agent_id')->unsigned();
            $table->foreign('agent_id')->references('id')->on('agents');
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
        Schema::dropIfExists('pointages');
    }
}
