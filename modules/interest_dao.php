<?php
  require_once('db_dao.php');

  class Interest extends MetroDAO {
    protected $quTable = 'interest';
    protected $quTableId = 'in_id';

    public function in_insert($pr_id,$mb_id,$om_id, $in_hit) {
      $this->openDB();
      if($mb_id != 'null'){
        $query = $this->db->prepare("insert into $this->quTable (pr_id, mb_id, in_hit) values (:pr_id, :mb_id, :in_hit)");
        $query -> bindValue(":mb_id", $mb_id, PDO::PARAM_INT);
      }else if($om_id != 'null'){
        $query = $this->db-prepare("insert into $this->quTable (pr_id, om_id, in_hit) values (:pr_id, :om_id, :in_hit)");
        $query -> bindValue(":om_id", $om_id, PDO::PARAM_INT);
      }
      $query -> bindValue(":pr_id", $pr_id, PDO::PARAM_INT);
      $query -> bindValue(":in_hit", $in_hit, PDO::PARAM_INT);
      $query->execute();
    }

    public function in_select($pr_id,$mb_id,$om_id) {
      $this->openDB();
      if($mb_id != 'null'){
        $query = $this->db->prepare("select * from $this->quTable where pr_id = :pr_id  and mb_id= :mb_id");
        $query -> bindValue(":mb_id", $mb_id, PDO::PARAM_INT);
      }else if($om_id != 'null'){
        $query = $this->db->prepare("select * from $this->quTable where pr_id = :pr_id and om_id = :om_id");
        $query -> bindValue(":om_id", $om_id, PDO::PARAM_INT);
      }
      $query -> bindValue(":pr_id", $pr_id, PDO::PARAM_INT);
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      if($fetch){
        return $fetch;
      }
      else return null;
    }

    public function in_update($pr_id,$mb_id,$om_id,$in_hit) {
      $this->openDB();
      if($mb_id != 'null'){
        $query = $this->db->prepare("update $this->quTable set in_hit=:in_hit where pr_id=:pr_id and mb_id=:mb_id");
        $query -> bindValue(":mb_id", $mb_id, PDO::PARAM_INT);
      }else if($om_id != 'null'){
        $query = $this->db->prepare("update $this->quTable set in_hit=:in_hit where pr_id=:pr_id and om_id=:om_id");
        $query -> bindValue(":om_id", $om_id, PDO::PARAM_INT);
      }
      $query -> bindValue(":pr_id", $pr_id, PDO::PARAM_INT);
      $query -> bindValue(":in_hit", $in_hit, PDO::PARAM_INT);
      $query->execute();
    }


}
