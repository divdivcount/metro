<?php
require_once('modules/db.php');
$dao = new Product;
$pr_id = Get("id", 0);
$pr_title = Get("title",0);
try{
  $imgdao = $dao->searchProduct_detail($pr_id, $pr_title);
}catch(PDOException $e){
    echo $e;
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/bxslider-4-4.2.12/src/css/jquery.bxslider.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/css_searchProduct_detail.css">
    <link rel="stylesheet" href="css/css_noamlfont.css">
    <link rel="stylesheet" href="css/css_metrocket_footer.css">
    <link rel="stylesheet" href="css/css_metrocket_header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="180x180" href="css/favicon_package_v0.16/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="css/favicon_package_v0.16/favicon.ico">
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="css/favicon_package_v0.16/favicon-16x16.png"> -->
    <link rel="manifest" href="css/favicon_package_v0.16/site.webmanifest">
    <link rel="mask-icon" href="css/favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">
  </head>
  <body>
    <!-- 상단 메뉴 부분 -->
    <?php require_once('metrocket_header.php'); ?>
    <div id="wrapContainer_Box">
      <div id="pageTitle_box" class="radius_box">
        <h2>품목 상세보기</h2>
        <span>채팅하기를 이용해 판매자와 대화할 수 있습니다.</span>
      </div>
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
              <img src="<?= $row["profile_img"] ?>" alt="">
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
          <div id="reportBtn_box" class="imgPlusText">
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

            <div class="imgPlusText">
              <div class="img_box"><img src="img/star_19x19.png" alt=""></div>
              <span>관심등록</span>
            </div>

            <div class="imgPlusText">
              <div class="img_box"><img src="img/chat.png" alt=""></div>
              <span>채팅하기</span>
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
    <?php endforeach ?>
    <!-- 댓글이 들어가야하는 부분입니다. -->



      <!-- 다른 상품 소개 타이틀 -->
      <div class="otherProduct_title"><h3>이 상품과 비슷한 상품</h3></div>
      <!-- 상품 그리드 박스 -->
      <!-- 다른 상품들 노출되는 부분임 -->
      <div class="otherProduct_gridBox">

        <!-- 기타 상품 정보  -->
        <!-- 이형식으로 쭉 클래스 긴건 애교로 -->
        <div class="otherProduct_content">

          <!-- 이미지 부분 -->
          <div class="otherProduct_content_img radiusTop">
            <img src="img/games.png" alt="">
          </div>

          <!-- 상품 내용 -->
          <div class="otherProduct_content_text radiusBottom">

            <!-- 제목 -->
            <div class="otherProduct_content_text_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="otherProduct_content_text_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="otherProduct_content_text_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="otherProduct_content_text_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>

          </div>
        </div>

        <!-- 기타 상품 정보  -->
        <!-- 이형식으로 쭉 클래스 긴건 애교로 -->
        <div class="otherProduct_content">

          <!-- 이미지 부분 -->
          <div class="otherProduct_content_img radiusTop">
            <img src="img/games.png" alt="">
          </div>

          <!-- 상품 내용 -->
          <div class="otherProduct_content_text radiusBottom">

            <!-- 제목 -->
            <div class="otherProduct_content_text_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="otherProduct_content_text_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="otherProduct_content_text_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="otherProduct_content_text_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>

          </div>
        </div>

        <!-- 기타 상품 정보  -->
        <!-- 이형식으로 쭉 클래스 긴건 애교로 -->
        <div class="otherProduct_content">

          <!-- 이미지 부분 -->
          <div class="otherProduct_content_img radiusTop">
            <img src="img/games.png" alt="">
          </div>

          <!-- 상품 내용 -->
          <div class="otherProduct_content_text radiusBottom">

            <!-- 제목 -->
            <div class="otherProduct_content_text_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="otherProduct_content_text_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="otherProduct_content_text_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="otherProduct_content_text_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>

          </div>
        </div>

        <!-- 기타 상품 정보  -->
        <!-- 이형식으로 쭉 클래스 긴건 애교로 -->
        <div class="otherProduct_content">

          <!-- 이미지 부분 -->
          <div class="otherProduct_content_img radiusTop">
            <img src="img/games.png" alt="">
          </div>

          <!-- 상품 내용 -->
          <div class="otherProduct_content_text radiusBottom">

            <!-- 제목 -->
            <div class="otherProduct_content_text_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="otherProduct_content_text_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="otherProduct_content_text_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="otherProduct_content_text_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>

          </div>
        </div>

      </div><!-- 그리드 박스의 끝  -->

      <!-- 다른 상품 소개 타이틀 -->
      <div class="otherProduct_title"><h3>판매자의 다른상품</h3></div>
      <!-- 상품 그리드 박스 -->
      <!-- 다른 상품들 노출되는 부분임 -->
      <div class="otherProduct_gridBox">

        <!-- 기타 상품 정보  -->
        <!-- 이형식으로 쭉 클래스 긴건 애교로 -->
        <div class="otherProduct_content">

          <!-- 이미지 부분 -->
          <div class="otherProduct_content_img radiusTop">
            <img src="img/games.png" alt="">
          </div>

          <!-- 상품 내용 -->
          <div class="otherProduct_content_text radiusBottom">

            <!-- 제목 -->
            <div class="otherProduct_content_text_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="otherProduct_content_text_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="otherProduct_content_text_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="otherProduct_content_text_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>

          </div>
        </div>

        <!-- 기타 상품 정보  -->
        <!-- 이형식으로 쭉 클래스 긴건 애교로 -->
        <div class="otherProduct_content">

          <!-- 이미지 부분 -->
          <div class="otherProduct_content_img radiusTop">
            <img src="img/games.png" alt="">
          </div>

          <!-- 상품 내용 -->
          <div class="otherProduct_content_text radiusBottom">

            <!-- 제목 -->
            <div class="otherProduct_content_text_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="otherProduct_content_text_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="otherProduct_content_text_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="otherProduct_content_text_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>

          </div>
        </div>

        <!-- 기타 상품 정보  -->
        <!-- 이형식으로 쭉 클래스 긴건 애교로 -->
        <div class="otherProduct_content">

          <!-- 이미지 부분 -->
          <div class="otherProduct_content_img radiusTop">
            <img src="img/games.png" alt="">
          </div>

          <!-- 상품 내용 -->
          <div class="otherProduct_content_text radiusBottom">

            <!-- 제목 -->
            <div class="otherProduct_content_text_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="otherProduct_content_text_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="otherProduct_content_text_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="otherProduct_content_text_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>

          </div>
        </div>

        <!-- 기타 상품 정보  -->
        <!-- 이형식으로 쭉 클래스 긴건 애교로 -->
        <div class="otherProduct_content">

          <!-- 이미지 부분 -->
          <div class="otherProduct_content_img radiusTop">
            <img src="img/games.png" alt="">
          </div>

          <!-- 상품 내용 -->
          <div class="otherProduct_content_text radiusBottom">

            <!-- 제목 -->
            <div class="otherProduct_content_text_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="otherProduct_content_text_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="otherProduct_content_text_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="otherProduct_content_text_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>

          </div>
        </div>

      </div><!-- 그리드 박스의 끝  -->
    </div>
    <!-- 푸터 부분  -->
    <?php require_once 'metrocket_footer.php';?>
  </body>
  <script type="text/javascript">
    $(document).ready(function(){
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
</html>
