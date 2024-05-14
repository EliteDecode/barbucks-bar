<?php


include('../includes/database/db_controllers.php');
$product = $_POST['product'];
$price_per_can = $_POST['price_per_can'];
$price_of_drink = $_POST['price_of_drink'];
$id = $_POST['id'];
$weight_of_liquor = $_POST['weight_empty_liquor'];


$result = selectOdd('beers', ['Product' => $product, 'id' => $id]);
$num = count($result);

if ($num >=1) {
    echo "exists";
}else{

    $data = [
        'Product' => $product,
        'Price_per_can' => $price_per_can,
        'Price_of_drink' => $price_of_drink,
        'Weight_of_bottle' => $weight_of_liquor
       ];
    $response =    update('liquors',$id,  $data);

    if($response){
        echo "success";
    }

}