<?php // file php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location:login.php");
}
echo "Dashboard nè...";
?>
<!DOCTYPE html>
<html lang="en">
<a href="logout.php">Logout</a>
</html>