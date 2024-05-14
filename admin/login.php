<?php  

$target;
$date = date('y-m-d');
if(isset($_GET['target'])){
    $target = $_GET['target'];
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
<style>
.form-box {
    width: 83%;
    margin: auto;
}

@media (min-width: 0px) and (max-width: 767px) {
    .form-box {
        width: 100% !important;
        margin: auto
    }

}
</style>
<section class="main">
    <div class="row justify-center">
        <div class="col-md-5 col-sm-12 h-min-screen shadow-lg mt-8 py-3" style="background-color: #fafafa">
            <div class="container sm:p-5 p-4 form-box">
                <div class="logo">
                    <a href="index.php">
                        <div class="logo w-100">
                            <img src="../assets/images/logo.png" alt="" style='width: 50%' />
                        </div>
                    </a>
                </div>
                <div class="text ">
                    <h2 class="sm:text-5xl text-3xl font-semibold">Welcome Back!</h2>
                    <h2 class="font-semibold">Please Login with Admin ID</h2>
                </div>
                <form class="row g-3 mt-3" onsubmit='return false'>
                    <div class="col-md-12">
                        <label for="validationServer01" class="form-label font-bold uppercase text-xs">Bar ID</label>
                        <input type="text" class="form-control" id="adminId" />
                        <div class="invalid-feedback error-adminId">Please enter your bar Id</div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationServer01" class="form-label font-bold uppercase text-xs">Password</label>
                        <input type="password" class="form-control" id="password" />
                        <div class="invalid-feedback error-password">Please enter your password</div>
                    </div>
                    <div class="col-12">
                        <button class="btn bg-teal-600 font-bold text-white w-100" id='login'
                            onclick='LoginUser()'>LOGIN</button>
                    </div>
                    <input type="hidden" id='target' value='<?php echo $target ?>'>
                    <input type="hidden" id='date' value='<?php echo $date ?>'>
                </form>
            </div>
        </div>

    </div>
</section>
<?php 
include('includes/footer.php')
?>


<script>
function LoginUser() {
    var adminId = $("#adminId").val();
    var password = $("#password").val();
    var target = $('#target').val();
    var date = $('#date').val();

    if (adminId == "") {
        $("#adminId").removeClass('form-control').addClass('form-control is-invalid');
        $('.error-adminId').show();
    } else {
        $("#adminId").removeClass('form-control is-invalid').addClass('form-control');
        $('.error-adminId').hide();
    }

    if (password == "") {
        $("#password").removeClass('form-control').addClass('form-control is-invalid');
        $('.error-password').show();
    } else {
        $("#password").removeClass('form-control is-invalid').addClass('form-control');
        $('.error-password').hide();
    }




    if (adminId != "" && password != "") {
        $('#login').html('Please wait...')

        $.ajax({
            url: "ajax_controls/admin_login.php",
            method: "post",
            data: {
                adminId: adminId,
                password: password
            },
            dataType: "text",
            success: function(data) {
                $('#login').html('login')
                console.log(data)
                if (data == 'incorrect password') {
                    $.toast({
                        heading: 'Oops!!!',
                        text: 'You have entered an incorrect password',
                        showHideTransition: 'slide',
                        bgColor: '#dc2626',
                        textColor: 'white',
                        position: 'top-left',

                    })
                } else if (data == 'not found') {
                    $.toast({
                        heading: 'Oops!!!',
                        text: 'User not found with this Bar ID',
                        showHideTransition: 'slide',
                        bgColor: '#dc2626',
                        textColor: 'white',
                        position: 'top-left',


                    })
                } else if (data == 'success') {
                    $.toast({
                        heading: 'Congratulations',
                        text: 'You have logged in successfully',
                        showHideTransition: 'slide',
                        bgColor: '#15803d',
                        textColor: 'white',
                        position: 'top-left',

                        afterHidden: function() {
                            if (target == 'barroll') {
                                window.location.assign(`index.php?date=${date}`)
                            } else {
                                window.location.assign(`index.php?date=${date}`)
                            }
                        },
                    })
                }
            }
        });

    }

};
</script>