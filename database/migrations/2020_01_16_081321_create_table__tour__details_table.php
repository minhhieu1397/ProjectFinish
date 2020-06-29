<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTourDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_table', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tour_id');
            $table->date('day_start');
            $table->date('day_end');
            $table->integer('amount');
            $table->string('account');
            $table->string('description');
            $table->integer('total');
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
        Schema::dropIfExists('detail_table');
    }
}
