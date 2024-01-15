<?php
session_start();
//Kiểm tra xem có Biến session chưa.
if(!isset($_SESSION['username'])){
    header("Location:index.html");
    exit();
}

include '../manager/ProductManger.php';

// Kết nối đến Customer
$productManager = new ProductManger();

// Lấy danh sách Customer
$products = $productManager->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Product Dashboard</title>
</head>
<body>

<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['username'] ?>!</h2>
    <p>This is the main page after successful login</p>

    <a href="../Logout.php" class="btn btn-danger">Logout</a>

    <h3>Product List</h3>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Add</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['description']; ?></td>
                <td><button onclick="addToCart()">Add to cart</button></td>
            </tr>
        <?php endforeach;; ?>
        </tbody>
    </table>
</div>
</body>
<script>
    function addToCart() {
        // Lấy thông tin từ người dùng (có thể lấy từ các ô input)
        var customerId = 1; // Thay đổi tùy theo người dùng đăng nhập
        var productId = 2; // Ví dụ: ID của sản phẩm muốn thêm vào giỏ hàng
        var quantity = 3; // Số lượng sản phẩm

        // Sử dụng XMLHttpRequest hoặc Fetch API để gửi yêu cầu đến addToCart.php
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "addToCart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText); // Hiển thị phản hồi từ server
            }
        };
        xhr.send("customerId=" + customerId + "&productId=" + productId + "&quantity=" + quantity);
    }
</script>
</html>
