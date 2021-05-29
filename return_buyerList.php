<?php
  require_once('modules/db.php');
  $dao = new Oauths;

  $pr_id = $_POST['pr_id'] ? $_POST['pr_id'] : null;

  $want_member = $dao->memo_select($pr_id);
  // var_dump($want_member);
  if(!(is_null($want_member))){

    foreach ($want_member as $key => $value) {

      $dao = new Oauths;
      $other_member = $dao->admin_Om_select($value["me_send_mb_id"]);

      if (is_null($other_member)) {
        $dao = new Member;
        $result_member[$key] = $dao->admin_Member_id_all_select($value["me_send_mb_id"]);
      }else if(!is_null($other_member)){
        $dao = new Oauths;
        $result_member[$key] = $dao->admin_Om_select($value["me_send_mb_id"]);
      }
    }
    // var_dump($result_member);

    echo '{"html":"';
    echo "<select id='selectID' class='fancy_SelectBuyerSelectBox'>";
    echo "<option value='0' selected='selected' data-skip='1'>구매자를 선택해주세요.</option>";
    // for ($i=0; $i < count($result_member); $i++) {
    //   echo "<option data-value='";
    //   echo isset($result_member[$i]["mb_id"]) ? $result_member[$i]["mb_id"] : (isset($result_member[$i]["om_id"]) ? $other_member[$i]["om_id"] : null);
    //   echo "' data-icon='";
    //   echo isset($result_member[$i]["mb_image"]) ? $result_member[$i]["mb_image"] : $result_member[$i]["om_iamge_url"];
    //   echo "' data-html-text='".$rowaa["me_send_mb_id"]."'>";
    //   echo $rowaa["me_send_mb_id"];
    //   echo "</option>";
    // }
    for ($i=0; $i < count($result_member); $i++) {
      // var_dump($result_member[$i][0]["mb_id"]);
      echo "<option data-value='";
      echo isset($result_member[$i][0]["mb_id"]) ? $result_member[$i][0]["mb_id"] : (isset($result_member[$i][0]["om_id"]) ? $result_member[$i][0]["om_id"] : null);
      echo "' data-icon='";
      echo isset($result_member[$i][0]["mb_image"]) ? ($result_member[$i][0]["mb_image"] == 'img/normal_profile.png' ? $result_member[$i][0]["mb_image"] : 'files/'.$result_member[$i][0]["mb_image"]) : (isset($result_member[$i][0]["om_image_url"]) ? $result_member[$i][0]["om_image_url"] : null) ;
      echo "' data-html-text='".$want_member[$i]["me_send_mb_id"]."'>";
      echo $want_member[$i]["me_send_mb_id"];
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
