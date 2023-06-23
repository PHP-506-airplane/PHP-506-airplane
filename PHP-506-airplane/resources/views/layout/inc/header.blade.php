{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views/layout/inc
 * 파일명       : header.blade.php
 * 이력         :   v001 0612 오재훈 new
                    v002 0614 박수연 add 로그인
**************************************************/
--}}

<ul class="nav nav-pills justify-content-center">
    <a class="navbar-brand" href="{{route('reservation.main')}}"><img width="150px" height="50px" class="air" src="{{asset('img/air.png')}}" alt="logo"></a>
        <div style="width:950px">
        </div>
        <li class="nav-item">
            <a class="nav-link p-3 mb-2 bg-body text-dark" href="{{route('notice.rateinfoget')}}">운임 안내</a>
        </li>
    @guest
        <li class="nav-item">
            <a class="nav-link active p-3 mb-2 bg-body text-dark" aria-current="page" href="{{route('users.login')}}">로그인</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active p-3 mb-2 bg-body text-dark" aria-current="page" href="{{route('users.registration')}}">회원가입</a>
        </li>
        
    @endguest

    @auth
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle p-3 mb-2 bg-body text-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{Auth::user()->u_name}}님</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('users.useredit')}}">회원정보 수정</a></li>
                <li><a class="dropdown-item" href="{{route('reservation.myreservation')}}">예약 조회</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link active p-3 mb-2 bg-body text-dark" aria-current="page" href="{{route('users.logout')}}">로그아웃</a>
        </li>

    @endauth 
</ul>


{{-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top navHeader" id="mainNav">
    <div class="container">
        {{-- <a class="navbar-brand" href="{{route('reservation.main')}}"><img src="{{asset('img/logo.png')}}" alt="logo" class="imgLogo"></a> --}}
        {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <li class="fas fa-bars ms-1"></li>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <div class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <button class="nav-item"><a href="#about">수하물 안내</a></button>
                <button class="nav-item">
                @guest
                    <a href="{{route('users.login')}}">로그인</a>
                    <a href="{{route('users.registration')}}">회원가입</a>
                @endguest

                @auth
                    <button class="nav-item">
                        <a href="">{{Auth::user()->u_name}}님</a>
                    </button>
                    <button class="nav-item">
                        <div class="dropdown">
                            <button onclick="dp_menu()" class="button">마이페이지</button>
                            <div id="drop-content">
                                <a hreaf='{{route('users.useredit')}}'>정보수정</a>
                                <a hreaf='{{route('reservation.myreservation')}}'>예약조회</a>
                            </div>
                        </div>
                    </button>
                    <button class="nav-item">
                        <a href="{{route('users.logout')}}">로그아웃</a>
                    </button>
                @endauth
                </button>
            </div>
        </div>
    </div>
</nav>  --}}