<?php

use Illuminate\Support\Facades\Http;

/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : app/Helpers
 * 파일명       : Helpers.php
 * 이력         :   v001 0623 이동호 new
**************************************************/

// ---------------------------------
// 메소드명	: TimeCalculation
// 기능		: '0000'형식인 문자열 시간 차이 계산
// 파라미터	:   String	&$start_time
//			    String		&$end_time
// 리턴값	:   String
// ---------------------------------
function TimeCalculation($start_time, $end_time) {
    $start_hour = (int)substr($start_time, 0, 2);
    $start_minute = (int)substr($start_time, 2, 2);

    $end_hour = (int)substr($end_time, 0, 2);
    $end_minute = (int)substr($end_time, 2, 2);

    if ($end_hour < $start_hour) {
        $end_hour += 24;
    }

    $hour_difference = $end_hour - $start_hour;
    $minute_difference = $end_minute - $start_minute;

    if ($minute_difference < 0) {
        $hour_difference--;
        $minute_difference += 60;
    }
    
    if ($hour_difference > 0 || $minute_difference > 60) {
        return '60분';
    }

    return $minute_difference . '분';
}

// ---------------------------------
// 메소드명	: getToken
// 기능		: 아임포트 환불시 필요한 토큰발급
// 파라미터	:
// 리턴값	: Arr
// ---------------------------------
function getToken() {
    $result  = Http::withHeaders([
        'Content-Type' => 'application/json'
    ])->post('https://api.iamport.kr/users/getToken', [
        // 'imp_key' => '8117658714750626',
        // 'imp_secret' => 'sOcpvVruTxXeQ7p1k0NRPyphuqDgZxKFfCuSX1vkSpMC3B46rQEzEzXGaADpdeoHHj1bC3DzWwQSMaXD',
        'imp_key' => '0833844628848866',
        'imp_secret' => 'l17oW36JAtRW7TaNjsZeBTLwdM0XbIFYJysHLDYzSBdn3yDgkDIM36G75yQ29SImMWw130HxvvbzIJNv',
    ]);
    $arr_result = json_decode($result, true);
    return $arr_result["response"]["access_token"];
}