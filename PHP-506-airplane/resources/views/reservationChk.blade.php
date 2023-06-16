{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : reservationChk.blade.php
 * 이력         :   v001 0613 오재훈 new
**************************************************/
--}}
@extends('layout.layout')

@section('title','항공편 조회')

@section('css')
    <link rel="stylesheet" href="{{asset('css/reservationChk.css')}}">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
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
                @if(isset($data[0]->arr2_port_no) && $_GET['arr_port_no'] == $data[0]->arr2_port_no)
                    @forelse($data as $val)
                    <tr>
                        <td>{{strtoupper($val->flight_num)}}</td>
                        <td>{{$val->dep_time}}</td>
                        <td>시 분</td>
                        <td>{{$val->arr_time}}</td>
                        <td>
                            <p class="price_btn">
                                <a href="javascript:void(0);" class="dep_price">{{$val->price}}</a>
                            </p>
                        </td>
                        <td><input type="radio" name="dep_fly_no" value="{{$val->fly_no}}"></td>
                    </tr>
                    @empty
                        <tr>
                            <td>데이터없음</td>
                        </tr>
                    @endforelse
                @endif
            </tbody>
        </table>
        
        {{-- 오는편 --}}
        <h2>여정2 :
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
            @if(isset($_GET['arr_port_no']) && $_GET['arr_port_no'] == $data2[0]->dep2_port_no)
                @forelse($data2 as $val)
                    <tr>
                        <td>{{$val->flight_num}}</td>
                        <td>{{$val->dep_time}}</td>
                        <td>시 분</td>
                        <td>{{$val->arr_time}}</td>
                        <td>
                            <p class="price_btn">
                                <a href="javascript:void(0);" class="arr_price">{{$val->price}}</a>
                            </p>
                        </td>
                        <td><input type="radio" name="arr_fly_no" value="{{$val->fly_no}}"></td>
                    </tr>
                @empty
                    <tr>
                        <td>데이터없음</td>
                    </tr>
                @endforelse
            @endif
        </tbody>
    </table>
    </div>
    <div class="total_price">
        <dt>총금액</dt>
        <dd class="sum_price">0원</dd>
    </div>
    <div class="btnArea">
            <button type="submit">다음</button>
    </div>
</form>
</div> {{-- END container --}}

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="{{asset('js/reserveChk.js')}}"></script>
@endsection