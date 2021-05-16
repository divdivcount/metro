<?php
  require_once('modules/db.php');
  $dao = new Oauths;

  $pr_id = $_POST['pr_id'] ? $_POST['pr_id'] : null;


  $want_member = $dao->memo_select($pr_id);
  $other_member = $dao->admin_Om_select($want_member["me_send_mb_id"]);
  echo '<select name="ctg_name" id="selectID" class="w3-select">';
  echo '<option value="">선택 해주세요</option>';
  foreach ($want_member as $rowaa) {
    // code...
    echo '<option value="'.$rowaa["me_send_mb_id"].'">'.$other_member[0]["om_nickname"].'</option>';
  }


  echo '</select>';
  echo '<input id="salePrid" type="hidden" name="" value="'.$pr_id.'">';
 ?>
