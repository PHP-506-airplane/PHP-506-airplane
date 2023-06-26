function displaySelectedImage(event) {
    const image = event.target.files[0];
    const imageURL = URL.createObjectURL(image);
    const imagePreview = document.getElementById('imagePreview');
    imagePreview.innerHTML = `<img src="${imageURL}" alt="이미지" class="noticeImg">`;
}

function updateTextarea() {
    let divContent = document.getElementById('divContent');
    let contentTextarea = document.getElementById('content');
    contentTextarea.value = divContent.innerText;
}