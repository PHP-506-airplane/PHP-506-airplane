/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : public/js
 * 파일명       : myreservation.js
 * 이력         :   v001 0623 이동호 new
**************************************************/

const formCancel = document.getElementById('formCancel');

function confirmCancel() {
    let con = confirm("예약을 취소 하시겠습니까?");

    if(con === true) {
        formCancel.submit();
    }
}