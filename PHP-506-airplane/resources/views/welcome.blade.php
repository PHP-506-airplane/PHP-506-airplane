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
@endsection

@section('contents')
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">
                    {{-- 왕복,편도 탭 메뉴 --}}
                    <div class="tabs">
                        <ul class="tabs-list">
                            <li class="on"><a href="#tab1">왕복</a></li>
                            <li><a href="#tab2">편도</a></li>
                        </ul>
                        <form action="{{route('reservation.check')}}" method="get">
                        <div id="tab1"class="tab on">
                            {{-- 왕복 --}}
                            <div class="round-way">
                                <div class="selectBox2">
                                    <input type="text" placeholder="출발지" name="" class="sta_label form-control" readonly>
                                    <ul class="optionList">
                                        @forelse($data as $val)
                                            <li class="sta_optionItem opItem">{{$val->port_name}}</li>
                                            @empty
                                            <li class="arr_optionItem opItem">데이터없음</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <input type="text" placeholder="도착지" class="arr_label form-control" readonly>
                                    <ul class="optionList">
                                        @forelse($data as $val)
                                            <li class="arr_optionItem opItem">{{$val->port_name}}</li>
                                            @empty
                                            <li class="arr_optionItem opItem">데이터없음</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <input type="text" id="txtDate" class="form-control" value="" />
                                </div>
                            </div>
                        </div>
                        <div id="tab2"class="tab">
                            <div class="one-way">
                                <div class="selectBox2">
                                    <input type="text" placeholder="출발지" class="oSta_label form-control" readonly>
                                    <ul class="optionList">
                                        @forelse($data as $val)
                                            <li class="oSta_optionItem opItem">{{$val->port_name}}</li>
                                            @empty
                                            <li class="arr_optionItem opItem">데이터없음</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <input type="text" placeholder="도착지" class="oArr_label form-control" readonly>
                                    <ul class="optionList">
                                        @forelse($data as $val)
                                            <li class="oArr_optionItem opItem">{{$val->port_name}}</li>
                                            @empty
                                            <li class="arr_optionItem opItem">데이터없음</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <input type="text" id="txtDate1" class="form-control" name="datefilter" value="" />
                                </div>
                            </div>
                        </div>
                        <button type="submit"><a class="btn btn-primary btn-xl text-uppercase">항공편 검색</a></button>
                    </form>
                    </div>
                </div>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container sec2">
                <div class="notice">
                    {{-- 0613 add 이동호 --}}
                    <h2><a href="{{route('notice.index')}}">공지사항</a></h2>
                    <ul>
                        <li><a href="#"><span>공지1</span><span class="notice-date">2023.06.11</span></a></li>
                        <li><a href="#"><span>공지2</span><span class="notice-date">2023.06.12</span></a></li>
                        <li><a href="#"><span>공지3</span><span class="notice-date">2023.06.13</span></a></li>
                        <li><a href="#"><span>공지4</span><span class="notice-date">2023.06.13</span></a></li>
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