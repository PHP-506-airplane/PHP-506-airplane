@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('css/reserveInsert.css')}}">
@endsection

@section('contents')
<div class="container">
    <h1>탑승객 정보</h1>
    <form method="POST" action="{{ route('reservation.reserveConfirm'); }}">
        @csrf
        <input type="hidden" name="fly_no" value="{{$_POST['fly_no']}}" id="fly_no">
        <input type="hidden" name="merchant_uid" id="merchant_uid">
        <input type="hidden" name="plane_no" value="{{$_POST['plane_no']}}">
        {{-- 왕복 --}}
        @if($_POST['flg'] === '1')
            <input type="hidden" name="fly_no2" value="{{$_POST['fly_no2']}}" id="fly_no2">
            <input type="hidden" name="plane_no2" value="{{$_POST['plane_no2']}}">
            @for($i = 0; $i < $allCnt; $i++)
                <div class="divInput">
                    <div>이름</div>
                    <input type="text" name="name[]">
                    <div>성별</div>
                    <select name="gender[]" id="">
                        <option value="0">남</option>
                        <option value="1">여</option>
                    </select>
                    <div>생일</div>
                    <input type="date" name="birth[]">
                    <div>가는편 좌석</div>
                    <input type="text" name="seatGo[]" value="{{ $seat_no_go[$i] }}" readonly>
                    <div>오는편 좌석</div>
                    <input type="text" name="seatReturn[]" value="{{ $seat_no_return[$i] }}" readonly>
                </div>
            @endfor
        @else {{-- 편도 --}}
            @for($i = 0; $i < $allCnt; $i++)
                <div class="divInput">
                    <div>이름</div>
                    <input type="text" name="name[]">
                    <div>성별</div>
                    <select name="gender[]" id="">
                        <option value="0">남</option>
                        <option value="1">여</option>
                    </select>
                    <div>생일</div>
                    <input type="date" name="birth[]">
                    <div>가는편 좌석</div>
                    <input type="text" name="seatGo[]" value="{{ $seat_no_go[$i] }}" readonly>
            @endfor
        @endif
        <button type="button" onclick="requestPay();">결제하기</button>
    </form>
</div>
@endsection

@section('js')
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/reservationInsert.js')}}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

{{-- <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.2.0.js"></script> --}}

    <script>
        let IMP = window.IMP;
        IMP.init("imp68041162"); // 예: imp00000000
        let merchant_uid = document.querySelector('#merchant_uid');
        function requestPay(totalPrice, cachedData) {
            // IMP.request_pay(param, callback) 결제창 호출
            IMP.request_pay({ // param
                pg: "kakaopay" // pg사
                // ,pg: "tosspay"
                // ,pg: "html5_inicis" // ********** 이니시스는 진짜로 결제되고 나중에 취소된다고 하니 주의 **********
                ,pay_method: "card"
                ,name: "항공권" // 상품명
                ,amount: totalPrice// 가격
                ,buyer_email: "{{ Auth::user()->u_email }}"
                ,buyer_name: "{{ Auth::user()->u_name }}" // 구매자명
            }, function(res) { // callback
                if (res.success) {
                    merchant_uid.value = res.merchant_uid;
                    seatForm.submit();
                } else {
                    // 결제 실패 시 로직
                    clearResCache(cachedData);
                    alert("결제에 실패했습니다.\n" +  res.error_msg);
                    removeLoading();
                }
            });
        }
    </script>
@endsection