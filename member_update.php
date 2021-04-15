<?php
require_once("modules/db.php");
  if(empty($_SESSION['ss_mb_id']) && empty($_SESSION['naver_mb_id']) && empty($_SESSION['kakao_mb_id']) ){
    echo "<script>alert('로그인을 해주세요');</script>";
    echo "<script>location.replace('./login.php');</script>";
  }else{
?>
<?php
if(isset($_SESSION['ss_mb_id'])){
  $mb_ids = $_SESSION['ss_mb_id'];
  $sql = " SELECT * FROM member WHERE mb_id = '$mb_ids' ";
  $result = mysqli_query($conn, $sql);
  $mb = mysqli_fetch_assoc($result);
  $mb_id = $mb['mb_num'];
  // echo  $mb_id;
}elseif(isset($_SESSION['naver_mb_id'])){
  $mb_ids = $_SESSION['naver_mb_id'];
  $mb_ids = substr($mb_ids, 5);
  $sql = " SELECT * FROM oauth_member WHERE om_id = $mb_ids ";
  $result = mysqli_query($conn, $sql);
  $om = mysqli_fetch_assoc($result);
  $mb_id = $om['om_id'];
  // echo  $mb_id;
}elseif(isset($_SESSION['kakao_mb_id'])){
  $mb_ids = $_SESSION['kakao_mb_id'];
  $mb_ids = substr($mb_ids, 5);
  $sql = " SELECT * FROM oauth_member WHERE om_id = $mb_ids ";
  $result = mysqli_query($conn, $sql);
  $om = mysqli_fetch_assoc($result);
  $mb_id = $om['om_id'];
  // echo  $mb_id;
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
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/css_my_one_page.css">
<link rel="stylesheet" href="css/css_noamlfont.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://unpkg.com/hangul-js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
  .w3-container{background-color: #fff;padding: 5.0rem 5.0rem;}
  .w3-container .h3{font-size: 3.0rem; font-family: "NotoSansKR_r";margin-bottom: 3.0rem;}

  .button_contatiner_margin{padding: 5.0rem 0;font-size: 2.0rem;}
  .button_contatiner_margin .w3-button{width: 18.0rem;}
  .p_container_margin{}


  #userInfo_box{
    font-family: "NotoSansKR_r";
    font-size: 2.3rem;
    width: 85%;
    display: grid;
    margin: 0 auto;
    grid-template-columns: minmax(200px ,30%) minmax(250px,1fr);
    grid-row-gap:2.5rem;
    justify-content: flex-end;
  }


  .input_id ,.input_name, .input_email,.input_password,.input_new_password,.input_new_exisit_password{
    width: 100%;
    max-width: 400px;
  }
  #selectMetro_box{
    width: 80%;
    height: 260px;
    display: none;
    flex-direction: column;
    align-items: center;
    background-color: #f9f9f9;
    box-shadow: 10px 10px 50px 0 rgba(0, 0, 0, 0.16);
    padding: 1.0rem 2.0rem;
    z-index: 1;
    position: absolute;
    top: 50%;
    left: 50%;
    transform:translate(-50%,-50%);
    border-radius: 30px;
    font-family: "NotoSansKR_r";
    font-size:2.3rem;
  }

  #selectMetro_box .title_line{width: 100%;display: flex;justify-content: flex-end;}
  #selectMetro_box .input_line{display: flex;justify-content: space-between;height: 80%;align-items: center;}
  #selectMetro_box span{font-size:1.8rem;color: #a1a1a1;}
  #selectMetro_box .find_item{width: 45%;border-bottom: 3px solid #a5a5a5;}
  #selectMetro_box .w3-button{width:20%;height: 7.0rem;font-family: "NotoSansKR_r";}
  #selectMetro_box .w3-input{outline: none;background-color:#f9f9f9!important;border: none;}
  #selectMetro_box .w3-select{outline: none;background-color:#f9f9f9!important;border: none;}
  #selectMetro_box .find_item:nth-child(1){}
  #selectMetro_box #bothFind_item{display: flex;width: 75%;flex-direction: row;justify-content: space-between;align-items: center;}

  .cloaseBtn{cursor: pointer;}

  #station {width: 100%;display: flex;}
  #station input{max-width: 300px;width: 70%;}
  #station button{font-size:1.5rem;color: #5e5956;min-width: 80px;height: auto;}


  @media only screen and (min-width: 1920px) {
  }
  @media only screen and (max-width: 1440px) {
  }
  @media only screen and (max-width: 1024px) {
  }
  @media only screen and (max-width: 768px) {
    #userInfo_box{width: 100%;}
  }
  @media only screen and (max-width: 540px) {
    #userInfo_box{grid-template-columns: 40% 60%;}
  }
  @media only screen and (max-width: 425px) {
    .w3-container{background-color: #fff;padding: 3.0rem 3.0rem;}
    #userInfo_box{grid-template-columns: 45% 55%;}
    #station {flex-direction: column;}
    #station input{max-width: 300px;width: 100%;}
    #station button{max-width: 100px;margin: 2.0rem 0 0 auto ;}
  }
  @media only screen and (max-width: 360px) {
    .button_contatiner_margin .w3-button{width: 18rem}
  }


</style>
</head>
<body>
<?php
// echo $mb["mb_id"] ? $mb["mb_id"] : $om["om_id"];
// echo $mb["mb_name"] ? $mb["mb_name"] : $om["om_nickname"];
// echo $mb["mb_email"] ? $mb["mb_email"] : $om["om_email"];
?>
<div class="w3-container">
  <h3 class="h3">회원정보 수정</h3>


  <form id="pwForm" name="frm1" class="p_container_margin" action="register_update.php" method="post">
    <div id="userInfo_box">

      <span>아이디<input type="hidden" name="mode" value="modify"></span>
      <input class="input_id" type="text" id="id" name="id" readonly value="<?= $mb["mb_id"] ? $mb["mb_id"] : $om["om_id"] ?>">

      <label><span class="blue">*</span>현재 비밀번호</label>
      <input class="input_password" id="old_pw" name="old_pw" type="password" <?php echo ($mb["mb_id"] ? "" : "readonly") ?> required >

      <label><span class="blue">*</span>새 비밀번호</label>
      <input class="input_new_password" name="mb_password" type="password" <?php echo ($mb["mb_id"] ? "" : "readonly") ?> required>

      <label><span class="blue">*</span>비밀번호 확인</label>
      <input class="input_new_exisit_password" name="mb_password_re" type="password" <?php echo ($mb["mb_id"] ? "" : "readonly") ?> required>

      <label>이름</label>
      <input class="input_name" type="text" id="name" name="mb_name" value="<?=$mb["mb_name"] ? $mb["mb_name"] : $om["om_nickname"] ?>"  readonly required>

      <label>이메일</label>
      <input class="input_email" type="text" id="email" name="mb_email" value="<?=$mb["mb_email"] ? $mb["mb_email"] : $om["om_email"] ?>"  readonly required>

      <label><span class="blue">*</span>주변 역 설정하기</label>
      <div id="station" style="display:flex;"><input class="input_station" type="text" id="pw2" value="<?=$mb['line_station'] ? $mb['line_station'] : $om['line_station']?>" required>	<button type="submit" id="joinBtn" class="w3-button w3-light-gray w3-round">역 검색</button></div>


      </div>
    </form>



    <form  id="selectMetro_box" action="station_update.php" method="post">
      <input type="hidden" name="mode" value="modify">
      <input type="hidden" name="mbs_id"  value="<?= $mb["mb_id"] ? $mb["mb_id"] : 'null' ?>">
      <input type="hidden" name="om_id"  value="<?= $om["om_id"] ? $om["om_id"] : 'null' ?>">

      <div class="title_line">
        <div class="cloaseBtn"><img src="img/cancle.png" class="close_pop"></div>
      </div>

      <div class="input_line">

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
          <div style="display:flex"><input id="auto" class="w3-input highlight" name="station" value='' type="text"><div style="width:1.3rem;margin:auto"><img src="img\loupe.png" alt=""></div></div>
        </div>

        </div>

        <button type="submit" class="w3-button w3-blue w3-ripple w3-round-xxlarge close_pop" name="button">등록</button>
      </div>



  </form>

    <p class="w3-center button_contatiner_margin">
      <button type="submit" class="w3-button  w3-blue w3-ripple w3-margin-top w3-round" onclick="document.getElementById('pwForm').submit();">비밀번호 변경</button>
      <button type="button" class="w3-button w3-dark-gray w3-ripple w3-margin-top w3-round">회원 탈퇴</button>
    </p>

</div>
</body>
<script type="text/javascript">
$(document).ready(function(){
  popup();

  function popup(){
    open_pop();
    close_pop();
  }
  function open_pop(){
    $('#joinBtn').click(function(){
      $('#selectMetro_box').css({'display':'flex'});
    });
  }
  function close_pop(){
    $('.close_pop').click(function(){
      $('#selectMetro_box').css({'display':'none'});
    });
  }
});
</script>
</html>
<?php } ?>
