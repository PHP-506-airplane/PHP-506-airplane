<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function main() {
        return view('welcome');
    }

    public function check() {
        return view('reservationChk');
    }
}
