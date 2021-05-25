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
  if(!(is_null($member_num))){
    $oauth = new Oauths;
    // echo $listc[0]['mb_id'];
    $member_mb = $oauth->admin_Om_select($member_num);
    // var_dump($member_mb);
    if(is_null($member_mb)){
          $mb_member = new Member;
          $member_mb  = $mb_member->admin_Member_all_select($member_num);
          // var_dump($member);
    }else{
        // echo "??";
    }
  }
  $two_Report_user_rep_name = isset($member_mb[0]["mb_name"]) ? $member_mb[0]["mb_name"] : $member_mb[0]["om_nickname"];
  // echo $two_Report_user_rep_name;
  $reportDao = new Product;
  $two_Report_user = $reportDao->report_select($member_num, $pr_id);
  $two_Report_user_rep_mb = isset($two_Report_user[0]["rep_mb"]) ? $two_Report_user[0]["rep_mb"] : null;
  $two_Report_user_pr_id = isset($two_Report_user[0]["pr_id"]) ? $two_Report_user[0]["pr_id"] : null;
  // var_dump($two_Report_user);
  // var_dump($two_Report_user_rep_name == $two_Report_user_rep_mb);
  // var_dump( $pr_id == $two_Report_user_pr_id);
  if($two_Report_user_rep_name == $two_Report_user_rep_mb && $pr_id == $two_Report_user_pr_id){
    userGoto("이미 한번 신고처리 하셨습니다.", "");
    exit;
  }else{
    if(!(is_null($report_member))){
      // echo $report_member;
      // echo $listc[0]['mb_id'];
      $oauth = new Oauths;
      $member = $oauth->admin_Om_select($report_member);
      // var_dump($member);
      if(is_null($member)){
            $mb_member = new Member;
            $member  = $mb_member->admin_Member_all_select($report_member);
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

    $reportDao->report_insert(isset($member[0]["mb_num"]) ? $member[0]["mb_num"] : null, isset($member[0]["om_id"]) ? $member[0]["om_id"] : null, $member_num, $conT, $otherReason, $pr_id);
   //  echo $conT."<br>";
   //  echo $member_num."<br>";
   // echo $report_member."<br>";
   // echo $other_member[0]["om_id"]."<br>";
   // echo $member[0]["mb_id"]."<br>";
   // echo $pr_id."<br>";
   userGoto("신고처리가 완료되었습니다.", "");
 }
?>
