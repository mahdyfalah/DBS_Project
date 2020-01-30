<?php
$user = 'a01428941';
$pass = 'dbs19';
$database = 'lab';

// establish database connection
$conn = oci_connect($user, $pass, $database);
if (!$conn) exit;
?>

<html>
<head>
    <title>All Orders</title>
    <link rel="stylesheet" type="text/css" href="cssFile.css">
</head>
<body>
<?php
$sql = "SELECT UserId, OrderNr, ProductId, Order_date FROM customer_orders ";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);
?>
<table style='border: 1px solid #DDDDDD'>
    <thead>
    <tr>
        <th>OrderNr</th>
        <th>Name</th>
        <th>ProductId</th>
        <th>date</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = oci_fetch_assoc($stmt)) {
        //Selecting FOREIGN key of order to get names
        $sqlHelp = "SELECT Firstname, Lastname FROM customer where UserId like '%".$row['USERID']."%' ";
        $stmtHelp = oci_parse($conn, $sqlHelp);
        oci_execute($stmtHelp);
        $rowHelp = oci_fetch_assoc($stmtHelp);


        echo "<tr>";
        echo "<td>" . $row['ORDERNR'] . "</td>";
        echo "<td>" . $rowHelp['FIRSTNAME'] ." ". $rowHelp['LASTNAME'] . "</td>";
        echo "<td>" . $row['PRODUCTID'] . "</td>";
        echo "<td>" . $row['ORDER_DATE'] . "</td>";
        echo "</tr>";

        oci_free_statement($stmtHelp);
    }
    ?>
    </tbody>
</table>
<div>A total of <?php echo oci_num_rows($stmt); ?> Customers found!</div>
<?php
oci_free_statement($stmt);
oci_close($conn);
?>
<br><a href="index.php">Back to Homepage</a>
</body>
</html>
