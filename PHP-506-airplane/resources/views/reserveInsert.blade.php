@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('css/reserveInsert.css')}}">
@endsection

@section('contents')
    <h1>상세 정보 입력</h1>
    <br>
    <br>
    <form action="{{route('reservation.seatpost')}}" method="post">
        @csrf
        <input type="hidden" class="flg" name="flg" value="{{$_POST['flg']}}">
        <input type="hidden" name="fly_no" value="{{$_POST['fly_no']}}" id="fly_no">
        <input type="hidden" name="plane_no" value="{{$_POST['plane_no']}}">
        <input type="hidden" name="ADULT" value="{{$_POST['ADULT']}}">
        <input type="hidden" name="CHILD" value="{{$_POST['CHILD']}}">
        <input type="hidden" name="BABY" value="{{$_POST['BABY']}}">

        <div class="con">
        @if(isset($peoNum))
            @for($i = 0; $i < $peoNum; $i++)
                <label>{{$pass_name[$i]}}</label>
                <input type="text" name="u_name" placeholder="이름{{$i}}" required>
                <label>생년월일 {{$i}}</label>
                <input type="date" name="u_birth" placeholder="생년월일" min="{{ date('Y-m-d', strtotime('-12 years')) }}" max="{{ date('Y-m-d', strtotime('-2 years')) }}" required>
                <label>성별</label>
                <select class="size num1" name="gender" value="{{old('gender')}}" required>
                    <option value="0">남</option>
                    <option value="1">여</option>
                </select>
                <br>
                <br>
                <span></span>
            @endfor
        @endif
        <div class="btnArea">
            <button type="button" class="chk_btn" onclick="reserveBtn();">결제하기</button>
        </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/reservationSeat.js')}}"></script>
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