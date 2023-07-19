<?php

namespace App\Http\Controllers;

use App\Models\FlightInfo;
use App\Models\PayAuth;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class PayController extends Controller
{
    public function price($pk) {
        try {
            $price = FlightInfo::select('price')->where('fly_no', $pk)->first();
            return response()->json(['price' => $price->price], 200);
        } catch (QueryException $e) {
            // 오류 응답
            return response()->json(['msg' => 'API Error \n' . $e->getMessage()], 500);
        }
    }

    // public function getMerchantUidAndSetPrice() {
    //     // 주문번호 규칙 : 연월일(YYMMDD) + 숫자or영어 랜덤 5자리 = 11자리
    //     $today = date("ymd");
    //     $merchant_uid = $today.Str::random(5);    
    
    //     $good = FlightInfo::select('price')->first();
    //     $price = floor($good->price + ($good->price * (35 / 1000))); // 상품 금액의 3.5% -> 수익!
    
    
    //     $result['merchant_uid'] = $merchant_uid;
    //     $result['price'] = $price;
    
    //     return response()->json($result);
    // }

    // public function complete(Request $request) {
    //     $result = ["code"=>200, "message"=>"success"]; // 결제에 성공했다는 의미의 코드와 메세지를 넣음
    //     $imp_key = "8117658714750626"; // 아임포트 관리자 페이지 시스템설정->내정보->REST API 키 값
    //     $imp_secret = "sOcpvVruTxXeQ7p1k0NRPyphuqDgZxKFfCuSX1vkSpMC3B46rQEzEzXGaADpdeoHHj1bC3DzWwQSMaXD"; // 아임포트 관리자 페이지의 시스템설정->내정보->REST API Secret 값
    //     $imp_uid = request('imp_uid');// 결제 번호
    //     $merchant_uid = request("merchant_uid");// 주문 번호
    //     $pay_auth_id = request("pay_auth_id");// 주문 번호 id
    //     $goods_id = request("goods_id"); // 상품 id
    //     // $sale_user_id = DB::table('goods')->select('user_id')->where('id', $goods_id)->first(); // 판매자 id를 db에서 가져옴
    //     $sale_user_id = 1; // 상품 판매자


    //     try{
    //         // 엑세스 토큰 발급
    //         $getToken  = Http::withHeaders([
    //             'Content-Type' => 'application/json'
    //         ])->post('https://api.iamport.kr/users/getToken', [
    //             'imp_key' => $imp_key,
    //             'imp_secret' => $imp_secret,
    //         ]);
    //         $getTokenJson = json_decode($getToken, true);
    //         $access_token = $getTokenJson['response']['access_token'];


    //         // imp_uid로 아임포트 서버에서 결제 정보 조회
    //         $getPaymentData = Http::withHeaders([
    //             'Authorization' => $access_token
    //         ])->get('https://api.iamport.kr/payments/?imp_uid[]='.$imp_uid);
    //         $getPaymentDataJson = json_decode($getPaymentData,true);


    //         // $getPaymentDataJson['response'] : 아임포트에 요청한 실제 결제 정보
    //         $iamport_status = $getPaymentDataJson['response'][0]['status']; //아임포트 결제 상태 값 (paid : 정상 결제 된 값)
    //         $iamport_amount = $getPaymentDataJson['response'][0]['amount']; //아임포트 실제 결제 금액           
    //         $iamport_merchant_uid = $getPaymentDataJson['response'][0]['merchant_uid']; //아임포트 실제 주문번호


    //         // 결제 검증(XSS 공격 방지)
    //         $amount = FlightInfo::select('price')->first();
    //         $amount = floor($amount->price + ($amount->price * 35/1000)); // 수수료 3.5%

    //         // 결제 된 금액과 상품 금액이 동일한지 and 정상결제확인 and 주문번호 동일한지
    //         if($iamport_amount == $amount && $real_amout == $amount && $iamport_status == 'paid' 
    //             && $real_merchant_uid == $iamport_merchant_uid && $real_merchant_uid == $merchant_uid) {
    //                 if (auth()->check()) {
    //                     $currentUser = auth()->user()->u_no;
    //                 }
    //                 else {
    //                     $currentUser = null;
    //                     throw new Exception('로그인이 되어있지 않습니다.', 410);
    //                 }

    //             // db에 값 넣기
    //             Payment::create([
    //                 'merchant_uid'=>$merchant_uid,
    //                 'imp_uid'=>$imp_uid,
    //                 'amount'=>$iamport_amount,
    //                 'status'=>$iamport_status,
    //                 'buy_user_id'=>$currentUser,
    //                 'sale_user_id'=>$sale_user_id,
    //                 'goods_id'=>$goods_id
    //             ]);

    //             // pay_auth값 삭제
    //             PayAuth::where('id', $pay_auth_id)->delete();

    //             // goods 판매완료로 전환
    //             DB::table('goods')->where('id', $goods_id)->update(['sale_state' => 2]);
    //         }
    //         else {
    //             throw new Exception('위조된 결제를 시도했습니다.', 410);
    //             PayAuth::where('id', $pay_auth_id)->delete(); // pay_auth값 삭제
    //         }

    //     }catch(Exception $e){ // 예외처리
    //         $result = [
    //             'code' => 410,
    //             'message' => $e->getMessage()
    //         ];
    //     }

    //     return response()->json([
    //         'result'=>$result
    //     ]);
    // }

    // function removePayAuth() {
    //     $removePayAuthId = request('removePayAuthId');
    //     PayAuth::where('id', $removePayAuthId)->delete(); // pay_auth값 삭제
    // }

    public function getToken(){
        // 엑세스 토큰 발급
        $getToken  = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://api.iamport.kr/users/getToken', [
            'imp_key' => '0833844628848866',
            'imp_secret' => 'l17oW36JAtRW7TaNjsZeBTLwdM0XbIFYJysHLDYzSBdn3yDgkDIM36G75yQ29SImMWw130HxvvbzIJNv',
        ]);
        $getTokenJson = json_decode($getToken, true);
        return $getTokenJson;
    }

    // public function refundPay(Request $req){
    //     // 환불
    //    Http::withHeaders([
    //         'Content-Type' => 'application/json'
    //     ])->post('https://api.iamport.kr/payments/cancel', [
    //         'imp_uid' => $req->merchant_uid,
    //         'reason' => '결제취소',
    //     ]);
    //     return response()->json(['success' => true]);
    // }

    public function refundPay(Request $request)
    {
        $accessToken = $this->getToken();
        // 환불하려는 결제 정보를 아임포트의 payment_id를 기준으로 데이터베이스에서 조회합니다.
        $paymentId = $request->input('id');
        $paymentInfo = Payment::where('id', $paymentId)->first();

        // $userName = auth()->user()->u_name;

        // 결제 정보가 없거나 이미 환불된 경우 등 예외 상황을 처리합니다.
        // if (!$paymentInfo || $paymentInfo->refunded) {
        //     // 환불할 수 없는 경우에 대한 처리를 여기에 추가합니다.
        //     return response()->json(['message' => '환불할 수 없는 결제 정보입니다.'], 400);
        // }

        // 아임포트 API로 환불 요청을 보냅니다.
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $accessToken,
        ])->post("https://api.iamport.kr/payments/cancel", [
            'merchant_uid' => '2307181PuNQwap', // 주문번호
            'amount' => '2000', // 환불할 금액
            'reason' => '고객 요청에 의한 환불', // 환불 사유
        ]);

        // 카카오톡 메시지 발송 처리
        try {
            $response2 = Http::withHeaders([
                'Authorization' => 'Bearer '. $accessToken,
                'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
            ])->post('https://kapi.kakao.com/v2/api/talk/memo/default/send', [
                'template_object' => json_encode([
                    'object_type' => 'text',
                    'text' => "안녕하세요, 님! 환불이 완료되었습니다.",
                ]),
            ]);

            // 메시지 발송 결과에 따라 처리
            if ($response2->successful()) {
                // 성공적으로 메시지를 보냄
                return response()->json(['message' => '환불이 성공적으로 완료되었습니다.']);
            } else {
                // 메시지 발송 실패
                return response()->json(['message' => '환불 성공. 그러나 카카오톡 메시지 발송에 실패하였습니다.'], 500);
            }
        } catch (Exception $e) {
            // 예외 처리
            return response()->json(['message' => '환불 성공. 그러나 카카오톡 메시지 발송에 실패하였습니다.'], 500);
        }



        // 아임포트 API의 응답을 확인하고, 환불 결과에 따라 처리합니다.
        if ($response->successful()) {
            // 환불 성공
            // 환불 정보를 데이터베이스에 저장하거나 환불 처리를 기록하는 등의 작업을 수행합니다.
            // 예를 들어, $paymentInfo->update(['refunded' => true]) 등의 코드를 추가할 수 있습니다.
            return response()->json(['message' => '환불이 성공적으로 완료되었습니다.']);
        } else {
            // 환불 실패
            // 환불 실패에 대한 처리를 여기에 추가합니다.
            return response()->json(['message' => '환불에 실패하였습니다.'], 500);
        }
    }
}

