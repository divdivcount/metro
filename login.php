<?php
// Load Modules
require_once("modules/db.php");
require_once('modules/notification.php');
?>

<html>
<head>
	<title>Login</title>
	<link href="css/css_login.css" rel="stylesheet" type="text/css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php if(!isset($_SESSION['ss_mb_id'])) { // 로그인 세션이 있을 경우 로그인 화면 ?>
	<form action="./login_check.php" method="post">
			<div class="login-box">
				<img src="img/metrocket.png" style="width:100%" alt="">
				<div id ="login">회원로그인</div>
				<div class="textbox">
				<input type="text" placeholder="아이디" name="mb_id">
				</div>
			<div class="textbox">
				<input type="password" placeholder="비밀번호" name="mb_password">
			</div>

					<div class="imgbox">
						<input type="image" id ="loginbtn" src="img/login.png">
					</div>

					<a class="text_center" href="">아이디 / 비밀번호 찾기</a>

					<div id="boundarybox">
						<div class="line"></div>
						<div style="width:20%;font-size:1.15em;" >또는</div>
						<div class="line"></div>
					</div>

					<div id="imgbox">
						<img src="img/naver.png" alt="">
						<img src="img/facebook.png" alt="">
						<img src="img/kakao.png" alt="">
						<img src="img/google.png" alt="">
					</div>

					<a class="text_center" href="./register.php">
						아직 회원이 아니신가요? 회원가입
					</a>
				</div>
	</form>

<?php } else { // 로그인 세션이 없을 경우 로그인 완료 화면 ?>
	<?php
	$mb_id = $_SESSION['ss_mb_id'];

	$sql = " select * from member where mb_id = TRIM('$mb_id') ";
	$result = mysqli_query($conn, $sql);
	$mb = mysqli_fetch_assoc($result);

	mysqli_close($conn); // 데이터베이스 접속 종료
	userGoNow('index.php');

 } ?>

</body>
</html>
