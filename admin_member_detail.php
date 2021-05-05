<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require_once("modules/db.php");
  require_once("modules/notification.php");
  $dao = new Member();
  $member_id = Post('mb_id', null);
  $oauth_id = Post('om_id', null);
  // echo $member_id."<br>";
  // echo $oauth_id."<br>";
  if(empty($_SESSION['ss_mb_id'])){
    echo "<script>alert('로그인을 해주세요');</script>";
    exit;
  }
?>
