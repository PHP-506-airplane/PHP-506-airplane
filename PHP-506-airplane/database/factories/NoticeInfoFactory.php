<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NoticeInfo>
 */
class NoticeInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-1 years');
        return [
            'adm_no'            => $this->faker->randomNumber(1)
            ,'notice_title'     => $this->faker->realText(30)
            ,'notice_content'   => $this->faker->realText(100)
            ,'created_at'       => $date
            ,'updated_at'       => $date
            ,'deleted_at'       => $this->faker->randomNumber(1) <= 5 ? $date : null
        ];
    }
}
