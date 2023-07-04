const chkPwMsg = document.getElementById('chk_pw_msg');

function chkPw() {
    const p1 = document.getElementById('password').value;
    const p2 = document.getElementById('pwchk').value;
    if( p2.length === 0 ) {
        chkPwMsg.style.color = 'red';
        chkPwMsg.style.fontSize = '12px';
        chkPwMsg.innerHTML = '❕비밀번호 확인을 입력해주세요.';
    } else if( p1 !== p2 ) {
        chkPwMsg.style.color = 'red';
        chkPwMsg.style.fontSize = '12px';
        chkPwMsg.innerHTML = '❕비밀번호가 일치하지 않습니다.';
    } else {
        chkPwMsg.style.color = 'green';
        chkPwMsg.style.fontSize = '12px';
        chkPwMsg.innerHTML = '✔️비밀번호가 일치합니다.';
    }
}