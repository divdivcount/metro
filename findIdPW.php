<html>
    <head>
        <meta charset="utf-8">
        <title>아이디/비밀번호찾기</title>
        <link rel="stylesheet" href="css/css_findIdPw.css">
        <link rel="stylesheet" href="css/css_noamlfont.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="wrap">
            <div class="form-wrap">
                <div class="imgbox">
                  <img src="/img/metrocket.png" alt="">
                </div>
                <div id="imgbtn_box">
                  <img src="img/findid_top_btn_on.png" onclick="findId()">
                  <img src="img/findpw_top_btn_off.png" onclick="findPw()">
                </div>

                <!-- 아이디 찾는 폼 부분 -->
                <form id="findId" action="findId.php" class="input-group" method="post">

                  <div class="inputbox">
                    <div class="textbox"><div class="bluedot">*</div>이름</div>
                    <input type="text" name ="id" class="input-field" placeholder="User Id" required >
                  </div>

                  <div class="inputbox">
                    <div class="textbox"><div class="bluedot">*</div>이메일</div>
                    <input type="password" name ="pw" class="input-field" placeholder="Enter Password" required>
                  </div>

                  <div class="imgbox">
                    <input type="image" src="img/findid_btn.png" class="submit">
                  </div>
                </form>

                <!-- 비밀번호 찾는 폼 부분 -->
                <form id="findPw" action="findPw.php" class="input-group" method="post">
                  <div class="inputbox">
                    <div class="textbox"><div class="bluedot">*</div>이름</div>
                    <input type="text" id ="userName" name="userName" class="input-field_2" required>
                  </div>

                  <div class="inputbox">
                    <div class="textbox"><div class="bluedot">*</div>아이디</div>
                    <input type="text" id ="userId" name="userId" class="input-field_2" required>
                  </div>

                  <div class="inputbox">
                    <div class="textbox"><div class="bluedot">*</div>이메일</div>
                      <!-- 이메일 폼 부분 재구성함 수정 요함  -->
              					<input type="text" id="fitst_email" name="" value="" > <div style="font-family:'NotoSansKR_m';color:#3b3b3b;">@</div>
              					<input type="text" id="second_email" name="" value="">

              					<select id="selbox" class="" name="">
              						<option value="direct">직접입력</option>
              						<option value="naver.com">naver.com</option>
              						<option value="gmail.com">gmail.com</option>
              					</select>

              					<!-- <input type="text" name="mb_email" placeholder="이메일" value="<?php// echo $mb['mb_email'] ?>"> 기존 php 부분 일부러 놔둠 -->

                  </div>

                  <div class="imgbox">
                    <input type="image" src="img/findpw_btn.png" class="submit">
                  </div>
                </form>

                <div id="output">

                </div>
            </div>
        </div>

        <script  type="text/javascript">
            var x = document.getElementById("findId");
            var y = document.getElementById("findPw");
            var z = document.getElementById("btn");
            var f_id = document.getElementById('idbtn');
            var f_pw = document.getElementById('pwbtn');

            function findId(){
                x.style.left = "50px";
                y.style.left = "450px";
                z.style.left = "0";
                f_id.className = "onbtn";
                f_pw.className = "offbtn";

            }
            function findPw(){
                x.style.left = "-400px";
                y.style.left = "50px";
                z.style.left = "110px";
                f_id.className = "offbtn";
                f_pw.className = "onbtn";
            }


        </script>
    </body>
</html>
