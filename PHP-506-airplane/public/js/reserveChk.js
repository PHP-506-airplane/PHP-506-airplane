const dep_price = document.querySelectorAll('.dep_fly_no');
const arr_price = document.querySelectorAll('.arr_fly_no');
const sum_price = document.querySelector('.sum_price');

let dep_count = 0;
let arr_count = 0;
let dep_total = 0; // dep_price 값의 누적을 저장하기 위한 변수

dep_price.forEach(function (a) {
    a.addEventListener('click', function () {
        dep_count++;
        dep_total = Number(a.lastChild.innerText); // 클릭한 dep_price의 값을 dep_total에 저장
        // dep_total = dep_total.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
        // sum_price.textContent = dep_total; // sum_price를 dep_total로 설정
    });
});

arr_price.forEach(function (a) {
    a.addEventListener('click', function (e) {
        let pr = sum_price.textContent;
        if(dep_count < 1){
            alert('가는편을 먼저 선택해 주세요');
            e.preventDefault();
        }
        arr_count++;
        if (dep_count >= 1 && arr_count < 10) {
            pr = Number(a.lastChild.innerText) + dep_total; // 클릭한 arr_price 값에 dep_total 값을 더하여 계산
            pr = pr.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
            sum_price.textContent = pr +'원'; // 새로운 합계를 sum_price에 업데이트
        }
    });
});


