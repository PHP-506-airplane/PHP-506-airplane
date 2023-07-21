@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('css/reserveInsert.css')}}">
@endsection

@section('contents')
    <h1>상세 정보 입력</h1>
    <br>
    <br>
    <form action="{{route('reservation.peoInsertPost')}}" method="post">
        @csrf
        <div class="con">
        @if(isset($peoNum))
            @for($i = 1; $i <= $peoNum; $i++)
                <label>탑승객{{$i}}</label>
                <input type="text" name="u_name{{$i}}" placeholder="이름{{$i}}">
                <label>생년월일 {{$i}}</label>
                <input type="date" name="u_birth{{$i}}" placeholder="생년월일">
                <label>성별</label>
                <select class="size num1" name="gender" value="{{old('gender')}}">
                    <option value="0">남</option>
                    <option value="1">여</option>
                </select>
                <br>
                <br>
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