<?php
class OrderDetailManager
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

    public function getAllOrderDetails()
    {
        $orderDetails = [];
        $sql = "SELECT od.id AS order_detail_id, c.name AS customer_name, od.order_id AS order_id, od.price, od.quantity AS quantity, p.name AS product_name
                FROM Customers c, Orders o, Order_Detail od, Products p
                WHERE c.id = o.customer_id AND o.id = od.order_id AND p.id = od.product_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $orderDetails[] = $row;
        }

        $stmt->close();

        return $orderDetails;
    }
}
