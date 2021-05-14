<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require_once("modules/db.php");
  require_once("modules/notification.php");

  $pr_id = Post("pr_id", 0);
  $member_checkId = Post("selectId", null);
  echo $pr_id;
  echo $member_checkId;
  if(!(is_null($member_checkId))){
    $dao = new Member;
    $member = $dao->admin_Member_id_all_select($member_checkId);
    // var_dump($member);
    if(is_null($member)){
      // echo "이곳과";
      $dao = new Oauths;
      $other_member = $dao->admin_Om_select($member_checkId);
    }else{
      // echo "이곳";
    }
  }elseif (!(is_null($om_id))) {
    // echo "저곳";
    $dao = new Oauths;
    $oauth = $dao->admin_Om_select($om_id, $gap);

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
