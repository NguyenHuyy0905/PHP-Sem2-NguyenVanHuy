<?php
session_start();
//Kiểm tra xem có Biến session chưa.
if(!isset($_SESSION['username'])){
    header("Location:index.html");
    exit();
}

include '../manager/OrderManager.php';

// Kết nối đến Customer
$orderManager = new OrderManager();

// Lấy danh sách Customer
$orders = $orderManager->getAllOrders();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Order Dashboard</title>
</head>
<body>

<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['username'] ?>!</h2>
    <p>This is the main page after successful login</p>

    <a href="../Logout.php" class="btn btn-danger">Logout</a>

    <h3>Order List</h3>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Customer ID</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['customer_id']; ?></td>
                <td><?php echo $order['date']; ?></td>
            </tr>
        <?php endforeach;; ?>
        </tbody>
    </table>
</div>
</body>
</html>
