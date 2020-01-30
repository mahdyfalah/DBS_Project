<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();
//'{$Poduct_name}','{$Brand}','{$CategorieId}','{$Price}'
//Grab variables from POST request
$Product_name = '';
if(isset($_POST['Product_name'])){
    $Product_name = $_POST['Product_name'];
}

$Brand = '';
if(isset($_POST['Brand'])){
    $Brand = $_POST['Brand'];
}

$CategorieId = '';
if(isset($_POST['CategorieId'])){
    $CategorieId = $_POST['CategorieId'];
}

$Price = '';
if(isset($_POST['Price'])){
    $Price = $_POST['Price'];
}

// Insert method
$success = $database->insertIntoProduct($Product_name, $Brand, $CategorieId, $Price);

// Check result
if ($success){
    echo "Product '{$Product_name} {$Brand}' successfully added!'";
}
else{
    echo "Error can't insert Person '{$Product_name} {$Brand}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>
