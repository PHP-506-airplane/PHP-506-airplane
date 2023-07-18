<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : database/seeders
 * 파일명       : UserInfoSeeder.php
 * 이력         :   v001 0614 이동호 new
**************************************************/


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = now();
        DB::table('user_info')->insert([
            [
                'u_email'       => 'admin@a.a'
                ,'u_pw'         => Hash::make('qwer1234!')
                ,'u_gender'     => 0
                ,'u_name'       => '관리자'
                ,'u_birth'      => '19961123'
                ,'qa_no'        => 2
                ,'qa_answer'    => '집'
                ,'created_at'   => $date
                ,'updated_at'   => $date
                ,'admin_flg'    => 1
            ]
        ]);
    }
}
