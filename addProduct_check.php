<?php
require_once("modules/notification.php");
require_once("modules/db.php");


// Parameter
// 호선과 역 둘로 나눠서 호선 id 가져와야함
$descriptions = Post('names', null);
$title = Post('title', null);
$price = Post('price', null);
$price_checking = Post('price_checking', null);
$category = Post('category', null);
$price = Post('price', null);
// Functions

// Process
try {
  $productObj = new Product($DBconfig['dburl'], $DBconfig['dbid'], $DBconfig['dbpw'], $DBconfig['dbtable'], $DBconfig['dbtype']);
  //제품을 먼저 추가 하고 pr_id를 불러 이미지 추가해야
  if($descriptions) {
    for($i=0; $i<count($_FILES['files']['name']); $i++) {
      if($_FILES['files']['type'][$i] == 'image/jpeg' || $_FILES['files']['type'][$i] == 'image/png' || $_FILES['files']['type'][$i] == 'image/gif') {
        $galleryObj->Upload('files', $i, ['description'=>$descriptions[$i]]);
      }
    }
  }
} catch (Exception $e) {
  echo $e->getMessage();
  exit();
}
userGoNow('/gallery_list.php');
?>
