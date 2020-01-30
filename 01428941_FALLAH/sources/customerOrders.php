<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();
//Grab variables from POST request
$UserId = '';
if(isset($_POST['UserId'])){
    $UserId = $_POST['UserId'];
}

$ProductId = '';
if(isset($_POST['ProductId'])){
    $ProductId = $_POST['ProductId'];
}


// Insert method
$success = $database->insertIntoCustOrd($UserId, $ProductId);

// Check result
if ($success){
    echo "successfully added!'";
}
else{
    echo "Error";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>
