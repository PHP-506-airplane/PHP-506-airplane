<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Test::insert([
            ['plane_no' => 1, 'seat_no' => 'A01', 'fly_no' => 13182, 'u_no' => 1]
        ]);
    }
}
