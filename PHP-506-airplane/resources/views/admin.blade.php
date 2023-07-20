@extends('layout.layout')

@section('title', '관리자 페이지')

@section('css')
    {{-- <link rel="stylesheet" href="{{asset('css/admin.css')}}"> --}}
    <style>
        a {
            margin: 10px;
            color: black;
            text-decoration: none;
        }
    </style>
@endsection

@section('contents')
    <div style="min-height: 780px; margin: 0 auto; text-align: center;">
        <div>
            <form id="searchForm" method="POST">
                @csrf
                <input type="date" name="dateStart" id="dateStart" value="{{ $today }}">
                <input type="date" name="dateEnd" id="dateEnd" value="{{ $today }}">
                <select name="airline" id="airline">
                    <option value="0">전체</option>
                    @foreach($airLine as $val)
                        <option value="{{ $val->line_no }}">{{ $val->line_name }}</option>
                    @endforeach
                </select>
                <button type="button" id="searchBtn">검색</button>
            </form>
        </div>
        <div id="resultDiv" class="container">
            {{-- 검색 결과 출력부분 --}}
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/admin.js')}}"></script>
@endsection