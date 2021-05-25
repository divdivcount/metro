<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require_once("modules/db.php");
  require_once("modules/notification.php");
  //신고 내용
  $conT = Post("check", null);
  //신고하는 사람
  $member_num = Post("member_num", null);
  //신고 받는 사람
  $report_member = Post("report_member", null);
  $pr_id = Post("pr_id", null);
  if(is_null($conT)){
    userGoto("신고 내용을 체크해 주세요","");
    exit;
  }


  if(!(is_null($report_member))){
    $dao = new Oauths;
    // echo $listc[0]['mb_id'];
    $other_member = $dao->admin_Om_select($report_member);
    // var_dump($other_member);
    if(is_null($other_member)){
          $dao = new Member();
          $member  = $dao->admin_Member_id_all_select($report_member);
          // var_dump($member);
    }else{
        // echo "??";
    }
  }


  if($conT === "기타"){

      $otherReason = Post("otherReason", null);

  }else{
    $otherReason = null;
  }
  $reportDao = new Product();
  $reportDao->report_insert(isset($member[0]["mb_id"]) ? $member[0]["mb_id"] : null, isset($other_member[0]["om_id"]) ? $other_member[0]["om_id"] : null, $member_num, $conT, $otherReason, $pr_id);
 //  echo $conT."<br>";
 //  echo $member_num."<br>";
 // echo $report_member."<br>";
 // echo $other_member[0]["om_id"]."<br>";
 // echo $member[0]["mb_id"]."<br>";
 // echo $pr_id."<br>";

?>
