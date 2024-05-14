<?php  

include ('includes/header.php');
require('admin/includes/database/db_controllers.php');



?>

<section class="main">
    <div class="row">
        <div class="col-md-6 col-sm-12" style="background-color: #fafafa">
            <div class="container p-5">
                <div class="logo">
                    <a href="index.php"> <img src="assets/images/logo.png" alt="" style='width: 50%' /></a>
                </div>
                <div class="text mt-4">
                    <h2 class="text-5xl font-semibold">Welcome Back!</h2>
                    <h2>Please select a slice</h2>
                </div>
                <div class="row mt-5">
                    <?php  if(isset($_SESSION['users'])): ?>
                    <a href="barroll.php?bar=bar1" class='col-md-4 mb-5 '>
                        <div class=" flex rounded-md items-center justify-center bg-white shadow-md hover:shadow-none cursor-pointer  p-3"
                            style='height: 15vh;'>
                            <h2 class='flex justify-center font-bold text-lg uppercase'>Bar 1</h2>
                        </div>
                    </a>
                    <?php else: ?>
                    <a href="login.php?bar=bar1&route=barrolls" class='col-md-4 mb-5'>
                        <div class="  flex rounded-md items-center justify-center bg-white shadow-md hover:shadow-none cursor-pointer  p-3"
                            style='height: 15vh;'>
                            <h2 class='flex justify-center font-bold text-lg uppercase'>Bar 1</h2>
                        </div>
                    </a>
                    <?php endif ?>
                    <?php  if(isset($_SESSION['users'])): ?>
                    <a href="barroll.php?bar=bar2" class='col-md-4 mb-5 '>
                        <div class=" flex rounded-md items-center justify-center bg-white shadow-md hover:shadow-none cursor-pointer  p-3"
                            style='height: 15vh;'>
                            <h2 class='flex justify-center font-bold text-lg uppercase'>Bar 2</h2>
                        </div>
                    </a>
                    <?php else: ?>
                    <a href="login.php?bar=bar2&route=barrolls" class='col-md-4 mb-5'>
                        <div class="  flex rounded-md items-center justify-center bg-white shadow-md hover:shadow-none cursor-pointer  p-3"
                            style='height: 15vh;'>
                            <h2 class='flex justify-center font-bold text-lg uppercase'>Bar 2</h2>
                        </div>
                    </a>
                    <?php endif ?>
                    <?php  if(isset($_SESSION['users'])): ?>
                    <a href="barroll.php?bar=bar3" class='col-md-4 mb-5 '>
                        <div class=" flex rounded-md items-center justify-center bg-white shadow-md hover:shadow-none cursor-pointer  p-3"
                            style='height: 15vh;'>
                            <h2 class='flex justify-center font-bold text-lg uppercase'>Bar 3</h2>
                        </div>
                    </a>
                    <?php else: ?>
                    <a href="login.php?bar=bar3&route=barrolls" class='col-md-4 mb-5'>
                        <div class="  flex rounded-md items-center justify-center bg-white shadow-md hover:shadow-none cursor-pointer  p-3"
                            style='height: 15vh;'>
                            <h2 class='flex justify-center font-bold text-lg uppercase'>Bar 3</h2>
                        </div>
                    </a>
                    <?php endif ?>
                    <?php  if(isset($_SESSION['users'])): ?>
                    <a href="barroll.php?bar=bar4" class='col-md-4 mb-5 '>
                        <div class=" flex rounded-md items-center justify-center bg-white shadow-md hover:shadow-none cursor-pointer  p-3"
                            style='height: 15vh;'>
                            <h2 class='flex justify-center font-bold text-lg uppercase'>Bar 4</h2>
                        </div>
                    </a>
                    <?php else: ?>
                    <a href="login.php?bar=bar4&route=barrolls" class='col-md-4 mb-5'>
                        <div class="  flex rounded-md items-center justify-center bg-white shadow-md hover:shadow-none cursor-pointer  p-3"
                            style='height: 15vh;'>
                            <h2 class='flex justify-center font-bold text-lg uppercase'>Bar 4</h2>
                        </div>
                    </a>
                    <?php endif ?>
                    <?php  if(isset($_SESSION['users'])): ?>
                    <a href="barroll.php?bar=bar5" class='col-md-4 mb-5 '>
                        <div class=" flex rounded-md items-center justify-center bg-white shadow-md hover:shadow-none cursor-pointer  p-3"
                            style='height: 15vh;'>
                            <h2 class='flex justify-center font-bold text-lg uppercase'>Bar 5</h2>
                        </div>
                    </a>
                    <?php else: ?>
                    <a href="login.php?bar=bar5&route=barrolls" class='col-md-4'>
                        <div class="  flex rounded-md items-center justify-center bg-white shadow-md hover:shadow-none cursor-pointer  p-3"
                            style='height: 15vh;'>
                            <h2 class='flex justify-center font-bold text-lg uppercase'>Bar 5</h2>
                        </div>
                    </a>
                    <?php endif ?>
                    <?php  if(isset($_SESSION['users'])): ?>
                    <a href="barroll.php?bar=bar6" class='col-md-4 '>
                        <div class=" flex rounded-md items-center justify-center bg-white shadow-md hover:shadow-none cursor-pointer  p-3"
                            style='height: 15vh;'>
                            <h2 class='flex justify-center font-bold text-lg uppercase'>Bar 6</h2>
                        </div>
                    </a>
                    <?php else: ?>
                    <a href="login.php?bar=bar6&route=barrolls" class='col-md-4'>
                        <div class="  flex rounded-md items-center justify-center bg-white shadow-md hover:shadow-none cursor-pointer  p-3"
                            style='height: 15vh;'>
                            <h2 class='flex justify-center font-bold text-lg uppercase'>Bar 6</h2>
                        </div>
                    </a>
                    <?php endif ?>

                </div>

            </div>
        </div>
        <div class="col-md-6 col-sm-12 background-barrol hidden sm:block" style="height: 100vh; overflow: hidden">
            <div style="position: fixed; bottom: 7%" class="p-5">
                <h2 class="text-white text-3xl font-bold">
                    Barbucks: A one-stop destination for all your beverage needs.
                </h2>
                <p class="text-gray-100 text-lg">
                    offering a wide variety of drinks in a fun and lively atmosphere.
                </p>
            </div>
        </div>


    </div>
</section>
</body>

</html>