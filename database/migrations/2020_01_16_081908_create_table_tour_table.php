<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('place_id');
            $table->string('tour_name');
            $table->string('vehicle');
            $table->date('departure');
            $table->string('day_night');
            $table->integer('price');
            $table->string('note');
            $table->string('img')->nullable();
            $table->boolean('tour_hot')->nullable();
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
        Schema::dropIfExists('tour');
    }
}
