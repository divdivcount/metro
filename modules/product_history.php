<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/modules/module_protect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/modules/db_dao.php');

class Product extends MetroDAO {
  protected $quTable = 'product_history';
  protected $quTableId = 'pu_id';




}
  ?>
