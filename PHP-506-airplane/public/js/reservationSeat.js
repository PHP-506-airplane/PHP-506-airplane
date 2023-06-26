let seats = document.querySelectorAll('.fast a');
let seats2 = document.querySelectorAll('.fast2 a');
let s_name = document.querySelector('.show_name');
let s_name2 = document.querySelector('.show_name2');
let choice = document.querySelector('.tab');

// 가는편 좌석 선택
seats.forEach(function(seat){
    seat.addEventListener('click', function(){
        seats.forEach(function(seat){
            seat.classList.remove('selected');
        });
        seat.classList.toggle('selected');
        s_name.value = seat.querySelector('#s_name').value;
    });
});

// 오는편 좌석 선택
seats2.forEach(function(seat){
    seat.addEventListener('click', function(){
        seats2.forEach(function(seat){
            seat.classList.remove('selected');
        });
        seat.classList.toggle('selected');
        s_name2.value = seat.querySelector('#s_name2').value;
    });
});

// 가는편/오는편 탭
function changeTab(tabId) {
    var tabId1 = document.getElementById('aFlight1');
    var tabId2 = document.getElementById('aFlight2');
    var map = document.getElementsByClassName('map');

    if(tabId == 'aFlight1'){
        tabId1.parentElement.classList.add('choice');
        tabId2.parentElement.classList.remove('choice');
        map[0].classList.add('active');
        map[1].classList.remove('active');
    }else{
        tabId2.parentElement.classList.add('choice');
        tabId1.parentElement.classList.remove('choice');
        map[1].classList.add('active');
        map[0].classList.remove('active');
    }
            
}
// 예약확정 confirm
const seatForm = document.getElementById('seatPost');
function reserveBtn(){
    var con_test = confirm("정말 예약 하시겠습니까?");
    if(con_test == true){
        seatForm.submit();
    }
}


