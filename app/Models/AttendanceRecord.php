<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    use HasFactory;

    // Define the table if it's different from the default 'attendance_records'
    protected $table = 'attendance_records';

    // Set the attributes that should be mass assignable
    protected $fillable = [
        'employee_id',    // Foreign key to the Employee table
        'attendance_date',
        'status',         // Present, Absent, Late, etc.
        'check_in_time',  // The time the employee logged in
        'check_out_time', // The time the employee logged out
    ];

    // Define the relationship with the Employee model
    public function employee()
    {
        return $this->belongsTo(Employee::class); // An attendance record belongs to an employee
    }
}
