<?php
session_start();
//Kiểm tra xem có Biến session chưa.
if(!isset($_SESSION['username'])){
    header("Location:index.html");
    exit();
}

include '../manager/OrderDetailManager.php';

// Kết nối đến Customer
$orderDetailManager = new OrderDetailManager();

// Lấy danh sách Customer
$orderDetails = $orderDetailManager->getAllOrderDetails();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>OrderDetail Dashboard</title>
</head>
<body>

<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['username'] ?>!</h2>
    <p>This is the main page after successful login</p>

    <a href="../Logout.php" class="btn btn-danger">Logout</a>

    <h3>Order Detail List</h3>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Customer Name</th>
            <th>Order ID</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Product Name</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($orderDetails as $orderDetail): ?>
            <tr>
                <td><?php echo $orderDetail['order_detail_id']; ?></td>
                <td><?php echo $orderDetail['customer_name']; ?></td>
                <td><?php echo $orderDetail['order_id']; ?></td>
                <td><?php echo $orderDetail['price']; ?></td>
                <td><?php echo $orderDetail['quantity']; ?></td>
                <td><?php echo $orderDetail['product_name']; ?></td>
            </tr>
        <?php endforeach;; ?>
        </tbody>
    </table>
</div>
</body>
</html>
