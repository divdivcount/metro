<?php
require_once("modules/db.php");
  if(empty($_SESSION['ss_mb_id']) && empty($_SESSION['naver_mb_id']) && empty($_SESSION['kakao_mb_id']) ){
    echo "<script>alert('로그인을 해주세요');</script>";
    echo "<script>location.replace('./login.php');</script>";
  }else{
?>
<?php
if(isset($_SESSION['ss_mb_id'])){
  $mb_ids = $_SESSION['ss_mb_id'];
  $sql = " SELECT * FROM member WHERE mb_id = '$mb_ids' ";
  $result = mysqli_query($conn, $sql);
  $mb = mysqli_fetch_assoc($result);
  $mb_id = $mb['mb_num'];
  echo  $mb_id;
}elseif(isset($_SESSION['naver_mb_id'])){
  $mb_ids = $_SESSION['naver_mb_id'];
  $mb_ids = substr($mb_ids, 5);
  $sql = " SELECT * FROM oauth_member WHERE om_id = $mb_ids ";
  $result = mysqli_query($conn, $sql);
  $om = mysqli_fetch_assoc($result);
  $mb_id = $om['om_id'];
  echo  $mb_id;
}elseif(isset($_SESSION['kakao_mb_id'])){
  $mb_ids = $_SESSION['kakao_mb_id'];
  $mb_ids = substr($mb_ids, 5);
  $sql = " SELECT * FROM oauth_member WHERE om_id = $mb_ids ";
  $result = mysqli_query($conn, $sql);
  $om = mysqli_fetch_assoc($result);
  $mb_id = $om['om_id'];
  echo  $mb_id;
}else{
  ?>
  <script>
    alter("어느것도 로그인되지 않았습니다.");
    location.replace("./index.php");
  </script>
  <?php
}
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
<?php
// echo $mb["mb_id"] ? $mb["mb_id"] : $om["om_id"];
// echo $mb["mb_name"] ? $mb["mb_name"] : $om["om_nickname"];
// echo $mb["mb_email"] ? $mb["mb_email"] : $om["om_email"];
?>
<div class="w3-container">
    <h3 class="h3">회원정보 수정</h3>
  <div>
    <form id="pwForm" name="frm1" class="p_container_margin" action="register_update.php" method="post">
      <p>
          <input type="hidden" name="mode" value="modify">
          <span>아이디</span><input class="input_id" type="text" id="id" name="id" readonly value="<?= $mb["mb_id"] ? $mb["mb_id"] : $om["om_id"] ?>">
      </p>
      <p>
        <label>*현재 비밀번호</label>
        <input class="input_password" id="old_pw" name="old_pw" type="password" <?php echo ($mb["mb_id"] ? "" : "readonly") ?> required >
      </p>
      <p>
        <label>*새 비밀번호</label>
        <input class="input_new_password" name="mb_password" type="password" <?php echo ($mb["mb_id"] ? "" : "readonly") ?> required>
      </p >
      <label>*비밀번호 확인</label>
        <input class="input_new_exisit_password" name="mb_password_re" type="password" <?php echo ($mb["mb_id"] ? "" : "readonly") ?> required>
      <p>
        <label>이름</label>
        <input class="input_name" type="text" id="name" name="mb_name" value="<?=$mb["mb_name"] ? $mb["mb_name"] : $om["om_nickname"] ?>"  readonly required>
      </p>
      <p>
        <label>이메일</label>
        <input class="input_email" type="text" id="email" name="mb_email" value="<?=$mb["mb_email"] ? $mb["mb_email"] : $om["om_email"] ?>"  readonly required>
      </p>
      </form>
      <p class="p_container_margin">
        <label>*주변 역 설정하기</label>
        <input class="input_station" type="text" id="pw2" required>	<button type="submit" id="joinBtn" class="w3-button w3-tiny w3-light-gray w3-round">역 검색</button>
      </p>
      <p class="w3-center button_contatiner_margin">
        <button type="submit" id="joinBtn" class="w3-button  w3-blue w3-ripple w3-margin-top w3-round" onclick="document.getElementById('pwForm').submit();">비밀번호 변경</button>
        <button type="button" id="joinBtn" class="w3-button w3-dark-gray w3-ripple w3-margin-top w3-round">회원 탈퇴</button>
      </p>
  </div>
</div>
</body>
</html>
<?php } ?>
