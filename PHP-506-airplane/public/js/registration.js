// const chkPwMsg = document.getElementById('chk_pw_msg');
// const errMsgName = document.getElementById('chk_name_msg');

// function chkPw() {
//     const p1 = document.getElementById('password').value;
//     const p2 = document.getElementById('passwordchk').value;
//     if( p2.length === 0 ) {
//         chkPwMsg.style.color = 'red';
//         chkPwMsg.innerHTML = '비밀번호 확인을 입력해주세요.';
//     } else if( p1 !== p2 ) {
//         chkPwMsg.style.color = 'red';
//         chkPwMsg.innerHTML = '비밀번호가 일치하지 않습니다.';
//     } else {
//         chkPwMsg.style.color = 'green';
//         chkPwMsg.innerHTML = '비밀번호가 일치합니다.';
//     }
// }

// function chkName() {
//     const input = document.getElementById('name').value;
//     // const errMsgName = document.getElementById('errMsgName');
//     const NameFormat = /^[ㄱ-ㅎ||ㅏ-ㅣ||가-힣||a-z||A-Z]{2,12}$/;

//     if(!input) {
//         errMsgName.innerHTML = '';
//     }else if(!NameFormat.test(input)) {
//         errMsgName.innerHTML = '이름이 형식에 맞지 않습니다.';
//     } else {
//         errMsgName.innerHTML = '';
//     }
// }

function checkAll() {
    if (!checkPassword(form.password.value, form.passwordchk.value)) {
        return false;
    }
    if (!checkMail(form.email.value)) {
        return false;
    }
    if (!checkName(form.name.value)) {
        return false;
    }

    return true;
}

// 공백확인 함수
function checkExistData(value, dataName) {
    if (value == "") {
        alert(dataName + " 입력해주세요!");
        return false;
    }
    return true;
}

function checkPassword(password, passwordchk) {
    //비밀번호가 입력되었는지 확인하기
    if (!checkExistData(password, "비밀번호를"))
        return false;
    //비밀번호 확인이 입력되었는지 확인하기
    if (!checkExistData(passwordchk, "비밀번호 확인을"))
        return false;

    var passwordRegExp = /^[a-zA-z0-9]{4,12}$/; //비밀번호 유효성 검사
    if (!passwordRegExp.test(password)) {
        alert("비밀번호는 영문 대소문자와 숫자 4~12자리로 입력해야합니다!");
        form.password.value = "";
        form.passwordchk.focus();
        return false;
    }
    //비밀번호와 비밀번호 확인이 맞지 않다면..
    if (password != passwordchk) {
        alert("두 비밀번호가 맞지 않습니다.");
        form.password.value = "";
        form.passwordchk.value = "";
        form.passwordchk.focus();
        return false;
    }

    //아이디와 비밀번호가 같을 때..
    if (id == password) {
        alert("아이디와 비밀번호는 같을 수 없습니다!");
        form.password.value = "";
        form.passwordchk.value = "";
        form.passwordchk.focus();
        return false;
    }
    return true; //확인이 완료되었을 때
}

function checkMail(email) {
    //mail이 입력되었는지 확인하기
    if (!checkExistData(email, "이메일을"))
        return false;

    var emailRegExp = /^[A-Za-z0-9_]+[A-Za-z0-9]*[@]{1}[A-Za-z0-9]+[A-Za-z0-9]*[.]{1}[A-Za-z]{1,3}$/;
    if (!emailRegExp.test(email)) {
        alert("이메일 형식이 올바르지 않습니다!");
        form.email.value = "";
        form.email.focus();
        return false;
    }
    return true; //확인이 완료되었을 때
}

function checkName(name) {
    if (!checkExistData(name, "이름을"))
        return false;

    var nameRegExp = /^[가-힣]{2,30}$/;
    if (!nameRegExp.test(name)) {
        alert("이름이 올바르지 않습니다.");
        return false;
    }
    return true; //확인이 완료되었을 때
}

// -------------------------------------------------------------
// function check() {
//     //alert("테스트")
//     var pwField = document.registration.password;
//     var pwChkField = document.registration.passwordchk;
//     var nameField = document.registration.name;

//     if (isEmpty(pwField) || lessThan(pwField, 5)
//             || contains(pwField, "1234567890!@#$%^&*()_+")
//             || doubleCheck(pwField, pwChkField)) {
//         alert("비밀번호를 확인해주세요");
//         pwField.value = "";
//         pwChkField.value = "";
//         pwField.focus();
//         return false;
//     }
//     if (isEmpty(nameField) || lessThan(nameField, 6)
//             || isNotNum(nameField)) {
//         alert("이름을 확인해주세요");
//         nameField.value = "";
//         nameField.focus();
//         return false;
//     }

//     return true;
// }
// -------------------------------------------------------------
// function checkBirth(identi1, identi2) {
//     //birth이 입력되었는지 확인하기
//     if (!checkExistData(identi1, "주민등록번호를 ")
//             || !checkExistData(identi2, "주민등록번호를 "))
//         return false;

//     var totalIdenti = "" + identi1 + identi2;

//     var identiArr = new Array();
//     var sum = 0;
//     var plus = 2;

//     //배열에 주민등록번호 입력 후 유효값 확인하기 위해 sum에 저장
//     for (var i = 0; i < 12; i++) {
//         identiArr[i] = totalIdenti.charAt(i);
//         if (i >= 0 && i <= 7) {
//             sum += totalIdenti[i] * plus;
//             plus++;
//             if (i == 7)
//                 plus = 2;
//         } else {
//             sum += totalIdenti[i] * plus;
//             plus++;
//         }
//     }
//     //주민등록번호 길이 확인하기
//     if (identiArr.length < 12) {
//         alert("주민등록번호는 13자리입니다.");
//         form.identi1.value = "";
//         form.identi2.value = "";
//         form.identi1.focus();
//         return false;
//     }
//     //주민등록번호 유효한지 확인
//     var result = 11 - (sum % 11) % 10
//     if (result != totalIdenti.charAt(12)) { //주민등록번호가 유효하지 않은 경우
//         alert("유효하지않은 주민번호입니다.");
//         form.identi1.value = "";
//         form.identi2.value = "";
//         form.identi1.focus();
//         return false;
//     }
//     return true; //확인이 완료되었을 때
// }