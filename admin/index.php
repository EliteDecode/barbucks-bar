<?php 

require('includes/header.php') ;
require('includes/database/db_controllers.php');

$date = date('y-m-d');
$adminId;
if(isset($_SESSION['admin'])){
    $adminId = $_SESSION['admin'];
}

$adminDetails = selectOne('admin', ['AdminId' => $adminId]);

$role = $adminDetails['Role'];


?>

<style>
.track {
    margin-top: 4%;
}

.inner_box {
    width: 90%;
    padding: 7% 8%;
    margin: 0% 5% 4% 5%;
}

.dash {
    color: #fff !important;
    text-decoration: none !important;
}

.dash:hover {
    color: var(--white) !important;
}

.dash i {
    font-size: 25px;
    margin-bottom: 8%;
}

.wrap {
    overflow: hidden;
    height: 820px;
}

@media (min-width: 0px) and (max-width: 969px) {
    .wrap {
        overflow: hidden;
        height: 1020px;
    }

    .form-group {
        margin-top: 4%;
        margin-bottom: 8%;
    }

}

@media (min-width: 0px) and (max-width: 969px) {

    .tabss {
        overflow: scroll;
        margin-top: 7%;
    }



    .track {
        margin-top: 9%;
    }
}
</style>

<?php include ('nav.php') ?>

<body>

    <div class="wrap h-min-screen" style=" background:#F9F9F9">



        <div class="row">
            <div class="col-md-2 col-lg-2 col-xl-2">
                <?php include('sidenav.php') ?>
            </div>
            <div class="col-md-10 col-lg-10 col-xl-10" style='padding:0% 5%'>
                <div class="container pt2">
                    <div class="row">
                        <?php if($role == 'barrol'): ?>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-primary inner_box" style='border-radius:10px;'>
                                <a href='beers.php' class='dash'>
                                    <img src="../assets/images/beer2.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">
                                    <h4 class="font-semibold mt-3">Total Beer Product: <?php
                                      $num = selectAll('inventory', ['Category' => 'Beer']);  
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?></h4>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-teal-600 inner_box" style='border-radius:10px;'>
                                <a href='beer_sales.php' class='dash'>
                                    <img src="../assets/images/inventory.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">Today's Beer sales <?php
                                      $num =  selectAllDistinct('saved_data', 'BarID', 'Bar' ,['DateReg' => $date]);
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?>

                                    </h4>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-info inner_box" style='border-radius:10px;'>
                                <a href='add_posts.php' class='dash'>
                                    <img src="../assets/images/liquor.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">Total Liquor Product: <?php
                                      $num = selectAll('inventory', ['Category' => 'Liquor']);  
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-secondary inner_box" style='border-radius:10px;'>
                                <a href='liquor_sales.php' class='dash'>
                                    <img src="../assets/images/inventory.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">Today's Liquor sales <?php
                                      $num =  selectAllDistinct('saved_data_liquor', 'BarID', 'Bar' ,['DateReg' => $date]);
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?>

                                    </h4>
                                </a>
                            </div>

                        </div>


                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-red-600 inner_box" style='border-radius:10px;'>
                                <a href='settings.php' class='dash'>
                                    <img src="../assets/images/ras-settings.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">
                                        Settings
                                    </h4>
                                </a>
                            </div>

                        </div>

                        <?php  elseif($role == 'bottle_service'):  ?>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-primary inner_box" style='border-radius:10px;'>
                                <a href='beers.php' class='dash'>
                                    <img src="../assets/images/beer2.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">
                                    <h4 class="font-semibold mt-3">Total Beer Product: <?php
                                      $num = selectAll('inventory', ['Category' => 'Beer']);  
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?></h4>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-info inner_box" style='border-radius:10px;'>
                                <a href='add_posts.php' class='dash'>
                                    <img src="../assets/images/liquor.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">Total Liquor Product: <?php
                                      $num = selectAll('inventory', ['Category' => 'Liquor']);  
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-red-600 inner_box" style='border-radius:10px;'>
                                <a href='settings.php' class='dash'>
                                    <img src="../assets/images/ras-settings.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">
                                        Settings
                                    </h4>
                                </a>
                            </div>

                        </div>

                        <?php elseif($role == 'inventory'): ?>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-warning inner_box" style='border-radius:10px;'>
                                <a href='posts.php' class='dash'>
                                    <img src="../assets/images/inventory.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">Inventory <?php
                                      $num = selectAll('beers');  
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?>

                                    </h4>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-red-600 inner_box" style='border-radius:10px;'>
                                <a href='settings.php' class='dash'>
                                    <img src="../assets/images/ras-settings.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">
                                        Settings
                                    </h4>
                                </a>
                            </div>

                        </div>
                        <?php  elseif($role == 'all'): ?>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-primary inner_box" style='border-radius:10px;'>
                                <a href='beers.php' class='dash'>
                                    <img src="../assets/images/beer2.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">
                                    <h4 class="font-semibold mt-3">Total Beer Product: <?php
                                      $num = selectAll('inventory', ['Category' => 'Beer']);  
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?></h4>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-info inner_box" style='border-radius:10px;'>
                                <a href='add_posts.php' class='dash'>
                                    <img src="../assets/images/liquor.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">Total Liquor Product: <?php
                                      $num = selectAll('inventory', ['Category' => 'Liquor']);  
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-warning inner_box" style='border-radius:10px;'>
                                <a href='posts.php' class='dash'>
                                    <img src="../assets/images/inventory.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">Inventory <?php
                                      $num = selectAll('beers');  
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?>

                                    </h4>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-teal-600 inner_box" style='border-radius:10px;'>
                                <a href='beer_sales.php' class='dash'>
                                    <img src="../assets/images/inventory.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">Today's Beer sales <?php
                                      $num =  selectAllDistinct('saved_data', 'BarID', 'Bar' ,['DateReg' => $date]);
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?>

                                    </h4>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-secondary inner_box" style='border-radius:10px;'>
                                <a href='liquor_sales.php' class='dash'>
                                    <img src="../assets/images/inventory.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">Today's Liquor sales <?php
                                      $num =  selectAllDistinct('saved_data_liquor', 'BarID', 'Bar' ,['DateReg' => $date]);
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?>

                                    </h4>
                                </a>
                            </div>

                        </div>

                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-red-600 inner_box" style='border-radius:10px;'>
                                <a href='settings.php' class='dash'>
                                    <img src="../assets/images/ras-settings.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">
                                        Settings
                                    </h4>
                                </a>
                            </div>

                        </div>
                        <?php  elseif($role == 'liquor_room'): ?>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-primary inner_box" style='border-radius:10px;'>
                                <a href='beers.php' class='dash'>
                                    <img src="../assets/images/beer2.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">
                                    <h4 class="font-semibold mt-3">Total Beer Product: <?php
                                      $num = selectAll('inventory', ['Category' => 'Beer']);  
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?></h4>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg 4 col-xl-4 col-sm-12 ">
                            <div class="bg-info inner_box" style='border-radius:10px;'>
                                <a href='add_posts.php' class='dash'>
                                    <img src="../assets/images/liquor.png" class='cursor-pointer ' alt=""
                                        style="width: 45px;">

                                    <h4 class="mt-3 font-semibold">Total Liquor Product: <?php
                                      $num = selectAll('inventory', ['Category' => 'Liquor']);  
                                    $res = count($num);
                                  if ($res > 0) {
                                      echo" <span>$res</span>";
                                  }else{
                                    echo "<span>0</span>";
                                  }
                                 
                                 ?>
                                </a>
                            </div>

                        </div>
                        <?php  endif ?>


                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php include('includes/footer.php')?>
</body>

</html>