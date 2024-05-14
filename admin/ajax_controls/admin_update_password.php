<?php
session_start();
include('../includes/database/db_controllers.php');

$old = $_POST['old_password'];
$new = $_POST['new_password'];
$new2 = $_POST['new_password2'];
$id = $_POST['id'];

$query = "SELECT * FROM `admin` WHERE id = $id";
$response = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($response);
$pwd = $row['Pwd'];



if ($old != $pwd ) {
    echo "incorrect old password";

}else if($new != $new2){
    echo "both password must match";
}else{
    update('admin', $id, ['Pwd' => $new]);
    echo"success";
}