<?php
include('../includes/database/db_controllers.php');


$totalProfit;

$rows   = $_POST["table_data"];
$totalProfit = $_POST['totalProfit'];
$totalProfitC = $_POST['totalProfitC'];
$totalProfitA = $_POST['totalProfitA'];
$bar = $_POST['bar'];
$barId = $_POST['barId'];




$current_time = date('y-m-d');

$check = selectAll('night_bottle_service', ['DateReg' => $current_time, 'BarID' => $barId, 'Bar' => $bar]);

$num = count($check);

if($num >= 1){

    foreach($rows as $row){

$id = $row[9];
        $data = [
            'Product' => $row[0],
            'Type' => $row[1],
            'Price_of_drink' => $row[2],
            'Bottles_sold' => $row[3],
            'Bottles_sold_deal' => $row[4],
            'price_of_drink_deal' => $row[5],
            'Total_Profit' => $row[6],
            'Profit_attendant' => $row[7],
            'Profit_company' => $row[8],
            'BarID' => $barId,
            'Bar' => $bar,
            'DateReg' => $current_time,
        
        ];

      
      $inventory = selectOne('inventory', ['Product' => $row[0], 'Type' => $row[1]]);
      $runCheck = selectOne('night_bottle_service', ['DateReg' => $current_time, 'BarID' => $barId, 'Bar' => $bar, 'Product' => $row[0], 'Type' => $row[1] ]);
      $quant = $inventory['Quantity'];
      $idInv = $inventory['id'];
      $bot = $runCheck['Bottles_sold'] +  $runCheck['Bottles_sold_deal'];
       if($bot > ($row[3] + $row[4])){
           $value = intval($bot) - intval($row[3] + $row[4]);
           $newInventory = intval($quant) + intval($value * $row[1]);
           $update_inventory = update('inventory', $idInv, ['Quantity' => $newInventory]);

           if($update_inventory){
            $insert= insert('night_bottle_service', $data);
            if($insert){
              echo 'success';
              delete('night_bottle_service', $id);
            }
           }else{
               echo 'error1';
           }
       }elseif(($row[3] + $row[4]) > $bot){
           $value = intval($row[3] + $row[4]) - intval($bot);
           $newInventory = intval($quant) - intval($value * $row[1]);
           $update_inventory = update('inventory', $idInv, ['Quantity' => $newInventory]);

           if($update_inventory){
            $insert= insert('night_bottle_service', $data);
            if($insert){
              echo 'success';
              delete('night_bottle_service', $id);
            }
           }else{
               echo 'error1';
           }
       }else{
           echo 'error1';
       }
    
     
    }
}else{

    foreach($rows as $row){
    
        $data = [
            'Product' => $row[0],
            'Type' => $row[1],
            'Price_of_drink' => $row[2],
            'Bottles_sold' => $row[3],
            'Bottles_sold_deal' => $row[4],
            'price_of_drink_deal' => $row[5],
            'Total_Profit' => $row[6],
            'Profit_attendant' => $row[7],
            'Profit_company' => $row[8],
            'BarID' => $barId,
            'Bar' => $bar,
            'DateReg' => $current_time,
          
            
        ];
    
        $result = insert('night_bottle_service', $data);
    
        if($result){
              
            $inventory = selectOne('inventory', ['Product' => $row[0], 'Type' => $row[1]]);
          
            $quant = $inventory['Quantity'];
            $idInv = $inventory['id'];
 
            $new_quantity = intval($quant) - intval(($row[3] + $row[4]) * $row[1]);
 
            $update_inventory = update('inventory', $idInv, ['Quantity' => $new_quantity]);
            if($update_inventory){
             echo 'success';
            }
        }else{
            echo 'error';
        }
       
    }
}