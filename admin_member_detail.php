<?php
  require_once("modules/db.php");
  require_once("modules/notification.php");

  $member_id = Post('mb_id', null);
  $oauth_id = Post('om_id', null);
  $name = Get('all', null);
  $mb_om = Get('mball', null);

  if($member_id != null){
    $dao = new Member();
    $lista = $dao->admin_Member_all_select($member_id);
  }elseif($oauth_id != null){
    $dao = new Oauths();
    $listb = $dao->admin_Om_select($oauth_id);
  }elseif ($name != null && $mb_om != null) {
    $dao = new Member();
    $listc = $dao->admin_Member_Search($name, $mb_om);
  }else{
    echo "오류가 발생";
  }
  $list_all = (isset($lista) ? ($lista ? $lista : null) :
              (isset($listb) ? ($listb ? $listb : null) :
              (isset($listc) ? ($listc ? $listc : null) : "값이 없습니다.")));
  // var_dump($list_all)."<br>";
  // echo $member_id."<br>";
  // echo $oauth_id."<br>";
  if(isset($_SESSION['ss_mb_id']) && $_SESSION['ss_mb_id'] !== 'admin'){
    echo "<script>alert('로그인을 해주세요');</script>";
    echo "<script>location.replace('./index.php');</script>";
    exit;
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php foreach ($list_all as $row):?>

      <?php
      // echo "--------------------------------------------<br>";
      //   var_dump(strpos($row["mb_image"], "http"));
      // echo "--------------------------------------------<br>";
      ?>
      <!-- 유저 프로필 뽑히는 곳 -->
      사진 <img src="<?= isset($row["mb_image"]) ? ($row["mb_image"] != "img/normal_profile.png" ? (strpos($row["mb_image"], "http") === 0 ? $row["mb_image"] : "files/".$row["mb_image"]) : $row["mb_image"]) : $row["om_image_url"] ?>"><br>
      이름 <?= isset($row["mb_name"]) ? $row["mb_name"] : $row["om_nickname"] ?><br>
      메일 <?= isset($row["mb_email"]) ? $row["mb_email"] : $row["om_email"]?><br>
      역 <?=$row["line_station"]?><br>
      신고 수<?=$row["rep_count"]?><br>
      경고 수<?=$row["warning_count"]?><br>
      <!-- 버튼 제어 하는 곳 -->
      <form method="post">
        <input type="hidden" name="mem_id" value="<?=isset($row["mb_id"]) ? $row["mb_id"] : null ?>">
        <input type="hidden" name="mom_id" value="<?=isset($row["om_id"]) ? $row["om_id"] : null ?>">
        <input type="hidden" name= "gap" value="<?= (isset($row["mb_block"]) ? $row["mb_block"] : $row["om_block"] ) == 'n' ? 'y' : 'n' ?>">
        <input type="submit" name="mem_block" id="mem_block" value="<?= (isset($row["mb_block"]) ? $row["mb_block"] : $row["om_block"] ) == 'n' ? '차단하기' : '차단해체' ?>" />
      </form>
      <form method="post">
        <input type="hidden" name="mem_id" value="<?=isset($row["mb_id"]) ? $row["mb_id"] : null ?>">
        <input type="hidden" name="mom_id" value="<?=isset($row["om_id"]) ? $row["om_id"] : null ?>">
        <input type="submit" name="warning_send" id="warning_send" value="경고 보내기" />
      </form>
    <?php endforeach ?>
    <?php
    //맴버 차단
      function mem_block(){
        $mem_id = Post("mem_id",null);
        $om_id = Post('mom_id', null);
        $gap = Post("gap",null);
        echo $mem_id;
        //쿼리 짜고 함수 지정
        if(!(is_null($mem_id))){
          $dao = new Member;
          $member = $dao->admin_Member_id_all_select($mem_id);
          // var_dump($member);
          if(is_null($member)){
            // echo "이곳과";
            $dao = new Oauths;
            $other_member = $dao->admin_Om_select($mem_id);
            $dao->admin_Om_block($other_member[0]["om_id"], $gap);
          }else{
            // echo "이곳";
            $dao->admin_mb_block($member[0]["mb_id"], $gap);
          }
        }elseif (!(is_null($om_id))) {
          // echo "저곳";
          $dao = new Oauths;
          $oauth = $dao->admin_Om_select($om_id, $gap);

        }
      }
      if(array_key_exists('mem_block',$_POST))
      {
        $gap = Post("gap",null);
        mem_block();
          if($gap == 'y'){
            userGoto("회원을 차단 하셨습니다", "");
          }else{
            userGoto("회원을 차단해체 하셨습니다", "");
          }
      }
      //경고 보내기
      function product_del(){
        $dao = new Product;
        $pr_id = Get('id', null);
        echo $pr_id;
        $dao->admin_product_del($pr_id);
      }
      if(array_key_exists('product_del',$_POST))
      {
        product_del();
        userGoto("상품을 삭제 하셨습니다", "");
      }
    ?>
  </body>
</html>
