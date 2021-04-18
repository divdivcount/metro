<?php
  require_once("modules/db.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="http://code.jquery.com/jquery-latest.js"></script>
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
    color: var(--greyish-brown);
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
    display: hidden;
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
        <h3 class="h3">관심 목록</h3>
			<div>


        <div class="w3-round w3-teal">
          <ul class="list">
          <!-- <li class="list-li check_field"><input type="checkbox" name="id[]" class="hidden" id="<?= $row['id'] ?>" value=""></li> -->
          <!-- <li class="hidden">aaaaa</li> -->
          <li class="list-li w3-round image_box"><img src="img/test_sang.png" width="100%" height="100%" /></li>
          <div class="text_field">
            <li class="name_field">i7-9세대 중고컴퓨터/ 144hz 중고모니터...</li>
            <li class="star"><img src="img/bin_star.png" /></li>
            <li class="clear"></li>
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
            <li class="sell_text">판매중</li>
            <li class="clear"></li>
            <li class="price_text">123원</li>
            <li class="clear"></li>
            <li class="star_text"><span style="float:left;"><img src="img\little_star.png" /></span>1<span class="station_text">8호선 수진역</span></li>
            <!-- <li class="sation_text">8호선 수진역</li> -->
            <!-- <li class="list-li date_text">등록일시 :</li> -->
          </div>
          </ul>
        </div>


			</div>
		</div>
	</div>
</body>
</html>
