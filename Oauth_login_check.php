<?php
require_once("modules/db.php");
require_once("modules/notification.php");
require_once("modules/parameter.php");

$naver_id = trim(GET("om_id",0));
$kakao_id = trim(GET("om_id",0));

if(isset($naver_id)){
  $_SESSION['naver_mb_id'] = $naver_id;
  echo $_SESSION['naver_mb_id'];
  // userGoto("로그인 되었습니다.","/index.php?d=$naver_id");
}elseif(isset($kakao_id)){
  $_SESSION['kakao_mb_id'] = $kakao_id;
  echo $_SESSION['kakao_mb_id'];
  // userGoto("로그인 되었습니다.","/index.php?d=$kakao_id");
}else{
  userGoto("Oauth로 로그인되지 않았습니다.", '');
}
?>
