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
    <link rel="stylesheet" href="{{asset('css/modal.css')}}">
@endsection

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
                <li class="nav-item">
                @guest
                    <a href="{{route('users.login')}}">로그인</a>
                    <a href="{{route('users.registration')}}">회원가입</a>
                @endguest

                @auth
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{Auth::user()->u_name}}
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">마이페이지</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"><a href="{{route('users.useredit')}}">정보수정</a></button>
                        <button type="button" class="btn btn-primary"><a href="{{route('reservation.myreservation')}}">예약조회</a></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">X</button>
                        
                    </div>
                    </div>
                </div>
                </div>

                <a href="{{route('users.logout')}}">로그아웃</a>
                @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>



@section('js')
    <script src="{{asset('js/modal.js')}}"></script>
@endsection