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
        // 공항정보 시더
        // $this->call(AirportInfoSeeder::class);

        // 관리자 시더
        // $this->call(UserInfoSeeder::class);

        // 항공사 정보 시더
        // $this->call(LineInfoSeeder::class);
        
        // 비행기 정보 시더
        // $this->call(AirplaneInfoSeeder::class);

        // 좌석 정보 시더
        // $this->call(SeatInfoSeeder::class);

        // 공지사항 팩토리
        // \App\Models\NoticeInfo::factory(2000)->create();

        // 운항정보 팩토리
        // \App\Models\FlightInfo::factory(500)->create();
    }
}
