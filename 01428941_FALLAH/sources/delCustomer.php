<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variable id from POST request
$UserId = '';
if(isset($_POST['UserId'])){
    $UserId = $_POST['UserId'];
}

// Delete method
$error_code = $database->deleteCustomer($UserId);

// Check result
if ($error_code == 1){
    echo "Customer with ID: '{$UserId}' successfully deleted!'";
}
else{
    echo "Error can't delete Customer with ID: '{$UserId}'. Errorcode: {$error_code}";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>
