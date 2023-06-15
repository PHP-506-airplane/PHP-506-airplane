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
			<span class="br"></span>{{$data->port_name}}<strong><span class="ico">→</span>도쿄/나리타(NRT)</strong>
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
                <tr>
                    <td>bb</td>
                    <td>bb</td>
                    <td>bb</td>
                    <td>bb</td>
                    <td>bb</td>
                </tr>
            </tbody>
        </table>
    </div>
</div> {{-- END container --}}
@endsection