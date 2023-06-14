<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : app/Http/Controllers
 * 파일명       : ReservationController.php
 * 이력         :   v001 0612 오재훈 new
 *                  v002 0614 이동호 add 공지사항
**************************************************/

namespace App\Http\Controllers;

use App\Models\NoticeInfo;
use App\Models\AirportInfo;
use App\Models\FlightInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function main() {
        // $result = AirportInfo::select('*')->get(); //v002 del 이동호
        $data = AirportInfo::select('*')->get();

        // v002 add 이동호
        // 최신 공지사항 5개 가져오기
        $notices = NoticeInfo::select(['notice_title', 'notice_no', 'created_at'])
        ->orderBy('notice_no', 'desc')
        ->take(5)
        ->get();
        
        //  return view('welcome')->with('data',$result); //v002 del 이동호
        return view('welcome', compact('notices', 'data'));
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
