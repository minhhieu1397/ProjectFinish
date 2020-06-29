<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableReservationListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tour_id');
            $table->string('tour_name');
            $table->date('booking_date');
            $table->integer('people');
            $table->string('email');
            $table->boolean('status')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->string('note');
            $table->boolean('pay')->nullable();
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
        Schema::dropIfExists('reservation_list');
    }
}
