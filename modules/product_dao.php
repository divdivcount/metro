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
      $query = $this->db->prepare("select * from $this->quTable where pr_title = '$title' and mb_id=$mb or om_id = '$om'");
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
      // 회원 출력
      if($om == ''){
        $om = 'null';
      }elseif($mb == ''){
        $mb = 'null';
      }
      // 회원 출력
      $this->openDB();
      $query = $this->db->prepare("select * from $this->quTable where pr_title = '$title' and mb_id=$mb or om_id = '$om'");
      $query -> bindValue(":title", $title, PDO::PARAM_STR);
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      if($fetch){
        return $fetch;
      }
      else return null;
    }

    // public function searchProduct_detail($p_id, $p_title) {
    //   $this->openDB();
    //   $query = $this->db->prepare("select group_concat(pr_img) as pr_img, (case when p.mb_id then (select mb_image from member m where p.mb_id = m.mb_num) when p.om_id then (select om_image_url from oauth_member o where o.om_id = p.om_id) else null end) as profile_img, (case when p.mb_id then (select m.mb_name from member m where p.mb_id = m.mb_num) when p.om_id then (select o.om_nickname from oauth_member o where o.om_id = p.om_id) else null end) as profile_name, (case when p.mb_id then (select m.line_station from member m where p.mb_id = m.mb_num) when p.om_id then (select o.line_station from oauth_member o where o.om_id = p.om_id) else null end) as profile_station, p.pr_title, p.ca_name, p.pr_status, p.pr_price, (select count(i.in_hit) from interest i where i.pr_id = p.pr_id) as i_count, p.pr_explanation from product_img pi, product p where p.pr_id = :p_id and pr_title = :title and pi.pr_img_id = p.pr_img_id group by pr_id");
    //   $query -> bindValue(":p_id", $p_id, PDO::PARAM_INT);
    //   $query -> bindValue(":title", $title, PDO::PARAM_STR);
    //   $query->execute();
    //   $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    //   if($fetch){
    //     echo "true";
    //     return $fetch;
    //   }
    //   else return null;
    // }

}
  ?>
