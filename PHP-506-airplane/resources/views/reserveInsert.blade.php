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
                <input type="text" name="u_name" placeholder="이름{{$i}}">
                <label>생년월일 {{$i}}</label>
                <input type="date" name="u_birth" placeholder="생년월일" min="{{ date('Y-m-d', strtotime('-12 years')) }}" max="{{ date('Y-m-d', strtotime('-2 years')) }}">
                <label>성별</label>
                <select class="size num1" name="gender" value="{{old('gender')}}">
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
@endsection