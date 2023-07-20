<h1>이메일 인증</h1>
<br>
<div>안녕하세요, {{ $user->u_name }}님</div>
<div>아래 링크를 클릭하여 이메일을 인증해 주세요</div>
<br>
<div><a href="{{ route('users.verify', ['code' => $emailVerify->verification_code]) }}">이메일 인증 하기</a></div>
<br>
<div>이 인증 링크는 {{ $emailVerify->validity_period }}까지 유효합니다.</div>