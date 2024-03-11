<!-- resources/views/createLeave.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo đơn xin nghỉ phép</title>
</head>
<body>
<h1>Tạo đơn xin nghỉ phép</h1>

<form method="POST" action="{{ route('leave.create') }}">
    @csrf
    <label for="employee_id">ID Nhân viên:</label><br>
    <input type="text" id="employee_id" name="employee_id" required><br>

    <label for="leave_date">Ngày nghỉ:</label><br>
    <input type="date" id="leave_date" name="leave_date" required><br>

    <label for="leave_count">Số ngày nghỉ:</label><br>
    <input type="number" id="leave_count" name="leave_count" required><br>

    <label for="reason">Lý do:</label><br>
    <textarea id="reason" name="reason"></textarea><br>

    <button type="submit">Gửi đơn</button>
    <!-- Thêm nút chuyển đến trang thống kê chấm công -->
    <a href="{{ route('attendance.statistics') }}">Thống kê chấm công</a>
</form>
</body>
</html>

