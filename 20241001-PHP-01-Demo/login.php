<?php
session_start();
// Thực hiện kết nối với CSDL
$host = "localhost:3307";
$username = "root";
$password = "";
$database = "PhpDemoAccount";

// Đối tượng connection
$conn = new mysqli($host, $username, $password, $database);

// Kiểm tra kết nối đến CSDL
if ($conn -> connect_error) {
    die("Kết nối CSDL không thành công!". $conn -> connect_error);
} else {
    echo "Kết nối CSDL thành công!";
}

// Xử lý cho phần login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tiếp tục xử lý
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Thực hiện truy vấn bảng Account
    $query = "SELECT * FROM account WHERE username = '$username' AND password = '$password';";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        echo "Đăng nhập thành công";

        // Gán session
        $row = $result -> fetch_row();
        $_SESSION["username"] = $row["username"];
        // Điều hướng trang web
        header("Location: dashboard.php");
    } else {
        echo "Đăng nhập thất bại, vui lòng nhập lại thông tin";
    }
} else {
    echo "Invalid request method";
}

// Đóng kết nối sau khi thực hiện xong
$conn -> close();
?>