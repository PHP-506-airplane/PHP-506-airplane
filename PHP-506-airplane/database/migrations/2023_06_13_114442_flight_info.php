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
        Schema::create('flight_info', function (Blueprint $table) {
            $table->id('fly_no');
            $table->date('fly_date');
            $table->integer('price');
            $table->biginteger('dep_port_no'); 
            $table->biginteger('arr_port_no');
            $table->biginteger('line_no');
            $table->string('flight_num',30);
            $table->char('dep_time', 4);
            $table->char('arr_time', 4);
            $table->biginteger('plane_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flight_info');
    }
};
