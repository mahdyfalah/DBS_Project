<?php

// Include DatabaseHelper.php file
require_once('DatabaseHelper.php');

// Instantiate DatabaseHelper class
$database = new DatabaseHelper();

?>

<html>
<head>
  <title>Online Shop</title>
</head>
<body>

  <h2>Add Customer: </h2>
  <form method="post" action="addCustomer.php">
      <div>
          <label for="new_firstname">Firstname:</label>
          <input id="new_firstname" name="firstname" type="text" maxlength="20">
      </div>
      <br>
      <div>
          <label for="new_lastname">Lastname:</label>
          <input id="new_lastname" name="lastname" type="text" maxlength="20">
      </div>
      <br>
      <div>
          <label for="new_telNr">TelNr:</label>
          <input id="new_telNr" name="telNr" type="number" max="9999999999">
      </div>
      <br>
      <div>
          <button type="submit">
              Add Customer
          </button>
      </div>
  </form>
  <br>
  <hr>

  <!-- Delete Person -->
<h2>Delete Customer: </h2>
<form method="post" action="delCustomer.php">
    <!-- ID textbox -->
    <div>
        <label for="del_name">ID:</label>
        <input id="del_name" name="UserId" type="number" min="1">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Delete Customer
        </button>
    </div>
</form>
<br>
<hr>

<h2>Update Customer: </h2>
<form method="post" action="updateCustomer.php">
  <div>
      <label for="update">ID:</label>
      <input id="update" name="UserId" type="number" min="1">
  </div>
  <br>
    <div>
        <label for="update_firstname">Firstname:</label>
        <input id="update_firstname" name="firstname" type="text" maxlength="20">
    </div>
    <br>
    <div>
        <label for="update_lastname">Lastname:</label>
        <input id="update_lastname" name="lastname" type="text" maxlength="20">
    </div>
    <br>
    <div>
        <label for="update_telNr">TelNr:</label>
        <input id="update_telNr" name="telNr" type="number" max="9999999999">
    </div>
    <br>
    <div>
        <button type="submit">
            Update Customer
        </button>
    </div>
</form>
<br>
<hr>

<h2>Add Product: </h2>
<form method="post" action="addProduct.php">
    <div>
        <label for="new_Product_name">Product name:</label>
        <input id="new_Product_name" name="Product_name" type="text" maxlength="20">
    </div>
    <br>
    <div>
        <label for="Brand">Brand:</label>
        <input id="Brand" name="Brand" type="text" maxlength="20">
    </div>
    <br>
    <div>
        <label for="categorie_id">Categorie:</label>
        <input id="categorie_id" name="CategorieId" type="text" max="20">
    </div>
    <br>
    <div>
        <label for="price">price:</label>
        <input id="price" name="Price" type="number" max="9999999999">
    </div>
    <br>
    <div>
        <button type="submit">
            Add Product
        </button>
    </div>
</form>
<br>
<hr>

<!-- SEARCH Product for specific Categorie -->
<div>
    <form id='searchform' action='index.php' method='get'>
        Search product for categorie:
        <input id='search' name='search' type='text' size='20' placeholder="categorie"
               value='<?php isset($_GET['search']) ? $_GET['search'] : null; ?>'/>
        <input id='submit' type='submit' value='Search'/><br>
    </form>
</div>
<?php
if (isset($_GET['search'])) {
    $sql = "SELECT productid, product_name, brand, price FROM Product WHERE categorieId like '%" . $_GET['search'] . "%'";
    echo "<td>" . $_GET['search'] . "</td>";
    $stmt = oci_parse($database->conn, $sql);
    oci_execute($stmt);
    ?>
    <table style='border: 1px solid #DDDDDD'>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // fetch rows of the executed sql query
        while ($row = oci_fetch_assoc($stmt)) {
            echo "<tr>";
            echo "<td>" . $row['PRODUCTID'] . "</td>";
            echo "<td>" . $row['PRODUCT_NAME'] . "</td>";
            echo "<td>" . $row['BRAND'] . "</td>";
            echo "<td>" . $row['PRICE'] . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <div>A total of <?php echo oci_num_rows($stmt); ?> datasets found!</div><br>
    <?php
    oci_free_statement($stmt);
}
?>
<br>
<hr>

<h2>Add Order: </h2>
<form method="post" action="customerOrders.php">
    <div>
        <label for="UserId">UserId:</label>
        <input id="UserId" name="UserId" type="number" >
    </div>
    <br>
    <div>
        <label for="ProductId">ProductId:</label>
        <input id="ProductId" name="ProductId" type="number">
    </div>
    <br>
    <div>
        <button type="submit">
            Add order
        </button>
    </div>
</form>
<br>
<hr>

<div>
    <form action="allCustomers.php">
        <input type="submit" value="Show all data in the Customer table">
    </form>
</div>
<br>
<hr>
<div>
    <form action="allOrders.php">
        <input type="submit" value="Show all data in the Order table">
    </form>
</div>
<br>
<hr>
<div>
    <form action="allSuppliers.php">
        <input type="submit" value="Show all Suppliers">
    </form>
</div>
<br>
<hr>
<h2>Execute price change: </h2>
<form method="post" action="price_change.php">
    <div>
        <label for="n">amount:</label>
        <input id="n" name="n" type="number" >
    </div>
    <div>
        <button type="submit">
            Execute
        </button>
    </div>
</form>
<br>
<hr>

</body>
</html>
