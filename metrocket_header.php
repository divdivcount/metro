<!-- 최상단 로고 및 상단메뉴 -->
    <div id="topMenu_box">
      <!-- 상단 로고 -->
      <div class="imgbox_1">
        <a href="index.php"><img src="img\mainlogo.png" alt=""></a>
      </div>

      <!-- 상단 툴바 -->
      <div id="topToolbar_box">
        <?php
          if(isset($mb['mb_num'])){
            echo "<ul>"."&nbsp;<a href='./addProduct.php'><li>상품등록</li></a>"."&nbsp;<a href='./User_page.php'><li>채팅</li></a>"."&nbsp;<a href='My_one_page.php'><li>마이페이지</li></a>"."&nbsp;<a href='./logout.php'><li>로그아웃</li></a>"."</ul>";
            // echo "일반 아이디";
          }elseif(isset($om['om_id'])){
            echo "<ul>"."&nbsp;<a href='./addProduct.php'><li>상품등록</li></a>"."&nbsp;<a href='./User_page.php'><li>채팅</li></a>"."&nbsp;<a href='My_one_page.php'><li>마이페이지</li></a>"."&nbsp;<a href='./oauth_logout.php'><li>로그아웃</li></a>"."</ul>";
            // echo "네이버 아이디";
          }else {
            echo "<ul><li onclick='openLoginPage()'>login</li></ul>";
          }
         ?>
         <script type="text/javascript">
         // 판매 팝업 페이지 열기
        function openLoginPage() {
          var popupWidth = 1080;
          var popupHeight = 650;

          var popupX = Math.ceil(( window.screen.width - popupWidth )/2);
          var popupY= Math.ceil(( window.screen.height - popupHeight )/2);

          var add = open('login.php',"로그인 페이지",'width='+ popupWidth +', height='+ popupHeight +', left=' + popupX + ', top='+ popupY +'location= no');
          }
         </script>
      </div>
    </div>
