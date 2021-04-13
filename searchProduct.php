<?php
require_once('modules/db.php');
$ctg_name = Post("ctg_name", 0);
$ctg_station = Post("ctg_station", 0);
// echo $ctg_name;
// echo $ctg_station;
$sql = "select s.s_name, i.l_name  from station s, line i where s.l_id = $ctg_name";
$result = mysqli_query($conn, $sql);
$a = 0;
while($station = mysqli_fetch_assoc($result)){
	// print_r($station)."<br>";
	if(array_search($ctg_station, $station) === false) {
		$theVariable = "not";
		// echo $theVariable."<br>";
	}else{
		$theVariable = "sure";
		// echo $theVariable."<br>";
		$a = 1;
		break;
	}
}
if($a == 0){
	echo "<script>alert('입력을 잘못하셨거나 없는 역을 입력하셨습니다.');</script>";
	echo "<script>location.replace('./index.php');</script>";
	exit;
}else{
?>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/hangul-js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
      .ui-helper-hidden-accessible{display:none;}
    </style>
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
          <div class="search_icon"><input type="image" src="img/search_icon.png" name="" value=""></div>

        </div>

        <!-- 역이나 호선 동적으로 나오는 부분 -->
        <div id="selectedStation">

        </div>

        <!-- 호선 선택 버튼 -->
        <div class="btn_box">
          <input id="pop" class="w3-button w3-round-large" type="button" name="" value="호선선택">
        </div>


        <form  id="selectMetro_box" action="My_one_page.php" method="post">
          <div id="bothFind_item">

          <div class="find_item">
            <span>호선을 선택해 주세요.</span>
            <select name="ctg_name" id="selectID" class="w3-select">
              <option value="">선택</option>
              <?php
              $sql = " select * from line";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)) {
              ?>
              <option value="<?=$row["l_id"]?>"><?=$row["l_name"]?></option>
            <?php }
             mysqli_close($conn);
            ?>
            </select>
          </div>

          <div class="find_item">
            <span>지하철역을 입력해주세요.</span>
            <script type="text/javascript">

            $(document).ready(function(){ // html 문서를 다 읽어들인 후
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
            </script>
            <div style="display:flex"><input id="auto" class="w3-input highlight" value='' type="text"><div style="width:1.3rem;margin:auto"><img src="img\loupe.png" alt=""></div></div>
          </div>

        </div>

        <button type="submit" id ="close_pop" class="w3-button w3-blue w3-ripple w3-round-xxlarge" name="button">물건보러가기</button>
        </form>
      </div>






      <!-- n 호선 및  n 역 상품 타이틀 -->
      <div id="productTitle">
        <div class="line"></div>
        <p><span><?= $station['l_name']?></span> 모든 최신매물</p>
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

            <!-- 제목 -->
            <div class="productText_box_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="productText_box_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="oproductText_box_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="productText_box_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>
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

            <!-- 제목 -->
            <div class="productText_box_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="productText_box_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="oproductText_box_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="productText_box_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>
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

            <!-- 제목 -->
            <div class="productText_box_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="productText_box_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="oproductText_box_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="productText_box_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>
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

            <!-- 제목 -->
            <div class="productText_box_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="productText_box_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="oproductText_box_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="productText_box_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>
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

            <!-- 제목 -->
            <div class="productText_box_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="productText_box_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="oproductText_box_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="productText_box_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>
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

            <!-- 제목 -->
            <div class="productText_box_title_line">
              <span>김치냉장고 이사로 급처</span>
            </div>

            <!-- 가격 -->
            <div class="productText_box_price_line">
              <span>150,000</span>
            </div>

            <!-- 역 위치 -->
            <div class="oproductText_box_station_line">
              <span>8호선 단대오거리역</span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="productText_box_category_line">
              <span>디지털/가전</span>
              <span>관심7</span>
            </div>
          </div>
        </div>
      </div>


      <!-- 페이지 네이션 들어가는 부분 -->
      <div id="pagination">
        <ul>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
        </ul>
      </div>

    </div>

    <!-- 푸터 부분  -->
    <?php require_once('metrocket_footer.php');?>

  </body>
  <script type="text/javascript">
    $(document).ready(function(){
      popup();

      function popup(){
        open_pop();
        close_pop();
      }
      function open_pop(){
        $('#pop').click(function(){
          $('#selectMetro_box').css({'display':'flex'});
        });
      }
      function close_pop(){
        $('#close_pop').click(function(){
          $('#selectMetro_box').css({'display':'none'});
        });
      }
  });
  </script>
</html>
<?php }?>
