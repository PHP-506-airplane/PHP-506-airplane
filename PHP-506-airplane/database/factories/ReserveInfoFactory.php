<?php

namespace Database\Factories;

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
            'plane_no' => $planeNo,
            'seat_no' => $generateSeatNo(),
            'fly_no' => $flyNo,
            'u_no' => $uNo,
        ];
    }
}
