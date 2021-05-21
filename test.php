<?php
  require_once('modules/db.php');
  require_once('modules/notification.php');
  $dao = new Oauths;
  $product = new Product_history;
  $pr_id = Post('pr_id',null);
  $selectId = Post('selectId', null);
  $member_check = "";

  if(!(is_null($selectId))){
    $other_member = $dao->admin_Om_select($selectId);
      if(!(is_null($other_member))){
        $member_check = "om_id";
        $product->product_history_update($pr_id,$other_member[0]["om_id"], $member_check);
      }
    if(is_null($other_member)){
      $member_check = "mb_id";
      $dao = new Member;
      $member = $dao->admin_Member_id_all_select($selectId);
          if(!(is_null($member))){
            $product->product_history_update($pr_id,$member[0]["mb_num"], $member_check);
          }
      // var_dump($member);
      if(is_null($member)){
        $member_check = "om_id";
        $dao = new Oauths;
        $other_member = $dao->admin_Om_select($selectId);
        if(!(is_null($other_member))){
          $member_check = "om_id";
          $product->product_history_update($pr_id,$other_member[0]["om_id"], $member_check);
        }
      }else{
        // echo "이곳";
      }
    }
  }
 ?>
