<?php
// Load Modules
require_once("modules/db.php");

$ctg_name = $_POST['ctg_name'];
$om_line_station_update = $_POST['station'];
$om_line_station = $ctg_name."호선"."&nbsp;".$om_line_station_update;
$mbs_id = $_POST['mbs_id'];
$om_id = $_POST['om_id'];

	if($mbs_id != "null"){
		echo $mbs_id."<br>";
		echo $om_id."<br>";
		echo $om_line_station."<br>";
		echo "mb"."<br>";
		$dao = new Member();
		$dao->mbom_line_station_update($om_id,$mbs_id,$om_line_station);

	}elseif($om_id != "null"){
		echo $mbs_id."<br>";
		echo $om_id."<br>";
		echo $om_line_station."<br>";
		echo "om"."<br>";
		$dao = new Oauths();
		$dao->mbom_line_station_update($om_id,$mbs_id,$om_line_station);

	}else{
		echo $mbs_id."<br>";
		echo $om_id."<br>";
		echo $om_line_station."<br>";
	}

?>
