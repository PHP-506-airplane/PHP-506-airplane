@extends('layout.layout')

@section('title','항공편 조회')

@section('css')
    <link rel="stylesheet" href="{{asset('css/reservationChk.css')}}">
@endsection

@section('contents')
<div class="container">
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
        <h2>여정1 :
                @if($_GET['dep_port_no'] == $data[0]->dep2_port_no)
                    <span class="br">{{$data[0]->dep_port_name}}({{$data[0]->dep_port_eng}})</span>
                @endif
            <strong>
                <span class="ico">→</span>
                    @if($_GET['arr_port_no'] == $data[0]->arr2_port_no)
                        <span class="br">{{$data[0]->arr_port_name}}({{$data[0]->arr_port_eng}})</span>
                    @endif
            </strong>
		</h2>
        <table class="table sta_table">
            <thead class="table-light">
                <tr>
                    <th>편명</th>
                    <th>출발시간</th>
                    <th></th>
                    <th>도착시간</th>
                    <th>가격</th>
                </tr>
            </thead>
            <tbody>
                @if($_GET['dep_port_no'] == $data[0]->dep2_port_no && $_GET['arr_port_no'] == $data[0]->arr2_port_no)
                    @forelse($data as $val)
                    <tr>
                        <td>{{$val->flight_num}}</td>
                        <td>{{$val->dep_time}}</td>
                        <td>시 분</td>
                        <td>{{$val->arr_time}}</td>
                        <td class="price_btn"><a href="#">{{$val->price}}</a></td>
                    </tr>
                    @empty
                        <tr>
                            <td>데이터없음</td>
                        </tr>
                    @endforelse
                @endif
            </tbody>
        </table>
        <h2>여정2 :
            @if( !empty($data[0]->arr2_port_no) || $_GET['arr_port_no'] == $data[0]->arr2_port_no)
                <span class="br">{{$data[0]->arr_port_name}}({{$data[0]->arr_port_eng}})</span>
            @endif
            <strong>
                <span class="ico">→</span>
                @if($_GET['dep_port_no'] == $data[0]->dep2_port_no)
                    <span class="br">{{$data[0]->dep_port_name}}({{$data[0]->dep_port_eng}})</span>
                @endif
            </strong>
        </h2>
    <table class="table sta_table">
        <thead class="table-light">
            <tr>
                <th>편명</th>
                <th>출발시간</th>
                <th></th>
                <th>도착시간</th>
                <th>가격</th>
            </tr>
        </thead>
        <tbody>
            @if($_GET['arr_port_no'] === $data[0]->dep_port_no)
                @forelse($data as $val)
                    <tr>
                        <td>{{$val->flight_num}}</td>
                        <td>{{$val->dep_time}}</td>
                        <td>시 분</td>
                        <td>{{$val->arr_time}}</td>
                        <td>{{$val->price}}</td>
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
</div> {{-- END container --}}
@endsection