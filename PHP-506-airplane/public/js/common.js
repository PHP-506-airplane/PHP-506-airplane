/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : public/js
 * 파일명       : common.js
 * 이력         :   v001 0612 이동호 new
**************************************************/

// 푸터 --------------------------------------------------------- v001
// DOMContentLoaded 이벤트(페이지 로딩)가 발생했을 때 실행
window.addEventListener('DOMContentLoaded', function() {
    let footer = document.querySelector('.footer');
    let divContentsMain = document.querySelector('.divContentsMain');
    
    function checkFooterPosition() {
        // 현재 창의 높이
        let windowHeight = window.innerHeight;
        // footer의 높이
        let footerHeight = footer.offsetHeight;
        let contentHeight = divContentsMain.scrollHeight;
        
        // footer가 화면 하단에 고정되어야 하는지 확인
        // 90(px)은 추가여백(만약 스크롤은 없는 높이지만, 컨테츠는 화면 가득 차있을경우를 위해 넣어줌)
        if (contentHeight + footerHeight + 130 < windowHeight) {
            footer.classList.add('footerFixed');
        } else {
            footer.classList.remove('footerFixed');
        }
    }
    
    // 페이지 로딩 시 footer의 위치를 조정
    checkFooterPosition();
    
    // 윈도우 크기 변경 시 footer의 위치를 다시 확인후 조정
    window.addEventListener('resize', function() {
        checkFooterPosition();
    });
});
// /푸터 ---------------------------------------------------------