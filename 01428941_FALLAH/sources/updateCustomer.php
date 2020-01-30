<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variables from POST request
$firstname = '';
if(isset($_POST['firstname'])){
    $firstname = $_POST['firstname'];
}

$lastname = '';
if(isset($_POST['lastname'])){
    $lastname = $_POST['lastname'];
}

$telNr = '';
if(isset($_POST['telNr'])){
    $telNr = $_POST['telNr'];
}

$UserId = '';
if(isset($_POST['UserId'])){
    $UserId = $_POST['UserId'];
}

// Insert method
$success = $database->updateCustomer($UserId ,$firstname, $lastname, $telNr);

// Check result
if ($success){
    echo "Customer '{$firstname} {$lastname}' successfully Updated!'";
}
else{
    echo "Error can't Update Person '{$firstname} {$lastname}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>
