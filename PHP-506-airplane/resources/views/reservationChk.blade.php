{{--
/**************************************************
* 프로젝트명 : PHP-506-airplane
* 디렉토리 : views
* 파일명 : reservationChk.blade.php
* 이력 : v001 0613 오재훈 new
**************************************************/
--}}
@extends('layout.layout')

@section('title','항공편 조회')

@section('css')
<link rel="stylesheet" href="{{asset('css/reservationChk.css')}}">
@endsection

@section('contents')

<div class="container">
    <form action="{{route('reservation.checkpost')}}" method="post">
    {{-- <form action="{{route('reservation.submitForm')}}" method="post"> --}}
        @csrf
        <h1>항공편 선택</h1>
        <div class="step">
            <h2>Step</h2>
            <ul>
                <li>
                    <strong>1</strong>
                    <span>여정 선택</span>
                </li>
                <li class="on">
                    <strong>2</strong>
                    <span>항공편 선택</span>
                </li>
                <li>
                    <strong>3</strong>
                    <span>좌석 선택</span>
                </li>
                <li>
                    <strong>4</strong>
                    <span>예약 확정</span>
                </li>
            </ul>
        </div>
        <div class="location">
            <input type="hidden" name="ADULT" value="{{$_GET['ADULT']}}">
            <input type="hidden" name="CHILD" value="{{$_GET['CHILD']}}">
            <input type="hidden" name="BABY" value="{{$_GET['BABY']}}">
            <input type="hidden" name="dep_port_no" value="{{$depPort[0]->port_no}}">
            <input type="hidden" name="arr_port_no" value="{{$arrPort[0]->port_no}}">
            @if($flg['hd_li_flg'] === '1')
            <input type="hidden" name="hd_li_flg" value="{{$flg['hd_li_flg']}}">
            {{-- 가는편 --}}
            <h2>여정1 :
                <span class="br">{{$depPort[0]->port_name}}({{$depPort[0]->port_eng}})</span>
                <strong>
                    <span class="ico">→</span>
                    <span class="br">{{$arrPort[0]->port_name}}({{$arrPort[0]->port_eng}})</span>
                </strong>
                <span class="r_date">
                    날짜: {{substr($_GET['fly_date'],0,-13)}}
                </span>
            </h2>
            <table class="table sta_table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>편명</th>
                        <th>출발시간</th>
                        <th></th>
                        <th>도착시간</th>
                        <th>가격</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $val)
                    <tr class="tr_data">
                        <input type="hidden" name="dep_plane_no" value="{{$val->plane_no}}">
                            <td>{{strtoupper($val->flight_num)}}</td>
                            <td><p>({{$data[0]->dep_port_eng}})</p>{{substr($val->dep_time, 0, 2)}}:{{substr($val->dep_time, 2, 2)}}</td>
                            <td>{{ TimeCalculation($val->dep_time, $val->arr_time) }}</td>
                            <td><p>({{$data[0]->arr_port_eng}})</p>{{substr_replace($val->arr_time,':',2,0)}}</td>
                            <td><input type="hidden" class="dep_price" value="{{$val->price}}">{{substr_replace($val->price,',',-3,0)}}</td>
                            <td class="dep_fly_no"><input type="radio" id="data" name="dep_fly_no" value="{{$val->fly_no}}"></td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="6">데이터없음</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- 오는편 --}}
            <h2 class="select2">여정2 :
                <span class="br">{{$arrPort[0]->port_name}}({{$arrPort[0]->port_eng}})</span>
                <strong>
                    <span class="ico">→</span>
                    <span class="br">{{$depPort[0]->port_name}}({{$depPort[0]->port_eng}})</span>
                </strong>
                <span class="r_date">
                    날짜: {{substr($_GET['fly_date'],13)}}
                </span>
            </h2>
            <table class="table sta_table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>편명</th>
                        <th>출발시간</th>
                        <th></th>
                        <th>도착시간</th>
                        <th>가격</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data2 as $val)
                    <tr class="tr_data2">
                        <input type="hidden" name="arr_plane_no" value="{{$val->plane_no}}">
                        <td>{{strtoupper($val->flight_num)}}</td>
                        <td><p>({{$data2[0]->dep_port_eng}})</p>{{substr($val->dep_time, 0, 2)}}:{{substr($val->dep_time, 2, 2)}}</td>
                        <td>{{ TimeCalculation($val->dep_time, $val->arr_time) }}</td>
                        <td><p>({{$data2[0]->arr_port_eng}})</p>{{substr_replace($val->arr_time,':',2,0)}}</td>
                        <td><input type="hidden" class="arr_price" value="{{$val->price}}">{{substr_replace($val->price,',',-3,0)}}</td>
                        <td class="arr_fly_no"><input type="radio" id="data" name="arr_fly_no" value="{{$val->fly_no}}"></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">데이터없음</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        
        @else
        {{-- 편도 --}}
        <input type="hidden" name="hd_li_flg" value="{{$flg['hd_li_flg']}}">
        <h2>여정1 :
            <span class="br">{{$depPort[0]->port_name}}({{$depPort[0]->port_eng}})</span>
            <strong>
                <span class="ico">→</span>
                <span class="br">{{$arrPort[0]->port_name}}({{$arrPort[0]->port_eng}})</span>
            </strong>
            <span class="r_date">
                날짜: {{$_GET['one_fly_date'],0,-13}}
            </span>
        </h2>
        <table class="table sta_table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>편명</th>
                    <th>출발시간</th>
                    <th></th>
                    <th>도착시간</th>
                    <th>가격</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($oneway as $val)
                <tr class="tr_data3">
                    <input type="hidden" name="dep_plane_no" value="{{$val->plane_no}}">
                    <td>{{strtoupper($val->flight_num)}}</td>
                    <td><p>({{$oneway[0]->dep_port_eng}})</p>{{substr($val->dep_time, 0, 2)}}:{{substr($val->dep_time, 2, 2)}}</td>
                    <td>{{TimeCalculation($val->dep_time, $val->arr_time)}}</td>
                    <td><p>({{$oneway[0]->arr_port_eng}})</p>{{substr_replace($val->arr_time,':',2,0)}}</td>
                    <td><input type="hidden" class="dep_price2" value="{{$val->price}}">{{substr_replace($val->price,',',-3,0)}}</td>
                    <td class="dep_fly_no2"><input type="radio" id="data" name="dep_fly_no" value="{{$val->fly_no}}"></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">데이터없음</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @endif
        <div class="total_price">
        </div>
        <div class="btnArea">
            {{-- <div class="price">
                <a href="#"></a>
                <p><span class="tit">총금액(KRW)</span><strong class="sum_price">0</strong></p>
            </div> --}}
            {{-- <button type="submit" class="chk_btn" onclick="{{route('reservation.peoInsert')}}">다음</button> --}}
            <button type="submit" class="chk_btn">다음</button>
        </div>
    </div>
    </form>
</div> {{-- END container --}}
@endsection

@section('js')
<script src="{{asset('js/reserveChk.js')}}"></script>
@endsection