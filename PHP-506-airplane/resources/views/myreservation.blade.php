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
    @foreach($data as $key => $val)
        {!!'편명 : ' . strtoupper($val['flight_num']) . '<br>'!!}
        {!!'비행기 이름 : ' . $val['plane_no'] . '<br>'!!}
        {!!'좌석 : ' . $val['seat_no'] . '<br>'!!}
        {!!'날짜 : ' . $val['fly_date'] . '<br>'!!}
        {!!$key . ':' . $val . '<br>'!!}
    @endforeach
@endsection

@section('js')
    {{-- <script src="{{asset('js/myreservation.js')}}"></script> --}}
@endsection