<?php
  require_once('modules/db.php');
  $dao = new Oauths;

  $pr_id = $_POST['pr_id'] ? $_POST['pr_id'] : null;

  $want_member = $dao->memo_select($pr_id);

  if(!(is_null($want_member))){
    $other_member = $dao->admin_Om_select($want_member[0]["me_send_mb_id"]);

    if(is_null($other_member)){
      $dao = new Member;
      $member = $dao->admin_Member_id_all_select($want_member[0]["me_send_mb_id"]);
      // var_dump($member);
      if(is_null($member)){
        // echo "이곳과";
        $dao = new Oauths;
        $other_member = $dao->admin_Om_select($want_member[0]["me_send_mb_id"]);
      }else{
        // echo "이곳";
      }
    }
    var_dump($want_member);
    echo '{"html":"';
    echo "<select name='ctg_name' id='change_selectID ' class='w3-select'>";
    echo '<option>선택 해주세요</option>';
    foreach ($want_member as $rowaa) {
      echo "<option value='";
      echo isset($member[0]["mb_id"]) ? $member[0]["mb_id"] : (isset($other_member[0]["om_id"]) ? $other_member[0]["om_id"] : null);
      echo "'>";
      echo $rowaa["me_send_mb_id"];
      echo "</option>";
    }
    echo '</select>';
    echo "<input id='salePrid' type='hidden' value='".$pr_id."'>";
    echo '","emptyCheck":1}';
  }else{
    echo '{"html":"';
    echo "<div class='img_box'><img src='img/noResult.png'></div>";
    echo "<p>구매요청자가 없습니다.<br>구매 요청자가 있어야 판매완료가 가능합니다.</p>";
    echo "<input id='salePrid' type='hidden' value='".$pr_id."'>";
    echo '","emptyCheck":0}';
  }

 ?>
