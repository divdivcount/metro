<?php
    $host = 'localhost';
    $user = 'metro';
    $pw = 'metro20210316';
    $dbName = 'metro';
    $mysqli = new mysqli($host, $user, $pw, $dbName);
    $insert = array('방화','개화산','김포공항','송정','마곡','발산','우장산','화곡',
    '까치산','신정','목동','오목교','양평','영등포구청','영등포시장','신길','여의도','여의나루','마포','공덕','애오개','충정로','서대문','광화문','종로3가','을지로4가','동대문역사문화공원','청구','신금호','행당','왕십리','마장','답십리',
    '장한평','군자','아차산','광나루','천호','강동','길동','굽은다리','명일','고덕','상일동','둔촌동','올림픽공원','방이','오금','개롱','거여','마천'
);

    if($mysqli){
        echo "MySQL 접속 성공";
        for($i = 0; $i <= count($insert)-1; $i++){
          $s = $insert[$i];
          $ic = "insert into station(`s_id`,`l_id`, `s_name`) values (null,5,'$s')";
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
