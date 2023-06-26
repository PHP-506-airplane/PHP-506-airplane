// div에 적은 내용 textarea로 복사
function updateTextarea() {
    let divContent = document.getElementById('divContent');
    let contentTextarea = document.getElementById('content');
    contentTextarea.value = divContent.innerText;
}

// 이미지 있으면 자동 줄바꿈
function addBr() {
    const divContent = document.getElementById('divContent');
    const newLine = document.createElement('br');
    divContent.appendChild(newLine);
}

// 이미지 로드가 완료되면 줄바꿈 추가
document.addEventListener('DOMContentLoaded', function () {
    const currentImage = document.getElementById('currentImage');
    currentImage.addEventListener('load', addBr());
});

// 마우스 커서 글뒷부분으로 옮기기
function moveCursor() {
    let divContent = document.getElementById('divContent');
    let range = document.createRange();
    let selection = window.getSelection();

    range.selectNodeContents(divContent); // 커서를 divContent 요소의 내용에 위치
    range.collapse(false); // 커서를 마지막 위치로 이동
    selection.removeAllRanges(); // 현재 선택된 영역을 제거
    selection.addRange(range); // 새로운 커서 위치를 선택
    divContent.focus(); // divContent에 포커스를 설정, 사용자가 텍스트를 입력할수 있게함
}

// 이미지 선택시 바로 바꾸기
function displaySelectedImage(event) {
    const image = event.target.files[0];
    const imageURL = URL.createObjectURL(image);
    const currentImage = document.getElementById('currentImage');
    currentImage.src = imageURL;
}