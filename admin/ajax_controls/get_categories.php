<?php

include('../includes/database/db_controllers.php');


// Replace this with your database connection and query to get categories based on the selected product
$id = $_POST['productID'];
// ... perform database query to fetch categories based on the selected product ...



// For demonstration purposes, let's assume the fetched categories are stored in an array called $categories
$categories = [];

$category = selectOne('inventory', ['id' => $id]);

// Return the categories as a JSON response
echo $category['Type'];
?>