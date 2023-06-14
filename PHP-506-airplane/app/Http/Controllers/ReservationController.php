<?php

namespace App\Http\Controllers;

use App\Models\AirportInfo;
use App\Models\FlightInfo;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function main() {
        $result = AirportInfo::select('*')->get();
         return view('welcome')->with('data',$result);
    }

    public function check(Request $req) {
        // $result = FlightInfo::select('*')
        // ->where('dep_port_no','1')
        // ->where('arr_port_no','2')
        // ->whereBetween('fly_date',['2022-05-13','2023-06-15'])
        // ->get();

        // return var_dump($result);
        return view('reservationChk');
    }
}
