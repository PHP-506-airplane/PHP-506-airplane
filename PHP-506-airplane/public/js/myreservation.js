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
            //token 가져옴
            const accessToken = await _getIamportToken();
            console.log(accessToken);

            if (accessToken) {
                let header = {
                    "Authorization": accessToken,
                    "Access-Control-Allow-Origin": "*",
                    "X-CSRF-TOKEN": token,
                };

                await axios.post('/api/reservations/refundPay');
                // refundPay 응답을 처리
                clickedForm.submit();
                alert('환불되었습니다.');
                removeLoading();

            } else {
                // accessToken이 null이거나 토큰을 가져오는 중에 오류가 발생한 경우에 대한 처리를 합니다.
                removeLoading();
                console.log('환불 실패');
            }
        } catch (e) {
            removeLoading();
            console.log(e);
        }
    }
}

async function _getIamportToken() {
    try {
      const response = await fetch('/api/reservations/getToken', {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        //   "X-CSRF-TOKEN": token, 
        },
      });
  
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      
      const data = await response.json();
      const accessToken = data.response.access_token;

      return accessToken;

    } catch (error) {
      console.error('Error:', error);
      return null;
    }
  }
