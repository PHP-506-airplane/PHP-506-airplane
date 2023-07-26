{{--
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : myreservation.blade.php
 * 이력         :   v001 0620 이동호 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '나의 예약')

@section('css')
<link rel="stylesheet" href="{{asset('css/myreservation.css')}}">
<link rel="stylesheet" href="{{asset('css/login.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/useredit.css')}}"> --}}
{{-- <link rel="stylesheet" href="{{asset('css/chgpw.css')}}"> --}}
@endsection

@section('contents')
<div class="divContentsMain">
    <div class="myreservationHeader">
        <h1 class="noticeH1">마이페이지</h1>
        <h5 class="noticeH5">예약하신 내역을 알려드립니다.</h5>
    </div>
    {{-- 전체 컨테이너 --}}
<div class="container">
    <div class="tabArea">
        <ul class="tabTypeA">
            <li class="tabA choice">
                <a href="#myreserve" onclick="showTab('myreserve_tab', 'myreserve_content'); return false" id="myreserve_tab">
                    예약조회
                </a>
            </li>
            <li class="tabA">
                <a href="#useredit" onclick="showTab('useredit_tab', 'useredit_content'); return false" id="useredit_tab">
                    회원정보수정
                </a>
            </li>
            <li class="tabA">
                <a href="#chgpw" onclick="showTab('chgpw_tab', 'chgpw_content'); return false" id="chgpw_tab">
                    비밀번호 변경
                </a>
            </li>
        </ul>
    </div>
    {{-- 예약조회 --}}
    <div id="myreserve_content" class="tabContent activeTab">
        @if($data->isEmpty())
            <div class="reserveNone">
                <span class="noneSpan">예약 정보가 없습니다.</span>
                <br>
                <br>
                <button type="button" onclick="location.href='{{route('reservation.main')}}'" class="btn btn-outline-info">예약하기</button>
            </div>
        @endif
        <div class="passContainer">
        @foreach($data as $key => $val)
            <div class="boarding-pass">
                <header>
                    <div class="flight">
                        <strong>{{$val['line_name']}}</strong>
                    </div>
                </header>
                <section class="cities">
                    <div class="city">
                        <small>{{str_replace('공항', '' , $val['dep_port_name'])}}</small>
                        <strong>{{strtoupper($val['dep_port_eng'])}}</strong>
                    </div>
                    <div class="city">
                        <small>{{str_replace('공항', '' , $val['arr_port_name'])}}</small>
                        <strong>{{strtoupper($val['arr_port_eng'])}}</strong>
                    </div>
                    <svg class="airplane">
                        <use xlink:href="#airplane"></use>
                    </svg>
                </section>
                <section class="infos">
                    <div class="places">
                        <div class="box">
                            <small>Linecode</small>
                            <strong><em>{{$val['line_code']}}</em></strong>
                        </div>
                        <div class="box">
                            <small>airplane</small>
                            <strong><em>{{$val['plane_name']}}</em></strong>
                        </div>
                        <div class="box">
                            <small>Seat</small>
                            <strong>{{$val['seat_no']}}</strong>
                        </div>
                        <div class="box">
                            <small>Flight</small>
                            <strong>{{$val['flight_num']}}</strong>
                        </div>
                    </div>
                    <div class="times">
                        <div class="box">
                            <small>Date</small>
                            <strong>{{substr($val['fly_date'], 5)}}</strong>
                        </div>
                        <div class="box">
                            <small>Departure</small>
                            <strong>{{substr($val['dep_time'], 0, 2) . ':' . substr($val['dep_time'], 2)}}</strong>
                        </div>
                        <div class="box">
                            <small>Duration</small>
                            <strong>{{TimeCalculation($val['dep_time'], $val['arr_time'])}}</strong>
                        </div>
                        <div class="box">
                            <small>Arrival</small>
                            <strong>{{substr($val['arr_time'], 0, 2) . ':' . substr($val['arr_time'], 2)}}</strong>
                        </div>
                    </div>
                </section>
                <section class="strap">
                    <div class="box">
                        <div class="passenger">
                            <small>passenger</small>
                            <strong>{{$val['p_name']!=null ? $val['p_name'] : $val['u_name']}}</strong>
                        </div>
                        <form action="{{route('reservation.rescancle')}}" method="POST" id="formCancel">
                            @csrf
                            <input type="hidden" name="reserve_no" value="{{$val['reserve_no']}}">
                            <input type="hidden" name="t_no" value="{{$val['t_no']}}">
                            <input type="hidden" class="merchant_uid" name="merchant_uid" value="{{$val['merchant_uid']}}">
                            <input type="hidden" class="id" name="id" value="{{$val['id']}}">
                            <input type="hidden" class="price" name="price" value="{{$val['price']}}">
                            <button type="button" onclick="cancelClick(event)" class="btn btn-outline-success" style="width: auto">예약 취소</button>
                        </form>
                    </div>
                    <img src="{{asset('img/qr.png')}}" alt="QR code" class="imgQr">
                </section>
            </div>
        @endforeach
    </div>

        <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" display="none">
            <symbol id="airplane" viewBox="243.5 245.183 25 21.633">
                <g>
                    <path fill="#30af2f" d="M251.966,266.816h1.242l6.11-8.784l5.711,0.2c2.995-0.102,3.472-2.027,3.472-2.308
                                            c0-0.281-0.63-2.184-3.472-2.157l-5.711,0.2l-6.11-8.785h-1.242l1.67,8.983l-6.535,0.229l-2.281-3.28h-0.561v3.566
                                            c-0.437,0.257-0.738,0.724-0.757,1.266c-0.02,0.583,0.288,1.101,0.757,1.376v3.563h0.561l2.281-3.279l6.535,0.229L251.966,266.816z
                                            " />
                </g>
            </symbol>
        </svg>
    </div>

    {{-- //예약조회 --}}
    {{-- 회원정보수정  --}}
    <div id="useredit_content" class="tabContent"> 
        <div id="con">
            <div id="login">
                <div id="login_form">
                <form action="{{route('users.useredit.post',['users' => $user->id])}}" method="post" id="edit">
                @csrf
                @method('put')
                    <h3 class="login" style="letter-spacing:-1px;">회원정보 수정</h3>
                    <hr>
                    <label>
                    <p style="text-align: left; font-size:12px; color:#666">이름</p>
                    <input type="text" name="u_name" id="u_name" value="{{count($errors) > 0 ? old('u_name') : $user->u_name}}" placeholder="">
                    <p></p>
                    </label>
                    <br>
                    <label>
                    <p style="text-align: left; font-size:12px; color:#666">이메일</p>
                    <input type="text" name="u_email" id="u_email" value="{{$user->u_email}}" disabled placeholder="">
                    <p></p>
                    </label>
                    <br>
                     @if ($errors->any())
                        <div class="error">
                            @foreach ($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        </div>
                     @endif
                    <div style="height:30px"></div>
                    <p>
                        <input type="button" value="수정" class="btn" id="editBtn">
                    </p>
                    <div class="login_etc">
                        <div class="space"></div>
                        <div class="forgot_pw">
                            <a href="{{route('reservation.main')}}">취소</a>
                        </div>
                        <span>|</span>
                        <div class="forgot_pw" id="divWithdraw">
                            <a  onclick="test()" id="withdraw">회원탈퇴</a>
                        </div> 
                    </div>
                </form>
                </div>
        </div>
    </div> 
</div>
    {{-- //회원정보수정  --}}
    {{-- 비밀번호 변경  --}}
    <div id="chgpw_content" class="tabContent"> 
        <div id="con">
            <div id="login">
                <div id="login_form">
                <form action="{{route('users.chgpw.post')}}" method="post">
                @csrf 
                @method('put')
                    <h3 class="login" style="letter-spacing:-1px;">비밀번호 변경</h3>
                    <hr>
                    <label>
                    <p style="text-align: left; font-size:12px; color:#666">현재 비밀번호</p>
                    <input type="password" placeholder="현재 비밀번호를 입력하세요" class="size" name="nowpassword" id="nowpassword">
                    <p></p>
                    </label>
                    <br>
                    <label>
                    <p style="text-align: left; font-size:12px; color:#666">비밀번호</p>
                    <input type="password" placeholder="비밀번호를 입력하세요" class="size" name="password" id="password" oninput="chkPw()">
                    <div class="space1"></div>
                    </label>
                    <br>
                    <p style="text-align: left; font-size:12px; color:#666">비밀번호 확인</p>
                    <input type="password" placeholder="비밀번호 확인을 입력하세요" class="size" name="passwordchk" id="pwchk" oninput="chkPw()">
                    <div id="chk_pw_msg"></div>
                    </label>
                    <div style="height:30px"></div>
                    <p>
                        <input type="submit" value="변경" class="btn">
                    </p>
                </form>
                <hr>
                <p class="find">
                    {{-- <span><a href="{{route('users.registration')}}">회원가입</a></span> --}}
                    <span><a href="{{route('reservation.main')}}">취소</a></span>
                </p>
                </div>
        </div>
    </div> 
</div>
    {{-- //비밀번호 변경  --}}
</div>
{{-- 전체 컨테이너 --}}

@endsection

@section('js')
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script> --}}
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="{{asset('js/myreservation.js')}}"></script>
<script src="{{asset('js/chkpw.js')}}"></script>
<script>
const withdraw = document.getElementById('withdraw');
function test() {
    var con_test = confirm("정말 탈퇴 하시겠습니까?");
    if(con_test == true){
    location.href="{{ route('users.withdraw')}}";
}
}

// 0627이동호 쓰로틀링 ----------------------------------------------------------
const editForm = document.getElementById('edit');
const btn = document.getElementById('editBtn');

throttle(btn, edit);
// /0627이동호 쓰로틀링 ----------------------------------------------------------
</script>
@endsection
