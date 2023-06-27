/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : public/js
 * 파일명       : common.js
 * 이력         :   v001 0612 이동호 new
**************************************************/

// fnc를 delay 밀리초 간격으로 실행하도록 제어하는 함수(= 쓰로틀링)
function throttle(fnc, delay) {
    // setTimeout 함수로 설정된 딜레이 동안 타이머 식별자를 저장하는 변수
    let timeoutId;
    // 마지막으로 함수가 실행된 시간을 저장하는 변수
    let lastExecTime = 0;
    
    // 쓰로틀링 함수를 반환
    return function() {
        // 실행 컨텍스트 : JavaScript 코드가 실행되는 환경을 나타내는 개념, 간단히 말해서 코드가 실행되는 공간
        // 변수 객체(Variable Object): 현재 컨텍스트에서 사용하는 변수와 함수 선언을 저장하는 객체
        //      전역 컨텍스트의 경우에는 전역 객체가 변수 객체로 동작함
        //      함수 컨텍스트의 경우에는 해당 함수의 활성 객체가 변수 객체로 동작함
        // 스코프 체인(Scope Chain): 변수 객체의 연결 리스트, 변수와 함수 식별자 검색을 위한 순서를 정의함
        //      함수 내부에서 변수를 찾을 때, 스코프 체인을 따라 상위 스코프로 이동하며 검색함
        // this 값: 현재 실행되는 함수의 this 값
        //      this는 함수 호출 방식에 따라 동적으로 결정됨

        // 쓰로틀링 함수가 호출될 때 실행 컨텍스트를 저장하는 변수, 이전 코드에서 this로 참조된 값을 저장함
        const context = this;
        // 쓰로틀링 함수가 호출될 때 전달된 arguments를 저장하는 변수
        const args = arguments;
        // 현재 시간과 이전 실행 시간의 차이 계산
        const elapsed = Date.now() - lastExecTime;
        
        // 실제로 함수를 실행하는 내부 함수, 저장된 실행 컨텍스트와 인수를 사용하여 fnc 함수를 실행
        function execute() {
            fnc.apply(context, args);
            lastExecTime = Date.now();
        }
        
        // 경과 시간이 딜레이보다 큰 경우는 바로 execute() 함수를 실행
        if (elapsed > delay) {
            execute();
        } else {
            // 이전에 예약된 타이머가 있다면 취소
            clearTimeout(timeoutId);
            // setTimeout을 사용해서 남은 시간(delay - elapsed) 후에 execute() 함수를 실행하도록 예약
            timeoutId = setTimeout(execute, delay - elapsed);
        }
    };
}

// 사용예시
// function handleEdit() {
//     // 수정 버튼을 클릭했을 때 실행되는 함수
//     // console.log('수정 버튼 클릭');
// }

// submitButton.addEventListener('click', throttle(handleEdit, 2000));