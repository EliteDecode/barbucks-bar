<?php 
require('includes/header.php');
require('includes/database/db_controllers.php');



if(isset($_GET['date'])){
    $date = $_GET['date'];
    $productdetails = selectAll('inventory', ['Category' => 'Liquor']);
    $distinct_totals =selectAllDistinct2('saved_data_shooters', 'Total_Profit', ['DateReg' => $date]);
    $grandtotal = 0;
$users = selectAllDistinct('saved_data_shooters', 'BarID', 'Bar' ,['DateReg' => $date]);
$formated_date = date("F jS, Y", strtotime($date));
}else{
    $date = date('y-m-d');
    $productdetails = selectAll('inventory', ['Category' => 'Liquor']);
    $distinct_totals =selectAllDistinct2('saved_data_shooters', 'Total_Profit', ['DateReg' => $date]);
    $grandtotal = 0;
$users = selectAllDistinct('saved_data_shooters', 'BarID', 'Bar' ,['DateReg' => $date]);
$formated_date = date("F jS, Y", strtotime($date));
}





?>

<style>
.table-container {

    width: 95%;
    margin: 0% 2.5%;
}

@media (min-width: 0px) and (max-width: 575px) {

    .table-container {
        width: 90%;
        margin: 0% 5% !important;
    }
}

thead tr th {
    font-size: 16px;
}

tbody tr td {
    font-size: 12px;
}

.dataTables_length select {
    border: 2px solid #171d64 !important;
    width: 90px !important;
    margin: 3% 0%;
}


.dataTables_length label,
.dataTables_info {
    font-weight: bold;
    text-transform: uppercase;
    font-size: 12px;
}

.paginate_button {
    font-weight: bold;
    text-transform: capitalize;
    font-size: 14px;


}

.dataTables_filter input {
    content: "e.g. jonhdoe";
    height: 35px;
    width: 200px;
    border: 2px solid #171d64 !important;
    font-size: 14px;
    margin: 3% 0%;
}


.dataTables_wrapper {
    background-color: #fff;
    padding: 3% 4%;
    border-radius: 10px;
}
</style>

<?php include ('nav.php') ?>

<body>
    <div class="wrap h-screen" style=" background:#F9F9F9; overflow-x:hidden">
        <div class="row">
            <div class="col-md-2 col-lg-2 col-xl-2">
                <?php include('sidenav.php') ?>
            </div>
            <div class="col-md-10 col-lg-10 col-xl-10" style='padding:0% 2%'>
                <div class=" mt-2 table-container">
                    <div class=" w-full p-2 rounded-md  my-3 bg-white flex justify-between items-center ">
                        <div>

                            <div class="flex space-x-1 items-center">
                                <img src="../assets/images/ras-lending.png" alt="" width="25px">
                                <p class="font-bold uppercase text-md "> Shooters Record</p>
                            </div>
                        </div>
                        <div>
                            <button class='btn bg-teal-300 font-bold text-sm uppercase' data-bs-toggle="modal"
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
                    <div class=" w-full p-2 rounded-md  my-3 bg-white flex space-x-2 items-center ">
                        <?php foreach($users as $user): ?>
                        <a href="#<?php echo $user['BarID'] ?>">
                            <div class='p-2 rounded-md bg-teal-600 text-white  my-4'>
                                <h4> ID:
                                    <span class='font-bold capitalize'> <?php echo $user['BarID'] ?> </span>
                                </h4>
                                <h4>At : <span class='capitalize font-bold'>Liquor Room</span></h4>
                            </div>
                        </a>
                        <?php endforeach;  ?>
                    </div>
                    <?php foreach($users as $user): ?>

                    <div class=" w-full p-2 rounded-md  my-3 bg-white  space-x-2 items-center "
                        id='<?php echo $user['BarID'] ?>'>
                        <button class='btn bg-teal-600 text-white font-bold my-4'>BAR ID:
                            <?php echo $user['BarID'] ?></button>
                        <table class="table table-hover border" id="postTable" width="100%">
                            <thead class="" style="border: 1px solid gray !important">
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Product 1</th>
                                    <th scope="col">Product 2</th>
                                    <th scope="col">Product 3</th>
                                    <th scope="col" class=''>Total Q/U</th>
                                    <th scope="col" class=''>Type</th>
                                    <th scope="col" class=''>Test Tubes</th>
                                    <th scope="col" class=''>Price</th>
                                    <th scope="col" class=''>Profit($)</th>
                                    <th scope="col" class=''>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $barId = $user['BarID'];
                                    $bar = $user['Bar'];
                                    if(isset($_GET['date'])){
                                        $date = $_GET['date'];
                                        $productdetails = selectAll('saved_data_shooters', ['DateReg' => $date, 'BarID' => $barId, 'Bar' => $bar]);
                                        $total_Profit = selectOne('saved_data_shooters', ['DateReg' => $date, 'BarID' => $barId, 'Bar' => $bar]);
                                    }else{
                                        $date = date('y-m-d');
                                        $productdetails = selectAll('saved_data_shooters', ['DateReg' => $date, 'BarID' => $barId, 'Bar' => $bar]);
                                        $total_Profit = selectOne('saved_data_shooters', ['DateReg' => $date, 'BarID' => $barId, 'Bar' => $bar]);
                                    }
                                   
                                    foreach($productdetails as $key=>$post):
                                     ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
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
                                            <input type="number" class="form-control" placeholder="0"
                                                value='<?php echo $post['P1_Quantity_Before'] ?>' />
                                            <input type="number" class="form-control" placeholder="0"
                                                value='<?php echo $post['P1_Quantity_After'] ?>' />
                                        </div>
                                        <input type="number" class="form-control" placeholder="0"
                                            value='<?php echo $post['P1_Quantity']; ?>' name='quantity_used[]' />

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
                                            <input type="number" class="form-control" placeholder="0"
                                                value='<?php echo $post['P2_Quantity_Before'] ?>'
                                                name='quantity_before[]' />
                                            <input type="number" class="form-control" placeholder="0"
                                                value='<?php echo $post['P2_Quantity_After'] ?>'
                                                name='quantity_after[]' />
                                        </div>
                                        <input type="number" class="form-control" placeholder="0"
                                            value='<?php echo $post['P2_Quantity']; ?>' name='quantity_used[]' />

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
                                            <input type="number" class="form-control" placeholder="0"
                                                value='<?php echo $post['P3_Quantity_Before'] ?>'
                                                name='quantity_before[]' />
                                            <input type="number" class="form-control" placeholder="0"
                                                value='<?php echo $post['P3_Quantity_After'] ?>'
                                                name='quantity_after[]' />
                                        </div>
                                        <input type="number" class="form-control" placeholder=""
                                            value='<?php echo $post['P3_Quantity']; ?>' name='quantity_used[]' />

                                    </td>


                                    <td class="">
                                        <input type="number" class="form-control" placeholder="0" readonly
                                            name='totalq_sold[]' value='<?php echo $post['Total_Quantity']; ?>' />
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

                                    <td class=''>
                                        <input type="number" class="form-control" name="test_tubes[]"
                                            class="form-control" oninput="" readonly
                                            value='<?php echo $post['Total_Tubes'] ?>' />
                                    </td>
                                    <td class=''>
                                        <input type="number" name="price[]" class="form-control" readonly
                                            value='<?php echo $post['Tube_Price'] ?>' />
                                    </td>

                                    <td class=''>
                                        <input type="number" name="total[]" class="form-control total_input" readonly
                                            value='<?php echo $post['Profit'] ?>' />
                                    </td>
                                    <td class=''>
                                        <input type="number" value='<?php echo $post['id'] ?>' name="id[]"
                                            class="form-control  total_input" readonly id='' />
                                    </td>


                                </tr>

                                <?php endforeach; ?>

                                <td colspan='7' class='font-bold '></td>
                                <td colspan='2' class='font-bold text-lg aliign-right'>Total Profit:</td>
                                <td colspan='' class='font-bold text-lg aliign-right flex border'>
                                    $<div id='TotalValue' class='  w-100'>
                                        <?php  echo $total_Profit['Total_Profit']?>
                                    </div>
                                </td>

                            </tbody>
                        </table>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>





    <?php include('includes/footer.php')?>

    <script>
    jQuery(document).ready(function($) {
        $('#postTable').DataTable({
            scrollX: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "E.g. Don Julio"
            }
        });
    })


    function fetchdata() {
        var date_input = $('#date_input').val();

        if (date_input != "") {
            window.location =
                `shooters.php?date=${date_input}`;
        } else {
            $("#date_input").removeClass('form-control').addClass('form-control is-invalid');
        }


    }
    </script>

</body>

</html>