@extends('layout.layout')

@section('title','Main')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    <div class="tabs">
                        <ul class="tabs-list">
                            <li class="on"><a href="#tab1">왕복</a></li>
                            <li><a href="#tab2">편도</a></li>
                        </ul>
                        <div id="tab1"class="tab on">
                            <div class="round-way">
                                <div class="selectBox2">
                                    <button class="label">출발지</button>
                                    <ul class="optionList">
                                    <li class="optionItem">원주</li>
                                    <li class="optionItem">군산</li>
                                    <li class="optionItem">광주</li>
                                    <li class="optionItem">여수</li>
                                    <li class="optionItem">사천</li>
                                    <li class="optionItem">울산</li>
                                    <li class="optionItem">포항경주</li>
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <button class="label">도착지</button>
                                    <ul class="optionList">
                                    <li class="optionItem">원주</li>
                                    <li class="optionItem">군산</li>
                                    <li class="optionItem">광주</li>
                                    <li class="optionItem">여수</li>
                                    <li class="optionItem">사천</li>
                                    <li class="optionItem">울산</li>
                                    <li class="optionItem">포항경주</li>
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <input type="text" id="txtDate" class="form-control" name="datefilter" value="" />
                                </div>
                                
                            </div>
                        </div>
                        <div id="tab2"class="tab">
                            <div class="round-way">
                                <div class="selectBox2">
                                    <button class="label">출발지</button>
                                    <ul class="optionList">
                                    <li class="optionItem">원주</li>
                                    <li class="optionItem">군산</li>
                                    <li class="optionItem">광주</li>
                                    <li class="optionItem">여수</li>
                                    <li class="optionItem">사천</li>
                                    <li class="optionItem">울산</li>
                                    <li class="optionItem">포항경주</li>
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <button class="label">도착지</button>
                                    <ul class="optionList">
                                    <li class="optionItem">원주</li>
                                    <li class="optionItem">군산</li>
                                    <li class="optionItem">광주</li>
                                    <li class="optionItem">여수</li>
                                    <li class="optionItem">사천</li>
                                    <li class="optionItem">울산</li>
                                    <li class="optionItem">포항경주</li>
                                    </ul>
                                </div>
                                <div class="selectBox2">
                                    <button class="label">출발날짜</button>
                                    <ul class="optionList">
                                    <li class="optionItem">원주</li>
                                    <li class="optionItem">군산</li>
                                    <li class="optionItem">광주</li>
                                    <li class="optionItem">여수</li>
                                    <li class="optionItem">사천</li>
                                    <li class="optionItem">울산</li>
                                    <li class="optionItem">포항경주</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">항공편 검색</a>
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