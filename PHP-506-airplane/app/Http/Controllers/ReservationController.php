<?php

namespace App\Http\Controllers;

use App\Models\AirportInfo;
use App\Models\FlightInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function main() {
        $result = AirportInfo::select('*')->get();
         return view('welcome')->with('data',$result);
    }

    public function check(Request $req) {
        // $result = FlightInfo::select('*')
        // ->where('dep_port_no',$req->dep_port_no)
        // ->where('arr_port_no',$req->arr_port_no)
        // ->whereBetween('fly_date',[substr($req->fly_date,0,-13),substr($req->fly_date,13)])
        // ->dd();

        $result = DB::table('flight_info')
                  ->join('airport_info','airport_info.port_no','=','flight_info.dep_port_no')
                  ->select('flight_info.*','airport_info.*')
                  ->get();
                  
        return view('reservationChk')->with('data',$result[0]);
    }
}
