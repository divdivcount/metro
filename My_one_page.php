<?php
require_once("modules/db.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/css_my_one_page.css">
<link rel="stylesheet" href="css/css_noamlfont.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<!-- <script>
	$(function(){
		if(${msg ne null}){
			alert('${msg}');
		};

		if($("#pwForm").submit(function(){
			if($("#pw").val() !== $("#pw2").val()){
				alert("비밀번호가 다릅니다.");
				$("#pw").val("").focus();
				$("#pw2").val("");
				return false;
			}else if ($("#pw").val().length < 8) {
				alert("비밀번호는 8자 이상으로 설정해야 합니다.");
				$("#pw").val("").focus();
				return false;
			}else if($.trim($("#pw").val()) !== $("#pw").val()){
				alert("공백은 입력이 불가능합니다.");
				return false;
			}
		}));
	})
</script> -->
<style>

</style>
</head>
<body>
  <!-- 상단 메뉴 부분 -->
  <?php require_once 'metrocket_header.php';?>

	<div class="w3-content w3-container w3-margin-top">

    <!-- 유저정보  차후 php 작업 필요 -->
    <div class="profile_box">
      <div class="prfileImg_box">
        <img class="w3-circle" src="img/testPeople.png" >
        <img src="img/camera.png" style="position:absolute;left:70%;top:70%;" alt="">
      </div>
        <div class="user_name">이름</div>
    </div>

    <!-- 메인 버튼 -->
    <div class="mainBtn_box">
       <button type="button" class="w3-button w3-round" name="main_button" onclick = "location.href = '#' " >회원 정보</button>
       <button type="button" class="w3-button w3-round" name="main_button" onclick = "location.href = '#' " >판매 상품</button>
       <button type="button" class="w3-button w3-round" name="main_button" onclick = "location.href = '#' " >관심 상품</button>
       <button type="button" class="w3-button w3-round" name="main_button" onclick = "location.href = '#' " >구매 상품</button>
    </div>

    <iframe src="" width="" height="" >
  		<div class="w3-container">
          <h3 class="h3">회원정보 수정</h3>
  			<div>
          <div class="img_center">
            <img class="w3-circle" src="img/google@3x.png" style="width:50px">
          </div>
          <form id="pwForm" action="member_pw_change.php" method="post">
            <p>
                <span>아이디</span><input class="input_id" type="text" id="id" name="id" readonly value="${ member.id }">
            </p>
            <p>
              <label>*현재 비밀번호</label>
              <input class="input_password" id="old_pw" name="old_pw" type="password" required>
            </p>
            <p>
              <label>*새 비밀번호</label>
              <input class="input_new_password" name="pw" type="password" required>
            </p>
            <label>*비밀번호 확인</label>
              <input class="input_new_exisit_password" type="text" name="pw2" type="password" required>
          </form>
            <p>
              <label>이름</label>
              <input class="input_name" type="text" id="email" name="name" value="${ member.email }"  readonly required>
            </p>
            <p>
              <label>이메일</label>
              <input class="input_email" type="text" id="email" name="email" value="${ member.email }"  readonly required>
            </p>
            <p>
              <label>*주변 역 설정하기</label>
              <input class="input_station" type="text" id="pw2" required>	<button type="submit" id="joinBtn" class="w3-button w3-tiny w3-light-gray w3-round">역 검색</button>
            </p>
            <p class="w3-center">
              <button type="submit" id="joinBtn" class="w3-button  w3-blue w3-ripple w3-margin-top w3-round">비밀번호 변경</button>
              <button type="button" id="joinBtn" class="w3-button w3-dark-gray w3-ripple w3-margin-top w3-round">회원 탈퇴</button>
            </p>
  			</div>
  		</div>
    </iframe>
	</div>

  <!-- 하단 메뉴 부분 -->
  <?php require_once 'metrocket_footer.php';?>
</body>
</html>
