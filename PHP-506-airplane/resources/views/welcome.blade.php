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

@section('title','PAPER AIRLINE')

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
                                    <input type="text" placeholder="출발지"  class="sta_label form-control" id="box1" readonly>
                                    <ul class="optionList">
                                        @forelse($data as $val)
                                            <li class="sta_optionItem opItem" id="lists" value="{{$val->port_no}}">{{$val->port_name}}</li>
                                            @empty
                                            <li class="arr_optionItem opItem">데이터없음</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <input type="hidden" class="ro_a_hd_no" name="arr_port_no">
                                    <input type="text" placeholder="도착지" class="arr_label form-control" id="box1" readonly>
                                    <ul class="optionList">
                                        @forelse($data as $val)
                                            <li class="arr_optionItem opItem" id="lists" value="{{$val->port_no}}">{{$val->port_name}}</li>
                                            @empty
                                            <li class="arr_optionItem opItem">데이터없음</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="selectBox2 dateBox">
                                    <input type="text" id="txtDate" class="form-control" name="fly_date" />
                                </div>
                                <div class="selectBox2 sbox">
                                    <input type="text" class="passenger form-control" readonly >
                                    <input type="hidden" class="passenger ADULT" name="ADULT">
                                    <input type="hidden" class="passenger CHILD" name="CHILD">
                                    <input type="hidden" class="passenger BABY" name="BABY">
                                    <a href="#none" class="selected_passenger">
                                        <span class="ADULT">성인0 </span>
                                        <span class="CHILD">유아0 </span>
                                        <span class="BABY">소아0 </span>
                                    </a>
                                    <div class="layer_passenger">
                                        <div class="layer_content">
                                            <dl>
                                                <dt>
                                                    <label>성인</label>
                                                </dt>
                                                <dd class="sel_passenger">
                                                    <a class="btn_minus" href="#none" onclick="changeCount('ADULT', -1);">빼기</a>
                                                    <input class="booking passenger ADULT" id="ADULT" title="인원수" type="text" value="0">
                                                    <a class="btn_plus" href="#none" onclick="changeCount('ADULT', 1);">더하기</a>
                                                </dd>
                                            </dl>
                                            <dl>
                                                <dt>
                                                    <label>유아</label>
                                                </dt>
                                                <dd class="sel_passenger">
                                                    <a class="btn_minus" href="#none" onclick="changeCount('CHILD', -1);">빼기</a>
                                                    <input class="booking passenger CHILD" id="CHILD" title="인원수" type="text" value="0">
                                                    <a class="btn_plus" href="#none" onclick="changeCount('CHILD', 1);">더하기</a>
                                                </dd>
                                            </dl>
                                            <dl>
                                                <dt>
                                                    <label>소아</label>
                                                </dt>
                                                <dd class="sel_passenger">
                                                    <a class="btn_minus" href="#none" onclick="changeCount('BABY', -1);">빼기</a>
                                                    <input class="booking passenger BABY" id="BABY" title="인원수" type="text" value="0">
                                                    <a class="btn_plus" href="#none" onclick="changeCount('BABY', 1);">더하기</a>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                    <button type="submit" class="btn btn-submit" id="searchbtn"><span>조회</span></button>
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
                                            <li class="oSta_optionItem opItem" id="lists" value="{{$val->port_no}}">{{$val->port_name}}</li>
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
                                            <li class="oArr_optionItem opItem" id="lists" value="{{$val->port_no}}">{{$val->port_name}}</li>
                                            @empty
                                            <li class="arr_optionItem opItem">데이터없음</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <input type="text" id="txtDate1" class="form-control" name="one_fly_date" />
                                </div>
                                <button type="submit" class="btn btn-submit2" id="searchbtn"><span>항공편 검색</span></button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </header> 
        {{-- 아이콘 --}}
        <div class="icons container">
            <h1>부가서비스</h1>
            <div class="icons_inner">
                <div class="box box1">
                    <img src="{{asset('img/reserve-icon.png')}}" alt="">
                    <p><strong>예약 조회</strong></p>
                </div>
                <div class="box box2">
                    <img src="{{asset('img/mileage-icon.png')}}" alt="">
                    <p><strong>마일리지 안내</strong></p>
                </div>
                <div class="box box3">
                    <img src="{{asset('img/user-icon.png')}}" alt="">
                    <p><strong>마이페이지</strong></p>
                </div>
                <div class="box box4">
                    <img src="{{asset('img/luggage-icon.png')}}" alt="">
                    <p><strong>수하물 안내</strong></p>
                </div>
                <div class="box box5">
                    <img src="{{asset('img/insurance-icon.png')}}" alt="">
                    <p><strong>여행자 보험</strong></p>
                </div>
            </div>
        </div>
        {{-- v004 add 이동호 스와이퍼 --}}
    <div class="wrap">
        <div class="swiperMent container" style="font-weight:600"><h1>특가 항공권</h1></div>
        <div class="mySwipper">
            <div class="swiper-container">
                <div class="swiper-wrapper swiper_center">
                    @for($i = 0; $i <= 7; $i++)
                        <div class="swiper-slide slide{{$i}}" id="slide_width">
                            {{-- <div class="swiper_contents swiper_width"> --}}
                            <ul class="type1">
                                <li>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <form action="{{route('reservation.checkpost')}}" method="POST" id="formLowCost" onclick="swiperClick(event)">
                                        @csrf
                                        <div class="goods-img">
                                            <img src="{{asset('lowCostImg/'. $i .'.png?' . time())}}" alt="IMG" class="swiper_img">
                                        </div>
                                        <div class="goods-cont">
                                            <i class="bul">편도운항</i>
                                            <div class="goods-loc">
                                                <span class="start">{{str_replace('공항','',$lowCost[$i]->dep_name)}}</span>
                                                <span class="mid"></span>
                                                <span class="end">{{str_replace('공항','',$lowCost[$i]->arr_name)}}</span>
                                            </div>
                                            <div class="goods-date">{{$lowCost[$i]->fly_date}}</div>
                                            <div class="goods-price">KRW {{number_format($lowCost[$i]->price)}}</div>
                                        </div>
                                        <input type="hidden" name="hd_li_flg" value="0">
                                        <input type="hidden" name="dep_port_no" value="{{$lowCost[$i]->dep_no}}">
                                        <input type="hidden" name="one_dep_port_no" value="{{$lowCost[$i]->dep_no}}">
                                        <input type="hidden" name="arr_port_no" value="{{$lowCost[$i]->arr_no}}">
                                        <input type="hidden" name="one_arr_port_no" value="{{$lowCost[$i]->arr_no}}">
                                        <input type="hidden" name="dep_plane_no" value="{{$lowCost[$i]->plane_no}}">
                                        <input type="hidden" name="dep_fly_no" value="{{$lowCost[$i]->fly_no}}">
                                        <input type="hidden" name="one_fly_date" value="{{$lowCost[$i]->fly_date}}">
                                    </form>
                                </li>
                            </ul>
                            {{-- </div> --}}
                        </div>
                    @endfor
                </div>
                <div class="swiper-btn-next"></div>
                <div class="swiper-btn-prev"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
        {{-- /스와이퍼 --}}
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container sec2" id="container2">
                <div class="notice"> 
                    {{-- v002 add 이동호 --}}
                    <h2><a href="{{route('notice.index')}}" style="color: #000;">공지사항</a></h2>
                    <ul>
                        @foreach($notices as $notice)
                            <li class="noticeli">
                                <a href="{{route('notice.show', ['notice' => $notice->notice_no])}}">
                                    <span><img src="{{asset('img/megaphone-icon.png')}}" alt=""></span>
                                    <span class="notice-title">{{ $notice->notice_title }}</span>
                                    <span class="notice-date">{{ $notice->created_at->format('Y.m.d') }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="map">
                    <div class="map_img">
                        <h2 class="maph2">국내공항위치</h2>
                        <div class="img1">
                            <span>국내</span>
                            <img src="{{asset('img/icon-airport2.png')}}" alt="">
                        </div>
                        <div class="img1">
                            <span>국제</span>
                            <img src="{{asset('img/icon-airport.png')}}" alt="">
                        </div>
                    </div>
                    <div id="map"></div>
                </div>
            </div>
        </section>
@endsection
        
@section('js')
        {{-- 카카오맵api --}}
        <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=ec157c40a3e8affeb7c7cd7bc375b9fc"></script>
        
        <script src="{{asset('js/scripts.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>

        <script>
            function swiperClick(event) {
                const clickedForm = event.target.closest('#formLowCost'); // 클릭된 form을 찾음
                showLoading();
                clickedForm.submit();
            }
        </script>
@endsection