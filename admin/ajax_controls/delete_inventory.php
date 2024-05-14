<?php

include('../includes/database/db_controllers.php');

$id = $_POST['id'];

 $result = delete('inventory', $id);

 if ($result) {
    echo "success";
 }else{
   echo "error";
 }