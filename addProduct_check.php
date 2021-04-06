<?php
require_once("modules/notification.php");
require_once("modules/db.php");


// Parameter
// 호선과 역 둘로 나눠서 호선 id 가져와야함
$line = Post('lines', null);
$title = Post('title', null);
$price = Post('price', null);
$price_checking = Post('price_checking', null);
$category = Post('category', null);
$mb = Post('mb', null);
$om = Post('om', null);
$explainText = Post('explainText', null);
$a = 0;
// Functions
// echo $line."<br>";
// echo $title."<br>";
// echo $price."<br>";
// echo $price_checking."<br>";
// echo $category."<br>";
// echo $explainText."<br>";
// echo $mb ? $mb : $om."<br>";
// echo $om."<br>";
// Process
try {

  //제품을 먼저 추가 하고 pr_id를 불러 이미지 추가해야
  $productObj = new Product();
  $results = $productObj->Product_title_search($title,$om,$mb);
  // echo $pr_img_id."<br>";
  foreach ($results as $rows) {
    // echo $rows['pr_title']."<br>";
    if($rows['pr_title'] == $title){
      userGoto("이미 한번 입력된 제목 입니다.", "addProduct.php");
    }
}
$ftime = time();
$pm = ($mb ? $mb : $om).$title."val".$ftime;
// echo $pm;
// echo $pr_img_id ;


  $productObj->Upload('', 0, ['ca_name'=>$category,'mb_id'=>$mb,'om_id'=>$om,'l_id'=>$line,'pr_title'=>$title,'pr_price'=>$price ,'pr_explanation'=>$explainText, 'pr_check'=>$price_checking,'pr_img_id'=>$pm]);
  $result = $productObj->ProductAll($title,$om,$mb);
  foreach ($result as $row) {
    $pr = $row['pr_img_id'];
  }

  if($pr) {
    // echo $pr."<br>";
    // echo count($_FILES['files']['name'])."<br>";
    for($i=0; $i<count($_FILES['files']['name']); $i++) {
      if($_FILES['files']['type'][$i] == 'image/jpeg' || $_FILES['files']['type'][$i] == 'image/png' || $_FILES['files']['type'][$i] == 'image/gif') {
        // echo $i."<br>";
        if($i == 0){
          $y = 'y';
          // echo $y;
        }else{
          $y = 'n';
          // echo $y;
        }
        $productIMG = new Primg();
        $productIMG->Upload('files', $i, ['pr_img_id'=>$pm, "main_check" => $y]);
      }
    }
  }
} catch (Exception $e) {
  echo $e->getMessage();
  exit();
}
userGoNow('My_one_page.php');
?>
