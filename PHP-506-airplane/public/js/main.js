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
const btn_submit2 = document.querySelector('.btn-submit2');

// 왕복/편도 flg
hd_li_no1.addEventListener('click', function(){
    hd_li_flg.value = '1';
});
hd_li_no2.addEventListener('click', function(){
    hd_li_flg.value = '0';
});

btn_submit.addEventListener('click',function(event){
    // 왕복일때 유효성 검사
    if(hd_li_flg.value == 1) {
        if(sta_label.value == ''){
            alert('출발지를 입력하세요');
            event.preventDefault();
    
        }else if(arr_label.value ==''){
            alert('도착지를 입력하세요');
            event.preventDefault();
        }else if (sta_label.value == arr_label.value) {
            alert('출발지와 도착지는 같을 수 없습니다.');
            event.preventDefault();
        }
    }
});
btn_submit2.addEventListener('click',function(event){
    // 편도일때
    if(hd_li_flg.value == 0){
        if(oSta_label.value == ''){
            alert('출발지를 입력하세요');
            event.preventDefault();
        }else if(oArr_label.value ==''){
            alert('도착지를 입력하세요');
            event.preventDefault();
        }else if (oSta_label.value == oArr_label.value) {
            alert('출발지와 도착지는 같을 수 없습니다.');
            event.preventDefault();
        }
    }
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
    option.addEventListener('click', function(){
        if(oSta_label.value == ''){
            alert('출발지를 입력하세요');
            oArr_label.parentNode.classList.remove('active');
        }else{
            handleSelect4(option);
        }
    })
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
        center : new kakao.maps.LatLng(36.0683, 127.6358), // 지도의 중심좌표 
        level : 20 // 지도의 확대 레벨 
    };
    
    var map = new kakao.maps.Map(container, options);
    map.setZoomable(false); // 확대,축소 막기 

    // 마커를 표시할 위치와 title 객체 배열입니다 
    var positions = [
        {
            title: '원주공항',
            content:'<div>원주공항(WJU)</div>',
            latlng: new kakao.maps.LatLng(37.459244, 127.977174)
        },
        {
            title: '군산공항',
            content:'<div>군산공항(KUV)</div>',  
            latlng: new kakao.maps.LatLng(35.926094, 126.615779)
        },
        {
            title: '광주공항',
            content:'<div>광주공항(KWJ)</div>',  
            latlng: new kakao.maps.LatLng(35.139930, 126.811030)
        },
        {
            title: '여수공항',
            content:'<div>여수공항(RSU)</div>',
            latlng: new kakao.maps.LatLng(34.840328, 127.614111)
        },
        {
            title: '사천공항',
            content:'<div>사천공항(HIN)</div>',
            latlng: new kakao.maps.LatLng(35.089780, 128.070582)
        },
        {
            title: '울산공항',
            content:'<div>울산공항(USN)</div>',
            latlng: new kakao.maps.LatLng(35.593570, 129.356540)
        },
        {
            title: '포항경주공항',
            content:'<div>포항경주공항(KPO)</div>',
            latlng: new kakao.maps.LatLng(35.984811, 129.433999)
        },
        {
            title: '김포공항',
            content:'<div>김포공항(GMP)</div>',
            latlng: new kakao.maps.LatLng(37.559879, 126.794989)
        },
        {
            title: '김해공항',
            content:'<div>김해공항(PUS)</div>',
            latlng: new kakao.maps.LatLng(35.172231, 128.948275)
        },
        {
            title: '대구공항',
            content:'<div>대구공항(TAE)</div>',
            latlng: new kakao.maps.LatLng(35.900114, 128.637707)
        },
        {
            title: '무안공항',
            content:'<div>무안공항(MWX)</div>',
            latlng: new kakao.maps.LatLng(34.993586, 126.387866)
        },
        {
            title: '양양공항',
            content:'<div>양양공항(YNY)</div>',
            latlng: new kakao.maps.LatLng(38.058846, 128.662988)
        },
        {
            title: '제주공항',
            content:'<div>제주공항(CJU)</div>',
            latlng: new kakao.maps.LatLng(33.510583, 126.491386)
        },
        {
            title: '청주공항',
            content:'<div>청주공항(CJJ)</div>',
            latlng: new kakao.maps.LatLng(36.721997, 127.495877)
        }
    ];


    // 마커 이미지의 이미지 주소입니다
    
    for (var i = 0; i < positions.length; i ++) {

        var imageSrc = "../img/icon-airport.png"; 
    
        if (i >= 0 && i <= 6) {
            imageSrc = "../img/icon-airport2.png";
        }

        // 마커 이미지의 이미지 크기 입니다
        var imageSize = new kakao.maps.Size(32, 32); 
        
        // 마커 이미지를 생성합니다    
        var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);
        
        // 마커를 생성합니다
        var marker = new kakao.maps.Marker({
            map: map, // 마커를 표시할 지도
            position: positions[i].latlng, // 마커를 표시할 위치
            title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
            image : markerImage // 마커 이미지
        });

        var infowindow = new kakao.maps.InfoWindow({
            content : positions[i].content
        });
        
        // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
        // 이벤트 리스너로는 클로저를 만들어 등록합니다 
        // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
        kakao.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
        kakao.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
    }
    
    // 인포윈도우를 표시하는 클로저를 만드는 함수입니다 
    function makeOverListener(map, marker, infowindow) {
        return function() {
            infowindow.open(map, marker);
        };
    }

    // 인포윈도우를 닫는 클로저를 만드는 함수입니다 
    function makeOutListener(infowindow) {
        return function() {
            infowindow.close();
        };
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
        autoApply: true,
        minDate: moment().startOf('day')            // 현재날 이전 날짜 막기
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
        minDate: moment().startOf('day'),            // 현재날 이전 날짜 막기
        singleDatePicker: true                   // 하나의 달력 사용 여부
    });


// v004 add 이동호 스와이퍼
let swiper = new Swiper('.swiper-container', {
    spaceBetween: 1,
    loop : true, // 슬라이드 반복 여부
    loopAdditionalSlides : 2,
    allowTouchMove : false, // false시에 스와이핑이 되지 않으며 버튼으로만 슬라이드 조작이 가능
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        type: 'bullets'
    },
    autoplay: {
        delay: 3000, // 3초 딜레이
        disableOnInteraction : false, // 스와이프 후 자동 재생이 비활성화 되지 않게
    },
    navigation: {
        prevEl: '.swiper-btn-prev', // 이전 슬라이드 버튼
        nextEl: '.swiper-btn-next', // 다음 슬라이드 버튼
    },
    breakpoints: { //반응형 조건 속성
        300: {
            slidesPerView: 1,
        },
        530: {
            slidesPerView: 2,
        },
        630: {
            slidesPerView: 3,
        },
        850: {
            slidesPerView: 4,
        },
    },
    observer: true,
    observeParents: true,
});

function changeCount(target,v){
    var countElement = document.getElementById(target);
    var currentCount = parseInt(countElement.value);
    var newCount = currentCount + v;
    countElement.value = newCount;

   // 선택된 인원 업데이트
   var selectedPassengerElement = document.querySelector('.selected_passenger');
   var passengerSpans = selectedPassengerElement.querySelectorAll('span');
   const ADULT = document.querySelector('.ADULT');
   const CHILD = document.querySelector('.CHILD');
   const BABY = document.querySelector('.BABY');
   for (var i = 0; i < passengerSpans.length; i++) {
     if (passengerSpans[i].classList.contains(target)) {
        if(target == 'ADULT'){
            target = '성인'
            passengerSpans[i].textContent = target + newCount;
            ADULT.value = newCount;
        }else if(target == 'CHILD'){
            target = '유아'
            passengerSpans[i].textContent = target + newCount;
            CHILD.value = newCount;
        }else{
            target = '소아'
            passengerSpans[i].textContent = target + newCount;
            BABY.value = newCount;
        }
       break;
     }
   }

}

const selected_passenger = document.querySelector('.selected_passenger');
const layerP = document.querySelector('.layer_passenger');
// 라벨을 클릭시 출발지 옵션 목록이 열림/닫힘
selected_passenger.addEventListener('click', function(){
    layerP.classList.toggle('on');
});