<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Agency - Start Bootstrap Theme</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Styles -->
        <style>
        </style>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
        <link href="{{asset('css/main.css')}}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="assets/img/navbar-logo.svg" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">예약</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">서비스</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    </ul>
                    @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
                </div>
            </div>
        </nav>
        <!-- Masthead-->
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
                                <div class="selectBox2">
                                    <button class="label">도착날짜</button>
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
                    <h2>공지사항</h2>
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
                    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=ec157c40a3e8affeb7c7cd7bc375b9fc"></script>
                    <script>
                        var container = document.getElementById('map');
                        var options = {
                            center : new kakao.maps.LatLng(36.2683, 127.6358), // 지도의 중심좌표 
                            level : 14 // 지도의 확대 레벨 
                        };

                        var map = new kakao.maps.Map(container, options);
                        // 마커를 표시할 위치와 title 객체 배열입니다 
                        var positions = [
                            {
                                title: '원주공항', 
                                latlng: new kakao.maps.LatLng(37.459244, 127.977174)
                            },
                            {
                                title: '군산공항', 
                                latlng: new kakao.maps.LatLng(35.926094, 126.615779)
                            },
                            {
                                title: '광주공항', 
                                latlng: new kakao.maps.LatLng(35.139930, 126.811030)
                            },
                            {
                                title: '근린공원',
                                latlng: new kakao.maps.LatLng(34.840328, 127.614111)
                            }
                        ];

                        // 마커 이미지의 이미지 주소입니다
                        var imageSrc = "https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png"; 
                            
                        for (var i = 0; i < positions.length; i ++) {
                            
                            // 마커 이미지의 이미지 크기 입니다
                            var imageSize = new kakao.maps.Size(24, 35); 
                            
                            // 마커 이미지를 생성합니다    
                            var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize); 
                            
                            // 마커를 생성합니다
                            var marker = new kakao.maps.Marker({
                                map: map, // 마커를 표시할 지도
                                position: positions[i].latlng, // 마커를 표시할 위치
                                title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
                                image : markerImage // 마커 이미지 
                            });
                        }
                    </script>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2023</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    /* 일반함수 */
    const label = document.querySelector('.label');
    const optionItem = document.querySelectorAll('.optionItem');
    // 클릭한 옵션의 텍스트를 라벨 안에 넣음
    const handleSelect = function(item) {
        label.innerHTML = item.textContent;
        label.parentNode.classList.remove('active');
    }
    // 옵션 클릭시 클릭한 옵션을 넘김
    optionItem.forEach(function(option){
    option.addEventListener('click', function(){handleSelect(option)})
    })
    // 라벨을 클릭시 옵션 목록이 열림/닫힘
    label.addEventListener('click', function(){
    if(label.parentNode.classList.contains('active')) {
        label.parentNode.classList.remove('active');
    } else {
        label.parentNode.classList.add('active');
    }
    });

// 3) Tabs
var links = document.querySelectorAll(".tabs-list li a");
var items = document.querySelectorAll(".tabs-list li");
for (var i = 0; i < links.length; i++) {
    links[i].onclick = function (e) {
        e.preventDefault();
    };
}
for (var i = 0; i < items.length; i++) {
    items[i].onclick = function () {
        var tabId = this.querySelector("a").getAttribute("href");
        console.log(this.classList);
        document.querySelectorAll(".tabs-list li, .tabs div.tab").forEach(function (item) {
                item.classList.remove("on");
            });
        document.querySelector(tabId).classList.add("on");
        this.classList.add("on");
    };
}

</script>
        <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
