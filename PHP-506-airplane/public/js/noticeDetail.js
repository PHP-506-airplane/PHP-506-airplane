function Confirm() {
    confirm('', '정말 삭제하시겠습니까?');
}

// function Alert() {
//     alert('gg', 'success');
// }

let alert = function(msg, type) {
    swal({
        title : '',
        text : msg,
        type : type,
        // timer : 1500,
        customClass : 'sweet-size',
        confirmButtonText : 'OK',
        confirmButtonColor : '#7267e3',
        closeOnCancel : false,
        showConfirmButton : true
    });
}

let confirm = function(msg, title) {
    swal({
        title : title,
        text : msg,
        type : "warning",
        showCancelButton : true,
        confirmButtonColor : '#7267e3',
        confirmButtonClass : "btn-danger",
        confirmButtonText : "예",
        cancelButtonText : "아니오",
        closeOnConfirm : false,
        closeOnCancel : false
    }, function(isConfirm) {
        if (isConfirm) {
            document.getElementById('formDel').submit();
        } else {
            alert('취소되었습니다.', 'error');
        }
    });
}