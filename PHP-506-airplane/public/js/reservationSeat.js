let seats = document.querySelectorAll('.fast a');
let s_name = document.querySelector('.show_name');
let choice = document.querySelector('.tab');


seats.forEach(function(seat){
    seat.addEventListener('click', function(){
        seats.forEach(function(seat){
            seat.classList.remove('selected');
        });
        seat.classList.toggle('selected');
        s_name.value = seat.querySelector('#s_name').value;
    });
});

function changeTab(tabId) {
    var tab = document.getElementById(tabId);
    var tabs = document.getElementsByClassName('tab');

    for (var i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove('choice');
    }

    tab.parentElement.classList.add('choice');
}

const seatForm = document.getElementById('seatPost');
function reserveBtn(){
    var con_test = confirm("정말 예약 하시겠습니까?");
    if(con_test == true){
        seatForm.submit();
    }
}