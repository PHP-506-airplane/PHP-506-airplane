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
const flg = document.querySelector('.flg');
// 예약확정 confirm
const seatForm = document.getElementById('seatPost');
function reserveBtn(){
    let con_test = confirm("정말 예약 하시겠습니까?");
    let fly_no = document.getElementById('fly_no').value;
    let fly_no2 = document.getElementById('fly_no2').value;

    if (con_test == true) {
        if (flg.value == 1) {
            if (s_name.value == '') {
                alert('가는편 좌석을 선택해 주세요.');
                con_test = false;
            }
            else if (s_name2.value == '') {
                alert('오는편 좌석을 선택해 주세요.');
                con_test = false;
            } else {
                showLoading();
                // seatForm.submit();

                let price1 = 
                    getPrice(fly_no)
                    .then(function(price) {
                        let price1 = price;
                    })
                    .then({
                        
                    })
                    .catch(function(err) {
                        console.log(err);
                    });

                let price2 =
                    getPrice(fly_no2)
                    .then(function(price) {
                        console.log(fly_no2 + ":" + price);
                        console.log(price1 + "," + price2);
                    })
                    .catch(function(err) {
                        console.log(err);
                    });
            }
        } else {
            if (s_name.value == '') {
                alert('좌석을 선택해 주세요.');
                con_test = false;
            } else {
                showLoading();
                // seatForm.submit();
                getPrice(fly_no.value);
            }
        }
    }
}
// fly_no.value
async function getPrice(pk) {
    try {
        const res = await axios.post('/api/pay/price', pk);
        const price = await res.data.price;
        return price;
    } catch (error) {
        console.log(error);
    }
}



