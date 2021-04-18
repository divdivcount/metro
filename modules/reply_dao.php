<?php
  require_once('db_dao.php');

  class Reply extends MetroDAO {
    protected $quTable = 'reply';
    protected $quTableId = 'idx';


    public function reply_select($pr_id) {
      // 회원 출력
      $this->openDB();
      $query = $this->db->prepare("select * from $this->quTable where pr_id= :pr_id order by idx desc");
      $query -> bindValue(":pr_id", $pr_id, PDO::PARAM_STR);
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      var_dump($fetch);
      if($fetch){
        return $fetch;
      }
      else return null;
    }

  }
