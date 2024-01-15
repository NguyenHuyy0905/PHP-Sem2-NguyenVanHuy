<?php
class OrderManager
{
    public $conn;
    public function __construct()
    {
        // Replace these database connection details with your actual credentials
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "PhpOrderManagement";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " + $this->conn->connect_error);
        }
    }

    public function getAllOrders()
    {
        $orders = [];
        $sql = "SELECT * FROM orders";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        $stmt->close();

        return $orders;
    }
}