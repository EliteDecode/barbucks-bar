<?php 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    /*--------------------------NAVBAR-------------------------------*/
    nav {
        z-index: 10;
    }

    .navbar-toggler-icon {
        position: relative;
        color: var(--dark);
        outline: none;
    }

    @media(max-width: 767px) {
        .navbar-toggler-icon>i {
            font-size: 17px !important;
        }

    }

    .display {
        display: block;
    }

    .hide {
        display: none;
    }

    .active {
        color: #1d4ed8 !important;
    }

    .navbar {
        display: none !important;
    }



    @media(max-width: 767px) {
        .navbar-desk {
            display: none;
        }

        .navbar {
            display: flex !important;
            flex-direction: row;
            justify-content: space-between;
        }
    }

    .navbar-desk {
        width: 100%;
        height: 90px;
        padding: 2% 2%;
        z-index: 1000 !important;
        position: relative;
    }


    .nav-links {
        margin-right: 0%;
        width: 13%;

    }


    .nav-links ul li {
        list-style-type: none;
        margin-left: 2%;

        padding: 0% 1%;
    }

    .nav-links ul li a {
        color: var(--dark);
        font-size: 15px;
        text-decoration: none !important;
        font-weight: 600;
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .nav-links ul li a {
            color: var(--white);
            font-size: 10px;
            font-weight: 600;
        }
    }

    .nav-links ul li a:hover {
        color: var(--yellow);
        transition: .3s ease all;
    }

    .nav-links ul a li {
        list-style-type: none;
        color: #fff;

    }

    .post_link {
        list-style-type: none;
    }

    .post_link a {
        color: var(--dark);
        text-transform: capitalize;
        text-decoration: none;
        font-size: 15px;
    }

    .mob_post_link {
        margin-left: -87px;
        padding: 1px 80px 1px 15px;
    }


    .logo a img {
        width: 30%;
    }


    @media (min-width: 0px) and (max-width: 575px) {}
    </style>
</head>

<body>


    <section class="navbar-desk "
        style="border-bottom: 1px solid #f0efed; position:sticky; top:0%; background-color:#fff">
        <div class="container flex items-center justify-between">

            <div class="logo">
                <a href="../index.php" class=''> <img src="../assets/images/logo.png" alt=""></a>
            </div>


            <a href="logout.php" class=''> <button class='btn btn-danger btn-sm font-bold'>Logout</button></a>

        </div>
    </section>



    <!--===================Navigation Section for Mobile=========================-->
    <nav class="navbar flex flex-row justify-between  py-8 "
        style="border-bottom: 1px solid #f0efed;position:sticky; top:0%; background-color:#fff">
        <a href='dashboard.php' class="" style='text-decoration:none'>
            <div class="container ">
                <div class="flex justify-between items-center">
                    <a href="index.php"> <img src="../assets/images/logo.png" width='50%' alt=""></a>

                </div>
            </div>
        </a>

    </nav>


    <!--===================END Navigation Section=========================-->