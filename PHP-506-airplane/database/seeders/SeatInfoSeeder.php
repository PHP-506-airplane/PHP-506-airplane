<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : database/seeders
 * 파일명       : SeatInfoSeeder.php
 * 이력         :   v001 0618 이동호 new
**************************************************/

namespace Database\Seeders;

use App\Models\SeatInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeatInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            // 해당 plane_no에 A 1 ~ I 12 좌석 생성
            $seats = $this->generateSeats();

            foreach ($seats as $seat) {
                SeatInfo::create([
                    'seat_no'   => $seat // 좌석 번호
                    ,'plane_no' => $i // 비행기 번호
                ]);
            }
        }
    }

    private function generateSeats()
    {
        $seats = [];

        for($i = 'A'; $i <= 'I'; $i++) {
            for($num = 1; $num <= 12; $num++) {
                // 좌석 번호 생성 ex) A01, A02, B01, B02, ...
                $seat = $i . str_pad($num, 2, '0', STR_PAD_LEFT);
                // 생성한 좌석 번호 배열에 추가
                $seats[] = $seat;
            }
        }

        // 생성한 좌석 번호 배열 반환
        return $seats;
    }
}
