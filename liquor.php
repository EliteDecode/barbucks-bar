<?php 
session_start();
require('admin/includes/database/db_controllers.php');
$barId = $_SESSION['users'];
 
$row = selectOne('users', ['BarId' => $barId]);

$name = $row['Lastname'];

$value = 26;
$posts;
$total_profit;

$date = date('y-m-d');
$formated_date;
$bar;
$measurement;

if(isset($_GET['measurement'])){
    $measurement = $_GET['measurement'];
}

if(isset($_GET['bar'])){
    $bar = $_GET['bar'];
}


if(isset($_GET['status']) && isset($_GET['date'])){
    $status = $_GET['status'];
    $date = $_GET['date'];
    $bar = $_GET['bar'];
    if($status == 'saved'){
        $posts = selectAll('saved_data_liquor', ['DateReg' => $date, 'BarID' => $barId, "Bar" => $bar ]);
        $total_profit = selectOne('saved_data_liquor', ['DateReg' => $date, 'BarID' => $barId]);
        $formated_date = date("F jS, Y", strtotime($date));
    }
}else{
    $posts = selectAll('inventory' , ['Category' => 'Liquor']);
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
    <div style="background-color: #fafafa; overflow-x: hidden" class="min-h-screen">
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
                            <img src="assets/images/liquor.png" alt="" width="40px" />
                            <h3 class="font-semibold text-xl uppercase">Liquor</h3>
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
                        <div class="flex flex-wrap space-y-2 justify-between items-center">
                            <h2 class='pb-3 text-md font-bold'>Data recorded on <?php echo $formated_date; ?></h2>
                            <div class='flex space-x-2 items-center mb-3'>
                                <h2 class='font-semibold'>Change measurement to :</h2>
                                <?php  if(isset($_GET['measurement'])){
                                     
                                      $measurement = $_GET['measurement'];
                                      if($measurement == 'ounce'){
                                         echo "<button class='btn font-bold btn-info text-sm' onclick='changeMeasurement(event)' id='grams'>Grams (g)</button>";
                                      }else{
                                         echo "<button class='btn font-bold font-bold btn-info text-sm' onclick='changeMeasurement(event)' id='ounce'>Ounce</button>";
                                      }
                                } ?>

                            </div>

                        </div>
                        <div style='overflow:scroll'>

                            <form action="" id='post-form' onsubmit='return false'>
                                <table class="table table-hover border table-responsive" id="postTable" width="100%">
                                    <thead class="" style="border: 1px solid gray !important">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Product</th>
                                            <th scope="col" class='hidden'>Price per can($)</th>
                                            <th scope="col">Empty Bottles</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Q/B</th>
                                            <th scope="col">Q/A</th>
                                            <th scope="col" class='hidden'>Total Q/S</th>
                                            <th scope="col" class='hidden'>Price($)</th>
                                            <th scope="col" class='hidden'>Gross Sale($)</th>
                                            <th scope="col" class='hidden'>Cog Used($)</th>
                                            <th scope="col" class='hidden'>Profit($)</th>
                                            <th scope="col" class=''>Q/L</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($posts as $key=>$post): ?>
                                        <tr>
                                            <td><?php echo $key+1 ?></td>
                                            <td><input type="text" class="form-control" value='<?php if(isset($_GET['status'])) {
                                            echo $post['Product'];
                                                  }else{
                                                        echo $post['Product'];
                                                    }  ?>' readonly name='product[]'></td>
                                            <td class="hidden">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Price_per_can'];
                                                  }else{
                                                        echo $post['Price_per_can'];
                                                    }  ?>' placeholder="$2" readonly name='price_per_can[]' />
                                            </td>
                                            <td class="">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                    echo $post['Bottles_sold'];
                                                  }else{
                                                        echo '0';
                                                    }  ?>' placeholder="Bottles sold"
                                                    onblur="calculateBottlesSoldK(event)" name='bottles_sold[]' />
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                    echo $post['Category'];
                                                  }else{
                                                    echo $post['Type'];
                                                    }  ?>' placeholder="Category" name='category[]' readonly />

                                            </td>
                                            <td class="">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                    echo $post['Quantity_before'];
                                                  }else{
                                                        echo '0';
                                                    }  ?>' placeholder="Quantity before"
                                                    onblur="calculateQuantityBeforeK(event)" name='quantity_before[]' />
                                            </td>
                                            <td class="">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                    echo $post['Quantity_after'];
                                                  }else{
                                                        echo '0';
                                                    }  ?>' placeholder="Quantity after"
                                                    onblur="calculateQuantityAfterK(event)" name='quantity_after[]' />
                                            </td>
                                            <td class="hidden">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                    echo $post['Total_quantity'];
                                                  }else{
                                                        echo '0';
                                                    }  ?>' placeholder="Total quantity sold"
                                                    onchange="calculateTotal(event)" readonly name='totalq_sold[]' />
                                            </td>
                                            <td class="hidden">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                    echo $post['Price_of_drink'];
                                                  }else{
                                                        echo $post['Price_of_drink'];
                                                    }  ?>' placeholder="$6.8" readonly name='price_of_drink[]' />
                                            </td>

                                            <td class='hidden'>
                                                <input type="number" class="form-control" name="gross_sale[]"
                                                    class="form-control" oninput="" readonly value='<?php if(isset($_GET['status'])) {
                                                    echo $post['Gross_sale'];
                                                  }else{
                                                        echo '0';
                                                    }  ?>' />
                                            </td>
                                            <td class='hidden'>
                                                <input type="number" name="cog_used[]" class="form-control" readonly
                                                    value='<?php if(isset($_GET['status'])) {
                                                    echo $post['Cog_used'];
                                                  }else{
                                                        echo '0';
                                                    }  ?>' />
                                            </td>
                                            <td class='hidden'>
                                                <input type="number" name="total[]" class="form-control total_input"
                                                    readonly value='<?php if(isset($_GET['status'])) {
                                                    echo $post['Profit'];
                                                  }else{
                                                        echo '0';
                                                    }  ?>' />
                                            </td>
                                            <td class='hidden'>
                                                <input type="number" value='<?php if(isset($_GET['status'])) {
                                                    echo $post['id'];
                                                  }else{
                                                    echo '0';
                                                    }  ?>' name="id[]" class="form-control  total_input" readonly
                                                    id='total_profit' />
                                            </td>
                                            <td class="">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                    echo $post['Quantity_last_bottle'];
                                                  }else{
                                                        echo '0';
                                                    }  ?>' placeholder="" name='quantity_last_bottle[]' />
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>

                                        <td colspan='9' class='font-bold hidden'></td>
                                        <td colspan='' class='font-bold aliign-right hidden'>Total ($):</td>
                                        <td colspan='' class='font-bold aliign-right flex border hidden'>
                                            $<div id='TotalValue' class='  w-100'>
                                                <?php if(isset($_GET['status'])){ echo $total_profit['Total_profit']; }else{ echo '0';}?>
                                            </div>

                                        </td>
                                        <input type="hidden" value='<?php echo $barId ?>' name="" class="form-control  "
                                            readonly id='barId' />
                                        <input type="hidden" value='<?php echo $bar ?>' name="" class="form-control  "
                                            readonly id='bar' />
                                        <input type="hidden" value='<?php echo $measurement ?>' name=""
                                            class="form-control  " readonly id='measurement' />
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
    <script src="styles/js/liquor.js"></script>

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
    var measurement = $('#measurement').val()



    function calculateQuantityBeforeK(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        var quantitybefore = tr.getElementsByTagName("input")[4].value;
        var category = tr.getElementsByTagName("input")[3].value;

        changeValueBefore(quantitybefore, event)

    }

    function changeValueBefore(value, event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        tr.getElementsByTagName("input")[4].value = value;
        sumTotalBottles(event);
        calculateTotal(event);
        calculateProfit(event);
        calculateTotalProfit(event)
    }



    function calculateQuantityAfterK(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        var quantityAfter = tr.getElementsByTagName("input")[5].value;
        var category = tr.getElementsByTagName("input")[3].value;
        changeValueAfter(quantityAfter, event);

        // if (measurement == 'grams') {
        //     changeValueAfter(quantityAfter, event);
        // } else {
        //     quantityAfter = quantityAfter / category;
        //     changeValueAfter(quantityAfter, event);
        // }
    }


    function changeValueAfter(value, event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        tr.getElementsByTagName("input")[5].value = value;

        sumTotalBottles(event);
        calculateTotal(event);
        calculateProfit(event);
        calculateTotalProfit(event)
    }





    function calculateBottlesSoldK(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;

        var bottlesSold = tr.getElementsByTagName("input")[2].value;

        if (measurement == 'grams') {
            changeBottlesSold(bottlesSold, event);
        } else {

            changeBottlesSold(bottlesSold, event);
        }
    }

    function changeBottlesSold(value, event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        tr.getElementsByTagName("input")[2].value = value;

        sumTotalBottles(event);
        calculateTotal(event);
        calculateProfit(event);
        calculateTotalProfit(event);

    }


    //Calculate total bottles

    function sumTotalBottles(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        var category = tr.getElementsByTagName("input")[3].value;
        var bottlesBefore = parseFloat(tr.getElementsByTagName("input")[2].value);
        if (measurement == 'grams') {
            var quantityBefore = parseFloat((tr.getElementsByTagName("input")[4].value / 28) / category);
            var quantitiesAfter = parseFloat((tr.getElementsByTagName("input")[5].value / 28) / category);
            tr.getElementsByTagName("input")[6].value = (bottlesBefore + (quantityBefore - quantitiesAfter));
        } else {

            var quantityBefore = parseFloat(tr.getElementsByTagName("input")[4].value / category);
            var quantitiesAfter = parseFloat(tr.getElementsByTagName("input")[5].value / category);
            tr.getElementsByTagName("input")[6].value = (bottlesBefore + (quantityBefore - quantitiesAfter));
        }
    }

    function calculateTotal(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        var pricePerCan = tr.getElementsByTagName("input")[1].value;
        var priceOfDrink = tr.getElementsByTagName("input")[7].value;
        var totalDrinks = tr.getElementsByTagName("input")[6].value;
        var category = tr.getElementsByTagName("input")[3].value;

        var grossSale = tr.getElementsByTagName("input")[8];
        var cogUsed = tr.getElementsByTagName("input")[9];

        if (measurement == 'grams') {
            grossSale.value = ((totalDrinks / 28) / category) * priceOfDrink;
            cogUsed.value = ((totalDrinks / 28) / category) * pricePerCan;


        } else {
            grossSale.value = (totalDrinks / category) * priceOfDrink;
            cogUsed.value = (totalDrinks / category) * pricePerCan;

        }

    }

    function calculateProfit(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;

        var grossSale = parseFloat(tr.getElementsByTagName("input")[8].value);
        var cogUsed = parseFloat(tr.getElementsByTagName("input")[9].value);

        console.log(grossSale)
        console.log(cogUsed)

        tr.getElementsByTagName("input")[10].value = parseFloat((grossSale - cogUsed)).toFixed(2);
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
                var measurement = $('#measurement').val()



                $("#postTable tr").each(function(rowIndex, r) {
                    var cols = [];
                    $(this).find("td").each(function(colIndex, c) {
                        cols.push($(c).find("input", "select").val());

                    });
                    tableData.push(cols);
                });
                $.ajax({
                    type: 'post',
                    url: 'admin/ajax_controls/saveDataLiquor.php',
                    data: {
                        table_data: tableData,
                        totalProfit,
                        barId,
                        bar,
                        measurement
                    },
                    success: function(response) {
                        // $('#msg').html(response);
                        console.log(response)
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
                                    `liquor.php?bar=${bar}&status=saved&date=${currentTime}&measurement=${measurement}`;
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
            var measurement = $('#measurement').val()
            window.location = `liquor.php?measurement=${measurement}&bar=${bar}&status=saved&date=${date_input}`;
        } else {
            $("#date_input").removeClass('form-control').addClass('form-control is-invalid');
        }

    }

    function changeMeasurement(event) {
        const value = event.target.id
        var bar = $('#bar').val()
        if (value == 'ounce') {
            window.location = `liquor.php?bar=${bar}&measurement=ounce`;
        } else {
            window.location = `liquor.php?bar=${bar}&measurement=grams`;
        }
    }

    function refreshdata() {
        var measurement = $('#measurement').val()
        var bar = $('#bar').val()
        window.location = `liquor.php?bar=${bar}&measurement=${measurement}`;
    }
    </script>

</body>

</html>