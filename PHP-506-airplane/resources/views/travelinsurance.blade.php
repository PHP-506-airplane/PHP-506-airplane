{{--
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : travelinsurance.blade.php
 * 이력         :   v001 0725 오재훈 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '여행자 보험')

@section('css')
<link rel="stylesheet" href="{{asset('css/insurance.css')}}">
<link rel="stylesheet" href="/etc.clientlibs/koreanair/components/content/thumb/thumbnail-text-list-d/clientlib.min.css" type="text/css">
@endsection

@section('contents')
<div class="baggageinfoHeader">
    <h1 class="noticeH1">여행자 보험 안내</h1>
    <h5 class="noticeH5">여행자 보험 관련 규정을 확인하세요.</h5>
</div>
<div class="container">
    <div class="thumbnail-text-list-d parbase">
        <hr class="divider">
        <div class="mb4020">
        <div class="ttld">       
            <h2 class="h2">나에게 맞는 여행 보험을 확인하고 동반자까지 편리하게 가입하세요.</h2>
            <ul class="timeline ">
        <li class="timeline__item">
            <div class="imgbox">
                <img src="{{asset('img/user-icon.png')}}" alt="">
            </div>
            <div class="timeline__box">
                <h3 class="h3">가입대상</h3>
                <p class="p">해외 또는 국내 여행을 계획 중인 대한민국 거주자라면 누구든 가입 가능합니다.</p>
            </div>
        </li>
          
        <li class="timeline__item">
            <div class="imgbox">
                <img src="{{asset('img/pencil-icon.png')}}" alt="">
            </div>
            <div class="timeline__box">
                <h3 class="h3">가입 방법 안내 </h3>
                <ul class="list -disc">
                    <li class="list__item">항공권을 구매하신 경우 ‘예약 목록’ &gt; ‘상세 보기’ 에서 함께 여행하는 모든 탑승객의 예상 보험료를 확인 후 여행 보험에 가입할 수 있습니다.
                    </li>
                    <li class="list__item">아래 해외여행보험 가입 버튼 또는 국내여행보험 가입 버튼을 선택하여 직접 일정 및 여행자 정보를 입력하고 보험에 가입할 수 있습니다.
                    </li>
                </ul>
            </div>
        </li>
        <li class="timeline__item">
            <div class="imgbox">
                <img src="{{asset('img/book-icon.png')}}"  alt="">
            </div>
            <div class="timeline__box">
                <h3 class="h3">가입 변경 및 취소 </h3>
                <ul class="list -disc">
                    <li class="list__item">여행 출발 전까지 무료 취소 및 변경할 수 있습니다.
                    </li>
                    <li class="list__item">여행자 보험 내 부분 취소는 할 수 없으며, 전체 취소 후 재가입해야 합니다.
                    </li>
                    <li class="list__item">‘예약목록’ &gt; ‘상세보기’ 또는 하단의 조회 및 취소하기 버튼을 통해 가입 내역을 확인하고 변경 가능합니다.
                    </li>
                </ul>
            </div>
        </li>
        <li class="timeline__item">
            <div class="imgbox">
                <img src="{{asset('img/file-icon.png')}}" alt="">
            </div>
            <div class="timeline__box">
                <h3 class="h3">특약사항</h3>
                <ul class="list -disc">
                    <li class="list__item">해외여행보험 가입 시 항공기 및 수하물 지연에 따른 보상
                    </li>
                    <li class="list__item">수하물 파손 및 여행 중 휴대품 손해 보상 (분실 제외, 국내여행보험의 경우 이동통신 단말기는 제외)
                    </li>
                </ul>
            </div>
        </li>
            </ul>    
        </div> 
        </div>
    </div>
</div>

    
@endsection

@section('js')
@endsection
