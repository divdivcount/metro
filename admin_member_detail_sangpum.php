<?php
  require_once("modules/db.php");
  require_once("modules/notification.php");
  $mb_id = Get("id", 'null');
  $om_id = Get("om", 'null');
  // echo $mb_id;
  if($mb_id != 'null'){
    $members = new Member();
    $member  = $members->admin_Member_id_all_select($mb_id);
  }
  // echo $om_id;
  $dao = new Product;
  $pid = Get('p', 1);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="w3-content w3-container">

      <!-- 제목 -->

      <?php
        try {
            // $start_s_value = empty($_REQUEST["start_s_value"]) ? "" : $_REQUEST["start_s_value"];
            // $s_value = empty($_REQUEST["s_value"]) ? "" : $_REQUEST["s_value"];
            // if($start_s_value){
            // 	$result = $dao->SelectPageLength($pid, 10, $s_value, $start_s_value);
            //   $list = $dao->SelectPageList($result['current'], 10,$s_value, $start_s_value);
            // }else{

            $result = $dao->SelectPageLength($pid, 8, isset($member[0]['mb_num']) ? $member[0]['mb_num'] : 'null', $om_id,'','');
            $list = $dao->SelectPageList($result['current'], 8, isset($member[0]['mb_num']) ? $member[0]['mb_num'] : 'null', $om_id,'','');
          // }
        } catch (PDOException $e) {
          $result = null;
          $list = null;
         echo $e->getMessage();
        }
      ?>

      <?php if ($list): ?>
      <!-- 상품 나오는 박스  -->
      <h3 class="h3"><?=isset($list[0]["mb_name"]) ? $list[0]["mb_name"] : $list[0]["om_nickname"]?></M>님의 게시글</h3>
      <div class="productList_box">

        <?php foreach ($list as $rows) : ?>

        <div class="productInfo_box">


          <!--   상품 관련 텍스트정보 -->
          <div class="productInfo_part_text">

            <!-- 1. 제목라인 -->
            <div class="productTitle_line">

              <!-- 제목 -->
              <div class="pr_title"><?= $rows['pr_title'] ?></div>
              <!-- 역 -->
              <div class="pr_station"><?= $rows['l_name'] ?> <?= $rows['pr_station'] ?></div>
            </div>


            <!-- 4. 별점과 역정보 라인 -->
            <div class="productRecommendation_line">
              <!-- 별점  -->
              <div class="pr_starcount"><img src="img\star_19x19.png"><?=$rows['i_count'] ?></div>

            </div>

            <div class="hidden">
              신고수<?=$rows["rep_count"]?>
            </div>

          </div>

        </div>
      <?php endforeach ?>



      <div id="pagenation_box"class="w3-center">
          <?php
          if($result['start'] < $result['current'] ) :?>
            <a class="abtn" href="admin_member_detail_sangpum.php?p=<?=($pid - 1)?>&id=<?=$mb_id?>&om=<?=$om_id?>">&lt;</a>
          <?php endif ?>

          <?php for($i=$result['start']; $i<=$result['end']; $i++): ?>
            <a class="abtn <?php if($i === (int)$result['current']) echo 'current' ?>" href="?p=<?= $i ?>&id=<?=$mb_id?>&om=<?=$om_id?>"><?= $i ?></a>
          <?php endfor ?>

          <?php if( $result['end'] > $result['current']) : ?>
            <a class="abtn" href="admin_member_detail_sangpum.php?p=<?=($pid + 1)?>&id=<?=$mb_id?>&om=<?=$om_id?>">&gt;</a>
          <?php endif ?>
      </div>
      <?php else: ?>

        <div id="empty_page">
          <img src="img/sad_back.png" alt="">
          <h4>EMPTY</h4>
          <p>
            <span>고객님의 상품정보가 비어있습니다.</span><br>
            판매 상품을 올리면 정보가 보여집니다.
          </p>
        </div>

    <?php endif; ?>

      </div>

    </div>
  </body>
</html>
