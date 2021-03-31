<?php
    $host = 'localhost';
    $user = 'metro';
    $pw = 'metro20210316';
    $dbName = 'metro';
    $mysqli = new mysqli($host, $user, $pw, $dbName);
    $insert = array("강남", "양재", "양재시민의숲", "청계산입구", "판교", "정자", "미금", "동천", "수지구청", "성복", "상복", "상현", "광교중앙(아주대)", "광교(경기대)");

    if($mysqli){
        echo "MySQL 접속 성공";
        for($i = 0; $i <= count($insert)-1; $i++){
          $s = $insert[$i];
          $ic = "insert into station(`s_id`,`l_id`, `s_name`, `s_station_id`) values (null,12,'$s',0)";
          if (mysqli_query($mysqli, $ic)) {
            echo "New record created successfully\n";
          } else {
            echo "Error: " . $ic . "<br>" . mysqli_error($mysqli);
          }
        }
        mysqli_close($mysqli);
    }else{
        echo "MySQL 접속 실패";
    }
?>
