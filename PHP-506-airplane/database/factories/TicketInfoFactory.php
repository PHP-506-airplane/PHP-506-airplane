<?php

namespace Database\Factories;

use App\Models\ReserveInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TicketInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $reservation = ReserveInfo::factory()->create();

        $reserveNo = $reservation->reserve_no;
        $tPrice = $this->faker->numberBetween(10, 300) * 1000; // 가격을 10,000원 ~ 300,000원 사이로 설정, 최소 1000원 단위 // 최소 단위인 1000원으로 반올림
        $del = mt_rand(1, 10);
        $delDate = null;

        if ($del < 4) {
            $delDate = now();
        }

        return [
            'reserve_no'    => $reserveNo
            ,'t_price'      => $tPrice
            ,'deleted_at'   => $delDate
        ];
    }
}
