<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require_once("modules/db.php");
  require_once("modules/notification.php");

  $check = $_GET["check"];
  foreach ($check as $value) {
    echo $value;
  }
  $otherReason="";
  // $otherReason = $_GET["otherReason"] ? $_GET["otherReason"] : "null";
if(isset($_GET["otherReason"])){
    $otherReason =  $_GET["otherReason"];
  }
  echo $otherReason;


  // $pr_id = Post('pr_id', null);
  // echo $pr_id;

  //pr + mb or om 인거 있으면 한 품목에 관해서 하나의 신고만 가능
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
