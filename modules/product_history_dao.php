<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/modules/module_protect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/modules/db_dao.php');

class Product_history extends MetroDAO {
  protected $quTable = 'product_history';
  protected $quTableId = 'pu_id';

  public function product_history_update($pr_id, $selectId, $member_check) {
    // 회원 출력
    $this->openDB();
    if($member_check === "mb_id"){
      $query = $this->db->prepare("update product_history set `$member_check` = :selectId, om_id = null where pr_id = :pr_id ");
      $query -> bindValue(":pr_id", $pr_id, PDO::PARAM_INT);
      $query->bindValue(':selectId', $selectId, PDO::PARAM_STR);
      $query->execute();
    }elseif($member_check === "om_id"){
      $query = $this->db->prepare("update product_history set `$member_check` = :selectId, mb_id = null where pr_id = :pr_id ");
      $query -> bindValue(":pr_id", $pr_id, PDO::PARAM_INT);
      $query->bindValue(':selectId', $selectId, PDO::PARAM_STR);
      $query->execute();
    }
  }
}
  ?>
