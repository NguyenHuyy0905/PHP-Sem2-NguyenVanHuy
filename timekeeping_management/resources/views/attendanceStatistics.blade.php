<!-- resources/views/attendanceStatistics.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê chấm công</title>
</head>
<body>
<h1>Thống kê chấm công</h1>

<h2>Thống kê số ngày nghỉ của mỗi nhân viên:</h2>
<ul>
    @foreach($leaveStatistics as $employeeId => $leaveDays)
        <li>Nhân viên ID {{ $employeeId }}: {{ $leaveDays }} ngày nghỉ</li>
    @endforeach
</ul>

<h2>Thống kê số ngày đi làm của mỗi nhân viên:</h2>
<ul>
    @foreach($attendanceStatistics as $employeeId => $attendanceDays)
        <li>Nhân viên ID {{ $employeeId }}: {{ $attendanceDays }} ngày đi làm</li>
    @endforeach
</ul>

<h2>Thống kê hiệu suất nghỉ của mỗi nhân viên:</h2>
<ul>
    @foreach($leaveEfficiency as $employeeId => $efficiency)
        <li>Nhân viên ID {{ $employeeId }}: {{ $efficiency }}%</li>
    @endforeach
</ul>

<h2>Thống kê hiệu suất đi làm của mỗi nhân viên:</h2>
<ul>
    @foreach($attendanceEfficiency as $employeeId => $efficiency)
        <li>Nhân viên ID {{ $employeeId }}: {{ $efficiency }}%</li>
    @endforeach
</ul>
<!-- Thêm nút chuyển đến trang tạo đơn xin nghỉ phép -->
<a href="{{ route('leave.create') }}">Tạo đơn xin nghỉ phép</a>
</body>
</html>

