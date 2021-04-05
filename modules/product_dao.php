<?php
require_once('db_dao.php');

class Product extends MetroDAO {
  protected $quTable = 'product';
  protected $quTableId = 'pr_id';

  //제품 출력
  	// public function ProductAll($title, $om, $mb) {
    //   $this->openDB();
  	// 	$query = $this->db->prepare("select * from `$quTable` where pr_title = '$title' and mb_id=$mb or om_id = $om");
    //   echo $query;
    //   $query->execute();
    //   $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    //   if($fetch) return $fetch;
    //   else return null;
    // }
    public function ProductAll($title, $om, $mb) {
      echo "-----------------------------"."<br>";
      echo $title."<br>";
      echo $om."<br>";
      echo $mb."<br>";
      echo "-----------------------------"."<br>";
      // 회원 출력
      if($om == ''){
        $om = 'null';
        echo $om."<br>";
      }elseif($mb = ''){
        $mb = 'null';
        echo $mb."<br>";
      }
      $this->openDB();
      $query = $this->db->prepare("select * from $this->quTable where pr_title = '$title' and mb_id=$mb or om_id = $om");
      $query -> bindValue(":title", $title, PDO::PARAM_STR);
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      if($fetch){
        return $fetch;
      }
      else return null;
    }
    public function Product_title_search($title, $om, $mb) {
      echo "-----------------------------"."<br>";
      echo $title."<br>";
      echo $om."<br>";
      echo $mb."<br>";
      echo "-----------------------------"."<br>";
      // 회원 출력
      if($om == ''){
        $om = 'null';
      }elseif($mb = ''){
        $mb = 'null';
      }
      // 회원 출력
      $this->openDB();
      $query = $this->db->prepare("select * from $this->quTable where pr_title = '$title' and mb_id=$mb or om_id = $om");
      $query -> bindValue(":title", $title, PDO::PARAM_STR);
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      if($fetch){
        return $fetch;
      }
      else return null;
    }
    // public function Product_title_search($title, $om, $mb) {
    //   $this->openDB();
    //   $query = $this->db->prepare("select pr_id from `$quTable` where pr_title = '$title' and mb_id=$mb or om_id = $om");
    //   echo $query;
    //   $query->execute();
    //   $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    //   if($fetch) return $fetch;
    //   else return null;
    // }


}
  ?>
