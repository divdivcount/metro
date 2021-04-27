<?php
require_once("modules/db.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<link rel="stylesheet" href="css/css_my_one_page.css">
<link rel="stylesheet" href="css/css_noamlfont.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="css/css_metrocket_header.css">
<link rel="stylesheet" href="css/css_metrocket_footer.css">

<style>
.click_box{
  width:100%;
}
</style>
</head>
<body>
  <!-- 상단 메뉴 부분 -->
  <?php
    if(empty($_SESSION['ss_mb_id']) && empty($_SESSION['naver_mb_id']) && empty($_SESSION['kakao_mb_id']) ){
      echo "<script>alert('로그인을 해주세요');</script>";
      echo "<script>location.replace('./index.php');</script>";
    }else{
  ?>
  <!-- 최상단 로고 및 상단메뉴 -->
  <?php
      if(!(empty($_SESSION['ss_mb_id']) || empty($_SESSION['naver_mb_id']) || empty($_SESSION['kakao_mb_id']))){
          echo "123";
      }else{
        if(isset($_SESSION['ss_mb_id'])){
          $mb_id = $_SESSION['ss_mb_id'];
          $sql = " select * from member where mb_id = TRIM('$mb_id') ";
          $result = mysqli_query($conn, $sql);
          $mb = mysqli_fetch_assoc($result);
        }elseif(isset($_SESSION['naver_mb_id'])){
          $om_id = $_SESSION['naver_mb_id'];
          $om_id = substr($om_id, 5);
          $sql = " select * from oauth_member where om_id = TRIM($om_id) ";
          $result = mysqli_query($conn, $sql);
          $om = mysqli_fetch_assoc($result);
        }elseif(isset($_SESSION['kakao_mb_id'])){
          $oms_id = $_SESSION['kakao_mb_id'];
          $oms_id = substr($oms_id, 5);
          $sql = " select * from oauth_member where om_id = TRIM($oms_id) ";
          $result = mysqli_query($conn, $sql);
          $om = mysqli_fetch_assoc($result);
        }
      }
  ?>
  <!-- 최상단 로고 및 상단메뉴 -->
      <?php require_once('metrocket_header.php') ?>
	<div class="w3-content w3-container w3-margin-top" >

    <!-- 유저정보  차후 php 작업 필요 -->
    <div class="profile_box">
      <div class="prfileImg_box">
        <img class="w3-circle" src="<?=$mb['mb_image'] ? $mb['mb_image'] : $om['om_image_url'] ?>" >
        <img src="img/camera.png" style="position:absolute;left:70%;top:70%;" alt="">
      </div>
        <div class="user_name"><?=$mb['mb_name'] ? $mb['mb_name'] : $om['om_nickname']?></div>
    </div>

    <!-- 메인 버튼 -->

    <div class="mainBtn_box">
       <button type="button" class="w3-button w3-round" name="main_button" onclick = "changeIframeUrl('member_update.php','800px')" >회원 정보</button>
       <button type="button" class="w3-button w3-round" name="main_button" onclick = "changeIframeUrl('sangpum.php','1300px')" >판매 상품</button>
       <button type="button" class="w3-button w3-round" name="main_button" onclick = "changeIframeUrl('gansim_sangpum.php','1300px')" >관심 상품</button>
       <button type="button" class="w3-button w3-round" name="main_button" onclick = "changeIframeUrl('buy_sangpum.php','1300px')">구매 상품</button>
    </div>

    <form name="nan" method="post" target="mbs">
      <input type="hidden" name="mba" value="<?=$mb_id?>">
    </form>

    <div class="click_box">
							<iframe style="float:left;" frameborder="0"  id="main_frame" src="member_update.php" height="800px" width="100%"></iframe>
		</div>

	</div>
  <script>
    function changeIframeUrl(url,iframe_width){
        document.getElementById("main_frame").src = url;
        document.getElementById("main_frame").height = iframe_width;
  		}

    var mainBtn = document.getElementsByClassName('w3-button w3-round');
    for (var i = 0; i < 4; i++) {

      mainBtn.item(i).addEventListener('click',(event)=>{
        for (var j = 0; j < 4; j++) {
            mainBtn.item(j).style.background='#e6e6e6';
        }
        event.target.style.background='#fff';
     });
    }
  </script>
  <!-- 하단 메뉴 부분 -->
  <?php require_once 'metrocket_footer.php';?>
</body>
</html>
<?php } ?>
