<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AirportInfoSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 초기 데이터 삽입용 시더 호출
        $this->call(AirportInfoSeeder::class);

        // \App\Models\NoticeInfo::factory(2000)->create();
        // \App\Models\User::factory(10)->create();
    }
}
