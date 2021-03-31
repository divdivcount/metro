<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/css_addProduct.css">
    <link rel="stylesheet" href="css/css_noamlfont.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <!-- 상단 메뉴 부분 -->
    <?php require_once 'metrocket_header.php'; ?>


    <div id = "wrapContainer_Box">
      <div id="pageTitle_box" class="radius_box">
        <div class="title_box" style="justify-content: space-between;">
          <h2 style="font-size:2.8rem">상품등록하기</h2>

          <!-- php 나 스크립트로 뜨게 해야하는 부분 추후 수정 -->
          <span>인증역:0호선 0000역</span>
        </div>

      </div>

      <!-- 폼  -->
      <form class="" action="addProduct.php" method="get">

      <!-- 제목 입력 부분 -->
      <div id="insertTitle_box" class="radius_box" >

        <div class="title_box">
          <h2><d>*</d>제목입력</h2>
          <span>100자 이하로 입력해 주세요.</span>
        </div>

        <div class="content_box">
          <input class="w3-input" type="text">
          <!-- php 추가예정  -->
          <div id="checkTextSize">0/100</div>
        </div>

      </div>

      <!-- 판매가 책정 부분 -->
      <div id="insertPrice_box" class="radius_box">

        <div class="title_box">
          <h2><d>*</d>판매가</h2>
        </div>

        <div class="content_box">
          <input class="w3-input" type="text">
          &#8361;
        </div>
      </div>

      <!-- 카테고리 선택 부분 -->
      <div id="insertCategory_box" class="radius_box">
        <div class="title_box">
          <h2><d>*</d>카테고리 설정 </h2>
          <span> 원하시는 카테고리를 설정해 주세요.</span>
        </div>

        <div class="content_box">
          <div class="categoryGrid_box">
            <label><input type="radio" class="test" name="category" value="디지털/가전">디지털/가전</label>
            <label><input type="radio" class="test" name="category" value="가구/인테리어">가구/인테리어</label>
            <label><input type="radio" class="test" name="category" value="유아동/유아도서">유아동/유아도서</label>
            <label><input type="radio" class="test" name="category" value="생활/가공식품">생활/가공식품</label>
            <label><input type="radio" class="test" name="category" value="스포츠/레저">스포츠/레저</label>
            <label><input type="radio" class="test" name="category" value="여성잡화">여성잡화</label>
            <label><input type="radio" class="test" name="category" value="여성의류">여성의류</label>
            <label><input type="radio" class="test" name="category" value="남성패션/잡화">남성패션/잡화</label>
            <label><input type="radio" class="test" name="category" value="게임/취미">게임/취미</label>
            <label><input type="radio" class="test" name="category" value="반려동물용품">반려동물용품</label>
            <label><input type="radio" class="test" name="category" value="도서/티켓/음반">도서/티켓/음반</label>
            <label><input type="radio" class="test" name="category" value="식물">식물</label>
            <label><input type="radio" class="test" name="category" value="기타 중고물품">기타 중고물품</label>
            <label><input type="radio" class="test" name="category" value="뷰티/미용">뷰티/미용</label>
          </div>
        </div>
      </div>

      <!-- 상품이미지 업로드 부분 -->
      <div id="insertImg_box" class="radius_box">
        <div class="title_box">
          <h2><d>*</d>상품이미지 </h2>
          <span> 최소 1개 이상의 이미지를 업로드 해주세요</span>
        </div>

        <div class="content_box">
          <div class="imgGrid_box">
            <div class="img_Item">
              <span><d>*</d>메인 이미지</span>
              <img class ="productImg" src="img\add_img.png" alt="">
            </div>

            <div class="img_Item">
              <span>추가 이미지</span>
              <img class ="productImg" src="img\add_img.png" alt="">
            </div>

            <div class="img_Item"><img class ="productImg" src="img\add_img.png" alt=""></div>
            <div class="img_Item"><img class ="productImg" src="img\add_img.png" alt=""></div>
            <div class="img_Item"><img class ="productImg" src="img\add_img.png" alt=""></div>
            <div class="img_Item"><img class ="productImg" src="img\add_img.png" alt=""></div>
            <input type="file" id="real-input" name="image" class="image_inputType_file" accept="img/*" style="display:none" required multiple>

          </div>

        </div>
      </div>

      <!-- 상세설명 작성 부분  -->
      <div id="insertText_box" class="radius_box">

        <div class="title_box">
          <h2><d>*</d>상세설명</h2>
        </div>

        <div class="content_box">
          <textarea name="text" rows="10" cols="80" style="width:100%" placeholder="내용을 작성해 상품을 소개해 주세요."></textarea>
        </div>

      </div>

    <div class="btn_box">
      <input class="w3-button w3-blue w3-round-large" type="submit" name="" value="완료">
      <input class="w3-button w3-round-large" type="button" name="" value="취소">
      </div>

      </form>
      <!-- 폼끝  -->

    </div>
    <!-- 푸터 부분  -->
    <?php require_once 'metrocket_footer.php';?>
  </body>
  <script type="text/javascript">
    //const browseBtn = document.querySelector('.img_Item');
    const img_Item = document.getElementsByClassName('img_Item');
    const realInput = document.getElementById('real-input');
    const productImg = document.getElementsByClassName('productImg');
    var img = document.getElementById('test');
    for (var i = 0; i < 5; i++) {
      img_Item.item(i).addEventListener('click',()=>{
       realInput.click();
     });
    }


    realInput.addEventListener('change',function(){
      if (this.files.length > 6) {
        alert('사진은 6장만 등록이 가능합니다');
        realInput.value="";
      }

      for (var i = 0; i < this.files.length; i++) {
        if(this.files[i].type!='image/jpeg' && this.files[i].type!='image/png') {
          alert('jpg 및 png 이미지를 업로드해주세요');
          realInput.value="";
        }else{
          productImg.item(i).src=URL.createObjectURL(this.files[i]);
        }
      }
    })






  </script>
</html>
