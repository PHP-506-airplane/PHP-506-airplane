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
        Schema::create('reserve_info', function (Blueprint $table) {
            $table->id('reserve_no');
            $table->integer('plane_no');
            $table->integer('seat_no');
            $table->integer('fly_no');
            $table->integer('u_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserve_info');
    }
};
