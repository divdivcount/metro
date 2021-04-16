<?php

class MetroDAO {
	// Field
	protected $db = null;
	protected $dburl = 'localhost';
	protected $dbid = 'metro';
	protected $dbpw = 'metro20210316';
	protected $dbtable = 'metro';
	protected $dbtype = 'mysql';

	protected $quTable = 'tablename';
	protected $quTableId = 'id';
	protected $quTableName = '';
	protected $quTableFdate = '';
	protected $quTableFrname = '';
	protected $fdir = 'files';
  protected $fsize_limit = 50 * 1024 * 1024;


  protected function openDB() {
    /*
      db가 열려있지 않으면 오픈합니다.
      ## parameter
      없음
      ## return
      없음
      ## return error code
      없음
    */
    if($this->db) return;

    $profile = '';
    if($this->dbtype === 'mysql') {
      $profile = "mysql:host=$this->dburl; dbname=$this->dbtable";
    }
    else if($this->dbtype === 'mariadb') {
      $profile = "mysql:host=$this->dburl; dbname=$this->dbtable; port=3306; charset=utf8";
    }
    else {
      throw new PDOException('존재하지 않는 db type');
    }

    $this->db = new PDO($profile, $this->dbid, $this->dbpw);
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
//제품 출력
	public function SelectAll($select = '*', $where = null) {
    $this->openDB();
    if($where){
			$query = $this->db->prepare("select $select from $this->quTable where $where");
		}else{
			$query = $this->db->prepare("select p.*, i.in_hit, pi.pr_img, l.l_name, m.mb_line_station from product p left outer join interest i ON p.pr_id = i.pr_id left outer join product_img pi ON p.pr_id = pi.pr_id left outer join line l ON p.l_id = l.l_id left outer join member m ON p.mb_id = m.mb_num where p.mb_id = $mb_id order by $this->quTableId asc limit :start, :viewLen");
		}
    $query->execute();
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    if($fetch) return $fetch;
    else return null;
  }



	// 특정 아이디의 값 모두 불러오기
	public function SelectId($id) {
		$this->openDB();
		$query = $this->db->prepare("select * from $this->quTable where id=:id");
		$query->bindValue(":id", $id);
		$query->execute();
		$fetch = $query->fetch(PDO::FETCH_ASSOC);

		if(!$fetch) throw new CommonException('데이터가 존재하지 않습니다.');
		return $fetch;
	}

	//겔러리, 컨설팅, 제품 modify
	public function Modify($product=null,$fparam,$fnum,$id, $datArray) {
		if($product){
			if(!is_array($datArray)) throw new CommonException('잘못된 인수');//is_array($datArray) 배열검사
			$farray = null;
			if(is_string($fparam) && ($fparam != '')) {
				if(isset($_FILES[$fparam]) && $this->quTableFname != '') {
					if(is_array($_FILES[$fparam]['name'])) {
						$farray = $this->fileUploader([ //객체배열로 넣기
							'name' => $_FILES[$fparam]['name'][$fnum],
							'tmp_name' => $_FILES[$fparam]['tmp_name'][$fnum],
							'size' => $_FILES[$fparam]['size'][$fnum],
							'type' => $_FILES[$fparam]['type'][$fnum],
							'error' => $_FILES[$fparam]['error'][$fnum]
						]);
					}
					else {
						$farray = $this->fileUploader([
							'name' => $_FILES[$fparam]['name'],
							'tmp_name' => $_FILES[$fparam]['tmp_name'],
							'size' => $_FILES[$fparam]['size'],
							'type' => $_FILES[$fparam]['type'],
							'error' => $_FILES[$fparam]['error']
						]);
					}
				}
			}
			if($farray === null) {
	      $farray = array(); //배열선언
	    }
	  else{
		    $dfield = '';
				$dvalue = '';
		    $first = true;
		    foreach($datArray as $key => $val) {

		      $dfield = ($first)?($dfield.$key.'=:'.$key):($dfield.','.$key.'=:'.$key);
		      $first = false;
		    }
				foreach($farray as $key => $val) {
					$first = true;
					$dvalue = ($first)?($dvalue.':'.$key):($dvalue.',:'.$key);
					$first = false;
				}
		}

			if(empty($dvalue)){
				$dfield = '';
				$first = true;
				$file='';
				foreach($datArray as $key => $val) {

					$dfield = ($first)?($dfield.$key.'=:'.$key):($dfield.','.$key.'=:'.$key);
					$first = false;
				}
			}else{
				$file=", file=$dvalue";
			}
			$this->openDB();
			$query = $this->db->prepare("update $this->quTable set $dfield $file where $this->quTableId=:id");
			print_r($query);
			$query->bindValue(':id', $id);
			foreach($datArray as $key => $val) {
				print_r($datArray);
				if(is_string($val)) {
					$query->bindValue(":$key", $val);
					// echo $val."<br>";
				}
				else if(is_int($val)) {
					$query->bindValue(":$key", $val, PDO::PARAM_INT);
					// echo $val."<br>";
				}
				else {
						$files = implode('', $val);
						$query->bindValue(":$key", $files);
				}
			}
			foreach($farray as $key => $val) {
				if(is_string($val)) {
					$query->bindValue(":$key", $val);
					// echo $key,$val."<br>";
					// print_r($query);
				}
				else if(is_int($val)) {
					$query->bindValue(":$key", $val, PDO::PARAM_INT);
					// echo $val."<br>";
					// print_r($query);
				}
				else {
					$query->bindValue(":$key", $val);
					// print_r($query);
				}
			}
			$query->execute();
		}else{
			$dfield = '';
			$first = true;
			foreach($datArray as $key => $val) {
				$dfield = ($first)?($dfield.$key.'=:'.$key):($dfield.','.$key.'=:'.$key);
				$first = false;
			}
		}
		$this->openDB();
		$query = $this->db->prepare("update $this->quTable set $dfield where $this->quTableId=:id");
		// print_r( $query)."<br>";
		$query->bindValue(':id', $id);
		foreach($datArray as $key => $val) {
			if(is_string($val)) {
				$query->bindValue(":$key", $val);
				// echo $key,$val."<br>";
			}
			else if(is_int($val)) {
				$query->bindValue(":$key", $val, PDO::PARAM_INT);
				// echo $key,$val."<br>";
			}
			else {
				if($this->quTable == "consulting"){
					$query->bindValue(":$key", $val);
				}else{
						$files = implode('', $val);
						$query->bindValue(":$key", $files);
						// print_r( $val)."<br>";
					}
			}
		}
		$query->execute();
	}
//제품, 컨설팅, 겔러리 삭제

public function Delete($id) {
try{
$this->openDB();

if($this->quTable == "consulting"){
	$query = $this->db->prepare("delete from $this->quTable where id=:id");
	// print_r($query);
	// echo "delete from $this->quTableFname where id=:id";
	$query->bindValue(":id", $id, PDO::PARAM_INT);
	$query->execute();
}else{
// 파일 삭제
if( $this->quTableFname !=  '') {
$query = $this->db->prepare("select file from $this->quTable where id=:id");
$query->bindValue(":id", $id, PDO::PARAM_INT);
$query->execute();
$fetch = $query->fetch(PDO::FETCH_ASSOC);
$fname = $fetch['file'];
if($fname != '') {
		if(file_exists("files/$this->quTable/".$fname)) {
			unlink("files/$this->quTable/".$fname);
			}
	}
}
}

	// 게시글 삭제
	$sql = "delete from $this->quTable where id=:id";
	$query = $this->db->prepare($sql);
	$query->bindValue(":id", $id, PDO::PARAM_INT);
	$query->execute();
	}catch(PDOException $e){
	exit($e ->getMessage());
		}
	}


	//페이지 내이션
  	public function SelectPageLength($cPage, $viewLen, $mb_id, $om_id, $category = null) {
			$this->openDB();
		if($mb_id != 'null' && $om_id == 'null'){
			$om_id = null;
			$query = $this->db->prepare("select count(*) from $this->quTable where mb_id = :mb_id and om_id is :om_id");
			// echo "dd";
		}elseif($om_id != 'null' && $mb_id == 'null'){
			$mb_id = null;
			$query = $this->db->prepare("select count(*) from $this->quTable where om_id = :om_id and mb_id is :mb_id");
			// echo "????";
		}else{
			if($category){
					$query = $this->db->prepare("select count(*) from $this->quTable where l_id = :mb_id and pr_station = :om_id and ca_name = :category");
					// echo "SelectPageLength1";
					$query->bindValue(":category", $category,  PDO::PARAM_STR);
			}else{
				// echo "SelectPageLength2";
				$query = $this->db->prepare("select count(*) from $this->quTable where l_id = :mb_id and pr_station = :om_id");
			}
			// echo "??";
		}
		$query->bindValue(":mb_id", $mb_id,  PDO::PARAM_STR);
		$query->bindValue(":om_id", $om_id,  PDO::PARAM_STR);

    $query->execute();
		$fetch = $query->fetch(PDO::FETCH_ASSOC);
		$countLen = $fetch['count(*)'];

		// 페이지의 총 개수가 몇개인가
		$plen = ($countLen != 0)?$countLen/((int)$viewLen):1;

		$plen = ceil($plen);

		// 표시할 페이지 시작점은 몇번인가
		$pstart = (
			($cPage-2<1)?1:(
				($cPage+2>$plen)?(
					($plen-4>1)?($plen-4):1
				):($cPage-2)
			)
		);
		// 현재 페이지 번호가 몇번인가
		$pcurnt = ((1>$cPage)?1:(($cPage>$plen)?$plen:$cPage));

		return [
			"count" => $countLen,
			"page" => $plen,
			"start" => $pstart,
			"end" => ($pstart+4>$plen)?$plen:$pstart+4,
			"current" => $pcurnt
		];

	}

	public function SelectPageList($cPage, $viewLen, $mb_id, $om_id, $s_value = null, $category = null) {
		$start = ($cPage * $viewLen) - $viewLen;
		// echo $start;
		// echo $viewLen;

		if($mb_id != 'null' && $om_id == 'null'){
			$om_id = null;
			$sql =	"select p.*, (select count(i.in_hit) from interest i where i.pr_id = p.pr_id) as i_count , pi.pr_img, l.l_name, m.line_station from product p left outer join product_img pi ON p.pr_img_id = pi.pr_img_id left outer join line l ON p.l_id = l.l_id left outer join member m ON p.mb_id = m.mb_num where p.mb_id = :mb_id and p.pr_img_id = pi.pr_img_id and pi.main_check = 'y' and p.om_id is :om_id order by $this->quTableId asc limit :start, :viewLen";
		}elseif($om_id != 'null' && $mb_id == 'null'){
			$mb_id = null;
			$sql = "select p.*, (select count(i.in_hit) from interest i where i.pr_id = p.pr_id) as i_count, pi.pr_img, l.l_name, om.line_station from product p left outer join product_img pi ON p.pr_img_id = pi.pr_img_id left outer join line l ON p.l_id = l.l_id left outer join oauth_member om ON p.om_id = om.om_id where p.om_id = :om_id and p.pr_img_id = pi.pr_img_id and pi.main_check = 'y' and  p.mb_id is :mb_id order by $this->quTableId asc limit :start, :viewLen";
		}else{
			if($s_value){
				// echo "SelectPageList1";
				$sql = "select pr_id,pr_title, pr_price, ca_name, (select l_name from line l where l.l_id = :mb_id ) as line_name, pr_station,(select count(i.in_hit) from interest i where i.pr_id = p.pr_id) as i_count,(select pr_img from product_img pi where pi.pr_img_id = p.pr_img_id and pi.main_check = 'y') as pr_img  from product p  where l_id = :mb_id and pr_station = :om_id and pr_title like :s_value order by $this->quTableId asc limit :start, :viewLen";
			}elseif($category){
				// echo "SelectPageList3";
				$sql = "select pr_id,pr_title, pr_price, ca_name, (select l_name from line l where l.l_id = :mb_id ) as line_name, pr_station,(select count(i.in_hit) from interest i where i.pr_id = p.pr_id) as i_count,(select pr_img from product_img pi where pi.pr_img_id = p.pr_img_id and pi.main_check = 'y') as pr_img  from product p  where l_id = :mb_id and pr_station = :om_id and p.ca_name = :category order by $this->quTableId asc limit :start, :viewLen";
			}elseif($s_value && $category){
				// echo "SelectPageList4";
				$sql = "select pr_id,pr_title, pr_price, ca_name, (select l_name from line l where l.l_id = :mb_id ) as line_name, pr_station,(select count(i.in_hit) from interest i where i.pr_id = p.pr_id) as i_count,(select pr_img from product_img pi where pi.pr_img_id = p.pr_img_id and pi.main_check = 'y') as pr_img  from product p  where l_id = :mb_id and pr_station = :om_id and pr_title and ca_name = :category and pr_title like :s_value order by $this->quTableId asc limit :start, :viewLen";
			}else{
				// echo "SelectPageList2";
				$sql = "select pr_id,pr_title, pr_price, ca_name,  (select l_name from line l where l.l_id = :mb_id ) as line_name ,pr_station,(select count(i.in_hit) from interest i where i.pr_id = p.pr_id) as i_count,(select pr_img from product_img pi where pi.pr_img_id = p.pr_img_id and pi.main_check = 'y') as pr_img  from product p  where l_id = :mb_id and pr_station = :om_id order by $this->quTableId asc limit :start, :viewLen";
			}
			// echo "???";
		}

		$this->openDB();
		$query = $this->db->prepare($sql);
		$query->bindValue(":start", $start, PDO::PARAM_INT);
		$query->bindValue(":viewLen", $viewLen, PDO::PARAM_INT);
		$query->bindValue(":mb_id", $mb_id,  PDO::PARAM_STR);
		$query->bindValue(":om_id", $om_id,  PDO::PARAM_STR);
		if($s_value)$query->bindValue(":s_value", "%$s_value%",  PDO::PARAM_STR);
		if($category)$query->bindValue(":category", "$category",  PDO::PARAM_STR);

		$query->execute();
		$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
		try{
		if(!$fetch){
			// echo "결과 값이 없습니다.";
		}
		return $fetch;
		}catch(PDOException $e){
			exit($e ->getMessage());
		  }
	}

	public function SelectGallery($select = '*', $where = null) {
    $this->openDB();
    if($where) $query = $this->db->prepare("select * from $this->quTable where $where");
    else $query = $this->db->prepare("select * from $this->quTable");
    $query->execute();
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    if($fetch) return $fetch;
    else return null;
  }





	public function fileUploader($fdat) {
		//$ftime파일명에 붙이기 위해
		$ftime = time();
		$fnslice = explode('.', $fdat['name']); // 파일의 확장자를 알기위해 . 으로 나눈다 ex)[123.jpg]
		$ftype = end($fnslice);// 이제 확장자를 알기위해 마지막 배열의 값을 가져온다.
		$ftslice = explode('/', $fdat['tmp_name']);// tmp_name을 / 로 끊어서 배열로 만든다.
		if(count($ftslice) <= 1) {
			$ftslice = explode('\\', $fdat['tmp_name']);
		}
		$ftemp = end($ftslice); // 가져오면 php6999이런식으로 나옵니다.
		$fname_save = "file$ftime$ftemp.$ftype"; //file1604987763php6999.tmp.확장자
		if($fdat['name'] != '' && $fdat['error'] == 0) {
			// 업로드 파일 확장자 검사 (필요시 확장자 추가)
			if($ftype=="html" ||
			$ftype=="htm" ||
			$ftype=="php" ||
			$ftype=="php3" ||
			$ftype=="inc" ||
			$ftype=="pl" ||
			$ftype=="cgi" ||
			$ftype=="txt" ||
			$ftype=="TXT" ||
			$ftype=="asp" ||
			$ftype=="jsp" ||
			$ftype=="phtml" ||
			$ftype=="js" ||
			$ftype=="") {
				throw new CommonException('허용되지 않은 파일 형식입니다.');
			}
			// 파일 용량을 검사합니다
			if($fdat['size'] > $this->fsize_limit) {
				throw new CommonException('파일 용량이 허가 용량을 넘습니다.');
			}

			if(!move_uploaded_file($fdat['tmp_name'], $this->fdir.'/'.$fname_save)) {
				throw new CommonException('파일 저장에 실패했습니다.');
			}

			// 리턴값 만들기
			$farray = array();//farray배열 선언
			if($this->quTableFname) { //$this->quTableFname이 있으면 farray[파일이름필드의 이름] = 임시파일명
				$farray[$this->quTableFname] = $fname_save; //farray[파일이름필드의 이름] = 임시파일명
			}
			if($this->quTableFrname) {//quTableFrname이 있으면
				$farray[$this->quTableFrname] = $fdat['name'];//quTableFrname을
			}
			if($this->quTableFdate) {//파일 저장 시간 테이블이 있으면
				$farray[$this->quTableFdate] = date('Y-m-d'); //파일 저당한 날짜를 현재시간으로
			}
			return $farray; //리턴
		}
		return null;
	}

//겔러리, 상담, 제품 등록
	public function Upload($fparam, $fnum, $datArray) {//$fnum 다중업로드 처리를 위해 id값
		if(!is_array($datArray)) throw new CommonException('잘못된 인수');//is_array($datArray) 배열검사
		$farray = null;
		if(is_string($fparam) && ($fparam != '')) {
			if(isset($_FILES[$fparam]) && $this->quTableFname != '') {
				if(is_array($_FILES[$fparam]['name'])) {
					$farray = $this->fileUploader([ //객체배열로 넣기
						'name' => $_FILES[$fparam]['name'][$fnum],
						'tmp_name' => $_FILES[$fparam]['tmp_name'][$fnum],
						'size' => $_FILES[$fparam]['size'][$fnum],
						'type' => $_FILES[$fparam]['type'][$fnum],
						'error' => $_FILES[$fparam]['error'][$fnum]
					]);
				}
				else {
					$farray = $this->fileUploader([
						'name' => $_FILES[$fparam]['name'],
						'tmp_name' => $_FILES[$fparam]['tmp_name'],
						'size' => $_FILES[$fparam]['size'],
						'type' => $_FILES[$fparam]['type'],
						'error' => $_FILES[$fparam]['error']
					]);
				}
			}
		}
		if($farray === null) {
			$farray = array(); //배열선언
		}
		$dfield = '';
		$dvalue = '';
		$first = true;
		foreach($datArray as $key => $val) {
			$dfield = ($first)?($dfield.$key):($dfield.','.$key);
			// echo $dfield."<br>"; //값을 뽑아서
			$dvalue = ($first)?($dvalue.':'.$key):($dvalue.',:'.$key);
			// echo $dvalue."<br>";//바인드처리
			$first = false;
		}
		foreach($farray as $key => $val) {
			// print_r($val);
			$dfield = ($first)?($dfield.$key):($dfield.','.$key);
			// echo $dfield."<br>";
			$dvalue = ($first)?($dvalue.':'.$key):($dvalue.',:'.$key);
			// echo $dfield."<br>";
			$first = false;
		}

		$this->openDB();
		$query = $this->db->prepare("insert into $this->quTable ($dfield) values ($dvalue)"); //글 올리는 로직
		// echo $query;
		foreach($datArray as $key => $val) {
			if(is_string($val)) { //변수 유형이 문자열인지 확인
				$query->bindValue(":$key", $val);
			}
			else if(is_int($val)) {//변수 유형이 숫자인지 확인
				$query->bindValue(":$key", $val, PDO::PARAM_INT);
			}
			else {
				$query->bindValue(":$key", $val);
			}
		}
		foreach($farray as $key => $val) {
			if(is_string($val)) {
				$query->bindValue(":$key", $val);
			}
			else if(is_int($val)) {
				$query->bindValue(":$key", $val, PDO::PARAM_INT);
			}
			else {
				$query->bindValue(":$key", $val);
			}
		}
		$query->execute();
	}


	public function Gohistory($cat_key, $id_key, $pr_img, $pr_name, $pa, $pr_qty, $mb_num,$num,$now,$last_id) {
    $this->openDB();
    $query = $this->db->prepare("insert into $this->quTable values (:cat_key, :id_key, :pr_img, :pr_name, :pa,:pr_qty,:mb_num,:pr_num,:pr_now,0,DEFAULT,DEFAULT)");
		$query -> bindValue(":cat_key", $cat_key, PDO::PARAM_STR);
		$query -> bindValue(":id_key", $id_key, PDO::PARAM_STR);
		$query -> bindValue(":pr_img", $pr_img, PDO::PARAM_STR);
		$query -> bindValue(":pr_name", $pr_name, PDO::PARAM_STR);
		$query -> bindValue(":pa", $pa, PDO::PARAM_STR);
		$query -> bindValue(":pr_qty", $pr_qty, PDO::PARAM_STR);
		$query -> bindValue(":mb_num", $mb_num, PDO::PARAM_STR);
		$query -> bindValue(":pr_num", $num, PDO::PARAM_STR);
		$query -> bindValue(":pr_now", $now, PDO::PARAM_STR);
    $query->execute();
		// if($this->quTable == "puhistory"){
		// 	$this->quTable = "paygo";
		// 	$query = $this->db->prepare("insert into $this->quTable values (:mb_num,:pr_num)");
		// 	$query -> bindValue(":mb_num", $mb_num, PDO::PARAM_STR);
		// 	$query -> bindValue(":pr_num", $num, PDO::PARAM_STR);
		// 	$query->execute();
		// }
		if($last_id == 0){
			$last_id = $this->db->lastInsertId();//오토 인크리먼트로 가장 최근 값
		}
		// "update $this->quTable set order_id = {$last_id} where pu_id =$last_id = " . $this->db->lastInsertId();
		$this->db->exec("update $this->quTable set order_id = {$last_id} where pu_id = " . $this->db->lastInsertId());
		// echo "update $this->quTable set order_id = {$last_id} where pu_id = " . $this->db->lastInsertId();
		// exit;
		return $last_id;
  }
	public function mbom_line_station_update($om_id,$mb_id, $om_line_station) {
				$this->openDB();
				if($mb_id != 'null'){
					$query = $this->db->prepare("update $this->quTable set line_station = '$om_line_station' where mb_id='$mb_id'");
				}elseif($om_id != 'null'){
					$query = $this->db->prepare("update $this->quTable set line_station = '$om_line_station' where om_id='$om_id'");
					// var_dump($query);
				}
				$query->execute();
			}

	public function searchProduct_detail($p_id, $p_title) {
    $this->openDB();
    $query = $this->db->prepare("
		select group_concat(pr_img) as pr_img, (case when p.mb_id then (select mb_image from member m where p.mb_id = m.mb_num) when p.om_id then (select om_image_url from oauth_member o where o.om_id = p.om_id) else null end) as profile_img, (case when p.mb_id then (select m.mb_name from member m where p.mb_id = m.mb_num) when p.om_id then (select o.om_nickname from oauth_member o where o.om_id = p.om_id) else null end) as profile_name, (case when p.mb_id then (select m.line_station from member m where p.mb_id = m.mb_num) when p.om_id then (select o.line_station from oauth_member o where o.om_id = p.om_id) else null end) as profile_station, p.pr_title, p.ca_name, p.pr_status, p.pr_price, (select count(i.in_hit) from interest i where i.pr_id = p.pr_id) as i_count, p.pr_explanation from product_img pi, product p where p.pr_id = :p_id and p.pr_title = :title and pi.pr_img_id = p.pr_img_id group by pr_id");
    $query -> bindValue(":p_id", $p_id, PDO::PARAM_INT);
    $query -> bindValue(":title", $p_title, PDO::PARAM_STR);
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
