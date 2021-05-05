<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require_once("modules/db.php");
  require_once("modules/notification.php");
  $dao = new Product;
  $pr_id = Get('id', null);
  echo $pr_id;

  if(empty($_SESSION['ss_mb_id'])){
    echo "<script>alert('로그인을 해주세요');</script>";
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/bxslider-4-4.2.12/src/css/jquery.bxslider.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
  </head>
  <body>
    <?php $imgdao = $dao->searchProduct_detail(isset($mb) ? $mb["mb_num"] : 'null', isset($om) ? $om["om_id"] : 'null',$pr_id); ?>
    <!-- 슬라이드 이미지 -->
    <?php foreach ($imgdao as $row) : ?>

    <?php
      $pr_imgs = $row["pr_img"];
      $pr_img = explode(",", $pr_imgs);
      // var_dump($pr_img);
      // print_r( $row);
    ?>
    <div id="slideImg_box">
      <!-- 나중에 php로 동적으로 이미지나오게 작업예정 -->

      <div class="bxslider">
        <?php for($img = 0; $img < count($pr_img); $img++) { ?><div><img src="files\<?= $pr_img[$img] ?>" alt="" ></div><?php } ?>
      </div>

    </div>
    <!-- 상품 및 유저 정보 + 부가기능 부분  -->
    <div id="productInfo_title" class="radiusTop">

      <!-- 첫줄  -->
      <div class="userProfile_line">

        <div class="userProfile">
          <!-- 사람사진 -->
          <div class="profileImg">
            <img class=" w3-circle" src="<?= $mb['mb_image'] ?($mb['mb_image'] == 'img/normal_profile.png' ? $mb['mb_image'] : 'files/'.$mb['mb_image']) : $om['om_image_url'] ?>" alt="">
          </div>

          <!-- 이름이랑 호선  -->
          <div class="pr_namestation">
            <p><?= $row["profile_name"] ?></p>

            <div class="imgPlusText">
              <div class="img_box"><img src="img/maps-and-flags.png" alt=""></div>
              <span><?= $row["profile_station"] ?></span>
            </div>

          </div>
        </div>

        <!-- 신고하기 버튼  -->
        <div id="reportBtn_box" class="imgPlusText" onclick="report_open()">
          <div class="img_box"><img src="img/siren.png" alt=""></div>
          <span>신고하기</span>
        </div>
      </div>

      <!-- 두번째줄 -->
      <div class="productTitle_line">
        <p><?= $row["pr_title"] ?></p>
      </div>

      <!-- 세번째줄  -->
      <div class="productPrice_line">
        <div class="imgPlusText">
          <div class="img_box"><img src="img/tag.png" alt=""></div>
          <span><?= $row["pr_price"] ?>원</span>
        </div>

        <!-- 가격제안 가능여부 -->
        <div class="checkPricepNegotiation">
          <?php if($row["pr_check"] == 1){echo "가격제안 가능";}else{} ?>
        </div>
      </div>

      <!-- 4번째줄 -->
      <div class="productCategory_line">

        <!-- 카테고리 내용 -->
        <div class="pr_category">
          <?= $row["ca_name"] ?> · 관심 <?= $row["i_count"] ?>
        </div>

        <div id="extraBtn_box">

          <div class="imgPlusText">
            <div class="img_box"><img src="img/flag.png" alt=""></div>
            <span>도착시간</span>
          </div>

          <div class="imgPlusText" onclick="registerInterest()">
            <!-- 여기 관심등록 -->
            <div class="img_box" > <img src="<?php if($row["mem_i_check"] == 0){echo "img/staroff_19x19.png";}elseif($row["mem_i_check"] == 1){echo "img/star_19x19.png";} ?>" id="star_btn" data-value="<?=$row["mem_i_check"] ? $row["mem_i_check"] : 0 ?>" alt="" ></div>
            <span>관심등록</span>
          </div>

          <div class="imgPlusText">
            <div class="img_box"><img src="img/chat.png" alt=""></div>
            <span><a href="./memo_form.php?me_recive_mb_id=<?php
            try{
              $member = new Member;
              if($row['mb_id']){
                $mb_name = $member->Member_Select($row['mb_id'] ? $row['mb_id'] : null);
                echo trim($mb_name[0]['mb_id']);
              }else{
                echo trim("sir".$row['om_id']);
              }

            }catch(PDOException $e){
                echo $e;
              }
            ?>&id=<?=$row["pr_id"]?>" class="td_btn" onclick="win_memo(this.href); return false;">쪽지보내기</a></span>
          </div>

        </div>
      </div>
    </div>

    <!-- 상품 설명  -->
    <div id="productInfo_text" class="radiusBottom">
      <p>
        <?= $row["pr_explanation"] ?>
      </p>
    </div>

    <?php
     $piec = explode("&nbsp;", $row["profile_station"]);
     // echo $piec[1];
     ?>

    <?php endforeach ?>
    <script type="text/javascript">
      $(document).ready(function(){

        $("#rep_btn").click(function() {
          $.ajax({
            url : "reply_ok.php",
            type : "get",
            data : {
              "bno" : $(".bno").val(),
              "mb_id" : $(".mb_dat_user").val(),
              "om_id" : $(".om_dat_user").val(),
              "rep_con" : $(".rep_con").val()
            },
            success : function(data) {
            alert("댓글이 작성되었습니다");
            location.reload();
          },
          error : function(e){
            alert("로그인을 먼저 해주세요");
            location.repleace("./index.php");
          }
          });
        })

        $(".dat_del_btn").click(function() {
          $("#rep_del").modal();
        });

        $('.bxslider').bxSlider( {
            mode: 'horizontal',// 가로 방향 수평 슬라이드
            speed: 500,        // 이동 속도를 설정
            pager: true,      // 현재 위치 페이징 표시 여부 설정
            moveSlides: 1,     // 슬라이드 이동시 개수
            auto: true,        // 자동 실행 여부
            autoHover: false,   // 마우스 호버시 정지 여부
            controls: true    // 이전 다음 버튼 노출 여부
        });
    });
    </script>
  </body>
</html>
