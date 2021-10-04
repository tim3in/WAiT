<?php 

require_once 'DBController.php';

$obj = new DBController();

$result =  $obj->getTop5Animals();

      
?>