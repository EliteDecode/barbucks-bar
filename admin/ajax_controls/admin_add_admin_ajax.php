<?php

include('../includes/database/db_controllers.php');

$email = $_POST['email'];
$pwd = $_POST['pwd'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$role = $_POST['role'];



$result = selectAll('admin', ['AdminId' => $email]);
$num = count($result);

if ($num >=1) {
    echo "admin exists";
}else{
    // echo "<script>window.location.assign('posts.php');</script>";
    echo "success";
$data = [
    'AdminId' => $email,
    'Pwd' => $pwd,
    'Role' => $role,
    'Phone' => $phone,
    'Gender' => $gender,
    'Fullname' => $name,
    'Verified' => 1,
    'Main' => 0
   ];
    
    insert('admin', $data);
}