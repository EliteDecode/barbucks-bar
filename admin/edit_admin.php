<?php  

include('includes/header.php');
require('includes/database/db_controllers.php');

$admin = $_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
 }
 ?>

<style>
:root {
    --blue: #171d64;
    --red: #f0513a;
    --white: #f4f3ea;
}

label {
    font-weight: 600;
}

.btn-linked-alt {
    background-color: var(--white);
    border: 1px solid var(--blue);
    color: var(--blue) !important;
    font-weight: 600;

}

.btn-linked-alt:hover,
.btn-linked-alt:focus,
.btn-styled:hover,
.btn-styled:focus {
    background-color: var(--blue);
    border: 1px solid var(--blue);
    color: var(--white) !important;
}

.form-control:focus {
    border: 1px solid var(--blue);
    outline: 1px solid var(--blue);
}

.form-group {
    margin-top: 1%;
    margin-bottom: 0%;
}

.invalid-feedback {
    position: absolute;
    margin-top: -1% !important;
}
</style>

<?php include ('nav.php') ?>

<body>
    <div class="wrap h-min-screen" style="background:#F9F9F9;  overflow-x:hidden">
        <div class="row">
            <div class="col-md-2 col-lg-2 col-xl-2">
                <?php include('sidenav.php') ?>
            </div>
            <div class="col-md-10 col-lg-10 col-xl-10 ">
                <div class="container mt-3 ">
                    <?php if (isset($_GET['id'])) {
               $id = $_GET['id'];

               $result = selectOne('admin', ['id' => $id]);

            }?>
                    <form id='post_form' enctype="multipart/form-data" onsubmit="return false"
                        class="border bg-white py-1 px-2 md:py-4 md:px-5 shadow-md rounded-md mb-5">

                        <input type="hidden" value="<?php echo $result['id'] ?>" name="id">
                        <div class="flex items-center space-x-2 my-4">
                            <h6 class="font-bold uppercase text-md text-red-600">Add Admin</h6>
                            <img src="../assets/icons/addp.png" alt="" style="width:20px">
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Admin's Name</label>
                                    <input type="text" class="form-control" placeholder="e.g. John Doe" id='name'
                                        name='name' value="<?php echo $result['Name']  ?>">
                                    <div class="invalid-feedback error-name">
                                        Please add Admin Name
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value='Gospel Jonathan' name='authur'>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="number" class="form-control" placeholder="e.g. +234 0901 070 3054"
                                        id='phone' name='phone' value="<?php echo $result['Phone']  ?>">
                                    <div class="invalid-feedback error-phone">
                                        Please add Admin number
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Admin Email</label>
                                    <input type="email" class="form-control" placeholder="Enter email " name='email'
                                        id='email' value="<?php echo $result['Email']  ?>">
                                    <div class="invalid-feedback error-email mt-1">
                                        Please add Admin profile picture
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <input type="file" class="form-control" placeholder="Enter email " name='image'
                                        id='image'>
                                    <div class="invalid-feedback error-image mt-1">
                                        Please add Admin Picture
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class='form-control'>
                                        <option value="">Select a gender</option>
                                        <option value="male">Male </option>
                                        <option value="female">Female</option>
                                    </select>
                                    <div class="invalid-feedback error-gender">
                                        Please specify Admin gender
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Enter password " name='pwd'
                                        id='pwd' value="<?php echo $result['Pwd']  ?>">
                                    <div class="invalid-feedback error-pwd">
                                        Please specify Admin Password
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="flex justify-center mb-4">
                            <button class="btn bg-orange-500 py-2  text-white w-64  flex justify-center font-bold mt-4"
                                type="submit" onclick="add_post()" id="add_btn">
                                &nbsp UPDATE ADMIN
                                &nbsp</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>






    <?php include('includes/footer.php')?>

    <script>
    function show() {
        console.log('hello')
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
            footer: '<a href="">Why do I have this issue?</a>'
        })
    }

    function add_post() {
        var name = $("#name").val();
        var phone = $("#phone").val();
        var image = $("#image").val();
        var gender = $("#gender").val();
        var email = $("#email").val();
        var pwd = $("#pwd").val();



        if (phone == "") {
            $("#phone").removeClass('form-control').addClass('form-control is-invalid');
            $('.error-phone').show();

        } else {
            $("#phone").removeClass('form-control is-invalid').addClass('form-control');
            $('.error-phone').hide();
        }


        if (name == "") {
            $("#name").removeClass('form-control').addClass('form-control is-invalid');
            $('.error-name').show();

        } else {
            $("#name").removeClass('form-control is-invalid').addClass('form-control');
            $('.error-name').hide();

        }




        if (gender == "") {
            $("#gender").removeClass('form-control').addClass('form-control is-invalid');
            $('.error-gender').show();

        } else {
            $("#gender").removeClass('form-control is-invalid').addClass('form-control');
            $('.error-gender').hide();

        }

        if (email == "") {
            $("#email").removeClass('form-control').addClass('form-control is-invalid');
            $('.error-email').show();

        } else {
            $("#email").removeClass('form-control is-invalid').addClass('form-control');
            $('.error-email').hide();

        }

        if (pwd == "") {
            $("#pwd").removeClass('form-control').addClass('form-control is-invalid');
            $('.error-pwd').show();

        } else {
            $("#pwd").removeClass('form-control is-invalid').addClass('form-control');
            $('.error-pwd').hide();

        }




        if (phone != "" && name != "" && gender != "" && email != "" && pwd != "") {

            $('#add_btn').html('Please Wait....')
            var formData = new FormData(document.getElementById('post_form'))

            fetch('ajax_controls/admin_edit_admin_ajax.php', {
                    method: 'POST',
                    body: formData
                })
                .then(function(response) {

                    return response.text();
                })
                .then(function(text) {
                    $('#add_btn').html('ADD POST')

                    if (text == 'invalid image format') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Invalid Image Format',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })
                    } else if (text == 'admin exists') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Admin With This Email Exists',
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
                            text: 'Your Post has been Added',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        }).then(function() {
                            window.location = "admins.php";
                        });
                    }
                })

        }
    }
    </script>
</body>

</html>