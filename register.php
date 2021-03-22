<?php
// Load Modules
require_once("modules/db.php");
?>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="css/css_register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<?php
$mb_id = empty($_SESSION['ss_mb_id']) ? "" : $_SESSION['ss_mb_id'];
if($mb_id && isset($_GET['mode']) == 'modify') { // 세션이 있고 회원수정 mode라면 회원 정보를 가져옴
	$dao = new Member();
	$result = $dao->Member_Search("",$mb_id);
	foreach ($result as $mb) {

	}
	$mode = "modify";
	$title = "Modify";
	$modify_mb_info = "readonly";
} else {
	$mb['mb_id']= "";
	$modify_mb_info = "";
	$mb['mb_name'] = "";
	$mb['mb_email'] = "";
	$mb['mb_station'] = "";

	$mode = "insert";
	$title = "register";
	$modify_mb_info = '';

	?>
<script>
	$(document).ready(function(e) {
		$(".id_checking").on("keyup", function(){ //id_checking 라는 클래스에 입력을 감지(keyup이벤트)
			var id_checking = $(this); //id_checking 클래스 자기자신
			var mb_id;
			if(id_checking.attr("id") === "mb_id"){ //id_checking.attr("id") -> mb_id === mb_id
				mb_id = id_checking.val();//id_checking 벨류값을 mb_id에 담김
			}
			$.post( //post방식으로 register_update.php에 입력한 userid값을 넘깁니다
				"ajaxlogin.php",
				{ mb_ids : mb_id},
				function(data){
					if(data){ //만약 data값이 전송되면
						$('#id_check').html(data); //id_check에 값을 넣음
					}
				}
			);
		});
	});

	</script>
	<?php
}
?>
<body>
<form action="./register_update.php" onsubmit="return fregisterform_submit(this);" method="post">
	<input type="hidden" name="mode" value="<?php echo $mode; ?>">

		<div class="login-box">

			<div class="imgbox">
        <img src="img/metrocket.png" alt="" style="align-self: center;">
      </div>

			<div id="boundarybox">
        <div class="line"></div>
        <div style="width:32%;" >메트로켓 회원가입</div>
        <div class="line"></div>
      </div>
			<div id="inputbox">

				<div class="textbox">
					<input type="text" placeholder="아이디" name="mb_id" id="mb_id"  class="id_checking" value="<?php echo $mb['mb_id']; ?>" <?php echo $modify_mb_info; ?>/>
				</div>
				<p id='id_check'></p>
				<div class="textbox">
					<input type="password" placeholder="비밀번호" name="mb_password">
				</div>
				<div class="textbox">
					<input type="password" placeholder="비밀번호 확인" name="mb_password_re">
				</div>
				<div class="textbox">
					<input type="text" name="mb_name" placeholder="이름" value="<?php echo $mb['mb_name'] ?>" <?php echo $modify_mb_info ?>>
				</div>

				<div class="textbox"><!-- 이메일 폼 부분 재구성함 수정 요함  -->
					<input type="text" id="fitst_email" name="" value="" placeholder="이메일"> <div style="float:left">@</div>
					<input type="text" id="second_email" name="" value="">

					<select id="selbox" class="" name="">
						<option value="direct">직접입력</option>
						<option value="naver.com">naver.com</option>
						<option value="gmail.com">gmail.com</option>
					</select>

					<!-- <input type="text" name="mb_email" placeholder="이메일" value="<?php// echo $mb['mb_email'] ?>"> 기존 php 부분 일부러 놔둠 -->
				</div>

				<div class="imgbox">
					<input type="image" src="img/register_complete.png" name="" value="<?php echo $title ?>">
				</div>

			</div>

			<div style="width:96%; text-align:center;"class="btn"><a style="font-size: 19px;text-decoration:none; color:#fff;" href="./login.php">Cancel</a></div>
	</div>
</form>

<script>
function fregisterform_submit(f) { // submit 최종 폼체크

	if (f.mb_id.value.length < 1) { // 회원아이디 검사
		alert("아이디를 입력하십시오.");
		f.mb_id.focus();
		return false;
	}

	if (f.mb_name.value.length < 1) { // 이름 검사
		alert("이름을 입력하십시오.");
		f.mb_name.focus();
		return false;
	}

	if (f.mb_password.value.length < 3) {
		alert("비밀번호를 3글자 이상 입력하십시오.");
		f.mb_password.focus();
		return false;
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		alert("비밀번호가 같지 않습니다.");
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password_re.focus();
			return false;
		}
	}

	if (f.mb_email.value.length < 1) { // 이메일 검사
		alert("이메일을 입력하십시오.");
		f.mb_email.focus();
		return false;
	}

	if (f.mb_email.value.length > 0) { // 이메일 형식 검사
		var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
		if (f.mb_email.value.match(regExp) == null) {
			alert("이메일 주소가 형식에 맞지 않습니다.");
			f.mb_email.focus();
			return false;
		}
	}

	return true;

// 권햄  한거 경계선


}
</script>

</body>
</html>
