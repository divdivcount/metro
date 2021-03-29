<?php
  require_once("modules/db.php");
  $old_pw= Post("old_pw",0);
  $pw = Post("pw",0);
  $pw2 = Post("pw2",0);
  $sql = "select * from member where mb_id='{$_POST['mb_id']}'"; // 회원가입을 시도하는 아이디가 사용중인 아이디인지 체크
  $result = mysqli_query($conn, $sql);
  $id_check = mysqli_num_rows($result);
  if(){}
 ?>
