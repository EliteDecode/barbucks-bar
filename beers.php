<?php 
session_start();
require('admin/includes/database/db_controllers.php');
$barId = $_SESSION['users'];
 
$row = selectOne('users', ['BarId' => $barId]);

$name = $row['Lastname'];


$posts;
$total_profit;

$date = date('y-m-d');
$formated_date;
$bar;

if(isset($_GET['bar'])){
    $bar = $_GET['bar'];
}


if(isset($_GET['status']) && isset($_GET['date'])){
    $status = $_GET['status'];
    $date = $_GET['date'];
    $bar = $_GET['bar'];
    if($status == 'saved'){
        $posts = selectAll('saved_data', ['DateReg' => $date, 'BarID' => $barId, 'Bar' => $bar ]);

     
        $total_profit = selectOne('saved_data', ['DateReg' => $date]);
        $formated_date = date("F jS, Y", strtotime($date));
    }
}else{
    $posts = selectAll('inventory' , ['Category' => 'Beer']);
    $formated_date = date("F jS, Y", strtotime($date));
}






?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Barbucks</title>
    <link rel="icon" href="assets/images/logo-nav.png" type="image/x-icon">
    <!--Bootstrap css-->
    <link rel="stylesheet" href="lib/css/bootstrap.min.css" />

    <!--Tailwind css-->
    <link rel="stylesheet" href="lib/css/tailwind.min.css" />

    <!--Carousel-->
    <link rel="stylesheet" href="lib/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="lib/css/owl.theme.default.min.css" />
    <!--DataTables --->

    <!--fonts-->
    <link rel="stylesheet" href="lib/fonts/css/all.min.css" />
    <!--css-->
    <link rel="stylesheet" href="styles/css/global.css" />
    <link rel="stylesheet" href="styles/css/index.css" />
    <link rel="stylesheet" href="lib/css/jquery.dataTables.min.css" />
</head>

<style>
.logo img {
    width: 60%
}

.link {
    width: 50%
}

@media (min-width: 0px) and (max-width: 575px) {
    .logo img {
        width: 100%
    }

    #postTable {
        width: 1000px !important;
    }

    .link {
        width: 70%
    }
}
</style>

<body>
    <div style="background-color: #fafafa" class="min-h-screen">
        <div class="container">
            <div class="header flex justify-between items-center py-2">
                <a href="index.php" class=' link'>
                    <div class="logo">
                        <img src="assets/images/logo.png" alt="" width="15px" />
                    </div>
                </a>
                <div class="flex   space-x-4 items-center">
                    <div class="flex items-center space-x-2">
                        <i class="fa fa-user-md"></i>
                        <h2 class="text-xl mb-1 font-semibold"><?php echo $name ?></h2>
                    </div>
                    <a href="barroll.php?bar=<?php echo $bar ?>">

                        <img src="assets/images/back-arrow.png" alt="" width="25px" />


                    </a>
                </div>
            </div>
            <div class="row flex justify-center">
                <div class="col-md-12 col-lg-12 col-xl-12 " style="padding: 0% 2%">
                    <div
                        class="p-3 mb-2 flex flex-wrap space-y-3 bg-white items-center justify-between shadow-md rounded-lg">
                        <div class="flex items-center space-x-2">
                            <img src="assets/images/beer2.png" alt="" width="40px" />
                            <h3 class="font-semibold text-xl uppercase">Beers</h3>
                        </div>
                        <div>
                            <input type="hidden" id='current_date' value='<?php echo $date; ?>'>

                            <?php  
                        if(isset($_GET['status']) && isset($_GET['date'])){
                            $getDate = $_GET['date'];
                            $cur = date('y-m-d');
                            $difference = strtotime( $getDate ) - strtotime( $cur );
                          
                            if($difference != 0){
                                echo "<button class='btn btn-secondary font-bold text-sm uppercase' onclick='refreshdata()'>Refresh
                                <i class='fa fa-refresh'></i></button>";
                            }else{
                                echo "<button class='btn btn-secondary font-bold text-sm uppercase' onclick='savedata()'>Save
                                Data <i class='fa fa-save'></i></button>";
                            }
                          }else{
                            echo "<button class='btn btn-secondary font-bold text-sm uppercase' onclick='savedata()'>Save
                                Data <i class='fa fa-save'></i></button>";
                          }
                          ?>
                            <button class='btn btn-warning font-bold text-sm uppercase' data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Fetch Data <i class="fa fa-cloud-download"></i></button>
                            <!-- Button trigger modal -->

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Fetch previous data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="date" class='form-control' id='date_input'>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"
                                                onclick='fetchdata()'>Fetch</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="px-2 py-3 shadow-md bg-white rounded-lg border-2 border-green-100" id='msg'>
                        <h2 class=' pb-3 text-md font-bold'>Data recorded on <?php echo $formated_date; ?></h2>
                        <div style='overflow:scroll'>
                            <form action="" id='post-form' onsubmit='return false'>
                                <table class="table table-hover border" id="postTable">
                                    <thead class="" style="border: 1px solid gray !important">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Product</th>
                                            <th scope="col" class='hidden'>Price per can($)</th>
                                            <th scope="col">Q/B</th>
                                            <th scope="col">Q/A</th>
                                            <th scope="col" class='hidden'>Price($)</th>
                                            <th scope="col" class='hidden'>Gross Sale($)</th>
                                            <th scope="col" class='hidden'>Cog Used($)</th>
                                            <th scope="col" class='hidden'>Profit($)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($posts as $key=>$post): ?>
                                        <tr>
                                            <th scope="row"><?php echo $key + 1  ?></th>
                                            <td><input type="text" readonly class='form-control font-semibold' value='<?php if(isset($_GET['status'])) {
                                                echo $post['Product'];
                                              }else{
                                                    echo $post['Product'];
                                                }  ?>' id='product' name='product[]'>
                                            </td>
                                            <td class="hidden">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Price_per_can'];
                                              }else{
                                                    echo $post['Price_per_can'];
                                                }  ?>' placeholder="$2" readonly id='Price_per_can'
                                                    name='price_per_can[]' />
                                            </td>
                                            <td class="">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Quantity_Before'];
                                              }else{
                                                    echo '0';
                                                }  ?>' placeholder="Bottles sold" onblur="calculateQuantityblur(event)"
                                                    onkeypress="calculateQuantity(event)" id='Quantity_Before'
                                                    name='Quantity_Before[]' />
                                            </td>
                                            <td class="">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Quantity_After'];
                                              }else{
                                                    echo '0';
                                                }  ?>' placeholder="Bottles sold" onblur="calculateQuantityblur(event)"
                                                    onkeypress="calculateQuantity(event)" id='Quantity_After'
                                                    name='Quantity_After[]' />
                                            </td>

                                            <td class="hidden">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Price_of_drink'];
                                              }else{
                                                echo $post['Price_of_drink'];
                                                }  ?>' placeholder="$6.8" readonly id='price_of_drink'
                                                    name='price_of_drink[]' />
                                            </td>

                                            <td class="hidden">
                                                <input type="number" class="form-control" name="gross_sale[]"
                                                    class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Gross_sale'];
                                              }else{
                                                echo '0';
                                                }  ?>' readonly id='gross_sale' />
                                            </td>
                                            <td class="hidden">
                                                <input type="number" name="cog_used[]" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Cog_used'];
                                              }else{
                                                echo '0';
                                                }  ?>' readonly id='cog_used' />
                                            </td>
                                            <td class="hidden">
                                                <input type="number" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Profit'];
                                              }else{
                                                echo '0';
                                                }  ?>' name="total[]" class="form-control  total_input" readonly
                                                    id='total_profit' />
                                            </td>
                                            <td class='hidden'>
                                                <input type="number" value='<?php if(isset($_GET['status'])) {
                                                echo $post['id'];
                                              }else{
                                                echo '0';
                                                }  ?>' name="id[]" class="form-control  " readonly id='' />
                                            </td>

                                        </tr>

                                        <?php endforeach; ?>
                                        <td colspan='6' class='font-bold hidden'></td>
                                        <td colspan='' class='font-bold hidden aliign-right'>Total Profit ($):</td>
                                        <td colspan='' class='font-bold hidden aliign-right flex border'>
                                            $<div id='TotalValue' class='  w-100'>
                                                <?php if(isset($_GET['status'])){ echo $total_profit['Total_profit']; }else{ echo '0';}?>
                                            </div>
                                        </td>
                                        <input type="hidden" value='<?php echo $barId ?>' name="" class="form-control  "
                                            readonly id='barId' />
                                        <input type="hidden" value='<?php echo $bar ?>' name="" class="form-control  "
                                            readonly id='bar' />
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php') ?>
    <script src="styles/js/beers.js"></script>

    <script>
    jQuery(document).ready(function($) {
        $("#postTable").DataTable({
            scrollX: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "E.g. Don Julio",
            },
        });
    });

    function calculateQuantity(event) {
        if (event.keyCode === 13) {
            calculateTotal(event);
            calculateProfit(event);
            calculateTotalProfit(event);
            calculateTotalProfit()
        }
    }

    function calculateQuantityblur(event) {
        calculateTotal(event);
        calculateProfit(event);
        calculateTotalProfit(event);
        calculateTotalProfit()
    }

    function calculateTotal(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        var pricePerCan = tr.getElementsByTagName("input")[1].value;
        var priceOfDrink = tr.getElementsByTagName("input")[4].value;
        var totalDrinks = (tr.getElementsByTagName("input")[2].value - tr.getElementsByTagName("input")[3].value);

        var grossSale = tr.getElementsByTagName("input")[5];
        var cogUsed = tr.getElementsByTagName("input")[6];
        grossSale.value = totalDrinks * priceOfDrink;
        cogUsed.value = totalDrinks * pricePerCan;
    }

    function calculateProfit(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;

        var grossSale = parseFloat(tr.getElementsByTagName("input")[5].value);
        var cogUsed = parseFloat(tr.getElementsByTagName("input")[6].value);

        tr.getElementsByTagName("input")[7].value = (grossSale - cogUsed).toFixed(2);
    }

    function calculateTotalProfit(event) {

        const inputs = document.querySelectorAll('.total_input');
        let sum = 0;

        for (let i = 0; i < inputs.length; i++) {
            sum += parseFloat(inputs[i].value);
        }


        document.getElementById("TotalValue").innerHTML = sum.toFixed(2);


    }



    function savedata() {
        var currentTime = $('#current_date').val();
        Swal.fire({
            title: 'Do you want to save this data?',
            showCancelButton: true,
            confirmButtonText: 'Save',

        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                var tableData = [];
                var totalProfit = $('#TotalValue').text();
                var barId = $('#barId').val()
                var bar = $('#bar').val()


                $("#postTable tr").each(function(rowIndex, r) {
                    var cols = [];
                    $(this).find("td").each(function(colIndex, c) {
                        cols.push($(c).find("input").val());
                    });
                    tableData.push(cols);
                });
                $.ajax({
                    type: 'post',
                    url: 'admin/ajax_controls/saveData.php',
                    data: {
                        table_data: tableData,
                        totalProfit,
                        barId,
                        bar
                    },
                    success: function(response) {
                        // console.log(response)
                        if (response.includes('success')) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Congratulations',
                                text: 'This Data has been Saved Successfully',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then(function() {
                                window.location =
                                    `beers.php?bar=${bar}&status=saved&date=${currentTime}`;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong...',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                        }
                    }
                });
            }
        })
    }


    function fetchdata() {
        var date_input = $('#date_input').val();

        if (date_input != "") {
            var bar = $('#bar').val()
            window.location =
                `beers.php?bar=${bar}&status=saved&date=${date_input}`;

        } else {
            $("#date_input").removeClass('form-control').addClass('form-control is-invalid');
        }
    }

    function refreshdata() {
        var bar = $('#bar').val()
        window.location =
            `beers.php?bar=${bar}`;
    }
    </script>

</body>

</html>