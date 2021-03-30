<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/css_addProduct.css">
    <link rel="stylesheet" href="css/css_noamlfont.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <!-- 상단 메뉴 부분 -->
    <?php require_once 'metrocket_header.php'; ?>


    <div id = "wrapContainer_Box">
      <div class="radius_box">

        <div class="title_box">
          <h2><d>*</d>상품등록하기</h2>

          <!-- php 나 스크립트로 뜨게 해야하는 부분 추후 수정 -->
          <span>인증역:0호선 0000역</span>
        </div>

      </div>

      <!--  -->
      <div class="radius_box">

        <div class="title_box">
          <h2><d>*</d>제목입력</h2>
          <span>100자 이하로 입력해 주세요.</span>
        </div>

        <div class="content_box">

        </div>

      </div>

      <!--  -->
      <div class="radius_box">

        <div class="title_box">
          <h2><d>*</d>판매가</h2>
        </div>

        <div class="content_box">

        </div>
      </div>

      <!--  -->
      <div class="radius_box">
        <div class="title_box">
          <h2><d>*</d>카테고리 설정 </h2>
          <span> 원하시는 카테고리를 설정해 주세요.</span>
        </div>

        <div class="content_box">

        </div>
      </div>

      <!--  -->
      <div class="radius_box">
        <div class="title_box">
          <h2><d>*</d>상품이미지 </h2>
          <span> 최소 1개 이상의 이미지를 업로드 해주세요</span>
        </div>

        <div class="content_box">

        </div>
      </div>

      <div class="radius_box">

        <div class="title_box">
          <h2><d>*</d>상세설명</h2>
        </div>

        <div class="content_box">

        </div>

      </div>

      <div class="btn_box">

      </div>

    </div>
    <!-- 푸터 부분  -->
    <?php require_once 'metrocket_footer.php';?>
  </body>
</html>
