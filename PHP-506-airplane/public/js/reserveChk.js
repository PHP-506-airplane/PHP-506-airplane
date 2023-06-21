const dep_price = document.querySelectorAll('.dep_price');
const arr_price = document.querySelectorAll('.arr_price');
const sum_price = document.querySelector('.sum_price');
const chk_btn = document.querySelector('.chk_btn');


let dep_count = 0;
let arr_count = 0;
dep_price.forEach(function(a){
    a.addEventListener('click', function(){
        dep_count++;
        sum_price.textContent = a.textContent 
    })
});

arr_price.forEach(function(a){
    a.addEventListener('click', function(){
        let pr = sum_price.textContent;
        if(dep_count == 0){

        }
        arr_count++;
        if(arr_count < 2){
            pr = Number(a.textContent)+Number(pr)  
        }else{
            
        }

    });
});

