<?php

include('../includes/database/db_controllers.php');

$id = $_POST['id'];

 $result = delete('liquors', $id);

 if ($result) {
    echo "success";
 }else{
   echo "error";
 }