// function displaySelectedImage(event) {
//     const image = event.target.files[0];
//     const imageURL = URL.createObjectURL(image);
//     const selectedImage = document.getElementById('selectedImage');
//     selectedImage.src = imageURL;
//     selectedImage.style = 'display: block';
// }

// function updateTextarea() {
//     let divContent = document.getElementById('divContent');
//     let contentTextarea = document.getElementById('content');
//     contentTextarea.value = divContent.innerText;
// }

function displaySelectedImage(event) {
    // 이미지 버튼으로 이미지 선택한 경우
    // 이미지 파일 가져오기
    const image = event.target.files[0];
    // 이미지 파일 가져오기
    const imageURL = URL.createObjectURL(image);
    // selectedImage 요소 가져오기
    const selectedImage = document.getElementById('selectedImage');
    // 이미지 표시되게 selectedImage의 src 설정
    selectedImage.src = imageURL;
    // 이미지 표시를되게 selectedImage의 style.display 설정
    selectedImage.style = 'display: block';

    // 붙여넣기로 이미지 넣은경우
    // divContent 가져오기
    const divContent = document.getElementById('divContent');
    // contentTextarea 가져오기
    const contentTextarea = document.getElementById('content');
    // img 태그 생성
    const imageTag = document.createElement('img');
    // img 태그의 src 설정
    imageTag.src = imageURL;
    // img 태그에 CSS 클래스 'noticeImg' 추가
    imageTag.className = 'noticeImg';
    // divContent에 img 태그 추가
    divContent.appendChild(imageTag);
    // divContent 내용을 contentTextarea로 복사
    contentTextarea.value = divContent.innerHTML;
}

function updateContentTextarea() {
    const divContent = document.getElementById('divContent');
    const contentTextarea = document.getElementById('content');
    contentTextarea.value = divContent.innerHTML;
}