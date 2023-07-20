<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : app/Console
 * 파일명       : Kernel.php
 * 이력         :   v001 0613 이동호 new
 *                  v002 0614 이동호 del
**************************************************/
    

namespace App\Console;

use App\Mail\sendReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\FlightInfo;
use App\Models\Payment;
use App\Models\ReserveInfo;
use App\Models\TicketInfo;
use App\Models\Userinfo;
use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    // protected function schedule(Schedule $schedule)
    // {
    //     $schedule->call(function () {
    //         Log::error('스케줄러 테스트');
    //         // php artisan schedule:list // 리스트 보기
    //         // php artisan schedule:work // 스케줄러 시작
    //     })->everyMinute();
    // }
    protected function schedule(Schedule $schedule)
    {
        // 매달 1번씩 실행
        // $schedule->command(FlightInfoFactoryCommand::class)->monthlyOn(1, '01:00');
        // $schedule->call(function () {
            // v002 del ---------------------------------------------------------------------
            // 운항 스케줄 api
            // $serviceKey = '?serviceKey=q1Huc9EjZjvBYP%2BNKi0ILB%2FS%2BhmYkimR2o%2FIfQey1bl0NGsyoDHQJVnSYSEwPfvS9C9SqZkaD%2FXMw9SLRkLlqA%3D%3D';
            // $response = Http::get('http://openapi.airport.co.kr/service/rest/FlightStatusList/getFlightStatusList' . $serviceKey);

            // if ($response->successful()) {
            //     $xmlString = $response->body();
            //     $xmlObject = simplexml_load_string($xmlString);
            //     $data = json_decode(json_encode($xmlObject), true);

            //     if (isset($data['body']['items']['item'])) {
            //         $items = $data['body']['items']['item'];

            //         // DB에 저장
            //         $faker = FakerFactory::create();

            //         foreach ($items as $item) {
            //             $flightInfo = new FlightInfo();

            //             // fly_date 값을 변경해서 'Y-m-d' 형식으로 저장
            //             $flyDate = Carbon::parse($item['flightDate'])->format('Y-m-d');
            //             $flightInfo->fly_date = $flyDate;

            //             $flightInfo->price = $faker->randomNumber(5, 6);
            //             $flightInfo->dep_port_no = $faker->randomNumber(1);
            //             $flightInfo->arr_port_no = $faker->randomNumber(1);
            //             $flightInfo->line_no = $faker->randomNumber(1);
            //             $flightInfo->flight_num = $item['airFln'];
            //             $flightInfo->dep_time = $item['std'];
            //             // ?? : null 병합 연산자, 값이 null이 아니라면 그 값을, null이라면 ??뒤의 값을 사용
            //             $flightInfo->arr_time = $item['etd'] ?? '0000';
            //             $flightInfo->plane_no = $faker->randomNumber(1);

            //             $flightInfo->save();
            //         }
            //     } else {
            //         // 'item' 키가 응답에 없는 경우 처리
            //         Log::error('API 응답에 item이 없음');
            //     }
            // } else {
            //     // API 요청이 성공하지 않은 경우 처리
            //     Log::error('API 요청이 상태 코드 ' . $response->status() . '로 실패함');
            // }
            // /v002 del ---------------------------------------------------------------------
            // 매 시간마다 FlightInfoFactoryCommand를 실행

        // })->everyMinute(); // php artisan schedule:run 명령어로 즉시 실행시 사용
        // })->dailyAt('10:00'); // 매일 아침 10시에 실행

        // 2년이상 지난 데이터 삭제
        $schedule->call(function () {
            $this->deleteData();
        })->dailyAt('10:00');

        $schedule->call(function () {
            $this->sendRemindEmail();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    protected function deleteData() {
        $twoYearsAgo = Carbon::now()->subYears(2); // 오늘로부터 2년전 날짜

        FlightInfo::where('fly_date', '<', $twoYearsAgo)
            ->forceDelete();

        ReserveInfo::join('flight_info AS fli', 'fli.fly_no', 'reserve_info.fly_no')
            ->where('fli.fly_date', '<', $twoYearsAgo)
            ->forceDelete();

        TicketInfo::join('reserve_info AS res', 'res.reserve_no', 'ticket_info.reserve_no')
            ->join('flight_info AS fli', 'fli.fly_no', 'res.fly_no')
            ->where('fli.fly_date', '<', $twoYearsAgo)
            ->forceDelete();

        Payment::where('deleted_at', '<', $twoYearsAgo)
            ->forceDelete();

        Userinfo::where('deleted_at', '<', $twoYearsAgo)
            ->forceDelete();
    }

    protected function sendRemindEmail() {
        $datas = 
            // 오늘 이후의 날짜
            // 2023-07-20 14:30:00같은 Carbon 객체에서 toDateString()을 호출하면 "2023-07-20"을 반환함
            FlightInfo::where('fly_date', '>=', Carbon::now()->toDateString())
                // 1일 이내의 날짜
                ->where('fly_date', '<=', Carbon::now()->addDays(1)->toDateString())
                // 현재 시간 + 3시간
                ->where('dep_time', '=', Carbon::now()->addHours(3)->format('Hi'))
                ->join('reserve_info AS res', 'flight_info.fly_no', 'res.fly_no')
                ->join('user_info AS user', 'res.u_no', 'user.u_no')
                ->join('airport_info AS dep', 'flight_info.dep_port_no', 'dep.port_no')
                ->join('airport_info AS arr', 'flight_info.arr_port_no', 'arr.port_no')
                ->join('airplane_info AS airp', 'flight_info.plane_no', 'airp.plane_no')
                ->join('airline_info AS airl', 'airp.line_no', 'airl.line_no')
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

        if ($datas) {
            foreach ($datas as $data) {
                Mail::to($data->u_email)->send(new sendReminder($data));
            }
        }
    }
}
