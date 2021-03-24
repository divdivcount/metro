<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>매트로켓</title>
    <link rel="stylesheet" href="css\css.index.css">
    <link rel="stylesheet" href="css/css_noamlfont.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  </head>
  <body>
    <!-- 최상단 로고 및 상단메뉴 -->
    <div id="topMenu_box">

      <!-- 상단 로고 -->
      <div class="imgbox_1">
        <a href="index.php"><img src="img\mainlogo.png" alt=""></a>
      </div>

      <!-- 상단 툴바 -->
      <div id="topToolbar_box">
        <ul>
          <li>상품등록</li>
          <li>내상품</li>
          <li>채팅</li>
          <li>프로필</li>
        </ul>
      </div>



    </div>

    <!-- 메인 배너이미지 부분 -->
    <div id="bannerImg_box">

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

    </div>

    <!-- 매트로켓 장점 소개 부분  -->
    <div id="advantages_box">
      <div class="titleText_1">
        왜 매트로켓이 좋을까요
      </div>
      <div class="textStyle_1">

      </div>
      <div class="explain_box">

      </div>


    </div>

    <!-- 푸터박스 -->
    <div id="footer_box">
      <div id="information_box">

      </div>
      <div class="line">

      </div>
      <div class="imgbox_1">


      </div>
    </div>







    <!-- <div>
      <form class="" action="index.php" method="post">
        <input type="text"  id="search_box"  placeholder="자동완성" />
        <input type="submit"/>
      </form>
    </div> -->
  </body>
  <script>

  var link = 'http://localhost/index.php?'

  $("#testInput").autocomplete({
      source : function(request, response) {
          $.ajax({
                url : "autocomplete_keyword.php"
              , type : "GET"
              , data : {keyword : $("#search_box").val()} // 검색 키워드
              , success : function(data){ // 성공
                  response(
                      $.map(data, function(item) {//써보고 추후 업데이트 요망
                          return {
                                label : item.testNm    //목록에 표시되는 값
                              , value : item.testNm    //선택 시 input창에 표시되는 값
                          };
                      })
                  );    //response
              }
              ,
              error : function(){ //실패
                  alert("통신에 실패했습니다.");
              }
          });
      }
      , minLength : 1
      , autoFocus : false
      , select : function(evt, ui) {
        //검색 부분 자동완성 키워드 url 뒤에 붙여서 전달
        link += ui.item.value;
        location.href=link;
        //----------
        //  console.log("전체 data: " + JSON.stringify(ui));
        //  console.log("db Index : " + ui.item.idx);
        //  console.log("검색 데이터 : " + ui.item.value);
      }
      , focus : function(evt, ui) {
          return false;
      }
      , close : function(evt) {
      }
  });

</script>
</html>
