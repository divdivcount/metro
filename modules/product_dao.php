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
      $query = $this->db->prepare("update product set pr_status = '거래완료' where pr_id = :pr_id");
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
    public function Product_block_update($pr_id, $gap) {
      // 회원 정보 1명 찾기
      $this->openDB();
      $query = $this->db->prepare("update product set pr_block = :gap where pr_id = :pr_id");
      $query->bindValue(":pr_id", $pr_id, PDO::PARAM_INT);
      $query->bindValue(":gap", $gap, PDO::PARAM_INT);
      $query->execute();
    }


    public function admin_product_list_detail($mb_id,$om_id,$pr_id) {
      $this->openDB();
  		// echo "--------------------------------<br>";
  		// echo $mb_id."<br>";
  		// echo $om_id."<br>";
  		// echo $p_id."<br>";
  		// echo $p_title."<br>";
  		// echo "--------------------------------<br>";
      $query = $this->db->prepare(
  "select
  	count(member_declaration.pr_id) as rep_count,
    product.pr_id,
    product.pr_check,
    product.om_id,
    product.mb_id,
    product_img.pr_img,
    product.l_id,
  	case
      when member.mb_num is not null
      then member.line_station
      when oauth_member.om_id is not null
      then oauth_member.line_station
      else null
    end as profile_station,
  	case
      when member.mb_num is not null
      then member.mb_num
      when oauth_member.om_id is not null
      then oauth_member.om_id
      else null
    end as profile_id,
    case
      when member.mb_num is not null
      then member.mb_name
      when oauth_member.om_id is not null
      then oauth_member.om_nickname
      else null
    end as profile_name,
    case
      when member.mb_num is not null
      then member.mb_image
      when oauth_member.om_id is not null
      then oauth_member.om_image_url
      else null
    end as profile_img,
    product.pr_title,
    product.ca_name,
    product.pr_status,
  	product.pr_block,
    product.pr_price,
    count(interest.in_hit=1) as i_count,
    count(case
      when myAccountInfo.myAccountType='mb'
      then interest.mb_id
      when myAccountInfo.myAccountType='om'
      then interest.om_id
      else null
    end=myAccountInfo.myID) as mem_i_check,
    product.pr_explanation,
    myAccountInfo.myAccountType,
    myAccountInfo.myID
  from
    product left join
    (select
      product_img.pr_img_id,
      group_concat(product_img.pr_img) as pr_img
    from
      product_img
    group by
      product_img.pr_img_id
    ) as product_img on
      product.pr_img_id=product_img.pr_img_id left join
      member_declaration on
  	product.pr_id = member_declaration.pr_id left join
    member on
      product.mb_id=member.mb_num left join
    oauth_member on
      product.om_id=oauth_member.om_id left join
    (select
      interest.pr_id,
      interest.mb_id,
      interest.om_id,
      interest.in_hit
    from
      interest
    ) as interest on
      interest.pr_id=product.pr_id,
    (select
      :accountID as myID,
      :accountType as myAccountType
    ) as myAccountInfo
  where
    product.pr_id=:pr_id
  group by
    product.pr_id"
  		);
      $query -> bindValue(":pr_id", $pr_id, PDO::PARAM_INT);
  		if($mb_id !== 'null') {
  			$query -> bindValue(":accountType", 'mb', PDO::PARAM_STR);
  			$query -> bindValue(":accountID", $mb_id, PDO::PARAM_INT);
  		} else if($om_id !== 'null') {
  			$query -> bindValue(":accountType", 'om', PDO::PARAM_STR);
  			$query -> bindValue(":accountID", $om_id, PDO::PARAM_INT);
  		} else {
  			$query -> bindValue(":accountID", null, PDO::PARAM_INT);
  			$query -> bindValue(":accountType", null, PDO::PARAM_STR);
  		}
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
  		// var_dump($fetch);
      if($fetch){
        return $fetch;
      }
      else return null;
    }

    public function admin_product_del($pr_id) {
      $this->openDB();
      $query = $this->db->prepare("select pr_img_id from product where pr_id=:id");
      $query->bindValue(":id", $pr_id, PDO::PARAM_INT);
      $query->execute();
      $fetch = $query->fetch(PDO::FETCH_ASSOC);
      var_dump($fetch);

      $query = $this->db->prepare("select pr_img from product_img where pr_img_id=:id");
      $query->bindValue(":id", $fetch['pr_img_id'], PDO::PARAM_STR);
      $query->execute();
      while ($fetch = $query->fetch(PDO::FETCH_ASSOC)) {
        $fname = $fetch['pr_img'];
        // var_dump($fname);
        if($fname != '') {
          if(file_exists("files/".$fname)) {
            // echo "삭제";
            unlink("files/".$fname);
          }
        }
      }

      $query = $this->db->prepare("delete from $this->quTable where pr_id=:id");
      $query->bindValue(":id", $pr_id, PDO::PARAM_STR);
      $query->execute();

    }
}
  ?>
