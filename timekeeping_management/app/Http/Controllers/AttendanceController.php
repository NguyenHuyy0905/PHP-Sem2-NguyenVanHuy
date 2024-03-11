<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Tạo đơn xin nghỉ phép
    public function createLeave(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_date' => 'required|date',
            'leave_count' => 'required|integer|min:1',
            'reason' => 'nullable|string',
        ]);

        $leave = new Leave();
        $leave->employee_id = $request->employee_id;
        $leave->leave_date = $request->leave_date;
        $leave->leave_count = $request->leave_count;
        $leave->reason = $request->reason;
        $leave->save();

        return response()->json(['message' => 'Đơn xin nghỉ phép đã được tạo thành công'], 201);
    }

    // Thống kê số ngày nghỉ của mỗi nhân viên
    public function calculateLeaveDays($employeeId)
    {
        $totalLeaveDays = Leave::where('employee_id', $employeeId)->sum('leave_count');
        return $totalLeaveDays;
    }

    // Thống kê số ngày đi làm của mỗi nhân viên
    public function calculateAttendanceDays($employeeId)
    {
        $totalAttendanceDays = Attendance::where('employee_id', $employeeId)->count();
        return $totalAttendanceDays;
    }

    // Tính hiệu suất nghỉ của mỗi nhân viên
    public function calculateLeaveEfficiency($employeeId)
    {
        $totalLeaveDays = $this->calculateLeaveDays($employeeId);
        $leaveEfficiency = min(($totalLeaveDays / 12) * 100, 100); // 12 là số ngày nghỉ tối đa trong một năm
        return $leaveEfficiency;
    }

    // Tính hiệu suất đi làm của mỗi nhân viên
    public function calculateAttendanceEfficiency($employeeId)
    {
        $totalAttendanceDays = $this->calculateAttendanceDays($employeeId);
        $attendanceEfficiency = min((22 - $totalAttendanceDays) / 22 * 100, 100); // 22 là số ngày làm việc tối đa trong một tháng
        return $attendanceEfficiency;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
