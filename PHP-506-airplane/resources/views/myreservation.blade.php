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
@if($data->isEmpty())
<div>예약 정보가 없습니다.</div>
<br>
<button type="button" onclick="location.href='{{route('reservation.main')}}'">예약하기</button>
@endif
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


<svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" display="none">
    <symbol id="alitalia" viewBox="0 0 80 17">
        <g>
            <path fill="#FFFFFF" d="M10.297,2.333L0.5,16.135h4.434l9.107-12.7v12.717l3.867,0.009V1.5h-5.654
                                    C10.83,1.5,10.297,2.333,10.297,2.333z M12.769,16.146v-8.62l-6.153,8.62H12.769z M20.367,16.186h3.745V2.102h-3.745V16.186z
                                    M26.555,16.186h3.746V5.571h-3.746V16.186z M26.555,4.67h3.746V2.102h-3.746V4.67z M55.084,16.119h3.747V2.033h-3.747V16.119z
                                    M61.271,16.119h3.75V5.505h-3.75V16.119z M61.271,4.604h3.75v-2.57h-3.75V4.604z M36.593,12.35V8.276h3.745V5.47h-3.885V3.336
                                    h-3.539v10.163c0,2.839,3.041,2.653,3.041,2.653h4.502v-2.836h-2.715C36.558,13.316,36.593,12.35,36.593,12.35z M50.445,5.439
                                    c0,0-2.854-0.719-5.774,0.016c0,0-3.078,0.469-2.889,3.323h3.766c0,0-0.019-1.484,1.857-1.469c0,0,1.646-0.117,1.786,0.968
                                    c0,0,0.24,0.617-0.791,0.952l-4.968,0.901c0,0-2.253,0.401-2.253,2.905c0,0-0.067,1.65,1.066,2.533c0,0,1.271,0.904,3.748,0.904
                                    c0,0,4.586,0.149,7.062-0.219V8.543C53.056,8.543,53.298,5.957,50.445,5.439z M49.225,14.134c0,0-2.286,0.216-3.317-0.114
                                    c0,0-0.791-0.237-0.791-1.202c0,0,0-0.833,0.878-1.087l3.23-0.652V14.134z M75.891,5.439c0,0-2.853-0.719-5.774,0.016
                                    c0,0-3.075,0.469-2.887,3.323h3.764c0,0-0.018-1.484,1.854-1.469c0,0,1.651-0.117,1.787,0.968c0,0,0.241,0.617-0.79,0.952
                                    L68.88,10.13c0,0-2.254,0.401-2.254,2.905c0,0-0.067,1.65,1.065,2.533c0,0,1.271,0.904,3.747,0.904c0,0,4.589,0.149,7.063-0.219
                                    V8.543C78.501,8.543,78.741,5.957,75.891,5.439z M74.672,14.134c0,0-2.288,0.216-3.318-0.114c0,0-0.787-0.237-0.787-1.202
                                    c0,0,0-0.833,0.872-1.087l3.233-0.652V14.134z" />
        </g>
    </symbol>
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
