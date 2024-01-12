<?php
session_start();
//Kiểm tra xem có Biến session chưa.
if(!isset($_SESSION['username'])){
    header("Location:index.html");
}
echo "This is dashboard";
?>
<!DOCTYPE html>
<html lang="en">
<a href="logout.php">Logout</a>
</html>
