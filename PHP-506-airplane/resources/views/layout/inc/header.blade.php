{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views/layout/inc
 * 파일명       : header.blade.php
 * 이력         :   v001 0612 오재훈 new
                    v002 0614 박수연 add 로그인
**************************************************/
--}}
@section('css') 
    <link rel="stylesheet" href="{{asset('css/dropdown.css')}}">
@endsection

<div class="space">
</div>
<ul class="nav nav-pills">
{{-- <a class="navbar-brand" href="{{route('reservation.main')}}"><img src="{{asset('img/logo.png')}}" alt="logo" class="imgLogo"></a> --}}
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Dropdown</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Action</a></li>
      <li><a class="dropdown-item" href="#">Another action</a></li>
      <li><a class="dropdown-item" href="#">Something else here</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Separated link</a></li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
</ul>


{{-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top navHeader" id="mainNav">
    <div class="container">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
</nav> --}}

@section('js')
    <script src="{{asset('js/dropdown.js')}}"></script>
@endsection