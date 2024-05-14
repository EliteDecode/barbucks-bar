<?php
session_start();

include('../includes/database/db_controllers.php');
$product = $_POST['product'];
$price_per_can = $_POST['price_per_can'];
$price_of_drink = $_POST['price_of_drink'];
$weight_of_liquor = $_POST['weight_empty_liquor'];


$result = selectAll('beers', ['Product' => $product]);
$num = count($result);

if ($num >=1) {
    echo "exists";
}else{
// echo "<script>window.location.assign('posts.php');</script>";
$data = [
    'Product' => $product,
    'Price_per_can' => $price_per_can,
    'Price_of_drink' => $price_of_drink,
    'Weight_of_bottle' => $weight_of_liquor
   ];
    $response = insert('liquors', $data);

    if($response){
        echo "success";
    }

}