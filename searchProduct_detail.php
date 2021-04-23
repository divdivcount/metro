<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('modules/db.php');
try{
  $dao = new Product;
  $replyobject = new Reply;
  $interest = new Interest;
  $pr_id = Get("id", 0);
  $pr_title = Get("title",0);
  $replys = $replyobject->reply_select($pr_id);
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
    <link rel="stylesheet" href="css/reply.css">
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
    <?php require_once('metrocket_header.php');?>
    <div id="wrapContainer_Box">
      <div id="pageTitle_box" class="radius_box">
        <h2>품목 상세보기</h2>
        <span>채팅하기를 이용해 판매자와 대화할 수 있습니다.</span>
      </div>
      <?php $imgdao = $dao->searchProduct_detail(isset($mb) ? $mb["mb_num"] : 'null', isset($om) ? $om["om_id"] : 'null',$pr_id, $pr_title); ?>
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
              <!-- 여기 관심등록 -->
              <div class="img_box"> <img src="<?php if($row["mem_i_check"] == 0){echo "img/staroff_19x19.png";}elseif($row["mem_i_check"] == 1){echo "img/star_19x19.png";} ?>" id="star_btn" data-value="<?=$row["mem_i_check"] ? $row["mem_i_check"] : 0 ?>" alt="" onclick="test()"></div>
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

      <?php
       $piec = explode("&nbsp;", $row["profile_station"]);
       // echo $piec[1];
       $sameProduct = $dao->same_searchProduct($row["l_id"],$piec[1],$row["ca_name"]);?>
      <?php $panmejaProduct = $dao->panpeja_searchProduct($row["mb_id"]? $row["mb_id"] : 'null', $row["om_id"] ? $row["om_id"] : 'null' );?>
    <?php endforeach ?>
    <!-- 댓글이 들어가야하는 부분입니다. -->
    <!-- 댓글 시작 -->
    <div class="reply_container">
      <div class="reply_view">
        <h3 style="padding:10px 0 15px 0; border-bottom: solid 1px gray;">댓글목록</h3>
        <?php if(isset($replys)) : ?>
        <?php foreach ($replys as $reple) : ?>

          <div class="dat_view">
            <div><b><img src="<?=$reple['mb_img'] ? $reple['mb_img'] : "files/".$reple['mb_img'] ?>"></b></div>
            <div><b><?=$reple['mb_id']?></b></div>
            <div class="dap_to comt_edit"><?php echo nl2br("$reple[content]"); ?></div>
            <div class="rep_me dap_to"><?=$reple['date']?></div>
            <div class="rep_me rep_menu">
            </div>
          </div>

          <div class="modal fade" id="rep_modal_del">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><b>댓글 삭제</b></h4>
                </div>
                <div class="modal-body">
                  <form method="get" id="modal_form" action="reply_delete.php">
                    <input type="hidden" name="rno" value="<?=$reple['idx']?>" />
                    <input type="hidden" name="b_no" value="<?=$pr_id?>">
                    <input type="submit" class="btn btn-primary" value="확인" /></p>
                  </form>
                </div>
              </div>
            </div>
          </div>

        <?php endforeach ?>
        <?php endif?>

          <div class="dat_ins">
            <input type="hidden" name="bno" class="bno" value="<?=$pr_id?>">
            <input type="hidden" name="mb_id" id="mb_id" class="mb_dat_user" value=<?=isset($mb) ? $mb["mb_num"] : 'null' ?>>
            <input type="hidden" name="om_id" id="om_id" class="om_dat_user" value=<?=isset($om) ? $om["om_id"] : 'null'?>>
            <div class="replyInsert_box" style="margin-top:10px;">
              <textarea name="content" class="rep_con" id="rep_con"></textarea>
              <button id="rep_btn" class="rep_btn">댓글</button>
            </div>
          </div>
        </div>
      </div>
      <!-- 댓글 끝 -->

      <!-- 다른 상품 소개 타이틀 -->
      <div class="otherProduct_title"><h3>이 상품과 비슷한 상품</h3></div>
      <!-- 상품 그리드 박스 -->
      <!-- 다른 상품들 노출되는 부분임 -->
      <div class="otherProduct_gridBox">

        <!-- 기타 상품 정보  -->
        <!-- 이형식으로 쭉 클래스 긴건 애교로 -->
        <?php foreach ($sameProduct as $rows) : ?>
        <a href="searchProduct_detail.php?id=<?=$rows['pr_id']?>&title=<?=$rows['pr_title']?>"><div class="otherProduct_content">

          <!-- 이미지 부분 -->
          <div class="otherProduct_content_img radiusTop">
            <img src="files/<?=$rows["pr_img"]?>" alt="">
          </div>

          <!-- 상품 내용 -->
          <div class="otherProduct_content_text radiusBottom">

            <!-- 제목 -->
            <div class="otherProduct_content_text_title_line">
              <span><?=$rows["pr_title"]?></span>
            </div>

            <!-- 가격 -->
            <div class="otherProduct_content_text_price_line">
              <span><?=$rows["pr_price"]?></span>
            </div>

            <!-- 역 위치 -->
            <div class="otherProduct_content_text_station_line">
              <span><?=$rows["line_name"]?> <?=$rows["pr_station"]?></span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="otherProduct_content_text_category_line">
              <span><?=$rows["ca_name"]?></span>
              <span>관심<?=$rows["i_count"]?></span>
            </div>

          </div>
        </div></a>
      <?php endforeach ?>
      </div><!-- 그리드 박스의 끝  -->

      <!-- 다른 상품 소개 타이틀 -->
      <div class="otherProduct_title"><h3>판매자의 다른상품</h3></div>
      <!-- 상품 그리드 박스 -->
      <!-- 다른 상품들 노출되는 부분임 -->
      <div class="otherProduct_gridBox">

        <!-- 기타 상품 정보  -->
        <!-- 이형식으로 쭉 클래스 긴건 애교로 -->
        <?php foreach ($panmejaProduct as $product) : ?>
        <a href="searchProduct_detail.php?id=<?=$product['pr_id']?>&title=<?=$product['pr_title']?>"><div class="otherProduct_content">

          <!-- 이미지 부분 -->
          <div class="otherProduct_content_img radiusTop">
            <img src="files/<?=$product["pr_img"]?>" alt="">
          </div>

          <!-- 상품 내용 -->
          <div class="otherProduct_content_text radiusBottom">

            <!-- 제목 -->
            <div class="otherProduct_content_text_title_line">
              <span><?=$product["pr_title"]?></span>
            </div>

            <!-- 가격 -->
            <div class="otherProduct_content_text_price_line">
              <span><?=$product["pr_price"]?></span>
            </div>

            <!-- 역 위치 -->
            <div class="otherProduct_content_text_station_line">
              <span><?=$product["line_name"]?> <?=$product["pr_station"]?></span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="otherProduct_content_text_category_line">
              <span><?=$product["ca_name"]?></span>
              <span><?=$product["i_count"]?></span>
            </div>

          </div>
        </div></a>
      <?php endforeach ?>
      </div><!-- 그리드 박스의 끝  -->
    </div>
    <!-- 푸터 부분  -->
    <?php require_once 'metrocket_footer.php';?>
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
          $("#rep_modal_del").modal();
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

    //관심상품 클릭시 값넘어가는거
    var star_btn = document.getElementById('star_btn');
     //  star_btn.addEventListener('click',(event)=>{
     //
     // });
    function test() {
      let values =star_btn.dataset.value;
      let pr_id = "<?= $pr_id ?>";
      let mb_id = "<?= isset($mb) ? $mb["mb_num"] : 'null' ?>";
      let om_id = "<?= isset($om) ? $om["om_id"] : 'null' ?>";
      if (star_btn.dataset.value == 0) {
        $.ajax({
            url:'search_detail_ajax.php', //request 보낼 서버의 경로
            type:'post', // 메소드(get, post)
            data:{values:"0", pr_id : pr_id, mb_id:mb_id, om_id:om_id}, //보낼 데이터
            success: function(data) {
                //서버로부터 정상적으로 응답이 왔을 때 실행
                $('#star_btn').html(data);
                star_btn.src ="img/star_19x19.png";
                star_btn.dataset.value = 1;
            },
            error: function(err) {
              alert("관심 상품을 등록하기 위해서 로그인을 먼저 해주세요");
              // history.back();
            }
        });
      }
      else if (star_btn.dataset.value == 1) {
        $.ajax({
            url:'search_detail_ajax.php', //request 보낼 서버의 경로
            type:'post', // 메소드(get, post)
            data:{values:"1", pr_id : pr_id, mb_id:mb_id,om_id:om_id}, //보낼 데이터
            success: function(data) {
                //서버로부터 정상적으로 응답이 왔을 때 실행
                star_btn.src = "img/staroff_19x19.png";
                star_btn.dataset.value = 0;
            },
            error: function(err) {
                //서버로부터 응답이 정상적으로 처리되지 못햇을 때 실행
                alert("관심 상품을 등록하기 위해서 로그인을 먼저 해주세요");
                history.back();
            }
        });
      }
    }
    </script>
  </body>

</html>
