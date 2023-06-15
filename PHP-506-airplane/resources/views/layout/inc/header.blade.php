{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views/layout/inc
 * 파일명       : header.blade.php
 * 이력         :   v001 0612 오재훈 new
                    v002 0614 박수연 add 로그인
**************************************************/
--}}
<nav class="navbar navbar-expand-lg navbar-dark fixed-top navHeader" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{route('reservation.main')}}"><img src="{{asset('img/logo.png')}}" alt="logo" class="imgLogo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a href="#services">예약</a></li>
                <li class="nav-item"><a href="#portfolio">서비스</a></li>
                <li class="nav-item"><a href="#about">About</a></li>
                {{-- 로그인 안했을 때 로그인, 회원가입 뜨고 로그인 했을 때 사용자 이름, 로그아웃 나타나게 --}}
                <li class="nav-item">
                @guest
                    <a href="{{route('users.login')}}">로그인</a>
                    <a href="{{route('users.registration')}}">회원가입</a>
                @endguest

                @auth
                    {{-- 로그인됐을 때 사용자 이름 표시 되고 이름 누르면 회원정보 수정으로  --}}
                    <a href="{{route('users.useredit')}}">{{Auth::user()->u_name}}</a>
                    <a href="{{route('users.logout')}}">로그아웃</a>
                @endauth
                </li>
                
            </ul>
        </div>
    </div>
</nav>