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
            echo "일반 아이디";
          }elseif(isset($naver['om_id'])){
            echo "<ul>"."&nbsp;<a href='./addProduct.php'><li>상품등록</li></a>"."&nbsp;<a href='./User_page.php'><li>채팅</li></a>"."&nbsp;<a href='My_one_page.php'><li>마이페이지</li></a>"."&nbsp;<a href='./oauth_logout.php'><li>로그아웃</li></a>"."</ul>";
            echo "네이버 아이디";
          }elseif(isset($kakao['om_id'])){
            echo "<ul>"."&nbsp;<a href='./addProduct.php'><li>상품등록</li></a>"."&nbsp;<a href='./User_page.php'><li>채팅</li></a>"."&nbsp;<a href='My_one_page.php'><li>마이페이지</li></a>"."&nbsp;<a href='./oauth_logout.php'><li>로그아웃</li></a>"."</ul>";
            echo "카카오 아이디";
          }
          else {
            echo "<ul><a href='./login.php'><li>login</li></a></ul>";
          }
         ?>
      </div>
    </div>
