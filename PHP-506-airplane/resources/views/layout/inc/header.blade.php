{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views/layout/inc
 * 파일명       : header.blade.php
 * 이력         :   v001 0612 오재훈 new
                    v002 0614 박수연 add 로그인
**************************************************/
--}}

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <div style="width:70px"></div>
    <a class="navbar-brand" href="{{route('reservation.main')}}"><img style="width:110px; height:50px;" class="air" src="{{asset('img/logom.png')}}" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
       <li class="nav-item" style="font-weight:600">
          <a class="nav-link active" aria-current="page" href="{{route('reservation.myreservation')}}">마이페이지</a>
        </li>
        <span class="stick">|</span>
        @guest
             <li class="nav-item justify-content-end" style="font-weight:600">
            <a class="nav-link" href="{{route('notice.baggage')}}">수하물 안내</a>
            </li>
            <li class="nav-item" style="font-weight:600">
            <a class="nav-link" href="{{route('users.login')}}">로그인</a>
            </li>
            <li class="nav-item" style="font-weight:600">
            <a class="nav-link" href="{{route('users.registration')}}">회원가입</a>
            </li>
        @endguest
       
       @auth
            <li class="nav-item justify-content-end uesrMile" style="font-weight:600;">
                {{-- <a class="nav-link" href="{{route('notice.baggage')}}">수하물 안내</a> --}}
                <div>내 마일리지 : {{number_format(session('mileage'))}}</div>
            </li>
            <span class="stick">|</span>
            <li class="nav-item justify-content-end uesrMile" style="font-weight:600;">
              <a class="nav-item" href="#" role="button" aria-expanded="false" style="color:#000;">
                {{Auth::user()->u_name}}님
              </a>
            </li>
            <span class="stick">|</span>
            <li class="nav-item justify-content-end uesrMile" style="font-weight:600;">
              <a class="nav-item" href="{{route('users.logout')}}" style="color:#000;">로그아웃</a>
            </li>
       @endauth
      </ul>
    </div>
  </div>
</nav>