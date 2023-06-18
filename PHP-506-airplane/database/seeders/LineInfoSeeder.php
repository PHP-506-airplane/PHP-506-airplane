<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : database/seeders
 * 파일명       : LineInfoSeeder.php
 * 이력         :   v001 0615 이동호 new
**************************************************/

namespace Database\Seeders;

use App\Models\LineInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LineInfo::insert([
            ['line_name' => '종이비행기항공']
            ,['line_name' => '대한항공']
            ,['line_name' => '아시아나항공']
            ,['line_name' => '에어프레미아']
            ,['line_name' => '제주항공']
            ,['line_name' => '진에어']
            ,['line_name' => '에어부산']
            ,['line_name' => '이스타항공']
            ,['line_name' => '티웨이항공']
            ,['line_name' => '에어서울']
            ,['line_name' => '플라이강원']
            ,['line_name' => '에어로케이항공']
        ]);
    }
}
