<?php
include 'dashboard.php'; // Nhúng một file php
echo "Hello World";
echo phpversion();
$varName = "FPT APTECH";
$varInt = 10;
$varFloat = 5.5;
$username = $_POST["username"];
$password = $_GET["password"];
if (isset($_GET["password"])) {
    echo "check password";
}