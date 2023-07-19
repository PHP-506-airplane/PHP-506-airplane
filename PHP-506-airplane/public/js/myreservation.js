/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : public/js
 * 파일명       : myreservation.js
 * 이력         :   v001 0623 이동호 new
**************************************************/

const formCancel = document.getElementById('formCancel');

// function confirmCancel() {
//     let con = confirm("예약을 취소 하시겠습니까?");

//     if(con === true) {
//         showLoading();
//         formCancel.submit();
//     }
// }

async function cancelClick(event) {
    const clickedForm = event.target.closest('#formCancel'); // 클릭된 form을 찾음
    const payId = document.querySelector('.p_id');

    const accessToken = await _getIamportToken();

    let con = confirm("예약을 취소 하시겠습니까?");
    if(con === true) {
        showLoading();
        // clickedForm.submit();
        try{
            let header = {"Authorization": accessToken};
            const refundPri = await axios.post('https://api.iamport.kr/payments/cancel',{
                merchant_uid : payId.value
            },header);
        }catch{
            removeLoading();
            console.log('환불 실패');
        }
    }
}

async function _getIamportToken() {
    const impInfo = config.iamport,
    tokenParam = { imp_key : impInfo.apiKey, imp_secret : impInfo.apiSecret };
  
    //accessToken 가져오기
    const tokenRes = await axios.post('https://api.iamport.kr/users/getToken', tokenParam),
    accessToken = tokenRes.data.response.access_token;
  
    if(!accessToken) {
      throw new Error("AccessToken is not exist");
    }
  
    return accessToken;
  }