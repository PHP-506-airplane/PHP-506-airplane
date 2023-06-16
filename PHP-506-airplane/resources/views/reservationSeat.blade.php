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
<div class="seatMap">
    <div class="map">
        <input type="hidden" name="airType" value="b738">
        <input type="hidden" name="maximumInfantsPerUnit" value="1">
        <ol>
            <li class="stretch Available">
                <a href="javascript:void(0)" data="28A" externalrownumber="28" externalcolumnname="A" type="JSST"
                    title="28열A">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="stretch Available">
                <a href="javascript:void(0)" data="28B" externalrownumber="28" externalcolumnname="B" type="JSST"
                    title="28열B">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="stretch Available" style="margin-right: 210px;">
                <a href="javascript:void(0)" data="28C" externalrownumber="28" externalcolumnname="C" type="JSST"
                    title="28열C">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="29A" externalrownumber="29" externalcolumnname="A" type="JFFT"
                    title="29열A (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="29B" externalrownumber="29" externalcolumnname="B" type="JFFT"
                    title="29열B (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)" data="29C" externalrownumber="29" externalcolumnname="C" type="JFFT"
                    title="29열C (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>

            <li class="stretch Available">
                <a href="javascript:void(0)" data="29D" externalrownumber="29" externalcolumnname="D" type="JSST"
                    title="29열D">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="stretch Available">
                <a href="javascript:void(0)" data="29E" externalrownumber="29" externalcolumnname="E" type="JSST"
                    title="29열E">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="stretch Available">
                <a href="javascript:void(0)" data="29F" externalrownumber="29" externalcolumnname="F" type="JSST"
                    title="29열F">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="30A" externalrownumber="30" externalcolumnname="A" type="JFFT"
                    title="30열A (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="30B" externalrownumber="30" externalcolumnname="B" type="JFFT"
                    title="30열B (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)" data="30C" externalrownumber="30" externalcolumnname="C" type="JFFT"
                    title="30열C (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="30D" externalrownumber="30" externalcolumnname="D" type="JFFT"
                    title="30열D (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="30E" externalrownumber="30" externalcolumnname="E" type="JFFT"
                    title="30열E (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="30F" externalrownumber="30" externalcolumnname="F" type="JFFT"
                    title="30열F (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="31A" externalrownumber="31" externalcolumnname="A" type="JFFT"
                    title="31열A (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="31B" externalrownumber="31" externalcolumnname="B" type="JFFT"
                    title="31열B (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)" data="31C" externalrownumber="31" externalcolumnname="C" type="JFFT"
                    title="31열C (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="31D" externalrownumber="31" externalcolumnname="D" type="JFFT"
                    title="31열D (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="31E" externalrownumber="31" externalcolumnname="E" type="JFFT"
                    title="31열E (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="31F" externalrownumber="31" externalcolumnname="F" type="JFFT"
                    title="31열F (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="32A" externalrownumber="32" externalcolumnname="A" type="JFFT"
                    title="32열A (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="32B" externalrownumber="32" externalcolumnname="B" type="JFFT"
                    title="32열B (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)" data="32C" externalrownumber="32" externalcolumnname="C" type="JFFT"
                    title="32열C (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="32D" externalrownumber="32" externalcolumnname="D" type="JFFT"
                    title="32열D (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="32E" externalrownumber="32" externalcolumnname="E" type="JFFT"
                    title="32열E (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="32F" externalrownumber="32" externalcolumnname="F" type="JFFT"
                    title="32열F (JINI FAST)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast disable Reserved">
                <a href="javascript:void(0)" data="33A" externalrownumber="33" externalcolumnname="A" type="JSDA"
                    title="33열A (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="33B" externalrownumber="33" externalcolumnname="B" type="JSDA"
                    title="33열B (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast disable Reserved" style="margin-right: 60px;">
                <a href="javascript:void(0)" data="33C" externalrownumber="33" externalcolumnname="C" type="JSDA"
                    title="33열C (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast disable Reserved">
                <a href="javascript:void(0)" data="33D" externalrownumber="33" externalcolumnname="D" type="JSDA"
                    title="33열D (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="33E" externalrownumber="33" externalcolumnname="E" type="JSDA"
                    title="33열E (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="33F" externalrownumber="33" externalcolumnname="F" type="JSDA"
                    title="33열F (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="34A" externalrownumber="34" externalcolumnname="A" type="JSDA"
                    title="34열A (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="34B" externalrownumber="34" externalcolumnname="B" type="JSDA"
                    title="34열B (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)" data="34C" externalrownumber="34" externalcolumnname="C" type="JSDA"
                    title="34열C (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="34D" externalrownumber="34" externalcolumnname="D" type="JSDA"
                    title="34열D (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="34E" externalrownumber="34" externalcolumnname="E" type="JSDA"
                    title="34열E (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="34F" externalrownumber="34" externalcolumnname="F" type="JSDA"
                    title="34열F (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="35A" externalrownumber="35" externalcolumnname="A" type="JSDA"
                    title="35열A (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="35B" externalrownumber="35" externalcolumnname="B" type="JSDA"
                    title="35열B (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)" data="35C" externalrownumber="35" externalcolumnname="C" type="JSDA"
                    title="35열C (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="35D" externalrownumber="35" externalcolumnname="D" type="JSDA"
                    title="35열D (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="35E" externalrownumber="35" externalcolumnname="E" type="JSDA"
                    title="35열E (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="35F" externalrownumber="35" externalcolumnname="F" type="JSDA"
                    title="35열F (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="36A" externalrownumber="36" externalcolumnname="A" type="JSDA"
                    title="36열A (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="36B" externalrownumber="36" externalcolumnname="B" type="JSDA"
                    title="36열B (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)" data="36C" externalrownumber="36" externalcolumnname="C" type="JSDA"
                    title="36열C (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="36D" externalrownumber="36" externalcolumnname="D" type="JSDA"
                    title="36열D (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="36E" externalrownumber="36" externalcolumnname="E" type="JSDA"
                    title="36열E (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="36F" externalrownumber="36" externalcolumnname="F" type="JSDA"
                    title="36열F (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="37A" externalrownumber="37" externalcolumnname="A" type="JSDA"
                    title="37열A (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="37B" externalrownumber="37" externalcolumnname="B" type="JSDA"
                    title="37열B (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)" data="37C" externalrownumber="37" externalcolumnname="C" type="JSDA"
                    title="37열C (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="37D" externalrownumber="37" externalcolumnname="D" type="JSDA"
                    title="37열D (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="37E" externalrownumber="37" externalcolumnname="E" type="JSDA"
                    title="37열E (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="37F" externalrownumber="37" externalcolumnname="F" type="JSDA"
                    title="37열F (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast disable Blocked">
                <a href="javascript:void(0)" data="38A" externalrownumber="38" externalcolumnname="A" type="JSDA"
                    title="38열A (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="38B" externalrownumber="38" externalcolumnname="B" type="JSDA"
                    title="38열B (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available" style="margin-right: 60px;">
                <a href="javascript:void(0)" data="38C" externalrownumber="38" externalcolumnname="C" type="JSDA"
                    title="38열C (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="38D" externalrownumber="38" externalcolumnname="D" type="JSDA"
                    title="38열D (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast Available">
                <a href="javascript:void(0)" data="38E" externalrownumber="38" externalcolumnname="E" type="JSDA"
                    title="38열E (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
            <li class="fast disable Reserved">
                <a href="javascript:void(0)" data="38F" externalrownumber="38" externalcolumnname="F" type="JSDA"
                    title="38열F (JINI STANDARD A)">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="KRW">
                </a>
            </li>
        </ol>
    </div>
</div>
@endsection

@section('js')
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/reservationSeat.js')}}"></script>
@endsection