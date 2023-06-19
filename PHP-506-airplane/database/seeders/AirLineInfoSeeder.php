<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : database/seeders
 * 파일명       : LineInfoSeeder.php
 * 이력         :   v001 0615 이동호 new
**************************************************/

namespace Database\Seeders;

use App\Models\AirLineInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirLineInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AirLineInfo::insert([
            ['line_name'    => '종이비행기항공',    'line_code' => 'AP']
            ,['line_name'   => '대한항공',          'line_code' => 'KE']
            ,['line_name'   => '아시아나항공',      'line_code' => 'OZ']
            ,['line_name'   => '에어프레미아',      'line_code' => 'YP']
            ,['line_name'   => '제주항공',          'line_code' => '7C']
            ,['line_name'   => '진에어',            'line_code' => 'LJ']
            ,['line_name'   => '에어부산',          'line_code' => 'BX']
            ,['line_name'   => '이스타항공',        'line_code' => 'ZE']
            ,['line_name'   => '티웨이항공',        'line_code' => 'TW']
            ,['line_name'   => '에어서울',          'line_code' => 'RS']
            ,['line_name'   => '플라이강원',        'line_code' => '4V']
            ,['line_name'   => '에어로케이항공',    'line_code' => 'RF']
        ]);
    }
}
