{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views/layout/inc
 * 파일명       : header.blade.php
 * 이력         :   v001 0612 오재훈 new
                    v002 0614 박수연 add 로그인
**************************************************/
--}}

{{-- <ul class="nav nav-pills justify-content-center">
    <a class="navbar-brand" href="{{route('reservation.main')}}"><img width="150px" height="50px" class="air" src="{{asset('img/air.png')}}" alt="logo"></a>
        <div style="width:950px">
        </div>
        <li class="nav-item">
            <a class="nav-link p-3 mb-2 bg-body text-dark" href="{{route('notice.baggage')}}">수하물 안내</a>
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
</ul> --}}

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <div style="width:70px"></div>
    <a class="navbar-brand" href="{{route('reservation.main')}}"><img width="180px" height="40px" class="air" src="{{asset('img/logoplz.png')}}" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item" style="font-weight:600">
          <a class="nav-link active" aria-current="page" href="{{route('reservation.main')}}">Home</a>
        </li>
        @guest
             <li class="nav-item justify-content-end" style="font-weight:600">
            <a class="nav-link" href="{{route('notice.baggage')}}">수하물 안내</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('users.login')}}">로그인</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('users.registration')}}">회원가입</a>
            </li>
        @endguest
       
       @auth
            <li class="nav-item justify-content-end" style="font-weight:600">
                <a class="nav-link" href="{{route('notice.baggage')}}">수하물 안내</a>
            </li>
            <li class="nav-item dropdown justify-content-end" style="font-weight:600">
             
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{Auth::user()->u_name}}님
            </a>
            <ul class="dropdown-menu justify-content-end" style="font-weight:600">
                <li><a class="dropdown-item" href="{{route('users.useredit')}}">회원정보 수정</a></li>
                <li><a class="dropdown-item" href="{{route('reservation.myreservation')}}">예약 조회</a></li>
                <li><a class="dropdown-item" href="{{route('users.logout')}}">로그아웃</a></li>
            </ul>
            </li>
       @endauth
      </ul>
    </div>
  </div>
</nav>

{{-- @section('css') 
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
@endsection --}}

 {{-- <nav class="navbar">
        <div class="navbar__logo">
            <i class="fab fa-apple"></i>
            <a href="{{route('reservation.main')}}"><img width="150px" height="50px" class="air" src="{{asset('img/air.png')}}" alt="logo"></a>
        </div>
        @guest
            <ul class="navbar__menu">
                <li><a href="{{route('notice.baggage')}}">수하물 안내</a></li>
                <li><a href="{{route('users.login')}}">로그인</a></li>
                <li><a href="{{route('users.registration')}}">회원가입</a></li>
            </ul>
        @endguest
               
        @auth
            <ul class="navbar__menu">
                <li>{{Auth::user()->u_name}}님</li>
                <li><a href="{{route('users.login')}}">로그인</a></li>
                <li><a href="{{route('users.registration')}}">회원가입</a></li>
            </ul>
        @endauth
        <a href="#" class="navbar__toggleBtn"><i class="fas fa-bars"></i></a>
    </nav>

@section('js')
    <script src="{{asset('js/header.js')}}"></script>
@endsection --}}