<?php
include('../includes/database/db_controllers.php');




$totalProfit;

$rows   = $_POST["table_data"];
$totalProfit = $_POST['totalProfit'];
$bar = $_POST['bar'];
$barId = $_POST['barId'];
$measurement = $_POST['measurement'];



$current_time = date('y-m-d');

$check = selectAll('saved_data_shooters', ['DateReg' => $current_time, 'BarID' => $barId, 'Bar' => $bar]);

$num = count($check);

if($num >= 1){
    function updateInventory($bot_quantity, $row_quantity, $quant, $idInv, $data, $id) {
        if ($bot_quantity > $row_quantity) {
            $value = intval($bot_quantity) - intval($row_quantity);
            $newInventory = intval($quant) + intval($value);
            update('inventory', $idInv, ['Quantity' => $newInventory]);   
        } elseif ($bot_quantity == $row_quantity) {
            update('inventory', $idInv, ['Quantity' => $quant]);   
        } else {
            $value = intval($row_quantity) - intval($bot_quantity);
            $newInventory = intval($quant) - intval($value);
            update('inventory', $idInv, ['Quantity' => $newInventory]);
           
        }
    }


    foreach($rows as $row){
        
        $q1;
        $q2;
        $q3;


        if($measurement == 'grams'){
            $q1 = ($row[3] / 28) / $row[2];
            $q2 = ($row[8] / 28) / $row[7];
            $q3 = ($row[13] / 28) / $row[12];
         } else {
            $q1 = $row[3] / $row[2];
            $q2 = $row[7] / $row[7];
            $q3 = $row[13] / $row[12];
          
        }

$id = $row[21];
        $data = [
            'P1_Product' => $row[1],
            'P1_Category' => $row[2],
            'P1_Quantity' => $row[3],
            'P1_Quantity_Ounce' => $q1,
            'P1_Quantity_Before' => $row[4],
            'P1_Quantity_After' => $row[5],
            'P2_Product' => $row[6],
            'P2_Category' => $row[7],
            'P2_Quantity' => $row[8],
            'P2_Quantity_Ounce' => $q2,
            'P2_Quantity_Before' => $row[9],
            'P2_Quantity_After' => $row[10],
            'P3_Product' => $row[11],
            'P3_Category' => $row[12],
            'P3_Quantity' => $row[13],
            'P3_Quantity_Ounce' => $q3,
            'P3_Quantity_Before' => $row[14],
            'P3_Quantity_After' => $row[15],
            'Total_Quantity' => $row[16],
            'Total_Quantity_Ounce' => $q1 + $q2 + $q3,
            'Tube_Type' => $row[17],
            'Total_Tubes' => $row[18],
            'Tube_Price'=> $row[19],
            'Profit' => $row[20],
            'Total_profit' => $totalProfit,
           'DateReg' => $current_time,
           'BarID' => $barId,
           'Bar' => $bar
        
        ];

        
        
        //For the first one product p1
        $inventory = selectOne('inventory', ['Product' => $row[1], 'Type' => $row[2]]);
        $runCheck = selectOne('saved_data_shooters', ['DateReg' => $current_time, 'BarId' => $barId, 'Bar' => $bar, 'P1_Product' => $row[1], 'P1_Category' => $row[2] ]);
        $quant = $inventory['Quantity'];
        $idInv = $inventory['id'];
        $bot_quantity = $runCheck['P1_Quantity_Ounce'];

        //for the second product
        $inventory2 = selectOne('inventory', ['Product' => $row[6], 'Type' => $row[7]]);
        $runCheck2 = selectOne('saved_data_shooters', ['DateReg' => $current_time, 'BarId' => $barId, 'Bar' => $bar, 'P2_Product' => $row[6], 'P2_Category' => $row[7] ]);
        $quant2 = $inventory2['Quantity'];
        $idInv2 = $inventory2['id'];
        $bot_quantity2 = $runCheck2['P2_Quantity_Ounce'];
        


        //for the third product
        $inventory3 = selectOne('inventory', ['Product' => $row[11], 'Type' => $row[12]]);
        $runCheck3 = selectOne('saved_data_shooters', ['DateReg' => $current_time, 'BarId' => $barId, 'Bar' => $bar, 'P3_Product' => $row[11], 'P3_Category' => $row[12] ]);
        $quant3 = $inventory3['Quantity'];
        $idInv3 = $inventory3['id'];
        $bot_quantity3 = $runCheck3['P3_Quantity_Ounce'];



        updateInventory($bot_quantity, $q1, $quant, $idInv, $data, $id);
        updateInventory($bot_quantity2, $q2, $quant2, $idInv2, $data, $id);
        updateInventory($bot_quantity3, $q3, $quant3, $idInv3, $data, $id);
            
     


        
                $insert= insert('saved_data_shooters', $data);
                if($insert){
                    echo 'success';
                    delete('saved_data_shooters', $id);
                }
                else{
                    echo 'error';
                }
            
        




    }
}else{

    foreach($rows as $row){

        $q1;
        $q2;
        $q3;


        if($measurement == 'grams'){
            $q1 = ($row[3] / 28) / $row[2];
            $q2 = ($row[8] / 28) / $row[7];
            $q3 = ($row[13] / 28) / $row[12];
         } else {
            $q1 = $row[3] / $row[2];
            $q2 = $row[7] / $row[7];
            $q3 = $row[13] / $row[12];
          
        }

       
    
        $data = [
             'P1_Product' => $row[1],
             'P1_Category' => $row[2],
             'P1_Quantity' => $row[3],
             'P1_Quantity_Ounce' => $q1,
             'P1_Quantity_Before' => $row[4],
             'P1_Quantity_After' => $row[5],
             'P2_Product' => $row[6],
             'P2_Category' => $row[7],
             'P2_Quantity' => $row[8],
             'P2_Quantity_Ounce' => $q2,
             'P2_Quantity_Before' => $row[9],
             'P2_Quantity_After' => $row[10],
             'P3_Product' => $row[11],
             'P3_Category' => $row[12],
             'P3_Quantity' => $row[13],
             'P3_Quantity_Ounce' => $q3,
             'P3_Quantity_Before' => $row[14],
             'P3_Quantity_After' => $row[15],
             'Total_Quantity' => $row[16],
             'Total_Quantity_Ounce' => $q1 + $q2 + $q3,
             'Tube_Type' => $row[17],
             'Total_Tubes' => $row[18],
             'Tube_Price'=> $row[19],
             'Profit' => $row[20],
             'Total_profit' => $totalProfit,
            'DateReg' => $current_time,
            'BarID' => $barId,
            'Bar' => $bar
            
        ];
    
        $result = insert('saved_data_shooters', $data);
    
        if($result){
            $inventory = selectOne('inventory', ['Product' => $row[1], 'Type' => $row[2]]);
            $quant = $inventory['Quantity'];
            $idInv = $inventory['id'];
            $new_quantity = intval($quant) - intval($q1);
            $update_inventory = update('inventory', $idInv, ['Quantity' => $new_quantity]);

                $inventory2 = selectOne('inventory', ['Product' => $row[6], 'Type' => $row[7]]);
                $quant2 = $inventory2['Quantity'];
                $idInv2 = $inventory2['id'];
                $new_quantity2 = intval($quant2) - intval($q2);
                $update_inventory2 = update('inventory', $idInv2, ['Quantity' => $new_quantity2]);
     
          
                $inventory3 = selectOne('inventory', ['Product' => $row[11], 'Type' => $row[12]]);
                $quant3 = $inventory3['Quantity'];
                $idInv3 = $inventory3['id'];
                $new_quantity3 = intval($quant3) - intval($q3);
                $update_inventory3 = update('inventory', $idInv3, ['Quantity' => $new_quantity3]);

                if( $update_inventory3){
                       echo 'success';
                }else{
                     echo 'error';
                }
       
      }
   }
}