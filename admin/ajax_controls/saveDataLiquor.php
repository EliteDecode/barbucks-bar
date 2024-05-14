<?php
include('../includes/database/db_controllers.php');




$totalProfit;

$rows   = $_POST["table_data"];
$totalProfit = $_POST['totalProfit'];
$bar = $_POST['bar'];
$barId = $_POST['barId'];
$measurement = $_POST['measurement'];




$current_time = date('y-m-d');

$check = selectAll('saved_data_liquor', ['DateReg' => $current_time, 'BarID' => $barId, 'Bar' => $bar]);

$num = count($check);

if($num >= 1){
    foreach($rows as $row){

        $qb;
        $qa;
        $ql;

        if($measurement == 'grams'){
            $qb = ($row[5] / 28) / $row[4];
            $qa = ($row[6] / 28) / $row[4];
            $ql = ($row[13] / 28) / $row[4];
         } else {
            $qb = $row[5] / $row[4];
            $qa = $row[6] / $row[4];
            $ql = $row[13] / $row[4];
          
        }
        

$id = $row[12];
        $data = [
            'Product' => $row[1],
            'Price_per_can' => $row[2],
            'Bottles_sold' => $row[3],
            'Category' => $row[4],
            'Quantity_before' => $row[5],
            'Quantity_after' => $row[6],
            'Quantity_Before_Ounce' => $qb,
            'Quantity_After_Ounce' => $qa,
            'Quantity_last_bottle_ounce'=> $ql,
            'Quantity_last_bottle'=> $row[13],
            'Total_quantity' => $row[3] +($qb - $qa),
            'Price_of_drink' => $row[8],
            'Gross_sale' => $row[9],
            'Cog_used' => $row[10],
            'Profit' => $row[11],
            'Total_profit' => $totalProfit,
            'DateReg' => $current_time,
            'BarID' => $barId,
            'Bar' => $bar
        ];
    
        $inventory = selectOne('inventory', ['Product' => $row[1], 'Category' => 'Liquor', 'Type' => $row[4]]);
        $runCheck = selectOne('saved_data_liquor', ['DateReg' => $current_time, 'BarID' => $barId, 'Bar' => $bar, 'Product' => $row[1], 'Category' => $row[4] ]);
        $quant = $inventory['Quantity'];
        $idInv = $inventory['id'];
        $bot = $runCheck['Total_quantity'];
         if($bot > ($row[3] +($qb - $qa))){
             $value = intval($bot) - intval($row[3] +($qb - $qa));
             $newInventory = intval($quant) + intval($value);
             $update_inventory = update('inventory', $idInv, ['Quantity' => $newInventory]);

             if($update_inventory){
                 update('saved_data_liquor', $id, $data);
                 echo 'success';
             }else{
                 echo 'error1';
             }
         }elseif($row[3] +($qb - $qa) > $bot){
             $value = intval($row[3] +($qb - $qa)) - intval($bot);
             $newInventory = intval($quant) - intval($value);
             $update_inventory = update('inventory', $idInv, ['Quantity' => $newInventory]);

             if($update_inventory){
                 update('saved_data_liquor', $id, $data);
                 echo 'success';
             }else{
                 echo 'error1';
             }
         }else{
             echo 'error1';
         }
     
    }
}else{

    foreach($rows as $row){

        $qb;
        $qa;
        $ql;

        if($measurement == 'grams'){
            $qb = ($row[5] / 28) / $row[4];
            $qa = ($row[6] / 28) / $row[4];
            $ql = ($row[13] / 28) / $row[4];
         } else {
            $qb = $row[5] / $row[4];
            $qa = $row[6] / $row[4];
            $ql = $row[13] / $row[4];
          
        }

        $data = [
            'Product' => $row[1],
            'Price_per_can' => $row[2],
            'Bottles_sold' => $row[3],
            'Category' => $row[4],
            'Quantity_before' => $row[5],
            'Quantity_after' => $row[6],
            'Quantity_Before_Ounce' => $qb,
            'Quantity_After_Ounce' => $qa,
            'Quantity_last_bottle_ounce'=> $ql,
            'Quantity_last_bottle'=> $row[13],
            'Total_quantity' => $row[3] +($qb - $qa),
            'Price_of_drink' => $row[8],
            'Gross_sale' => $row[9],
            'Cog_used' => $row[10],
            'Profit' => $row[11],
            'Total_profit' => $totalProfit,
            'DateReg' => $current_time,
            'BarID' => $barId,
            'Bar' => $bar
            
        ];
    
        $result = insert('saved_data_liquor', $data);
    
        if($result){
              
            $inventory = selectOne('inventory', ['Product' => $row[1], 'Category' => 'Liquor' , 'Type' => $row[4]]);
          
            $quant = $inventory['Quantity'];
            $idInv = $inventory['id'];
 
            $new_quantity = intval($quant) - intval($row[3] +($qb - $qa));
 
            $update_inventory = update('inventory', $idInv, ['Quantity' => $new_quantity]);
            if($update_inventory){
             echo 'success';
            }
        }else{
            echo 'error';
        }
       
    }
}