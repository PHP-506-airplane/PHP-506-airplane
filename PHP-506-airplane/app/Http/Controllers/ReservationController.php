<?php

namespace App\Http\Controllers;

use App\Models\AirportInfo;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function main() {
        $result = AirportInfo::select('port_name')->get();
        return view('welcome')->with('data',$result);
    }

    public function check() {
        return view('reservationChk');
    }
}
