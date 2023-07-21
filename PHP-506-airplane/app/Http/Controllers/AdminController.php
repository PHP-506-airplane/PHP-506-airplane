<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminPageMiddleware;
use App\Models\AirLineInfo;
use App\Models\AirportInfo;
use App\Models\FlightInfo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    // 미들웨어로 관리자권한 체크
    public function __construct() {
        $this->middleware(AdminPageMiddleware::class)->only(['index']);
    }

    public function index() {
        $today = Carbon::now()->toDateString();
        $airLine = AirLineInfo::get();
        $port = AirportInfo::get();
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
            ->groupBy('flight_info.fly_no')
            ->orderBy('flight_info.fly_date')
            ->orderBy('flight_info.dep_time')
            ->paginate(10);

        return view('admin')
            ->with('today', $today)
            ->with('airLine', $airLine)
            ->with('port', $port)
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
    
            // 날짜 범위 + 항공사를 기준으로 운항 정보 검색
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

            if ($airline != 0) {
                $data->where('line.line_no', $airline);
            }

            if ($depPort != 0) {
                $data->where('dep_port_no', $depPort);
            }

            if ($arrPort != 0) {
                $data->where('arr_port_no', $arrPort);
            }

            $data = $data->groupBy('flight_info.fly_no')
                ->orderBy('flight_info.fly_date')
                ->orderBy('flight_info.dep_time')
                ->paginate(10);

            // Log::debug($data);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
