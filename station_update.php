<?php
// Load Modules
require_once("modules/db.php");
$ctg_name = $_POST['ctg_name'];
$om_line_station_update = $_POST['station'];

$sql = "select l_name from line where l_id = $ctg_name";
$result = mysqli_query($conn, $sql);
$line = mysqli_fetch_assoc($result);

$om_line_station = $line["l_name"]."&nbsp;".$om_line_station_update;
// echo $om_line_station;
$mbs_id = $_POST['mbs_id'];
$om_id = $_POST['om_id'];
$theVariable = "";
// echo $ctg_name."<br>";
// echo $om_line_station_update."<br>";
$sql = "select s_name from station where l_id = $ctg_name";
$result = mysqli_query($conn, $sql);
$a = 0;
while($station = mysqli_fetch_assoc($result)){
	// print_r($station)."<br>";
	if(array_search($om_line_station_update, $station) === false) {
		$theVariable = "not";
		// echo $theVariable."<br>";
	}else{
		$theVariable = "sure";
		// echo $theVariable."<br>";
		$a = 1;
		break;
	}
}
if($a == 0){
	echo "<script>alert('입력을 잘못하셨거나 없는 역을 입력하셨습니다.');</script>";
	echo "<script>location.replace('./member_update.php');</script>";
	exit;
}else{
	if($mbs_id != "null"){
		// echo $mbs_id."<br>";
		// echo $om_id."<br>";
		// echo $om_line_station."<br>";
		// echo "mb"."<br>";
		$dao = new Member();
		$dao->mbom_line_station_update($om_id,$mbs_id,$om_line_station);
		?>
		<script>
					window.top.location.href = "../My_one_page.php";
		</script>
		<?php
	}elseif($om_id != "null"){
		// echo $mbs_id."<br>";
		// echo $om_id."<br>";
		// echo $om_line_station."<br>";
		// echo "om"."<br>";
		$dao = new Oauths();
		$dao->mbom_line_station_update($om_id,$mbs_id,$om_line_station);
		echo "<script>location.replace('./member_update.php');</script>";
	}else{
		echo $mbs_id."<br>";
		echo $om_id."<br>";
		echo $om_line_station."<br>";
	}
}
?>
