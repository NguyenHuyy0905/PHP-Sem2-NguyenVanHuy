<?php
session_start();
//Kiểm tra xem có Biến session chưa.
if(!isset($_SESSION['username'])){
    header("Location:index.html");
    exit();
}

include 'StudentManager.php';

// Kết nối đến StudentManager
$studentManager = new StudentManager();

// Lấy danh sách sinh viên và thông tin điểm
$students = $studentManager->getAllStudentsWithMarks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/boostrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['username'] ?>!</h2>
    <p>This is the main page after successful login</p>

    <a href="login.php" class="btn btn-danger">Logout</a>
    
    <h3>Student List</h3>
    <a href="add_student.php" class="btn btn-success mb-3">Add Student</a>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Action</th>
            <th>Mark Details</th> <!-- Thêm cột mới cho nút "Mark Details" -->
        </tr>
        </thead>
        <tbody>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo $student['id']; ?></td>
                <td><?php echo $student['name']; ?></td>
                <td><?php echo $student['address']; ?></td>
                <td>
                    <a href="edit_student.php?id=<?php echo $student['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_student.php?id=<?php echo $student['id']; ?>" class="btn btn-danger dtn-sm"
                        onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                </td>
                <td>
                    <?php
                    // Kiểm tra xem sinh viên có điểm hay không
                    if ($student['mark_count'] > 0) {
                        echo '<a href="mark_details.php?student_id=' . $student['id'] . '" class="btn btn-info btn-sm">
                        Mark Details</a>';
                    } else {
                        echo '<button class="btn btn-info btn-sm" disabled>Mark Details</button>';
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach;; ?>
        </tbody>
    </table>
</div>
</body>
</html>