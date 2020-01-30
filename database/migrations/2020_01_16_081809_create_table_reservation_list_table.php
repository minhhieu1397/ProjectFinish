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
            $table->integer('detail_id');
            $table->date('booking_date');
            $table->integer('children');
            $table->integer('adults');
            $table->boolean('status');
            $table->string('phone');
            $table->string('note');
            $table->boolean('pay');
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
