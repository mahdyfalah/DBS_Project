<?php

class DatabaseHelper
{
    // Since the connection details are constant, define them as const
    // We can refer to constants like e.g. DatabaseHelper::username
    const username = 'a01428941'; // use a + your matriculation number
    const password = 'dbs19'; // use your oracle db password
    const con_string = 'lab';

    // Since we need only one connection object, it can be stored in a member variable.
    // $conn is set in the constructor.
    public $conn;

    // Create connection in the constructor
    public function __construct()
    {
        try {
            // Create connection with the command oci_connect(String(username), String(password), String(connection_string))
            // The @ sign avoids the output of warnings
            // It could be helpful to use the function without the @ symbol during developing process
            $this->conn = @oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string
            );

            //check if the connection object is != null
            if (!$this->conn) {
                // die(String(message)): stop PHP script and output message:
                die("DB error: Connection can't be established!");
            }

        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }

    // Used to clean up
    public function __destruct()
    {
        // clean up
        @oci_close($this->conn);
    }


    public function insertIntoCustomer($firstname, $lastname, $telNr)
    {
        $sql = "INSERT INTO Customer (Firstname, Lastname, TelNr) VALUES ('{$firstname}', '{$lastname}', '{$telNr}')";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoProduct($Poduct_name, $Brand, $CategorieId, $Price)
    {
        $sql ="INSERT INTO Product (Product_name,Brand,categorieId,Price)
          values('{$Poduct_name}','{$Brand}','{$CategorieId}','{$Price}')";
        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function deleteCustomer($UserId)
    {
        // The SQL string
        $sql = "DELETE FROM Customer WHERE UserId = '{$UserId}' ";
        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function updateCustomer($UserId, $firstname, $lastname, $telNr)
    {
        $sql = "UPDATE Customer SET firstname = '{$firstname}', lastname = '{$lastname}', telNr = '{$telNr}'
          WHERE UserId = '{$UserId}' ";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoCustOrd($UserId, $ProductId)
    {
        $sql ="INSERT INTO Customer_orders(UserId,ProductId) values('{$UserId}','{$ProductId}')";
        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function price_change($n)
    {
        $sql ="BEGIN price_change('{$n}'); END;";
        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

}
