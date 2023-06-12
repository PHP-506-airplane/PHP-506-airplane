<nav class="navbar navbar-expand-lg navbar-dark fixed-top navHeader" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{asset('img/logo.png')}}" alt="logo" class="imgLogo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a href="#services">예약</a></li>
                <li class="nav-item"><a href="#portfolio">서비스</a></li>
                <li class="nav-item"><a href="#about">About</a></li>
                <li class="nav-item"><a href="{{route('users.login')}}">로그인</a></li>
                <li class="nav-item"><a href="{{route('users.registration')}}">회원가입</a></li>
            </ul>
        </div>
    </div>
</nav>