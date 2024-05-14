<?php 
require('includes/header.php');
require('includes/database/db_controllers.php');



if(isset($_GET['date'])){
    $date = $_GET['date'];
    $userdetails = selectAll('inventory', ['Category' => 'Beer']);
    $distinct_totals =selectAllDistinct2('saved_data', 'Total_profit', ['DateReg' => $date]);
    $grandtotal = 0;
    $sum = selectSum('saved_data', 'Bottles_sold', ['Product' => 'Heinken', 'DateReg' => $date]);
$users = selectAllDistinct('saved_data', 'BarID', 'Bar' ,['DateReg' => $date]);
$formated_date = date("F jS, Y", strtotime($date));
}else{
    $date = date('y-m-d');
    $userdetails = selectAll('inventory', ['Category' => 'Beer']);
    $distinct_totals =selectAllDistinct2('saved_data', 'Total_profit', ['DateReg' => $date]);
    $grandtotal = 0;
    $sum = selectSum('saved_data', 'Bottles_sold', ['Product' => 'Heinken', 'DateReg' => $date]);
$users = selectAllDistinct('saved_data', 'BarID', 'Bar' ,['DateReg' => $date]);
$formated_date = date("F jS, Y", strtotime($date));
}




?>

<style>
.table-container {

    width: 95%;
    margin: 0% 2.5%;
}

#postTable {
    width: 1500px;
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
                                <p class="font-bold uppercase text-md "> All Beers Sales</p>
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
                                <h4> BAR ID:
                                    <span class='font-bold capitalize'> <?php echo $user['BarID'] ?> </span>
                                </h4>
                                <h4>BAR : <span class='capitalize font-bold'><?php echo $user['Bar'] ?></span></h4>
                            </div>
                        </a>
                        <?php endforeach;  ?>
                    </div>


                    <div class=" w-full p-2 rounded-md  my-3 bg-white  space-x-2 items-center ">
                        <button class='btn bg-teal-600 text-white font-bold my-4'>
                            Summary on <?php echo $formated_date ?>
                        </button>
                        <div style='overflow: scroll'>
                            <table class="table table-hover border" id="postTable" width="100%">
                                <thead class="" style="border: 1px solid gray !important">
                                    <tr>
                                        <th scope="col">S/N</th>
                                        <th scope="col">Product</th>
                                        <th scope="col" class=''>Price per can($)</th>
                                        <th scope="col">Quantity Before</th>
                                        <th scope="col">Quantity After</th>
                                        <th scope="col">Bottles Sold</th>
                                        <th scope="col" class=''>Price($)</th>
                                        <th scope="col" class=''>Gross Sale($)</th>
                                        <th scope="col" class=''>Cog Used($)</th>
                                        <th scope="col" class=''>Profit($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                   
                                   
                                 
                  
                                    foreach($userdetails as $key=>$ud):
                                  

                                    if(isset($_GET['date'])){
                                        $date = $_GET['date'];
                                        $bottles_sold = selectSum('saved_data', 'Bottles_sold', ['Product' => $ud['Product'], 'DateReg' => $date]);
                                        $quantity_before = selectSum('saved_data', 'Quantity_before', ['Product' => $ud['Product'], 'DateReg' => $date]);
                                        $quantity_after = selectSum('saved_data', 'Quantity_after', ['Product' => $ud['Product'], 'DateReg' => $date]);
                                        $gross_sale = selectSum('saved_data', 'Gross_sale', ['Product' => $ud['Product'], 'DateReg' => $date]);
                                        $cog_used = selectSum('saved_data', 'Cog_used', ['Product' => $ud['Product'], 'DateReg' => $date]);
                                        $profit = selectSum('saved_data', 'Profit', ['Product' => $ud['Product'], 'DateReg' => $date]);
                                        $price_per_can = selectOne('saved_data', ['Product' => $ud['Product']]);
                                        
                                    }else{
                                        $date = date('y-m-d');
                                        $bottles_sold = selectSum('saved_data', 'Bottles_sold', ['Product' => $ud['Product'], 'DateReg' => $date]);
                                        $quantity_before = selectSum('saved_data', 'Quantity_before', ['Product' => $ud['Product'], 'DateReg' => $date]);
                                        $quantity_after = selectSum('saved_data', 'Quantity_after', ['Product' => $ud['Product'], 'DateReg' => $date]);
                                        $gross_sale = selectSum('saved_data', 'Gross_sale', ['Product' => $ud['Product'], 'DateReg' => $date]);
                                        $cog_used = selectSum('saved_data', 'Cog_used', ['Product' => $ud['Product'], 'DateReg' => $date]);
                                        $profit = selectSum('saved_data', 'Profit', ['Product' => $ud['Product'], 'DateReg' => $date]);
                                        $price_per_can = selectOne('saved_data', ['Product' => $ud['Product']]);
                                        
                                    }
                                    
                                   
                                     ?>
                                    <tr>
                                        <th scope="row"><?php echo $key + 1  ?></th>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $ud['Product']?>'></td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $price_per_can['Price_per_can']?>'></td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $quantity_before[0]['total'] ?>'>
                                        </td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $quantity_after[0]['total'] ?>'>
                                        </td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $bottles_sold[0]['total'] ?>'>
                                        </td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $price_per_can['Price_of_drink']?>'></td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $gross_sale[0]['total']?>'></td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo  $cog_used[0]['total'] ?>'></td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $profit[0]['total']?>'>
                                        </td>

                                    </tr>


                                    <?php endforeach; ?>

                                    <td colspan='7' class='font-bold '></td>
                                    <td colspan='2' class='font-bold text-lg aliign-right'>Total Profit:</td>
                                    <td colspan='' class='font-bold text-lg aliign-right flex border'>
                                        $<div id='TotalValue' class='  w-100'>
                                            <?php  
                                        $grandtotal = 0;
                                        foreach($distinct_totals as $total){
                                            $grandtotal += $total['Total_profit']; 
                                        }
                                        echo $grandtotal;
                                        ?>
                                        </div>
                                    </td>

                                </tbody>
                            </table>

                        </div>

                    </div>



                    <?php foreach($users as $user): ?>
                    <div class=" w-full p-2 rounded-md  my-3 bg-white  space-x-2 items-center "
                        id='<?php echo $user['BarID'] ?>'>
                        <button class='btn bg-teal-600 text-white font-bold my-4'>BAR ID:
                            <?php echo $user['BarID'] ?></button>
                        <div style='overflow:scroll'>
                            <table class="table table-hover border" id="postTable" width="100%">
                                <thead class="" style="border: 1px solid gray !important">
                                    <tr>
                                        <th scope="col">S/N</th>
                                        <th scope="col">Product</th>
                                        <th scope="col" class=''>Price per can($)</th>
                                        <th scope="col">Quantity Before</th>
                                        <th scope="col">Quantity After</th>
                                        <th scope="col">Bottles Sold</th>
                                        <th scope="col" class=''>Price($)</th>
                                        <th scope="col" class=''>Gross Sale($)</th>
                                        <th scope="col" class=''>Cog Used($)</th>
                                        <th scope="col" class=''>Profit($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $barId = $user['BarID'];
                                    $bar = $user['Bar'];
                                    if(isset($_GET['date'])){
                                        $date = $_GET['date'];
                                        $userdetails = selectAll('saved_data', ['DateReg' => $date, 'BarID' => $barId, 'Bar' => $bar]);
                                        $total_profit = selectOne('saved_data', ['DateReg' => $date, 'BarID' => $barId, 'Bar' => $bar]);
                                    }else{
                                        $date = date('y-m-d');
                                        $userdetails = selectAll('saved_data', ['DateReg' => $date, 'BarID' => $barId, 'Bar' => $bar]);
                                        $total_profit = selectOne('saved_data', ['DateReg' => $date, 'BarID' => $barId, 'Bar' => $bar]);
                                    }
                                    
                                   
                                    foreach($userdetails as $key=>$ud):
                                     ?>
                                    <tr>
                                        <th scope="row"><?php echo $key + 1  ?></th>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $ud['Product']?>'></td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $ud['Price_per_can']?>'></td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $ud['Quantity_Before']?>'></td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $ud['Quantity_After']?>'></td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $ud['Bottles_sold']?>'></td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $ud['Price_of_drink']?>'></td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $ud['Gross_sale']?>'></td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $ud['Cog_used']?>'></td>
                                        <td><input type="text" class="form-control" readonly
                                                value='<?php  echo $ud['Profit']?>'></td>

                                    </tr>


                                    <?php endforeach; ?>

                                    <td colspan='7' class='font-bold '></td>
                                    <td colspan='2' class='font-bold text-lg aliign-right'>Total Profit:</td>
                                    <td colspan='' class='font-bold text-lg aliign-right flex border'>
                                        $<div id='TotalValue' class='  w-100'>
                                            <?php  echo $total_profit['Total_profit']?>
                                        </div>
                                    </td>

                                </tbody>
                            </table>
                        </div>
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
        if (date_input != "") {
            window.location =
                `beer_sales.php?date=${date_input}`;
        } else {
            $("#date_input").removeClass('form-control').addClass('form-control is-invalid');
        }



    }
    </script>

</body>

</html>