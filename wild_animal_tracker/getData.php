<?php 

require_once 'DBController.php';

$obj = new DBController();

$val = $obj->getData();  
if($_GET['id']=="animal"){  echo $val[0]; }
if($_GET['id']=="timestamp"){ echo $val[1];  }

?>