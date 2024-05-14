<?php

include('../includes/database/db_controllers.php');

$id = $_POST['id'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$image = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];

$folder = '../images/post_images'  ;

$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

// get uploaded file's extension
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
// can upload same image using rand function
$final_image = rand(1000,1000000).$image;
// check's valid format

if($image != ''){
if(!in_array($ext, $valid_extensions)){ 
    echo"invalid image format";
}else{
    
$result = selectOdd('admin', ['Email' => $email, 'id' => $id]);
$num = count($result);

if ($num >=1) {
    echo "admin exists";
}else{
        // echo "<script>window.location.assign('posts.php');</script>";
        echo "success";
        $path = strtolower($final_image); 
        $folder = $folder . $path;
       
    $data = [
        'Email' => $email,
        'Pwd' => $pwd,
        'Picture' => $path,
        'Phone' => $phone,
        'Gender' => $gender,
        'name' => $name
        
       ];
        
        update('admin', $id,  $data);
        move_uploaded_file($image_tmp, $folder); 
    }
}
}else{
        
$result = selectOdd('admin', ['Email' => $email, 'id' => $id]);
$num = count($result);

if ($num >=1) {
    echo "admin exists";
}else{
        // echo "<script>window.location.assign('posts.php');</script>";
        echo "success";
        $path = strtolower($final_image); 
        $folder = $folder . $path;
       
    $data = [
        'Email' => $email,
        'Pwd' => $pwd,
       
        'Phone' => $phone,
        'Gender' => $gender,
        'name' => $name
        
       ];
        
        update('admin', $id,  $data);
        move_uploaded_file($image_tmp, $folder); 
    }
}