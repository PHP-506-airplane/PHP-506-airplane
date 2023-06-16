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
use Illuminate\Database\Query\JoinClause;

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
        // 왕복
        if($req->hd_li_flg === '1'){

        // 가는편
        $result = DB::table('flight_info')
        ->join('airport_info as dep_port','dep_port.port_no', '=', 'flight_info.dep_port_no')
        ->join('airport_info as arr_port','arr_port.port_no', '=', 'flight_info.arr_port_no')
        ->select(
                'flight_info.*'
                ,'dep_port.port_no AS dep2_port_no'
                ,'dep_port.port_eng AS dep_port_eng'
                ,'dep_port.port_name AS dep_port_name'
                ,'arr_port.port_no AS arr2_port_no'
                ,'arr_port.port_eng AS arr_port_eng'
                ,'arr_port.port_name AS arr_port_name'
                )
        ->where([
            ['flight_info.dep_port_no', '=', $req->dep_port_no],
            ['flight_info.arr_port_no', '=', $req->arr_port_no],
        ])
        ->whereBetween('flight_info.fly_date',[substr($req->fly_date,0,-13),substr($req->fly_date,13)])
        ->limit(5)
        ->get();

        // 오는편
        $result2 = DB::table('flight_info')
        ->join('airport_info as dep_port','dep_port.port_no', '=', 'flight_info.dep_port_no')
        ->join('airport_info as arr_port','arr_port.port_no', '=', 'flight_info.arr_port_no')
        ->select(
                'flight_info.*'
                ,'dep_port.port_no AS dep2_port_no'
                ,'dep_port.port_eng AS dep_port_eng'
                ,'dep_port.port_name AS dep_port_name'
                ,'arr_port.port_no AS arr2_port_no'
                ,'arr_port.port_eng AS arr_port_eng'
                ,'arr_port.port_name AS arr_port_name'
                )
        ->where([
            ['flight_info.dep_port_no', '=', $req->arr_port_no],
            ['flight_info.arr_port_no', '=', $req->dep_port_no],
        ])
        ->whereBetween('flight_info.fly_date',[substr($req->fly_date,0,-13),substr($req->fly_date,13)])
        ->limit(5)
        ->get();

        return view('reservationChk')->with('data',$result)->with('data2',$result2);

        }else{
            // 편도

        }
        


    }
    public function checkpost(Request $req){

        return view('reservationSeat');
    }
    
}
