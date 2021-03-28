<?php
require_once('modules/db.php');
$member_search = new Member;

$mb_name = Post("mb_name",0);
$mb_email = Post("mb_email",0);
if($mb_name && $mb_email){
  $member_searchs = $member_search->Member_Search($mb_name, $mb_email);
  foreach ($member_searchs as $row) {
    $row['mb_id'];
  }
  ?>
  <script>
      alert("<?=$row['mb_id']?>");
  </script>
  <?php
}



 ?>
