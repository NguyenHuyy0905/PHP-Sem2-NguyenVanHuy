<?php
session_start();
//Kiểm tra xem có Biến session chưa.
if(!isset($_SESSION['username'])){
    header("Location:index.html");
    exit();
}

include '../manager/CustomerManager.php';

// Kết nối đến Customer
$customerManager = new CustomerManager();

// Lấy danh sách Customer
$customers = $customerManager->getAllCustomers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Customer Dashboard</title>
</head>
<body>

<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['username'] ?>!</h2>
    <p>This is the main page after successful login</p>

    <a href="../Logout.php" class="btn btn-danger">Logout</a>

    <h3>Customer List</h3>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?php echo $customer['id']; ?></td>
                <td><?php echo $customer['name']; ?></td>
                <td><?php echo $customer['address']; ?></td>
                <td><?php echo $customer['phone']; ?></td>
            </tr>
        <?php endforeach;; ?>
        </tbody>
    </table>
</div>
</body>
</html>