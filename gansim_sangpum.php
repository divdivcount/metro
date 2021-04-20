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

  #controlBtn_box{
    display: flex;
    justify-content: space-between;
  }
  #reviseProduct_btn, #completeSale_btn, #deleteProduct_btn{

  }
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
          <li>


            <!-- 여기 건들이면 큰일남 할때 언급좀  -->
            <div class="controlBtn_box" data-sell_check = "0">
              <button type="button" data-test ="0" class="reviseProduct_btn w3-button w3-blue w3-round">수정하기</button>
              <button type="button" class="completeSale_btn w3-button w3-light-grey w3-round" onclick="completeSale(this)">판매완료</button>
              <button type="button" class="deleteProduct_btn w3-button w3-dark-grey w3-round">삭제하기</button>
            </div>
            <!--  여기 건들이면 큰일남 할때 언급좀  -->


          </li>
          </ul>
        </div>


			</div>
		</div>
	</div>
</body>
<script type="text/javascript">

  //   판매여부에따라 버튼 출력 방식
  var reviseProduct_btn = document.getElementsByClassName('reviseProduct_btn');
  var completeSale_btn = document.getElementsByClassName('completeSale_btn');
  var deleteProduct_btn =   document.getElementsByClassName('deleteProduct_btn');
  var controlBtn_box = document.getElementsByClassName('controlBtn_box');

  window.onload = function() {
    for (var i = 0; i < controlBtn_box.length; i++) {
      if (controlBtn_box.item(i).dataset.sell_check == "0") { //판매 완료가 false(0)이면  삭제버튼 감추기
        completeSale_btn.item(i).style.display="block";
        reviseProduct_btn.item(i).style.display="block";
        deleteProduct_btn.item(i).style.display="none";
      }else if (controlBtn_box.item(i).dataset.sell_check == "1") { //판매 완료가 true(1)이면  수정 및 판매완료 버튼 감추기
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
</html>
