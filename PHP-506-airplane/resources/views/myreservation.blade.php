{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : myreservation.blade.php
 * 이력         :   v001 0620 이동호 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '나의 예약')

@section('css')
    {{-- <link rel="stylesheet" href="{{asset('css/myreservation.css')}}"> --}}
@endsection

@section('contents')
    @if($data->isEmpty())
        <div>예약 정보가 없습니다.</div>
        <br>
        <button type="button" onclick="location.href='{{route('reservation.main')}}'">예약하기</button>
    @endif
    @foreach($data as $key => $val)
        {!!'flyno : ' . strtoupper($val['fly_no']) . '<br>'!!}
        {!!'resno : ' . strtoupper($val['reserve_no']) . '<br>'!!}
        {!!'편명 : ' . strtoupper($val['flight_num']) . '<br>'!!}
        {!!'항공사 : ' . $val['line_name'] . '<br>'!!}
        {!!'항공사 코드 : ' . $val['line_code'] . '<br>'!!}
        {!!'비행기 이름 : ' . $val['plane_name'] . '<br>'!!}
        {!!'예약자 이름 : ' . $val['u_name'] . '<br>'!!}
        {!!'좌석 : ' . $val['seat_no'] . '<br>'!!}
        {!!'날짜 : ' . $val['fly_date'] . '<br>'!!}
        {!!'출발 시간 : ' . $val['dep_time'] . '<br>'!!}
        {!!'도착 시간 : ' . $val['arr_time'] . '<br>'!!}
        {!!'소요 시간 : ' . TimeCalculation($val['dep_time'], $val['arr_time']) . '<br>'!!}
        {!!'출발 : ' . $val['dep_port_name'] . '<br>'!!}
        {!!'도착 : ' . $val['arr_port_name'] . '<br>'!!}
        <form action="{{route('reservation.rescancle')}}" method="POST" id="formCancel">
            @csrf
            <input type="hidden" name="reserve_no" value="{{$val['reserve_no']}}">
            <input type="hidden" name="t_no" value="{{$val['t_no']}}">
            <button type="button" onclick="confirmCancel()">예약 취소</button>
            {{-- <button type="submit">예약 취소</button> --}}
        </form>
        <hr>
    @endforeach
@endsection

@section('js')
    <script src="{{asset('js/myreservation.js')}}"></script>
@endsection