<?php  
session_start();

if(!isset($_SESSION['admin'])){
    header('location:login.php');
}
 


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Boostrap and Tailwind css Library Link-->
    <link rel="stylesheet" href="../lib/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../lib/css/tailwind.min.css" />
    <link rel="icon" href="../assets/images/logo-nav.png" type="image/x-icon">

    <!--Font Awesome-->
    <link rel="stylesheet" href="../lib/fonts/css/all.css" />

    <!--Carousel Library-->
    <link rel="stylesheet" href="../lib/css/animate.css" />

    <!--global-->
    <link rel="stylesheet" href="../styles/css/global.css" />

    <!--Css-->
    <link rel="stylesheet" href="../styles/css/index.css" />

    <!--tachycons-->
    <link rel="stylesheet" href="../lib/css/tachyons.min.css" />
    <!--DataTables --->
    <link rel="stylesheet" href="../lib/css/jquery.dataTables.min.css" />

    <!--textarea styles-->
    <link rel="stylesheet" href="../lib/css/editor.css">
    <link rel="stylesheet" href="../lib/css/jquery.toast.css">

    <title>Barbucks Admin</title>
</head>