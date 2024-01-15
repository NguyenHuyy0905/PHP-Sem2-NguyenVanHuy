<?php

function addToCart($customerId, $productId, $quantity) {
    // Kết nối đến cơ sở dữ liệu (điều này cần được điều chỉnh dựa trên thông tin kết nối của bạn)
    $conn = new mysqli("localhost", "username", "password", "your_database");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Bắt đầu một giao dịch
    $conn->begin_transaction();

    try {
        // Thêm thông tin đặt hàng (Orders)
        $date = date("Y-m-d");
        $orderQuery = "INSERT INTO orders (customer_id, date) VALUES ('$customerId', '$date')";
        $conn->query($orderQuery);

        // Lấy ID của đơn đặt hàng vừa thêm
        $orderId = $conn->insert_id;

        // Lấy thông tin sản phẩm
        $productQuery = "SELECT * FROM products WHERE id = $productId";
        $productResult = $conn->query($productQuery);

        if ($productResult->num_rows > 0) {
            $product = $productResult->fetch_assoc();

            // Thêm sản phẩm vào giỏ hàng (Order_Detail)
            $price = $product['price'];
            $totalPrice = $price * $quantity;
            $orderDetailQuery = "INSERT INTO order_detail (order_id, product_id, price, date, quantity) 
                                VALUES ('$orderId', '$productId', '$totalPrice', '$date', '$quantity')";
            $conn->query($orderDetailQuery);

            // Commit giao dịch
            $conn->commit();
            echo "Product added to cart successfully.";
        } else {
            echo "Product not found.";
        }
    } catch (Exception $e) {
        // Rollback giao dịch nếu có lỗi
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    // Đóng kết nối
    $conn->close();
}

// Xử lý yêu cầu AJAX nếu được gọi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customerId'], $_POST['productId'], $_POST['quantity'])) {
    $customerId = $_POST['customerId'];
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    addToCart($customerId, $productId, $quantity);
}

?>
