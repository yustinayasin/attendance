<?php

namespace App\Http\Controllers;

use App\Models\AttendanceRecord;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all attendance records with employee details
        $attendanceRecords = AttendanceRecord::with('employee')->get();

        return response()->json([
            'message' => 'List of attendance records',
            'data' => $attendanceRecords,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return a view for creating a new attendance record (for web routes)
        return view('attendance_records.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'employees_id' => 'required|exists:employees,id',
            'attendance_date' => 'required|attendance_date',
            'status' => 'required|string|max:255',
            'check_in_time' => 'nullable|date_format:H:i:s',
            'check_out_time' => 'nullable|date_format:H:i:s',
        ]);

        // Create a new attendance record
        $attendanceRecord = AttendanceRecord::create($validated);

        return response()->json([
            'message' => 'Attendance record created successfully',
            'data' => $attendanceRecord,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find an attendance record by ID with employee details
        $attendanceRecord = AttendanceRecord::with('employee')->findOrFail($id);

        return response()->json([
            'message' => 'Attendance record details',
            'data' => $attendanceRecord,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Return a view for editing an attendance record (for web routes)
        $attendanceRecord = AttendanceRecord::findOrFail($id);

        return view('attendance_records.edit', compact('attendanceRecord'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the attendance record by ID
        $attendanceRecord = AttendanceRecord::findOrFail($id);

        // Validate the incoming request
        $validated = $request->validate([
            'employees_id' => 'required|exists:employees,id',
            'attendance_date' => 'required|attendance_date',
            'status' => 'required|string|max:255',
            'check_in_time' => 'nullable|date_format:H:i:s',
            'check_out_time' => 'nullable|date_format:H:i:s',
        ]);

        // Update the attendance record
        $attendanceRecord->update($validated);

        return response()->json([
            'message' => 'Attendance record updated successfully',
            'data' => $attendanceRecord,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the attendance record by ID
        $attendanceRecord = AttendanceRecord::findOrFail($id);

        // Delete the attendance record
        $attendanceRecord->delete();

        return response()->json([
            'message' => 'Attendance record deleted successfully',
        ]);
    }
}
