<?php
    require_once('modules/db.php');
    $dao = new Product;
    $pid = Get('p', 1);

  if(empty($_SESSION['ss_mb_id']) && empty($_SESSION['naver_mb_id']) && empty($_SESSION['kakao_mb_id']) ){
        echo "<script>alert('로그인을 해주세요');</script>";
        echo "<script>location.replace('./login.php');</script>";
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
  .img_box{width:160px; height: 160px;}
  .image_box{
    float: left;
  }
  .list{
    margin-top: 50px;
    display: flex;
    padding : 20px;
    flex-direction: row;
    height: 200px;
    list-style: none;
  }
  .list-li{
    margin: 0 0 0 0;
    padding: 0 0 0 0;
    border : 0;
    float: left;
    width:160px;
    height: 160px;
  }
  .info_text{
    margin-top: 5px;
    padding-left: 10%;
    width:80%;
    font-size: 13px;
    float: left;
  }
  .sell_text{
    font-family: "NotoSansKR";
    width: 40%;
    font-size: 20px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    padding-left: 10%;
    float: left;
  }
  .station_text{
    width: 40%;
    font-size: 20px;
    text-align: right;
    padding-left: 10%;
    font-family: "NotoSansKR";
    float: right;
  }
  .price_text{
    width: 40%;
    font-size: 25px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    padding-left: 10%;
    float: left;
    font-family: "NotoSansKR";
  }
  .star_text{
    margin-top: 40px;
    width: 100%;
    font-size: 20px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    padding-left: 10%;
    font-family: "NotoSansKR";
    /* margin-top: 24px; */
  }
  .text_field{
    width: 80%;
  }
  .check_field{
    width: 10%;
    text-align: center;
  }
  .name_field{
    font-family: "NotoSansKR";
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: left;
    font-size: 25px;
    padding-left: 10%;
    width: 90%;
    float: left;
  }
  .vertical{
    width:19%;
    margin-top: 25px;
  }
  .button{

    height: 50px;
  }
  .hidden{
    display: none;
  }
  .w3-teal{
    color: #3b3b3b!important;
    background-color: #f2f2f2!important;
  }
  .h3{color:#3b3b3b; font-family: "NotoSansKR"}
  .star{width: 10%;float: right; text-align: right;}
  .clear{clear:both;}
</style>
</head>
<body>
	<div class="w3-content w3-container w3-margin-top">
		<div class="w3-container w3-card-4">
        <h3 class="h3">판매 내역</h3>
			<div>
        <?php
        	try {
        			// $start_s_value = empty($_REQUEST["start_s_value"]) ? "" : $_REQUEST["start_s_value"];
        		  // $s_value = empty($_REQUEST["s_value"]) ? "" : $_REQUEST["s_value"];
        			// if($start_s_value){
        			// 	$result = $dao->SelectPageLength($pid, 10, $s_value, $start_s_value);
        			//   $list = $dao->SelectPageList($result['current'], 10,$s_value, $start_s_value);
        			// }else{
        			$result = $dao->SelectPageLength($pid, 3, $mb_id ? $mb_id : 'null', $om_id ? $om_id : 'null','');
        			$list = $dao->SelectPageList($result['current'], 3, $mb_id ? $mb_id : 'null', $om_id ? $om_id : 'null','');
        		// }
        	} catch (PDOException $e) {
        	  $result = null;
        	  $list = null;
        	 echo $e->getMessage();
        	}
        ?>

        <?php foreach ($list as $row) : ?>
        <div class="w3-round w3-teal">
          <ul class="list">
          <li class="hidden check_field"><input type="checkbox" name="id[]" class="hidden" id="<?= $row['pr_id'] ?>" value=""></li>
          <li class="hidden"><?= $row['pr_id'] ?></li>
          <li class="list-li w3-round image_box"><img src="files/<?= $row['pr_img'] ?>" width="100%" height="100%" /></li>
          <div class="text_field">
            <li class="name_field"><?= $row['pr_title'] ?></li>
            <li class="clear"></li>
            <li class="sell_text"><?= $row['pr_status'] ?></li>
            <li class="clear"></li>
            <li class="price_text"><?= $row['pr_price'] ?></li>
            <li class="clear"></li>
            <li class="star_text"><span style="float:left;"><img src="img\little_star.png" /></span><?=$row['i_count'] ?><span class="station_text"><?= $row['l_name'] ?> <?= $row['pr_station'] ?></span></li>
          </div>
          </ul>
        </div>
      <?php endforeach ?>
      <div class="w3-center">
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
	</div>
  <script>
    $(document).ready(function(){
            /*웹페이지 열었을 때*/
            $("#img1").show();
            $("#img2").hide();

            /*img1을 클릭했을 때 img2를 보여줌*/
            $("#img1").click(function(){
                $("#img1").hide();
                $("#img2").show();
            });

            /*img2를 클릭했을 때 img1을 보여줌*/
            $("#img2").click(function(){
                $("#img1").show();
                $("#img2").hide();
            });
        });
  </script>
</body>
</html>
<?php } ?>
