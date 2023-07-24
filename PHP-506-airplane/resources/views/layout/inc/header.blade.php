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
            <li class="nav-item justify-content-end" style="font-weight:600">
                <a class="nav-link" href="{{route('notice.baggage')}}">수하물 안내</a>
            </li>
            <li class="nav-item dropdown justify-content-end" style="font-weight:600">
             
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-right:60px">
                {{Auth::user()->u_name}}님
            </a>
            <ul class="dropdown-menu justify-content-end" style="font-weight:600">
                @if(Auth::user()->admin_flg === '1')
                  <li><a class="dropdown-item" href="{{route('admin.index')}}" style="color: red;">관리자 페이지</a></li>
                @endif
                {{-- <li><a class="dropdown-item" href="{{route('users.useredit')}}">회원정보 수정</a></li>
                <li><a class="dropdown-item" href="{{route('reservation.myreservation')}}">예약 조회</a></li> --}}
                <li><a class="dropdown-item" href="{{route('users.logout')}}">로그아웃</a></li>
            </ul>
            </li>
       @endauth
      </ul>
    </div>
  </div>
</nav>