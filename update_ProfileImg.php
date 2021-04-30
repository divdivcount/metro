<?php
  require_once("modules/db.php");

  $member_num = $_POST["member_num"];

  if ($_FILES['files']['name'] != "") {
    echo "1<br>";
    if($_FILES['files']['type'] == 'image/jpeg' || $_FILES['files']['type'] == 'image/png' || $_FILES['files']['type'] == 'image/gif') {
      $productIMG = new Member();
      $userprofile_img[] = $productIMG->fileUploader($_FILES['files']);
      $fileName ="";
      $fileName = $userprofile_img[0]['mb_image'];

      $productIMG->Delete_mbImg($member_num);

      $query = "update member set mb_image='$fileName' where mb_num = TRIM($member_num)";
      $result = mysqli_query($conn, $query);
      echo "2<br>";
    }
  }else{
    $productIMG = new Member();
    echo "3<br>";
    $query = "update member set mb_image = 'img/normal_profile.png' where mb_num = TRIM($member_num)";
    $result = mysqli_query($conn, $query);
    echo "4<br>";
    $productIMG->Delete_mbImg($member_num);
    echo "5<br>";
  }


 ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title></title>
    </head>
    <body>
      <script type="text/javascript">
        alert("프로필 정보가 성공적으로 저장되었습니다");
        history.back();
      </script>
    </body>
  </html>
