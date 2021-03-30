<?php
require_once("modules/db.php");
Get("option",0);
echo Get("option",0);
    $return_arr = array();

    $keyword = $_GET['term'];
    $sql = "select l.l_name, s.s_name from line l left outer join station s on l.l_id = s.l_id where l.l_id = 1";
    $result = mysqli_query($db, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $return_arr[] =  $row['s_name'];
    }
    print_r($return_arr);

    echo json_encode($return_arr);
?>
