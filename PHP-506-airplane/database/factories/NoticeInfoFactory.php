<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : database/factories
 * 파일명       : NoticeInfoFactory.php
 * 이력         :   v001 0612 이동호 new
**************************************************/


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
            'u_no'              => $this->faker->randomNumber(1)
            ,'notice_title'     => $this->faker->realText(30)
            ,'notice_content'   => $this->faker->realText(100)
            ,'created_at'       => $date
            ,'updated_at'       => $date
            ,'deleted_at'       => $this->faker->randomNumber(1) <= 5 ? $date : null
        ];
    }
}
