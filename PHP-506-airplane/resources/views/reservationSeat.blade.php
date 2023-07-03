{{--
/**************************************************
* 프로젝트명 : PHP-506-airplane
* 디렉토리 : views
* 파일명 : reservationSeat.blade.php
* 이력 : v001 0616 오재훈 new
**************************************************/
--}}
@extends('layout.layout')

@section('title','좌석예약')

@section('css')
<link rel="stylesheet" href="{{asset('css/reservationSeat.css')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<style>
    /* 로딩 이미지 */
    .svg-calLoader {
        width: 230px; 
        height: 230px;
        transform-origin: 115px 115px;
        animation: 1.4s linear infinite loader-spin;
        z-index: 9999;
        display: none;
    }

    .cal-loader__plane {
        /* fill: $c-hilight; */
    }
    .cal-loader__path {
        /* stroke: $c-front;  */
        animation: 1.4s ease-in-out infinite loader-path;
    }

    .svgHidden {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9998;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes loader-spin {
        to{
            transform: rotate(360deg);
        }
    }
    @keyframes loader-path {
        0%{
            stroke-dasharray:  0, 580, 0, 0, 0, 0, 0, 0, 0;
        }
        50%{
            stroke-dasharray: 0, 450, 10, 30, 10, 30, 10, 30, 10;
        }
        100%{
            stroke-dasharray: 0, 580, 0, 0, 0, 0, 0, 0, 0;
        }
    }
/* /로딩 이미지 */
</style>
@endsection

@section('contents')
<div class="container">
    {{-- 로딩 이미지 --}}
    <div id="Divloading">
        <svg id="svgImg" class="svg-calLoader" xmlns="http://www.w3.org/2000/svg" width="230" height="230"><path class="cal-loader__path" d="M86.429 40c63.616-20.04 101.511 25.08 107.265 61.93 6.487 41.54-18.593 76.99-50.6 87.643-59.46 19.791-101.262-23.577-107.142-62.616C29.398 83.441 59.945 48.343 86.43 40z" fill="none" stroke="#ffffff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="10 10 10 10 10 10 10 432" stroke-dashoffset="77"/><path class="cal-loader__plane" fill="#c2d9ff" d="M141.493 37.93c-1.087-.927-2.942-2.002-4.32-2.501-2.259-.824-3.252-.955-9.293-1.172-4.017-.146-5.197-.23-5.47-.37-.766-.407-1.526-1.448-7.114-9.773-4.8-7.145-5.344-7.914-6.327-8.976-1.214-1.306-1.396-1.378-3.79-1.473-1.036-.04-2-.043-2.153-.002-.353.1-.87.586-1 .952-.139.399-.076.71.431 2.22.241.72 1.029 3.386 1.742 5.918 1.644 5.844 2.378 8.343 2.863 9.705.206.601.33 1.1.275 1.125-.24.097-10.56 1.066-11.014 1.032a3.532 3.532 0 0 1-1.002-.276l-.487-.246-2.044-2.613c-2.234-2.87-2.228-2.864-3.35-3.309-.717-.287-2.82-.386-3.276-.163-.457.237-.727.644-.737 1.152-.018.39.167.805 1.916 4.373 1.06 2.166 1.964 4.083 1.998 4.27.04.179.004.521-.076.75-.093.228-1.109 2.064-2.269 4.088-1.921 3.34-2.11 3.711-2.123 4.107-.008.25.061.557.168.725.328.512.72.644 1.966.676 1.32.029 2.352-.236 3.05-.762.222-.171 1.275-1.313 2.412-2.611 1.918-2.185 2.048-2.32 2.45-2.505.241-.111.601-.232.82-.271.267-.058 2.213.201 5.912.8 3.036.48 5.525.894 5.518.914 0 .026-.121.306-.27.638-.54 1.198-1.515 3.842-3.35 9.021-1.029 2.913-2.107 5.897-2.4 6.62-.703 1.748-.725 1.833-.594 2.286.137.46.45.833.872 1.012.41.177 3.823.24 4.37.085.852-.25 1.44-.688 2.312-1.724 1.166-1.39 3.169-3.948 6.771-8.661 5.8-7.583 6.561-8.49 7.387-8.702.233-.065 2.828-.056 5.784.011 5.827.138 6.64.09 8.62-.5 2.24-.67 4.035-1.65 5.517-3.016 1.136-1.054 1.135-1.014.207-1.962-.357-.38-.767-.777-.902-.893z" class="cal-loader__plane"/></svg>
    </div>
    {{-- /로딩 이미지 --}}
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
                @if($flg['hd_li_flg'] === '1')
                    <li class="tab choice" style="width: 50%;">
                        <a id="aFlight1" onclick="changeTab('aFlight1')">구간1<span class="t_over"> : {{$depPort[0]->port_name}}({{$depPort[0]->port_eng}})->{{$arrPort[0]->port_name}}({{$arrPort[0]->port_eng}})</span></a>
                    </li>
                    <li class="tab" style="width: 50%;">
                        <a id="aFlight2" onclick="changeTab('aFlight2')">구간2<span class="t_over"> : {{$arrPort[0]->port_name}}({{$arrPort[0]->port_eng}})->{{$depPort[0]->port_name}}({{$depPort[0]->port_eng}})</span></a>
                    </li>
                @else
                    <li class="tab choice" style="width: 100%; text-align:center;">
                        <a id="aFlight1" onclick="changeTab('aFlight1')">구간1<span class="t_over"> : {{$depPort[0]->port_name}}({{$depPort[0]->port_eng}})->{{$arrPort[0]->port_name}}({{$arrPort[0]->port_eng}})</span></a>
                    </li>
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
                    <input type="hidden" class="flg" name="flg" value="{{$flg['hd_li_flg']}}">
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