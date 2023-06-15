const chkPwMsg = document.getElementById('chk_pw_msg');
const errMsgName = document.getElementById('chk_name_msg');

function chkPw() {
    const p1 = document.getElementById('password').value;
    const p2 = document.getElementById('passwordchk').value;
    if( p2.length === 0 ) {
        chkPwMsg.style.color = 'red';
        chkPwMsg.innerHTML = '비밀번호 확인을 입력해주세요.';
    } else if( p1 !== p2 ) {
        chkPwMsg.style.color = 'red';
        chkPwMsg.innerHTML = '비밀번호가 일치하지 않습니다.';
    } else {
        chkPwMsg.style.color = 'green';
        chkPwMsg.innerHTML = '비밀번호가 일치합니다.';
    }
}

function chkName() {
    const input = document.getElementById('name').value;
    // const errMsgName = document.getElementById('errMsgName');
    const NameFormat = /^[ㄱ-ㅎ||ㅏ-ㅣ||가-힣||a-z||A-Z]{2,12}$/;

    if(!input) {
        errMsgName.innerHTML = '';
    }else if(!NameFormat.test(input)) {
        errMsgName.innerHTML = '이름이 형식에 맞지 않습니다.';
    } else {
        errMsgName.innerHTML = '';
    }
}