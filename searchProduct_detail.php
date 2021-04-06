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
  </head>
  <body>
    <!-- 상단 메뉴 부분 -->
    <?php
        if(!(empty($_SESSION['ss_mb_id']) || empty($_SESSION['naver_mb_id']) || empty($_SESSION['kakao_mb_id']))){
            echo "123";
        }else{
          if(isset($_SESSION['ss_mb_id'])){
            $mb_id = $_SESSION['ss_mb_id'];
            $sql = " select * from member where mb_id = TRIM('$mb_id') ";
            $result = mysqli_query($conn, $sql);
            $mb = mysqli_fetch_assoc($result);
          }elseif(isset($_SESSION['naver_mb_id'])){
            $om_id = $_SESSION['naver_mb_id'];
            $om_id = substr($om_id, 5);
            $sql = " select * from oauth_member where om_id = TRIM($om_id) ";
            $result = mysqli_query($conn, $sql);
            $om = mysqli_fetch_assoc($result);
          }elseif(isset($_SESSION['kakao_mb_id'])){
            $oms_id = $_SESSION['kakao_mb_id'];
            $oms_id = substr($oms_id, 5);
            echo $oms_id;
            $sql = " select * from oauth_member where om_id = TRIM($oms_id) ";
            $result = mysqli_query($conn, $sql);
            $om = mysqli_fetch_assoc($result);
          }
        }
    ?>
    <?php require_once('metrocket_header.php'); ?>
    <div id="wrapContainer_Box">
      <div id="pageTitle_box" class="radius_box">
        <h2>품목 상세보기</h2>
        <span>채팅하기를 이용해 판매자와 대화할 수 있습니다.</span>
      </div>
      <!-- 슬라이드 이미지 -->
      <div id="slideImg_box">
        <!-- 나중에 php로 동적으로 이미지나오게 작업예정 -->
        <div class="bxslider">
          <div><img src="img\slideimg_1.png" alt=""></div>
          <div><img src="img\slideimg_2.png" alt=""></div>
          <div><img src="img\slideimg_3.png" alt=""></div>
          <div><img src="img\slideimg_4.png" alt=""></div>
          <div><img src="img\slideimg_5.png" alt=""></div>
        </div>
      </div>

      <!-- 상품 및 유저 정보 + 부가기능 부분  -->
      <div id="productInfo_title" class="radiusTop">

        <!-- 첫줄  -->
        <div class="userProfile_line">

          <div class="userProfile">
            <!-- 사람사진 -->
            <div class="profileImg">
              <img src="" alt="">
            </div>

            <!-- 이름이랑 호선  -->
            <div class="pr_namestation">
              <p>김첨지</p>

              <div class="imgPlusText">
                <div class="img_box"><img src="img/maps-and-flags.png" alt=""></div>
                <span>8호선 단대오거리 </span>
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
          <p>김치냉장고 이사로 급처</p>
        </div>

        <!-- 세번째줄  -->
        <div class="productPrice_line">
          <div class="imgPlusText">
            <div class="img_box"><img src="img/tag.png" alt=""></div>
            <span>150,000원</span>
          </div>

          <!-- 가격제안 가능여부 -->
          <div class="checkPricepNegotiation">
            가격제안가능
          </div>
        </div>

        <!-- 4번째줄 -->
        <div class="productCategory_line">

          <!-- 카테고리 내용 -->
          <div class="pr_category">
            카테고리 내용
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
          삼성 아삭아삭 김치 냉장고예요. 2011년 구매했어요~작동 잘되요.<br>
          김치통 2개 같이 드려요.<br>
          <br>
          무게.부피 때문에 직접 가져가셔야해요.<br>
          1층까지는 내려드려요~ 저녁 6시 이후에 거래가능.<br>
          <br>
          교환.환불은 불가해요.<br>
        </p>
      </div>

      <!-- 다른 상품 소개 타이틀 -->
      <div class="otherProduct_title"><h3>이 상품과 비슷한 상품</h3></div>

      <!-- 상품 그리드 박스 -->
      <div class="otherProduct_gridBox">

        <!-- 상품 정보  -->
        <div class="otherProduct_content">
          <!-- 이미지 부분 -->
          <div class="otherProduct_content_img radiusTop">
            <img src="img/games.png" alt="">
          </div>
          <!-- 상품 내용 -->
          <div class="otherProduct_content_text radiusBottom">
            test
          </div>
        </div>
      </div>



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
