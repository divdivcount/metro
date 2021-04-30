<?php
  require_once('db_dao.php');

  class Member extends MetroDAO {
    protected $quTable = 'member';
    protected $quTableId = 'mb_num';
    protected $quTableFname = 'mb_image';
    protected $fdir = 'files';

    public function Member_Delete($mb_id) {
    try{
      // 회원 탈퇴
      $this->openDB();
      // var_dump($mb_id != 'null');
      // var_dump($om_id == 'null');
      if($mb_id != 'null'){
        $sql = "delete from member where mb_id='$mb_id'";
        echo "회원 탈퇴";
      }
      $query = $this->db->prepare($sql);
      $query->execute();
      ?>
      <script>
        alert("지금까지 메트로켓을 사랑 해주셔서 감사합니다.");
        window.top.location.href = "../index.php";
      </script>
      <?php
      }catch(PDOException $e){
      exit($e ->getMessage());
      }
    }

    public function Member_Search($mb_name, $mb_email) {
      // 회원 번호 찾기 User_page 회원번호 찾는데 사용합니다.
      $this->openDB();
      $query = $this->db->prepare("select mb_id from member where mb_name ='$mb_name' and mb_email = '$mb_email'");
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      if($fetch){
        return $fetch;
      }
      else return null;
    }

    public function Member_Select($mb_id) {
    	// 회원 정보 1명 찾기
    	$this->openDB();
    	$query = $this->db->prepare("select mb_id from member where mb_num = $mb_id");
    	$query->execute();
    	$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    	if($fetch){
    		return $fetch;
    	}
    	else return null;
    }

    public function Delete_mbImg($id) {
  		try{
  			$this->openDB();

  			// 파일 삭제
  			if( $this->quTableFname !=  '') {

  				$query = $this->db->prepare("select mb_image from $this->quTable where mb_num=:id");
  				$query->bindValue(":id", $id, PDO::PARAM_STR);
  				$query->execute();

  				while ($fetch = $query->fetch(PDO::FETCH_ASSOC)) {
            if ($fetch['mb_image'] != "img/normal_profile.png") {
    					$fname = $fetch['mb_image'];
    					// var_dump($fname);
    					if($fname != '') {
    						if(file_exists("files/".$fname)) {
    							// echo "삭제";
    							unlink("files/".$fname);
    						}
    					}
            }else{
              return null;
            }
  				}
  			}
  		}catch(PDOException $e){
  			exit($e ->getMessage());
  		}
  	}

    // public function Member_Join($mb_id, $mb_password, $mb_name, $mb_email, $mb_gender, $mb_datetime) {
    // 	// 회원 번호 찾기
    // 	$this->openDB();
    // 	$query = $this->db->prepare("");
    // 	$query->execute();
    // }

    // public function Member_Rating() {
    //   // 회원 등급 출력
    //   $this->openDB();
    //   $query = $this->db->prepare("select * from member_rating");
    //   $query->execute();
    //   $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    //   if($fetch){
    //     return $fetch;
    //   }
    //   else return null;
    // }
  }
