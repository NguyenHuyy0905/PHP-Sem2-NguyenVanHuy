<?php
global $conn;
include "config.php";

// Thêm sinh viên
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_student"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $address = $_POST["address"];

    $sql = "INSERT INTO Students (id, name, address) VALUES ('$id', '$name', '$address')";
    $conn->query($sql);
}

// Thêm môn học
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_subject"])) {
    $subject_name = $_POST["subject_name"];

    $sql = "INSERT INTO Subjects (name) VALUES ('$subject_name')";
    $conn->query($sql);
}

// Thêm điểm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_mark"])) {
    $student_id = $_POST["student_id"];
    $subject_id = $_POST["subject_id"];
    $marks = $_POST["marks"];

    $sql = "INSERT INTO Marks (student_id, subject_id, mark) VALUES ('$student_id', '$subject_id', $marks)";
    $conn->query($sql);
}

// Hiển thị danh sách sinh viên
$sql_students = "SELECT * FROM Students";
$result_students = $conn->query($sql_students);

// Hiển thị danh sách môn học
$sql_subjects = "SELECT * FROM Subjects";
$result_subjects = $conn->query($sql_subjects);

// Hiển thị danh sách điểm
$sql_marks = "SELECT Marks.id, Students.name AS student_name, Subjects.name AS subject_name, mark FROM Marks
              JOIN Students ON Marks.student_id = Students.id
              JOIN Subjects ON Marks.subject_id = Subjects.id";
$result_marks = $conn->query($sql_marks);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
</head>
<body>
<h2>Thêm sinh viên</h2>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Id: <input type="text" id="id" name="id" required>
    Tên: <input type="text" name="name" required>
    Địa chỉ: <input type="text" name="address" required>
    <input type="submit" name="add_student" value="Thêm">
</form>

<h2>Thêm môn học</h2>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    Tên môn học: <input type="text" name="subject_name" required>
    <input type="submit" name="add_subject" value="Thêm">
</form>

<h2>Thêm điểm</h2>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    Sinh viên:
    <select name="student_id">
        <?php while($row = $result_students->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php endwhile; ?>
    </select>
    Môn học:
    <select name="subject_id">
        <?php while($row = $result_subjects->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php endwhile; ?>
    </select>
    Điểm: <input type="text" name="marks" required>
    <input type="submit" name="add_mark" value="Thêm">
</form>
<h2>Danh sách điểm sinh viên</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Sinh viên</th>
        <th>Môn học</th>
        <th>Điểm</th>
    </tr>
    <?php while($row = $result_marks->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['student_name']; ?></td>
        <td><?php echo $row['subject_name']; ?></td>
        <td><?php echo $row['mark']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
