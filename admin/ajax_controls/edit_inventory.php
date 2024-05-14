<?php


include('../includes/database/db_controllers.php');
$product = $_POST['product'];
$quantity = $_POST['quantity'];
$category = $_POST['category'];
$type = $_POST['type'];
$price_of_drink = $_POST['price_of_drink'];

$id = $_POST['id'];


$query = "SELECT * FROM inventory WHERE Product = '$product' AND Category = '$category' AND Type = '$type' AND id != '$id'";
$res = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($res); 
$num = count($result);

if ($num >=1) {
    echo "exists";
}else{

$data = [
    'Product' => $product,
    'Quantity' => $quantity,
    'Price_of_drink' => $price_of_drink,
    'Category' => $category,
    'Type' =>  $type,
    'Empty' => 0
   ];
    $response =    update('inventory',$id,  $data);

    if($response){
        echo "success";
    }

}
 ?>