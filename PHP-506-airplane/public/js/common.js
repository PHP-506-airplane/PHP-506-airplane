/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : public/js
 * 파일명       : common.js
 * 이력         :   v001 0612 이동호 new
**************************************************/

// 쓰로틀링
function throttle(btn, form) {
    let timer;
    
    btn.addEventListener('click', function (e) {
        if (!timer) {
            timer = setTimeout(function() {
                // 타이머 초기화
                timer = null;
            }, 1500);
            // form submit
            form.submit();
        }
    });
}