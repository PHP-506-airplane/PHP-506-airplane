{{--
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : myreservation.blade.php
 * 이력         :   v001 0620 이동호 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '나의 예약')

@section('css')
<link rel="stylesheet" href="{{asset('css/myreservation.css')}}">
@endsection

@section('contents')
<div class="myreservationHeader">
    <h1 class="noticeH1">예약 내역 조회</h1>
    <h5 class="noticeH5">예약하신 내역을 알려드립니다.</h5>
</div>
@if($data->isEmpty())
    <div class="reserveNone">
        <span class="noneSpan">예약 정보가 없습니다.</span>
        <br>
        <br>
        <button type="button" onclick="location.href='{{route('reservation.main')}}'" class="btn btn-outline-info">예약하기</button>
    </div>
@endif
<div class="passContainer">
@foreach($data as $key => $val)
    <div class="boarding-pass">
        <header>
            <div class="flight">
                <strong>{{$val['line_name']}}</strong>
            </div>
        </header>
        <section class="cities">
            <div class="city">
                <small>{{str_replace('공항', '' , $val['dep_port_name'])}}</small>
                <strong>{{strtoupper($val['dep_port_eng'])}}</strong>
            </div>
            <div class="city">
                <small>{{str_replace('공항', '' , $val['arr_port_name'])}}</small>
                <strong>{{strtoupper($val['arr_port_eng'])}}</strong>
            </div>
            <svg class="airplane">
                <use xlink:href="#airplane"></use>
            </svg>
        </section>
        <section class="infos">
            <div class="places">
                <div class="box">
                    <small>Linecode</small>
                    <strong><em>{{$val['line_code']}}</em></strong>
                </div>
                <div class="box">
                    <small>airplane</small>
                    <strong><em>{{$val['plane_name']}}</em></strong>
                </div>
                <div class="box">
                    <small>Seat</small>
                    <strong>{{$val['seat_no']}}</strong>
                </div>
                <div class="box">
                    <small>Class</small>
                    <strong>E</strong>
                </div>
            </div>
            <div class="times">
                <div class="box">
                    <small>Date</small>
                    <strong>{{substr($val['fly_date'], 5)}}</strong>
                </div>
                <div class="box">
                    <small>Departure</small>
                    <strong>{{substr($val['dep_time'], 0, 2) . ':' . substr($val['dep_time'], 2)}}</strong>
                </div>
                <div class="box">
                    <small>Duration</small>
                    <strong>{{TimeCalculation($val['dep_time'], $val['arr_time'])}}</strong>
                </div>
                <div class="box">
                    <small>Arrival</small>
                    <strong>{{substr($val['arr_time'], 0, 2) . ':' . substr($val['arr_time'], 2)}}</strong>
                </div>
            </div>
        </section>
        <section class="strap">
            <div class="box">
                <div class="passenger">
                    <small>passenger</small>
                    <strong>{{$val['u_name']}}</strong>
                </div>
                <form action="{{route('reservation.rescancle')}}" method="POST" id="formCancel">
                    @csrf
                    <input type="hidden" name="reserve_no" value="{{$val['reserve_no']}}">
                    <input type="hidden" name="t_no" value="{{$val['t_no']}}">
                    <button type="button" onclick="confirmCancel()" class="btn btn-outline-success">예약 취소</button>
                </form>
            </div>
            <img src="{{asset('img/qr.png')}}" alt="QR code" class="imgQr">
        </section>
    </div>
@endforeach
</div>

<svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" display="none">
    <symbol id="airplane" viewBox="243.5 245.183 25 21.633">
        <g>
            <path fill="#30af2f" d="M251.966,266.816h1.242l6.11-8.784l5.711,0.2c2.995-0.102,3.472-2.027,3.472-2.308
                                    c0-0.281-0.63-2.184-3.472-2.157l-5.711,0.2l-6.11-8.785h-1.242l1.67,8.983l-6.535,0.229l-2.281-3.28h-0.561v3.566
                                    c-0.437,0.257-0.738,0.724-0.757,1.266c-0.02,0.583,0.288,1.101,0.757,1.376v3.563h0.561l2.281-3.279l6.535,0.229L251.966,266.816z
                                    " />
        </g>
    </symbol>
</svg>
@endsection

@section('js')
<script src="{{asset('js/myreservation.js')}}"></script>
@endsection
