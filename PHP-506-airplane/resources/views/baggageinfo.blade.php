{{--
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : baggageinfo.blade.php
 * 이력         :   v001 0623 이동호 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '수하물 안내')

@section('css')
<link rel="stylesheet" href="{{asset('css/baggageinfo.css')}}">
@endsection

@section('contents')
{{-- <div class="baggageinfoHeader">
    <h1 class="noticeH1">수하물 안내</h1>
    <h5 class="noticeH5">수하물 관련 규정을 확인하세요.</h5>
</div>
<div class="baggageinfoContainer">
    <div class="divLi">
        <div class="title">휴대 수하물</div>
        <br>
        <ul>
            <li>
                고객이 기내로 가져갈 수 있는 수하물을 말합니다.
            </li>
            <li>
                10 kg 이하 1개에 한함
                <br>
                (세변의 합이 115 cm 이하, 각 변의 최대치는 가로 40 cm, 세로 20 cm, 높이 55 cm미만)
            </li>
            <li>
                추가 허용 품목 : 노트북 컴퓨터, 서류가방, 핸드백 중 1개
            </li>
            <li>기내 휴대 수하물 허용 기준을 초과(무게, 사이즈 또는 개수)하는 모든 수하물은 반드시 수속카운터에서 미리 부치시기 바랍니다.
                <br>
                탑승구에서 위탁 시 별도 수수료가 부과됩니다.
            </li>
            <li>
                객실 안전 및 승객의 편의를 위해 통로 및 비상구로의 접근을 방해하거나 주변 승객에게 불편을 줄 수 있는 개인 편의 용품은 기내 사용이 불가합니다.
                <br>
                (예 : Bed Box, Fly Legs Up, FLY-Tot, Plane Pal, Inflatable Cube 등)
            </li>
            <li>
                단, 기내 휴대 수하물 허용 규격에 부합하는 경우 기내 반입은 가능하나, 기내 탑재공간 부족시 탑승구에서 위탁될수 있으니 이점 양지하시기 바랍니다.
            </li>
        </ul>
        <div class="title">무료 위탁 수하물</div>
        <br>
        <ul>
            <li>
                고객이 출발지 공항에서 항공사에 탁송 의뢰하여 목적지 공항에서 수취하는 수하물을 말합니다.
            </li>
            <li>
                안전한 수하물 위탁을 위해 가방(짐)은 항공사에서 안내하는 지정된 크기와 무게를 지켜 준비하여 주시기 바랍니다.
            </li>
            <li>
                위탁 수하물 1개의 크기가 203cm(가로 X 세로 X 높이의 합)를 초과할 경우 위탁 수하물로서의 운송이 거절될 수 있습니다.
            </li>
            <li>
                위탁 수하물 1개의 무게는 32kg을 초과할 수 없으며, 초과 시에는 분리하여 포장해 주셔야 합니다.
            </li>
        </ul>
    </div>
    <br>
    <table class="bbsList">
        <colgroup>
            <col width="20%">
            <col width="">
        </colgroup>
        <thead>
            <tr>
                <th scope="col">지역</th>
                <th scope="col">성인 및 소아 (만 2세 이상)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">국내선</th>
                <td class="al">15kg</td>
            </tr>
        </tbody>
    </table>
    <table class="bbsList">
        <colgroup>
            <col width="20%">
            <col width="">
        </colgroup>
        <thead>
            <tr>
                <th scope="col">지역</th>
                <th scope="col">유아 (만 2세 미만)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">국내선</th>
                <td class="al">접는 유모차, 유아용 카시트 중 1개</td>
            </tr>
        </tbody>
    </table>
</div> --}}

<button onclick="requestPay()">결제하기</button>


<div style="min-height: 830px"></div>

@endsection

@section('js')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

{{-- <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.2.0.js"></script> --}}

<script>
    let IMP = window.IMP;
    IMP.init("imp11776700"); // 예: imp00000000

    function requestPay() {
        // IMP.request_pay(param, callback) 결제창 호출
        IMP.request_pay({ // param
            pg: "kakaopay" // pg사
            // ,pg: "tosspay"
            // ,pg: "html5_inicis" // ********** 이니시스는 진짜로 결제되고 밤에 취소된다고 하니 주의 **********
            ,pay_method: "card"
            ,name: "항공권" // 상품명
            ,amount: 99999 // 가격
            ,buyer_email: "ldh517525@gmail.com"
            ,buyer_name: "풀스택" // 구매자명
        }, function(res) { // callback
            if (res.success) {
                // 결제 성공 시 로직
                // TODO : DB insert 추가
                let resData = {
                    // 저장할 데이터 추가하기
                    amount: res.paid_amount
                }

                axios.post('/pay/store', resData)
                .then(function(res) {
                    // DB 저장 성공 시 로직
                    alert('예약이 완료되었습니다.');
                    // TODO : 결제성공 페이지 추가후 URL교체
                    window.location.href = "/reservation/myreservation";
                })
                .catch(function(error) {
                    // DB 저장 실패 시 로직
                    console.log(error);
                    
                    // 오류 메시지 확인
                    let errorMessage = error.response ? error.response.data.message : error.message;
                    alert('예약을 저장하는중 오류가 발생했습니다.\n' + errorMessage);
                });
            } else {
                // 결제 실패 시 로직
                alert("결제에 실패했습니다.\n" +  res.error_msg);
            }
        });
    }
</script>
{{-- <script src="{{asset('js/baggageinfo.js')}}"></script> --}}
{{-- <script>    
    var IMP = window.IMP; // 생략 가능
    IMP.init("imp11776700"); // 예시 : imp00000000
    function requestPay(isLogin) {
        
        // 로그인 체크
        if (!isLogin) {
            alert("로그인 후 이용할 수 있습니다.");
            return;
        }


        // 값 세팅
        getCurrentUserInfo();
        let temp = getMerchantUid_setPrice();
        let merchant_uid = temp.merchant_uid;
        let pay_auth_id = temp.pay_auth_id;
        let amount = temp.price;
        

        // 결제창 호출 코드
        IMP.request_pay({ // 파라미터
            pg: "kakaopay", // pg사
            // pg: "tosspay",
            // pg: "html5_inicis", // ********** 이니시스는 진짜로 결제되고 밤에 취소된다고 하니 주의 **********
            pay_method: "card", // 결제 수단
            merchant_uid: merchant_uid, //주문번호
            name: '항공권',  //결제창에서 보여질 이름
            amount: amount,  //가격 
            buyer_name: buyer_name,// 구매자 이름
            buyer_tel: buyer_tel, // 구매자 전화번호
        }, function (rsp) { 
            if (rsp.success) { // 결제 성공

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "/pay/complete",
                    method: "POST",
                    dataType : "JSON",
                    data: {
                        imp_uid: rsp.imp_uid,
                        merchant_uid: rsp.merchant_uid,
                        pay_auth_id : pay_auth_id,
                        goods_id : goods_id,
                    },
                    success: function(data) {
                        if(data.result.code!=200){
                            //결제실패(웹서버측 실패)   
                            // TODO : 환불 코드
                            alert("위조된 결제 시도에 의해 결제에 실패했습니다.");  
                            removePayAuth(pay_auth_id);// pay_auth 값 지우기
                        }else{
                            //결제성공(웹서버측 성공)
                            alert("결제에 성공했습니다.");
                        }
                    },
                    error: function(data) {
                        console.log("error" +data);
                    }
                });
            } else {
                removePayAuth(pay_auth_id); // pay_auth 값 지우기
                alert("결제에 실패했습니다. : " +  rsp.error_msg);
            }
        });
    }
    
    // 현재 사용자의 정보를 가져오는 함수
    function getCurrentUserInfo() {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            // url: "/users/getCurrentUser",
            url: "{{ route('users.getCurrentUser') }}",
type: "get",
async: false, // 동기방식(전역변수에 값 저장하려면 필요)
dataType : "json",
success : function(data) {
buyer_name = data.name;
buyer_tel = data.tel;
},
error: function(request,status,error){
alert("code = "+ request.status + " message = " + request.responseText + " error = " + error);
console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
}
});
}

// 주문번호를 가져오는 함수
function getMerchantUid_setPrice() {
var result = "";
$.ajax({
headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
url: "/pay/getMerchantUidAndSetPrice",
type: "GET",
async:false, // 동기방식(전역변수에 값 저장하려면 필요)
dataType: "json",
data : {
// TODO: flight_no로 바꾸기
goods_id : 1
},
success : function(data) {
result = data;
},
error: function(request,status,error){
alert("code = "+ request.status + " message = " + request.responseText + " error = " + error);
console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
result = "error";
}
});
return result;
}

function removePayAuth(removePayAuthId) {
$.ajax({
headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
url: "/pay/removePayAuth",
method: "POST",
dataType : "text",
data: {
removePayAuthId : removePayAuthId
},
success: function() {

},
error: function(request, status, error) {
console.log("status : " + request.status + ", message : " + request.responseText + ", error : " + error);
}
});
}
</script> --}}
@endsection
