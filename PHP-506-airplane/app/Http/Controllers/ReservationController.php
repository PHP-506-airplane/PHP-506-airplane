<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : app/Http/Controllers
 * 파일명       : ReservationController.php
 * 이력         :   v001 0612 오재훈 new
 *                  v002 0614 이동호 add 공지사항
 *                  v003 0620 이동호 add 나의 예약 조회 페이지
 *                  v004 0621 이동호 add 최저가 항공
**************************************************/

namespace App\Http\Controllers;

use App\Models\NoticeInfo;
use App\Models\AirportInfo;
use App\Models\FlightInfo;
use App\Models\ReserveInfo;
use App\Models\SeatInfo;
use App\Models\TicketInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function main() {
        // $result = AirportInfo::select('*')->get(); //v002 del 이동호
        $data = 
            AirportInfo::select('*')
            ->orderby('port_name')
            ->get();

        // v002 add 이동호
        // 최신 공지사항 5개 가져오기
        $notices = 
            NoticeInfo::select('notice_title', 'notice_no', 'created_at')
                ->orderBy('notice_no', 'desc')
                ->take(5)
                ->get();

        // v004 이동호
        // 최저가항공 6개 가져오기
        $lowCost = 
            FlightInfo::join('airport_info AS dep', 'flight_info.dep_port_no', 'dep.port_no')
                ->join('airport_info AS arr', 'flight_info.arr_port_no', 'arr.port_no')
                ->select(
                    'flight_info.fly_date'
                    ,'flight_info.price'
                    ,'dep.port_name AS dep_name'
                    ,'arr.port_name AS arr_name'
                )
                ->where('flight_info.fly_date', '>', now())
                ->orderBy('price')
                ->orderBy('flight_info.fly_date')
                ->limit(8)
                ->get();
        
        //  return view('welcome')->with('data',$result); //v002 del 이동호
        return view('welcome', compact('notices', 'data', 'lowCost'));
    }

    public function check(Request $req) {
        // 로그인체크
        if(empty(Auth::user())) {
            return redirect()->route('users.login')->with('alert', '로그인이 필요한 기능입니다.');
        }
        // 왕복/편도 플래그
        $flg = $req->only('hd_li_flg');
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

        return view('reservationChk')->with('data',$result)->with('data2',$result2)->with('flg',$flg);

        }else{
        // 편도
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
            ['flight_info.dep_port_no', '=', $req->one_dep_port_no],
            ['flight_info.arr_port_no', '=', $req->one_arr_port_no],
        ])
        ->where('flight_info.fly_date','=',$req->one_fly_date)
        ->limit(5)
        ->get();

        return view('reservationChk')->with('oneway',$result)->with('flg',$flg);
        }
        


    }
    public function checkpost(Request $req){
        //왕복
        if($req->hd_li_flg =='1'){
            // 가는편
            $result = DB::table('reserve_info as res')
            ->join('flight_info as fli','res.fly_no', '=','fli.fly_no')
            ->join('airport_info as dep','dep.port_no', '=', 'fli.dep_port_no')
            ->join('airport_info as arr','arr.port_no', '=', 'fli.arr_port_no')
            ->select(
                        'fli.*'
                        ,'res.seat_no'
                        ,'dep.port_name as dep_name'
                        ,'dep.port_eng as dep_eng' 
                        ,'arr.port_name as arr_name'
                        ,'arr.port_eng as arr_eng'
                        )
            ->where('fli.fly_no','=',$req->dep_fly_no)
            ->where('fli.fly_date','>',now())
            ->get();

            // 예약된 좌석
            $availableSeats = DB::table('reserve_info')
                ->select('seat_no')
                ->where('fly_no','=',$req->dep_fly_no)
                ->get();

            // 오는편
        }

        

        // 좌석
        $seat = DB::table('seat_info')
        ->select('seat_no')
        ->limit(108)
        ->get();


        if(!isset($req->dep_fly_no)){
            return redirect()->back()->with('alert', '가는편 여정을 선택해주세요.');
        }elseif(!isset($req->arr_fly_no)){
            return redirect()->back()->with('alert', '오는편 여정을 선택해주세요.');
        }

        return view('reservationSeat')->with('data',$result)->with('seat',$seat)->with('able',$availableSeats);
    }

    public function seatpost(Request $req){

        if(!isset($req->seat_no)){
            return redirect()->back()->with('alert', '좌석을 선택해주세요.');
        }

        $reserveInfo = new ReserveInfo([
            'u_no'=> Auth::user()->u_no
            ,'seat_no' => $req->seat_no
            ,'fly_no' => $req->fly_no
            ,'plane_no' => $req->plane_no
        ]);

        $reserveInfo->save();

        
        return redirect()->route('reservation.myreservation');
    }
    
    // v003 이동호
    public function myreservation() {
        if(empty(Auth::user())) {
            return redirect()->route('users.login');
        }

        $data = [];
        $data = 
            ReserveInfo::join('flight_info AS fli', 'reserve_info.fly_no', 'fli.fly_no')
                ->join('airplane_info AS airp', 'fli.plane_no', 'airp.plane_no')
                ->join('airline_info AS airl', 'airp.line_no', 'airl.line_no')
                ->join('airport_info AS dep', 'fli.dep_port_no', 'dep.port_no')
                ->join('airport_info AS arr', 'fli.arr_port_no', 'arr.port_no')
                ->join('user_info AS user', 'reserve_info.u_no', 'user.u_no')
                ->join('ticket_info AS ticket', 'reserve_info.reserve_no', 'ticket.reserve_no')
                ->where('reserve_info.u_no', Auth::user()->u_no)
                ->select(
                    'reserve_info.*'
                    ,'fli.fly_date'
                    ,'dep.port_name AS dep_port_name'
                    ,'arr.port_name  AS arr_port_name'
                    ,'fli.flight_num'
                    ,'fli.dep_time'
                    ,'fli.arr_time'
                    ,'airp.plane_name'
                    ,'airl.line_name'
                    ,'airl.line_code'
                    ,'user.u_name'
                    ,'fli.fly_no'
                    ,'ticket.t_no'
                )
                ->limit(30)
                ->get();

        return view('myreservation')->with('data', $data);
    }

    public function rescancle(Request $req) {
        if(empty(Auth::user())) {
            return redirect()->route('users.login');
        }

        ReserveInfo::destroy($req->reserve_no);
        TicketInfo::where('t_no', $req->t_no)->delete();

        return redirect()->route('reservation.myreservation')->with('alert', '취소가 완료되었습니다.');
    }
}
