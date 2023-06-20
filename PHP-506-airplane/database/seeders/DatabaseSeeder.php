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
        // $this->call(AirLineInfoSeeder::class);
        
        // 비행기 정보 시더
        // $this->call(AirplaneInfoSeeder::class);

        // 좌석 정보 시더
        // $this->call(SeatInfoSeeder::class);

        // 예약 정보 테스트 시더
        // $this->call(TestSeeder::class);

        // 공지사항 팩토리
        // \App\Models\NoticeInfo::factory(2000)->create();

        // 운항정보 팩토리
        // \App\Models\FlightInfo::factory(1000)->create();

        // 예약정보 팩토리
        // for($i = 0; $i < 100; $i++) {
        //     \App\Models\ReserveInfo::factory(2000)->create();
        // }
        
        // 티켓정보 팩토리
        for($i = 0; $i < 1; $i++) {
            \App\Models\TicketInfo::factory(2000)->create();
        }
    }
}
