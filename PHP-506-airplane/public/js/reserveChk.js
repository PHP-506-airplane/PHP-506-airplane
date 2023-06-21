// const dep_price = document.querySelectorAll('.dep_price');
// const arr_price = document.querySelectorAll('.arr_price');
// const sum_price = document.querySelector('.sum_price');
// const chk_btn = document.querySelector('.chk_btn');


// let dep_count = 0;
// let arr_count = 0;
// dep_price.forEach(function(a){
//     a.addEventListener('click', function(){
//         dep_count++;
//         sum_price.textContent = a.textContent 
//     })
// });

// arr_price.forEach(function(a){
//     a.addEventListener('click', function(){
//         let pr = sum_price.textContent;
//         arr_count++;
//         if(arr_count < 2){
//             pr = Number(a.textContent)+Number(pr)  
//         }
//     });
// });


const dep_price = document.querySelectorAll('.dep_price');
const arr_price = document.querySelectorAll('.arr_price');
const sum_price = document.querySelector('.sum_price');

let dep_count = 0;
let arr_count = 0;
let dep_total = 0; // dep_price 값의 누적을 저장하기 위한 변수

dep_price.forEach(function (a) {
    a.addEventListener('click', function () {
        dep_count++;
        dep_total = Number(a.textContent); // 클릭한 dep_price의 값을 dep_total에 저장
        sum_price.textContent = dep_total; // sum_price를 dep_total로 설정
    });
});

arr_price.forEach(function (a) {
    a.addEventListener('click', function () {
        let pr = sum_price.textContent;
        arr_count++;
        if (arr_count < 2) {
            pr = Number(a.textContent) + dep_total; // 클릭한 arr_price 값에 dep_total 값을 더하여 계산
            sum_price.textContent = pr; // 새로운 합계를 sum_price에 업데이트
        }
    });
});
