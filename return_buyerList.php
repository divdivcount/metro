<?php
  require_once('modules/db.php');
  $pr_id = $_POST['pr_id'] ? $_POST['pr_id'] : null;

  $sql = "select DISTINCT(me_send_mb_id) from mb_om_memo where pr_id = $pr_id";
  $want_member = mysqli_query($conn, $sql);

  echo '<select name="ctg_name" id="selectID" class="w3-select">';
  echo '<option value="">선택 해주세요</option>';
  while ($rowaa = mysqli_fetch_assoc($want_member)) {
    echo '<option value="'.$rowaa["me_send_mb_id"].'">'.$rowaa["me_send_mb_id"].'</option>';
  }
  echo '</select>';
  echo '<input id="salePrid" type="hidden" name="" value="'.$pr_id.'">';
 ?>
