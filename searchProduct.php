<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/css_searchProduct.css">
    <link rel="stylesheet" href="css/css_noamlfont.css">
    <link rel="stylesheet" href="css/css_metrocket_footer.css">
    <link rel="stylesheet" href="css/css_metrocket_header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <!-- 상단 메뉴 부분 -->
    <?php require_once('metrocket_header.php'); ?>

    <!-- 메인 컨테이너  -->
    <div id = "wrapContainer_Box">

      <!-- 상단 title 박스  -->
      <div id="pageTitle_box" class="radius_box">
        <h2>중고품목 매물보기</h2>
        <span>카테고리를 활용해 매물을 검색해 보세요</span>

        <!-- 검색관련 input 박스 -->
        <div id="search_box">
          <div id="search_TextPart">

            <select class="w3-select" name="">
              <option>나는찬규가좋아</option>
            </select>

            <input type="text" name="" value="">
          </div>

          <!-- 검색버튼  -->
          <input type="image" src="img/search_icon.png" name="" value="">
        </div>

        <!-- 역이나 호선 동적으로 나오는 부분 -->
        <div id="selectedStation">

        </div>

        <!-- 호선 및 역별 선택 버튼 -->
        <div class="btn_box">
          <input class="w3-button w3-blue w3-round-large" type="submit" name="" value="완료">
          <input class="w3-button w3-round-large" type="button" name="" value="취소">
        </div>
      </div>

      <!-- n 호선 및  n 역 상품 타이틀 -->
      <div id="productTitle">
        <div class="line"></div>
        <p><span>8호선</span> 모든 최신매물</p>
        <div class="line"></div>
      </div>

      <!-- 상품 목록 그리드 박스  -->
      <div id="productGrid_box">

        <!-- 상품 예시 샘플 php로 띄울거임 -->
        <div class="productInfo_box">
          <!-- 상품 이미지부분 -->
          <div class="productImg_box">
            <img src="img/chair@2x.png" alt="">
          </div>

          <!-- 상품 상세설명 -->
          <div class="productText_box">

          </div>
        </div>
        <!-- 상품 예시 샘플 php로 띄울거임 -->
        <div class="productInfo_box">
          <!-- 상품 이미지부분 -->
          <div class="productImg_box">
            <img src="img/chair@2x.png" alt="">
          </div>

          <!-- 상품 상세설명 -->
          <div class="productText_box">
            <div class="productText_title">제목</div>
            <div class="productText_recommend"><img src="img/star.png" alt="">n</div> <!-- 추천수 php  -->
            <div class="productText_price">가격</div>
            <div class="productText_category">카테고리</div>
            <div class="productText_station">위치</div>
          </div>
        </div>


        <!-- 상품 예시 샘플 php로 띄울거임 -->
        <div class="productInfo_box">
          <!-- 상품 이미지부분 -->
          <div class="productImg_box">
            <img src="img/chair@2x.png" alt="">
          </div>

          <!-- 상품 상세설명 -->
          <div class="productText_box">

          </div>
        </div>
        <!-- 상품 예시 샘플 php로 띄울거임 -->
        <div class="productInfo_box">
          <!-- 상품 이미지부분 -->
          <div class="productImg_box">
            <img src="img/banner.png" alt="">
          </div>

          <!-- 상품 상세설명 -->
          <div class="productText_box">

          </div>
        </div>

      </div>


      <!-- 페이지 네이션 들어가는 부분 -->
      <div id="pagination">
        <!-- 페이지 네이션 아마도 a 태그로 들어오겠지요? a 에 css 줬습니다 -->
        <!-- 버튼은 일단 보류 왜냐하면 php 로 다루는게 좋을지 js 다룰건지 미정이므로 형님
         코드에 편한대로   -->
        <a href="#">1</a>
        <a href="#">2</a>
      </div>

    </div>

    <!-- 푸터 부분  -->
    <?php require_once('metrocket_footer.php');?>

  </body>
</html>
