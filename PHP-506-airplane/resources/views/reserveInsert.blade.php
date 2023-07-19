@extends('layout.layout')

@section('css')
<link rel="stylesheet" href="{{asset('css/reservationChk.css')}}">
@endsection

@section('content')

<h1>상세 정보 입력</h1>

<div class="btnArea">
            <div class="price">
                <a href="#"></a>
                <p><span class="tit">총금액(KRW)</span><strong class="sum_price">0</strong></p>
            </div>
            <button type="submit" class="chk_btn">다음</button>
</div>

<button type="button" class="chk_btn" onclick="reserveBtn()">결제하기</button>
@endsection

@section('js')
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/reservationSeat.js')}}"></script>
@endsection