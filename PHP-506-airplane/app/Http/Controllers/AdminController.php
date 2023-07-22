<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : Http/Controller
 * 파일명       : AdmionController.php
 * 이력         :   v001 0721 이동호 new
**************************************************/

namespace App\Http\Controllers;

use App\Http\Middleware\AdminPageMiddleware;
use App\Mail\ResCancel;
use App\Models\AirLineInfo;
use App\Models\AirportInfo;
use App\Models\FlightInfo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    protected $today;
    protected $airLine;
    protected $port;

    public function __construct() {
        // 미들웨어로 관리자권한 체크
        $this->middleware(AdminPageMiddleware::class);
        $this->today = Carbon::now()->toDateString();
        $this->airLine = AirLineInfo::get();
        $this->port = AirportInfo::get();
    }

    public function index() {

        $data =  FlightInfo::join('reserve_info AS res', 'flight_info.fly_no', 'res.fly_no')
            ->join('airport_info AS dep', 'flight_info.dep_port_no', 'dep.port_no')
            ->join('airport_info AS arr', 'flight_info.arr_port_no', 'arr.port_no')
            ->join('airplane_info AS plane', 'flight_info.plane_no', 'plane.plane_no')
            ->join('airline_info AS line', 'plane.line_no', 'line.line_no')
            ->select(
                'flight_info.*'
                ,'dep.port_name AS dep_port_name'
                ,'arr.port_name AS arr_port_name'
                ,'line.line_name'
                ,DB::raw('COUNT(res.fly_no) AS count')
            )
            ->where('flight_info.fly_date', '>', Carbon::now()->subDay())
            ->withTrashed()
            ->groupBy('flight_info.fly_no')
            ->orderBy('flight_info.fly_date')
            ->orderBy('flight_info.dep_time')
            ->paginate(10);

        return view('admin')
            ->with('today', $this->today)
            ->with('airLine', $this->airLine)
            ->with('port', $this->port)
            ->with('data', $data);
    }

    public function search(Request $req) {
        // Log::debug($req);
        try {
            $dateStart = $req->dateStart;
            $dateEnd = $req->dateEnd;
            $airline = $req->airline;
            $depPort = $req->depPort;
            $arrPort = $req->arrPort;
            $state = $req->state;
    
            // 운항 정보 검색
            $data = FlightInfo::join('reserve_info AS res', 'flight_info.fly_no', 'res.fly_no')
                ->join('airport_info AS dep', 'flight_info.dep_port_no', 'dep.port_no')
                ->join('airport_info AS arr', 'flight_info.arr_port_no', 'arr.port_no')
                ->join('airplane_info AS plane', 'flight_info.plane_no', 'plane.plane_no')
                ->join('airline_info AS line', 'plane.line_no', 'line.line_no')
                ->select(
                    'flight_info.*'
                    ,'dep.port_name AS dep_port_name'
                    ,'arr.port_name AS arr_port_name'
                    ,'line.line_name'
                    ,'line.line_no'
                    ,DB::raw('COUNT(res.fly_no) AS count')
                )
                ->whereBetween('fly_date', [$dateStart, $dateEnd]);

            if ($airline !== '0') {
                $data->where('line.line_no', $airline);
            }

            if ($depPort !== '0') {
                $data->where('dep_port_no', $depPort);
            }

            if ($arrPort !== '0') {
                $data->where('arr_port_no', $arrPort);
            }

            if ($state === '1') {
                $data->whereNull('deleted_at');
            } else if ($state === '2') {
                $data->whereNotNull('deleted_at');
            }

            $data = $data->withTrashed()
                ->groupBy('flight_info.fly_no')
                ->orderBy('flight_info.fly_date')
                ->orderBy('flight_info.dep_time')
                ->paginate(10);
                // ->get();

            // Log::debug($data);

            return view('admin')
                ->with('today', $this->today)
                ->with('airLine', $this->airLine)
                ->with('port', $this->port)
                ->with('data', $data);

        } catch (Exception $e) {
            Log::debug($e);
        }
    }

    public function delete(Request $req) {
        Log::debug($req);
        try {
            DB::beginTransaction();

            $data = FlightInfo::find($req->fly_no);

            if (!$data) {
                return response()
                    ->json([
                        'success' => false
                        ,'message' => '존재하지 않는 데이터입니다.'
                    ]);
            }

            $data->deleted_at = Carbon::now();
            $data->del_reason = $req->del_reason;
            $data->save();

            $userList = FlightInfo::where('flight_info.fly_no', $data->fly_no)
                ->join('reserve_info AS res', 'flight_info.fly_no', 'res.fly_no')
                ->join('ticket_info AS tic', 'res.reserve_no', 'tic.reserve_no')
                ->join('user_info AS user', 'res.u_no', 'user.u_no')
                ->join('airport_info AS dep', 'flight_info.dep_port_no', 'dep.port_no')
                ->join('airport_info AS arr', 'flight_info.arr_port_no', 'arr.port_no')
                ->join('airplane_info AS airp', 'flight_info.plane_no', 'airp.plane_no')
                ->join('airline_info AS airl', 'airp.line_no', 'airl.line_no')
                ->withTrashed()
                ->select(
                    'user.u_name'
                    ,'user.u_email'
                    ,'airl.line_name'
                    ,'flight_info.dep_time'
                    ,'flight_info.arr_time'
                    ,'flight_info.fly_date'
                    ,'dep.port_name AS dep_port_name'
                    ,'arr.port_name AS arr_port_name'
                )
                ->get();
        
            foreach ($userList as $user) {
                // Log::debug($user);
                Mail::to($user->u_email)->send(new ResCancel($user, $data->del_reason));
            }

            DB::commit();
            return response()
                ->json([
                    'success' => true
                    ,'message' => '삭제 완료'
                ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e);

            return response()
                ->json([
                    'success' => false
                    ,'message' => '서버 에러'
                ]);
        }
    }
}
