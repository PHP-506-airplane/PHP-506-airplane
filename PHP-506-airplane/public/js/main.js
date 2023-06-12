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
                                title: '여수공항',
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