<?php
require_once('db_dao.php');

class Product extends MetroDAO {
  protected $quTable = 'product';
  protected $quTableId = 'pr_id';

    public function ProductAll($title, $om, $mb) {
      // echo "-----------------------------"."<br>";
      // echo $title."<br>";
      // echo $om."<br>";
      // echo $mb."<br>";
      // echo "-----------------------------"."<br>";
      // 회원 출력
      if($om == ''){
        $om = 'null';
        // echo $om."<br>";
      }elseif($mb == ''){
        $mb = 'null';
        // echo $mb."<br>";
      }
      $this->openDB();
      $query = $this->db->prepare("select * from $this->quTable where pr_title = '$title' and mb_id=$mb or om_id = '$om' and pr_block = 1");
      $query -> bindValue(":title", $title, PDO::PARAM_STR);
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      if($fetch){
        return $fetch;
      }
      else return null;
    }
    public function Product_title_search($title, $om, $mb) {
      // echo "-----------------------------"."<br>";
      // echo $title."<br>";
      // echo $om."<br>";
      // echo $mb."<br>";
      // echo "-----------------------------"."<br>";
      if($om == ''){
        $om = 'null';
      }elseif($mb == ''){
        $mb = 'null';
      }
      $this->openDB();
      $query = $this->db->prepare("select * from $this->quTable where pr_title = '$title' and mb_id=$mb or om_id = '$om' and pr_block = 1");
      $query -> bindValue(":title", $title, PDO::PARAM_STR);
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      if($fetch){
        return $fetch;
      }
      else return null;
    }

    public function Product_img_code($pr_id, $mb, $om) {

      $this->openDB();
      if($mb != 'null' && $om == 'null'){
        $query = $this->db->prepare("select p.pr_img_id from product p where pr_id = :pr_id and mb_id=:mb and om_id is null and pr_block = 1");
        $query -> bindValue(":mb", $mb, PDO::PARAM_INT);
      }elseif($mb == 'null' && $om != 'null'){
        $query = $this->db->prepare("select p.pr_img_id from product p where pr_id = :pr_id and om_id=:om and mb_id is null and pr_block = 1");
        $query -> bindValue(":om", $om, PDO::PARAM_INT);
      }
      $query -> bindValue(":pr_id", $pr_id, PDO::PARAM_INT);
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      if($fetch){
        return $fetch;
      }
      else return null;
    }

    public function Product_update_search($pr_id, $mb, $om) {

      $this->openDB();
      if($mb != 'null' && $om == 'null'){
        $query = $this->db->prepare("select p.pr_id,p.ca_name,p.l_id,p.pr_station,p.pr_title,p.pr_price,p.pr_explanation,p.pr_check,group_concat(pi.pr_img) as pr_img from product p left outer join product_img pi on pi.pr_img_id = p.pr_img_id where pr_id = :pr_id and mb_id=:mb and om_id is null and pr_block = 1");
        $query -> bindValue(":mb", $mb, PDO::PARAM_INT);
      }elseif($mb == 'null' && $om != 'null'){
        $query = $this->db->prepare("select p.pr_id,p.ca_name,p.l_id,p.pr_station,p.pr_title,p.pr_price,p.pr_explanation,p.pr_check,group_concat(pi.pr_img) as pr_img from product p left outer join product_img pi on pi.pr_img_id = p.pr_img_id where pr_id = :pr_id and om_id=:om and mb_id is null and pr_block = 1");
        $query -> bindValue(":om", $om, PDO::PARAM_INT);
      }
      $query -> bindValue(":pr_id", $pr_id, PDO::PARAM_INT);
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      if($fetch){
        return $fetch;
      }
      else return null;
    }

    public function Product_status_update($pr_id) {
      // 회원 정보 1명 찾기
      $this->openDB();
      $query = $this->db->prepare("update product set mb_name = '거래완료' where pr_id = :pr_id");
      $query->bindValue(":pr_id", $pr_id, PDO::PARAM_INT);
      $query->execute();

      $query = $this->db->prepare("select * from product where pr_id=:pr_id");
      $query->bindValue(":pr_id", $pr_id, PDO::PARAM_INT);


      while ($fetch = $query->fetch(PDO::FETCH_ASSOC)) {
        $status = $fetch['pr_status'];
        var_dump($status);
        if($status === '거래완료') {
          $last_id = 0;
          $query = $this->db->prepare("insert into product_history valuse (null, {$fetch['pr_id']},{$fetch['pr_img_id']},{$fetch['pr_order_id']},{$fetch['pr_id']}) ");
          $query->bindValue(":pr_id", $pr_id, PDO::PARAM_INT);
          $query->execute();
          if($last_id == 0){
      			$last_id = $this->db->lastInsertId();//오토 인크리먼트로 가장 최근 값
      		}
      		$this->db->exec("update product_history set pr_order_id = {$last_id} where pu_id = " . $this->db->lastInsertId());
      		return $last_id;
        }
      }
    }
}
  ?>
