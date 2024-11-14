<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Define the table if it's different from the default 'employees'
    protected $table = 'employees';

    // Set the attributes that should be mass assignable
    protected $fillable = [
        'user_id',  // Foreign key to the User table
        'name',
        'dob',      // Date of birth
        'city',
        'email',
        'status',   // Active/Inactive status
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class); // Each employee belongs to a user
    }

    // Define the relationship with the AttendanceRecord model
    public function attendanceRecords()
    {
        return $this->hasMany(AttendanceRecord::class); // Each employee can have multiple attendance records
    }

    // Define the relationship with the LeaveRequest model
    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class); // Each employee can have multiple leave requests
    }
}
