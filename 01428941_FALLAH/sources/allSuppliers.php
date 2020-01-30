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
    <title>All Suppliers</title>
    <link rel="stylesheet" type="text/css" href="cssFile.css">
</head>
<body>
<?php
$sql = "Select Supplier_name, TelNr FROM Supplier";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);
?>
<table style='border: 1px solid #DDDDDD'>
    <thead>
    <tr>
        <th>name</th>
        <th>TelNr</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = oci_fetch_assoc($stmt)) {
        echo "<tr>";
        echo "<td>" . $row['SUPPLIER_NAME'] . "</td>";
        echo "<td>" . $row['TELNR'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
<div>A total of <?php echo oci_num_rows($stmt); ?> Suppliers found!</div>
<?php
oci_free_statement($stmt);
oci_close($conn);
?>
<br><a href="index.php">Back to Homepage</a>
</body>
</html>
