{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : noticedetail.blade.php
 * 이력         :   v001 0614 이동호 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '공지사항')

@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link rel="stylesheet" href="{{asset('css/noticeDetail.css')}}">
@endsection

@section('contents')
    @include('layout.inc.notice')
    <div style="min-height: 600px;">
        <div class="nDetailContainer container">
            <hr>
            <div class="nTitle">
                <div class="nTitleText">
                    {{$data->notice_title}}
                    <div class="created_date">
                        등록일 : {{mb_substr($data->created_at, 0, 10)}}
                    </div>
                </div>
            </div>
            <div class="nContent">
                @if($data->image_path)
                <div class="nImage">
                    <img src="{{asset($data->image_path . '?' . time())}}" alt="이미지" class="noticeImg">
                </div>
                @endif
                {!!$data->notice_content!!}
            </div>
        </div>
        <div class="nButtons">
            @if($isAdmin)
                <button type="button" onclick="location.href = '{{route('notice.edit', ['notice' => $data->notice_no])}}'" class="btn btn-outline-success">수정</button>
                <form action="{{route('notice.destroy', ['notice' => $data->notice_no])}}" method="POST" id="formDel">
                    @csrf
                    @method('delete')
                    <button type="button" onclick="confirmDel()" class="btn btn-outline-danger">삭제</button>
                </form>
            @endif
            <button type="button" onclick="location.href = '{{route('notice.index')}}'" class="btn btn-outline-info">리스트</button>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/noticeDetail.js')}}"></script>
@endsection