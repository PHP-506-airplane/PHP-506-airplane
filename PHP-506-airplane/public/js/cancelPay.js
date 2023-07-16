const express = require('express'),
      axios   = require('axios'),
      router  = express.Router();

const HappyRedis = require('../happyredis');

const config = require('../config');

router.all('/iamport/:device/complete', async (req, res, next) => {
  
});

//환불
router.post('/iamport/:key/refund', async (req, res, next) => {
  try {
    const key = req.params.key,
          merchantInfo = req.body[key];

    //token 가져옴
    const accessToken = await _getIamportToken();

    //아임포트 환불 API 호출
    const refundRet = await axios({
      url : 'https://api.iamport.kr/payments/cancel', 
      method : 'POST',
      headers : { "Authorization": accessToken },
      data : { 
        imp_uid : merchantInfo.iamport_id, 
        reason : merchantInfo.reason, 
        checksum : merchantInfo.price 
      }
    });
    const isSuccess = !!refundRet.data.response;

    if(isSuccess) {
      //환불완료
      merchantInfo.status = 3;
    } else {
      //환불실패
      merchantInfo.errmsg = refundRet.data.message;
    }

    //가맹점 WAS 상품데이터 변경
    const redisClient = new HappyRedis();

    redisClient.hset(key, merchantInfo.id, JSON.stringify(merchantInfo), (updateErr, affectedRows) => {
      if(updateErr) {
        return next(updateErr);
      }
      if(isSuccess) {
        res.status(200).send(merchantInfo);
      } else {
        next(new Error(merchantInfo.errmsg));
      }
    });
  } catch(err) {
    if(err.response) {
      err = new Error(erro.response.data.message);
    }
    next(err);
  }
});

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

module.exports = router;