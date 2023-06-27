const dep_price = document.querySelectorAll('.dep_fly_no');
const dep_price2 = document.querySelectorAll('.dep_fly_no2');
const arr_price = document.querySelectorAll('.arr_fly_no');
const sum_price = document.querySelector('.sum_price');

let dep_count = 0;
let arr_count = 0;
let dep_total = 0; // dep_price 값의 누적을 저장하기 위한 변수

// 왕복
// dep_price.forEach(function (a) {
//     a.addEventListener('click', function () {
        
//         dep_total = Number(a.lastChild.innerText); // 클릭한 dep_price의 값을 dep_total에 저장
//     });
// });

// arr_price.forEach(function (a) {
//     a.addEventListener('click', function (e) {
//         let pr = sum_price.textContent;
//         if(dep_count < 1){
//             alert('가는편을 먼저 선택해 주세요');
//             e.preventDefault();
//         }
//         arr_count++;
//         if (dep_count >= 1 && arr_count < 10) {
//             pr = Number(a.lastChild.innerText) + dep_total; // 클릭한 arr_price 값에 dep_total 값을 더하여 계산
//             pr = pr.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
//             sum_price.textContent = pr +'원'; // 새로운 합계를 sum_price에 업데이트
//         }
//     });
// });

// 편도
dep_price2.forEach(function (a) {
    a.addEventListener('click', function () {
        dep_count++;
        dep_total = Number(a.lastChild.innerText); // 클릭한 dep_price의 값을 dep_total에 저장
        dep_total = dep_total.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
        sum_price.textContent = dep_total + '원'; // sum_price를 dep_total로 설정
    });
});


const tr = document.querySelectorAll('.tr_data');
const tr2 = document.querySelectorAll('.tr_data2');
const tr3 = document.querySelectorAll('.tr_data3');
const id = document.getElementById('data');
// 왕복
tr.forEach(function (trElement) {
  trElement.addEventListener('click', function () {
    dep_count++;
    // 버튼 체크 해제
    const radioButtons = document.getElementsByName('.dep_fly_no');
    radioButtons.forEach(function (radioButton) {
      radioButton.checked = false;
    });

    // 체크
    const radioButton = this.querySelector('input[name="dep_fly_no"]');
    radioButton.checked = true;
    // 가격
    const depPrice = this.querySelector('.dep_price').value;
    dep_total = parseFloat(depPrice); ;
  });
});

tr2.forEach(function (trElement) {
  trElement.addEventListener('click', function (e) {
    if(dep_count < 1){
        alert('가는편을 먼저 선택해 주세요');
        e.preventDefault();
    }
    arr_count++;
        
    // 버튼 체크 해제
    const radioButtons = document.getElementsByName('.arr_fly_no');
    radioButtons.forEach(function (radioButton) {
      radioButton.checked = false;
    });

    // 체크
    const radioButton = this.querySelector('input[name="arr_fly_no"]');
    radioButton.checked = true;
    // 가격
    const arrPrice = this.querySelector('.arr_price').value;

    if (dep_count >= 1 && arr_count < 10) {
        let pr = sum_price.textContent;
        pr = parseFloat(arrPrice) + dep_total; // 클릭한 arr_price 값에 dep_total 값을 더하여 계산
        console.log(pr);
        pr = pr.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
        sum_price.textContent = pr +'원'; // 새로운 합계를 sum_price에 업데이트
    }
  });
});
// 편도
tr3.forEach(function (trElement) {
    trElement.addEventListener('click', function () {
      // 버튼 체크 해제
      const radioButtons = document.getElementsByName('.dep_fly_no');
      radioButtons.forEach(function (radioButton) {
        radioButton.checked = false;
      });
      // 체크
      const radioButton = this.querySelector('input[name="dep_fly_no"]');
      radioButton.checked = true;
      // 가격
      const depPrice = this.querySelector('.dep_price2').value;
      let pr;
      pr = parseFloat(depPrice).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
      sum_price.textContent = pr +'원';
    });
  });
