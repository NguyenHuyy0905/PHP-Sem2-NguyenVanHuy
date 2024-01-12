<?php
include 'dashboard.php';//nhúng 1 php file vào
echo "Hello World!";
$varName ="Hello";
$varInt = 10;
$varFloat = 12.5;
$username= $_POST["username"];
$password =$_GET["password"];
if(isset($_GET["password"])){
    echo "check password";
}