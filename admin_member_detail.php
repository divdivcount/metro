<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require_once("modules/db.php");
  require_once("modules/notification.php");

  $member_id = Post('mb_id', null);
  $oauth_id = Post('om_id', null);
  $name = Get('all', null);
  $mb_om = Get('mball', null);
  if($member_id != null){
    $dao = new Member();
    $list = $dao->Member_all_select($member_id);
  }elseif($oauth_id != null){
    $dao = new Oauths();
    $list = $dao->Om_select($oauth_id);
  }elseif ($name != null && $mb_om != null) {
    $dao = new Member();
  }else{
    echo "오류가 발생";
  }

  // echo $member_id."<br>";
  // echo $oauth_id."<br>";
  if(empty($_SESSION['ss_mb_id'])){
    echo "<script>alert('로그인을 해주세요');</script>";
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
