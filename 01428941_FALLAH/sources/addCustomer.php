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

// Insert method
$success = $database->insertIntoCustomer($firstname, $lastname, $telNr);

// Check result
if ($success){
    echo "Customer '{$firstname} {$lastname}' successfully added!'";
}
else{
    echo "Error can't insert Person '{$firstname} {$lastname}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>
