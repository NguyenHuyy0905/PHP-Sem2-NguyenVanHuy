<?php
session_start();
//Kiểm tra xem có Biến session chưa.
if(!isset($_SESSION['username'])){
    header("Location:index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
</head>
<body>

<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['username'] ?>!</h2>
    <p>This is the main page after successful login</p>

    <a href="Logout.php" class="btn btn-danger">Logout</a>

    <h3>Product List</h3>
    <table class="table">
        <thead>
        <tr>
            <a href="view/CustomerView.php">Customers</a>
            <a href="view/OrdersView.php">Orders</a>
            <a href="view/OrderDetailsView.php">OrderDetails</a>
            <a href="view/ProductsView.php">Products</a>
            <a href="view/ShoppingCartView.php">Shopping Cart</a>
        </tr>
        </thead>

    </table>
</div>
</body>
</html>
