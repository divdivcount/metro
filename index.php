<?php
require_once('modules/db.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>매트로켓</title>
    <link rel="stylesheet" href="css/css_index.css">
    <link rel="stylesheet" href="css/css_noamlfont.css">
    <link rel="stylesheet" href="css/bxslider-4-4.2.12/src/css/jquery.bxslider.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="css/bxslider-4-4.2.12/src/js/jquery.bxslider.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->
  </head>
  <body>
    <?php
        if(!(empty($_SESSION['ss_mb_id']) || empty($_SESSION['naver_mb_id']) || empty($_SESSION['kakao_mb_id']))){
            echo "";
        }else{
          if(isset($_SESSION['ss_mb_id'])){
            $mb_id = $_SESSION['ss_mb_id'];
            $sql = " select * from member where mb_id = TRIM('$mb_id') ";
            $result = mysqli_query($conn, $sql);
            $mb = mysqli_fetch_assoc($result);
            mysqli_close($conn); // 데이터베이스 접속 종료
          }elseif(isset($_SESSION['naver_mb_id'])){
            $om_id = $_SESSION['naver_mb_id'];
            $sql = " select * from oauth_member where om_id = TRIM($om_id) ";
            $result = mysqli_query($conn, $sql);
            $naver = mysqli_fetch_assoc($result);
            mysqli_close($conn); // 데이터베이스 접속 종료
          }elseif(isset($_SESSION['kakao_mb_id'])){
            $oms_id = $_SESSION['kakao_mb_id'];
            $sql = " select * from oauth_member where om_id = TRIM($oms_id) ";
            $result = mysqli_query($conn, $sql);
            $kakao = mysqli_fetch_assoc($result);
            mysqli_close($conn); // 데이터베이스 접속 종료
          }
        }
    ?>

    <!-- 상단 메뉴 부분 -->
    <?php require_once 'metrocket_header.php'; ?>


    <!-- 메인 배너이미지 부분 -->
    <div id="bannerImg_box">
      <img src="img\banner.png" class="imgbox_2">
      <!-- 이중select box 로 지하철역 선택하는 부분 -->
      <div id="selectMetro_box">

      </div>
    </div>

    <!-- 인기매물 카테고리 아이콘 부분 -->
    <div id="mainContent_box">
      <div class="titleText_1">
        인기매물 카테고리
      </div>

      <!-- 아이콘 들어오는 부분 -->
      <div id="icon_box">

      </div>
    </div>

    <!-- 슬라이드 이미지 부분  -->
    <div id="slideImg_box">

      <!-- 나중에 php로 동적으로 이미지나오게 작업예정 -->
      <div class="slider">
        <div><img src="img\slideimg_1.png" alt=""></div>
        <div><img src="img\slideimg_2.png" alt=""></div>
        <div><img src="img\slideimg_3.png" alt=""></div>
        <div><img src="img\slideimg_4.png" alt=""></div>
        <div><img src="img\slideimg_5.png" alt=""></div>
      </div>

    </div>

    <!-- 매트로켓 장점 소개 부분  -->
    <div id="advantages_box">

      <!-- 타이틀  -->
      <div class="titleText_1">
        왜 매트로켓이 좋을까요
      </div>
      <div class="textStyle_1">
        메트로켓은 가장 실용성있는 중고거래사이트 입니다.
      </div>

      <!-- 텍스트 박스 4개  -->
      <div id="explain_box">

        <div class="textBox_1">
          <ul class="leftLine">
            <li><span>비대면 거래</span></li>
            <li>필요에 따라 물품 보관함을 이용해 비대면 거래를 이용할 수 있습니다.</li>
          </ul>
          <div class="imgbox_3"><img src="img\locker.png" alt=""></div>
        </div>

        <div class="textBox_1">
          <div class="imgbox_3"><img src="img\time.png" alt=""></div>
          <ul class="rightLine">
            <li><span>도착시간</span></li>
            <li>메트로켓은 출발시간에 맞춰서 도착시간을 알려줍니다.</li>
          </ul>
        </div>

        <div class="textBox_1">
          <ul class="leftLine">
            <li><span>지하철역 거래</span></li>
            <li>인증받은 주변 역을 중심으로 품목들을 볼 수 있고, 호선을 선택하여 다양한 물품들을 검색할 수 있습니다.</li>
          </ul>
          <div class="imgbox_3"><img src="img\train.png" alt=""></div>
        </div>

        <div class="textBox_1">
          <div class="imgbox_3"><img src="img\shield.png" alt=""></div>
          <ul class="rightLine">
            <li><span>안전거래</span></li>
            <li>실시간으로 물건을 직접 보고 거래하여 안전하게 거래를 이용할 수 있습니다.</li>
          </ul>
        </div>

      </div>

    </div>
    <?php require_once 'metrocket_footer.php';?>


    <!-- <div>
      <form class="" action="index.php" method="post">
        <input type="text"  id="search_box"  placeholder="자동완성" />
        <input type="submit"/>
      </form>
    </div> -->
  </body>
  <script>
  //슬라이드 이미지
  $(document).ready(function(){
    $('.slider').bxSlider({
      auto: true, speed: 500, pause: 4000, mode:'fade', autoControls: true, pager:true,
    });




  });


  // var link = 'http://localhost/index.php?'
  //
  // $("#testInput").autocomplete({
  //     source : function(request, response) {
  //         $.ajax({
  //               url : "autocomplete_keyword.php"
  //             , type : "GET"
  //             , data : {keyword : $("#search_box").val()} // 검색 키워드
  //             , success : function(data){ // 성공
  //                 response(
  //                     $.map(data, function(item) {//써보고 추후 업데이트 요망
  //                         return {
  //                               label : item.testNm    //목록에 표시되는 값
  //                             , value : item.testNm    //선택 시 input창에 표시되는 값
  //                         };
  //                     })
  //                 );    //response
  //             }
  //             ,
  //             error : function(){ //실패
  //                 alert("통신에 실패했습니다.");
  //             }
  //         });
  //     }
  //     , minLength : 1
  //     , autoFocus : false
  //     , select : function(evt, ui) {
  //       //검색 부분 자동완성 키워드 url 뒤에 붙여서 전달
  //       link += ui.item.value;
  //       location.href=link;
  //       //----------
  //       //  console.log("전체 data: " + JSON.stringify(ui));
  //       //  console.log("db Index : " + ui.item.idx);
  //       //  console.log("검색 데이터 : " + ui.item.value);
  //     }
  //     , focus : function(evt, ui) {
  //         return false;
  //     }
  //     , close : function(evt) {
  //     }
  // });

</script>
</html>
