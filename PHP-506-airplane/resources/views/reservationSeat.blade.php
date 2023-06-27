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
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
@endsection

@section('contents')

<div class="container">
    <h1 class="title">좌석 선택</h1>
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
                    <a id="aFlight1" onclick="changeTab('aFlight1')">구간1<span class="t_over"> : {{$depPort[0]->port_name}}({{$depPort[0]->port_eng}})->{{$arrPort[0]->port_name}}({{$arrPort[0]->port_eng}})</span></a>
                </li>
                @if($flg['hd_li_flg'] === '1')
                    <li class="tab" style="width: 50%;">
                        <a id="aFlight2" onclick="changeTab('aFlight2')">구간2<span class="t_over"> : {{$arrPort[0]->port_name}}({{$arrPort[0]->port_eng}})->{{$depPort[0]->port_name}}({{$depPort[0]->port_eng}})</span></a>
                    </li>
                @else
                <li class="tab choice" style="width: 50%;"></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="seatMap">
        <div class="name_box">
            <h2>예매자 정보</h2>
            <form id="seatPost" action="{{route('reservation.seatpost')}}" method="post">
                @csrf
                <ul>
                    <input type="hidden" name="flg" value="{{$flg['hd_li_flg']}}">
                    <input type="hidden" name="fly_no" value="{{$_POST['dep_fly_no']}}">
                    <input type="hidden" name="plane_no" value="{{$_POST['dep_plane_no']}}">
                    @if($flg['hd_li_flg'] === '1')
                        <input type="hidden" name="fly_no2" value="{{$_POST['arr_fly_no']}}">
                        <input type="hidden" name="plane_no2" value="{{$_POST['arr_plane_no']}}">
                    @endif
                    <li class="u_name">이름 : <span>{{Auth::user()->u_name}}</span></li>
                    <li class="s_li">
                        <h3>가는편(구간1)</h3>
                        <span class="material-symbols-outlined">
                            chair
                            </span>
                        <input type="text" class="show_name" name="seat_no" readonly>
                    </li>
                    @if($flg['hd_li_flg'] === '1')
                        <li class="s_li">
                            <h3>오는편(구간2)</h3>
                            <span class="material-symbols-outlined">
                                chair
                                </span>
                            <input type="text" class="show_name2" name="seat_no2" readonly>
                        </li>
                    @endif
                </ul>
                <button type="button" class="chk_btn" onclick="reserveBtn()">예약하기</button>
            </form>
        </div>
        {{-- 왕복편 --}}
        {{-- 예약된 좌석 비교 --}}
        @if($flg['hd_li_flg'] === '1')
        <div class="map active">
            <ol>
                {{-- 가는편 --}}
                @foreach($seat as $value)
                    @if($availableSeats->contains('seat_no',$value->seat_no))
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
        <div class="map">
            <ol>
                {{-- 오는편 --}}
                @foreach($seat as $value)
                    @if($availableSeats2->contains('seat_no',$value->seat_no))
                    <li class="fast2 Available">
                        <a href="javascript:void(0)" class="selectedEd">
                            <input type="hidden" name="amount" value="0">
                            <input type="hidden" id="s_name2" name="seat_no" value="{{$value->seat_no}}">
                        </a>
                    </li>
                    @else
                    <li class="fast2 Available">
                        <a href="javascript:void(0)">
                            <input type="hidden" name="amount" value="0">
                            <input type="hidden" id="s_name2" name="seat_no" value="{{$value->seat_no}}">
                        </a>
                    </li>
                    @endif
                @endforeach
            </ol>
        </div>
        @else
        <div class="map active">
            <ol>
                {{-- 편도 --}}
                @foreach($seat as $value)
                    @if($availableSeats->contains('seat_no',$value->seat_no))
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
        @endif
        <div class="info"></div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/reservationSeat.js')}}"></script>
@endsection