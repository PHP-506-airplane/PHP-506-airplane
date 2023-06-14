<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('airport_info')->insert([
            ['port_eng' => 'WJU', 'port_name' =>'원주공항']
           ,['port_eng' => 'KUV', 'port_name' =>'군산공항']
           ,['port_eng' => 'KWJ', 'port_name' =>'광주공항']
           ,['port_eng' => 'RSU', 'port_name' =>'여수공항']
           ,['port_eng' => 'HIN', 'port_name' =>'사천공항']
           ,['port_eng' => 'USN', 'port_name' =>'울산공항']
           ,['port_eng' => 'KPO', 'port_name' =>'포항경주공항']
           
        ]);
    }
}
