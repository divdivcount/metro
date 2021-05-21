<?php
  require_once("modules/admin.php");
  $dao = new Product;
  $pr_id = Get('id', null);
  echo $pr_id;

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
    <link rel="stylesheet" href="css/css_noamlfont.css">
    <link rel="stylesheet" href="css/admin_product_detail.css">
    <link rel="stylesheet" href="css/bxslider-4-4.2.12/src/css/jquery.bxslider.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
  </head>
  <body>
    <?php $imgdao = $dao->admin_product_list_detail(isset($mb) ? $mb["mb_num"] : 'null', isset($om) ? $om["om_id"] : 'null',$pr_id); ?>
    <!-- 슬라이드 이미지 -->
    <?php foreach ($imgdao as $row) : ?>

    <?php
      $pr_imgs = $row["pr_img"];
      $pr_img = explode(",", $pr_imgs);
      // var_dump($pr_img);
      // print_r( $row);
    ?>
    <div id="wrapPage">
      <div id="content_box">
        <div id="mainProduct_box">

          <div id="slideImg_box">
            <div class="bxslider">
              <?php for($img = 0; $img < count($pr_img); $img++) { ?><div><img src="files\<?= $pr_img[$img] ?>" alt="" ></div><?php } ?>
            </div>
          </div>

          <div id="mainProduct_information">
            <div style="">
              <h4>게시판 상세정보</h4>
              <!--제품 제목  -->
              <div class="title_line"><?= $row["pr_title"] ?></div>
              <!--카테고리와  호선  -->
              <div class="category_line">
                <?= $row["ca_name"] ?>&nbsp&nbsp
                <?= $row["profile_station"] ?>
              </div>
              <!-- 상품 설명  -->
              <div class="explantion_line"><?= $row["pr_explanation"] ?><br></div>
            </div>
            <!-- 신고수 -->
            <div class="report_line">
              신고수 <?=$row["rep_count"]?>
            </div>


          </div>

        </div>

        <div id="button_box">
          <form action="admin_member_detail.php" method="post">
            <input type="hidden" name="om" value="<?=isset($row["om_id"]) ? $row["om_id"] : null ?>">
            <input type="hidden" name="id" value="<?=isset($row["mb_id"]) ? $row["mb_id"] : null ?>">
            <input type="submit" value="회원보기" />
          </form>
          <form method="post">
            <input type="hidden" name= "gap" value="<?php if($row["pr_block"] == 1){echo 2;}else{echo 1;} ?>">
            <input type="submit" name="product_block" id="product_block" value="<?php if($row["pr_block"] == 1){echo "가리기";}else{echo "가리기 풀기";} ?>" />
          </form>
          <form method="post">
            <input type="submit" name="product_del" id="product_del" value="삭제하기" />
          </form>
        </div>
      </div>
    </div>

    <?php endforeach ?>
    <?php
    //제품가리기
      function product_block(){
        $dao = new Product;
        $gap = Post("gap",0);
        $pr_id = Get('id', null);
        $dao->Product_block_update($pr_id, $gap);
      }
      if(array_key_exists('product_block',$_POST))
      {
        $gap = Post("gap",0);
        product_block();
          if($gap == 2){
            userGoto("상품을 숨김처리 하셨습니다", "");
          }else{
            userGoto("상품을 보이게 하셨습니다", "");
          }
      }
      //제품삭제
      function product_del(){
        $dao = new Product;
        $pr_id = Get('id', null);
        // echo $pr_id;
        $dao->admin_product_del($pr_id);
      }
      if(array_key_exists('product_del',$_POST))
      {
        product_del();
        userGoto("상품을 삭제 하셨습니다", "admin_product_list.php");
      }
    ?>
    <script type="text/javascript">
    var slider = $('.bxslider');
    var slider_bx =null;
      $(document).ready(function(){
        var bxslider_img = document.querySelector(".bxslider").getElementsByTagName('img');
        //이미지가 하나이상일때 설정
        if (bxslider_img.length > 1) {
          slider_bx = slider.bxSlider( {
              mode: 'horizontal',// 가로 방향 수평 슬라이드
              speed: 500,        // 이동 속도를 설정
              pager: true,      // 현재 위치 페이징 표시 여부 설정
              pagerCustom: $("#customPager"),
              moveSlides: 1,     // 슬라이드 이동시 개수
              auto: true,        // 자동 실행 여부
              autoHover: false,   // 마우스 호버시 정지 여부
              controls: true    // 이전 다음 버튼 노출 여부
          });

        //이미지가 하나일때 설정  (슬라이드 기능 거의 off)
        }else{
          slider_bx = slider.bxSlider( {
              mode: 'horizontal',// 가로 방향 수평 슬라이드
              speed: 500,        // 이동 속도를 설정
              pager: true,      // 현재 위치 페이징 표시 여부 설정
              pagerCustom: $("#customPager"),
              moveSlides: 1,     // 슬라이드 이동시 개수
              auto: false,        // 자동 실행 여부
              preventDefaultSwipeX: false, // 손가락이 스핑할 때 터치 스크린이 x축이동 여부
              touchEnabled:false, //슬라이더에 터치 swipe 전환을 허용 여부
              autoHover: false,   // 마우스 호버시 정지 여부
              controls: true    // 이전 다음 버튼 노출 여부
          });
        }
    });
    </script>
  </body>
</html>
