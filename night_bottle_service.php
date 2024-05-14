<?php 
session_start();
require('admin/includes/database/db_controllers.php');
$barId = $_SESSION['users'];
$posts;
$total_profit;

$barId = $_SESSION['users'];
 
$row = selectOne('users', ['BarId' => $barId]);

$name = $row['Lastname'];


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
        $posts = selectAll('night_bottle_service', ['DateReg' => $date, 'BarID' => $barId, 'Bar' => $bar ]);
        $total_profit = selectOne('night_bottle_service', ['DateReg' => $date]);
        $formated_date = date("F jS, Y", strtotime($date));
    }
}else{
    $posts = selectAll2('inventory');
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
.hidden {
    display: none;
}

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
        <div id="msg"></div>
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
                    <a href="bottle_service.php?bar=<?php echo $bar ?>">

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
                            <h3 class="font-semibold text-xl uppercase">Pre-sale Bottles</h3>
                        </div>
                        <div>

                            <input type="hidden" id='current_date' value='<?php echo $date; ?>'>

                            <?php if(isset($_SESSION['users'])): ?>

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
                            <?php else: ?>
                            <button type='button' class='btn btn-secondary font-bold text-sm uppercase'
                                data-bs-toggle="modal" data-bs-target="#exampleModal">Save
                                Data <i class='fa fa-save'></i></button>
                            <?php endif; ?>

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
                        <h2 class='pb-3 text-md font-bold'>Data recorded on <?php echo $formated_date; ?></h2>
                        <div style='overflow:scroll'>
                            <form action="" id='post-form' onsubmit='return false'>
                                <table class="table table-hover border" id="postTable" width="100%">
                                    <thead class="" style="border: 1px solid gray !important">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Category</th>
                                            <th scope="col" class='hidden'>Price of drink($)</th>
                                            <th scope="col">Bottles sold(default)</th>
                                            <th scope="col">Bottles sold(deal)</th>
                                            <th scope="col">Price of deal</th>
                                            <th scope="col" class='hidden'>Total Amount</th>
                                            <th scope="col" class='hidden'>Profit Company</th>
                                            <th scope="col" class='hidden'>Profit Attendant</th>
                                            <th class='hidden'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($posts as $key=>$post): ?>
                                        <tr>
                                            <th scope="row"><?php echo $key + 1  ?></th>
                                            <td class='hidden'></td>
                                            <td><input type="text" readonly class='form-control font-semibold' value='<?php if(isset($_GET['status'])) {
                                                echo $post['Product'];
                                              }else{
                                                    echo $post['Product'];
                                                }  ?>' id='product' name='product[]'>
                                            </td>
                                            <td><input type="text" readonly class='form-control font-semibold' value='<?php if(isset($_GET['status'])) {
                                                echo $post['Type'];
                                              }else{
                                                    echo $post['Type'];
                                                }  ?>' id='Type' name='Type[]'>
                                            </td>
                                            <td class="hidden">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Price_of_drink'];
                                              }else{
                                                echo $post['Price_of_drink'];
                                                }  ?>' readonly id='price_of_drink' name='price_of_drink[]' />
                                            </td>
                                            <td class="">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Bottles_sold'];
                                              }else{
                                                    echo '0';
                                                }  ?>' placeholder="Bottles sold" onblur="calculateQuantityblur(event)"
                                                    onkeypress="calculateQuantity(event)" id='Bottles_sold'
                                                    name='bottles_sold[]' />
                                            </td>
                                            <td class="">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Bottles_sold_deal'];
                                              }else{
                                                    echo '0';
                                                }  ?>' placeholder="Bottles sold" onblur="calculateQuantityblur(event)"
                                                    onkeypress="calculateQuantity(event)" id='Bottles_sold_default'
                                                    name='bottles_sold_deal[]' />
                                            </td>
                                            <td class="">
                                                <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Price_of_drink_deal'];
                                              }else{
                                                    echo '0';
                                                }  ?>' placeholder="Bottles sold" onblur="calculateQuantityblur(event)"
                                                    onkeypress="calculateQuantity(event)" id='Price_of_drink_deal'
                                                    name='Price_of_drink_deal[]' />
                                            </td>



                                            <td class="hidden">
                                                <input type="number" name="Total_amount[]"
                                                    class="form-control total_input" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Total_profit'];
                                              }else{
                                                echo '0';
                                                }  ?>' readonly id='Total_amount' />
                                            </td>
                                            <td class="hidden">
                                                <input type="number" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Profit_company'];
                                              }else{
                                                echo '0';
                                                }  ?>' name="Profit_company[]" class="form-control total_company  "
                                                    readonly id='Profit_company' />
                                            </td>
                                            <td class="hidden">
                                                <input type="number" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Profit_attendant'];
                                              }else{
                                                echo '0';
                                                }  ?>' name="Profit_attendant[]" class="form-control  total_attendant "
                                                    readonly id='Profit_attendant' />
                                            </td>
                                            <td class='hidden'>
                                                <input type="number" value='<?php if(isset($_GET['status'])) {
                                                echo $post['id'];
                                              }else{
                                                echo '0';
                                                }  ?>' name="id[]" class="form-control  " readonly id='' />
                                            </td>
                                            <td>

                                                <button class="btn btn-info" onclick='addRow(this)'><i
                                                        class="fa fa-plus"></i></button>
                                            </td>

                                        </tr>

                                        <?php endforeach; ?>
                                        <td colspan='2' class='font-bold '></td>
                                        <td class='hidden' class='font-bold  aliign-right'>Total Profit:</td>
                                        <td class='hidden' class='font-bold  aliign-right flex border'>
                                            $<div id='TotalValue' class='  w-100'>
                                                <?php if(isset($_GET['status'])){ echo $total_profit['Total_profit']; }else{ echo '0';}?>
                                            </div>
                                        </td>
                                        <td class='hidden' class='font-bold  border aliign-right'>
                                            <div id='TotalValueC ' class='  w-100'>
                                                <?php if(isset($_GET['status'])){ echo $total_profit['Total_profit']; }else{ echo '0';}?>
                                            </div>
                                        </td>

                                        <td class='hidden' class='font-bold  border aliign-right'>
                                            <div id='TotalValueA ' class='  w-100'>
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
        calculateTotalProfit(event);
        calculateTotalProfit()
    }

    function calculateTotal(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        var priceOfDrink = tr.getElementsByTagName("input")[2].value;
        var totalDrinks = tr.getElementsByTagName("input")[3].value;

        var priceOfDrink_deal = tr.getElementsByTagName("input")[5].value;
        var totalDrinks_deal = tr.getElementsByTagName("input")[4].value;

        tr.getElementsByTagName("input")[6].value = (priceOfDrink * totalDrinks) + (priceOfDrink_deal *
            totalDrinks_deal)
        tr.getElementsByTagName("input")[7].value = ((priceOfDrink * totalDrinks) + (priceOfDrink_deal *
            totalDrinks_deal)) * 0.13
        tr.getElementsByTagName("input")[8].value = ((priceOfDrink * totalDrinks) + (priceOfDrink_deal *
            totalDrinks_deal)) * 0.87

    }

    function addRow(button) {
        var table = document.querySelector('.table');
        var rows = table.rows;

        // Define a CSS class with the "display" property set to "none"

        // Insert the cells and add the "hidden" class to the corresponding cells
        var table = button.closest("table"); // find the closest table element
        var rowIndex = button.closest("tr").rowIndex; // get the index of the current row
        var newRow = table.insertRow(rowIndex + 1); // insert a new row after the current row
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
        cell4.classList.add("hidden");
        var cell5 = newRow.insertCell(4);
        var cell6 = newRow.insertCell(5);
        var cell7 = newRow.insertCell(6);
        var cell8 = newRow.insertCell(7);
        cell8.classList.add("hidden");
        var cell9 = newRow.insertCell(8);
        cell9.classList.add("hidden");
        var cell10 = newRow.insertCell(9);
        cell10.classList.add("hidden");
        var cell11 = newRow.insertCell(10);
        cell11.classList.add("hidden");

        var rowOriginal = table.rows[rowIndex]; // second row (index 1)
        var cells_original = rowOriginal.cells; // array of cells in the row

        var parentRow = button.parentNode.parentNode;





        // access the contents of the cells
        var serialNo = cells_original[0].textContent; // content of first cell
        // Get all the input elements in the parent row
        var product = parentRow.getElementsByTagName("input")[0].value;
        var type = parentRow.getElementsByTagName("input")[1].value;
        var price_of_drink = parentRow.getElementsByTagName("input")[2].value;
        var bottles_sold = parentRow.getElementsByTagName("input")[3].value;
        var bottles_sold_deal = parentRow.getElementsByTagName("input")[4].value;
        var price_bottles_sold_deal = parentRow.getElementsByTagName("input")[5].value;
        var total_amount = parentRow.getElementsByTagName('input')[6].value
        var profit_company = parentRow.getElementsByTagName("input")[7].value;
        var profit_attendant = parentRow.getElementsByTagName("input")[8].value;
        var id = parentRow.getElementsByTagName("input")[9].value;




        cell1.innerHTML = `<i class='fa fa-minus' ></i>`; // set the content of the th element
        cell2.innerHTML =
            `<input type="text" readonly class='form-control font-semibold' value='${product}' id='product' name='product[]'>`;
        cell3.innerHTML =
            `<input type="text" readonly class='form-control font-semibold' value='${type}' id='Type' name='Type[]'>`;
        cell4.innerHTML =
            `<input type="number" class="form-control" value='${price_of_drink}' readonly id='price_of_drink' name='price_of_drink[]' />`;
        cell5.innerHTML =
            ` <input type="number" class="form-control" value='0' placeholder="Bottles sold" onblur="calculateQuantityblur(event)"
                                                onkeypress="calculateQuantity(event)" id='Bottles_sold'
                                                name='bottles_sold[]' readonly/>`
        cell6.innerHTML = `<input type="number" class="form-control" value='${bottles_sold_deal}' placeholder="Bottles sold" onblur="calculateQuantityblur(event)"
                                                onkeypress="calculateQuantity(event)" id='Bottles_sold_default'
                                                name='bottles_sold_deal[]' />`;
        cell7.innerHTML = `<input type="number" class="form-control" value='${price_bottles_sold_deal}' placeholder="Bottles sold" onblur="calculateQuantityblur(event)"
                                                onkeypress="calculateQuantity(event)" id='Price_of_drink_deal'
                                                name='Price_of_drink_deal[]' />`;
        cell8.innerHTML = `<input type="number" name="Total_amount[]" class="form-control total_input"
                                                value='${total_amount}' readonly id='Total_amount' />`;
        cell9.innerHTML = `<input type="number" value='${profit_company}' name="Profit_company[]" class="form-control total_company  "
                                                readonly id='Profit_company' />`;
        cell10.innerHTML = `<input type="number" value='${profit_attendant}' name="Profit_attendant[]" class="form-control  total_attendant "
                                                readonly id='Profit_attendant' />`;

        cell11.innerHTML = `<input type="number" value='${id}' name="id[]" class="form-control  " readonly id='' />`




    }



    function calculateTotalProfit(event) {

        const inputs = document.querySelectorAll('.total_input');
        const company = document.querySelectorAll('.total_company');
        const attendants = document.querySelectorAll('.total_attendant');
        let sum = 0;
        let sumC = 0;
        let sumA = 0;

        for (let i = 0; i < inputs.length; i++) {
            sum += parseFloat(inputs[i].value);
        }

        for (let i = 0; i < company.length; i++) {
            sumC += parseFloat(company[i].value);
        }

        for (let i = 0; i < attendants.length; i++) {
            sumA += parseFloat(attendants[i].value);
        }



        document.getElementById("TotalValue").innerHTML = sum.toFixed(2);
        document.getElementById("TotalValueC").innerHTML = sumC.toFixed(2);
        document.getElementById("TotalValueA").innerHTML = sumA.toFixed(2);


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
                var totalProfitC = $('#TotalValueC').text();
                var totalProfitA = $('#TotalValueA').text();
                var barId = $('#barId').val()
                var bar = $('#bar').val()

                $("#postTable tr").each(function(rowIndex, r) {
                    var cols = [];
                    $(this).find("td").each(function(colIndex, c) {
                        if (colIndex !== 0 || rowIndex ===
                            0) { // skip first cell of all rows except the first
                            cols.push($(c).find("input").val());
                        }
                    });
                    if (cols.length > 0) { // check if any cells were added to the row
                        tableData.push(cols);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: 'admin/ajax_controls/saveData_presales.php',
                    data: {
                        table_data: tableData,
                        totalProfit,
                        totalProfitC,
                        totalProfitA,
                        barId,
                        bar

                    },
                    success: function(response) {
                        // $('#msg').html(response)
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
                                    `night_bottle_service.php?bar=${bar}&status=saved&date=${currentTime}`;
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
                `night_bottle_service.php?bar=${bar}&status=saved&date=${date_input}`;

        } else {
            $("#date_input").removeClass('form-control').addClass('form-control is-invalid');
        }
    }

    function refreshdata() {
        var bar = $('#bar').val()
        window.location =
            `night_bottle_service.php?bar=${bar}`;
    }
    </script>

</body>

</html>