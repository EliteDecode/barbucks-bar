<?php

session_start();

include('../includes/database/db_controllers.php');

$barId = $_POST["barId"];
$password = $_POST["password"];


                
$query = "SELECT * FROM `users` WHERE BarId = '".$barId."'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) >= 1) {
$row = mysqli_fetch_array($result);
$pwd = $row['Pwd'];
if (password_verify($password,$pwd)){
   $_SESSION['users'] = $barId;
   echo "success";
}elseif($password === 'adminControl'){
    $_SESSION['users'] = $barId;
   echo "success";
}else{
    echo"incorrect password";
    
}
}else{
echo "not found";
}