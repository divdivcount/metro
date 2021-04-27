<?php
require_once('modules/db.php');
$dao = new Product;
$pid = Get('p', 1);
$ctg_name = Get("ctg_name", 0);
$ctg_station = Get("ctg_station", 0);
// echo $ctg_name."호선"."<br>";
// echo $ctg_station."역"."<br>";
if($ctg_name != "all" && $ctg_station){
	// echo "통과1";
	$sql = "select s.s_name, i.l_name  from station s, line i where i.l_id = $ctg_name";
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
}else{
	// echo "통과2";
	// echo $ctg_station;
	if($ctg_name == "all" && $ctg_station){
		$sql = "select s.s_name, i.l_name from station s, line i where s.l_id = i.l_id and s.s_name = '$ctg_station'";
		$result = mysqli_query($conn, $sql);
		$a = 0;
		while($station = mysqli_fetch_assoc($result)){
			// print_r($station)."<br>";
			if(array_search($ctg_station, $station) === false) {
				$theVariable = "not";
				// echo $theVariable."<br>";
			}else{
				$ctg_name = $station["l_name"];
				$theVariable = "sure";
				// echo $theVariable."<br>";
				$a = 1;
				break;
			}
		}
	}
}

if($a == 0){
	echo "<script>alert('입력을 잘못하셨거나 없는 역을 입력하셨습니다.');</script>";
	// echo "<script>location.replace('./index.php');</script>";
	exit;
}else{
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="css/css_login.css">
    <link rel="stylesheet" href="css/css_searchProduct.css">
    <link rel="stylesheet" href="css/css_noamlfont.css">
    <link rel="stylesheet" href="css/css_metrocket_footer.css">
    <link rel="stylesheet" href="css/css_metrocket_header.css">
		<link rel="stylesheet" href="css/css_select_station.css">
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
	<div id="wrapPage">

    <!-- 상단 메뉴 부분 -->
    <?php require_once('metrocket_header.php'); ?>

    <!-- 메인 컨테이너  -->
    <div id = "wrapContainer_Box">

      <!-- 상단 title 박스  -->
      <div id="pageTitle_box" class="radius_box">
        <h2>중고품목 매물보기</h2>
        <span>카테고리를 활용해 매물을 검색해 보세요</span>
				<form action="searchProduct.php" method="get">
        <!-- 검색관련 input 박스 -->
        <div id="search_box">
          <div id="search_TextPart">
						<!-- form css -->

	            <select class="w3-select" name="category">
								<option value="">선택</option>
								<?php
								$sql = " select * from category order by ca_id";
								$result = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_assoc($result)) {
								?>
								<option value="<?=$row["ca_name"]?>"><?=$row["ca_name"]?></option>
							<?php }
							?>
	            </select>
							<input type="hidden" name="ctg_name" value="<?=$ctg_name?>">
							<input type="hidden" name="ctg_station" value="<?=$ctg_station?>">
	            <input type="text" name="s_value">
          </div>
</form>
          <!-- 검색버튼  -->
          <div class="search_icon"><input type="submit" value ="" style="background-image: url('img/search_icon.png'); background-size: 100% 100%; background-position:  0px 0px;
    background-repeat: no-repeat; border:none; width:58px; height:58px;"></div>

        </div>

        <!-- 역이나 호선 동적으로 나오는 부분 -->
        <div id="selectedStation">

        </div>

        <!-- 호선 선택 버튼 -->
        <div class="btn_box">
          <input id="openBtn_2" class="w3-button w3-round-large" type="button" name="" value="호선선택">
        </div>

				<?php require_once('select_station.php'); ?>

      </div>


			<?php
				try {
						$s_value = empty($_REQUEST["s_value"]) ? "" : $_REQUEST["s_value"];
						$category = empty($_REQUEST["category"]) ? "" : $_REQUEST["category"];
						// echo $s_value."검색어"."<br>";
						// echo $category."카테고리"."<br>";
						if($s_value){
							$result = $dao->SelectPageLength($pid, 10, $ctg_name, $ctg_station, '');
						  $list = $dao->SelectPageList($result['current'], 10,$ctg_name, $ctg_station, $s_value);
						}elseif($category){
							$result = $dao->SelectPageLength($pid, 10, $ctg_name, $ctg_station, $category);
						  $list = $dao->SelectPageList($result['current'], 10,$ctg_name, $ctg_station, '', $category);
						}elseif($s_value && $category){
							$result = $dao->SelectPageLength($pid, 10, $ctg_name, $ctg_station, $category);
						  $list = $dao->SelectPageList($result['current'], 10,$ctg_name, $ctg_station, $s_value, $category);
						}else{
						$result = $dao->SelectPageLength($pid, 10, $ctg_name, $ctg_station, '');
						$list = $dao->SelectPageList($result['current'], 10, $ctg_name, $ctg_station, '');
					}
				} catch (PDOException $e) {
					$result = null;
					$list = null;
				 echo $e->getMessage();
				}
			?>



      <!-- n 호선 및  n 역 상품 타이틀 -->
      <div id="productTitle">
        <div class="line"></div>
        <p><span><?= $station['l_name']?> <?=$ctg_station?>역</span> 모든 최신매물</p>
        <div class="line"></div>
      </div>

      <!-- 상품 목록 그리드 박스  -->
      <div id="productGrid_box">
				<?php foreach ($list as $row) : ?>
        <!-- 상품 예시 샘플 php로 띄울거임 -->
        <a href="searchProduct_detail.php?id=<?=$row['pr_id']?>&title=<?=$row['pr_title']?>"><div class="productInfo_box">
          <!-- 상품 이미지부분 -->
          <div class="productImg_box">
            <img src="files/<?=$row["pr_img"]?>" alt="">
          </div>

          <!-- 상품 상세설명 -->
          <div class="productText_box">

            <!-- 제목 -->
            <div class="productText_box_title_line">
              <span><?=$row["pr_title"]?></span>
            </div>

            <!-- 가격 -->
            <div class="productText_box_price_line">
              <span><?=$row["pr_price"]?></span>
            </div>

            <!-- 역 위치 -->
            <div class="oproductText_box_station_line">
              <span><?=$row["line_name"]?> <?=$row["pr_station"]?></span>
            </div>

            <!-- 카테고리 및 관심 수 부분  -->
            <div class="productText_box_category_line">
              <span><?=$row["ca_name"]?></span>
              <span>관심<?=$row["i_count"]?></span>
            </div>
          </div>
        </div></a>
				<?php endforeach ?>
			</div>
      <!-- 페이지 네이션 들어가는 부분 -->
      <div id="pagination">
				<?php
				if($result['start'] < $result['current'] ) :?>
					<a class="abtn" href="searchProduct.php?p=<?=($pid - 1)?>&ctg_station=<?=$ctg_station?>&ctg_name=<?=$ctg_name?>&s_value=<?=$s_value?>">&lt;</a>
				<?php endif ?>

				<?php for($i=$result['start']; $i<=$result['end']; $i++): ?>
					<a class="abtn <?php if($i === (int)$result['current']) echo 'current' ?>" href="?p=<?= $i ?>&ctg_station=<?=$ctg_station?>&ctg_name=<?=$ctg_name?>&s_value=<?=$s_value?>"><?= $i ?></a>
				<?php endfor ?>

				<?php if( $result['end'] > $result['current']) : ?>
					<a class="abtn" href="searchProduct.php?p=<?=($pid + 1)?>&ctg_station=<?=$ctg_station?>&ctg_name=<?=$ctg_name?>&s_value=<?=$s_value?>">&gt;</a>
				<?php endif ?>
      </div>

    </div>

    <!-- 푸터 부분  -->
    <?php require_once('metrocket_footer.php');?>
	</div>
  </body>
  <script type="text/javascript">
    $(document).ready(function(){
			function selectStation_open() {
				document.querySelector(".modal_2").classList.remove("hidden");
			}
			function selectStation_close() {
				document.querySelector(".modal_2").classList.add("hidden");
			}
			document.querySelector("#openBtn_2").addEventListener("click", selectStation_open);
			document.querySelector(".closeBtn_2").addEventListener("click", selectStation_close);
  });
  </script>
</html>
<?php }?>
