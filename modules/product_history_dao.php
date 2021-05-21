<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/modules/module_protect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/modules/db_dao.php');

class Product_history extends MetroDAO {
  protected $quTable = 'product_history';
  protected $quTableId = 'pu_id';

  public function product_history_update($pr_id, $selectId, $member_check) {
    // 회원 출력
    $this->openDB();
    $query = $this->db->prepare("update product_history set :member_check = :selectId where pr_id = :pr_id ");
    $query -> bindValue(":pr_id", $pr_id, PDO::PARAM_INT);
    $query->bindValue(':selectId', $selectId, PDO::PARAM_STR);
    $query->bindValue(':member_check', `$member_check`, PDO::PARAM_STR);
    $query->execute();
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($fetch);
    if($fetch){
      return $fetch;
    }
    else return null;
  }


}
  ?>
