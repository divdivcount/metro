<?php
require_once("modules/db.php");
$mb_id = Get("mb", 0);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/css_my_one_page.css">
<link rel="stylesheet" href="css/css_noamlfont.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<style>
  .w3-container{background-color: #fff;}
  .button_contatiner_margin{padding-top: 88px; padding-bottom: 190px;}
  .p_container_margin{margin-bottom: 50px; margin-left: 70px;}
</style>
</head>
<body>
<div class="w3-container">
    <h3 class="h3">회원정보 수정</h3>
  <div>
    <form id="pwForm" class="p_container_margin" action="member_pw_change.php" method="post">
      <p>
          <span>아이디</span><input class="input_id" type="text" id="id" name="id" readonly value="">
      </p>
      <p>
        <label>*현재 비밀번호</label>
        <input class="input_password" id="old_pw" name="old_pw" type="password" required>
      </p>
      <p>
        <label>*새 비밀번호</label>
        <input class="input_new_password" name="pw" type="password" required>
      </p >
      <label>*비밀번호 확인</label>
        <input class="input_new_exisit_password" type="text" name="pw2" type="password" required>
    </form>
      <p class="p_container_margin">
        <label>이름</label>
        <input class="input_name" type="text" id="name" name="name" value=""  readonly required>
      </p>
      <p class="p_container_margin">
        <label>이메일</label>
        <input class="input_email" type="text" id="email" name="email" value=""  readonly required>
      </p>
      <p class="p_container_margin">
        <label>*주변 역 설정하기</label>
        <input class="input_station" type="text" id="pw2" required>	<button type="submit" id="joinBtn" class="w3-button w3-tiny w3-light-gray w3-round">역 검색</button>
      </p>
      <p class="w3-center button_contatiner_margin">
        <button type="submit" id="joinBtn" class="w3-button  w3-blue w3-ripple w3-margin-top w3-round">비밀번호 변경</button>
        <button type="button" id="joinBtn" class="w3-button w3-dark-gray w3-ripple w3-margin-top w3-round">회원 탈퇴</button>
      </p>
  </div>
</div>
</body>
</html>
