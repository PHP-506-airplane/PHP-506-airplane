<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_info', function (Blueprint $table) {
            $table->id('t_no');
            $table->bigInteger('u_no');
            $table->bigInteger('reserve_seat_num');
            $table->bigInteger('fly_no');
            $table->integer('reserve_no');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_info');
    }
};
