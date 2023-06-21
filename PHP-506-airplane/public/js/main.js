// 왕복
const ro_s_hd_no = document.querySelector('.ro_s_hd_no');
const ro_a_hd_no = document.querySelector('.ro_a_hd_no');
const sta_label = document.querySelector('.sta_label');
const arr_label = document.querySelector('.arr_label');
const sta_optionItem = document.querySelectorAll('.sta_optionItem');
const arr_optionItem = document.querySelectorAll('.arr_optionItem');
// 편도
const one_s_hd_no = document.querySelector('.one_s_hd_no');
const one_a_hd_no = document.querySelector('.one_a_hd_no');
const oSta_label = document.querySelector('.oSta_label');
const oArr_label = document.querySelector('.oArr_label');
const oSta_optionItem = document.querySelectorAll('.oSta_optionItem');
const oArr_optionItem = document.querySelectorAll('.oArr_optionItem');

const hd_li_no1 = document.querySelector('.hd_li_no1');
const hd_li_no2 = document.querySelector('.hd_li_no2');
const hd_li_flg = document.querySelector('.hd_li_flg');
// 항공편 검색 
const btn_submit = document.querySelector('.btn-submit');

btn_submit.addEventListener('click',function(event){
    // 왕복일때 유효성 검사
    if(hd_li_flg.value == '1') {
        if(sta_label.value == ''){
            alert('출발지를 입력하세요');
            event.preventDefault();
    
        }else if(arr_label.value ==''){
            alert('도착지를 입력하세요');
            event.preventDefault();
        }
        // 편도일때
    }else{
        if(oSta_label.value == ''){
            alert('출발지를 입력하세요');
            event.preventDefault();
    
        }else if(oArr_label.value ==''){
            alert('도착지를 입력하세요');
            event.preventDefault();
        }
    }
})
// 왕복/편도 flg
hd_li_no1.addEventListener('click', function(){
    hd_li_flg.value = '1';
});
hd_li_no2.addEventListener('click', function(){
    hd_li_flg.value = '0';
});




 // 클릭한 옵션의 텍스트를 라벨 안에 넣음
const handleSelect = function(item) {
    // 출발지
    sta_label.value = item.textContent;
    ro_s_hd_no.value = item.value;
    sta_label.parentNode.classList.remove('active');
}
 // 옵션 클릭시 클릭한 옵션을 넘김
sta_optionItem.forEach(function(option){
    option.addEventListener('click', function(){handleSelect(option)})
});
 // 클릭한 옵션의 텍스트를 라벨 안에 넣음
const handleSelect2 = function(item) {
    // 도착지
    arr_label.value = item.textContent;
    ro_a_hd_no.value = item.value;
    arr_label.parentNode.classList.remove('active');
}
 // 옵션 클릭시 클릭한 옵션을 넘김
arr_optionItem.forEach(function(option){
    option.addEventListener('click', function(){
        // 출발지 입력안할시 alert띄움
        if(sta_label.value == ''){
            alert('출발지를 입력하세요');
            arr_label.parentNode.classList.remove('active');
        }else{
            handleSelect2(option);
        }
    })
});

const handleSelect3 = function(item) {
    // 출발지
    oSta_label.value = item.textContent;
    one_s_hd_no.value = item.value;
    oSta_label.parentNode.classList.remove('active');
}
 // 옵션 클릭시 클릭한 옵션을 넘김
 oSta_optionItem.forEach(function(option){
    option.addEventListener('click', function(){handleSelect3(option)})
});
 // 클릭한 옵션의 텍스트를 라벨 안에 넣음
const handleSelect4 = function(item) {
    // 도착지
    oArr_label.value = item.textContent;
    one_a_hd_no.value = item.value;
    oArr_label.parentNode.classList.remove('active');
}
 // 옵션 클릭시 클릭한 옵션을 넘김
 oArr_optionItem.forEach(function(option){
    option.addEventListener('click', function(){handleSelect4(option)})
});

//  왕복
 // 라벨을 클릭시 출발지 옵션 목록이 열림/닫힘
sta_label.addEventListener('click', function(){
    sta_label.parentNode.classList.toggle('active');
});
 // 라벨을 클릭시 도착지 옵션 목록이 열림/닫힘
arr_label.addEventListener('click', function(){
    arr_label.parentNode.classList.toggle('active');
});
// 편도
 // 라벨을 클릭시 출발지 옵션 목록이 열림/닫힘
 oSta_label.addEventListener('click', function(){
    oSta_label.parentNode.classList.toggle('active');
});
 // 라벨을 클릭시 도착지 옵션 목록이 열림/닫힘
 oArr_label.addEventListener('click', function(){
    oArr_label.parentNode.classList.toggle('active');
});

// Tabs
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
     document.querySelectorAll(".tabs-list li, .tabs div.tab").forEach(function (item) {
             item.classList.remove("on");
         });
     document.querySelector(tabId).classList.add("on");
     this.classList.add("on");
 };
}
// 카카오맵 api
var container = document.getElementById('map');
    var options = {
        center : new kakao.maps.LatLng(36.2683, 127.6358), // 지도의 중심좌표 
        level : 14 // 지도의 확대 레벨 
    };
    
    var map = new kakao.maps.Map(container, options);
    map.setDraggable(false);  // 맵 이동 막기
    map.setZoomable(false); // 확대,축소 막기 

    // 마커를 표시할 위치와 title 객체 배열입니다 
    var positions = [
        {
            title: '원주공항',
            content:'<div class="marker">' +
            '  <a href="https://www.airport.co.kr/wonju/index.do" target="_blank">' +
            '    <span style="color:#2e2e2e; font-weight:bold; font-size:14px; position:absolute; top:-30px; left:-13px" class="title">원주</span>' +
            '  </a>' +
            '</div>'
            , 
            latlng: new kakao.maps.LatLng(37.459244, 127.977174)
        },
        {
            title: '군산공항',
            content:'<div class="marker">' +
            '  <a href="https://www.airport.co.kr/gunsan/index.do" target="_blank">' +
            '    <span style="color:#2e2e2e; font-weight:bold; font-size:14px; position:absolute; top:-30px; left:-13px" class="title">군산</span>' +
            '  </a>' +
            '</div>'
            ,  
            latlng: new kakao.maps.LatLng(35.926094, 126.615779)
        },
        {
            title: '광주공항',
            content:'<div class="marker">' +
            '  <a href="https://www.airport.co.kr/gwangju/index.do" target="_blank">' +
            '    <span style="color:#2e2e2e; font-weight:bold; font-size:14px; position:absolute; top:-30px; left:-13px" class="title">광주</span>' +
            '  </a>' +
            '</div>'
            ,  
            latlng: new kakao.maps.LatLng(35.139930, 126.811030)
        },
        {
            title: '여수공항',
            content:'<div class="marker">' +
            '  <a href="https://www.airport.co.kr/yeosu/index.do" target="_blank">' +
            '    <span style="color:#2e2e2e; font-weight:bold; font-size:14px; position:absolute; top:-30px; left:-13px" class="title">여수</span>' +
            '  </a>' +
            '</div>'
            ,
            latlng: new kakao.maps.LatLng(34.840328, 127.614111)
        },
        {
            title: '사천공항',
            content:'<div class="marker">' +
            '  <a href="https://www.airport.co.kr/sacheon/index.do" target="_blank">' +
            '    <span style="color:#2e2e2e; font-weight:bold; font-size:14px; position:absolute; top:-30px; left:-13px" class="title">사천</span>' +
            '  </a>' +
            '</div>'
            ,
            latlng: new kakao.maps.LatLng(35.089780, 128.070582)
        },
        {
            title: '울산공항',
            content:'<div class="marker">' +
            '  <a href="https://www.airport.co.kr/ulsan/index.do" target="_blank">' +
            '    <span style="color:#2e2e2e; font-weight:bold; font-size:14px; position:absolute; top:-30px; left:-13px" class="title">울산</span>' +
            '  </a>' +
            '</div>'
            ,
            latlng: new kakao.maps.LatLng(35.593570, 129.356540)
        },
        {
            title: '포항경주공항',
            content:'<div class="marker">' +
            '  <a href="https://www.airport.co.kr/pohang/index.do" target="_blank">' +
            '    <span style="color:#2e2e2e; font-weight:bold; font-size:14px; position:absolute; top:-30px; left:-23px" class="title">포항경주</span>' +
            '  </a>' +
            '</div>'
            ,
            latlng: new kakao.maps.LatLng(35.984811, 129.433999)
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
        // 커스텀 오버레이를 생성합니다
        var customOverlay = new kakao.maps.CustomOverlay({
            position : marker.getPosition(),
            content: positions[i].content
        });
        
        // 커스텀 오버레이를 지도에 표시합니다
        customOverlay.setMap(map);
    }
    
// 달력
      $("#txtDate").daterangepicker({
        locale: {
        "separator": " ~ ",                     // 시작일시와 종료일시 구분자
        "format": 'YYYY-MM-DD',     // 일시 노출 포맷
        "applyLabel": "확인",                    // 확인 버튼 텍스트
        "cancelLabel": "취소",                   // 취소 버튼 텍스트
        "daysOfWeek": ["일", "월", "화", "수", "목", "금", "토"],
        "monthNames": ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"]
        },
        showDropdowns: true,                     // 년월 수동 설정 여부
        autoApply: true,                         // 확인/취소 버튼 사용여부
        // singleDatePicker: true                   // 하나의 달력 사용 여부
    });

    $("#txtDate1").daterangepicker({
        locale: {
        "separator": " ~ ",                     // 시작일시와 종료일시 구분자
        "format": 'YYYY-MM-DD',     // 일시 노출 포맷
        "applyLabel": "확인",                    // 확인 버튼 텍스트
        "cancelLabel": "취소",                   // 취소 버튼 텍스트
        "daysOfWeek": ["일", "월", "화", "수", "목", "금", "토"],
        "monthNames": ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"]
        },
        showDropdowns: true,                     // 년월 수동 설정 여부
        autoApply: true,                         // 확인/취소 버튼 사용여부
        singleDatePicker: true                   // 하나의 달력 사용 여부
    });


// v004 add 이동호 스와이퍼
let swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    autoplay: {
        delay: 3000, // 3초 딜레이
    },
    navigation: {
        prevEl: '.swiper-button-prev', // 이전 슬라이드 버튼
        nextEl: '.swiper-button-next', // 다음 슬라이드 버튼
    },
});

// 다음 슬라이드 버튼 클릭 시 슬라이드 1로 이동
function goToNextSlide() {
    if (swiper.activeIndex < swiper.slides.length - 1) {
        swiper.slideNext();
    } else {
        swiper.slideTo(0);
    }
}