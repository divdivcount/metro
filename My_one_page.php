<?php
require_once("modules/db.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
  .input_id{border:none; width:50%; margin-left: 17.5%;}
  .input_name{border:none; width:50%; margin-left: 18.5%;}
  .input_email{border:none; width:50%; margin-left: 17%;}
  .input_password{border:none; border-bottom: 1px solid; width:50%; margin-left: 11%;}
  .input_new_password{border:none; border-bottom: 1px solid; width:50%; margin-left: 12.7%;}
  .input_new_exisit_password{border: none; border-bottom: 1px solid; width:50%; margin-left: 11%;}
  .input_station{border: none; border-bottom: 1px solid; width:20%; margin-left: 9%;}
  .img_center{width:100%; text-align: center;}
  .h3{font-size: 30px;}
  label{width:20%;}
</style>
</head>
<body>
	<div class="w3-content w3-container w3-margin-top">
		<div class="w3-container w3-card-4">
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
	</div>
</body>
</html>
