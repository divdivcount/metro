<?php
require_once("modules/db.php");
$mb_id = Get("mb",0);
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
      if(empty($mb_id)){
        echo "<script>alert('로그인을 해주세요');</script>";
        echo "<script>location.replace('./login.php');</script>";
      }
      else{
  ?>
  <!-- 최상단 로고 및 상단메뉴 -->
      <div id="topMenu_box">
        <!-- 상단 로고 -->
        <div class="imgbox_1">
          <a href="index.php"><img src="img\mainlogo.png" alt=""></a>
        </div>

        <!-- 상단 툴바 -->
        <div id="topToolbar_box">
          <?php
            if(isset($mb_id)){
              echo "<ul>"."&nbsp;<a href='./User_page.php'><li>상품등록</li></a>"."&nbsp;<a href='./User_page.php'><li>채팅</li></a>"."&nbsp;<a href='./My_one_page.php?mb=$mb_id'><li>마이페이지</li></a>"."&nbsp;<a href='./logout.php'><li>로그아웃</li></a>"."</ul>";
              // echo "일반 아이디";
            }elseif(isset($mb_id)){
              echo "<ul>"."&nbsp;<a href='./User_page.php'><li>상품등록</li></a>"."&nbsp;<a href='./User_page.php'><li>채팅</li></a>"."&nbsp;<a href='./My_one_page.php?mb=$om_id'><li>마이페이지</li></a>"."&nbsp;<a href='./oauth_logout.php'><li>로그아웃</li></a>"."</ul>";
              // echo "네이버 아이디";
            }elseif(isset($mb_id)){
              echo "<ul>"."&nbsp;<a href='./User_page.php'><li>상품등록</li></a>"."&nbsp;<a href='./User_page.php'><li>채팅</li></a>"."&nbsp;<a href='./My_one_page.php?mb=$oms_id'><li>마이페이지</li></a>"."&nbsp;<a href='./oauth_logout.php'><li>로그아웃</li></a>"."</ul>";
              // echo "카카오 아이디";
            }
            else {
              echo "<ul><a href='./login.php'><li>login</li></a></ul>";
            }
           ?>
        </div>
      </div>
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

    <div class="click_box">
							<iframe style="float:left;" frameborder="0"  id="main_frame" src="member_update.php?mb=<?=$mb_id?>" height="1030px" width="100%"></iframe>
		</div>
	</div>

  <!-- 하단 메뉴 부분 -->
  <?php require_once 'metrocket_footer.php';?>
</body>
</html>
<?php } ?>
