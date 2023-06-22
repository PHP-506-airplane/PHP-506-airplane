{{--
/**************************************************
* 프로젝트명 : PHP-506-airplane
* 디렉토리 : views
* 파일명 : reservationSeat.blade.php
* 이력 : v001 0616 오재훈 new
**************************************************/
--}}
@extends('layout.layout')

@section('title','좌석')

@section('css')
<link rel="stylesheet" href="{{asset('css/reservationSeat.css')}}">
@endsection

@section('contents')

<div class="container">
<h1>좌석 선택</h1>
    <div class="step">
        <h2>Step</h2>
        <ul>
            <li>
                <strong>1</strong>
                <span>여정 선택</span>
            </li>
            <li>
                <strong>2</strong>
                <span>항공편 선택</span>
            </li>
            <li class="on">
                <strong>3</strong>
                <span>좌석 선택</span>
            </li>
            <li>
                <strong>4</strong>
                <span>예약 확정</span>
            </li>
        </ul>
    </div>
<div class="tripTab">
    <div class="slideCont">
        <ul>
            <li class="tab choice" style="width: 50%;">
                <a id="aFlight1" onclick="changeTab('aFlight1')">구간1<span> : {{$data[0]->dep_name}}({{$data[0]->dep_eng}})->{{$data[0]->arr_name}}({{$data[0]->arr_eng}})</span></a>
            </li>
            <li class="tab" style="width: 50%;">
                <a id="aFlight2" onclick="changeTab('aFlight2')">구간2<span> : {{$data[0]->arr_name}}({{$data[0]->arr_eng}})->{{$data[0]->dep_name}}({{$data[0]->dep_eng}})</span></a>
            </li>
        </ul>
    </div>
</div>
<div class="seatMap">
    <div class="name_box">
        <h2>예매자 정보</h2>
        <form id="seatPost" action="{{route('reservation.seatpost')}}" method="post">
            @csrf
            <ul>
                <input type="hidden" name="fly_no" value="{{$data[0]->fly_no}}">
                <input type="hidden" name="plane_no" value="{{$data[0]->plane_no}}">
                <li>이름 : <span>{{Auth::user()->u_name}}</span></li>
                <li><input type="text" class="show_name" name="seat_no" value="" readonly></li>
            </ul>
            <button type="button" onclick="reserveBtn()">예약하기</button>
        </form>
    </div>
    <div class="map">
        <ol>
            {{-- 예약된 좌석 비교 --}}
            @foreach($seat as $value)
                @if($able->contains('seat_no',$value->seat_no))
                <li class="fast Available">
                    <a href="javascript:void(0)" class="selectedEd">
                        <input type="hidden" name="amount" value="0">
                        <input type="hidden" id="s_name" name="seat_no" value="{{$value->seat_no}}">
                    </a>
                </li>
                @else
                <li class="fast Available">
                    <a href="javascript:void(0)">
                        <input type="hidden" name="amount" value="0">
                        <input type="hidden" id="s_name" name="seat_no" value="{{$value->seat_no}}">
                    </a>
                </li>
                @endif
            @endforeach
        </ol>
    </div>
</div>
</div>
@endsection
@section('js')
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/reservationSeat.js')}}"></script>
@endsection