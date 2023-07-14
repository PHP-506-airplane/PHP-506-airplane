<?php

namespace Database\Seeders;

use App\Models\RateInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RateInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RateInfo::insert([
            ['kind_of_rate' => '성인', 'rate_per' => '0']
            ,['kind_of_rate' => '유아', 'rate_per' => '100']
            ,['kind_of_rate' => '소아', 'rate_per' => '10']
        ]);
    }
}
