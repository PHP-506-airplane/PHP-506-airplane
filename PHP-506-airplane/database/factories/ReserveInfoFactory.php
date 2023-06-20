<?php

namespace Database\Factories;

use App\Models\FlightInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReserveInfo>
 */
class ReserveInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $planeNo = $this->faker->numberBetween(1, 5);
        $flyNo = $this->faker->numberBetween(1, 14554);
        $uNo = 1;

        // seat_no를 생성
        $generateSeatNo = function () {
            $row = chr($this->faker->numberBetween(65, 73)); // A ~ I
            $column = $this->faker->numberBetween(1, 12);
            return $row . str_pad($column, 2, '0', STR_PAD_LEFT); // ex) A01, B02, ...
        };

        return [
            'plane_no'  => $planeNo
            ,'seat_no'  => $generateSeatNo()
            ,'fly_no'   => $flyNo
            ,'u_no'     => $uNo
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function ($reserveInfo) {
            $res = $reserveInfo->where('fly_no', $reserveInfo->fly_no)->first();
            if ($res) {
                $reserveInfo->plane_no = $res->plane_no;
            }

            $flightInfo = FlightInfo::where('flight_num', $reserveInfo->fly_no)->first();
            if ($flightInfo) {
                $reserveInfo->plane_no = $flightInfo->plane_no;
            }
        });
    }
}

