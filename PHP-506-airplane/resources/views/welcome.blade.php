{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : welcome.blade.php
 * 이력         :   v001 0612 오재훈 new
 *                  v002 0614 이동호 add 공지사항 출력
 *                  v003 0621 이동호 add 최저가 항공 스와이퍼
**************************************************/
--}}
@extends('layout.layout')

@section('title','Main')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
{{-- jquery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
{{-- datepicker moment --}}
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
{{-- daterangepicker --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
{{-- css --}}
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

{{-- v004 add 이동호 --}}
{{-- 스와이퍼 라이브러리 --}}
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endsection

@section('contents')
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">
                    {{-- 왕복,편도 탭 메뉴 --}}
                    <div class="tabs">
                        <ul class="tabs-list">
                            <li class="on hd_li_no1"><a href="#tab1">왕복</a></li>
                            <li class="hd_li_no2"><a href="#tab2">편도</a></li>
                        </ul>
                        <form action="{{route('reservation.check')}}" method="get">
                            @csrf
                        <div id="tab1"class="tab on">
                            {{-- 왕복 --}}
                            <div class="round-way">
                                <div class="selectBox2">
                                    <input type="hidden" class="hd_li_flg" name="hd_li_flg" value="1">
                                    <input type="hidden" class="ro_s_hd_no" name="dep_port_no">
                                    <input type="text" placeholder="출발지"  class="sta_label form-control" readonly>
                                    <ul class="optionList">
                                        @forelse($data as $val)
                                            <li class="sta_optionItem opItem" value="{{$val->port_no}}">{{$val->port_name}}</li>
                                            @empty
                                            <li class="arr_optionItem opItem">데이터없음</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <input type="hidden" class="ro_a_hd_no" name="arr_port_no">
                                    <input type="text" placeholder="도착지" class="arr_label form-control" readonly>
                                    <ul class="optionList">
                                        @forelse($data as $val)
                                            <li class="arr_optionItem opItem" value="{{$val->port_no}}">{{$val->port_name}}</li>
                                            @empty
                                            <li class="arr_optionItem opItem">데이터없음</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <input type="text" id="txtDate" class="form-control" name="fly_date" />
                                </div>
                                <button type="submit" class="btn-submit">항공편 검색</button>
                            </div>
                        </div>
                        {{-- 편도 --}}
                        <div id="tab2" class="tab">
                            <div class="one-way">
                                <div class="selectBox2">
                                    <input type="hidden" class="one_s_hd_no" name="one_dep_port_no">
                                    <input type="text" placeholder="출발지" class="oSta_label form-control" readonly>
                                    <ul class="optionList">
                                        @forelse($data as $val)
                                            <li class="oSta_optionItem opItem" value="{{$val->port_no}}">{{$val->port_name}}</li>
                                            @empty
                                            <li class="arr_optionItem opItem">데이터없음</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <input type="hidden" class="one_a_hd_no" name="one_arr_port_no">
                                    <input type="text" placeholder="도착지" class="oArr_label form-control" readonly>
                                    <ul class="optionList">
                                        @forelse($data as $val)
                                            <li class="oArr_optionItem opItem" value="{{$val->port_no}}">{{$val->port_name}}</li>
                                            @empty
                                            <li class="arr_optionItem opItem">데이터없음</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <input type="text" id="txtDate1" class="form-control" name="one_fly_date" />
                                </div>
                                <button type="submit" class="btn-submit">항공편 검색</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </header>
        {{-- v004 add 이동호 --}}
        <div class="mySwipper">
            <div class="swiper-container">
                <div class="swiper-wrapper swiper_margin">
                    @for($i = 0; $i <= 5; $i++)
                        <div class="swiper-slide slide{{$i}} slide_width">
                            <div class="swiper_contents">
                                <img src="{{asset('lowCostImg/'. $i .'.png?' . time())}}" alt="IMG" class="swiper_img">
                                <div>{{$lowCost[$i]->dep_name}} ~ {{$lowCost[$i]->arr_name}}</div>
                                <div>날짜 : {{$lowCost[$i]->fly_date}}</div>
                                <div>가격 : {{number_format($lowCost[$i]->price)}}원</div>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div> {{-- 이전 슬라이드 버튼 --}}
                <div class="swiper-button-next" onclick="goToNextSlide()"></div> {{-- 다음 슬라이드 버튼 --}}
            </div>
        </div>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container sec2">
                <div class="notice">
                    {{-- v002 add 이동호 --}}
                    <h2><a href="{{route('notice.index')}}">공지사항</a></h2>
                    <ul>
                        @foreach($notices as $notice)
                            <li>
                                <a href="{{route('notice.show', ['notice' => $notice->notice_no])}}">
                                    <span>{{ $notice->notice_title }}</span>
                                    <span class="notice-date">{{ $notice->created_at->format('Y.m.d') }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="map">
                    <h2>국내공항위치</h2>
                    <div id="map" style="width:400px;height:300px;"></div>
                </div>
            </div>
        </section>
@endsection
        
@section('js')
    {{-- 카카오맵api --}}
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=ec157c40a3e8affeb7c7cd7bc375b9fc"></script>
    
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

@endsection