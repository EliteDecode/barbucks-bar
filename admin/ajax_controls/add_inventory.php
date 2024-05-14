<?php
session_start();

include('../includes/database/db_controllers.php');
$product = $_POST['product'];
$quantity = $_POST['quantity'];
$category = $_POST['category'];
$type = $_POST['type'];
$price_of_drink = $_POST['price_of_drink'];
$price_per_can = $_POST['price_per_can'];

$result = selectAll('inventory', ['Product' => $product, 'Category' => $category, 'Type' => $type]);
$num = count($result);

if ($num >=1) {
    echo "exists";
}else{
// echo "<script>window.location.assign('posts.php');</script>";
$data = [
    'Product' => $product,
    'Quantity' => $quantity,
    'Price_of_drink' => $price_of_drink,
    'Price_per_can' => $price_per_can,
    'Category' => $category,
    'Type' =>  $type,
    'Empty' => 0
   ];
    $response = insert('inventory', $data);

    if($response){
        echo "success";
    }

}