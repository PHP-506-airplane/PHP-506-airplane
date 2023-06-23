{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : rateinfo.blade.php
 * 이력         :   v001 0623 이동호 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '할인 안내')

@section('css')
    {{-- <link rel="stylesheet" href="{{asset('css/rateinfo.css')}}"> --}}
@endsection

@section('contents')
    @forelse($data as $val)
        <div>{{$val->kind_of_rate}} : {{$val->rate_per}}%</div>
    @empty
        <div>DB 에러</div>
    @endforelse
    <button type="button" onclick="location.href='{{route('reservation.main')}}'">메인으로</button>
@endsection

@section('js')
    {{-- <script src="{{asset('js/rateinfo.js')}}"></script> --}}
@endsection