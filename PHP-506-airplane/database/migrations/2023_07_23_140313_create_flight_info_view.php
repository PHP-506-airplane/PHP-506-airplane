<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::statement("
            CREATE VIEW flight_info_view AS
            SELECT flight_info.*
                    ,dep.port_name AS dep_port_name
                    ,arr.port_name AS arr_port_name
                    ,line.line_name
                    ,COUNT(res.fly_no) AS count
            FROM flight_info
            LEFT JOIN reserve_info AS res 
                ON flight_info.fly_no = res.fly_no
            JOIN airport_info AS dep 
                ON flight_info.dep_port_no = dep.port_no
            JOIN airport_info AS arr 
                ON flight_info.arr_port_no = arr.port_no
            JOIN airplane_info AS plane 
                ON flight_info.plane_no = plane.plane_no
            JOIN airline_info AS line 
                ON plane.line_no = line.line_no
            WHERE flight_info.fly_date > (NOW() - INTERVAL 1 DAY)
            GROUP BY flight_info.fly_no
            ORDER BY 
                flight_info.fly_date
                ,flight_info.dep_time
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flight_info_view');
    }
};
