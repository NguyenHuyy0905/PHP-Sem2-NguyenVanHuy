<?php
session_start();

// Kiểm tra nếu người dùng đã đăng nhập, chuyển hướng...
if (isset($_SESSION['user_id'])) {
    header("Location: Dashboard.php");
    exit();
}

// Kiểm tra nếu người dùng đã gửi form đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến Database
    include 'manager/CustomerManager.php';
    $customerManger = new CustomerManager();

    // Lấy dữ liệu từ form đăng nhập
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Thực hiện truy vấn kiểm tra đăng nhập
    $sql = "SELECT * FROM Accounts WHERE username=? AND password=?";
    $stmt = $customerManger->conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Đăng nhập thành công, lưu thông tin người dùng vào session
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        // Chuyển hướng đến trang dashboard.php
        header("Location: Dashboard.php");
        exit();
    } else {
        $error_message = "Đăng nhập không thành công. Vui lòng kiểm tra lại";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Student Manager</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
</head>
<body>

<div class="container mt-5">
    <h2>Login</h2>

    <?php
    if (isset($error_message)) {
        echo '<div class="alert alert-danger">' . $error_message . '</div>';
    }
    ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

</div>

</body>
</html>