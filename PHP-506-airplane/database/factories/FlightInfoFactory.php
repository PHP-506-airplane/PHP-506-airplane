<?php

/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : database/factories
 * 파일명       : FlightInfoFactory.php
 * 이력         :   v001 0614 이동호 new
 **************************************************/

namespace Database\Factories;

use App\Models\FlightInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightInfoFactory extends Factory
{
    public function definition()
    {
        // 현재부터 +1년까지 랜덤한 날짜 생성
        $flyDate = $this->faker->dateTimeBetween('now', '+1 year');
        // HH:mm 형식으로 출발 시간 생성
        $depTime = Carbon::createFromFormat('H:i', $this->faker->time('H:i'))->format('H:i');
        // 출발시간과 10분 ~ 60분 사이의 랜덤한 시간 차이 나게 도착 시간 생성
        $minDiff = $this->faker->numberBetween(10, 60);
        $arrTime = Carbon::createFromFormat('H:i', $depTime)->addMinutes($minDiff)->format('H:i');
        $depPortNo = $this->faker->numberBetween(1, 14);
        $arrPortNo = $this->faker->numberBetween(1, 14);

        while ($depPortNo === $arrPortNo) {
            $arrPortNo = $this->faker->numberBetween(1, 14);
            // $arrPortNo = 99;
        }

        return [
            'fly_date'      => $flyDate->format('Y-m-d H:i:s') // DateTime 객체를 문자열로 변환해서 저장
            ,'price'        => $this->faker->numberBetween(10, 300) * 1000 // 가격을 10,000원 ~ 300,000원 사이로 설정, 최소 1000원 단위
            ,'dep_port_no'  => $depPortNo
            ,'arr_port_no'  => $arrPortNo
            ,'line_no'      => $this->faker->numberBetween(1, 12)
            // bothify('??###') : 영어 2자리, 숫자 3자리 랜덤하게 생성
            ,'flight_num'   => $this->faker->bothify('??###')
            // 시간 형식을 변경해서 저장 ex) 12:00 => 1200
            ,'dep_time'     => str_replace(':', '', substr($depTime, 0, 2)) . substr($depTime, 3, 2)
            ,'arr_time'     => str_replace(':', '', substr($arrTime, 0, 2)) . substr($arrTime, 3, 2)
        ];
    }

    // configure() : 팩토리의 동작을 커스터마이즈하기 위해 사용
    public function configure()
    {
        return $this->afterCreating(function (FlightInfo $flight) {
            // 각 날짜에는 최소한 10개 이상의 데이터가 들어가도록 설정
            $date = Carbon::parse($flight->fly_date)->format('Y-m-d');
            $count = FlightInfo::whereDate('fly_date', $date)->count();

            if ($count < 10) {
                $remainingCount = 10 - $count;
                // 부족한 데이터 생성
                FlightInfo::factory()->count($remainingCount)->create([
                    'fly_date' => $flight->fly_date
                ]);
            }

            // 매일 1부터 14까지의 dep_port_no가 모두 포함되어 최소 3개 이상의 데이터가 있는지 확인
            foreach (range(1, 14) as $depPortNo) {
                $countPort = FlightInfo::whereDate('fly_date', $date)
                    ->where('dep_port_no', $depPortNo)
                    ->count();

                if ($countPort < 3) {
                    $remainingCount = 3 - $countPort;
                    // 부족한 데이터 생성
                    FlightInfo::factory()->count($remainingCount)->create([
                        'fly_date'      => $flight->fly_date
                        ,'dep_port_no'  => $depPortNo
                    ]);
                }
            }
        });
    }
}
