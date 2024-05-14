<?php  
include('includes/header.php');

$target;
$route;

if(isset($_GET['route'])){
    $route = $_GET['route'];
}
if(isset($_GET['bar'])){
    $target = $_GET['bar'];
}


?>
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
    <div class="row">
        <div class="col-md-6 col-sm-12 h-screen " style="background-color: #fafafa">
            <div class="container sm:p-5 p-4 form-box">
                <div class="logo mt-8">
                    <a href="index.php">
                        <div class="logo w-100">
                            <a href="index.php"> <img src="assets/images/logo.png" alt="" style='width: 50%' /></a>
                        </div>
                    </a>
                </div>
                <div class="text mt-8">
                    <h2 class="sm:text-5xl text-3xl font-semibold">Welcome Back!</h2>
                    <h2 class="font-semibold">Please Login with Bar ID</h2>
                </div>
                <form class="row g-3 mt-3" onsubmit='return false'>
                    <div class="col-md-12">
                        <label for="validationServer01" class="form-label font-bold uppercase text-xs">Bar ID</label>
                        <input type="text" class="form-control" id="barId" />
                        <div class="invalid-feedback error-barId">Please enter your bar Id</div>
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
                    <?php if(isset($_GET['route'])): ?>
                    <input type="hidden" value='<?php echo $route ?>' id='route'>
                    <?php endif; ?>
                    <input type="hidden" id='target' value='<?php echo $target ?>'>
                </form>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 background-imageify hidden sm:block" style="height: 100vh; overflow: hidden">
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
<?php 
include('includes/footer.php')
?>


<script>
function LoginUser() {
    var barId = $("#barId").val();
    var password = $("#password").val();
    var target = $('#target').val();

    if (barId == "") {
        $("#barId").removeClass('form-control').addClass('form-control is-invalid');
        $('.error-barId').show();
    } else {
        $("#barId").removeClass('form-control is-invalid').addClass('form-control');
        $('.error-barId').hide();
    }

    if (password == "") {
        $("#password").removeClass('form-control').addClass('form-control is-invalid');
        $('.error-password').show();
    } else {
        $("#password").removeClass('form-control is-invalid').addClass('form-control');
        $('.error-password').hide();
    }




    if (barId != "" && password != "") {
        $('#login').html('Please wait...')

        $.ajax({
            url: "admin/ajax_controls/user_login.php",
            method: "post",
            data: {
                barId: barId,
                password: password,

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
                    var route = $('#route').val()
                    if (route === 'barrolls') {
                        $.toast({
                            heading: 'Congratulations',
                            text: 'You have logged in successfully',
                            showHideTransition: 'slide',
                            bgColor: '#15803d',
                            textColor: 'white',
                            position: 'top-left',
                            afterHidden: function() {
                                window.location.assign(`barroll.php?bar=${target}`)
                            },
                        })
                    } else if (route === 'shooters') {
                        $.toast({
                            heading: 'Congratulations',
                            text: 'You have logged in successfully',
                            showHideTransition: 'slide',
                            bgColor: '#15803d',
                            textColor: 'white',
                            position: 'top-left',
                            afterHidden: function() {
                                window.location.assign(`shooters_bars.php?bar=${target}`)
                            },
                        })
                    } else {
                        $.toast({
                            heading: 'Congratulations',
                            text: 'You have logged in successfully',
                            showHideTransition: 'slide',
                            bgColor: '#15803d',
                            textColor: 'white',
                            position: 'top-left',
                            afterHidden: function() {
                                window.location.assign(`bottle_service.php?bar=${target}`)
                            },
                        })
                    }
                }
            }
        });

    }

};
</script>