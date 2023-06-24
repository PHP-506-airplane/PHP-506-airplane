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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endsection

@section('contents')

<div class="container">
    <form action="{{route('reservation.checkpost')}}" method="post">
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
            @if($flg['hd_li_flg'] === '1')
            <input type="hidden" name="hd_li_flg" value="{{$flg['hd_li_flg']}}">
            {{-- 가는편 --}}
            <h2>여정1 :
                @if(isset($data[0]->dep2_port_no) && $_GET['dep_port_no'] == $data[0]->dep2_port_no)
                <span class="br">{{$data[0]->dep_port_name}}({{$data[0]->dep_port_eng}})</span>
                @endif
                <strong>
                    <span class="ico">→</span>
                    @if(isset($data[0]->arr2_port_no) && $_GET['arr_port_no'] == $data[0]->arr2_port_no)
                    <span class="br">{{$data[0]->arr_port_name}}({{$data[0]->arr_port_eng}})</span>
                    @endif
                </strong>
            </h2>
            <table class="table sta_table align-middle">
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
                    <tr>
                        <td>{{strtoupper($val->flight_num)}}</td>
                        <td><p>({{$data[0]->dep_port_eng}})</p>{{substr($val->dep_time, 0, 2)}}:{{substr($val->dep_time, 2, 2)}}</td>
                        <td>{{ TimeCalculation($val->dep_time, $val->arr_time) }}</td>
                        <td><p>({{$data[0]->arr_port_eng}})</p>{{substr_replace($val->arr_time,':',2,0)}}</td>
                        <td><input type="hidden" class="dep_price" value="{{$val->price}}">{{substr_replace($val->price,',',-3,0)}}</td>
                        <td class="dep_fly_no"><input type="radio"  name="dep_fly_no" value="{{$val->fly_no}}"><span style="display:none;">{{$val->price}}</span></td>
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
                @if( isset($data[0]->arr2_port_no) && $_GET['arr_port_no'] == $data[0]->arr2_port_no)
                <span class="br">{{$data[0]->arr_port_name}}({{$data[0]->arr_port_eng}})</span>
                @endif
                <strong>
                    <span class="ico">→</span>
                    @if(isset($data[0]->dep2_port_no) && $_GET['dep_port_no'] == $data[0]->dep2_port_no)
                    <span class="br">{{$data[0]->dep_port_name}}({{$data[0]->dep_port_eng}})</span>
                    @endif
                </strong>
            </h2>
            <table class="table sta_table align-middle">
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
                    <tr>
                        <td>{{strtoupper($val->flight_num)}}</td>
                        <td><p>({{$data2[0]->dep_port_eng}})</p>{{substr($val->dep_time, 0, 2)}}:{{substr($val->dep_time, 2, 2)}}</td>
                        <td>{{ TimeCalculation($val->dep_time, $val->arr_time) }}</td>
                        <td><p>({{$data2[0]->arr_port_eng}})</p>{{substr_replace($val->arr_time,':',2,0)}}</td>
                        <td>{{substr_replace($val->price,',',-3,0)}}</td>
                        <td class="arr_fly_no"><input type="radio" name="arr_fly_no" value="{{$val->fly_no}}"><span style="display:none;">{{$val->price}}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">데이터없음</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @else
        {{-- 편도 --}}
        <input type="hidden" name="hd_li_flg" value="{{$flg['hd_li_flg']}}">
        <h2>여정1 :
            @if(isset($oneway[0]->dep2_port_no) && $_GET['one_dep_port_no'] == $oneway[0]->dep2_port_no)
            <span class="br">{{$oneway[0]->dep_port_name}}({{$oneway[0]->dep_port_eng}})</span>
            @endif
            <strong>
                <span class="ico">→</span>
                @if(isset($oneway[0]->arr2_port_no) && $_GET['one_arr_port_no'] == $oneway[0]->arr2_port_no)
                <span class="br">{{$oneway[0]->arr_port_name}}({{$oneway[0]->arr_port_eng}})</span>
                @endif
            </strong>
        </h2>
        <table class="table sta_table align-middle">
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
                <tr>
                    <td>{{strtoupper($val->flight_num)}}</td>
                    <td><p>({{$oneway[0]->dep_port_eng}})</p>{{substr($val->dep_time, 0, 2)}}:{{substr($val->dep_time, 2, 2)}}</td>
                    <td>
                        {{TimeCalculation($val->dep_time, $val->arr_time)}}
                    </td>
                    <td><p>({{$oneway[0]->arr_port_eng}})</p>{{substr_replace($val->arr_time,':',2,0)}}</td>
                    <td>{{substr_replace($val->price,',',-3,0)}}</td>
                    <td><input type="radio" name="dep_fly_no" value="{{$val->fly_no}}"></td>
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
            <dt>총금액</dt>
            <dd class="sum_price">0원</dd>
        </div>
        <div class="btnArea">
            <button type="submit" class="chk_btn">다음</button>
        </div>
    </form>
</div> {{-- END container --}}

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{asset('js/reserveChk.js')}}"></script>
@endsection