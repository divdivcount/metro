<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require_once("modules/admin.php");
  $dao = new Member;
  $pid = Get('p', 1);

  if(isset($_SESSION['ss_mb_id']) && $_SESSION['ss_mb_id'] !== 'admin'){
    echo "<script>alert('로그인을 해주세요');</script>";
    echo "<script>location.replace('./index.php');</script>";
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      tbody tr:hover{background-color:orange};
    </style>
  </head>
  <body>
    <div>
      <form action="admin_member_block_list.php" method="get">
        <input type="hidden" name="p" value="<?=$pid?>">
        <input type="text" name="s_value" >
        <input type="submit" value="검색하기">
      </form>
    </div>
    <div>
        <table style="width : 100%;">
            <thead style="width : 100%;">
              <tr>
                <th>
                  회원 이름
                </th>
                <th>
                  회원 아이디
                </th>
                <th>
                  인증 받은 이메일
                </th>
                <th>
                  가입일
                </th>
                <th>
                  해당 위치(호선, 역)
                </th>
                <th>
                  신고 수
                </th>
              </tr>
            </thead>
            <?php
              try {
                $s_value = Get('s_value', null);
                if(empty($s_value) == true){
                  $result = $dao->mem_SelectPageLength($pid, 8, 'admin','null','');
                  $list = $dao->mem_SelectPageList($result['current'], 8, 'admin','null','');
                  // echo "none";
                }else{
                  $result = $dao->mem_SelectPageLength($pid, 8,  'admin','null',$s_value);
                  $list = $dao->mem_SelectPageList($result['current'], 8, 'admin','null',$s_value);
                  // echo "go";
                  // echo $s_value;
                }
              } catch (PDOException $e) {
                $result = null;
                $list = null;
               echo $e->getMessage();
              }
            ?>
            <tbody style="width : 100%;">
              <?php foreach ($list as $admin_lists): ?>
                <tr style="cursor:pointer;" onclick="location.href='admin_member_detail.php?all=<?=$admin_lists["mb_name"]?>&mball=<?=$admin_lists["mb_id"]?>'">
                  <td><?=$admin_lists["mb_name"]?></td>
                  <td><?=$admin_lists["mb_id"]?></td>
                  <td><?=$admin_lists["mb_email"]?></td>
                  <td><?=$admin_lists["mb_datetime"]?></td>
                  <td><?=$admin_lists["line_station"]?></td>
                  <td><?=$admin_lists["rep_count"]?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div id="pagenation_box"class="w3-center">
        <?php
        if($result['start'] < $result['current'] ) :?>
          <a class="abtn" href="admin_member_block_list.php?p=<?=($pid - 1)?>&s_value=<?=$s_value?>">&lt;</a>
        <?php endif ?>

        <?php for($i=$result['start']; $i<=$result['end']; $i++): ?>
          <a class="abtn <?php if($i === (int)$result['current']) echo 'current' ?>" href="?p=<?= $i ?>&s_value=<?=$s_value?>"><?= $i ?></a>
        <?php endfor ?>

        <?php if( $result['end'] > $result['current']) : ?>
          <a class="abtn" href="admin_member_block_list.php?p=<?=($pid + 1)?>&s_value=<?=$s_value?>">&gt;</a>
        <?php endif ?>
    </div>
  </body>
</html>
