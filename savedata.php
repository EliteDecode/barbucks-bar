<?php 

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "barbucks";


$conn = mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);

if(!$conn){
   die('Connection failed: ' . mysqli_connect_error());
}

// Check if the form was submitted
if (isset($_POST['data'])) {
  // Get the number of columns
  $num_columns = count($_POST['data'][1]);
  
  // Loop through the rows of the table
  foreach ($_POST['data'] as $row) {
    // Build the SQL query
    $sql = "INSERT INTO saved_data VALUES (NULL";
    for ($i = 1; $i <= $num_columns; $i++) {
      $sql .= ", '" . mysqli_real_escape_string($conn, $row[$i]) . "'";
    }
    $sql .= ")";
    
    // Insert the data into the database
    mysqli_query($conn, $sql);
  }
}

// Close the connection
mysqli_close($conn);

?>