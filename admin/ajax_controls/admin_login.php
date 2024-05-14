<?php

session_start();

include('../includes/database/db_controllers.php');

$adminId = $_POST["adminId"];
$password = $_POST["password"];

                
$query = "SELECT * FROM `admin` WHERE Verified = 1 AND AdminId = '".$adminId."' ";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) >= 1) {
$row = mysqli_fetch_array($result);
$pwd = $row['Pwd'];
if ($password == $pwd){
   $_SESSION['admin'] = $adminId;
   echo "success";
}else{
    echo"incorrect password";
    
}
}else{
echo "not found";
}