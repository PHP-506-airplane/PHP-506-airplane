/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : public/js
 * 파일명       : myreservation.js
 * 이력         :   v001 0623 이동호 new
 **************************************************/
 let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const formCancel = document.getElementById('formCancel');

// function confirmCancel() {
//     let con = confirm("예약을 취소 하시겠습니까?");

//     if(con === true) {
//         showLoading();
//         formCancel.submit();
//     }
// }

// async function cancelClick(event) {
//     const clickedForm = event.target.closest('#formCancel'); // 클릭된 form을 찾음
//     const payId = document.querySelector('.p_id');


//     let con = confirm("예약을 취소 하시겠습니까?");
//     if(con === true) {
//         showLoading();
//         // clickedForm.submit();
//         try{
//              //token 가져옴
//             const accessToken = await _getIamportToken();
//             console.log(accessToken);
//             let header ={"Authorization": accessToken,
//                         "Access-Control-Allow-Origin": "*",
//                         "X-CSRF-TOKEN": token,}
//             const refundPay = await axios.post('https://api.iamport.kr/payments/cancel',{
//                 imp_uid : payId.value, 
//                 reason : '결제취소', 
//                 checksum : '3200' 
//             },{ headers: header });
//         }catch(e){
//             removeLoading();
//             console.log(e);
//             console.log('환불 실패');
//         }
//     }
// }
async function cancelClick(event) {
    const clickedForm = event.target.closest('#formCancel'); // 클릭된 form을 찾음

    let con = confirm("예약을 취소 하시겠습니까?");
    if (con === true) {
        showLoading();
        try {
                let header = {
                    "Access-Control-Allow-Origin": "*",
                    "X-CSRF-TOKEN": token,
                };
                await axios.post('/reservation/myreservation',{},{headers:header});
                
                // refundPay 응답을 처리
                clickedForm.submit();
                alert('환불 되었습니다.');
                removeLoading();

              } catch (e) {
            removeLoading();
            alert('환불에 실패했습니다.');
        }
    }
}

function showTab(activeTabId, activeContentId) {
    // 모든 탭 콘텐츠 숨기기
    var tabContents = document.getElementsByClassName("tabContent");
    for (var i = 0; i < tabContents.length; i++) {
        tabContents[i].style.display = "none";
    }

    // 모든 탭 비활성화
    var tabLinks = document.getElementsByClassName("tabA");
    for (var i = 0; i < tabLinks.length; i++) {
        tabLinks[i].classList.remove("choice");
    }

    // 선택된 탭 콘텐츠 보이기
    var activeContent = document.getElementById(activeContentId);
    activeContent.style.display = "block";

    // 선택된 탭 활성화
    var activeTab = document.getElementById(activeTabId);
    activeTab.parentNode.classList.add("choice");
}
