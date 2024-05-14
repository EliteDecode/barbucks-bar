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
$status;

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
        $posts = selectAll('saved_data_shooters', ['DateReg' => $date, 'BarID' => $barId, "Bar" => $bar ]);
        $total_profit = selectOne('saved_data_shooters', ['DateReg' => $date, 'BarId' => $barId]);
        $formated_date = date("F jS, Y", strtotime($date));
    }
}else{
    $posts = selectAll('inventory');
    $formated_date = date("F jS, Y", strtotime($date));
}


$inventory = selectAll('inventory', ['Category' => 'Liquor']);

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
                    <a href="shooters_bar.php?bar=<?php echo $bar ?>">

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
                        <div class="flex flex-wrap justify-between items-center">
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
                        <div style='overflow: scroll'>
                            <form action="" id='post-form' onsubmit='return false'>
                                <table class="table table-hover border" id="postTable" width="100%">
                                    <thead class="" style="border: 1px solid gray !important">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Product 1</th>
                                            <th scope="col">Product 2</th>
                                            <th scope="col">Product 3</th>
                                            <th scope="col" class='hidden'>Total Q/U</th>
                                            <th scope="col" class=''>Tube Type</th>
                                            <th scope="col" class='hidden'>Test Tubes</th>
                                            <th scope="col" class='hidden'>Price</th>
                                            <th scope="col" class='hidden'>Profit($)</th>
                                            <th scope="col" class='hidden'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if(isset($_GET['status'])): ?>
                                        <input value='<?php  echo $status; ?>' id='status' hidden>
                                        <?php foreach($posts as $key=> $post): ?>
                                        <tr>
                                            <td>Tray <?php echo $key+1 ?></td>
                                            <td class='space-y-2'>
                                                <select name="product[]" class='form-control product-select'
                                                    onchange='fetchCategory(this)'>
                                                    <option selected value="<?php echo $post['P1_Product']; ?>">
                                                        <?php echo $post['P1_Product']; ?>
                                                    </option>
                                                    <?php foreach($inventory as $invt): ?>
                                                    <option value="<?php echo $invt['Product'] ?>"
                                                        id="<?php echo $invt['id'] ?>">
                                                        <?php echo $invt['Product'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <select name="category[]" class='form-control category-select'>
                                                    <option
                                                        value="<?php  if($post['P1_Category'] == '26'){echo '26';}else if($post['P1_Category'] == '40'){echo '40';}  ?>">
                                                        <?php if($post['P1_Category'] == '26'){echo '26';}else if($post['P1_Category'] == '40'){echo '40';} ?>
                                                    </option>
                                                </select>
                                                <div class='flex items-center space-between space-x-2 quantity-calc'>
                                                    <span class='font-bold'>Q/B</span> <input type="number"
                                                        class="form-control" placeholder="0"
                                                        value='<?php echo $post['P1_Quantity_Before'] ?>'
                                                        name='quantity_before[]'
                                                        onblur='calculateQuantityUsedRow(event)' />
                                                    <span class='font-bold'>Q/A</span> <input type="number"
                                                        class="form-control" placeholder="0"
                                                        value='<?php echo $post['P1_Quantity_After'] ?>'
                                                        name='quantity_after[]'
                                                        onblur='calculateQuantityUsedRow(event)' />
                                                </div>
                                                <input type="number" class="form-control hidden" placeholder="0"
                                                    value='<?php echo $post['P1_Quantity']; ?>' name='quantity_used[]'
                                                    onblur='calculateQuantityUsed(event)' />

                                            </td>
                                            <td class='space-y-2'>
                                                <select name="product[]" class='form-control product-select'
                                                    onchange='fetchCategory(this)'>
                                                    <option selected value="<?php echo $post['P2_Product']; ?>">
                                                        <?php echo $post['P2_Product']; ?>
                                                    </option>
                                                    <?php foreach($inventory as $invt): ?>
                                                    <option value="<?php echo $invt['Product'] ?>"
                                                        id="<?php echo $invt['id'] ?>">
                                                        <?php echo $invt['Product'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <select name="category[]" class='form-control category-select'>
                                                    <option
                                                        value="<?php  if($post['P2_Category'] == '26'){echo '26';}else if($post['P2_Category'] == '40'){echo '40';}  ?>">
                                                        <?php if($post['P2_Category'] == '26'){echo '26';}else if($post['P2_Category'] == '40'){echo '40';} ?>
                                                    </option>
                                                </select>
                                                <div class='flex items-center space-between space-x-2 quantity-calc'>
                                                    <span class='font-bold'>Q/B</span> <input type="number"
                                                        class="form-control" placeholder="0"
                                                        value='<?php echo $post['P2_Quantity_Before'] ?>'
                                                        name='quantity_before[]'
                                                        onblur='calculateQuantityUsedRow(event)' />
                                                    <span class='font-bold'>Q/A</span> <input type="number"
                                                        class="form-control" placeholder="0"
                                                        value='<?php echo $post['P2_Quantity_After'] ?>'
                                                        name='quantity_after[]'
                                                        onblur='calculateQuantityUsedRow(event)' />
                                                </div>
                                                <input type="number" class="form-control hidden" placeholder="0"
                                                    value='<?php echo $post['P2_Quantity']; ?>' name='quantity_used[]'
                                                    onblur='calculateQuantityUsed(event)' />

                                            </td>
                                            <td class='space-y-2'>
                                                <select name="product[]" class='form-control product-select'
                                                    onchange='fetchCategory(this)'>
                                                    <option selected value="<?php echo $post['P3_Product']; ?>">
                                                        <?php echo $post['P3_Product']; ?>
                                                    </option>
                                                    <?php foreach($inventory as $invt): ?>
                                                    <option value="<?php echo $invt['Product'] ?>"
                                                        id="<?php echo $invt['id'] ?>">
                                                        <?php echo $invt['Product'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <select name="category[]" class='form-control category-select'>
                                                    <option
                                                        value="<?php  if($post['P3_Category'] == '26'){echo '26';}else if($post['P3_Category'] == '40'){echo '40';}  ?>">
                                                        <?php if($post['P3_Category'] == '26'){echo '26';}else if($post['P3_Category'] == '40'){echo '40';} ?>
                                                    </option>
                                                </select>
                                                <div class='flex items-center space-between space-x-2 quantity-calc'>
                                                    <span class='font-bold'>Q/B</span> <input type="number"
                                                        class="form-control" placeholder="0"
                                                        value='<?php echo $post['P3_Quantity_Before'] ?>'
                                                        name='quantity_before[]'
                                                        onblur='calculateQuantityUsedRow(event)' />
                                                    <span class='font-bold'>Q/A</span> <input type="number"
                                                        class="form-control" placeholder="0"
                                                        value='<?php echo $post['P3_Quantity_After'] ?>'
                                                        name='quantity_after[]'
                                                        onblur='calculateQuantityUsedRow(event)' />
                                                </div>
                                                <input type="number" class="form-control hidden" placeholder=""
                                                    value='<?php echo $post['P3_Quantity']; ?>' name='quantity_used[]'
                                                    onblur='calculateQuantityUsed(event)' />

                                            </td>


                                            <td class="hidden">
                                                <input type="number" class="form-control" placeholder="0" readonly
                                                    name='totalq_sold[]'
                                                    value='<?php echo $post['Total_Quantity']; ?>' />
                                            </td>
                                            <td class="">
                                                <select name="tubeType[]" id="tubeType" class='form-control'
                                                    onchange='calculateTestTubes(event)'>
                                                    <option value="1" <?php  if($post['Tube_Type'] == '1'){
                                                    echo 'selected';
                                                } ?>>1 Ounce</option>
                                                    <option value="0.5" <?php  if($post['Tube_Type'] == '0.5'){
                                                    echo 'selected';
                                                } ?>>1/2 Ounce</option>
                                                    <option value="0.25" <?php  if($post['Tube_Type'] == '0.25'){
                                                    echo 'selected';
                                                } ?>>1/4 Ounce</option>

                                                </select>
                                            </td>

                                            <td class='hidden'>
                                                <input type="number" class="form-control" name="test_tubes[]"
                                                    class="form-control" oninput="" readonly
                                                    value='<?php echo $post['Total_Tubes'] ?>' />
                                            </td>
                                            <td class='hidden'>
                                                <input type="number" name="price[]" class="form-control" readonly
                                                    value='<?php echo $post['Tube_Price'] ?>' />
                                            </td>

                                            <td class='hidden'>
                                                <input type="number" name="total[]" class="form-control total_input"
                                                    readonly value='<?php echo $post['Profit'] ?>' />
                                            </td>
                                            <td class='hidden'>
                                                <input type="number" value='<?php echo $post['id'] ?>' name="id[]"
                                                    class="form-control total_input" readonly id='' />
                                            </td>
                                            <td>

                                                <button class="btn btn-info" onclick='addRow(this)'><i
                                                        class="fa fa-plus"></i></button>
                                            </td>

                                        </tr>

                                        <?php endforeach; ?>
                                        <?php else: ?>

                                        <tr>
                                            <td>Tray 1</td>
                                            <td class='space-y-2'>

                                                <select name="product[]" class='form-control product-select'
                                                    onchange='fetchCategory(this)'>
                                                    <option value='' selected>Products</option>
                                                    <?php foreach($inventory as $post): ?>
                                                    <option value="<?php echo $post['Product'] ?>"
                                                        id="<?php echo $post['id'] ?>">
                                                        <?php echo $post['Product'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <select name="category[]" class='form-control category-select'>
                                                    <option value="Null" selected>Size</option>
                                                </select>
                                                <div class='flex items-center space-between space-x-2 quantity-calc'>
                                                    <span class='font-bold'>Q/B</span> <input type="number"
                                                        class="form-control" placeholder="0" value='0'
                                                        name='quantity_before[]'
                                                        onblur='calculateQuantityUsedRow(event)' />
                                                    <span class='font-bold'>Q/A</span><input type="number"
                                                        class="form-control" placeholder="0" value='0'
                                                        name='quantity_after[]'
                                                        onblur='calculateQuantityUsedRow(event)' />
                                                </div>
                                                <input type="number" class="form-control hidden" placeholder="0"
                                                    value='0' name='quantity_used[]' readonly />

                                            </td>
                                            <td class='space-y-2'>


                                                <select name="product[]" class='form-control product-select'
                                                    onchange='fetchCategory(this)'>
                                                    <option value='' selected>Products</option>
                                                    <?php foreach($inventory as $post): ?>
                                                    <option value="<?php echo $post['Product'] ?>"
                                                        id="<?php echo $post['id'] ?>">
                                                        <?php echo $post['Product'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <select name="category[]" class='form-control category-select'>
                                                    <option value="Null" selected>Size</option>
                                                </select>
                                                <div class='flex items-center space-between space-x-2 quantity-calc'>
                                                    <span class='font-bold'>Q/B</span> <input type="number"
                                                        class="form-control" placeholder="0" value='0'
                                                        name='quantity_before[]'
                                                        onblur='calculateQuantityUsedRow(event)' />
                                                    <span class='font-bold'>Q/A</span> <input type="number"
                                                        class="form-control" placeholder="0" value='0'
                                                        name='quantity_after[]'
                                                        onblur='calculateQuantityUsedRow(event)' />
                                                </div>
                                                <input type="number" class="form-control hidden" placeholder="0"
                                                    value='0' name='quantity_used[]' readonly />


                                            </td>
                                            <td class='space-y-2'>


                                                <select name="product[]" class='form-control product-select'
                                                    onchange='fetchCategory(this)'>
                                                    <option value='' selected>Products</option>
                                                    <?php foreach($inventory as $post): ?>
                                                    <option value="<?php echo $post['Product'] ?>"
                                                        id="<?php echo $post['id'] ?>">
                                                        <?php echo $post['Product'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <select name="category[]" class='form-control category-select'>
                                                    <option value="Null" selected>Size</option>
                                                </select>
                                                <div class='flex items-center space-between space-x-2 quantity-calc'>
                                                    <span class='font-bold'>Q/B</span> <input type="number"
                                                        class="form-control" placeholder="0" value='0'
                                                        name='quantity_before[]'
                                                        onblur='calculateQuantityUsedRow(event)' />
                                                    <span class='font-bold'>Q/A</span> <input type="number"
                                                        class="form-control" placeholder="0" value='0'
                                                        name='quantity_after[]'
                                                        onblur='calculateQuantityUsedRow(event)' />
                                                </div>
                                                <input type="number" class="form-control hidden" placeholder="0"
                                                    value='0' name='quantity_used[]' readonly />


                                            </td>


                                            <td class="hidden">
                                                <input type="number" class="form-control" placeholder="0" readonly
                                                    name='totalq_sold[]' />
                                            </td>
                                            <td class="">
                                                <select name="tubeType[]" id="tubeType" class='form-control'
                                                    onchange='calculateTestTubes(event)'>
                                                    <option value="Null">Choose Test Tubes</option>
                                                    <option value="1">1 Ounce</option>
                                                    <option value="0.5">1/2 Ounce</option>
                                                    <option value="0.25">1/4 Ounce</option>

                                                </select>
                                            </td>

                                            <td class='hidden'>
                                                <input type="number" class="form-control" name="test_tubes[]"
                                                    class="form-control" oninput="" readonly value=' 0' />
                                            </td>
                                            <td class='hidden'>
                                                <input type="number" name="price[]" class="form-control" readonly
                                                    value='3' />
                                            </td>

                                            <td class='hidden'>
                                                <input type="number" name="total[]" class="form-control total_input"
                                                    readonly value='0' />
                                            </td>
                                            <td>

                                                <button class="btn btn-info" onclick='addRow(this)'><i
                                                        class="fa fa-plus"></i></button>
                                            </td>

                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <div id='' class='flex space-x-4 items-center justify-end mt-5  w-100 hidden'>
                                    <h2 class='font-bold'>Total Profit ($):</h2>
                                    <span class='font-bold' id='TotalValue'>
                                        <?php if(isset($_GET['status'])){ echo $total_profit['Total_Profit']; }else{ echo '0';}?></span>
                                    <input type="hidden" value='<?php echo $barId ?>' name="" class="form-control  "
                                        readonly id='barId' />
                                    <input type="hidden" value='<?php echo $bar ?>' name="" class="form-control  "
                                        readonly id='bar' />
                                    <input type="hidden" value='<?php echo $measurement ?>' name=""
                                        class="form-control  " readonly id='measurement' />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php') ?>


    <script>
    function fetchCategory(selectedElement) {
        // Get the selected product ID from the 'id' attribute of the selected option
        var selectedProductID = selectedElement.options[selectedElement.selectedIndex].id;


        // Find the parent table cell (td) of the selected product
        var parentCell = selectedElement.parentNode;

        // Find the corresponding category select element within the parent cell
        var categorySelect = parentCell.querySelector(".category-select");

        console.log(categorySelect)

        // Make an AJAX request to get the corresponding categories
        $.ajax({
            url: "admin/ajax_controls/get_categories.php", // Replace with the PHP file to fetch categories from the database
            method: "POST",
            data: {
                productID: selectedProductID
            }, // Send the product ID instead of the product value
            success: function(data) {
                console.log(data)
                // Clear existing options in the category select dropdown
                categorySelect.innerHTML = "";

                // Add new options based on the received data
                categorySelect.add(new Option(data, data));
                // Optionally, you can select the first option by default
                categorySelect.selectedIndex = 0;
            }
        });
    }
    </script>




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



    //Calculate the total used in Row 1
    function calculateQuantityUsedRow(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        var quantityBefore = parseInt(tr.getElementsByTagName("input")[0].value);
        var quantityAfter = parseInt(tr.getElementsByTagName("input")[1].value);
        const total = (quantityBefore - quantityAfter.toFixed(2))
        changeTotalQuantityUsedRow(total, event)

    }

    function changeTotalQuantityUsedRow(value, event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        tr.getElementsByTagName("input")[2].value = value
        calculateQuantityUsed(event)


    }

    function calculateQuantityUsed(event) {
        var target = event.target;
        var div = target.parentNode
        var td = div.parentNode;
        var tr = td.parentNode;

        var quantity1 = parseInt(tr.getElementsByTagName("input")[2].value);
        var quantity2 = parseInt(tr.getElementsByTagName("input")[5].value);
        var quantity3 = parseInt(tr.getElementsByTagName("input")[8].value);
        const total = quantity1 + quantity2 + quantity3

        changeTotalQuantityUsed(total, tr)



    }

    function changeTotalQuantityUsed(value, tr) {
        var tubeType = parseInt(tr.getElementsByTagName("select")[6].value)
        tr.getElementsByTagName("input")[9].value = value
        tr.getElementsByTagName("input")[10].value = value / tubeType
    }



    function calculateTestTubes(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        var tubeType = tr.getElementsByTagName("select")[6].value
        var qauntityUsed = tr.getElementsByTagName("input")[9].value
        tr.getElementsByTagName("input")[10].value = qauntityUsed / tubeType

        calculateProfit(event)
        calculateTotalProfit(event)
    }

    function calculateProfit(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        var totaltubes = tr.getElementsByTagName("input")[10].value
        var Price = tr.getElementsByTagName("input")[11].value
        tr.getElementsByTagName("input")[12].value = totaltubes * Price
        calculateTotalProfit(event)
    }

    function calculateTotalProfit(event) {

        const inputs = document.querySelectorAll('.total_input');
        let sum = 0;


        for (let i = 0; i < inputs.length; i++) {
            sum += parseFloat(inputs[i].value);
        }


        document.getElementById("TotalValue").innerHTML = sum.toFixed(2);


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

        var cell5 = newRow.insertCell(4);
        var cell6 = newRow.insertCell(5);
        var cell7 = newRow.insertCell(6);
        var cell8 = newRow.insertCell(7);
        var cell9 = newRow.insertCell(8);
        var cell10 = newRow.insertCell(9);
        cell2.classList.add('space-y-2')
        cell3.classList.add('space-y-2')
        cell4.classList.add('space-y-2')
        cell8.classList.add('hidden')
        cell9.classList.add('hidden')
        cell5.classList.add('hidden')
        cell7.classList.add('hidden')






        var rowOriginal = table.rows[rowIndex]; // second row (index 1)
        var cells_original = rowOriginal.cells; // array of cells in the row

        var parentRow = button.parentNode.parentNode;









        cell1.innerHTML = `<i class='fa fa-minus' ></i>`; // set the content of the th element
        cell2.innerHTML =
            `   <select name="product[]" class='form-control product-select'
                                                onchange='fetchCategory(this)'>
                                                <option value='' selected>Products</option>
                                                <?php foreach($inventory as $post): ?>
                                                <option value="<?php echo $post['Product'] ?>"
                                                    id="<?php echo $post['id'] ?>">
                                                    <?php echo $post['Product'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <select name="category[]" class='form-control category-select'>
                                                <option value="Null" selected>Category</option>
                                            </select>
                                            <div class='flex items-center space-between space-x-2 quantity-calc'>
                                                <input type="number" class="form-control" placeholder="0" value='0'
                                                    name='quantity_before[]'
                                                    onblur='calculateQuantityUsedRow(event)' />
                                                <input type="number" class="form-control" placeholder="0" value='0'
                                                    name='quantity_after[]'
                                                    onblur='calculateQuantityUsedRow(event)' />
                                            </div>
                                            <input type="number" class="form-control hidden" placeholder="0" value='0'
                                                name='quantity_used[]' readonly />`;
        cell3.innerHTML =
            `   <select name="product[]" class='form-control product-select'
                                                onchange='fetchCategory(this)'>
                                                <option value='' selected>Products</option>
                                                <?php foreach($inventory as $post): ?>
                                                <option value="<?php echo $post['Product'] ?>"
                                                    id="<?php echo $post['id'] ?>">
                                                    <?php echo $post['Product'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <select name="category[]" class='form-control category-select'>
                                                <option value="Null" selected>Category</option>
                                            </select>
                                            <div class='flex items-center space-between space-x-2 quantity-calc'>
                                                <input type="number" class="form-control" placeholder="0" value='0'
                                                    name='quantity_before[]'
                                                    onblur='calculateQuantityUsedRow(event)' />
                                                <input type="number" class="form-control" placeholder="0" value='0'
                                                    name='quantity_after[]'
                                                    onblur='calculateQuantityUsedRow(event)' />
                                            </div>
                                            <input type="number" class="form-control hidden" placeholder="0" value='0'
                                                name='quantity_used[]' readonly />`;
        cell4.innerHTML =
            `   <select name="product[]" class='form-control product-select'
                                                onchange='fetchCategory(this)'>
                                                <option value='' selected>Products</option>
                                                <?php foreach($inventory as $post): ?>
                                                <option value="<?php echo $post['Product'] ?>"
                                                    id="<?php echo $post['id'] ?>">
                                                    <?php echo $post['Product'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <select name="category[]" class='form-control category-select'>
                                                <option value="Null" selected>Category</option>
                                            </select>
                                            <div class='flex items-center space-between space-x-2 quantity-calc'>
                                                <input type="number" class="form-control" placeholder="0" value='0'
                                                    name='quantity_before[]'
                                                    onblur='calculateQuantityUsedRow(event)' />
                                                <input type="number" class="form-control" placeholder="0" value='0'
                                                    name='quantity_after[]'
                                                    onblur='calculateQuantityUsedRow(event)' />
                                            </div>
                                            <input type="number" class="form-control hidden" placeholder="0" value='0'
                                                name='quantity_used[]' readonly />`;
        cell5.innerHTML =
            ` <input type="number" class="form-control" placeholder="0" readonly
                                                name='totalq_sold[]' />`
        cell6.innerHTML = `  <select name="tubeType[]" id="tubeType" class='form-control'  onchange='calculateTestTubes(event)'>
        <option value="Null">Choose Test Tubes</option>
                                                <option value="1">1 Ounce</option>
                                                <option value="0.5">1/2 Ounce</option>
                                                <option value="0.25">1/4 Ounce</option>

                                            </select>`;
        cell7.innerHTML = ` <input type="number" class="form-control" name="test_tubes[]"
                                                class="form-control" oninput="" readonly value='0' />`;
        cell8.innerHTML = ` <input type="number" name="price[]" class="form-control" readonly
                                                value='3' /> `;
        cell9.innerHTML = `   <input type="number" name="total[]" class="form-control total_input"
                                                readonly value='0' />`;

        cell10.innerHTML = `   <td>

<button class="btn btn-info" onclick='addRow(this)'><i
        class="fa fa-plus"></i></button>
</td>`
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

                console.log(bar)

                $("#postTable tr").each(function(rowIndex, r) {
                    var cols = [];
                    $(this).find("td").each(function(colIndex, c) {
                        var inputVal = "";
                        var selectVal = "";
                        if ($(c).find("input").length) {
                            inputVal = $(c).find("input").val();
                        } else if ($(c).find("select").length) {
                            selectVal = $(c).find("select").val();
                        }
                        if ($(c).hasClass("space-y-2")) {
                            var select1Val = $(c).find("select[name='product[]']").val();
                            var select2Val = $(c).find("select[name='category[]']").val();
                            var inputVal1 = $(c).find("input[name='quantity_before[]']").val();
                            var inputVal2 = $(c).find("input[name='quantity_after[]']").val();
                            var inputVal = $(c).find("input[name='quantity_used[]']").val();
                            cols.push(select1Val, select2Val, inputVal, inputVal1, inputVal2);
                        } else {
                            cols.push(inputVal + selectVal);
                        }
                    });
                    tableData.push(cols);
                });


                $.ajax({
                    type: 'post',
                    url: 'admin/ajax_controls/saveDataShooters.php',
                    data: {
                        table_data: tableData,
                        totalProfit,
                        barId,
                        bar,
                        measurement
                    },
                    success: function(response) {
                        console.log(response)
                        $('#msg').html(response);

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
                                    `shooters.php?bar=${bar}&status=saved&date=${currentTime}&measurement=${measurement}`;
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
            window.location = `shooters.php?measurement=${measurement}&bar=${bar}&status=saved&date=${date_input}`;
        } else {
            $("#date_input").removeClass('form-control').addClass('form-control is-invalid');
        }

    }

    function changeMeasurement(event) {
        const value = event.target.id
        var bar = $('#bar').val()
        if (value == 'ounce') {
            window.location = `shooters.php?bar=${bar}&measurement=ounce`;
        } else {
            window.location = `shooters.php?bar=${bar}&measurement=grams`;
        }
    }

    function refreshdata() {
        var measurement = $('#measurement').val()
        var bar = $('#bar').val()
        window.location = `shooters.php?bar=${bar}&measurement=${measurement}`;
    }
    </script>

</body>

</html>