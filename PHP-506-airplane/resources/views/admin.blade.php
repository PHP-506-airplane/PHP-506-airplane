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
        .jsPage {
            display: inline-block;
            max-width: 50px; 
        }

        .after::after {
            display: inline-block;
            position: relative;
            left: 70px;
            content: '~';
        }
    </style>
@endsection

@section('contents')
    <div style="min-height: 750px; margin: 30px auto; text-align: center;">
        <div>
            <form id="searchForm" method="POST" style="margin: 20px;">
                @csrf
                <input type="date" name="dateStart" id="dateStart" value="{{ $today }}">
                <span> ~ </span>
                <input type="date" name="dateEnd" id="dateEnd" value="{{ $today }}">
                <select name="airline" id="airline">
                    <option value="0">항공사</option>
                    @foreach($airLine as $val)
                        <option value="{{ $val->line_no }}">{{ $val->line_name }}</option>
                    @endforeach
                </select>
                <select name="depPort" id="depPort">
                    <option value="0">출발지</option>
                    @foreach($port as $val)
                        <option value="{{ $val->port_no }}">{{ str_replace('공항', '', $val->port_name) }}</option>
                    @endforeach
                </select>
                <select name="arrPort" id="arrPort">
                    <option value="0">도착지</option>
                    @foreach($port as $val)
                        <option value="{{ $val->port_no }}">{{ str_replace('공항', '', $val->port_name) }}</option>
                    @endforeach
                </select>
                {{-- 출발/도착공항 추가 --}}
                <button type="button" id="searchBtn" class="btn btn-outline-dark btn-sm">검색</button>
            </form>
        </div>
        <div id="resultDiv" class="container">
            {{-- 검색 결과 출력부분 --}}
            <div class="row" style="background-color: #0000009d; color: white; height: 50px; line-height: 50px; font-weight: 600; margin-bottom: 20px;">
                <div class="col">날짜</div>
                <div class="col">항공사</div>
                <div class="col">출발지</div>
                <div class="col">도착지</div>
                <div class="col">출발</div>
                <div class="col">도착</div>
                <div class="col">예약된 좌석</div>
                <div class="col">삭제</div>
            </div>
            <div id="resultRow">
                @forelse($data as $item)
                    <div class="row">
                        <div class="col">{{ $item->fly_date }}</div>
                        <div class="col">{{ $item->line_name }}</div>
                        <div class="col after">{{ str_replace('공항', '', $item->dep_port_name) }}</div>
                        <div class="col">{{ str_replace('공항', '', $item->arr_port_name) }}</div>
                        <div class="col after">{{ substr($item->dep_time, 0, 2) . ':' . substr($item->dep_time, 2) }}</div>
                        <div class="col">{{ substr($item->arr_time, 0, 2) . ':' . substr($item->arr_time, 2) }}</div>
                        <div class="col">{{ $item->count }}석</div>
                        <div class="col">
                            {{-- <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">수정</button> --}}
                            <button type="button" class="btn btn-outline-dark btn-sm">삭제</button>
                        </div>
                    </div>
                    <hr>
                @empty
                <div class="row">
                    <div>데이터가 없습니다.</div>
                </div>
                @endforelse
            </div>
            <div class="paginate">
                {{ $data->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/admin.js')}}"></script>
@endsection