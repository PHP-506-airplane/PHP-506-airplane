{{--
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : mileage.blade.php
 * 이력         :   v001 0728 오재훈 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '마일리지 안내')

@section('css')
<link rel="stylesheet" href="{{asset('css/baggageinfo.css')}}">
@endsection

@section('contents')
<div class="baggageinfoHeader">
    <h1 class="noticeH1">마일리지 안내</h1>
    <h5 class="noticeH5">마일리지 관련 규정을 확인하세요.</h5>
</div>
<div class="baggageinfoContainer">
    <div class="divLi">
        <div class="title">※ 마일리지 적립 방법</div>
        <br>
        <ul>
            <li style="margin-bottom: 15px">
                항공편 예약 시 또는 공항에서 탑승수속 시 스카이패스 회원번호를 알려주시면, 탑승 후 마일리지가 자동으로 적립됩니다
            </li>
            <li style="margin-bottom: 15px">
                항공편의 탑승일을 기준으로 탑승 구간별 마일리지 및 예약 등급에 따라 마일리지가 적립됩니다.
            </li>
            <li style="margin-bottom: 15px">
                추가 허용 품목 : 노트북 컴퓨터, 서류가방, 핸드백 중 1개
            </li>
            <li style="margin-bottom: 15px">기내 휴대 수하물 허용 기준을 초과(무게, 사이즈 또는 개수)하는 모든 수하물은 반드시 수속카운터에서 미리 부치시기 바랍니다.
                <br>
                탑승구에서 위탁 시 별도 수수료가 부과됩니다.
            </li>
        </ul>
        <div class="title">※ 마일리지 유효기간</div>
        <br>
        <ul>
            <li>
                2008년 7월 1일부터 대한항공 또는 제휴 항공사를 탑승하신 마일리지는 탑승일 기준으로 10년의 유효기간이 적용되어, 탑승일로부터 10년이 되는 해 12월 31일(대한민국 시간 기준)까지 사용할 수 있습니다.
            </li>
        </ul>
        <div class="title">※ 마일리지가 적립되지 않는 항공권</div>
        <br>
        <ul>
            <li>
                마일리지 보너스 항공권
            </li>
            <li>
                마일리지 적립 불가 조건의 할인 항공권 (예. 50% 또는 50% 이상 할인된 항공권, 마일리지 적립 불가 조건의 프로모션 운임 등)
            </li>
            <li>
                탑승일로부터 30일 이상 경과하여 회원 가입한 경우
            </li>
        </ul>
    </div>
    <br>
</div>
@endsection

@section('js')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
@endsection
