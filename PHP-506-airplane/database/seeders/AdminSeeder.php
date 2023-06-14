<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = now();
        DB::table('admin_info')->insert([
            [
                'adm_email'     => 'admin@a.a'
                ,'adm_pw'       => Hash::make('qwer1234!')
                ,'adm_flg'      => 0
                ,'created_at'   => $date
                ,'updated_at'   => $date
            ]
        ]);
    }
}
