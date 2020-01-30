<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variables from POST request
$n = '';
if(isset($_POST['n'])){
    $n = $_POST['n'];
}



// Insert method
$success = $database->price_change($n);

// Check result
if ($success){
    echo "prices changed'";
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
