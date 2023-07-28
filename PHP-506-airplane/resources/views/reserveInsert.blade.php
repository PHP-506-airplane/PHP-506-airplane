@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('css/reserveInsert.css')}}">
@endsection

@section('contents')
<div class="container">
    <h1>탑승객 정보</h1>
    <hr>
    <form method="POST" id="insertForm" action="{{ route('reservation.reserveConfirm'); }}">
        @csrf
        <input type="hidden" name="fly_no" value="{{$_POST['fly_no']}}" id="fly_no">
        <input type="hidden" name="merchant_uid" id="merchant_uid">
        <input type="hidden" name="plane_no" value="{{$_POST['plane_no']}}">
        <input type="hidden" id="allCnt" name="allCnt" value="{{$allCnt}}">

        {{-- 왕복 --}}
        @if($_POST['flg'] === '1')
            <input type="hidden" name="fly_no2" value="{{$_POST['fly_no2']}}" id="fly_no2">
            <input type="hidden" name="plane_no2" value="{{$_POST['plane_no2']}}">
            @for($i = 0; $i < $allCnt; $i++)
                <div class="divInput">
                    <div class="title1">이름</div>
                    <input type="text" name="name[]" id="name">
                    <div class="title1">성별</div>
                    <select name="gender[]" id="">
                        <option value="0">남</option>
                        <option value="1">여</option>
                    </select>
                    <div class="title1">생일</div>
                    <input type="date" name="birth[]">
                    <div class="title1">가는편 좌석</div>
                    <input type="text" name="seatGo[]" class="seat_no" value="{{ $seat_no_go[$i] }}" readonly>
                    <div class="title1">오는편 좌석</div>
                    <input type="text" name="seatReturn[]" class="seat_no2" value="{{ $seat_no_return[$i] }}" readonly>
    </div>
            @endfor
        @else {{-- 편도 --}}
            @for($i = 0; $i < $allCnt; $i++)
                <div class="divInput">
                    <div class="title1">이름</div>
                    <input type="text" name="name[]" id="name">
                    <div class="title1">성별</div>
                    <select name="gender[]" id="">
                        <option value="0">남</option>
                        <option value="1">여</option>
                    </select>
                    <div class="title1">생일</div>
                    <input type="date" name="birth[]">
                    <div>가는편 좌석</div>
                    <input type="text" name="seatGo[]" value="{{ $seat_no_go[$i] }}" readonly>
            @endfor
        @endif
        <div class="btnArea">
            {{-- <button type="button" class="submitbtn" onclick="submitReq();">결제하기</button> --}}
        </div>
        {{-- <button type="submit">결제하기</button> --}}
        <input type="hidden" id="use_mile" name="use_mile">
    </form>
    </div>
</div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="price1(); this.onclick=''">
        결제하기
    </button>

<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">마일리지 사용</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>현재 마일리지 : </span><input type="text" id="milenow" value="{{session('mileage')}}" readonly>
                <br>
                <br>
                사용 마일리지 : <input type="text" id="mileageInput">
                <button type="button" id="milebtn" onclick="mileageUse()">사용</button>
                <br>
                <br>
                <hr>
                <br>
                <span> 최종 결제 금액 : <span id="totalPrice"></span>원</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="submitReq();">결제</button>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/reservationInsert.js')}}"></script>
    <script src="{{asset('js/reserveInsert.js')}}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

{{-- <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.2.0.js"></script> --}}

    <script>
        let IMP = window.IMP;
        IMP.init("imp11776700"); // 예: imp00000000
        let merchant_uid = document.querySelector('#merchant_uid');
        function requestPay(totalPrice, arrCaching) {
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
                    insertForm.submit();
                } else {
                    // 결제 실패 시 로직
                    clearResCache(arrCaching);
                    alert("결제에 실패했습니다.\n" +  res.error_msg);
                    removeLoading();
                }
            });
        }
    </script>
@endsection