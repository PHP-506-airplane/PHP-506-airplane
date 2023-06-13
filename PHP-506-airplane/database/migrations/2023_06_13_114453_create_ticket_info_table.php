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
            $table->bigInteger('t_no');
            $table->bigInteger('u_no');
            $table->bigInteger('fly_no');
            $table->primary(['t_no', 'u_no', 'fly_no']);
            $table->bigInteger('reserve_seat_num');
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
