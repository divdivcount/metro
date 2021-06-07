<?php
  require_once('modules/db.php');
  $category = isset($_REQUEST["category"]) ? $_REQUEST["category"] : "";

  $sql = "select p.pr_id,(select pr_img from product_img pi where pi.pr_img_id = p.pr_img_id and pi.main_check = 'y') as pr_img, p.pr_title, p.l_id ,p.pr_station, p.pr_price, (select count(i.in_hit) from interest i where p.pr_id = i.pr_id )as in_hit, p.ca_name from product p where p.ca_name ='$category' and pr_status='판매중' and pr_block = 1 order by in_hit desc";
  $result = mysqli_query($conn, $sql);

  try {

    while ($row = mysqli_fetch_assoc($result)) {
      echo '<a href="searchProduct_detail.php?id='.$row['pr_id'].'&title='.$row['pr_title'].'&line='.$row['l_id'].'&station='.$row['pr_station'].'">'.'<div class="productInfo_box">';

      // 이미지
      echo '<div class="productImg_box">';
      echo '<img src= files/', $row["pr_img"], '> </div>';

      // 상품 상세설명 부분
      echo '<div class="productText_box">';

      //제목
      echo '<div class="productText_box_title_line">';
      echo '<span>',$row["pr_title"],'</span> </div>';

      //역 위치
      echo '<div class="productText_box_station_line">';
      echo '<span>',$row["l_id"],'호선 </span>'.'<span>',$row["pr_station"],'</span> </div>';

      //가격
      echo '<div class="productText_box_price_line">';
      echo '<span>',$row["pr_price"],'</span> </div>';

      echo '</div>';

      echo '</div></a>';

    }
  } catch (PDOException $e) {
    exit($e->getMessage());
  }
 ?>
