// const btn = document.getElementById('popupBtn');
// const modal = document.getElementById('modalWrap');
// const closeBtn = document.getElementById('closeBtn');

// btn.addEventListener('click', function(){
//     modal.style.display = 'block';
// });

// closeBtn.onclick = function() {
//   modal.style.display = 'none';
// }

// //배경 화면 클릭시 모달창 닫히도록
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }

var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
myInput.focus()
})