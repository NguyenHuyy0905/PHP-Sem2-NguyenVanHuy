<?php
session_start();

//Thực hiện kết nối với CSDL
$host = "localhost:3307";
$username="root";
$password="";
$database="PhpOrderManagement";

//Đối tượng Connection
$conn = new mysqli($host,$username,$password,$database);
//Kiểm tra kết nối đên CSDL
if($conn->connect_error){
    die("Kết nối CSDL không thành công!". $conn->connect_error);
}
//Xử lý cho phần login
if($_SERVER["REQUEST_METHOD"]== "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    //Thực hiện truy vấn với bảng Account
    $query = "SELECT * FROM accounts WHERE username ='$username' AND password='$password'";
    $result = $conn->query($query);
    if($result ->num_rows == 1){
        echo "Đăng nhập thành công!";
        $row = $result->fetch_assoc();
        $_SESSION['username']=$row['username'];
        //Điều hướng trang web
        header("Location:Dashboard.php");
    }else{
        echo "Đăng nhập thất bại. Vui lòng kiểm tra lại thông tin đăng nhập";
    }
}
//Đóng kết nối sau khi thực hiện xong
$conn->close();
?>

