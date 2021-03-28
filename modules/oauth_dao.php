<?php
  require_once('db_dao.php');

  class Oauths extends MetroDAO {
    protected $quTable = 'oauth_member';
    protected $quTableId = 'om_id';

    public function Om_insert($mb_uid,$mb_token,$mb_name,$mb_nickname,$mb_email,$mb_profile_image,$mb_company) {
      $this->openDB();
      $query = $this->db->prepare("insert into $this->quTable values (:mb_uid, :mb_email, :mb_nickname, :mb_profile_image, :mb_token,:mb_company,null,null,null)");
      $query -> bindValue(":mb_uid", $mb_uid, PDO::PARAM_STR);
      $query -> bindValue(":mb_email", $mb_email, PDO::PARAM_STR);
      $query -> bindValue(":mb_nickname", $mb_nickname, PDO::PARAM_STR);
      $query -> bindValue(":mb_profile_image", $mb_profile_image, PDO::PARAM_STR);
      $query -> bindValue(":mb_token", $mb_token, PDO::PARAM_STR);
      $query -> bindValue(":mb_company", $mb_company, PDO::PARAM_STR);
      var_dump($query);
      $query->execute();
    }

    public function Om_select($mb_uid) {
      // 회원 출력
      $this->openDB();
      $query = $this->db->prepare("select * from $this->quTable where om_id = $mb_uid");
      $query -> bindValue(":mb_uid", $mb_uid, PDO::PARAM_STR);
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      if($fetch){
        return $fetch;
      }
      else return null;
    }

    public function Om_token_update($mb_token, $mb_id) {
          $this->openDB();
          $query = $this->db->prepare("update $this->quTable set om_access_token=:mb_token where om_id=:mb_id");
          $query->bindValue(':mb_token', $mb_token);
          $query->bindValue(':mb_id', $mb_id);
          return $query->execute();
        }


    public function Om_Delete($om_id) {
    try{
      // 회원 탈퇴
      $this->openDB();
      $sql = "delete from $this->quTable where om_id=$om_id";
      $query = $this->db->prepare($sql);
      $query->execute();
      ?>
      <script>
        alert("아이디가 삭제되었습니다.");
        location.href = "../index.php";
      </script>
      <?php
      }catch(PDOException $e){
      exit($e ->getMessage());
      }
    }

  }
