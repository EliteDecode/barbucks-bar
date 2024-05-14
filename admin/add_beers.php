<?php  

include('includes/header.php');
require('includes/database/db_controllers.php');


 ?>

<style>
:root {
    --blue: #171d64;
    --red: #fb923c;
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
    <div class="wrap sm:h-screen h-min-screen" style="background:#F9F9F9;  overflow-x:hidden">
        <div class="row">
            <div class="col-md-2 col-lg-2 col-xl-2">
                <?php include('sidenav.php') ?>
            </div>
            <div class="col-md-10 col-lg-10 col-xl-10 ">
                <div class="container mt-3 ">
                    <div id="msg"></div>
                    <form id='post_form' enctype="multipart/form-data" onsubmit="return false"
                        class="border bg-white py-1 px-4 md:py-4 md:px-5 shadow-md rounded-md mb-5">
                        <div class="flex items-center space-x-2 my-4">
                            <h6 class="font-bold uppercase text-md text-blue-600">Add beer</h6>
                            <img src="../assets/icons/edit2.png" alt="" style="width:20px">
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="product">Product</label>
                                    <input type="text" class="form-control" placeholder="e.g. Buldweiser" id='product'
                                        name='product'>
                                    <div class="invalid-feedback error-product">
                                        Please enter beers name
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="price_per_can">Price per can</label>
                                    <input type="text" class="form-control" placeholder="e.g. $6" id='price_per_can'
                                        name='price_per_can'>
                                    <div class="invalid-feedback error-price_per_can">
                                        Please enter price per can of beer
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="price_of_drink">Price of drink</label>
                                    <input type="text" class="form-control" placeholder="e.g. $6" id='price_of_drink'
                                        name='price_of_drink'>
                                    <div class="invalid-feedback error-price_of_drink">
                                        Please enter price of beer
                                    </div>
                                </div>
                            </div>



                        </div>


                        <div class="flex justify-center mb-4">
                            <button class="btn bg-blue-600 py-2  text-white w-64  flex justify-center font-bold mt-4"
                                type="submit" onclick="add_post()" id="add_btn"> <i id="hide-fa"
                                    class="fa  fa-spinner fa-spin"></i>
                                &nbsp ADD DATA
                                &nbsp</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>






    <?php include('includes/footer.php')?>
    <script>
    $("#hide-fa").hide();

    function add_post() {
        var product = $("#product").val();
        var price_per_can = $("#price_per_can").val();
        var price_of_drink = $("#price_of_drink").val();


        if (product == "") {
            $("#product").removeClass('form-control').addClass('form-control is-invalid');
            $('.error-product').show();

        } else {
            $("#product").removeClass('form-control is-invalid').addClass('form-control');
            $('.error-product').hide();
        }


        if (price_per_can == "") {
            $("#price_per_can").removeClass('form-control').addClass('form-control is-invalid');
            $('.error-price_per_can').show();

        } else {
            $("#price_per_can").removeClass('form-control is-invalid').addClass('form-control');
            $('.error-price_per_can').hide();

        }

        if (price_of_drink == "") {
            $("#price_of_drink").removeClass('form-control').addClass('form-control is-invalid');
            $('.error-price_of_drink').show();

        } else {
            $("#price_of_drink").removeClass('form-control is-invalid').addClass('form-control');
            $('.error-price_of_drink').hide();

        }



        if (product != "" && price_of_drink != "" && price_per_can != "") {

            $('#add_btn').html('Please Wait....')
            var formData = new FormData(document.getElementById('post_form'))
            fetch('ajax_controls/add_beers.php', {
                    method: 'POST',
                    body: formData
                })
                .then(function(response) {

                    return response.text();
                })
                .then(function(text) {
                    console.log(text)
                    $('#add_btn').html('ADD PROJECT')
                    if (text.includes('success')) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'Data has been added successfully',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        }).then(function() {
                            window.location = "beers.php";
                        });
                    }

                    if (text.includes('exists')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Data already exists',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })
                    }
                })

        }
    }
    </script>
</body>

</html>