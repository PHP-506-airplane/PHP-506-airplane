{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : noticelist.blade.php
 * 이력         :   v001 0612 이동호 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '공지사항')

@section('css')
    <link rel="stylesheet" href="{{asset('css/noticelist.css')}}">
@endsection

@section('contents')
    @include('layout.inc.notice')
    @if($isAdmin)
        <div class="divCreateBtn">
            <button type="button" onclick="location.href='{{route('notice.create')}}'" class="btnCreate btn btn-outline-info">공지사항 작성</button>
        </div>
    @endif
    <div class="nListContainer container">
        <div class="listInfo row textCenter">
            <div class="col-2 afterLine">번호</div>
            <div class="col-8 afterLine">제목</div>
            <div class="col-2">등록일</div>
        </div>
        @forelse($data as $item)

        <div class="row mainContents">
            <div class="col-2 textCenter afterLine">{{$item->notice_no}}</div>
            <div class="col-8 afterLine"><a href="{{route('notice.show', ['notice' => $item->notice_no])}}">{{$item->notice_title}}</a></div>
            <div class="col-2 textCenter">{{mb_substr($item->created_at, 0, 10)}}</div>
        </div>
        <hr>
        @empty
        <div class="row">
            <div class="noneContents">공지사항이 없습니다.</div>
        </div>
        @endforelse
    </div>
    <div class="serachBox">
        <form action="{{ route('notice.index') }}" method="GET">
            <input type="text" id="serachInput" name="search" value="{{ $searchText }}">
            <button type="submit" class="btn btn-outline-info">검색</button>
        </form>
    </div>

    {{-- 검색하면 검색결과 페이지네이션 --}}
    @if ($searchText)
        <div class="paginate" style="min-height: 50px;">
            {{ $data->appends(['search' => $searchText])->links('vendor.pagination.custom') }}
        </div>
    @else
        <div class="paginate">
            {{ $data->links('vendor.pagination.custom') }}
        </div>
    @endif

@endsection

@section('js')
    <script src="{{asset('js/noticeList.js')}}"></script>
@endsection