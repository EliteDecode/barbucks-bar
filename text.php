<!-- <?php
include('../includes/database/db_controllers.php');




$totalProfit;

$rows   = $_POST["table_data"];
$totalProfit = $_POST['totalProfit'];
$bar = $_POST['bar'];
$barId = $_POST['barId'];



$current_time = date('y-m-d');

$check = selectAll('saved_data_shooters', ['DateReg' => $current_time, 'BarID' => $barId, 'Bar' => $bar]);

$num = count($check);

if($num >= 1){
//     foreach($rows as $row){
// $id = $row[15];

//         $data = [
//             'P1_Product' => $row[1],
//              'P1_Category' => $row[2],
//              'P1_Quantity' => $row[3],
//              'P2_Product' => $row[4],
//              'P2_Category' => $row[5],
//              'P2_Quantity' => $row[6],
//              'P3_Product' => $row[7],
//              'P3_Category' => $row[8],
//              'P3_Quantity' => $row[9],
//              'Total_Quantity' => $row[10],
//              'Tube_Type' => $row[11],
//              'Total_Tubes' => $row[12],
//              'Tube_Price'=> $row[13],
//              'Profit' => $row[14],
//              'Total_profit' => $totalProfit,
//             'DateReg' => $current_time,
//             'BarID' => $barId,
//             'Bar' => $bar
            
        
//         ];

        
//         //For the first one product p1
//         $inventory = selectOne('inventory', ['Product' => $row[1], 'Type' => $row[2]]);
//         $runCheck = selectOne('saved_data_shooters', ['DateReg' => $current_time, 'BarId' => $barId, 'Bar' => $bar, 'Product' => $row[1], 'Type' => $row[2] ]);
//         $quant = $inventory['Quantity'];
//         $idInv = $inventory['id'];
//         $bot_quantity = $runCheck['P1_Quantity'];

//         //for the second product
//         $inventory2 = selectOne('inventory', ['Product' => $row[4], 'Type' => $row[5]]);
//         $runCheck2 = selectOne('saved_data_shooters', ['DateReg' => $current_time, 'BarId' => $barId, 'Bar' => $bar, 'Product' => $row[4], 'Type' => $row[5] ]);
//         $quant2 = $inventory2['Quantity'];
//         $idInv2 = $inventory2['id'];
//         $bot_quantity2 = $runCheck2['P2_Quantity'];


//         //for the third product
//         $inventory3 = selectOne('inventory', ['Product' => $row[7], 'Type' => $row[8]]);
//         $runCheck3 = selectOne('saved_data_shooters', ['DateReg' => $current_time, 'BarId' => $barId, 'Bar' => $bar, 'Product' => $row[7], 'Type' => $row[8] ]);
//         $quant3 = $inventory3['Quantity'];
//         $idInv3 = $inventory3['id'];
//         $bot_quantity3 = $runCheck3['P3_Quantity'];



//          if($bot_quantity > $row[3]){
//              $value = intval($bot_quantity) - intval($row[3]);
//              $newInventory = intval($quant) + intval($value);
//              $update_inventory = update('inventory', $idInv, ['Quantity' => $newInventory]);

//              //if the first one has been updated then we update the second one.
//              if($update_inventory && ($bot_quantity2 > $row[6])){
//                 $value2 = intval($bot_quantity2) - intval($row[6]);
//                 $newInventory2 = intval($quant2) + intval($value2);
//                 $update_inventory2 = update('inventory', $idInv2, ['Quantity' => $newInventory2]);

//                  //if the second one has been updated then we update the third one.
//                 if($update_inventory2 && ($bot_quantity3 > $row[9])){
//                     $value3 = intval($bot_quantity3) - intval($row[9]);
//                     $newInventory3 = intval($quant3) + intval($value3);
//                     $update_inventory3 = update('inventory', $idInv3, ['Quantity' => $newInventory3]);

//                     //third one
//                     if($update_inventory3){
//                         $insert= insert('saved_data_shooters', $data);
//                         if($insert){
//                           echo 'success';
//                           delete('saved_data_shooters', $id);
//                         }
//                        else{
//                            echo 'error1';
//                     }
//                 }
//              }
//          }elseif($row[3] > $bot_quantity){
//              $value = intval($row[3]) - intval($bot_quantity);
//              $newInventory = intval($quant) - intval($value);
//              $update_inventory = update('inventory', $idInv, ['Quantity' => $newInventory]);

//              if($update_inventory && ($row[6] > $bot_quantity2)){
//                 $value2 = intval($row[6]) - intval($bot_quantity2);
//                 $newInventory2 = intval($quant2) - intval($value2);
//                 $update_inventory2 = update('inventory', $idInv2, ['Quantity' => $newInventory2]);

//                 if($update_inventory2 && ($row[9] > $bot_quantity3)){
//                     $value3 = intval($row[6]) - intval($bot_quantity3);
//                     $newInventory3 = intval($quant3) - intval($value3);
//                     $update_inventory3 = update('inventory', $idInv3, ['Quantity' => $newInventory3]);

//                     if($update_inventory3){
//                         $insert= insert('saved_data_shooters', $data);
//                         if($insert){
//                           echo 'success';
//                           delete('saved_data_shooters', $id);
//                         }
//                      }else{
//                            echo 'error1';
//                     }
//                 }
//              }
  
             
//          }else{
//              echo 'error1';
//          }
      
       
//       }
//     }
}else{

    foreach($rows as $row){
    
        $data = [
             'P1_Product' => $row[1],
             'P1_Category' => $row[2],
             'P1_Quantity' => $row[3],
             'P2_Product' => $row[4],
             'P2_Category' => $row[5],
             'P2_Quantity' => $row[6],
             'P3_Product' => $row[7],
             'P3_Category' => $row[8],
             'P3_Quantity' => $row[9],
             'Total_Quantity' => $row[10],
             'Tube_Type' => $row[11],
             'Total_Tubes' => $row[12],
             'Tube_Price'=> $row[13],
             'Profit' => $row[14],
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
            $new_quantity = intval($quant) - intval($row[3]);
            $update_inventory = update('inventory', $idInv, ['Quantity' => $new_quantity]);

                $inventory2 = selectOne('inventory', ['Product' => $row[4], 'Type' => $row[5]]);
                $quant2 = $inventory2['Quantity'];
                $idInv2 = $inventory2['id'];
                $new_quantity2 = intval($quant2) - intval($row[6]);
                $update_inventory2 = update('inventory', $idInv2, ['Quantity' => $new_quantity2]);
     
          
                $inventory3 = selectOne('inventory', ['Product' => $row[7], 'Type' => $row[8]]);
                $quant3 = $inventory3['Quantity'];
                $idInv3 = $inventory3['id'];
                $new_quantity3 = intval($quant3) - intval($row[9]);
                $update_inventory3 = update('inventory', $idInv3, ['Quantity' => $new_quantity3]);

                if( $update_inventory3){
                       echo 'success';
                }else{
                     echo 'error';
                }
       
      }
   }
} -->