<?php
  require_once("modules/dbconn.php");
  if(!(empty($_SESSION['ss_mb_id']) || empty($_SESSION['naver_mb_id']) || empty($_SESSION['kakao_mb_id']))){
      echo "123";
  }else{
    if(isset($_SESSION['ss_mb_id'])){
      $mb_id = $_SESSION['ss_mb_id'];
      $sql = " select * from member where mb_id = TRIM('$mb_id') ";
      $result = mysqli_query($conn, $sql);
      $mb = mysqli_fetch_assoc($result);
    }elseif(isset($_SESSION['naver_mb_id'])){
      $om_id = $_SESSION['naver_mb_id'];
      $om_id = substr($om_id, 5);
      $sql = " select * from oauth_member where om_id = TRIM($om_id) ";
      $result = mysqli_query($conn, $sql);
      $om = mysqli_fetch_assoc($result);
    }elseif(isset($_SESSION['kakao_mb_id'])){
      $oms_id = $_SESSION['kakao_mb_id'];
      $oms_id = substr($oms_id, 5);
      // echo $oms_id;
      $sql = " select * from oauth_member where om_id = TRIM($oms_id) ";
      $result = mysqli_query($conn, $sql);
      $om = mysqli_fetch_assoc($result);
    }else{
      echo "???";
    }


    $rno = $_GET['rno'];
    echo $rno;
    $bno = $_GET['b_no'];
    echo $bno;
    $sql = "select * from reply where idx=$rno";
    $replys = mysqli_query($conn, $sql);
    $replyss = mysqli_fetch_assoc($replys);
    var_dump($replyss);

    $sql2 = "select * from product where pr_id=$bno";
    $pro_board = mysqli_query($conn, $sql);
    $pro_boards = mysqli_fetch_assoc($pro_board);
    var_dump($replyss);
    $all_id = $mb["mb_num"] ? $mb["mb_num"] : $om["om_id"];
    echo $all_id;
    echo $replyss['mb_id'];
    echo $replyss['om_id'];
    if($all_id == $replyss['mb_num'] || $all_id == $replyss['om_id']) {
       $sql = mq("delete from reply where idx=$rno");
  ?>
      <script>
        alert("댓글이 삭제 되었습니다.");
      </script>
      <meta http-equiv="refresh" content="0 url=/searchProduct_detail.php?id=<?=$bno?>&u_id=<?= $all_id ?>">
    <?php
  }else{
?>
    <script>
      alert('본인의 댓글이 아니거나 비밀번호가 틀립니다');
      // history.back();
    </script>
<?php
  }
}
?>
