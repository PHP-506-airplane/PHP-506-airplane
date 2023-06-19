<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : database/seeders
 * 파일명       : AirplaneInfoSeeder.php
 * 이력         :   v001 0616 이동호 new
**************************************************/

namespace Database\Seeders;

use App\Models\AirplaneInfo;
use App\Models\LineInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class airplaneInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        for($j = 101; $j <= 105; $j++) {
            for($i = 1; $i <= 12; $i++) {
                $arr[] = ['plane_name' => 'A'.$j, 'total_seat_num' => 96 , 'line_no' => $i];
            }
        }

        AirplaneInfo::insert($arr);

        // $airlines = LineInfo::all();
        // $lineNo = 1;

        // foreach ($airlines as $airline) {
        //     AirplaneInfo::create([
        //         'plane_name' => 'Air' . $lineNo
        //         ,'total_seat_num' => 96
        //         ,'line_no' => $lineNo
        //     ]);

        //     $lineNo++;
        // }
    }
}
