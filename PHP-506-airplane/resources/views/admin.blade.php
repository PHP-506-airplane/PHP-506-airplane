@extends('layout.layout')

@section('title', '관리자 페이지')

@section('css')
    {{-- <link rel="stylesheet" href="{{asset('css/admin.css')}}"> --}}
@endsection

@section('contents')
    <div style="min-height: 780px; margin: 0 auto; text-align: center;">
        관리자 페이지
        <div>
            <form action="">
                <input type="date" name="date">
                <button type="button">검색</button>
            </form>
        </div>
        <div>
            운항정보 출력
        </div>
    </div>
@endsection

@section('js')
    {{-- <script src="{{asset('js/admin.js')}}"></script> --}}
@endsection