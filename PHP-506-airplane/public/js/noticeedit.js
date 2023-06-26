// div에 적은 내용 textarea로 복사
function updateTextarea() {
    let divContent = document.getElementById('divContent');
    let contentTextarea = document.getElementById('content');
    contentTextarea.value = divContent.innerText;
}

// 이미지 선택시 바로 바꾸기
function displaySelectedImage(event) {
    const image = event.target.files[0];
    const imageURL = URL.createObjectURL(image);
    const currentImage = document.getElementById('currentImage');
    currentImage.src = imageURL;
}