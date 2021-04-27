<?php
require_once('modules/db.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" href="css/css_index.css">
    <link rel="stylesheet" href="css/css_noamlfont.css">
    <link rel="stylesheet" href="css/bxslider-4-4.2.12/src/css/jquery.bxslider.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/css_metrocket_header.css">
    <link rel="stylesheet" href="css/css_metrocket_footer.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/OwlCarousel2-2.3.4/docs/assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="css/OwlCarousel2-2.3.4/docs/assets/owlcarousel/assets/owl.theme.default.min.css">

    <link href="css/css_login.css" rel="stylesheet" type="text/css">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="180x180" href="css/favicon_package_v0.16/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="css/favicon_package_v0.16/favicon.ico">
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="css/favicon_package_v0.16/favicon-16x16.png"> -->
    <link rel="manifest" href="css/favicon_package_v0.16/site.webmanifest">
    <link rel="mask-icon" href="css/favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">

    <!-- js  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unpkg.com/hangul-js" type="text/javascript"></script>
    <script src="css/OwlCarousel2-2.3.4/docs/assets/owlcarousel/owl.carousel.min.js"></script>

    <style>
      .ui-helper-hidden-accessible{display:none;}
    </style>
  </head>
  <body>
    <!-- 상단 메뉴 부분 -->
    <?php require_once('metrocket_header.php'); ?>
    <div class="modal hidden">
      <div class="bg">
        <div class="test_modal">

          <div class="modalBox">

            <div class="closeBtn_box"><img src="img/cancle.png" class="closeBtn"></div>

            <?php require_once('login.php'); ?>
          </div>

        </div>
      </div>
   </div>

    <!-- 메인 배너이미지 부분 -->
    <div id="bannerImg_box">
      <div class="bxslider">
        <div><img src="img\slideimg_1.png" alt=""></div>
        <div><img src="img\slideimg_2.png" alt=""></div>
        <div><img src="img\slideimg_3.png" alt=""></div>
        <div><img src="img\slideimg_4.png" alt=""></div>
      </div>
      <!-- 이중select box 로 지하철역 선택하는 부분 -->
        <form  id="selectMetro_box" action="searchProduct.php" method="get">
          <div id="bothFind_item">

          <div class="find_item">
            <span>호선을 선택해 주세요.</span>
            <select name="ctg_name" id="selectID" class="w3-select">
              <option value="">선택 해주세요</option>
              <option value="all">전체</option>
              <?php
              $sql = " select * from line";
              $station_result = mysqli_query($conn, $sql);  //여기

              while ($row = mysqli_fetch_assoc($station_result)) { //여기
              ?>
              <option value="<?=$row["l_id"]?>"><?=$row["l_name"]?></option>
            <?php }
            mysqli_close($conn);
            ?>
            </select>
          </div>

          <div class="find_item">
            <span>지하철역을 입력해주세요.</span>
            <div style="display:flex"><input id="auto" class="w3-input highlight" name = "ctg_station"  type="text"><div style="width:1.3rem;margin:auto"><img src="img\loupe.png" alt=""></div></div>
          </div>

        </div>

        <button type="submit" class="w3-button w3-blue w3-ripple w3-round-xxlarge" >물건보러가기</button>
      </form>
    </div>

    <!-- 인기매물 카테고리 아이콘 부분 -->
    <div id="mainContent_box">

      <div class="titleText_1">인기매물 모아보기</div>
      <div class="textStyle_1">인기 카테고리 별로 인기 매물을 확인해 보세요!</div>

      <div id="main_tapmenu">
        <div class="tapmenuItem">디지털/가전</div>
        <div class="tapmenuItem">생활/가공식품</div>
        <div class="tapmenuItem">게임/취미</div>
      </div>


      <div class="owl-carousel" id="owl-carousel">

      </div>

      <div class="customBtn">
        <img src="img/prev_black.png" class="customPrevBtn" alt="">
        <img src="img/next_black.png" class="customNextBtn" alt="">
      </div>
    </div>


    <!-- 배너이미지 2 -->
    <div class="contentImg_box" id="c_img01">

      <!-- 이미지  -->
      <div class="contentImg_img">
        <img src="img/bannerImg_1.png" id="img01" alt="">
      </div>

      <!-- 텍스트 부분 -->
      <div class="contentImg_text">
        <h5>Metroket</h5>
        <p>
          누구나 손쉽게 거래 하는<br>
          취향저격 중고거래 사이트
        </p>
        <span>메트로켓을 통해 필요하고 원하는 물품을 값 싸고 빠르게 얻어보세요.</span>
      </div>
    </div>

    <!-- 최신매물 나오는 부분 -->
    <div id="subContent_box">

      <div class="titleText_1">최신매물 모아보기</div>

      <div class="blue_line_120"></div>




      <div id="recentProducts_gridbox">
        <div class="productInfo_box">

          <!-- 이미지 부분  -->
          <div class="productImg_box">
            <img src="" alt="">
          </div>

          <!-- 텍스트 부분 -->
          <div class="productText_box">
            <div class="productText_box_title_line">제목</div>
            <div class="productText_box_price_line">가격</div>
            <div class="productText_box_station_line">역호선</div>
            <div class="productText_box_category_line">카테고리</div>
          </div>

        </div>


        <div class="productInfo_box">

          <!-- 이미지 부분  -->
          <div class="productImg_box">
            <img src="" alt="">
          </div>

          <!-- 텍스트 부분 -->
          <div class="productText_box">
            <div class="productText_box_title_line">제목</div>
            <div class="productText_box_price_line">가격</div>
            <div class="productText_box_station_line">역호선</div>
            <div class="productText_box_category_line">카테고리</div>
          </div>

        </div>

        <div class="productInfo_box">

          <!-- 이미지 부분  -->
          <div class="productImg_box">
            <img src="" alt="">
          </div>

          <!-- 텍스트 부분 -->
          <div class="productText_box">
            <div class="productText_box_title_line">제목</div>
            <div class="productText_box_price_line">가격</div>
            <div class="productText_box_station_line">역호선</div>
            <div class="productText_box_category_line">카테고리</div>
          </div>

        </div>


        <div class="productInfo_box">

          <!-- 이미지 부분  -->
          <div class="productImg_box">
            <img src="" alt="">
          </div>

          <!-- 텍스트 부분 -->
          <div class="productText_box">
            <div class="productText_box_title_line">제목</div>
            <div class="productText_box_price_line">가격</div>
            <div class="productText_box_station_line">역호선</div>
            <div class="productText_box_category_line">카테고리</div>
          </div>

        </div>


        <div class="productInfo_box">

          <!-- 이미지 부분  -->
          <div class="productImg_box">
            <img src="" alt="">
          </div>

          <!-- 텍스트 부분 -->
          <div class="productText_box">
            <div class="productText_box_title_line">제목</div>
            <div class="productText_box_price_line">가격</div>
            <div class="productText_box_station_line">역호선</div>
            <div class="productText_box_category_line">카테고리</div>
          </div>

        </div>


        <div class="productInfo_box">

          <!-- 이미지 부분  -->
          <div class="productImg_box">
            <img src="" alt="">
          </div>

          <!-- 텍스트 부분 -->
          <div class="productText_box">
            <div class="productText_box_title_line">제목</div>
            <div class="productText_box_price_line">가격</div>
            <div class="productText_box_station_line">역호선</div>
            <div class="productText_box_category_line">카테고리</div>
          </div>

        </div>


        <div class="productInfo_box">

          <!-- 이미지 부분  -->
          <div class="productImg_box">
            <img src="" alt="">
          </div>

          <!-- 텍스트 부분 -->
          <div class="productText_box">
            <div class="productText_box_title_line">제목</div>
            <div class="productText_box_price_line">가격</div>
            <div class="productText_box_station_line">역호선</div>
            <div class="productText_box_category_line">카테고리</div>
          </div>

        </div>


        <div class="productInfo_box">

          <!-- 이미지 부분  -->
          <div class="productImg_box">
            <img src="" alt="">
          </div>

          <!-- 텍스트 부분 -->
          <div class="productText_box">
            <div class="productText_box_title_line">제목</div>
            <div class="productText_box_price_line">가격</div>
            <div class="productText_box_station_line">역호선</div>
            <div class="productText_box_category_line">카테고리</div>
          </div>

        </div>


        <div class="productInfo_box">

          <!-- 이미지 부분  -->
          <div class="productImg_box">
            <img src="" alt="">
          </div>

          <!-- 텍스트 부분 -->
          <div class="productText_box">
            <div class="productText_box_title_line">제목</div>
            <div class="productText_box_price_line">가격</div>
            <div class="productText_box_station_line">역호선</div>
            <div class="productText_box_category_line">카테고리</div>
          </div>

        </div>

        <div class="productInfo_box">

          <!-- 이미지 부분  -->
          <div class="productImg_box">
            <img src="" alt="">
          </div>

          <!-- 텍스트 부분 -->
          <div class="productText_box">
            <div class="productText_box_title_line">제목</div>
            <div class="productText_box_price_line">가격</div>
            <div class="productText_box_station_line">역호선</div>
            <div class="productText_box_category_line">카테고리</div>
          </div>

        </div>

        <div class="productInfo_box">

          <!-- 이미지 부분  -->
          <div class="productImg_box">
            <img src="" alt="">
          </div>

          <!-- 텍스트 부분 -->
          <div class="productText_box">
            <div class="productText_box_title_line">제목</div>
            <div class="productText_box_price_line">가격</div>
            <div class="productText_box_station_line">역호선</div>
            <div class="productText_box_category_line">카테고리</div>
          </div>

        </div>

        <div class="productInfo_box">

          <!-- 이미지 부분  -->
          <div class="productImg_box">
            <img src="" alt="">
          </div>

          <!-- 텍스트 부분 -->
          <div class="productText_box">
            <div class="productText_box_title_line">제목</div>
            <div class="productText_box_price_line">가격</div>
            <div class="productText_box_station_line">역호선</div>
            <div class="productText_box_category_line">카테고리</div>
          </div>

        </div>

      </div>
      <input type="button" id="moreInfo_btn" class="w3-button w3-round-xlarge" data-tf="0" name="" value="최신매물 더 보기" style="box-shadow:3px 3px 10px 0 rgba(0, 0, 0, 0.16);width:30.0rem;color:#3b3b3b">
    </div>


    <!-- 매트로켓 장점 소개 부분  -->
    <div id="advantages_box">

      <!-- 배너이미지 2 -->
      <div class="contentImg_box" id="c_img02">

        <!-- 이미지  -->
        <div class="contentImg_img">
          <img src="img/bannerImg_2.png" id="img02" alt="">
        </div>

        <!-- 텍스트 부분 -->
        <div class="contentImg_text">
          <p style="">
            <span style="">중고거래,</span><br>
            매일 삼천그루의 나무를 심습니다.
          </p>
        </div>
      </div>

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
          <div class="imgbox_3"><img src="img\locker_3.png" alt=""></div>
          <span>비대면 거래</span>
          <div class="blue_line"></div>
          <p>필요에 따라 물품 보관함을 이용해 비대면 거래를 이용할 수 있습니다.</p>
        </div>

        <div class="textBox_1">
          <div class="imgbox_3"><img src="img\time_3.png" alt=""></div>
          <span>도착시간</span></li>
          <div class="blue_line"></div>
          <p>메트로켓은 출발시간에 맞춰서 도착시간을 알려줍니다.</p>
        </div>

        <div class="textBox_1">
          <div class="imgbox_3"><img src="img\train_3.png" alt=""></div>
          <span>지하철역 거래</span>
          <div class="blue_line"></div>
          <p>인증받은 주변 역을 중심으로 품목들을 볼 수 있고, 호선을 선택하여 다양한 물품들을 검색할 수 있습니다.</p>
        </div>

        <div class="textBox_1">
          <div class="imgbox_3"><img src="img\shield_3.png" alt=""></div>
          <span>안전거래</span>
          <div class="blue_line"></div>
          <p>실시간으로 물건을 직접 보고 거래하여 안전하게 거래를 이용할 수 있습니다.</p>
        </div>

      </div>

      <!-- 배너이미지 3 -->
      <div class="contentImg_box" id="c_img03">

        <!-- 이미지  -->
        <div class="contentImg_img">
          <img src="img/bannerImg_3.png" id="img03" alt="">
        </div>

        <!-- 텍스트 부분 -->
        <div class="contentImg_text">
          <h5>똑똑한 중고거래</h5>
          <p>
            "사기는 NO! 안전하게 물건 사는 방법!"
          </p>
          <span>메트로켓</span>
        </div>
      </div>

    </div>


    <!-- 푸터 부분  -->
    <?php require_once('metrocket_footer.php');?>
  </body>
  <script>
  const tapmenuItem = document.getElementsByClassName('tapmenuItem');
  $(document).ready(function(){

    //슬라이드 이미지
    $('.bxslider').bxSlider( {
        mode: 'horizontal',// 가로 방향 수평 슬라이드
        speed: 500,        // 이동 속도를 설정
        pager: false,      // 현재 위치 페이징 표시 여부 설정
        moveSlides: 1,     // 슬라이드 이동시 개수
        auto: true,        // 자동 실행 여부
        autoHover: false,   // 마우스 호버시 정지 여부
        controls: true,    // 이전 다음 버튼 노출 여부
        captions:true
    });
    load_category(tapmenuItem.item(0).innerText);
    // $(".owl-carousel").owlCarousel(obj);

    // 768px 일때 사이트 소개이미지파일 다른해상도 파일로 변경
    // changeContent()
    // changeBtn_style();
    changeWidth_RecentProducts_gridbox(2);
  });


  var test = 0;
  //태그에 함수 넣는부분
  for (var i = 0; i < 3; i++) {

    tapmenuItem.item(i).addEventListener('click',(event)=>{
      for (var j = 0; j < 3; j++) {
          tapmenuItem.item(j).style.color='#707070';
          tapmenuItem.item(j).style.borderBottom='none';
      }
      event.target.style.color='#3b3b3b';
      event.target.style.borderBottom='solid 2px #0099ff';

      select_category(event.target.innerText);
   });

  }

  function load_category(category) {
    $.ajax({
        url:'update_categoryItem.php', //request 보낼 서버의 경로
        type:'post', // 메소드(get, post)
        data:{category:category}, //보낼 데이터
        success: function(data) {
            $('#owl-carousel').html(data);
            $("#owl-carousel").owlCarousel(obj);
        },
        error: function(err) {
            //서버로부터 응답이 정상적으로 처리되지 못햇을 때 실행
        }
    });
  }

    //카테고리 넘겨주는 ajax
    function select_category(category) {
      $.ajax({
          url:'update_categoryItem.php', //request 보낼 서버의 경로
          type:'post', // 메소드(get, post)
          data:{category:category}, //보낼 데이터
          success: function(data) {
              //서버로부터 정상적으로 응답이 왔을 때 실행
              $('#owl-carousel').trigger('replace.owl.carousel', data).trigger('refresh.owl.carousel');
              // $('#owl-carousel').attr('class','owl-carousel');
              // $('#owl-carousel').html(data);
              // $("#owl-carousel").owlCarousel(obj);
              // $("#owl-carousel").removeClass();
              // $("#owl-carousel").addClass("owl-carousel");

          },
          error: function(err) {
              //서버로부터 응답이 정상적으로 처리되지 못햇을 때 실행
          }
      });
    }


  $(document).ready(function(){ // html 문서를 다 읽어들인 후
    function login_open() {
      document.querySelector(".modal").classList.remove("hidden");
    }
    function login_close() {
      document.querySelector(".modal").classList.add("hidden");
    }

    if (document.querySelector(".openBtn")) {
      document.querySelector(".openBtn").addEventListener("click", login_open);
    }
    document.querySelector(".closeBtn").addEventListener("click", login_close);

      $('#selectID').on('change', function(){
          if(this.value !== ""){
              var optVal = $(this).find(":selected").val();
              //alert(optVal);
              $.post('autosearch.php',{optVal:optVal}, function(data) {
                let source = $.map($.parseJSON(data), function(item) { //json[i] 번째 에 있는게 item 임.
                  chosung = "";
                  //Hangul.d(item, true) 을 하게 되면 item이 분해가 되어서
                  //["ㄱ", "ㅣ", "ㅁ"],["ㅊ", "ㅣ"],[" "],["ㅂ", "ㅗ", "ㄲ"],["ㅇ", "ㅡ", "ㅁ"],["ㅂ", "ㅏ", "ㅂ"]
                  //으로 나오는데 이중 0번째 인덱스만 가지고 오면 초성이다.
                  full = Hangul.disassemble(item).join("").replace(/ /gi, "");	//공백제거된 ㄱㅣㅁㅊㅣㅂㅗㄲㅇㅡㅁㅂㅏㅂ
                  Hangul.d(item, true).forEach(function(strItem, index) {

                    if(strItem[0] != " "){	//띄어 쓰기가 아니면
                      chosung += strItem[0];//초성 추가

                    }
                  });


                  return {
                    label : chosung + "|" + (item).replace(/ /gi, "") +"|" + full, //실제 검색어랑 비교 대상 ㄱㅊㅂㅇㅂ|김치볶음밥|ㄱㅣㅁㅊㅣㅂㅗㄲㅇㅡㅁㅂㅏㅂ 이 저장된다.
                    value : item,
                    chosung : chosung,
                    full : full
                  }
                });
                $("#auto").autocomplete({
                          source : source,	// source 는 자동 완성 대상
                          select : function(event, ui) {	//아이템 선택시
                            console.log(ui.item.label + " 선택 완료");

                          },
                          focus : function(event, ui) {	//포커스 가면
                            return false;//한글 에러 잡기용도로 사용됨
                          },
                }).autocomplete( "instance" )._renderItem = function( ul, item ) {
                //.autocomplete( "instance" )._renderItem 설절 부분이 핵심
                    return $( "<li>" )	//기본 tag가 li로 되어 있음
                      .append( "<div>" + item.value + "</div>" )	//여기에다가 원하는 모양의 HTML을 만들면 UI가 원하는 모양으로 변함.
                      .appendTo( ul );	//웹 상으로 보이는 건 정상적인 "김치 볶음밥" 인데 내부에서는 ㄱㅊㅂㅇㅂ,김치 볶음밥 에서 검색을 함.
                 };
          })
        }
      })


    });
    $("#auto").on("keyup",function(){	//검색창에 뭔가가 입력될 때마다
    input = $("#auto").val();	//입력된 값 저장
    $( "#auto" ).autocomplete( "search", Hangul.disassemble(input).join("").replace(/ /gi, "") );	//자모 분리후 띄어쓰기 삭제
    })

  var obj ={
    nav:false,
    loop: true,
    dots: false,
    autoplay:false,
    rewind: true,
    margin:0,
    responsiveClass:true,
    responsive:{
       1800:{items:5},
       1441:{items:5},
       1025:{items:4},
       769:{items:3},
       0:{items:2}
    }
  }

  var owl = $('.owl-carousel');
  // Go to the next item
  $('.customNextBtn').click(function() {
    owl.trigger('next.owl.carousel');
  })
  // Go to the previous item
  $('.customPrevBtn').click(function() {
    // With optional speed parameter
    // Parameters has to be in square bracket '[]'
    owl.trigger('prev.owl.carousel', [300]);
})


  //content_count 보여주고싶은 콘텐츠들의 행의 수 (열은 자동으로 조정)
  //check 버튼 체크여
  function changeWidth_RecentProducts_gridbox(content_count) {
    var w_width = window.outerWidth;
    let content_rem = 19.4;
    if (w_width <= 1440) {
      if (w_width <= 1024) {
        if (w_width <= 768) {
          if (w_width <= 540) {
            if (w_width <= 425) {
              if (w_width <= 360) {
                document.getElementById('recentProducts_gridbox').style.height =String((content_rem * 6 + 140)*content_count)+"px";
                return 0;
              }
              document.getElementById('recentProducts_gridbox').style.height =String((content_rem * 7 + 140)*content_count)+"px";
              return 0;
            }
            document.getElementById('recentProducts_gridbox').style.height =String((content_rem * 7 + 160)*content_count)+"px";
            return 0;
          }
          document.getElementById('recentProducts_gridbox').style.height =String((content_rem * 8 + 200)*content_count)+"px";
          return 0;
        }
        document.getElementById('recentProducts_gridbox').style.height =String((content_rem * 9 + 200)*content_count)+"px";
        return 0;
      }
    document.getElementById('recentProducts_gridbox').style.height =String((content_rem * 10 + 200)*content_count)+"px";
    return 0;
    }else{
      document.getElementById('recentProducts_gridbox').style.height =String((content_rem * 10 + 200)*content_count)+"px";
      return 0;
    }
  }

  function changeSubBannerImge() {
    var w_width = window.outerWidth;
    if (w_width <= 768) {
      document.getElementById('img01').src = "img/bannerImg_1_768x320.png";
      document.getElementById('img02').src = "img/bannerImg_2_768x320.png";
      document.getElementById('img03').src = "img/bannerImg_3_768x110.png";
    }
  }




  //더보기 버튼
  document.getElementById('moreInfo_btn').addEventListener("click",changeBtn_style);

    function changeBtn_style() {
      if (document.getElementById('moreInfo_btn').dataset.tf=="0") {
        changeWidth_RecentProducts_gridbox(4);
        document.getElementById('moreInfo_btn').value="닫기";
        document.getElementById('moreInfo_btn').dataset.tf="1"
      }else {
        changeWidth_RecentProducts_gridbox(2);
        document.getElementById('moreInfo_btn').value ="최신매물 더 보기";
        document.getElementById('moreInfo_btn').dataset.tf="0"
      }
    }


  //콘텐츠이미지들 일정디스플레이시 변경해주는 함수
  window.addEventListener("resize", changeContent);

    function changeContent() {
      if (document.getElementById('moreInfo_btn').dataset.tf=="0") {
        changeWidth_RecentProducts_gridbox(2);
      }else {
        changeWidth_RecentProducts_gridbox(4);
      }
    }
</script>
</html>
