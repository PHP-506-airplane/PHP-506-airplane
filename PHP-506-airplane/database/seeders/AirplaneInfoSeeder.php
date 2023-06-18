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
        AirplaneInfo::insert([
            ['plane_name' => 'A101', 'total_seat_num' => 96]
            ,['plane_name' => 'A102', 'total_seat_num' => 96]
            ,['plane_name' => 'A103', 'total_seat_num' => 96]
            ,['plane_name' => 'A104', 'total_seat_num' => 96]
            ,['plane_name' => 'A105', 'total_seat_num' => 96]
        ]);

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
