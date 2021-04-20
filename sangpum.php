<?php
    require_once('modules/db.php');
    $dao = new Product;
    $pid = Get('p', 1);

  if(empty($_SESSION['ss_mb_id']) && empty($_SESSION['naver_mb_id']) && empty($_SESSION['kakao_mb_id']) ){
        echo "<script>alert('로그인을 해주세요');</script>";
        echo "<script>location.replace('./index.php');</script>";
  }else{

    if(isset($_SESSION['ss_mb_id'])){
      $mb_ids = $_SESSION['ss_mb_id'];
      $sql = " SELECT * FROM member WHERE mb_id = '$mb_ids' ";
      $result = mysqli_query($conn, $sql);
      $mb = mysqli_fetch_assoc($result);
      $mb_id = $mb['mb_num'];
    }elseif(isset($_SESSION['naver_mb_id'])){
      $mb_ids = $_SESSION['naver_mb_id'];
      $mb_ids = substr($mb_ids, 5);
      $sql = " SELECT * FROM oauth_member WHERE om_id = $mb_ids ";
      $result = mysqli_query($conn, $sql);
      $om = mysqli_fetch_assoc($result);
      $om_id = $om['om_id'];

    }elseif(isset($_SESSION['kakao_mb_id'])){
      $mb_ids = $_SESSION['kakao_mb_id'];
      $mb_ids = substr($mb_ids, 5);
      $sql = " SELECT * FROM oauth_member WHERE om_id = $mb_ids ";
      $result = mysqli_query($conn, $sql);
      $om = mysqli_fetch_assoc($result);
      $om_id = $om['om_id'];
    }else{
      ?>
      <script>
        alter("어느것도 로그인되지 않았습니다.");
        location.replace("./index.php");
      </script>
      <?php
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/css_noamlfont.css">
<link rel="stylesheet" href="css/css.sangpum.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>

</style>
</head>
<body>
	<div class="w3-content w3-container">

    <!-- 제목 -->
    <h3 class="h3">판매 내역</h3>

    <!-- 상품 나오는 박스  -->
		<div class="productList_box">
      <?php
      	try {
      			// $start_s_value = empty($_REQUEST["start_s_value"]) ? "" : $_REQUEST["start_s_value"];
      		  // $s_value = empty($_REQUEST["s_value"]) ? "" : $_REQUEST["s_value"];
      			// if($start_s_value){
      			// 	$result = $dao->SelectPageLength($pid, 10, $s_value, $start_s_value);
      			//   $list = $dao->SelectPageList($result['current'], 10,$s_value, $start_s_value);
      			// }else{
      			$result = $dao->SelectPageLength($pid, 3, isset($mb_id) ? $mb_id : 'null', isset($om_id) ? $om_id : 'null','');
      			$list = $dao->SelectPageList($result['current'], 3, isset($mb_id) ? $mb_id : 'null', isset($om_id) ? $om_id : 'null','');
      		// }
      	} catch (PDOException $e) {
      	  $result = null;
      	  $list = null;
      	 echo $e->getMessage();
      	}
      ?>

      <!-- 상품 정보  -->
      <?php foreach ($list as $row) : ?>
      <div class="productInfo_box">

        <!-- 상품 이미지  -->
        <div class="productInfo_part_img">
          <img src="files/<?= $row['pr_img'] ?>" width="100%" height="100%" />
        </div>

        <!--   상품 관련 텍스트정보 -->
        <div class="productInfo_part_text">

          <!-- 1. 제목라인 -->
          <div class="productTitle_line">

            <!-- 제목 -->
            <div class="pr_title"><?= $row['pr_title'] ?></div>

            <!-- 버튼들 -->
            <div class="pr_buttons">
              <!-- 여기 건들이면 큰일남 할때 언급좀  -->
              <button type="button" class="reviseProduct_btn w3-button w3-blue w3-round">수정하기</button>
              <button type="button" class="completeSale_btn w3-button w3-light-grey w3-round" onclick="completeSale(this)">판매완료</button>
              <button type="button" class="deleteProduct_btn w3-button w3-dark-grey w3-round">삭제하기</button>
              <!--  여기 건들이면 큰일남 할때 언급좀  -->
            </div>
          </div>

          <!--  2. 판매여부 라인 -->
          <div class="checkSale_line">
            <?= $row['pr_status'] ?>
          </div>

          <!-- 3. 상품가격라인 -->
          <div class="productPrice_line">
            <?= $row['pr_price'] ?>
          </div>

          <!-- 4. 별점과 역정보 라인 -->
          <div class="productRecommendation_line">

            <!-- 별점  -->
            <div class="pr_starcount"><img src="img\star_19x19.png"><?=$row['i_count'] ?></div>

            <!-- 역 -->
            <div class="pr_station"><?= $row['l_name'] ?> <?= $row['pr_station'] ?></div>
          </div>

          <div class="hidden">
            <?= $row['pr_id'] ?>
          </div>

        </div>
        <!-- <ul class="list">
        <li class="hidden"></li>
        <li class="list-li w3-round image_box"></li>
        <div class="text_field">
          <li class="name_field"></li>
          <li class="clear"></li>
          <li class="sell_text"></li>
          <li class="clear"></li>
          <li class="price_text"></li>
          <li class="clear"></li>
          <li class="star_text"><span style="float:left;"></span><span class="station_text"></span></li>
        </div>
        </ul> -->
      </div>
    <?php endforeach ?>

    <div id="pagenation_box"class="w3-center">
        <?php
        if($result['start'] < $result['current'] ) :?>
          <a class="abtn" href="sangpum.php?p=<?=($pid - 1)?>">&lt;</a>
        <?php endif ?>

        <?php for($i=$result['start']; $i<=$result['end']; $i++): ?>
          <a class="abtn <?php if($i === (int)$result['current']) echo 'current' ?>" href="?p=<?= $i ?>"><?= $i ?></a>
        <?php endfor ?>

        <?php if( $result['end'] > $result['current']) : ?>
          <a class="abtn" href="sangpum.php?p=<?=($pid + 1)?>">&gt;</a>
        <?php endif ?>
      </div>


		</div>

	</div>

  <script>

    //   판매여부에따라 버튼 출력 방식
    var reviseProduct_btn = document.getElementsByClassName('reviseProduct_btn');
    var completeSale_btn = document.getElementsByClassName('completeSale_btn');
    var deleteProduct_btn =   document.getElementsByClassName('deleteProduct_btn');
    var pr_buttons = document.getElementsByClassName('pr_buttons');

    window.onload = function() {
      for (var i = 0; i < pr_buttons.length; i++) {
        if (pr_buttons.item(i).dataset.sell_check == "0") { //판매 완료가 false(0)이면  삭제버튼 감추기
          completeSale_btn.item(i).style.display="block";
          reviseProduct_btn.item(i).style.display="block";
          deleteProduct_btn.item(i).style.display="none";
        }else if (pr_buttons.item(i).dataset.sell_check == "1") { //판매 완료가 true(1)이면  수정 및 판매완료 버튼 감추기
          completeSale_btn.item(i).style.display="none";
          reviseProduct_btn.item(i).style.display="none";
          deleteProduct_btn.item(i).style.display="block";
        }
      }
    };

    //판매완료시 버튼처리 부분
    function completeSale(e) {
      e.style.display ="none";
      var parent = e.parentNode;
      // alert(parent.dataset.sell_check);
      var child =parent.childNodes;
      // alert(child[1].dataset.test);
      child[1].style.display ="none";
      child[5].style.display ="block";
    }

  </script>
</body>
</html>
<?php } ?>
