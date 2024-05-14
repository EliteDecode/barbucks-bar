<?php
session_start();
$ad = $_SESSION['admin'];

require('includes/database/db_controllers.php');
if (!isset($_SESSION['admin'])) {
    header('location: login.php');
  }


?>

<style>
:root {
    --yellow: #333d51;
    --yellow: #d3ac2b;
    --white: #f4f3ea;
}

.wrap_form {
    background-color: #fff;
    box-shadow: 2px 4px 13px grey;
    border-radius: 10px;
    padding: 15px 30px;
}

.ui-tabs-nav li {
    background-color: #f0513a !important;
    border: 1px solid #f0513a !important;
    margin: 1% 1% !important;
    padding: .2% !important;
    border-radius: 5px;
}

.ui-tabs-nav li a {
    color: #fff !important;
    font-weight: bold;
}

li.ui-tabs-active {
    background-color: var(--white) !important;
    border: 1px solid #f0513a !important;

}

li.ui-tabs-active a {
    color: #f0513a !important;
}



.form-group {
    margin: 3% 0%;
}


.wrap {
    overflow: hidden;
}

@media (min-width: 0px) and (max-width: 969px) {
    .form-group {
        margin-top: 4%;
        margin-bottom: 8%;
    }

}


@media (min-width: 0px) and (max-width: 969px) {
    .ui-tabs-nav li {
        background-color: #f0513a !important;
        border: 1px solid #f0513a !important;
        margin: 2% 1% !important;
        padding: 1% !important;
        border-radius: 5px;
    }

    .ui-tabs-nav li a {
        color: #fff !important;
        font-weight: bold;
    }

    .wrap_form {
        width: 100% !important;
        padding: 7%;
        margin: 7% 0% 0% 0% !important;
        box-shadow: 2px 4px 13px grey;
        border-radius: 10px;
    }

    .form-group {
        margin: 7% 0% !important;
    }


}
</style>


<?php include ('nav.php') ?>

<body>
    <div class="wrap h-screen" style="background:#F9F9F9; overflow-x:hidden">
        <div class="row">
            <div class="col-md-2 col-lg-2 col-xl-2">
                <?php include('sidenav.php') ?>
            </div>
            <div class="col-md-10 col-lg-10 col-xl-10">


                <div class="container mt-2 ml-0 mr-0 ">

                    <?php
                        
                        $result = selectOne('admin', ['Email' => $ad]);

                        $id = $result['id'];
                        
                    ?>
                    <div id="tabs">
                        <ul class="flex">
                            <li class="w-full "><a href="#tabs-1"
                                    class="flex items-center justify-center space-x-2 p-1">
                                    <img src="../assets/icons/profile.png" alt="" width="20px"><span>Profile</span></a>
                            </li>
                            <li class="w-full"><a href="#tabs-2"
                                    class=" flex items-center justify-center space-x-2 p-1">
                                    <img src="../assets/icons/password.png" alt="" width="20px">
                                    <span>Key</span></a></li>
                            <li class="w-full"><a href="#tabs-3"
                                    class=" flex items-center justify-center space-x-2 p-1">
                                    <img src="../assets/icons/photography.png" alt="" width="20px">
                                    <span>Photo</span></a>
                            </li>
                        </ul>

                        <!--Change Password-->
                        <div id="tabs-2">
                            <div class='wrap_form update' style=' margin:4% 15%; width:70%' id='password-form'>
                                <div id="msg" class="alert alert-success valid-feedback" style=''></div>
                                <form action="" method="post" enctype="multipart/form-data" class='form '>
                                    <input type="hidden" name='id' value='<?php echo $id ?>' id='id'>
                                    <div class="form-group">
                                        <label for="payment" style="font-size:14px; font-weight:bold;">Old
                                            Password</label>
                                        <input type="password" name="method" class="form-control"
                                            placeholder="Your Old password..." id='old_password' />

                                    </div>
                                    <div class="form-group">
                                        <label for="payment" style="font-size:14px; font-weight:bold;">New
                                            Password</label>
                                        <input type="password" name="method" class="form-control"
                                            placeholder="Your New password..." id='new_password' />

                                    </div>
                                    <div class="form-group">
                                        <label for="payment" style="font-size:14px; font-weight:bold;">Retype New
                                            Password</label>
                                        <input type="password" name="method" class="form-control"
                                            placeholder="Retype your New password..." id='new_password2' />

                                    </div>

                                </form>
                                <button type='submit' id='submit' class='btn bg-orange-500 text-white font-semibold'
                                    onclick='update_password() '>
                                    &nbsp Update &nbsp</button>
                            </div>
                        </div>




                        <!--update profile-->

                        <?php
                     $result = selectOne('admin', ["Email" => $ad]);

                     $username = $result['Name'];
                     $email = $result['Email'];
                     $id = $result['id'];
                     
                     ?>
                        <div id="tabs-1">

                            <div class='wrap_form' style=' margin:4% 15%; width:70%' id='profile-form tabs-2'>
                                <div id="msg_p" class="alert alert-success valid-feedback"></div>
                                <form id='profile_form' method="post" enctype="multipart/form-data" class='form'
                                    onsubmit="return false">

                                    <div class="form-group">
                                        <label for="username" style="font-size:14px; font-weight:bold;">Username</label>
                                        <input type="text" class="form-control" placeholder="Enter Your Username..."
                                            id='username' value='<?php echo $username ?>' />

                                    </div>
                                    <div class="form-group">
                                        <label for="email" style="font-size:14px; font-weight:bold;">Email</label>
                                        <input type="email" name="method" class="form-control"
                                            placeholder="Enter Your Email..." id='email' value='<?php echo $email ?>' />

                                    </div>


                                    <button type='submit' id='submit'
                                        class='btn bg-custom-red mt-3 text-white font-semibold'
                                        onclick='update_profile() '>
                                        &nbsp
                                        Update &nbsp</button>

                                </form>
                            </div>
                        </div>


                        <div id="tabs-3">

                            <?php 
                         if (isset($_POST['upload'])) {
                              $image = $_FILES['image']['name'];
                              $image_tmp = $_FILES['image']['tmp_name'];
                              $folder = 'images/'  ;


                              $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
                              $error = array();

                              if (empty($image)) {
                                 $error['image'] = 'Please choose an image';
                              }

                              if (count($error) === 0) {

                              $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
                              
                                // get uploaded file's extension
                                $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                                // can upload same image using rand function
                                $final_image = rand(1000,1000000).$image;
                                // check's valid format
                                if(!in_array($ext, $valid_extensions)){ 
                                    echo "<script>alert('invalid Image Format')</script>";
                                }else{
                                    $path = strtolower($final_image); 
                                    $folder = $folder . $path;
                                    update('admin', $id, ["Picture" => $path]);
                                   move_uploaded_file($image_tmp, $folder); 
                                   echo "<script>alert('Image updated successfully')</script>";

                                }

                         }
                        }

                        if (isset($error['image'])) {
                            $er = $error['image'];
                           echo "<script>alert('$er')</script>";
                        }
                        
                        ?>

                            <div style=' margin:4% 15%; width:70%' class="wrap_form">

                                <form enctype="multipart/form-data" onsubmit="" method='post'>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Profile Picture</label>
                                        <input type="file" class="form-control" placeholder="Enter email " name='image'>
                                    </div>

                                    <button type="submit" class="btn bg-custom-red text-white font-semibold"
                                        name='upload'>Upload</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>






    <?php include('includes/footer.php')?>
    <script>
    $("#tabs").tabs();


    function update_password() {


        var oldpassword = $("#old_password").val();
        var new_password = $("#new_password").val();
        var new_password2 = $("#new_password2").val();
        var id = $("#id").val();

        if (oldpassword == "") {
            $("#old_password").removeClass('form-control').addClass('form-control is-invalid');

        } else {
            $("#old_password").removeClass('form-control is-invalid').addClass('form-control');

        }


        if (new_password == "") {
            $("#new_password").removeClass('form-control').addClass('form-control is-invalid');

        } else {
            $("#new_password").removeClass('form-control is-invalid').addClass('form-control');


        }

        if (new_password2 == "") {
            $("#new_password2").removeClass('form-control').addClass('form-control is-invalid');

        } else {
            $("#new_password2").removeClass('form-control is-invalid').addClass('form-control');
        }





        if (oldpassword != "" && new_password != "" && new_password2 != "") {


            $.ajax({
                url: "ajax_controls/admin_update_password.php",
                method: "post",
                data: {
                    old_password: oldpassword,
                    new_password: new_password,
                    new_password2: new_password2,
                    id: id
                },
                dataType: "text",
                success: function(data) {

                    if (data == 'incorrect old password') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Old Password Is Incorrect...',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })
                    } else if (data == 'both password must match') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Your New Passwords Doesnt Match',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'Password Updated Successfully',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        }).then(function() {
                            window.location = "profile.php";
                        });
                    }
                }
            });

        }


    }


    function update_profile() {


        var username = $("#username").val();
        var email = $("#email").val();
        var profile = $("#profile").val();
        var id = $('#id').val();


        if (username == "") {
            $("#username").removeClass('form-control').addClass('form-control is-invalid');


        } else {
            $("#username").removeClass('form-control is-invalid').addClass('form-control');
            $('.error-name').hide();

        }

        if (email == "") {
            $("#email").removeClass('form-control').addClass('form-control is-invalid');

        } else {
            $("#email").removeClass('form-control is-invalid').addClass('form-control');
            $('.error-emailp').hide();
        }



        if (username != "" && email != "") {



            $.ajax({
                url: "ajax_controls/admin_profile_update_ajax.php",
                method: "post",
                data: {
                    username: username,
                    email: email,
                    id: id
                },
                dataType: "text",
                success: function(data) {
                    if (data == 'email exists') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Admin already exists..',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })
                    } else if (data == 'invalid email') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Invalid email entered..',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'Profile updated successfully',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        }).then(function() {
                            window.location = "profile.php";
                        });
                    }
                }
            });

        }



    }
    </script>

</body>

</html>