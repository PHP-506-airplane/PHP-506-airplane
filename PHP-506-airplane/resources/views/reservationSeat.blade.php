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
            <li class="choice" style="width: 526px;">
                <a id="aFlight1">구간1<span> :{{var_dump($_POST)}}</span></a>
            </li>
            <li style="width: 526px;">
                <a id="aFlight2">구간2<span> : 기타큐슈(KKJ)-서울/인천(ICN)</span></a>
            </li>
        </ul>
    </div>
</div>

<div class="seatMap">
    <div class="map">
        <ol>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>

            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast disable Reserved">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast disable Reserved" style="margin-right: 60px;">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast disable Reserved">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast disable Blocked">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast disable Reserved">
                <a href="javascript:void(0)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
        </ol>
    </div>
</div>
</div>
@endsection

@section('js')
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/reservationSeat.js')}}"></script>
@endsection