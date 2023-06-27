{{--
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : baggageinfo.blade.php
 * 이력         :   v001 0623 이동호 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '수하물 안내')

@section('css')
<link rel="stylesheet" href="{{asset('css/baggageinfo.css')}}">
@endsection

@section('contents')
<div class="baggageinfoHeader">
    <h1 class="noticeH1">수하물 안내</h1>
    <h5 class="noticeH5">수하물 관련 규정을 확인하세요.</h5>
</div>
<div class="baggageinfoContainer">
    <div class="divLi">
        <div>휴대 수하물</div>
        <ul>
            <li>
                고객이 기내로 가져갈 수 있는 수하물을 말합니다.
            </li>
            <li>
                10 kg 이하 1개에 한함
                <br>
                (세변의 합이 115 cm 이하, 각 변의 최대치는 가로 40 cm, 세로 20 cm, 높이 55 cm미만)
            </li>
            <li>
                추가 허용 품목 : 노트북 컴퓨터, 서류가방, 핸드백 중 1개
            </li>
            <li>기내 휴대 수하물 허용 기준을 초과(무게, 사이즈 또는 개수)하는 모든 수하물은 반드시 수속카운터에서 미리 부치시기 바랍니다.
                <br>
                탑승구에서 위탁 시 별도 수수료가 부과됩니다.
            </li>
            <li>
                객실 안전 및 승객의 편의를 위해 통로 및 비상구로의 접근을 방해하거나 주변 승객에게 불편을 줄 수 있는 개인 편의 용품은 기내 사용이 불가합니다.
                <br>
                (예 : Bed Box, Fly Legs Up, FLY-Tot, Plane Pal, Inflatable Cube 등)
            </li>
            <li>
                단, 기내 휴대 수하물 허용 규격에 부합하는 경우 기내 반입은 가능하나, 기내 탑재공간 부족시 탑승구에서 위탁될수 있으니 이점 양지하시기 바랍니다.
            </li>
        </ul>
        <div>무료 위탁 수하물</div>
        <ul>
            <li>
                고객이 출발지 공항에서 항공사에 탁송 의뢰하여 목적지 공항에서 수취하는 수하물을 말합니다.
            </li>
            <li>
                안전한 수하물 위탁을 위해 가방(짐)은 항공사에서 안내하는 지정된 크기와 무게를 지켜 준비하여 주시기 바랍니다.
            </li>
            <li>
                위탁 수하물 1개의 크기가 203cm(가로 X 세로 X 높이의 합)를 초과할 경우 위탁 수하물로서의 운송이 거절될 수 있습니다.
            </li>
            <li>
                위탁 수하물 1개의 무게는 32kg을 초과할 수 없으며, 초과 시에는 분리하여 포장해 주셔야 합니다.
            </li>
        </ul>
    </div>
    <table class="bbsList">
        <colgroup>
            <col width="20%">
            <col width="">
        </colgroup>
        <thead>
            <tr>
                <th scope="col">지역</th>
                <th scope="col">성인 및 소아 (만 2세 이상)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">국내선</th>
                <td class="al">15kg</td>
            </tr>
        </tbody>
    </table>
    <table class="bbsList">
        <colgroup>
            <col width="20%">
            <col width="">
        </colgroup>
        <thead>
            <tr>
                <th scope="col">지역</th>
                <th scope="col">유아 (만 2세 미만)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">국내선</th>
                <td class="al">접는 유모차, 유아용 카시트 중 1개</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@section('js')
{{-- <script src="{{asset('js/baggageinfo.js')}}"></script> --}}
@endsection
