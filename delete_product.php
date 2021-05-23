<?php
  require_once("modules/db.php");
  require_once("modules/product_dao.php");

  $pr_id = $_POST["pr_id"];
  $product = new Product;
  try {
    $product->admin_product_del($pr_id);
?>
    <script type="text/javascript">
      alert("정상적으로 삭제되었습니다.");
      location.href="My_one_page.php";
    </script>
<?php
  } catch (\Exception $e) {
?>
  <script type="text/javascript">
    alert("삭제중 오류가 발생했습니다. 지속적으로 오류발생시 알림톡을 이용해주세요");
  </script>
<?php
  }
?>
